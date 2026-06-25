<?php
$host = getenv('DB_HOST') ?: 'reseau.proxy.rlwy.net';
$port = getenv('DB_PORT') ?: '25358';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'qSsHEHZmMgaWlVuzLkAjTGlpmhqIkPsD';
$db   = getenv('DB_DATABASE') ?: 'railway';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(100),
        prenom VARCHAR(100),
        email VARCHAR(150) UNIQUE,
        password VARCHAR(255),
        role VARCHAR(20) DEFAULT 'technicien',
        status VARCHAR(20) DEFAULT 'pending',
        avatar VARCHAR(255),
        reset_token VARCHAR(10),
        reset_expires DATETIME,
        created DATETIME DEFAULT CURRENT_TIMESTAMP,
        modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    INSERT IGNORE INTO users (nom, email, password, role, status) VALUES 
    ('Admin', 'admin@sigit.mg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'approved');
    ";
    
    $pdo->exec($sql);
    echo 'Tables created! Admin: admin@sigit.mg / password';
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}