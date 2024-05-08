<?php


namespace TSN\src\controllers\comment;

require_once("./src/models/comment.php");
use TSN\src\models\comment\CommentManagment as ModelCommentManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

require_once("src/controllers/notification/notification.php");
use TSN\src\controllers\notification\Notification as Notification;


class Comment {

    private ModelCommentManagment $commentManagment;
    private ModelConfig $config;
    private Notification $notification;

    public function addComment($idPost, $idUser, $content, $date, $idPostAuthor){  // To add a comment on a post.

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->commentManagment = new ModelCommentManagment;
        $this->commentManagment->addCommentOnPost($idPost, $idUser, $content, $date);

        $this->notification = new Notification;
        $this->notification->sendNotification($idPostAuthor, 7, date('Y-m-d'));

        $user = $_SESSION['user'];
        if($user->getId() == $idPostAuthor){  // If the user comments one of his post. We retrieve his recent notification.

            $this->notification->getUserNotifications($idPostAuthor);
            $this->notification->getUnreadUserNotificationsNumber($idPostAuthor);
        }

        header("location: {$startingUrl}/index.php?action=home");
    }

    public function addCommentWithImage($idPost, $idUser, $content, $date, $image, $idPostAuthor){   // To add a comment with an image on a post.

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->commentManagment = new ModelCommentManagment;
        $this->commentManagment->addCommentOnPostWithImage($idPost, $idUser, $content, $date, $image);

        $this->notification = new Notification;
        $this->notification->sendNotification($idPostAuthor, 7, date('Y-m-d'));

        $user = $_SESSION['user'];
        if($user->getId() == $idPostAuthor){  // If the user likes ono of his post. We retrieve his recent notification.

            $this->notification->getUserNotifications($idPostAuthor);
            $this->notification->getUnreadUserNotificationsNumber($idPostAuthor);
        }

        header("location: {$startingUrl}/index.php?action=home");
    }

    public function getPostComments($idPost){  // To get all the comments of a post.

        $postComments = [];

        $this->commentManagment = new ModelCommentManagment;
        $postComments = $this->commentManagment->getCommentsByPost($idPost);

        return $postComments;
    }
}