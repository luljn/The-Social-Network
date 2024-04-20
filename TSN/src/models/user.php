<?php 


namespace TSN\src\models\user;

require_once("lib/database.php");
use TSN\src\models\lib\DatabaseConnection;

class User {

    private int $id;
    private string $email;
    private string $password;
    private string $name;
    private string $surname;
    private string $birthday;
    private string $address;
    private bool $admin;
    private string $photo;

    public function __construct(int $_id, string $_email, string $_password, string $_name, string $_surname, 
                                string $_birthday, string $_address, bool $_admin,  string $_photo){
        
        $this->id = $_id;
        $this->email = $_email;
        $this->password = $_password;
        $this->name = $_name;
        $this->surname = $_surname;
        $this->birthday = $_birthday;
        $this->address = $_address;
        $this->admin = $_admin;
        $this->photo = $_photo;
    }

    public function getID(){ return $this->id; }
    public function getEmail(){ return $this->email; }
    public function getpassword(){ return $this->password; }
    public function getName(){ return $this->name; }
    public function getSurname(){ return $this->surname; }
    public function getBirthday(){ return $this->birthday; }
    public function getAddress(){ return $this->address; }
    public function getAdmin(){ return $this->admin; }
    public function getPhoto(){ return $this->photo; }

    public function setID(int $_id){ $this->id = $_id; }
    public function setEmail(string $_email){ $this->email = $_email; }
    public function setpassword(string $_password){ $this->password = $_password; }
    public function setName(string $_name){ $this->name = $_name; }
    public function setSurname(string $_surname){ $this->surname = $_surname; }
    public function setBirthday(string $_birthday){ $this->birthday = $_birthday; }
    public function setAddress(string $_address){ $this->address = $_address; }
    public function setPhoto(string $_photo){ $this->photo = $_photo; }
}


class UserModification {  // This class is used to modify the user informations in the database.

    private DatabaseConnection $databaseConnection; 

    public function updatePersonnalInformations($email, $name, $surname, $address){

        $this->databaseConnection = new DatabaseConnection;
        $user = $_SESSION['user'];
        $idUser = $user->getID();            // The Id of the connected user.
        $statement = "UPDATE utilisateur 
                      SET email = '{$email}', nom = '{$name}', 
                      prenom = '{$surname}', adresse = '{$address}'
                      WHERE id = '{$idUser}';";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();

        // We update the user informations to display it on the UI.
        $_SESSION['user'] = $this->updateUser($idUser);
    }

    public function updateBirthday($birthday){

        $this->databaseConnection = new DatabaseConnection;
        $user = $_SESSION['user'];
        $idUser = $user->getID();            // The Id of the connected user.
        $statement = "UPDATE utilisateur 
                      SET date_de_naissance = '{$birthday}'
                      WHERE id = '{$idUser}';";
        $query = $this->databaseConnection->getConnection()->prepare($statement);
        $query->execute();
        $query->closeCursor();

        // We update the user informations to display it on the UI.
        $_SESSION['user'] = $this->updateUser($idUser);
    }

    public function updatePassword($previousPassword, $password){

        $this->databaseConnection = new DatabaseConnection;
        $user = $_SESSION['user'];
        $idUser = $user->getID();            // The Id of the connected user.

        $statement_1 = "SELECT mdp AS password from utilisateur WHERE id = '{$idUser}';";
        $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);
        $query_1->execute();
        $result_1 = $query_1->fetch();
        $query_1->closeCursor();

        if(password_verify($previousPassword, $result_1['password'])){

            $mdp = password_hash($password, PASSWORD_DEFAULT);
            $statement = "UPDATE utilisateur 
                          SET mdp = '{$mdp}'
                          WHERE id = '{$idUser}';";
            $query = $this->databaseConnection->getConnection()->prepare($statement);
            $query->execute();
            $query->closeCursor();

            // We update the user informations to display it on the UI.
            $_SESSION['user'] = $this->updateUser($idUser);
        }

        // Currently, we don't manage the case in which the user enter an incorrect current password.
    }

    public function updateProfilePhoto($photo){

        
    }

    public function updateUser($idUser){          // To update the informations about the user in the application.

        $this->databaseConnection = new DatabaseConnection;
        $statement_1 = "SELECT * from utilisateur WHERE id = '{$idUser}';";
        $query_1 = $this->databaseConnection->getConnection()->prepare($statement_1);
        $query_1->execute();
        $result_1 = $query_1->fetch();
        $query_1->closeCursor();

        if($result_1['profile_photo'] == NULL){

            $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                            date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], '');
        }

        else{

            $user = new User($result_1['id'], $result_1['email'], $result_1['mdp'], $result_1['nom'], $result_1['prenom'],
                            date("d-m-Y", strtotime($result_1['date_de_naissance'])), $result_1['adresse'], $result_1['admin'], $result_1['profile_photo']);
        }

        return $user;
    }
}