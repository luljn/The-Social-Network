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

require_once("src/controllers/user/user.php");
use TSN\src\controllers\user\User as User;

require_once("src/controllers/post/post.php");
use TSN\src\controllers\post\Post as Post;

require_once("src/controllers/follow/follow.php");
use TSN\src\controllers\follow\Follow as Follow;

require_once("src/controllers/comment/comment.php");
use TSN\src\controllers\comment\Comment as Comment;

require_once("src/controllers/notification/notification.php");
use TSN\src\controllers\notification\Notification as Notification;

require_once("src/controllers/like/like.php");
use TSN\src\controllers\like\Like as Like;

require_once("src/controllers/stat/stat.php");
use TSN\src\controllers\stat\Stat as Stat;

require_once("src/controllers/search/search.php");
use TSN\src\controllers\search\Search as Search;

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
                                            $_POST['prenom'], $_POST['birthday'], $_POST['address'], 0, 0);
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
            }

            else{

                throw new Exception("Oups, l'utilisateur que vous cherchez n'existe pas.");
            }
        }

        elseif($_GET['action'] === 'accountNotFound'){  // If the user account does not exists.
            
            throw new Exception("Oups, l'utilisateur que vous cherchez n'existe pas.");
        }

        elseif($_GET['action'] === 'addPost'){            // If the user wants to add a post.

            $user = $_SESSION['user'];
            $idUser = $user->getID();
            
            if(isset($_FILES['image']) && isset($_POST['newPost'])){    // To add a post with an image.

                $file = $_FILES['image'];
                $tempName = $file["tmp_name"];
                $fileName = basename($file['name']);            // We get the file name.
                $uploadDir = "img/posts/";                // The images directory.

                
                move_uploaded_file($tempName, $uploadDir . $fileName);
                (new Post)->addPostWithImage($idUser, $_POST['newPost'], date('Y-m-d'), $fileName);
            }

            elseif(isset($_POST['newPost']) && (!isset($_FILES['image']))){       // To add a post without an image.

                (new Post)->addPost($idUser, $_POST['newPost'], date('Y-m-d'));
            }
        }

        elseif($_GET['action'] === 'addComment'){            // If the user wants to add a comment on a post.

            $user = $_SESSION['user'];
            $idUser = $user->getID();
            
            if(isset($_FILES['imageComment']) && isset($_POST['newComment'])){    // To add a comment with an image.

                $file = $_FILES['imageComment'];
                $tempName = $file["tmp_name"];
                $fileName = basename($file['name']);            // We get the file name.
                $uploadDir = "img/posts/";                // The images directory.

                
                move_uploaded_file($tempName, $uploadDir . $fileName);
                (new Comment)->addCommentWithImage($_POST['idPost'], $idUser, $_POST['newComment'], date('Y-m-d'), $fileName);
            }

            elseif(isset($_POST['newComment']) && (!isset($_FILES['imageComment']))){       // To add a comment without an image.

                (new Comment)->addComment($_POST['idPost'], $idUser, $_POST['newComment'], date('Y-m-d'));
            }
        }

        elseif($_GET['action'] === 'addLike'){   // To add a like on a post.

            $user = $_SESSION['user'];
            $idUser = $user->getID();

            if(isset($_POST['idPost'])){

                (new Like)->addLike($_POST['idPost'], $idUser, date('Y-m-d'));
            }
        }

        elseif($_GET['action'] === 'removeLike'){  // To remove the like given on a post.

            $user = $_SESSION['user'];
            $idUser = $user->getID();

            if(isset($_POST['idPost'])){
                
                (new Like)->removeLike($_POST['idPost'], $idUser);
            }
        }

        elseif($_GET['action'] === 'myProfile'){
            
            (new Profile)->getUserProfile();  // We return the User profile page.
        }

        elseif($_GET['action'] === 'updatePersonnalInformations'){    // To update the personnal informations of the user.
            
            if(isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) 
               && isset($_POST['address'])){
            
                (new User)->updateUserInformations($_POST['email'], $_POST['nom'], $_POST['prenom'], $_POST['address']);     
            }
        }

        elseif($_GET['action'] === 'updateBirthday'){    // To update the birthday of the user.
            
            if(isset($_POST['birthday'])){
            
                (new User)->updateUserBirthday($_POST['birthday']);     
            }
        }

        elseif($_GET['action'] === 'updatePassword'){    // To update the password of the user.
            
            if(isset($_POST['nouveauMdp1'])){
            
                (new User)->updateUserPassword($_POST['mdp'], $_POST['nouveauMdp1']);     
            }
        }

        elseif($_GET['action'] === 'updateProfilePhoto'){    // To update the profile photo of the user.
            
            if(isset($_FILES['profilePhoto'])){

                $file = $_FILES['profilePhoto'];
                $tempName = $file["tmp_name"];
                $fileName = basename($file['name']);            // We get the file name.
                $uploadDir = "img/users/";                // The images directory.

                move_uploaded_file($tempName, $uploadDir . $fileName);
            
                (new User)->updateUserProfilePhoto($fileName);     
            }
        }

        elseif($_GET['action'] === 'updateDescription'){    // To update the birthday of the user.
            
            if(isset($_POST['description'])){
            
                (new User)->updateUserDescription($_POST['description']);     
            }
        }

        elseif($_GET['action'] === 'newFollow'){    // To make a new follow between two users.
            
            if(isset($_POST['idUserToFollow'])){
            
                $user = $_SESSION["user"];
                (new Follow)->newFollow($user->getID(), $_POST['idUserToFollow'], date("Y-m-d"));
            }
        }

        elseif($_GET['action'] === 'unFollow'){    // To delete a follow between two users.
            
            if(isset($_POST['idUserFollowed'])){
            
                $user = $_SESSION["user"];
                (new Follow)->unFollow($user->getID(), $_POST['idUserFollowed']);
            }
        }

        elseif($_GET['action'] === 'notification'){

            (new Notification)->getNotificationsPage();         // We return the notifications page.
        }

        elseif($_GET['action'] === 'statistics'){

            (new Stat)->getStatisticsPage();         // We return the statistics page.
        }

        elseif($_GET['action'] === 'search'){

            (new Search)->getSearchPage();         // We return the search page.
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