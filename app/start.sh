#!/bin/bash

set -e  # Detiene la ejecución si hay un error

if [ "$WATCH_ENABLE" = "true" ]; then
    echo "Starting Hyperf in watch mode (hot reload enabled)..."
    composer install 
    exec php bin/hyperf.php server:watch
else
    echo "Starting Hyperf in normal mode..."
    composer install 
    exec php bin/hyperf.php start
fi
