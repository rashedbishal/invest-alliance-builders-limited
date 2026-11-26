# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A Laravel 12 app for Invest Alliance Builders Limited: a public landing/booking page that sells "shares" (ownership units) in hotel properties (currently Hotel Jana and Hotel Jana The Dove), takes payment via SSLCommerz (BDT, local cards/mobile banking) or PayPal (USD, converted from BDT) — or lets the customer opt for a manual Dutch-Bangla Bank transfer — and emails/generates PDF invoices and money receipts. There is no authenticated admin area or user login in this codebase — it's a single-purpose booking + payment flow plus invoice/receipt delivery.

This app's database is shared with another, separate application (see "Shared database" below) — this is the most important thing to understand before touching migrations or the `transactions`/`invoices` tables.

## Commands

```bash
# Install (first time: composer install, copy .env.example → .env, key:generate, migrate, npm install + build)
composer setup

# Local dev (serves app + queue worker + logs + vite, all at once)
composer dev

# Run all tests
composer test        # runs config:clear first, then php artisan test

# Run a single test file / filter
php artisan test tests/Feature/PayPalPaymentTest.php
php artisan test --filter=test_method_name

# Frontend build
npm run dev      # vite dev server
npm run build    # production build (public/build/manifest.json — required by the welcome view's Vite::asset() calls, even in CI)

# Lint / format PHP
vendor/bin/pint
```

Tests run against in-memory SQLite (`phpunit.xml`), not the real DB — safe to run anytime, no `.env` needed. CI (`.github/workflows/tests.yml`) copies `.env.example` to `.env` for a throwaway key rather than using the tracked `.env`.

## Architecture

### Payment flow (the core of the app)

There are three payment options on the booking form. Two are real gateways feeding the same `transactions` / `invoices` / `submissions` / `transaction_shares` tables:

- **SSLCommerz** — `SslCommerzPaymentController` (`payViaAjax`, `success`, `ipn`, `fail`, `cancel`), backed by `App\Library\SslCommerz\SslCommerzNotification`. Used for amounts under `shares.sslcommerz_limit` (BDT). Both `success` (browser redirect) and `ipn` (server-to-server webhook) can independently mark a transaction Processing — both are guarded by checking `status == 'Pending'` first so only one wins.
- **PayPal** — `PayPalPaymentController` (`create`, `success`, `cancel`), backed by `PayPalService` (REST Orders v2) and `PayPalRate` (BDT→USD conversion, see below). Used when the booking total is at/above the SSLCommerz limit, or whenever the customer picks PayPal. `success` wraps the whole capture+invoice flow in `DB::transaction()` with `lockForUpdate()` to avoid double-processing; PayPal API failures are classified into `DECLINED_ISSUES` (payment genuinely refused → mark Failed) vs. everything else (left Pending — money may have moved, needs manual review).

- **Dutch-Bangla Bank transfer** — `BankTransferController::notify` (`bank-transfer.notify` route). Not a gateway: the customer pays manually and collects their receipt by phone, so this creates **no** Transaction/Invoice/Submission. It only validates the customer details, quotes via `ShareCatalog`, and queues `BankTransferNotificationMail` to `config('mail.from.address')`; the frontend (`resources/js/site.js`) shows a modal with the bank account details.

The two gateway flows (SSLCommerz and PayPal) converge on the same pattern after a successful capture: create an `Invoice` (auto-numbered via `InvoiceNumberGenerator`), create a `Submission` (denormalized unit price/qty snapshot for the invoice), generate a money receipt number (`MoneyReceiptGenerator`), render the `content.invoice` Blade view to PDF (`barryvdh/laravel-dompdf`) with a QR code (`QRProcessor`) linking to the public invoice-access route, then queue `PaymentConfirmationMail` to the customer and `PaymentReceiveConfirmationMail` to the internal addresses in `config('portal.email_address.*')`.

**Pricing is always server-side.** `App\Services\Booking\ShareCatalog::quote()` is the single source of truth for hotel prices/max share counts (from `config/shares.php`, itself from `.env`) — the browser only sends a hotel key and quantity, never a price or total. Any change to pricing logic should go through `ShareCatalog`, not the controllers.

### Admin CMS (`/admin`)

Filament v5 panel (`App\Providers\Filament\AdminPanelProvider`, resources in `app/Filament`). Signs in with its own `admin` guard and `admins` table — **never** the `users` table, which belongs to the portal app. There is exactly one admin, managed only by `php artisan cms:admin` (deletes and replaces it); no registration or password reset.

