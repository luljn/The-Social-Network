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
    }
}