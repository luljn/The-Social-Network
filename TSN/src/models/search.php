<?php


namespace TSN\src\models\search;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User as User;

require_once("post.php");
use TSN\src\models\post\Post as Post;

require_once("./src/controllers/comment/comment.php");
use TSN\src\controllers\comment\Comment as CommentController;


class Search {

    private DatabaseConnection $databaseConnection;  
    private CommentController $commentController;
    
    public function makeSearch($research){

        $this->databaseConnection = new DatabaseConnection;
        $this->commentController = new CommentController;

        $findingWord1 = str_replace(' ', '%', $research);
        $findingWord2 = str_replace('\'', '', $findingWord1);
        $findingWord = str_replace('"', '', $findingWord2);

        $statement = "SELECT * FROM utilisateur WHERE nom LIKE \"%{$findingWord}%\" or prenom LIKE \"%{$findingWord}%\" or description LIKE \"%{$findingWord}%\";";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $statement_1 = "SELECT * FROM post WHERE contenu LIKE \"%{$findingWord}%\";";
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

            $Users = []; // The authors of each posts.

            for($i = 0; $i < count($result_1); $i++){

                $idUser = $result_1[$i]['id_utilisateur'];
                $statement_2 = "SELECT * from utilisateur WHERE id = \"{$idUser}\";";
                $query_2 = $this->databaseConnection->getConnection()->prepare($statement_2);
                $query_2->execute();
                $result_2 = $query_2->fetch();
                $query_2->closeCursor();

                if($result_2['profile_photo'] == NULL){

                    $user = new User($result_2['id'], $result_2['email'], $result_2['mdp'], $result_2['nom'], $result_2['prenom'],
                                    date("d-m-Y", strtotime($result_2['date_de_naissance'])), $result_2['adresse'], $result_2['admin'], '', $result_2['description']);
                }
        
                else{
        
                    $user = new User($result_2['id'], $result_2['email'], $result_2['mdp'], $result_2['nom'], $result_2['prenom'],
                                    date("d-m-Y", strtotime($result_2['date_de_naissance'])), $result_2['adresse'], $result_2['admin'], $result_2['profile_photo'], $result_2['description']);
                }
    
                if(!in_array($user, $Users)){
    
                    $Users[] = $user;   // We add the user to the list.
                }
            }

            for ($i = 0; $i < count($result_1); $i++){     // To associate a post to his author.

                foreach($Users as $ramdomUser){
    
                    if($result_1[$i]['id_utilisateur'] === $ramdomUser->getID()){
    
                        // List of comments of each post.
                        $postComments = $this->commentController->getPostComments($result_1[$i]['id']);
                        //
    
                        // To retrieve the number of likes of the post.
                        $idPost = $result_1[$i]['id'];
                        $statement_3 = "CALL CountLikesOfPost({$idPost});";
                        $query_3 = $this->databaseConnection->getConnection()->prepare($statement_3);
                        $query_3->execute();
                        $result_3 = $query_3->fetch();
                        $query_3->closeCursor();
    
                        if($result_1[$i]['image'] == NULL){
    
                            $userPost = new Post($result_1[$i]['id'], $result_1[$i]['contenu'], $result_1[$i]['date_creation'], $ramdomUser, '', $postComments, $result_3['NumberOfLikes']);
                        }
        
                        else{
        
                            $userPost = new Post($result_1[$i]['id'], $result_1[$i]['contenu'], $result_1[$i]['date_creation'], $ramdomUser, $result_1[$i]['image'], $postComments, $result_3['NumberOfLikes']);
                        }
                        
                        if(!in_array($userPost, $ResultPosts)){
    
                            $ResultPosts[] = $userPost;
                        }
                    }
                }
            }
        }

        else{

            $ResultPosts = $result_1;
        }

        $_SESSION['resultPosts'] = $ResultPosts;
    }
}