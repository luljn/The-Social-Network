<?php

namespace TSN\src\models\notification;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

class Notification {

    private int $id;
    private int $idUser;
    private string $content;
    private bool $readStatus;
    private string $creationDate;

    public function __construct(int $_id, int $_idUser, string $_content, bool $_readStatus, string $_creationDate){

        $this->id = $_id;
        $this->idUser = $_idUser;
        $this->content = $_content;
        $this->readStatus = $_readStatus;
        $this->creationDate = $_creationDate;
    }

    public function getID(){ return $this->id; }
    public function getIdUser(){ return $this->idUser; }
    public function getContent(){ return $this->content; }
    public function getReadStatus(){ return $this->readStatus; }
    public function getCreationDate(){ return $this->creationDate; }
}


class NotificationManagment {

    private DatabaseConnection $databaseConnection;

    public function getNotificationByUser($idUser){

        $this->databaseConnection = new DatabaseConnection;
        $statement = "SELECT * from notification WHERE id_utilisateur = \"{$idUser}\" ORDER BY date_creation DESC;";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();

        $UserNotifications = []; // The list of all notifications of the user.

        if($result != NULL){

            for ($i = 0; $i < count($result); $i++){

                // To get the content of the notification.
                $idNotif = $result[$i]['id_notificationGenerique'];
                $statement_1 = "SELECT contenu as content from notificationGenerique 
                                JOIN notification ON notification.id_notificationGenerique = notificationgenerique.id
                                WHERE id_notificationGenerique = \"{$idNotif}\" AND notification.id_utilisateur = \"{$idUser}\";";
                $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);
                $query_1->execute();
                $result_1 = $query_1->fetch();
                $query_1->closeCursor();

                $notification = new Notification($result[$i]['id'], $idUser, $result_1['content'], $result[$i]['statut_lecture'], $result[$i]['date_creation']);

                if(!in_array($notification, $UserNotifications)){

                    $UserNotifications[] = $notification;   // We add the notification to the list.
                }
            }
        }

        $_SESSION['userNotifications'] = $UserNotifications;
    }
}