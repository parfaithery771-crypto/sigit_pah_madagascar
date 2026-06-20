<?php
define('ROOT', dirname(__DIR__));
require ROOT . '/vendor/autoload.php';
try {
    $dsn = 'mysql:host=sql7.freesqldatabase.com;dbname=sql7830743;port=3306';
    $pdo = new PDO($dsn, 'sql7830743', 'X9UVEJYT3f');
    $stmt = $pdo->query('DESCRIBE interventions');
    echo '<b>Columns:</b><br>';
    while($r = $stmt->fetch()) echo $r['Field'].' - '.$r['Type'].'<br>';
} catch(Exception $e) {
    echo 'DB Error: '.$e->getMessage();
}
?>