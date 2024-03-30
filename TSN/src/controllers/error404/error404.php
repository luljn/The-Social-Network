<?php


namespace TSN\src\controllers\error404;


class Error {

    public function getError404Page(){

        require('./src/views/error404.php');
    }
}