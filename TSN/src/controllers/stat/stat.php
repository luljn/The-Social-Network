<?php

namespace TSN\src\controllers\stat;

require_once("src/controllers/like/like.php");
use TSN\src\controllers\like\Like as Like;


class Stat {

    public function getStatisticsPage(){

        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == True){  // If the user is connected.

            $connectedUser = $_SESSION['user'];
            // To retrieve the number of likes given and received by the user.
            (new Like)->getLikesGiven($connectedUser->getID());
            (new Like)->getLikesReceived($connectedUser->getID());
        }

        require('./src/views/stat.php');
    }
}