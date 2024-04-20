<?php


namespace TSN\src\controllers\user;

require_once("./src/models/user.php");
use TSN\src\models\user\UserModification as ModelUserModification;

require_once("src/controllers/profile/profile.php");
use TSN\src\controllers\profile\Profile as Profile;


class User {

    private ModelUserModification $userModification;

    public function updateUserInformations($email, $name, $surname, $address){

        $this->userModification = new ModelUserModification;
        $this->userModification->updatePersonnalInformations($email, $name, $surname, $address);

        header("location: http://localhost:4000/index.php?action=myProfile");
    }

    public function updateUserBirthday($birthday){

        $this->userModification = new ModelUserModification;
        $this->userModification->updateBirthday($birthday);

        header("location: http://localhost:4000/index.php?action=myProfile");
    }

    public function updateUserPassword($previousPassword, $password){

        $this->userModification = new ModelUserModification;
        $this->userModification->updatePassword($previousPassword, $password);

        header("location: http://localhost:4000/index.php?action=myProfile");
    }

    public function updateUserProfilePhoto($profile_photo){

        $this->userModification = new ModelUserModification;
        $this->userModification->updateProfilePhoto($profile_photo);

        header("location: http://localhost:4000/index.php?action=myProfile");
    }
}