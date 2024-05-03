<?php


namespace TSN\src\controllers\follow;

require_once("./src/models/follow.php");
use TSN\src\models\follow\FollowManagment as ModelFollowManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

require_once("src/controllers/notification/notification.php");
use TSN\src\controllers\notification\Notification as Notification;

class Follow {

    private ModelFollowManagment $followManagment;
    private ModelConfig $config;
    private Notification $notification;

    public function newFollow($idFollower, $idFollowing, $dateCreation){ // To follow another user.

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->followManagment = new ModelFollowManagment;
        $this->followManagment->followAnotherUser($idFollower, $idFollowing, $dateCreation);

        $this->getUserFollowings($idFollower);  // To get the list of the followings of the user up to date.

        $this->notification = new Notification;
        $this->notification->sendNotification($idFollower, 2, date('Y-m-d')); // To send a notification to the follower.
        $this->notification->getUnreadUserNotificationsNumber($idFollower);
        $this->notification->getUserNotifications($idFollower);

        $this->notification->sendNotification($idFollowing, 1, date('Y-m-d')); // To send a notification to the following.

        header("location: {$startingUrl}/index.php?action=home");
    }

    public function unFollow($idFollower, $idFollowing){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->followManagment = new ModelFollowManagment;
        $this->followManagment->unFollowUser($idFollower, $idFollowing);

        $this->getUserFollowings($idFollower);  // To get the list of the followings of the user up to date.

        $this->notification = new Notification;
        $this->notification->sendNotification($idFollower, 4, date('Y-m-d')); // To send a notification to the follower.
        $this->notification->getUnreadUserNotificationsNumber($idFollower);
        $this->notification->getUserNotifications($idFollower);

        $this->notification->sendNotification($idFollowing, 3, date('Y-m-d')); // To send a notification to the following.

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