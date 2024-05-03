<?php

namespace TSN\src\controllers\like;

require_once("./src/models/like.php");
use TSN\src\models\like\Like as ModelLike;

class Like {

    private ModelLike $like;

    public function addLike($idPost, $idUser, $date){

        $this->like = new ModelLike;
        $this->like->addLikeOnPost($idPost, $idUser, $date);
    }

    public function removeLike($idPost, $idUser){

        $this->like = new ModelLike;
        $this->like->removeLikeOnPost($idPost, $idUser);
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