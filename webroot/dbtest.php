<?php
header("Content-Type: text/plain");
require dirname(__DIR__) . "/vendor/autoload.php";
use App\Application;
$app = new Application(dirname(__DIR__) . "/config");
echo "debug = " . var_export(\Cake\Core\Configure::read("debug"), true) . "\n";
$ds = \Cake\Core\Configure::read("Datasources.default");
if (isset($ds["password"])) { $ds["password"] = "HIDDEN"; }
echo "Datasources.default:\n" . print_r($ds, true) . "\n";
echo "getenv DATABASE_URL = " . (getenv("DATABASE_URL") ? "SET" : "NOT SET") . "\n";
echo "getenv DEBUG = " . var_export(getenv("DEBUG"), true) . "\n";
