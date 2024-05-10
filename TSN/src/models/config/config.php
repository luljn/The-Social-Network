<?php

namespace TSN\src\models\config;

class Config {

    private string $startingUrlWithPort = "http://localhost:4000";
    private string $startingUrlWithoutPort = "https://tsn-thesocialnetwork.000webhostapp.com";
    private bool $usingPort = False;   // To determine if we use a specific port or not, to access the web site. 

    public function getStartingUrl(){

        if($this->usingPort){

            return $this->startingUrlWithPort;
        }

        return $this->startingUrlWithoutPort;
    }
}