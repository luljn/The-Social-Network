<?php

require_once("src/controllers/home/home.php");
use TSN\src\controllers\home\Home as Home;

require_once("src/controllers/error404/error404.php");
 use TSN\src\controllers\error404\Error as Error;

 require_once("src/controllers/login/login.php");
 use TSN\src\controllers\login\Login as Login;


try {
    
    // (new Home)->getHomePage();
    (new Login)->getLoginPage();  // The default page of the site.
}

catch(Exception $e) {

    // (new Error)->getError404Page();    
}