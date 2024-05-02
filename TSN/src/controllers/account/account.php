<?php


namespace TSN\src\controllers\account;

require_once("./src/models/account.php");
use TSN\src\models\account\Account as ModelAccount;

require_once("src/controllers/post/post.php");
use TSN\src\controllers\post\Post as Post;

require_once("src/controllers/follow/follow.php");
use TSN\src\controllers\follow\Follow as Follow;


class Account {

    private ModelAccount $account;

    public function getUserAccount($userId){

        $this->account = new ModelAccount;
        $user = $this->account->getUser($userId);
        (new Post)->getUserPosts($userId);  // We retrieve all the posts associated to the user account.
        (new Follow)->getUserFollowings($userId);   // We retrieve all the followings of the user.
        (new Follow)->getUserFollowers($userId);   // We retrieve all the followers of the user.
        $_SESSION['otherUser'] = $user;    // We define a new user, to make a difference with the current connected user.
        require('./src/views/account.php');
    }
}