<?php


namespace TSN\src\models\account;

use Exception;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("config/config.php");
use TSN\src\models\config\Config;

require_once("user.php");
use TSN\src\models\user\User;


class Account {

    private DatabaseConnection $databaseConnection;
    private Config $config;

    public function getUser($userId){  // To get a specific user by his Id.

        $this->config = new Config;
        $startingUrl = $this->config->getStartingUrl();

        $this->databaseConnection = new DatabaseConnection;

        try {

            $statement = "SELECT * from utilisateur WHERE id = \"{$userId}\";";
            $query = $this->databaseConnection->getConnection()->prepare($statement);
            $query->execute();
            $result = $query->fetch();
            $query->closeCursor();

            if($result == NULL){  // If the user id doesn't exists in the database.

                throw new Exception("Oups, l'utilisateur que vous cherchez n'existe pas.");
            }

            if($result['profile_photo'] == NULL){
            
                $user = new User($result['id'], $result['email'], $result['mdp'], $result['nom'], $result['prenom'],
                                 date("d-m-Y", strtotime($result['date_de_naissance'])), $result['adresse'], $result['admin'], '', $result['description']);
            }

            else{

                $user = new User($result['id'], $result['email'], $result['mdp'], $result['nom'], $result['prenom'],
                                 date("d-m-Y", strtotime($result['date_de_naissance'])), $result['adresse'], $result['admin'], $result['profile_photo'], $result['description']);
            }

            return $user;
        }

        catch(Exception $e) {

            $e->getMessage();
            header("location: {$startingUrl}/index.php?action=accountNotFound");
        }
    }
}