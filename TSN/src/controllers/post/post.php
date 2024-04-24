<?php


namespace TSN\src\controllers\post;

require_once("./src/models/post.php");
use TSN\src\models\post\PostManagment as ModelPostManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

class Post {

    private ModelPostManagment $postManagment;
    private ModelConfig $config;

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

    public function getUserPosts(int $idUser){

        $this->postManagment = new ModelPostManagment;
        $this->postManagment->getPostsByUser($idUser);
    }

    public function getPosts(){
        
        $this->postManagment = new ModelPostManagment;
        $this->postManagment->getRandomPosts();
    }
}