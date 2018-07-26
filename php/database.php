<?php
    class Database {
        private $host = 'localhost';
        private $username = 'root';
        private $password = "Int64.Parse";
        private $db_name = "blog";
        public $conn;

        public function getConnection() {
            $this->conn = null;

            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
            return $this->conn;
        }

        public function closeConnection() {
            $this->conn->close();
        }
    }
?>