<?php


class Config {

    private string $startingUrlWithPort = "http://localhost:4000";
    private string $startingUrlWithoutPort = "http://localhost/";
    private bool $usingPort = True;

    public function getStartingUrl(){

        if($this->usingPort){

            return $this->startingUrlWithPort;
        }

        return $this->startingUrlWithoutPort;
    }
}