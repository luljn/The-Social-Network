<?php


namespace TSN\src\models\post;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

class Post {

    private int $id;
    private string $content;
    private string $creationDate;
    private int $idUser;
    private string $image;

    public function __construct(int $_id, string $_content, string $_creationDate, int $_idUser, string $_image){
        
        $this->id = $_id;
        $this->content = $_content;
        $this->creationDate = $_creationDate;
        $this->idUser = $_idUser;
        $this->image = $_image;
    }

    public function getID(){ return $this->id; }
    public function getContent(){ return $this->content; }
    public function getCreationDate(){ return $this->creationDate; }
    public function getIdUser(){ return $this->idUser; }
    public function getImage(){ return $this->image; }

    public function setID(int $_id){ $this->id = $_id; }
    public function setContent(string $_content){ $this->content = $_content; }
    public function setCreationDate(string $_creationDate){ $this->creationDate = $_creationDate; }
    public function setIdUser(int $_idUser){ $this->idUser = $_idUser; }
    public function setImage(string $_image){ $this->image = $_image; }
}

class PostManagment {

    private DatabaseConnection $databaseConnection;

    public function getPost(int $id){

        $this->databaseConnection = new DatabaseConnection;
    }

    public function getPostsByUser(int $idUser){

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * from post WHERE id_utilisateur = '{$idUser}';";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $Posts = [];

        if($result !== NULL){

            for ($i = 0; $i < count($result); $i++) {

                if($result['image'] == NULL){

                    $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $result[$i]['id_utilisateur'], '');
                }

                else{

                    $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $result[$i]['id_utilisateur'], $result[$i]['image']);
                }

                $Posts[] = $userPost;
            }
        }

        $_SESSION['userPosts'] = $Posts;
        // return $Posts;
    }


    public function getRandomPosts(){

        $this->databaseConnection = new DatabaseConnection;
    }
}