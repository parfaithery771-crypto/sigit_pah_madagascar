<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';
use Cake\Datasource\ConnectionManager;
$conn = ConnectionManager::get('default');
try {
    $conn->execute("ALTER TABLE interventions ADD COLUMN description_travaux TEXT NULL");
    echo "OK: colonne ajoutee<br>";
} catch (\Exception $e) {
    echo "Erreur: " . $e->getMessage() . "<br>";
}
$data = $conn->execute('SELECT id, date_intervention, beneficiaire, description_travaux, observation FROM interventions ORDER BY id DESC LIMIT 3')->fetchAll('assoc');
echo '<pre>'; print_r($data); echo '</pre>';
