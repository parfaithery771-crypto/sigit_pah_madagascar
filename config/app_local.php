<?php
return [
    "debug" => true,

    "Security" => [
        "salt" => "sigit-madagascar-repoblika-2025-secure-salt-key",
    ],

 "Datasources" => [
    "default" => [
        "url" => env("DATABASE_URL", null),
        "driver" => "Cake\Database\Driver\Mysql",
        "encoding" => "utf8mb4",
        "timezone" => "UTC",
        "persistent" => false,
        "flags" => [
            \PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        ],
],
   

    "Cache" => [
        "default" => [
            "className" => "Cake\Cache\Engine\FileEngine",
            "prefix"    => "sigit_",
            "path"      => CACHE,
            "serialize" => true,
            "duration"  => "+1 days",
        ],
        "_cake_core_" => [
            "className" => "Cake\Cache\Engine\FileEngine",
            "prefix"    => "sigit_cake_core_",
            "path"      => CACHE . "persistent" . DS,
            "serialize" => true,
            "duration"  => "+1 years",
        ],
        "_cake_model_" => [
            "className" => "Cake\Cache\Engine\FileEngine",
            "prefix"    => "sigit_cake_model_",
            "path"      => CACHE . "models" . DS,
            "serialize" => true,
            "duration"  => "+1 years",
        ],
        "_cake_routes_" => [
            "className" => "Cake\Cache\Engine\FileEngine",
            "prefix"    => "sigit_cake_routes_",
            "path"      => CACHE . "persistent" . DS,
            "serialize" => true,
            "duration"  => "+1 years",
        ],
    ],

    "Log" => [
        "debug" => [
            "className" => "Cake\Log\Engine\FileLog",
            "path"      => LOGS,
            "file"      => "debug",
            "scopes"    => null,
            "levels"    => ["notice", "info", "debug"],
        ],
        "error" => [
            "className" => "Cake\Log\Engine\FileLog",
            "path"      => LOGS,
            "file"      => "error",
            "scopes"    => null,
            "levels"    => ["warning", "error", "critical", "alert", "emergency"],
        ],
    ],

    "Error" => [
        "errorLevel" => E_ALL & ~E_USER_DEPRECATED,
        "log"        => true,
        "trace"      => true,
    ],

    "EmailTransport" => [
        "default" => [
            "className" => "Cake\Mailer\Transport\MailTransport",
        ],
    ],

    "Email" => [
        "default" => [
            "transport" => "default",
            "from"      => "sigit@mnc.gov.mg",
        ],
    ],

    "Session" => [
        "defaults" => "php",
    ],
];