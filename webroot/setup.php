<?php
$host = getenv('DB_HOST') ?: 'reseau.proxy.rlwy.net';
$port = getenv('DB_PORT') ?: '25358';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'qSsHEHZmMgaWlVuzLkAjTGlpmhqIkPsD';
$db   = getenv('DB_DATABASE') ?: 'railway';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $newPassword = password_hash('Admin2025!', PASSWORD_DEFAULT);
    
    // Update admin existant
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@sigit.mg'");
    $stmt->execute([$newPassword]);
    
    if ($stmt->rowCount() === 0) {
        // Raha tsy misy, mamorona vaovao
        $stmt2 = $pdo->prepare("INSERT INTO users (nom, email, password, role, status) VALUES ('Admin', 'admin@sigit.mg', ?, 'admin', 'approved')");
        $stmt2->execute([$newPassword]);
        echo 'Admin created!';
    } else {
        echo 'Password updated!';
    }
    
    echo ' Login: admin@sigit.mg / Admin2025!';
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}