<?php


namespace TSN\src\controllers\signup;

require_once("./src/models/signup.php");
use TSN\src\models\signup\Signup as ModelSignup;


class Signup {

    private ModelSignup $signup;

    public function getSignUpPage(){

        require("./src/views/signup.php");
    }

    public function executeSignup($email, $password, $name, $surname, $birthday, $address, $admin, $photo){

        $this->signup = new ModelSignup();
        $this->signup->addUser($email, $password, $name, $surname, $birthday, $address, $admin, $photo);
    }
}