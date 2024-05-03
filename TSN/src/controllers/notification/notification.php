<?php


namespace TSN\src\controllers\notification;

require_once("./src/models/notification.php");
use TSN\src\models\notification\NotificationManagment as ModelNotificationManagment;


class Notification {

    private ModelNotificationManagment $notificationManagment;

    public function getNotificationsPage(){

        $user = $_SESSION['user'];

        $this->notificationManagment = new ModelNotificationManagment;
        $this->notificationManagment->setNotificationsAsRead($user->getID()); // To sert all the unread notifications as read.
        require('./src/views/notification.php');
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
}