---Procedures PROJET SI40----

---Compter le nombre de likes d'un post 

DELIMITER //

CREATE PROCEDURE CountLikesOfPost(IN post_id INT)
BEGIN
    SELECT COUNT(*) AS NumberOfLikes
    FROM likes
    WHERE id_post = post_id;
END //

DELIMITER ;

----Récuperer toutes les dates des post d'un utilisateur
DELIMITER //

CREATE PROCEDURE GetPostDatesOfUser(IN user_id INT)
BEGIN
    SELECT date_creation
    FROM post
    WHERE id_utilisateur = user_id;
END //

DELIMITER ;


---Récuperer toutes les dates des like d'un utilisateur(donné et reçu)
---Likes donnés par un utilisateur 

DELIMITER //
CREATE PROCEDURE GetLikeDatesOfUser(IN user_id INT)
BEGIN
    SELECT date_creation
    FROM likes
    WHERE id_utilisateur = user_id;
    END //

DELIMITER ;

---Likes recus par un utilisateur 
DELIMITER //

CREATE PROCEDURE GetLikeDatesOfUserReceivedt(IN user_id INT)
BEGIN    
    SELECT p.date_creation
    FROM likes AS l
    INNER JOIN post AS p ON l.id_post = p.id
    WHERE p.id_utilisateur = user_id;
END //

DELIMITER ;

---Compter le nombre de followings d'un utilisateur
DELIMITER //

CREATE PROCEDURE CountFollowingsOfUser(IN user_id INT)
BEGIN
    SELECT COUNT(*) as NumberOfFollowings
    FROM Follow
    WHERE id_follower = user_id;
END //

DELIMITER ;

---Compter le nombre de followers d'un utilisateur 
DELIMITER //

CREATE PROCEDURE CountFollowersOfUser(IN user_id INT)
BEGIN
    SELECT COUNT(*)  as NumberOfFollowers
    FROM Follow
    WHERE id_following = user_id;
END //

DELIMITER ;