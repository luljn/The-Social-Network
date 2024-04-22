<?php


namespace TSN\src\controllers\follow;

require_once("./src/models/follow.php");
use TSN\src\models\follow\FollowManagment as ModelFollowManagment;

class Follow {

    private ModelFollowManagment $follow;

    public function getUserFollowings($idUser){  // To retrieve all the persons that the user follows.

        $this->follow = new ModelFollowManagment;
        $this->follow->getFollowingsOfUser($idUser);
    }

    public function getUserFollowers($idUser){   // To retrieve all the persons who followed the user.
        
        $this->follow = new ModelFollowManagment;
        $this->follow->getFollowersOfUser($idUser);
    }
}