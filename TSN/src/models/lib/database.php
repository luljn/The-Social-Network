<?php


namespace TSN\src\models\lib;

class DatabaseConnection {

    public ?\PDO $database = null;

    // The local database connection informations.
    private $localDatabaseAccess = ["mysql:host=db;dbname=mbeck_selatchom_database;charset=utf8", "root", "pass"];

    // The online database connection informations (for production).
    private $onlineDatabaseAccess = ["mysql:host=localhost;dbname=;charset=utf8", "", ""];

    private $useLocalDatabase = True;    // This variable is used to specify which database we use(the local one or the online one).

    public function getConnection(): \PDO {

        if($this->database === null){

            if($this->useLocalDatabase){    // If the site is hosted localy.

                $this->database = new \PDO($this->localDatabaseAccess[0], $this->localDatabaseAccess[1], $this->localDatabaseAccess[2]);
            }

            else{  // If the site is deployed on internet.

                $this->database = new \PDO($this->onlineDatabaseAccess[0], $this->onlineDatabaseAccess[1], $this->onlineDatabaseAccess[2]);
            } 
        }

        return $this->database;
    }
}