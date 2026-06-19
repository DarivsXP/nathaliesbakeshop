#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f vendor/autoload.php ]; then
    echo "Installing composer dependencies..."
    composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
else
    echo "Composer dependencies already present."
fi

echo "Fixing permissions..."
chmod -R 775 storage bootstrap/cache || true

echo "Linking storage..."
php artisan storage:link || true

echo "Running migrations..."
php artisan migrate --force

echo "Clearing cached config..."
php artisan optimize:clear

echo "Caching config..."
php artisan config:cache

echo "Seeding database if empty..."
php artisan tinker --execute="if (App\\Models\\Product::count() === 0) { Artisan::call('db:seed', ['--force' => true]); echo PHP_EOL.'Seeded.'.PHP_EOL; } else { echo PHP_EOL.'Already seeded.'.PHP_EOL; }" || echo "Seed skipped or failed."

echo "Deploy script finished."
