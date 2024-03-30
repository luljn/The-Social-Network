<?php


namespace TSN\src\controllers\erreur404;


class Error {

    public function getError404Page(){

        require('./src/views/erreur404.php');
    }
}