<?php

class RegisteredUser {
    public $email;
    public $password;
    public $id;

    public function __construct($_email, $_password, $_id){
        $this->email = $_email;
        $this->password = $_password;
        $this->id = $_id;
    }

    public function setUsetEmail($_email){
        $this->email = $_email;
    }

    public function setUserPassword($_password){
        $this->password = $_password;
    }

    public function setUserId($_id){
        $this->id = $_id;
    }

    public function getUserId() {
        return $this->id;
    }

    public function getUserEmail() {
        return $this->email;
    }

    public function getUserPassword() {
        return $this->password;
    }
}

?>