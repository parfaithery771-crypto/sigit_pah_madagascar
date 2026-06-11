<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
$conn = Cake\Datasource\ConnectionManager::get('default');
try {
    $conn->execute("ALTER TABLE interventions MODIFY COLUMN type_intervention ENUM(
        'resolution_probleme',
        'installation_configuration',
        'restoration_mise_a_niveau',
        'supervision_fonctionnement',
        'supervision_analyse_pannes',
        'maintenance_premier_degre',
        'maintenance_preventive_curative'
    ) NOT NULL");
    echo 'ENUM mis a jour!' . PHP_EOL;
} catch (Exception $e) {
    echo 'Erreur: ' . $e->getMessage() . PHP_EOL;
}