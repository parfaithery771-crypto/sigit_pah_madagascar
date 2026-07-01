<?php
$dsn = 'mysql:host=sql7.freesqldatabase.com;port=3306;dbname=sql7830743;charset=utf8mb4';
$pdo = new PDO($dsn, 'sql7830743', 'X9UVEJYT3f');
echo "=== LIVRABLES ===<br>";
foreach($pdo->query('DESCRIBE livrables') as $r) echo $r['Field'].' | '.$r['Type'].'<br>';
echo "=== INTERVENTIONS ===<br>";
foreach($pdo->query('DESCRIBE interventions') as $r) echo $r['Field'].' | '.$r['Type'].'<br>';
