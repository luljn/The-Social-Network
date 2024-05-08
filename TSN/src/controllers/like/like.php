<?php

namespace TSN\src\controllers\like;

require_once("./src/models/like.php");
use TSN\src\models\like\Like as ModelLike;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

require_once("src/controllers/notification/notification.php");
use TSN\src\controllers\notification\Notification as Notification;

class Like {

    private ModelLike $like;
    private ModelConfig $config;
    private Notification $notification;

    public function addLike($idPost, $idUser, $date, $idPostAuthor){

        $this->like = new ModelLike;
        $this->like->addLikeOnPost($idPost, $idUser, $date);

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->notification = new Notification;
        $this->notification->sendNotification($idPostAuthor, 6, date('Y-m-d')); // We send a notification to the author of the post.

        $user = $_SESSION['user'];
        if($user->getId() == $idPostAuthor){  // If the user likes one of his post. We retrieve his recent notification.

            $this->notification->getUserNotifications($idPostAuthor);
            $this->notification->getUnreadUserNotificationsNumber($idPostAuthor);
        }

        header("location: {$startingUrl}/index.php?action=home");
    }

    public function removeLike($idPost, $idUser){

        $this->like = new ModelLike;
        $this->like->removeLikeOnPost($idPost, $idUser);

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();
        header("location: {$startingUrl}/index.php?action=home");
    }

    public function getLikedPosts($idUser){

        $this->like = new ModelLike;
        $this->like->getPostsLikedByTheUser($idUser);        
    }

    public function getLikesGiven($idUser){
     
        $this->like = new ModelLike;
        $this->like->getNumberOfLikesGivenByUser($idUser);
    }

    public function getLikesReceived($idUser){

        $this->like = new ModelLike;
        $this->like->getNumberOfLikesReceivedByUser($idUser);
    }
}