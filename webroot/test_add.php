<?php
$dsn = 'mysql:host=sql7.freesqldatabase.com;dbname=sql7830743;port=3306;charset=utf8mb4';
$pdo = new PDO($dsn, 'sql7830743', 'X9UVEJYT3f');
$stmt = $pdo->query('DESCRIBE users');
while($r = $stmt->fetch()) echo $r['Field'].' - '.$r['Type'].'<br>';