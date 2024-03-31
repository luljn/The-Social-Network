<?php

require_once("src/controllers/home/home.php");
use TSN\src\controllers\home\Home as Home;

require_once("src/controllers/error404/error404.php");
 use TSN\src\controllers\error404\Error as Error;

 require_once("src/controllers/login/login.php");
 use TSN\src\controllers\login\Login as Login;

 require_once("src/controllers/signup/signup.php");
 use TSN\src\controllers\signup\Signup as Signup;


try {
    
    if(isset($_GET['action']) && $_GET['action'] !== ''){

        if($_GET['action'] === 'signup'){

            (new Signup)->getSignUpPage();
        }

        elseif($_GET['action'] === 'home'){

            (new Home)->getHomePage();
        }

        else{

            throw new Exception("Oups, la page que vous cherchez n'existe pas.");
        }
    }
    
    else{

        (new Login)->getLoginPage();  // The default page of the site.
    }
}

catch(Exception $e) {

    $errorMessage = $e->getMessage();
    (new Error)->getError404Page($errorMessage);    
}