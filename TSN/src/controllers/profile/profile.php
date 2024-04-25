<?php


namespace TSN\src\controllers\profile;

require_once("src/controllers/follow/follow.php");
use TSN\src\controllers\follow\Follow as Follow;


class Profile {

    public function getUserProfile(){
        
        $isConnected = $_SESSION['isConnected'];

        if(isset($isConnected) && $isConnected){  // If the user is connected.

            $user = $_SESSION['user'];
            (new Follow)->getUserFollowings($user->getID());
        }

        require('./src/views/profile.php');
    }
}