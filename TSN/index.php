<?php

require_once("src/controllers/home/home.php");
use TSN\src\controllers\home\Home as Home;

require_once("src/controllers/error404/error404.php");
 use TSN\src\controllers\error404\Error as Error;


try {
    
    (new Home)->getHomePage();
}

catch(Exception $e) {

    // (new Error)->getError404Page();    
}