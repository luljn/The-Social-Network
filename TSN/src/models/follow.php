<?php 


namespace TSN\src\models\follow;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User as User;

class Follow {

    private DatabaseConnection $databaseConnection;

    public function getFollowingsOfUser($idUser){    // To retrieve all the persons that the user follows.

        $this->databaseConnection = new DatabaseConnection;
    }

    public function getFollowersOfUser($idUser){   // To retrieve all the persons who followed the user.

        $this->databaseConnection = new DatabaseConnection;
    }
}