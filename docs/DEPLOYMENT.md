# Deployment (GitHub Actions -> Hostinger shared hosting)

## How it works

| Workflow | Runs when | What it does |
|---|---|---|
| `.github/workflows/tests.yml` | pull requests, pushes to any branch except `main` | Installs dependencies, builds the Vite assets, runs `php artisan test` (SQLite in memory, config from `.env.example` – never the real `.env`). |
| `.github/workflows/deploy.yml` | push to `main`, or manually (Actions > Deploy > Run workflow) | Runs the tests, then builds `vendor/` (no dev packages) and the Vite assets (`public/build`), uploads with rsync over SSH, runs `.github/scripts/post-deploy.sh` on the server, and checks the site answers HTTP 200. |

Deploy behaviour worth knowing:

- **Nothing is deployed if a test fails.** Only one deploy runs at a time.
- **Server state is never touched:** `.env`, `storage/` (logs, sessions, cache), `bootstrap/cache/`, `.well-known/`, `default.php` and any other folders in `public_html` are excluded from upload and from deletion (`.github/deploy-excludes.txt`). Only the app's own folders (`app`, `bootstrap`, `config`, `database`, `public`, `resources`, `routes`, `vendor`) are mirrored exactly, so deleted files disappear from the server.
- **Migrations do NOT run automatically** (see "Database migrations" below).
- **Config and route caching are deliberately not used.** `SslCommerzNotification` reads `env('APP_URL')` directly; once config is cached that returns `null` and the SSLCommerz success/fail/IPN URLs break. The deploy script actively clears those caches.
- The root `.htaccess` makes Apache serve only `public/` and blocks `.env`, `vendor/`, `storage/`, `*.sql`, etc., because the whole project sits inside `public_html`.

## One-time setup

### 1. Hostinger (hPanel)
1. **PHP**: Advanced > PHP Configuration > choose **PHP 8.3** (the project requires `^8.3`) and make sure the `gd`, `mbstring`, `curl`, `fileinfo`, `intl`, `pdo_mysql` extensions are enabled.
2. **SSH**: Advanced > SSH Access > enable it. Note the host, port (Hostinger uses `65002`) and username.
3. On your computer create a deploy key (no passphrase):
   `ssh-keygen -t ed25519 -f hostinger_deploy -C "github-actions"`
   Paste `hostinger_deploy.pub` into hPanel's SSH Access > "Add SSH key". Keep the private key for step 2.
4. Find the site folder over SSH (usually `/home/<user>/domains/<domain>/public_html`) and the PHP 8.3 CLI (usually `/opt/alt/php83/usr/bin/php`; check with `ls /opt/alt`).
5. Create the production `.env` **once** on the server, inside that folder (start from `.env.example`). It is never overwritten by deploys. Make sure it has at least:
   `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://your-domain`, a real `APP_KEY` (`php artisan key:generate --show`), the MySQL `DB_*` values, `MAIL_*`, `SSLCZ_*` (with `SSLCZ_TESTMODE=false` for live), `PAYPAL_*` (`PAYPAL_MODE=live` for real payments, plus `PAYPAL_BDT_PER_USD`), `HOTEL_JANA_*` prices/max counts, `QUEUE_CONNECTION=database`.
6. **Queue worker (needed for emails).** Receipts are queued; without a worker no email is ever sent. Add a cron job (Advanced > Cron Jobs, every minute):
   ```
   cd /home/<user>/domains/<domain>/public_html && /opt/alt/php83/usr/bin/php artisan queue:work --stop-when-empty --max-time=55 >/dev/null 2>&1
   ```

### 2. GitHub (Settings > Secrets and variables > Actions)
Secrets:

| Name | Value |
|---|---|
| `SSH_HOST` | server host/IP from hPanel |
| `SSH_PORT` | e.g. `65002` |
| `SSH_USER` | SSH username |
| `SSH_PRIVATE_KEY` | contents of `hostinger_deploy` (the private key) |
| `DEPLOY_PATH` | absolute path of the site folder, e.g. `/home/u123456789/domains/example.com/public_html` |
| `SSH_KNOWN_HOSTS` | *(optional)* pinned host key(s) from `ssh-keyscan -p 65002 <host>`. Leave it unset unless the server always presents the same key: Hostinger can answer with different keys per connection, and then a pinned key makes deploys fail with "REMOTE HOST IDENTIFICATION HAS CHANGED". When unset the host key is not verified (login still requires the private key). |

Variables:

| Name | Value |
|---|---|
| `PHP_BIN` | PHP 8.3 CLI path, e.g. `/opt/alt/php83/usr/bin/php` (defaults to `php`) |
| `SITE_URL` | e.g. `https://example.com` – enables the post-deploy health check |

Optional: Settings > Environments > `production` > add *required reviewers* to make every deploy wait for an approval click.

## Database migrations
The production database is shared with other tables/apps and some older migrations in this repo (`submissions`, `jobs`) have no "table already exists" guard, so a blanket `migrate` can fail on production. Deploys therefore only print `migrate:status`.

To run a migration: Actions > Deploy > *Run workflow* > tick **Run database migrations**. For the share-booking feature run only the new one by entering
`database/migrations/2026_09_24_000001_create_transaction_shares_table.php` in *migration_path*. Leave it empty only after `migrate:status` shows that just the intended migrations are pending. **Deploy this migration before (or with) the code that needs it**, otherwise both payment methods fail when they save the booking lines.

## Rolling back
Re-run the Deploy workflow on an earlier commit (Actions > Deploy > Run workflow, pick the tag/branch), or `git revert` on `main`. Database migrations are not rolled back automatically.

## Troubleshooting
- *`REMOTE HOST IDENTIFICATION HAS CHANGED`*: delete the `SSH_KNOWN_HOSTS` secret (or leave it unset) – see the table above.
- *`Load key ... error in libcrypto`* or *`SSH_PRIVATE_KEY is not a usable private key`*: the secret isn't a valid key. Paste the whole private-key file (both `-----BEGIN/END ... PRIVATE KEY-----` lines, each on its own line), generated without a passphrase, in OpenSSH format – not the `.pub` file and not a PuTTY `.ppk`.
- *`Permission denied (publickey)`*: the public key isn't added in hPanel, or `SSH_PRIVATE_KEY` was pasted without its `BEGIN/END` lines.
- *`.env does not exist`*: create it once on the server (step 1.5).
- *HTTP 500 after deploy*: check `storage/logs/laravel.log` on the server; confirm PHP 8.3 is active for the site and `PHP_BIN` points to 8.3.
- *Emails not arriving*: check the cron job (step 1.6) and the `failed_jobs` table.
