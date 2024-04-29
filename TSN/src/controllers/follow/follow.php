<?php


namespace TSN\src\controllers\follow;

require_once("./src/models/follow.php");
use TSN\src\models\follow\FollowManagment as ModelFollowManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

class Follow {

    private ModelFollowManagment $followManagment;
    private ModelConfig $config;

    public function newFollow($idFollower, $idFollowing, $dateCreation){ // To follow another user.

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->followManagment = new ModelFollowManagment;
        $this->followManagment->followAnotherUser($idFollower, $idFollowing, $dateCreation);

        $this->getUserFollowings($idFollower);  // To get the list of the followings of the user up to date.

        header("location: {$startingUrl}/index.php?action=home");
    }

    public function unFollow($idFollower, $idFollowing){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->followManagment = new ModelFollowManagment;
        $this->followManagment->unFollowUser($idFollower, $idFollowing);

        $this->getUserFollowings($idFollower);  // To get the list of the followings of the user up to date.

        header("location: {$startingUrl}/index.php?action=myProfile");
    }

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