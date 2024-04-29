<?php


namespace TSN\src\controllers\comment;

require_once("./src/models/comment.php");
use TSN\src\models\comment\CommentManagment as ModelCommentManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;


class Comment {

    private ModelCommentManagment $commentManagment;
    private ModelConfig $config;

    public function addComment($idPost, $idUser, $content, $date){  // To add a comment on a post.

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->commentManagment = new ModelCommentManagment;
        $this->commentManagment->addCommentOnPost($idPost, $idUser, $content, $date);

        header("location: {$startingUrl}/index.php?action=home");
    }

    public function addCommentWithImage($idPost, $idUser, $content, $date, $image){   // To add a comment with an image on a post.

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->commentManagment = new ModelCommentManagment;
        $this->commentManagment->addCommentOnPostWithImage($idPost, $idUser, $content, $date, $image);

        header("location: {$startingUrl}/index.php?action=home");
    }

    public function getPostComments($idPost){  // To get all the comments of a post.

        $postComments = [];

        $this->commentManagment = new ModelCommentManagment;
        $postComments = $this->commentManagment->getCommentsByPost($idPost);

        return $postComments;
    }
}