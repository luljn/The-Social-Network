<?php


namespace TSN\src\controllers\signup;

require_once("./src/models/signup.php");
use TSN\src\models\signup\Signup as ModelSignup;

require_once("src/controllers/login/login.php");
use TSN\src\controllers\login\Login as Login;


class Signup {

    private ModelSignup $signup;

    public function getSignUpPage(){

        require("./src/views/signup.php");
    }

    public function executeSignup($email, $password, $name, $surname, $birthday, $address, $admin){

        $this->signup = new ModelSignup();
        $this->signup->addUser($email, $password, $name, $surname, $birthday, $address, $admin);

        (new Login)->executeLogin($email, $password);
    }
}