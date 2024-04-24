<?php


namespace TSN\src\controllers\follow;

require_once("./src/models/follow.php");
use TSN\src\models\follow\FollowManagment as ModelFollowManagment;

class Follow {

    private ModelFollowManagment $followManagment;

    public function getUserFollowings($idUser){  // To retrieve all the persons that the user follows.

        $this->followManagment = new ModelFollowManagment;
        $this->followManagment->getFollowingsOfUser($idUser);
    }

    public function getPeopleToFollowForTheUser($idUser){

        $this->followManagment = new ModelFollowManagment;
        $this->followManagment->getPeopleToFollow($idUser);
    }

    public function getUserFollowers($idUser){   // To retrieve all the persons who followed the user.
        
        $this->followManagment = new ModelFollowManagment;
        $this->followManagment->getFollowersOfUser($idUser);
    }
}