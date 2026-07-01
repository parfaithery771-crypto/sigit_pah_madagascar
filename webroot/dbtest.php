<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';
use Cake\Datasource\ConnectionManager;
$conn = ConnectionManager::get('default');

$queries = [
    "ALTER TABLE interventions ADD COLUMN date_intervention DATE NULL",
    "ALTER TABLE interventions ADD COLUMN beneficiaire VARCHAR(255) NULL",
    "ALTER TABLE livrables ADD COLUMN etat VARCHAR(50) NULL",
    "ALTER TABLE livrables ADD COLUMN direction VARCHAR(255) NULL",
];

foreach ($queries as $q) {
    try {
        $conn->execute($q);
        echo "OK: $q<br>";
    } catch (\Exception $e) {
        echo "SKIP (deja existant ou erreur): $q -- " . $e->getMessage() . "<br>";
    }
}

echo "<br>Termine.";
