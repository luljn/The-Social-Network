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

    session_start(); // We start a new session for the user.
                    // We use a session variables to set the connection status of the user.
    
    if(isset($_GET['action']) && $_GET['action'] !== ''){

        if($_GET['action'] === 'signup'){

            (new Signup)->getSignUpPage();         // We return the Sign up page.
        }

        elseif($_GET['action'] === 'signout'){

            (new Login)->disconnectUser();         // We disconnect the current user and return the Login page.
        }

        elseif($_GET['action'] === 'login'){

            if(isset($_POST['email']) && isset($_POST['mdp'])){

                (new Login)->executeLogin($_POST['email'], $_POST['mdp']);   // We try to connect the user to the site.
            }
        }

        elseif($_GET['action'] === 'loginError'){ // If an error occured during the login(bad credentials).

            $_SESSION['loginFailed'] = true;
            (new Login)->getLoginPage();
        }

        elseif($_GET['action'] === 'home'){
            
            (new Home)->getHomePage();
        }

        else{

            throw new Exception("Oups, la page que vous cherchez n'existe pas.");
        }
    }
    
    else{

        $_SESSION['isConnected'] = false;
        $_SESSION['loginFailed'] = false;
        (new Login)->getLoginPage();   // We return de Login page.
                                       // The default page of the site.
    }
}

catch(Exception $e) {

    $errorMessage = $e->getMessage();
    (new Error)->getError404Page($errorMessage);    
}