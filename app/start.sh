#!/bin/bash

# Determinar si se debe usar el modo watch (hot reload)
if [ "$WATCH_ENABLE" = "true" ]; then
    echo "Starting Hyperf in watch mode (hot reload enabled)..."
    cd /var/www/html
    php bin/hyperf.php watcher:start
else
    echo "Starting Hyperf in normal mode..."
    cd /var/www/html
    php bin/hyperf.php start
fi