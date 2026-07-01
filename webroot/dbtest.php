<?php
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';
use Cake\Datasource\ConnectionManager;
$conn = ConnectionManager::get('default');
echo "=== INTERVENTIONS ===<br>";
$rows = $conn->execute('DESCRIBE interventions')->fetchAll('assoc');
foreach($rows as $r) echo $r['Field'].' | '.$r['Type'].'<br>';
echo "<br>=== SAMPLE DATA ===<br>";
$data = $conn->execute('SELECT * FROM interventions LIMIT 2')->fetchAll('assoc');
echo '<pre>'; print_r($data); echo '</pre>';
echo "<br>=== LIVRABLES ===<br>";
$rows2 = $conn->execute('DESCRIBE livrables')->fetchAll('assoc');
foreach($rows2 as $r) echo $r['Field'].' | '.$r['Type'].'<br>';
