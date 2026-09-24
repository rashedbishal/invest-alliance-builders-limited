#!/usr/bin/env bash
# Runs on the Hostinger server over SSH after the files have been uploaded.
# Inputs (environment): DEPLOY_PATH, PHP_BIN, RUN_MIGRATIONS, MIGRATION_PATH
set -euo pipefail

: "${DEPLOY_PATH:?DEPLOY_PATH is required}"
PHP_BIN="${PHP_BIN:-php}"
RUN_MIGRATIONS="${RUN_MIGRATIONS:-false}"
MIGRATION_PATH="${MIGRATION_PATH:-}"

cd "$DEPLOY_PATH"

if [ ! -f .env ]; then
  echo "ERROR: $DEPLOY_PATH/.env does not exist. Create it once on the server (see docs/DEPLOYMENT.md)." >&2
  exit 1
fi

# storage/ and bootstrap/cache/ are never uploaded, so make sure they exist and are writable.
mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache

echo "Using: $("$PHP_BIN" -v | head -n 1)"

# bootstrap/cache/ is never uploaded, so it can hold cache files from an earlier install that
# list packages this build no longer has (e.g. dev-only providers such as laravel/pail).
# Artisan would crash while booting on them, so remove them first; Laravel rebuilds them.
rm -f bootstrap/cache/*.php

"$PHP_BIN" artisan package:discover --ansi

# Do NOT cache config or routes: SslCommerzNotification calls env('APP_URL') directly, which
# returns null once config is cached and would break the SSLCommerz callback URLs.
"$PHP_BIN" artisan config:clear
"$PHP_BIN" artisan route:clear
"$PHP_BIN" artisan event:clear
"$PHP_BIN" artisan view:clear

if [ "$RUN_MIGRATIONS" = "true" ]; then
  if [ -n "$MIGRATION_PATH" ]; then
    if ! [[ "$MIGRATION_PATH" =~ ^database/migrations/[A-Za-z0-9_]+\.php$ ]]; then
      echo "ERROR: invalid migration path: $MIGRATION_PATH" >&2
      exit 1
    fi
    echo "Running migration: $MIGRATION_PATH"
    "$PHP_BIN" artisan migrate --force --path="$MIGRATION_PATH"
  else
    echo "Running all pending migrations"
    "$PHP_BIN" artisan migrate --force
  fi
else
  echo "Skipping migrations (enable them when running the workflow manually). Current state:"
  "$PHP_BIN" artisan migrate:status || true
fi

echo "Deploy finished."
