<?php
$host = getenv('DB_HOST') ?: 'reseau.proxy.rlwy.net';
$port = getenv('DB_PORT') ?: '25358';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'qSsHEHZmMgaWlVuzLkAjTGlpmhqIkPsD';
$db   = getenv('DB_DATABASE') ?: 'railway';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sqls = [
        "ALTER TABLE interventions ADD COLUMN IF NOT EXISTS type_intervention VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE interventions ADD COLUMN IF NOT EXISTS type_intervention_id INT DEFAULT NULL",
        "ALTER TABLE interventions ADD COLUMN IF NOT EXISTS direction_id INT DEFAULT NULL",
        "ALTER TABLE interventions ADD COLUMN IF NOT EXISTS user_id INT DEFAULT NULL",
    ];
    
    foreach ($sqls as $sql) {
        try { $pdo->exec($sql); } catch(Exception $e) { echo "Skip: " . $e->getMessage() . "<br>"; }
    }
    
    echo 'Columns added!';
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}