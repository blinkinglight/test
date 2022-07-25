#!/bin/bash
pushd /var/www
php artisan octane:install --server swoole
php artisan migrate:fresh --seed --force
php artisan octane:start --host=0.0.0.0 --port=80 --env=production
