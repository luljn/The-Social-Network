<?php

namespace TSN\src\controllers\like;

require_once("./src/models/like.php");
use TSN\src\models\like\Like as ModelLike;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

class Like {

    private ModelLike $like;
    private ModelConfig $config;

    public function addLike($idPost, $idUser, $date){

        $this->like = new ModelLike;
        $this->like->addLikeOnPost($idPost, $idUser, $date);

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();
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