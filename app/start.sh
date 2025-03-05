#!/bin/bash
set -e
if [ "$WATCH_ENABLE" = "true" ]; then
    echo "Starting Hyperf in watch mode (hot reload enabled)..."
    composer install
    chown -R ${UID:-1000}:${GID:-1000} /var/www/html/runtime/logs
    chmod -R 777 /var/www/html/runtime/logs
    exec php bin/hyperf.php server:watch
else
    echo "Starting Hyperf in normal mode..."
    composer install 
    exec php bin/hyperf.php start
fi
