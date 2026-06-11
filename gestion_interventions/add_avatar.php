<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
$conn = Cake\Datasource\ConnectionManager::get('default');
try {
    $conn->execute("ALTER TABLE users ADD COLUMN avatar VARCHAR(255) DEFAULT NULL");
    echo 'Colonne avatar ajoutee!' . PHP_EOL;
} catch (Exception $e) {
    echo 'Deja existe: ' . $e->getMessage() . PHP_EOL;
}