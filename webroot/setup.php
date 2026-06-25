<?php
$host = getenv('DB_HOST') ?: 'reseau.proxy.rlwy.net';
$port = getenv('DB_PORT') ?: '25358';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'qSsHEHZmMgaWlVuzLkAjTGlpmhqIkPsD';
$db   = getenv('DB_DATABASE') ?: 'railway';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("DROP TABLE IF EXISTS livrables");
    $pdo->exec("CREATE TABLE livrables (
        id INT AUTO_INCREMENT PRIMARY KEY,
        intervention_id INT,
        date_livrable DATE,
        date_livraison DATE,
        statut VARCHAR(50) DEFAULT 'en_attente',
        created DATETIME DEFAULT CURRENT_TIMESTAMP,
        modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    
    echo 'Livrables table fixed!';
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}