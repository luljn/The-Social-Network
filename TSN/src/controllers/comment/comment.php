<?php


namespace TSN\src\controllers\comment;

require_once("./src/models/comment.php");
use TSN\src\models\comment\CommentManagment as ModelCommentManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;


class Comment {

    private ModelCommentManagment $commentManagment;
    private ModelConfig $config;

    public function getPostComments($idPost){

        $this->commentManagment = new ModelCommentManagment;
        $this->commentManagment->getCommentsByPost($idPost);
    }
}