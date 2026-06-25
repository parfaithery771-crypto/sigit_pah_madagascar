<?php
$host = getenv('DB_HOST') ?: 'reseau.proxy.rlwy.net';
$port = getenv('DB_PORT') ?: '25358';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'qSsHEHZmMgaWlVuzLkAjTGlpmhqIkPsD';
$db   = getenv('DB_DATABASE') ?: 'railway';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Drop sy recreate ny table interventions mba ho marina
    $pdo->exec("DROP TABLE IF EXISTS interventions");
    $pdo->exec("CREATE TABLE interventions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE,
        direction_id INT,
        type_intervention_id INT,
        type_intervention VARCHAR(100),
        observation TEXT,
        perspectives TEXT,
        date_livrable DATE,
        statut VARCHAR(50) DEFAULT 'en_attente',
        user_id INT,
        created DATETIME DEFAULT CURRENT_TIMESTAMP,
        modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    
    echo 'Interventions table fixed!';
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}