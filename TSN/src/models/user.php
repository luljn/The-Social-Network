<?php 


namespace TSN\src\models\user;

use DateTime;

class User {

    private int $id;
    private string $email;
    private string $password;
    private string $name;
    private string $surname;
    private DateTime $birthday;
    private string $address;
    private bool $admin;

    public function __construct(int $_id, string $_email, string $_password, string $_name, string $_surname, 
                                DateTime $_birthday, string $_address, bool $_admin){
        
        $this->id = $_id;
        $this->email = $_email;
        $this->password = $_password;
        $this->name = $_name;
        $this->surname = $_surname;
        $this->birthday = $_birthday;
        $this->address = $_address;
        $this->admin = $_admin;
    }

    public function getID(){ return $this->id; }
    public function getEmail(){ return $this->email; }
    public function getpassword(){ return $this->password; }
    public function getName(){ return $this->name; }
    public function getSurname(){ return $this->surname; }
    public function getBirthday(){ return $this->birthday; }
    public function getAddress(){ return $this->address; }
    public function getAdmin(){ return $this->admin; }

    public function setEmail(string $_email){ $this->email = $_email; }
    public function setpassword(string $_password){ $this->password = $_password; }
    public function setName(string $_name){ $this->name = $_name; }
    public function setSurname(string $_surname){ $this->surname = $_surname; }
    public function setBirthday(DateTime $_birthday){ $this->birthday = $_birthday; }
    public function setAddress(string $_address){ $this->address = $_address; }
}