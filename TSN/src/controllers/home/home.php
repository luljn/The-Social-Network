<?php


namespace TSN\src\controllers\home;

require_once("src/controllers/post/post.php");
use TSN\src\controllers\post\Post as Post;

require_once("src/controllers/follow/follow.php");
use TSN\src\controllers\follow\Follow as Follow;


class Home {

    public function getHomePage(){

        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == True){  // If the user is connected.

            $user = $_SESSION['user'];
            (new Follow)->getPeopleToFollowForTheUser($user->getID());
            // (new Post)->getUserFollowingsPosts();
        }
        
        (new Post)->getPosts();
        require('./src/views/home.php');
    }
}