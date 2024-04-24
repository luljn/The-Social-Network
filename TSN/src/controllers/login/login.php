<?php


namespace TSN\src\controllers\login;

require_once("./src/models/login.php");
use TSN\src\models\login\Login as ModelLogin;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

class Login {

    private ModelLogin $login;
    private ModelConfig $config;

    public function getLoginPage(){

        require("./src/views/login.php");
    }

    public function executeLogin($email, $password){

        $this->login = new ModelLogin;
        $this->login->connectUser($email, $password);
    }

    public function disconnectUser(){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        session_unset();
        session_destroy();
        header("location: {$startingUrl}/index.php");
    }
}