<?php


namespace TSN\src\models\search;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User as User;


class Search {

    private DatabaseConnection $databaseConnection;  
    
    public function makeSearch($research){

        $this->databaseConnection = new DatabaseConnection;

        $findingWord = str_replace(' ', '%', $research);

        $statement = "SELECT * FROM utilisateur WHERE nom LIKE \"%{$findingWord}%\" or prenom LIKE \"%{$findingWord}%\";";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $statement_1 = "SELECT * FROM post WHERE contenu LIKE '%\"{$findingWord}\"%';";
        $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);
        $query_1->execute();
        $result_1 = $query_1->fetchAll();
        $query_1->closeCursor();

        // The lists of results, by users and by posts.
        $ResultUsers = [];
        $ResultPosts = [];

        if($result != NULL){

            for($i = 0; $i < count($result); $i++){

                if($result[$i]['profile_photo'] == NULL){

                    $user = new User($result[$i]['id'], $result[$i]['email'], $result[$i]['mdp'], $result[$i]['nom'], $result[$i]['prenom'],
                                     date('d-m-Y', strtotime($result[$i]['date_de_naissance'])), $result[$i]['adresse'], $result[$i]['admin'], '', $result[$i]['description']);
                }

                else{

                    $user = new User($result[$i]['id'], $result[$i]['email'], $result[$i]['mdp'], $result[$i]['nom'], $result[$i]['prenom'],
                                     date('d-m-Y', strtotime($result[$i]['date_de_naissance'])), $result[$i]['adresse'], $result[$i]['admin'], $result[$i]['profile_photo'], $result[$i]['description']);
                }

                if(!in_array($user, $ResultUsers)){

                    $ResultUsers[] = $user;   // We add the user to the list.
                }
            }
        }

        else{

            $ResultUsers = $result;
        }

        $_SESSION['resultUsers'] = $ResultUsers;

        if($result_1 != NULL){

            for($i = 0; $i < count($result_1); $i++){

            }
        }
    }
}