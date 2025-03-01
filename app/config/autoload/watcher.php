<?php

use function Hyperf\Support\env;

return [
    'enabled' => env('WATCHER_ENABLED', true),
    'mode' => 'scan',
    'paths' => [
        'app',
        'config',
    ],
];
