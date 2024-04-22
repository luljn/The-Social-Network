<?php


namespace TSN\src\controllers\post;

require_once("./src/models/post.php");
use TSN\src\models\post\PostManagment as ModelPostManagment;


class Post {

    private ModelPostManagment $postManagment;

    public function addPost($idUser, $content, $date){

        $this->postManagment = new ModelPostManagment;

        $this->postManagment->addPost($idUser, $content, $date);
        header("location: http://localhost:4000/index.php?action=myAccount&userId={$idUser}");
    }

    public function addPostWithImage($idUser, $content, $date, $image){

        $this->postManagment = new ModelPostManagment;

        $this->postManagment->addPostWithImage($idUser, $content, $date, $image);
        header("location: http://localhost:4000/index.php?action=myAccount&userId={$idUser}");
    }

    public function getUserPosts(int $idUser){

        $this->postManagment = new ModelPostManagment;
        $this->postManagment->getPostsByUser($idUser);
    }

    public function getPosts(){
        
        $this->postManagment = new ModelPostManagment;
        $this->postManagment->getRandomPosts();
    }
}