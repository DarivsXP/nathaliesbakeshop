#!/usr/bin/env bash
set -e

echo "Running composer..."
composer install --no-dev --working-dir=/var/www/html

echo "Linking storage..."
php artisan storage:link || true

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Seeding database if empty..."
php artisan tinker --execute="if (App\\Models\\Product::count() === 0) { Artisan::call('db:seed', ['--force' => true]); echo 'Seeded.'; } else { echo 'Already seeded.'; }"
