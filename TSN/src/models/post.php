<?php


namespace TSN\src\models\post;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User as User;

class Post {

    private int $id;
    private string $content;
    private string $creationDate;
    private string $image;
    private User $user;    // The user who made the post.

    public function __construct(int $_id, string $_content, string $_creationDate, User $_user, string $_image){
        
        $this->id = $_id;
        $this->content = $_content;
        $this->creationDate = $_creationDate;
        $this->user = $_user;
        $this->image = $_image;
    }

    public function getID(){ return $this->id; }
    public function getContent(){ return $this->content; }
    public function getCreationDate(){ return $this->creationDate; }
    public function getUser(){ return $this->user; }
    public function getImage(){ return $this->image; }

    public function setID(int $_id){ $this->id = $_id; }
    public function setContent(string $_content){ $this->content = $_content; }
    public function setCreationDate(string $_creationDate){ $this->creationDate = $_creationDate; }
    public function setUser(User $user){ $this->user = $user; }
    public function setImage(string $_image){ $this->image = $_image; }
}

class PostManagment {

    private DatabaseConnection $databaseConnection;

    public function getPost(int $id){

        $this->databaseConnection = new DatabaseConnection;
    }

    public function getPostsByUser(int $idUser){    // To retrieve all the posts made by a user.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * from post WHERE id_utilisateur = '{$idUser}';";
        $statement_1 = "SELECT * from utilisateur WHERE id = '{$idUser}';";

        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);

        $query->execute();
        $query_1->execute();

        $result = $query->fetchAll();
        $result_1 = $query_1->fetch();

        $query->closeCursor();
        $query_1->closeCursor();

        $Posts = [];

        if($result_1['profile_photo'] == NULL){

            $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                            date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], '');
        }

        else{

            $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                            date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], $result_1['profile_photo']);
        }

        if($result !== NULL){

            for ($i = 0; $i < count($result); $i++) {

                if($result[$i]['image'] == NULL){

                    $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $user, '');
                }

                else{

                    $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $user, $result[$i]['image']);
                }

                $Posts[] = $userPost;
            }
        }

        $_SESSION['userPosts'] = $Posts;
    }


    public function getRandomPosts(){   // To get random post, to display on the home screen.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * from post LIMIT 5;";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $RandomPosts = [];  // The list of random posts retrieved.
        $Users = [];       // The users who made the posts.

        for ($i = 0; $i < count($result); $i++){  // To retrieve all the authors of posts.

            $idUser = $result[$i]['id_utilisateur'];
            $statement_1 = "SELECT * from utilisateur WHERE id = '{$idUser}';";
            $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);
            $query_1->execute();
            $result_1 = $query_1->fetch();
            $query_1->closeCursor();

            if($result_1['profile_photo'] == NULL){

                $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                                date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], '');
            }
    
            else{
    
                $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                                date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], $result_1['profile_photo']);
            }

            $Users[] = $user;   // We add the user to the list.
        }
        

        for ($i = 0; $i < count($result); $i++){     // To associate a post tho his author.

            foreach($Users as $ramdomUser){

                if($result[$i]['id_utilisateur'] === $ramdomUser->getID()){

                    if($result[$i]['image'] == NULL){

                        $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $ramdomUser, '');
                    }
    
                    else{
    
                        $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $ramdomUser, $result[$i]['image']);
                    }
                    
                    $RandomPosts[] = $userPost;
                }
            }
        }

        $_SESSION['ramdomPosts'] = $RandomPosts;
    }
}