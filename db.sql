-- Database creation.
DROP DATABASE IF EXISTS `mbeck_selatchom_database`;
CREATE DATABASE `mbeck_selatchom_database`;

USE `mbeck_selatchom_database`;


-- Tables creation.
DROP TABLE IF EXISTS utilisateur;
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_de_naissance DATE NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    admin BOOLEAN NOT NULL,
    statut_bannissement BOOLEAN NOT NULL,
    profile_photo VARCHAR(255) NULL
);

DROP TABLE IF EXISTS post;
CREATE TABLE post(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INTEGER NOT NULL,
    contenu VARCHAR(255) NOT NULL,
    date_creation DATE NOT NULL,
    image VARCHAR(255) NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
);

DROP TABLE IF EXISTS commentaire;
CREATE TABLE commentaire(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INTEGER NOT NULL,
    id_post INTEGER NOT NULL,
    contenu VARCHAR(255) NOT NULL,
    date_creation DATE NOT NULL,
    image VARCHAR(255) NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
    FOREIGN KEY (id_post) REFERENCES post(id)
);

DROP TABLE IF EXISTS notificationGenerique;
CREATE TABLE notificationGenerique(
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenu VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS notification;
CREATE TABLE notification(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INTEGER NOT NULL,
    id_notificationGenerique INTEGER NOT NULL,
    statut_lecture BOOLEAN NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
    FOREIGN KEY (id_notificationGenerique) REFERENCES notificationGenerique(id)
);

DROP TABLE IF EXISTS likes;
CREATE TABLE likes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_post INTEGER NOT NULL,
    id_utilisateur INTEGER NOT NULL,
    date_creation DATE NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
    FOREIGN KEY (id_post) REFERENCES post(id)
);

DROP TABLE IF EXISTS Follow;
CREATE TABLE Follow(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_follower INTEGER NOT NULL,     -- l'identifiant de l'utilsateur qui follow.
    id_following INTEGER NOT NULL,    -- l'identifiant de l'utilsateur qui est followé.
    date_creation DATE NOT NULL,
    FOREIGN KEY (id_follower) REFERENCES utilisateur(id),
    FOREIGN KEY (id_following) REFERENCES utilisateur(id)
);


-- Data insertion.

INSERT INTO utilisateur (email, mdp, nom, prenom, date_de_naissance, adresse, admin, statut_bannissement)
VALUES 
('mbohlulajonathan4@gmail.com', '$2y$10$9I2vH3YsIUXBmV/riX5K/.DtwV8njr30lJ9TC6R/jbWMZ6ovdvf3O', 'MBECK MBOH', 'Lula', '2003-01-12', '123 Rue de la Poste', 1, 0),
('jamesross97@gmail.com', '$2y$10$qkPhmJegGX2Zk82b0EE9re8ZlZ8GuGSwhXFlP2/ZSiUFkkS4KXKj2', 'ROSS', 'James', '1997-03-13', '17 Avenue GENDARME', 0, 0)
;

INSERT INTO post (id_utilisateur, contenu, date_creation)
VALUES
(1, 'Ceci est mon premier post', '2024-04-12')
;