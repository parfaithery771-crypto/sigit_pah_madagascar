<?php
$host = getenv('DB_HOST') ?: 'reseau.proxy.rlwy.net';
$port = getenv('DB_PORT') ?: '25358';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'qSsHEHZmMgaWlVuzLkAjTGlpmhqIkPsD';
$db   = getenv('DB_DATABASE') ?: 'railway';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $tables = [
        "CREATE TABLE IF NOT EXISTS directions (id INT AUTO_INCREMENT PRIMARY KEY, nom_direction VARCHAR(255) NOT NULL, code VARCHAR(50), created DATETIME DEFAULT CURRENT_TIMESTAMP, modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)",
        "CREATE TABLE IF NOT EXISTS type_interventions (id INT AUTO_INCREMENT PRIMARY KEY, libelle VARCHAR(255) NOT NULL, realisation TEXT, perspectives TEXT, created DATETIME DEFAULT CURRENT_TIMESTAMP, modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)",
        "CREATE TABLE IF NOT EXISTS interventions (id INT AUTO_INCREMENT PRIMARY KEY, date DATE, direction_id INT, type_intervention_id INT, observation TEXT, perspectives TEXT, date_livrable DATE, statut VARCHAR(50) DEFAULT 'en_attente', user_id INT, created DATETIME DEFAULT CURRENT_TIMESTAMP, modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)",
        "CREATE TABLE IF NOT EXISTS livrables (id INT AUTO_INCREMENT PRIMARY KEY, intervention_id INT, date_livrable DATE, statut VARCHAR(50), created DATETIME DEFAULT CURRENT_TIMESTAMP, modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)",
        "INSERT IGNORE INTO directions (nom_direction, code) VALUES ('Direction Generale','DG'),('Direction des Ressources Humaines','DRH'),('Direction Financiere','DF'),('Direction des Systemes Information','DSI'),('Direction Commerciale','DC')",
        "INSERT IGNORE INTO type_interventions (libelle, realisation, perspectives) VALUES ('Maintenir en premier degre les materiels TIC','Resolution probleme et maintenance','Materiel en etat de marche'),('Installer et configurer les materiels','Installation et configuration','Tous les materiels en etat'),('Restauration et mise a niveau logiciels','Restitution et mise a niveau','Assurer la reinstallation'),('Effectuer des maintenances preventive et curative','Assurer que les parcs sont en bon etat','Materiel en bon fonctionnement'),('Surveiller et verifier les pannes','Supervision et analyse des pannes','Reseau fonctionnel')",
    ];
    
    foreach ($tables as $sql) {
        $pdo->exec($sql);
    }
    
    echo 'Toutes les tables creees avec succes!';
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}