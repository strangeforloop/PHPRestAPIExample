<?php
    class Database {
        // DB Parameters
        private $host = 'localhost';
        private $db_name = 'myblog';
        private $username = 'root';
        private $password = '123456';
        private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null;

            // connect thru PDO by creating a new PDO object
            try {
                // $this->conn = new PDO('mysql:host='. $this->host . ';dbname= ' . $this->db_name,
                // $this->username, $this->password);
                // for whatever reason this didn't work, so did the below

                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", 
                "$this->username", "$this->password");
                
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
                // should maybe add a die()

            }
            
            return $this->conn;
        }

    }