<?php
return [
    'debug' => true,
    'App' => [
       'paths' => [
    'templates' => [ROOT . DS . 'templates' . DS],
],
        'namespace' => 'App',
        'encoding' => 'UTF-8',
        'defaultLocale' => 'fr_FR',
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        'fullBaseUrl' => false,
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
    ],
    'Security' => [
        'salt' => 'a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6',
    ],
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'gestion_interventions',
            'encoding' => 'utf8mb4',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
        ],
    ],
    'Cache' => [
        'default' => [
            'className' => 'Cake\Cache\Engine\FileEngine',
            'path' => CACHE,
        ],
    ],
    'Error' => [
         'errorLevel' => E_ALL & ~E_USER_DEPRECATED,
        'errorLevel' => E_ALL,
        'log' => true,
    ],
    'Session' => [
        'defaults' => 'php',
    ],
];