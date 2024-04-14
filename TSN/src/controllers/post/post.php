<?php


namespace TSN\src\controllers\post;

require_once("./src/models/post.php");
use TSN\src\models\post\Post as ModelPost;

$user = $_SESSION["user"];

class Post {

    private ModelPost $post;

    public function getPost(int $id){

    }

    public function getUserPosts(int $idUser){

    }

    public function getPosts(){
        
    }
}