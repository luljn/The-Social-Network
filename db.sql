CREATE DATABASE 'mbeck--selatchom--database';

DROP TABLE IF EXISTS utilisateurs;
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_de_naissance DATE NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    admin BOOLEAN NOT NULL,
    profile_photo VARCHAR(255) NULL
);

INSERT INTO utilisateurs (email, mdp, nom, prenom, date_de_naissance, adresse, admin)
VALUES ('mbohlulajonathan4@gmail.com', '$2y$10$9I2vH3YsIUXBmV/riX5K/.DtwV8njr30lJ9TC6R/jbWMZ6ovdvf3O', 'MBECK MBOH', 'Lula', '2003-01-12', '123 Rue de la Poste', 1);
