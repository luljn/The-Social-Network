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
}