- **Which rows are ours:** `transactions`/`invoices` are shared with the portal, and both apps write `cn_identifier = 2` and `TRX-…` ids. A transaction belongs to this app iff it has `transaction_shares` rows (`Transaction::scopeFromThisApp()`, `Invoice::scopeFromThisApp()`); every CMS query must go through these scopes. Gateway is derived, not stored: `gateway_transaction_id` set → PayPal, `card_type = Transaction::BANK_CARD_TYPE` → bank transfer, else SSLCommerz.
- **Shared post-payment logic:** `ReceiptService` (invoice + submission + money receipt, PDF, emails) and `PayPalCaptureProcessor` (capture/verify rules, `DECLINED_ISSUES`) are used by `PayPalPaymentController`, the CMS "Verify with PayPal" action and `BankTransferService::markPaid`. `SslCommerzPaymentController` keeps its own inline copy of that logic on purpose — the owner has asked that SSLCommerz code/config not be changed.
- **Bank transfers:** `BankTransferController::notify` saves a `BankTransferRequest` (status New); "Mark paid" in the CMS creates the transaction + share lines + invoice/receipt and emails it like an online payment.
- Filament's published assets (`public/{css,js,fonts}/filament`) are committed because the deploy runs `composer install --no-scripts`; re-run `php artisan filament:assets` after upgrading Filament.

### Currency conversion (two independent, unrelated systems — don't conflate them)

- **Display conversion** (`CurrencyService`, `config/currency.php`): geolocates the visitor (Cloudflare header, then IP lookup) to show BDT prices converted to their local currency. Purely cosmetic — never affects what's charged. Rates are cached and fetched from exchangerate-api.com / open.er-api.com.
- **PayPal charge conversion** (`PayPalRate`, `config/paypal.php`): converts a BDT total into the actual USD amount charged. Can use `rate_source=auto` (shares the same rate feed as display, plus `PAYPAL_RATE_MARGIN_PERCENT` safety margin) or `fixed` (always `PAYPAL_BDT_PER_USD`). This one directly determines money charged, so treat changes here with more care than the display converter.

### Shared database

Several migrations (e.g. `create_transactions_table`, `create_invoices_table`) start with `if (Schema::hasTable(...)) { return; }` and have a no-op `down()`, because the `transactions`/`invoices` tables are shared with a *different, separate application* running against the same production database. Consequences:

- New migrations touching these shared tables must be **additive only** (new nullable columns / new tables) — never rename or drop columns other apps may read.
- Config caching is deliberately never used in production (see `docs/DEPLOYMENT.md`) because `SslCommerzNotification` reads `env('APP_URL')` directly at runtime; caching config makes that return `null` and breaks SSLCommerz callback URLs.

### Route model binding is encrypted

`Invoice::getRouteKey()` / `resolveRouteBinding()` (via `App\Support\RouteCrypto`) encrypt/decrypt the invoice number in URLs (`{invoice}` route params), so invoice numbers are never exposed in plain text in links. The `concern` route parameter (e.g. in `admin-download-invoice`) is similarly encrypted — it isn't a real "concern" model, just an encrypted flag. Don't add plain-integer/plain-string invoice IDs to routes.

Public invoice access (no auth) goes through a separate, opaque, revocable/expirable `public_token` on the `Invoice` model (`invoice-access` route, `InvoiceController::accessViaQr`), not through `RouteCrypto` — that's for QR codes printed on receipts.

## Deployment

Deploys are GitHub Actions → Hostinger shared hosting via rsync+SSH, triggered on push to `main`. Full details, one-time server/secrets setup, and troubleshooting are in `docs/DEPLOYMENT.md` — read it before touching `.github/workflows/deploy.yml`, `.github/scripts/post-deploy.sh`, or `.github/deploy-excludes.txt`. Key points worth knowing while coding (not just deploying):

- `storage/`, `bootstrap/cache/`, and `.env` on the server are never touched by a deploy — don't assume a deploy resets runtime state.
- Migrations run automatically on every deploy (`php artisan migrate --force`), so new migrations must be safe to run against the live shared database with zero downtime (see "Shared database" above).
- Queued mail requires a `queue:work` cron on the server; locally use `composer dev` (starts `queue:listen` alongside `serve`) or the mail will never send.
