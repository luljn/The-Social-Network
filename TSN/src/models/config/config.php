<?php

namespace TSN\src\models\config;

class Config {

    private string $startingUrlWithPort = "http://localhost:4000";
    private string $startingUrlWithoutPort = "http://localhost/TSN";
    private bool $usingPort = True;   // To determine if we use a specific port or not, to access the web site. 

    public function getStartingUrl(){

        if($this->usingPort){

            return $this->startingUrlWithPort;
        }

        return $this->startingUrlWithoutPort;
    }
}