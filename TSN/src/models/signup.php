<?php


namespace TSN\src\models\signup;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User;


class Signup {

    private DatabaseConnection $databaseConnection;

    public function addUser($email, $password, $name, $surname, $birthday, $address, $admin, $photo){

    }
}