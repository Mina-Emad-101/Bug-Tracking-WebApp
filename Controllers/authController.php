<?php

    require_once __DIR__.'/../Models/user.php';
    session_start();

    class AuthController
    {
        private $db;

        public function __construct($dbController)
        {
            $this->db = $dbController;
        }

        public static function getRoleID($role)
        {
            if($role == 'Admin') return 1;
            if($role == 'Staff') return 2;
            if($role == 'Customer') return 3;
        }

        public static function getRoleFromID($id)
        {
            if($id == 1) return 'Admin';
            if($id == 2) return 'Staff';
            if($id == 3) return 'Customer';
        }

        public function confirmLogin($email, $password)
        {
            $query = "SELECT * FROM auth WHERE email = '$email' AND password = '$password';";
            $result = $this->db->conn->query($query);
            if(mysqli_num_rows($result) == 0) return false;

            $row = $result->fetch_assoc();
            $_SESSION['loggedInUser'] = new User($row);

            return true;
        }

        public function isUsernameTaken($username)
        {
            $query = "SELECT * FROM auth WHERE username = '$username';";
            $result = $this->db->conn->query($query);
            if(mysqli_num_rows($result) == 0){ return false; } else { return true; }
        }

        public function isEmailTaken($email)
        {
            $query = "SELECT * FROM auth WHERE email = '$email';";
            $result = $this->db->conn->query($query);
            if(mysqli_num_rows($result) == 0){ return false; } else { return true; }
        }

        public function register($username, $email, $password, $role)
        {
            $role_id = self::getRoleID($role);
            $query = "INSERT INTO auth (username, email, password, role_id) VALUES ('$username', '$email', '$password', '$role_id');";
            $this->db->conn->query($query);
        }
    }

?>
