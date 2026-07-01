<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';
use Cake\Datasource\ConnectionManager;
$conn = ConnectionManager::get('default');
$data = $conn->execute('SELECT id, beneficiaire, statut FROM interventions ORDER BY id')->fetchAll('assoc');
echo '<pre>'; print_r($data); echo '</pre>';
