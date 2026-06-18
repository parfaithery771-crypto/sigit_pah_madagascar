<?php
header("Content-Type: text/plain");
require dirname(__DIR__) . "/vendor/autoload.php";
$result = include dirname(__DIR__) . "/config/app_local.php";
echo "debug from direct include = " . var_export($result["debug"] ?? "KEY MISSING", true) . "\n";
echo "Datasources.default.url = " . var_export($result["Datasources"]["default"]["url"] ?? "KEY MISSING", true) . "\n";
echo "raw getenv DEBUG here = " . var_export(getenv("DEBUG"), true) . "\n";
