<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';
use Cake\Datasource\ConnectionManager;
$conn = ConnectionManager::get('default');
$data = $conn->execute('SELECT id, date, beneficiaire, description_travaux, observation FROM interventions ORDER BY id DESC LIMIT 3')->fetchAll('assoc');
echo '<pre>'; print_r($data); echo '</pre>';
