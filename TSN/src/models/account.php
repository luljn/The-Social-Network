<?php


namespace TSN\src\models\account;

use Exception;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User;


class Account {

    private DatabaseConnection $databaseConnection;

    public function getUser($userId){  // To get a specific user by his Id.

        $this->databaseConnection = new DatabaseConnection;

        try {

            $statement = "SELECT * from utilisateurs WHERE id = '{$userId}';";
            $query = $this->databaseConnection->getConnection()->prepare($statement);
            $query->execute();
            $result = $query->fetch();
            $query->closeCursor();

            if($result == NULL){  // If the user id doesn't exists in the database.

                throw new Exception("Oups, l'utilisateur que vous cherchez n'existe pas.");
            }

            $user = new User($result['id'], $result['email'], $result['mdp'], $result['nom'], $result['prenom'],
            date("d-m-Y", strtotime($result['date_de_naissance'])), $result['adresse'], $result['admin'], '');

            return $user;
        }

        catch(Exception $e) {

            $e->getMessage();
            header("location: http://localhost:4000/index.php?action=accountNotFound");
        }
    }
}