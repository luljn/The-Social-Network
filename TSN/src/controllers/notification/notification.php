<?php


namespace TSN\src\controllers\notification;

require_once("./src/models/notification.php");
use TSN\src\models\notification\NotificationManagment as ModelNotificationManagment;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;


class Notification {

    private ModelNotificationManagment $notificationManagment;
    private ModelConfig $config;

    public function getNotificationsPage(){

        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == True){  // If the user is connected.

            $user = $_SESSION['user'];

            $this->notificationManagment = new ModelNotificationManagment;
            $this->notificationManagment->setNotificationsAsRead($user->getID()); // To set all the unread notifications as read.
        }
       
        require('./src/views/notification.php');

        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == True){ // To set the unread notifications as read, after the user read it. 

            $this->getUserNotifications($user->getID());
        }
    }

    public function getUserNotifications($idUser){

        $this->notificationManagment = new ModelNotificationManagment;
        $this->notificationManagment->getNotificationByUser($idUser);
    }

    public function getUnreadUserNotificationsNumber($idUser){

        $this->notificationManagment = new ModelNotificationManagment;
        $number = $this->notificationManagment->getUnreadNotificationsNumber($idUser);

        return $number;
    }

    public function sendNotification($idUser, $idNotif, $date){

        $this->notificationManagment = new ModelNotificationManagment;
        $this->notificationManagment->sendNotificationToUser($idUser, $idNotif, $date);
    }

    public function deleteNotification($idNotif){

        $user = $_SESSION['user'];

        $this->notificationManagment = new ModelNotificationManagment;
        $this->notificationManagment->deleteNotification($idNotif);

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->getUserNotifications($user->getID());
        
        header("location: {$startingUrl}/index.php?action=notification");
    }
}