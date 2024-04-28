<?php


namespace TSN\src\models\comment;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User as User;

class Comment {

    private int $id;
    private int $idPost;
    private string $content;
    private string $creationDate;
    private string $image;
    private User $user;    // The user who made the comment.

    public function __construct(int $_id, int $_idPost, string $_content, string $_creationDate, User $_user, string $_image){
        
        $this->id = $_id;        
        $this->idPost = $_idPost;
        $this->content = $_content;
        $this->creationDate = $_creationDate;
        $this->user = $_user;
        $this->image = $_image;
    }

    public function getID(){ return $this->id; }
    public function getIdPost(){ return $this->idPost; }
    public function getContent(){ return $this->content; }
    public function getCreationDate(){ return $this->creationDate; }
    public function getUser(){ return $this->user; }
    public function getImage(){ return $this->image; }

    public function setID(int $_id){ $this->id = $_id; }
    public function setIdPost(int $_idPost){ $this->idPost = $_idPost; }
    public function setContent(string $_content){ $this->content = $_content; }
    public function setCreationDate(string $_creationDate){ $this->creationDate = $_creationDate; }
    public function setUser(User $user){ $this->user = $user; }
    public function setImage(string $_image){ $this->image = $_image; }
}

class CommentManagment {

    private DatabaseConnection $databaseConnection;

    public function getCommentsByPost(int $idPost){

        $Comments = [];  // The list of all the comments of a post.
        $Users = [];     // The list of each user who made a comment on a post.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * FROM commentaire WHERE id_post = \"{$idPost}\";";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();


        for ($i = 0; $i < count($result); $i++){  // To retrieve all the authors of comments.

            $idUser = $result[$i]['id_utilisateur'];
            $statement_1 = "SELECT * from utilisateur WHERE id = \"{$idUser}\";";
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


        for ($i = 0; $i < count($result); $i++){     // To associate a comment to his author.

            foreach($Users as $user){

                if($result[$i]['id_utilisateur'] === $user->getID()){

                    if($result[$i]['image'] == NULL){

                        $userComment = new Comment($result[$i]['id'], $idPost, $result[$i]['contenu'], $result[$i]['date_creation'], $user, '');
                    }
    
                    else{
    
                        $userComment = new Comment($result[$i]['id'], $idPost, $result[$i]['contenu'], $result[$i]['date_creation'], $user, $result[$i]['image']);
                    }
                    
                    if(!in_array($userComment, $Comments)){

                        $Comments[] = $userComment;                        
                    }
                }
            }
        }

        return $Comments;
    }
}