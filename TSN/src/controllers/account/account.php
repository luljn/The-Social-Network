<?php


namespace TSN\src\controllers\account;

require_once("./src/models/account.php");
use TSN\src\models\account\Account as ModelAccount;


class Account {

    private ModelAccount $account;

    public function getUserAccount($userId){

        $this->account = new ModelAccount;
        $user = $this->account->getUser($userId);
        $_SESSION['otherUser'] = $user;
        require('./src/views/account.php');
    }
}