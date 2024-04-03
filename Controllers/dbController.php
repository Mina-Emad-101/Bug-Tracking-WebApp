<?php
    class DbController
    {
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $dbName = 'MyDB';
        public $conn;

        public function __construct()
        {
            $this->openConnection();
        }

        public function openConnection()
        {
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);
        }

        public function closeConnection()
        {
            if($this->conn)
            {
                $this->conn->close();
            }
        }
    }
?>
