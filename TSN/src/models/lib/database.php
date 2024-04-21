<?php


namespace TSN\src\models\lib;

class DatabaseConnection {

    public ?\PDO $database = null;
    private $localDatabaseAccess = ["mysql:host=localhost;dbname=mbeck_selatchom_database;charset=utf8", "root", ""];
    private $onlineDatabaseAccess = [];

    public function getConnection(): \PDO {

        if($this->database === null){

            $this->database = new \PDO($this->localDatabaseAccess[0], $this->localDatabaseAccess[1], $this->localDatabaseAccess[2]);
        }

        return $this->database;
    }
}