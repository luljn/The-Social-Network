<?php



namespace TSN\src\models\login;

use TSN\src\models\lib\DatabaseConnection;
use TSN\src\models\user\User;

class Login {

    private User $user;
    private DatabaseConnection $databaseConnection;

    public function connectUser(){
        
        $this->databaseConnection = new DatabaseConnection;

        
    }
}