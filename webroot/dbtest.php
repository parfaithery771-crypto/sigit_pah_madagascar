<?php
$dsn = 'mysql:host=mysql-22e1d2da-sigitmincc.i.aivencloud.com;port=14995;dbname=defaultdb;charset=utf8mb4';
$pdo = new PDO($dsn, 'avnadmin', 'AVNS_xzwmfEDAqtpY_ZcrA1N', [PDO::MYSQL_ATTR_SSL_CA=>true]);
$stmt = $pdo->query('DESCRIBE interventions');
while($r=$stmt->fetch()) echo $r['Field'].' | '.$r['Type'].'<br>';
