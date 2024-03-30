<?php

require_once("src/controllers/home/home.php");
use TSN\src\controllers\home\Home as Home;

(new Home)->getHomePage();