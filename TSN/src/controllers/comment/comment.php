<?php


namespace TSN\src\controllers\comment;

require_once("./src/models/comment.php");
use TSN\src\models\comment\CommentManagment as ModelCommentManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;


class Comment {

    private ModelCommentManagment $commentManagment;
    private ModelConfig $config;

    public function getPostComments($idPost){  // To get all the comments of a post.

        $postComments = [];

        $this->commentManagment = new ModelCommentManagment;
        $postComments = $this->commentManagment->getCommentsByPost($idPost);

        return $postComments;
    }
}