<?php


namespace TSN\src\models\lib;


class DatabaseConnection {

    public ?\PDO $database = null;

    public function getConnection(): \PDO {

        if($this->database === null){

            $this->database = new \PDO("mysql:host=localhost;dbname=mbeck_selatchom_database;charset=utf8", "root", "");
        }

        return $this->database;
    }
}