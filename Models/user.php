<?php

require_once __DIR__.'/../Controllers/authController.php';

class User
{
    private $id;
    private $username;
    private $email;
    private $role;

    function __construct($dbRow)
    {
        $this->id = $dbRow['id'];
        $this->username = $dbRow['username'];
        $this->email = $dbRow['email'];
        $this->role = AuthController::getRoleFromID($dbRow['role_id']);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }
}

?>
