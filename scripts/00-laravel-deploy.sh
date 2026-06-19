#!/usr/bin/env bash
set -e

echo "Running composer..."
composer install --no-dev --working-dir=/var/www/html

echo "Fixing permissions..."
chown -R nginx:nginx storage bootstrap/cache || chown -R www-data:www-data storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

echo "Linking storage..."
php artisan storage:link || true

echo "Clearing cached config..."
php artisan optimize:clear

echo "Caching config..."
php artisan config:cache

echo "Running migrations..."
php artisan migrate --force

echo "Seeding database if empty..."
php artisan tinker --execute="if (App\\Models\\Product::count() === 0) { Artisan::call('db:seed', ['--force' => true]); echo 'Seeded.'; } else { echo 'Already seeded.'; }"
