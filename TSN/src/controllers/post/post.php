<?php


namespace TSN\src\controllers\post;

require_once("./src/models/post.php");
use TSN\src\models\post\PostManagment as ModelPostManagment;


class Post {

    private ModelPostManagment $postManagment;

    public function getPost(int $id){

    }

    public function getUserPosts(int $idUser){

        $this->postManagment = new ModelPostManagment();
        $this->postManagment->getPostsByUser($idUser);
    }

    public function getPosts(){
        
        $this->postManagment = new ModelPostManagment();
        $this->postManagment->getRandomPosts();
    }
}