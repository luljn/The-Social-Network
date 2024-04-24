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

    public function followAnotherUser($idFollower, $idFollowing, $dateCreation){ // To make a follower between 2 users, the first one (the follower) and another one (the following).

        $this->databaseConnection = new DatabaseConnection;
        $statement = "INSERT INTO follow (id_follower, id_following, date_creation)
                      VALUES 
                      (\"{$idFollower}\", \"{$idFollowing}\", \"{$dateCreation}\");";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();
    }

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

    public function getPeopleToFollow($idUser){  // To get people that the user could follow.

        $Users = [];       // The list of all the persons that the user could follow.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * from follow WHERE id_follower <> \"{$idUser}\" AND id_following <> \"{$idUser}\";";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        for ($i = 0; $i < count($result); $i++){

            $idUserNotFollowed = $result[$i]['id_following'];
            $statement_1 = "SELECT * from utilisateur WHERE id = \"{$idUserNotFollowed}\";";
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

                $Users[] = $user;   // We add the user who is not followed to the list.
            }
        }

        // This query is to retrieve all the users who don't have any follower.
        $statement_2 = "SELECT * 
                        FROM utilisateur 
                        LEFT JOIN follow ON utilisateur.id = follow.id_following 
                        WHERE utilisateur.id <> follow.id_following OR follow.id_following IS NULL;";
        $query_2 = $this->databaseConnection->getConnection()->prepare($statement_2);
        $query_2->execute();
        $result_2 = $query_2->fetchAll();
        $query_2->closeCursor();

        for ($i = 0; $i < count($result_2); $i++){

            $userName = $result_2[$i]['nom'];
            $statement_3 = "SELECT id FROM utilisateur WHERE nom = \"{$userName}\";";
            $query_3 = $this->databaseConnection->getConnection()->prepare($statement_3);
            $query_3->execute();
            $result_3 = $query_3->fetch();
            $query_3->closeCursor();

            if($result_2[$i]['profile_photo'] == NULL){

                $user = new User($result_3['id'], $result_2[$i]['email'], $result_2[$i]['mdp'], $result_2[$i]['nom'], $result_2[$i]['prenom'],
                                date("d-m-Y", strtotime($result_2[$i]['date_de_naissance'])), $result_2[$i]['adresse'], $result_2[$i]['admin'], '', $result_2[$i]['description']);
            }
    
            else{
    
                $user = new User($result_3['id'], $result_2[$i]['email'], $result_2[$i]['mdp'], $result_2[$i]['nom'], $result_2[$i]['prenom'],
                                date("d-m-Y", strtotime($result_2[$i]['date_de_naissance'])), $result_2[$i]['adresse'], $result_2[$i]['admin'], $result_2[$i]['profile_photo'], $result_2[$i]['description']);
            }

            if(!in_array($user, $Users) && $user->getID() != $idUser){

                $Users[] = $user;   // We add the user who is not followed to the list.
            }
        }

        $follows = $_SESSION['userFollowings'];

        foreach($follows as $follow){  // To sort and to delete the users who are already in the list of the followings

            foreach($Users as $user){

                if($follow->getUser()->getID() == $user->getID()){

                    $indice = array_search($user, $Users);
                    unset($Users[$indice]);
                }
            }
        }

        $_SESSION['usersNotFollowed'] = $Users;
    }

    public function getFollowersOfUser($idUser){   // To retrieve all the persons who followed the user.

        $this->databaseConnection = new DatabaseConnection;
    }
}