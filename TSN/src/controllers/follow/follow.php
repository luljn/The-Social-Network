<?php


namespace TSN\src\controllers\follow;

require_once("./src/models/follow.php");
use TSN\src\models\follow\Follow as ModelFollow;

class Follow {

    private ModelFollow $follow;

    public function getUserFollowings($idUser){  // To retrieve all the persons that the user follows.

        $this->follow = new ModelFollow;
        $this->follow->getFollowingsOfUser($idUser);
    }

    public function getUserFollowers($idUser){   // To retrieve all the persons who followed the user.
        
        $this->follow = new ModelFollow;
        $this->follow->getFollowersOfUser($idUser);
    }
}