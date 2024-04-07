<?php


namespace TSN\src\models\account;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User;


class Account {

    private DatabaseConnection $databaseConnection;

    public function getUser($userId){  // To get a specific user by his Id.

        $this->databaseConnection = new DatabaseConnection;

        $statement = "SELECT * from utilisateurs WHERE id = '{$userId}';";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        $user = new User($result['id'], $result['email'], $result['mdp'], $result['nom'], $result['prenom'],
        date("d-m-Y", strtotime($result['date_de_naissance'])), $result['adresse'], $result['admin'], '');

        return $user;
    }
}