<?php


namespace TSN\src\models\signup;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User;


class Signup {

    private DatabaseConnection $databaseConnection;

    public function addUser($email, $password, $name, $surname, $birthday, $address, $admin, $photo){

        $this->databaseConnection = new DatabaseConnection;

        $statement_1 = "SELECT COUNT(email) AS email from utilisateurs WHERE email = '{$email}';";

        $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);

        $query_1->execute();

        $result_1 = $query_1->fetch();

        $query_1->closeCursor();

        if($result_1['email'] === 0){

        }

        elseif($result_1['email'] === 1){

            header("location: http://localhost:4000/index.php?action=signupError");
        }
    }
}