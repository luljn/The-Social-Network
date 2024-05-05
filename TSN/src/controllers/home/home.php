<?php


namespace TSN\src\controllers\home;

require_once("src/controllers/post/post.php");
use TSN\src\controllers\post\Post as Post;

require_once("src/controllers/follow/follow.php");
use TSN\src\controllers\follow\Follow as Follow;

require_once("src/controllers/like/like.php");
use TSN\src\controllers\like\Like as Like;


class Home {

    public function getHomePage(){

        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == True){  // If the user is connected.

            $user = $_SESSION['user'];
            $userFollowings = $_SESSION['userFollowings'];
            (new Follow)->getPeopleToFollowForTheUser($user->getID());
            if(!empty($userFollowings)){ (new Post)->getUserFollowingsPosts(); }
            (new Like)->getLikedPosts($user->getID());  // We retrieve all the posts liked by the user.
        }
        
        (new Post)->getPosts();
        require('./src/views/home.php');
    }
}