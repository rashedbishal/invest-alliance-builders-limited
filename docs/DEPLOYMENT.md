# Deployment (GitHub Actions -> Hostinger shared hosting)

## How it works

| Workflow | Runs when | What it does |
|---|---|---|
| `.github/workflows/tests.yml` | pull requests, pushes to any branch except `main` | Installs dependencies, builds the Vite assets, runs `php artisan test` (SQLite in memory, config from `.env.example` – never the real `.env`). |
| `.github/workflows/deploy.yml` | push to `main`, or manually (Actions > Deploy > Run workflow) | Runs the tests, then builds `vendor/` (no dev packages) and the Vite assets (`public/build`), uploads with rsync over SSH, runs `.github/scripts/post-deploy.sh` on the server (including `php artisan migrate --force`), and checks the site answers HTTP 200. |

Deploy behaviour worth knowing:

- **Nothing is deployed if a test fails.** Only one deploy runs at a time.
- **Server state is never touched:** `.env`, `storage/` (logs, sessions, cache), `bootstrap/cache/`, `.well-known/`, `default.php` and any other folders in `public_html` are excluded from upload and from deletion (`.github/deploy-excludes.txt`). Only the app's own folders (`app`, `bootstrap`, `config`, `database`, `public`, `resources`, `routes`, `vendor`) are mirrored exactly, so deleted files disappear from the server.
- **Migrations run automatically** on every deploy (see "Database migrations" below).
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

### 3. Admin CMS account (`/admin`)

After the first deploy that includes the CMS, create the admin over SSH (the password is typed at a prompt, never passed on the command line):

```bash
cd /home/<user>/domains/<domain>/public_html && /opt/alt/php83/usr/bin/php artisan cms:admin
```

There is only ever one admin. Running the command again deletes the current admin (signing them out) and creates the new one, which is also how you change the password. The CMS uses its own `admins` table — never the `users` table shared with the portal app. Filament's CSS/JS live in `public/css/filament`, `public/js/filament` and `public/fonts/filament` and are committed to git (the deploy runs `composer install --no-scripts`, so nothing on the server would publish them); after upgrading Filament run `php artisan filament:assets` and commit the result.

## Database migrations
Every deploy runs `php artisan migrate --force` after the files are uploaded, so a push to `main` needs no manual step. All migrations that touch tables shared with the other app are guarded ("skip if the table already exists"), so this is safe on the production database. **When you write a new migration, keep it additive** (new tables/nullable columns): the new code is live for a few seconds before the migration finishes, and a migration that fails stops the deploy after the upload.

Manual runs (Actions > Deploy > *Run workflow*) can untick **Run database migrations** to skip them, or fill *migration_path* to run a single migration file.

## Rolling back
Re-run the Deploy workflow on an earlier commit (Actions > Deploy > Run workflow, pick the tag/branch), or `git revert` on `main`. Database migrations are not rolled back automatically.

## Troubleshooting
- *`REMOTE HOST IDENTIFICATION HAS CHANGED`*: delete the `SSH_KNOWN_HOSTS` secret (or leave it unset) – see the table above.
- *`Load key ... error in libcrypto`* or *`SSH_PRIVATE_KEY is not a usable private key`*: the secret isn't a valid key. Paste the whole private-key file (both `-----BEGIN/END ... PRIVATE KEY-----` lines, each on its own line), generated without a passphrase, in OpenSSH format – not the `.pub` file and not a PuTTY `.ppk`.
- *`Permission denied (publickey)`*: the public key isn't added in hPanel, or `SSH_PRIVATE_KEY` was pasted without its `BEGIN/END` lines.
- *`.env does not exist`*: create it once on the server (step 1.5).
- *HTTP 500 after deploy*: check `storage/logs/laravel.log` on the server; confirm PHP 8.3 is active for the site and `PHP_BIN` points to 8.3.
- *Emails not arriving*: check the cron job (step 1.6) and the `failed_jobs` table.
