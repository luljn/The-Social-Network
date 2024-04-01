<?php


namespace TSN\src\controllers\login;

require_once("./src/models/login.php");
use TSN\src\models\login\Login as ModelLogin;

class Login {

    private ModelLogin $login;

    public function getLoginPage(){

        require("./src/views/login.php");
    }

    public function executeLogin($email, $password){

        $this->login = new ModelLogin;
        $this->login->connectUser($email, $password);
    }
}