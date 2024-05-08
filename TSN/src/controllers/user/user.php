<?php


namespace TSN\src\controllers\user;

require_once("./src/models/user.php");
use TSN\src\models\user\UserModification as ModelUserModification;

require_once("./src/models/config/config.php");
use TSN\src\models\config\Config as ModelConfig;

require_once("src/controllers/notification/notification.php");
use TSN\src\controllers\notification\Notification as Notification;


class User {

    private ModelUserModification $userModification;
    private ModelConfig $config;
    private Notification $notification;

    public function updateUserInformations($email, $name, $surname, $address){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->userModification = new ModelUserModification;
        $this->userModification->updatePersonnalInformations($email, strtoupper($name), $surname, $address);

        header("location: {$startingUrl}/index.php?action=myProfile");
    }

    public function updateUserBirthday($birthday){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->userModification = new ModelUserModification;
        $this->userModification->updateBirthday($birthday);

        header("location: {$startingUrl}/index.php?action=myProfile");
    }

    public function updateUserPassword($previousPassword, $password){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->userModification = new ModelUserModification;
        $this->userModification->updatePassword($previousPassword, $password);

        header("location: {$startingUrl}/index.php?action=myProfile");
    }

    public function updateUserProfilePhoto($profile_photo){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->userModification = new ModelUserModification;
        $this->userModification->updateProfilePhoto($profile_photo);

        header("location: {$startingUrl}/index.php?action=myProfile");
    }

    public function updateUserDescription($description){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->userModification = new ModelUserModification;
        $this->userModification->updateDescription($description);

        header("location: {$startingUrl}/index.php?action=myProfile");
    }

    public function SendWarningToUser($idUser){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->notification = new Notification;
        $this->notification->sendNotification($idUser, 10, date('Y-m-d'));

        header("location: {$startingUrl}/index.php?action=adminSpace");
    }

    public function banishUser($idUser){

        $this->config = new ModelConfig;
        $startingUrl = $this->config->getStartingUrl();

        $this->userModification = new ModelUserModification;
        $this->userModification->banishUser($idUser);

        header("location: {$startingUrl}/index.php?action=adminSpace");
    }
}