<?php


namespace TSN\src\controllers\login;


class Login {

    public function getLoginPage(){

        require("./src/views/login.php");
    }
}