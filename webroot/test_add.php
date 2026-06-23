<?php
$dsn = 'mysql:host=sql7.freesqldatabase.com;dbname=sql7830743;port=3306;charset=utf8mb4';
$pdo = new PDO($dsn, 'sql7830743', 'X9UVEJYT3f');
$stmt = $pdo->query('SELECT id, nom, email, status FROM users ORDER BY id DESC LIMIT 5');
while($r = $stmt->fetch()) echo $r['id'].' | '.$r['nom'].' | '.$r['email'].' | '.$r['status'].'<br>';