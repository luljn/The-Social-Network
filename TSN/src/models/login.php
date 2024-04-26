<?php


namespace TSN\src\models\login;

require_once("config/config.php");
use TSN\src\models\config\Config;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User;


class Login {

    private DatabaseConnection $databaseConnection;
    private Config $config;

    public function connectUser($email, $password){  // To verify the informations given by the user in the login form and make the connection these are good.

        $this->config = new Config;
        $startingUrl = $this->config->getStartingUrl();
        
        $this->databaseConnection = new DatabaseConnection;

        $statement_1 = "SELECT COUNT(email) AS email from utilisateur WHERE email = \"{$email}\";";
        $statement_2 = "SELECT mdp AS password from utilisateur WHERE email = \"{$email}\";";

        $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);
        $query_2 = $this->databaseConnection->getConnection()->prepare($statement_2);

        $query_1->execute();
        $query_2->execute();

        $result_1 = $query_1->fetch();
        $result_2 = $query_2->fetch();

        $query_1->closeCursor();
        $query_2->closeCursor();

        if($result_1['email'] === 1 and password_verify($password, $result_2['password'])){

            $statement = "SELECT * from utilisateur WHERE email = \"{$email}\";";
            $query = $this->databaseConnection->getConnection()->prepare($statement);
            $query->execute();
            $result = $query->fetch();
            $query->closeCursor();

            if($result['profile_photo'] == NULL){

                $user = new User($result['id'], $result['email'], $result['mdp'], $result['nom'], $result['prenom'],
                                date("d-m-Y", strtotime($result['date_de_naissance'])), $result['adresse'], $result['admin'], '', $result['description']);
            }

            else{

                $user = new User($result['id'], $result['email'], $result['mdp'], $result['nom'], $result['prenom'],
                                date("d-m-Y", strtotime($result['date_de_naissance'])), $result['adresse'], $result['admin'], $result['profile_photo'], $result['description']);
            }

            $_SESSION["user"] = $user; 
            $_SESSION['isConnected'] = true;
            $userIdUrl = urldecode($user->getID());
            header("location: {$startingUrl}/index.php?action=myAccount&userId={$userIdUrl}");
        }

        else{
            
            header("location: {$startingUrl}/index.php?action=loginError");
        }
    }
}