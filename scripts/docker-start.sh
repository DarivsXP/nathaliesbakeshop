#!/usr/bin/env bash
set -e

cd /var/www/html

bash /var/www/html/scripts/00-laravel-deploy.sh

echo "Starting Laravel on port ${PORT:-8000}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
