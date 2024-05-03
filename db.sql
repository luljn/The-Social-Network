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
    profile_photo VARCHAR(255) NULL,
    description LONGTEXT NOT NULL
);

DROP TABLE IF EXISTS post;
CREATE TABLE post(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INTEGER NOT NULL,
    contenu LONGTEXT NOT NULL,
    date_creation DATE NOT NULL,
    image VARCHAR(255) NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
);

DROP TABLE IF EXISTS commentaire;
CREATE TABLE commentaire(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INTEGER NOT NULL,
    id_post INTEGER NOT NULL,
    contenu LONGTEXT NOT NULL,
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
    date_creation DATE NOT NULL,
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

INSERT INTO utilisateur (email, mdp, nom, prenom, date_de_naissance, adresse, admin, statut_bannissement, profile_photo, description)
VALUES 
('mbohlulajonathan4@gmail.com', '$2y$10$9I2vH3YsIUXBmV/riX5K/.DtwV8njr30lJ9TC6R/jbWMZ6ovdvf3O', 'MBECK MBOH', 'Lula', '2003-01-12', '123 Rue de la Poste', 1, 0, "Luljn_User_Picture.jpg", "Je suis un développeur logiciel passionné"),
('jamesross97@gmail.com', '$2y$10$qkPhmJegGX2Zk82b0EE9re8ZlZ8GuGSwhXFlP2/ZSiUFkkS4KXKj2', 'ROSS', 'James', '1997-03-13', '17 Avenue GENDARME', 0, 0, "8-bit City_1920x1080.jpg", "Salut je suis un(e) utilisateur(trice) de TSN"),
('marctaylor@gmail.com', '$2y$10$NB/5iXABuRkfx9Kn0Yd13eW..nC/xDBqZS.jTTHQGEZpPdSuxb/HG', 'TAYLOR', 'Marc', '2002-11-12', '14 Boulevard Pierront', 1, 0, NULL, "Salut je suis un(e) utilisateur(trice) de TSN")
;

INSERT INTO post (id_utilisateur, contenu, date_creation, image)
VALUES
(1, 'Ceci est mon premier post', '2024-04-12', NULL),
(2, 'Ceci est mon post, le tout premier que je fait, merci de le lire', '2024-04-16', NULL),
(3, "Je suis un énorme fan de Hunter X Hunter, et j'espère que l'animé aura une suite très bientôt.", "2024-04-21", "hunter_x_hunter_v2__meruem_e_komugi____icon_folder_by_ubagutobr_d80func.ico"),
(3, "Je suis un grand fan de mangas et d'animés.", '2024-04-21', NULL),
(1, "Je suis un grand fan de cet animé, j'attends sa suite avec impatience.", '2024-04-22', "hunter_x_hunter_folder_icon_by_walad7ekaya_d7k1sz1(1).ico"),
(2, "Cet animé est juste fantastique", '2024-04-22', "hunter_x_hunter_v3__hisoka____icon_folder_by_ubagutobr_d80jtem.ico")
;

INSERT INTO commentaire (id_utilisateur, id_post, contenu, date_creation, image)
VALUES
(2, 1, "Ceci est mon commentaire sur ton post", "2024-04-28", NULL)
;

INSERT INTO Follow (id_follower, id_following, date_creation)
VALUES
(1, 2, '2024-04-21'),
(1, 3, '2024-04-21')
;

INSERT INTO notificationGenerique(contenu)
VALUES
("Vous avez un nouveau follower"),
("Vous avez un nouveau following"),
("Un utilisateur a arrêté de vous follow"),
("Vous avez arrêté de follow un utilisateur"),
("Un de vos following a ajouté un nouveau post"),
("Vous avez un nouveau like sur l'un de vos post"),
("Vous avez un nouveau commentaire sur l'un de vos post"),
("Un de vos post a été marqué comme 'sensible' par un administrateur"),
("Un de vos post a été supprimé par un administrateur")
;

INSERT INTO notification(id_utilisateur, id_notificationGenerique, statut_lecture, date_creation)
VALUES
(1, 2, 0, '2024-04-21'),
(1, 2, 0, '2024-04-21'),
(2, 1, 0, '2024-04-21'),
(3, 1, 0, '2024-04-21')
;

INSERT INTO likes(id_post, id_utilisateur, date_creation)
VALUES
(1, 2, '2024-05-01'),
(1, 3, '2024-05-01'),
(5, 1, '2024-05-01')
;


-- Stored procedures --

-- Count the number of likes on a post. 

DELIMITER //

CREATE PROCEDURE CountLikesOfPost(IN post_id INT)
BEGIN
    SELECT COUNT(*) AS NumberOfLikes
    FROM likes
    WHERE id_post = post_id;
END //

DELIMITER ;

-- Retrieve all dates of a user's posts.
DELIMITER //

CREATE PROCEDURE GetPostDatesOfUser(IN user_id INT)
BEGIN
    SELECT date_creation
    FROM post
    WHERE id_utilisateur = user_id;
END //

DELIMITER ;


-- Retrieve all dates of a user's likes (given and received).
-- Likes given by a user.

DELIMITER //
CREATE PROCEDURE GetLikeDatesOfUser(IN user_id INT)
BEGIN
    SELECT date_creation
    FROM likes
    WHERE id_utilisateur = user_id;
    END //

DELIMITER ;

-- Likes received by a user.
DELIMITER //

CREATE PROCEDURE GetLikeDatesOfUserReceivedt(IN user_id INT)
BEGIN    
    SELECT p.date_creation
    FROM likes AS l
    INNER JOIN post AS p ON l.id_post = p.id
    WHERE p.id_utilisateur = user_id;
END //

DELIMITER ;

-- Count the number of followings of a user.
DELIMITER //

CREATE PROCEDURE CountFollowingsOfUser(IN user_id INT)
BEGIN
    SELECT COUNT(*) as NumberOfFollowings
    FROM Follow
    WHERE id_follower = user_id;
END //

DELIMITER ;

-- Count the number of followers of a user. 
DELIMITER //

CREATE PROCEDURE CountFollowersOfUser(IN user_id INT)
BEGIN
    SELECT COUNT(*)  as NumberOfFollowers
    FROM Follow
    WHERE id_following = user_id;
END //

DELIMITER ;