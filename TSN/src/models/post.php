<?php


namespace TSN\src\models\post;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

require_once("user.php");
use TSN\src\models\user\User as User;

require_once("./src/controllers/comment/comment.php");
use TSN\src\controllers\comment\Comment as CommentController;

class Post {

    private int $id;
    private string $content;
    private string $creationDate;
    private string $image;
    private User $user;               // The user who made the post.
    private $comments = [];          // The list of all the comments of a post.
    private int $likes;             // The number of likes of a comment.
    private bool $sensible;

    public function __construct(int $_id, string $_content, string $_creationDate, User $_user, string $_image, $_comments, int $_likes, bool $_sensible){
        
        $this->id = $_id;
        $this->content = $_content;
        $this->creationDate = $_creationDate;
        $this->user = $_user;
        $this->image = $_image;
        $this->comments = $_comments;
        $this->likes = $_likes;
        $this->sensible = $_sensible;
    }

    public function getID(){ return $this->id; }
    public function getContent(){ return $this->content; }
    public function getCreationDate(){ return $this->creationDate; }
    public function getUser(){ return $this->user; }
    public function getImage(){ return $this->image; }
    public function getComments(){ return $this->comments; }
    public function getLikes(){ return $this->likes; }
    public function getSensibility(){ return $this->sensible; }

    public function setID(int $_id){ $this->id = $_id; }
    public function setContent(string $_content){ $this->content = $_content; }
    public function setCreationDate(string $_creationDate){ $this->creationDate = $_creationDate; }
    public function setUser(User $user){ $this->user = $user; }
    public function setImage(string $_image){ $this->image = $_image; }
}

class PostManagment {

    private DatabaseConnection $databaseConnection;
    private CommentController $commentController;

    public function addPost($idUser, $content, $date){            // To add a post without an image.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "INSERT INTO post (id_utilisateur, contenu, date_creation, image, sensible) 
                      VALUES (\"{$idUser}\", \"{$content}\", \"{$date}\", NULL, 0);";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();
    }

    public function addPostWithImage($idUser, $content, $date, $image){    // To add a post with an image.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "INSERT INTO post (id_utilisateur, contenu, date_creation, image, sensible) 
                      VALUES (\"{$idUser}\", \"{$content}\", \"{$date}\", \"{$image}\", 0);";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();
    }

    public function deletePost($idPost){  // To delete a post.

        $this->databaseConnection = new DatabaseConnection;
        $statement = "DELETE FROM post WHERE id = \"{$idPost}\";";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();
    }

    public function setPostAsSensible($idPost){

        $this->databaseConnection = new DatabaseConnection;
        $statement = "UPDATE post SET sensible = 1 WHERE id = \"{$idPost}\";";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();
    }

    public function getPostsByUser(int $idUser){    // To retrieve all the posts made by a user.

        $this->commentController = new CommentController;

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * from post WHERE id_utilisateur = \"{$idUser}\" ORDER BY date_creation DESC, id DESC;";
        $statement_1 = "SELECT * from utilisateur WHERE id = \"{$idUser}\";";

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
                            date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], '', $result_1['description']);
        }

        else{

            $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                            date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], $result_1['profile_photo'], $result_1['description']);
        }

        if($result !== NULL){

            for ($i = 0; $i < count($result); $i++) {

                // List of comments of each post.
                $postComments = $this->commentController->getPostComments($result[$i]['id']);
                //

                // To retrieve the number of likes of the post.
                $idPost = $result[$i]['id'];
                $statement_2 = "CALL CountLikesOfPost({$idPost});";
                $query_2 = $this->databaseConnection->getConnection()->prepare($statement_2);
                $query_2->execute();
                $result_2 = $query_2->fetch();
                $query_2->closeCursor();


                if($result[$i]['image'] == NULL){

                    $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $user, '', $postComments, $result_2['NumberOfLikes'], $result[$i]['sensible']);
                }

                else{

                    $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $user, $result[$i]['image'], $postComments, $result_2['NumberOfLikes'], $result[$i]['sensible']);
                }

                $Posts[] = $userPost;
            }
        }

        $_SESSION['userPosts'] = $Posts;
    }


    public function getRandomPosts(){   // To get random post, to display on the home screen.

        $this->commentController = new CommentController;

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * from post ORDER BY date_creation DESC, id DESC;";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $RandomPosts = [];  // The list of random posts retrieved.
        $Users = [];       // The users who made the posts.

        for ($i = 0; $i < count($result); $i++){  // To retrieve all the authors of posts.

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
        

        for ($i = 0; $i < count($result); $i++){     // To associate a post to his author.

            foreach($Users as $ramdomUser){

                if($result[$i]['id_utilisateur'] === $ramdomUser->getID()){

                    // List of comments of each post.
                    $postComments = $this->commentController->getPostComments($result[$i]['id']);
                    //

                    // To retrieve the number of likes of the post.
                    $idPost = $result[$i]['id'];
                    $statement_2 = "CALL CountLikesOfPost({$idPost});";
                    $query_2 = $this->databaseConnection->getConnection()->prepare($statement_2);
                    $query_2->execute();
                    $result_2 = $query_2->fetch();
                    $query_2->closeCursor();

                    if($result[$i]['image'] == NULL){

                        $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $ramdomUser, '', $postComments, $result_2['NumberOfLikes'], $result[$i]['sensible']);
                    }
    
                    else{
    
                        $userPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $ramdomUser, $result[$i]['image'], $postComments, $result_2['NumberOfLikes'], $result[$i]['sensible']);
                    }
                    
                    if(!in_array($userPost, $RandomPosts)){

                        $RandomPosts[] = $userPost;
                    }
                }
            }
        }

        $_SESSION['ramdomPosts'] = $RandomPosts;
    }

    public function getFollowingsPosts(){  // The get all the post made by followings of a user.

        $this->commentController = new CommentController;

        $userFollowings = $_SESSION['userFollowings'];
        $followingsPosts = [];  // The list of user followings posts.

        $this->databaseConnection = new DatabaseConnection;

        foreach($userFollowings as $following){

            $id_following = $following->getUser()->getID();

            $statement = "SELECT * from post WHERE id_utilisateur = \"{$id_following}\" ORDER BY date_creation DESC, id DESC;";
            $query = $this->databaseConnection->getConnection()->prepare($statement);
            $query->execute();
            $result = $query->fetchAll();
            $query->closeCursor();

            if($result != NULL){

                for($i = 0; $i < count($result); $i++){

                    // List of comments of each post.
                    $postComments = $this->commentController->getPostComments($result[$i]['id']);
                    //

                    // To retrieve the number of likes of the post.
                    $idPost = $result[$i]['id'];
                    $statement_2 = "CALL CountLikesOfPost({$idPost});";
                    $query_2 = $this->databaseConnection->getConnection()->prepare($statement_2);
                    $query_2->execute();
                    $result_2 = $query_2->fetch();
                    $query_2->closeCursor();

                    if($result[$i]['image'] == NULL){

                        $followingPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $following->getUser(), '', $postComments, $result_2['NumberOfLikes'], $result[$i]['sensible']);
                    }
    
                    else{
    
                        $followingPost = new Post($result[$i]['id'], $result[$i]['contenu'], $result[$i]['date_creation'], $following->getUser(), $result[$i]['image'], $postComments, $result_2['NumberOfLikes'], $result[$i]['sensible']);
                    }

                    if(!in_array($followingPost, $followingsPosts)){

                        $followingsPosts[] = $followingPost;
                    }
                }
            }
        }

        $_SESSION["followingsPosts"] = $followingsPosts;
    }
}