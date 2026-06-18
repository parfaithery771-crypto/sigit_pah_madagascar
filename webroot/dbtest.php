<?php
header("Content-Type: text/plain");
require dirname(__DIR__) . "/vendor/autoload.php";
use App\Application;
$app = new Application(dirname(__DIR__) . "/config");

echo "file_exists app_local.php = " . var_export(file_exists(dirname(__DIR__) . "/config/app_local.php"), true) . "\n";
echo "raw getenv DEBUG = " . var_export(getenv("DEBUG"), true) . "\n";
echo "filter_var manual = " . var_export(filter_var(getenv("DEBUG"), FILTER_VALIDATE_BOOLEAN), true) . "\n";
echo "Configure debug = " . var_export(\Cake\Core\Configure::read("debug"), true) . "\n";

$conn = \Cake\Datasource\ConnectionManager::getConfig("default");
if (isset($conn["password"])) { $conn["password"] = "HIDDEN"; }
echo "ConnectionManager config default:\n" . print_r($conn, true) . "\n";
