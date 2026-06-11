CREATE DATABASE gestion_interventions CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;USE gestion_interventions;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','technicien','directeur') DEFAULT 'technicien',
  avatar VARCHAR(255) DEFAULT NULL,
  created DATETIME,
  modified DATETIME
);

CREATE TABLE interventions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_intervention DATE NOT NULL,
  observation TEXT,
  beneficiaire VARCHAR(200) NOT NULL,
  type_intervention ENUM(
    'resolution_probleme',
    'installation_configuration',
    'restoration_mise_a_niveau',
    'supervision_fonctionnement',
    'supervision_analyse_pannes'
  ) NOT NULL,
  statut ENUM('cours','repare','reparable') DEFAULT 'cours',
  user_id INT,
  created DATETIME,
  modified DATETIME,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE livrables (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_livraison DATE NOT NULL,
  etat ENUM('lundi','mardi','mercredi','jeudi','vendredi') NOT NULL,
  direction VARCHAR(150),
  intervention_id INT,
  created DATETIME,
  modified DATETIME,
  FOREIGN KEY (intervention_id) REFERENCES interventions(id)
);