<?php


namespace TSN\src\models\login;

use TSN\src\models\lib\DatabaseConnection;
use TSN\src\models\user\User;

class Login {

    private User $user;
    private DatabaseConnection $databaseConnection;

    public function connectUser($email, $password){
        
        $this->databaseConnection = new DatabaseConnection;

        $statement_1 = "SELECT COUNT(email) AS email from utilisateurs WHERE email = '{$email}';";
        $statement_2 = "SELECT mdp AS password from utilisateurs WHERE email = '{$email}';";

        $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);
        $query_2 = $this->databaseConnection->getConnection()->prepare($statement_2);

        $query_1->execute();
        $query_2->execute();

        $result_1 = $query_1->fetch();
        $result_2 = $query_2->fetch();

        $query_1->closeCursor();
        $query_2->closeCursor();

        if($result_1['email'] === 1 and password_verify($password, $result_2['mdp'])){

            header("location: http://localhost:4000/index.php?action=home");
        }

        else{

        }
    }
}