<?php


namespace TSN\src\controllers\home;

require_once("src/controllers/post/post.php");
use TSN\src\controllers\post\Post as Post;


class Home {

    public function getHomePage(){

        (new Post)->getPosts();
        require('./src/views/home.php');
    }
}