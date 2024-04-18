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

    public function executeSignup($email, $password, $name, $surname, $birthday, $address, $admin, $statutBannissement){

        $this->signup = new ModelSignup();
        $wasAlreadyUser = $this->signup->addUser($email, $password, $name, $surname, $birthday, $address, $admin, $statutBannissement);

        if($wasAlreadyUser === 0){

            (new Login)->executeLogin($email, $password);
        }
        
        else{
            
            header("location: http://localhost:4000/index.php?action=signupError");
        }
    }
}