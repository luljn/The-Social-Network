<?php 

namespace TSN\src\models\like;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

class Like {

    private DatabaseConnection $databaseConnection;

    public function addLikeOnPost($idPost, $idUser, $date){  // To add a like on a post.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "INSERT INTO likes (id_post, id_utilisateur, date_creation)
                      VALUES (\"{$idPost}\", \"{$idUser}\", \"{$date}\");";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();
    }

    public function removeLikeOnPost($idPost, $idUser){ // To remove the like given on a post.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "DELETE FROM likes WHERE id_post = \"{$idPost}\" AND id_utilisateur = \"{$idUser}\";";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();
    }
}