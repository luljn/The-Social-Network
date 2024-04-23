<?php 


namespace TSN\src\models\follow;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User as User;

class Follow {

    private int $id;
    private User $userFollowed;   // The user who is followed.

    public function __construct($_id, $_userFollowed){
        
        $this->id = $_id;
        $this->userFollowed = $_userFollowed;
    }

    public function getID(){ return $this->id; }
    public function getUser(){ return $this->userFollowed; }
}

class FollowManagment {

    private DatabaseConnection $databaseConnection;

    public function getFollowingsOfUser($idUser){    // To retrieve all the persons that the user follows.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * from follow WHERE id_follower = \"{$idUser}\";";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $Followings = [];  // The list of all the followings of the user.
        $Users = [];       // The list of all the persons that the user follows.

        for ($i = 0; $i < count($result); $i++){

            $idUserFollowed = $result[$i]['id_following'];
            $statement_1 = "SELECT * from utilisateur WHERE id = \"{$idUserFollowed}\";";
            $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);
            $query_1->execute();
            $result_1 = $query_1->fetch();
            $query_1->closeCursor();

            if($result_1['profile_photo'] == NULL){

                $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                                date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], '', $result_1['description']);
            }
    
            else{
    
                $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                                date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], $result_1['profile_photo'], $result_1['description']);
            }

            if(!in_array($user, $Users)){

                $Users[] = $user;   // We add the user to the list.
            }
        }

        for ($i = 0; $i < count($result); $i++){     

            foreach($Users as $followedUser){

                if($result[$i]['id_following'] === $followedUser->getID()){

                    $follow = new Follow($result[$i]['id'], $followedUser);
                }

                if(!in_array($follow, $Followings)){

                    $Followings[] = $follow;   
                }
            }
        }

        $_SESSION['userFollowings'] = $Followings;
    }

    public function getFollowersOfUser($idUser){   // To retrieve all the persons who followed the user.

        $this->databaseConnection = new DatabaseConnection;
    }
}