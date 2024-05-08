<?php


namespace TSN\src\controllers\post;

require_once("./src/models/post.php");
use TSN\src\models\post\PostManagment as ModelPostManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

require_once("src/controllers/notification/notification.php");
use TSN\src\controllers\notification\Notification as Notification;

class Post {

    private ModelPostManagment $postManagment;
    private ModelConfig $config;
    private Notification $notification;

    public function addPost($idUser, $content, $date){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->postManagment = new ModelPostManagment;
        $this->postManagment->addPost($idUser, $content, $date);

        header("location: {$startingUrl}/index.php?action=myAccount&userId={$idUser}");
    }

    public function addPostWithImage($idUser, $content, $date, $image){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->postManagment = new ModelPostManagment;

        $this->postManagment->addPostWithImage($idUser, $content, $date, $image);
        header("location: {$startingUrl}/index.php?action=myAccount&userId={$idUser}");
    }

    public function deletePost($idPost, $idPostAuthor){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->postManagment = new ModelPostManagment;
        $this->postManagment->deletePost($idPost);
        
        $this->notification = new Notification;
        $this->notification->sendNotification($idPostAuthor, 9, date('Y-m-d'));

        $user = $_SESSION['user'];
        if($user->getId() == $idPostAuthor){  // If the user deletes one of his post. We retrieve his recent notification.

            $this->notification->getUserNotifications($idPostAuthor);
            $this->notification->getUnreadUserNotificationsNumber($idPostAuthor);
        }
        
        header("location: {$startingUrl}/index.php?action=adminSpace");
    }

    public function setPostAsSensible($idPost, $idPostAuthor){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->postManagment = new ModelPostManagment;
        $this->postManagment->setPostAsSensible($idPost);
        
        $this->notification = new Notification;
        $this->notification->sendNotification($idPostAuthor, 8, date('Y-m-d'));

        $user = $_SESSION['user'];
        if($user->getId() == $idPostAuthor){  // If the user sets one of his post. We retrieve his recent notification.

            $this->notification->getUserNotifications($idPostAuthor);
            $this->notification->getUnreadUserNotificationsNumber($idPostAuthor);
        }
        
        header("location: {$startingUrl}/index.php?action=adminSpace");
    }

    public function getUserPosts(int $idUser){

        $this->postManagment = new ModelPostManagment;
        $this->postManagment->getPostsByUser($idUser);
    }

    public function getPosts(){
        
        $this->postManagment = new ModelPostManagment;
        $this->postManagment->getRandomPosts();
    }

    public function getUserFollowingsPosts(){

        $this->postManagment = new ModelPostManagment;
        $this->postManagment->getFollowingsPosts();
    }
}