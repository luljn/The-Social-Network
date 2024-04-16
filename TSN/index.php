<?php

require_once("src/controllers/home/home.php");
use TSN\src\controllers\home\Home as Home;

require_once("src/controllers/error404/error404.php");
use TSN\src\controllers\error404\Error as Error;

require_once("src/controllers/login/login.php");
use TSN\src\controllers\login\Login as Login;

require_once("src/controllers/signup/signup.php");
use TSN\src\controllers\signup\Signup as Signup;

require_once("src/controllers/account/account.php");
use TSN\src\controllers\account\Account as Account;

require_once("src/controllers/profile/profile.php");
use TSN\src\controllers\profile\Profile as Profile;

require_once("src/controllers/post/post.php");
use TSN\src\controllers\post\Post as Post;

try {

    session_start(); // We start a new session for the user.
                    // We use a session variables to set the connection status of the user.
    
    if(isset($_GET['action']) && $_GET['action'] !== ''){

        if($_GET['action'] === 'signup'){

            $_SESSION['signupFailed'] = false;
            (new Signup)->getSignUpPage();         // We return the Sign up page.
        }

        elseif($_GET['action'] === 'signout'){

            (new Login)->disconnectUser();         // We disconnect the current user and return the Login page.
        }
        
        elseif($_GET['action'] === 'createNewAccount'){

            if(isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) 
               && isset($_POST['birthday']) && isset($_POST['address'])){


                (new Signup)->executeSignup($_POST['email'], $_POST['mdp'], $_POST['nom'], 
                                            $_POST['prenom'], $_POST['birthday'], $_POST['address'], 0);
            }
        }

        elseif($_GET['action'] === 'signupError'){  // If an error occured during the inscription(the email already exists).

            $_SESSION['signupFailed'] = true;
            (new Signup)->getSignUpPage();       // We return the Sign up page.
        }

        elseif($_GET['action'] === 'login'){

            if(isset($_POST['email']) && isset($_POST['mdp'])){

                (new Login)->executeLogin($_POST['email'], $_POST['mdp']);   // We try to connect the user to the site.
            }
        }

        elseif($_GET['action'] === 'loginError'){ // If an error occured during the login(bad credentials).

            $_SESSION['loginFailed'] = true;
            (new Login)->getLoginPage();          // We return de Login page.
        }

        elseif($_GET['action'] === 'loginRequired'){ // If the login is required to have an access to a page.

            throw new Exception("Oups, vous devez être connecté pour avoir accès à cette page.");
        }

        elseif($_GET['action'] === 'home'){
            
            (new Home)->getHomePage();  // We return the Home Page.
        }

        elseif($_GET['action'] === 'myAccount'){
            
            if(isset($_GET['userId']) && $_GET['userId'] > 0){

                (new Account)->getUserAccount($_GET['userId']);  // We return the User account page.
                // (new Post)->getUserPosts($_GET['userId']);  // We retrieve the post of the user.
            }

            else{

                throw new Exception("Oups, l'utilisateur que vous cherchez n'existe pas.");
            }
        }

        elseif($_GET['action'] === 'accountNotFound'){  // If the user account does not exists.
            
            throw new Exception("Oups, l'utilisateur que vous cherchez n'existe pas.");
        }

        elseif($_GET['action'] === 'myProfile'){
            
            (new Profile)->getUserProfile();  // We return the User profile page.
        }

        else{

            throw new Exception("Oups, la page que vous cherchez n'existe pas.");
        }
    }
    
    else{

        $_SESSION['isConnected'] = false;
        $_SESSION['loginFailed'] = false;
        $_SESSION['signupFailed'] = false;
        (new Login)->getLoginPage();   // We return de Login page.
                                       // The default page of the site.
    }
}

catch(Exception $e) {

    $errorMessage = $e->getMessage();
    (new Error)->getError404Page($errorMessage);    
}