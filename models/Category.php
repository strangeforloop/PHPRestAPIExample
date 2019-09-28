<?php

    class Category {
        // DB Stuff
        private $conn;
        private $table = 'categories';

        // Category Properties
        public $id;
        public $name;
        public $created_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        // Read Categories
        public function read() {
            // Read query
            $query = 'SELECT
                    id,
                    name,
                    created_at
                FROM 
                    ' . $this->table . 
                ' ORDER BY
                    created_at DESC';
            
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        // Read Single Category
        public function read_single() {
            // Read single query
            $query = 'SELECT 
                    id,
                    name,
                    created_at
                FROM 
                    ' . $this->table . 
                ' WHERE 
                    id = ?
                LIMIT 0,1';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);   // prepare is PDO

            // Bind ID to ? above
            $stmt->bindParam(1, $this->id);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties to use from API endpoint
            $this->id = $row['id'];
            $this->name = $row['name'];
        }


        // Create Category
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . 
                ' SET
                    name = :name,
                    id = :id';
            
                // the :word is a named param, defined further down
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);
                    
            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
           
            // Bind data - for the named params :whatev in the query
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
           
            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s. \n", $stmt->error);
            return false;
        }

        // Update Category
        public function update() {
            $query = 'UPDATE ' . $this->table  .
                ' SET 
                    name = :name
                WHERE
                    id = :id';

            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            
            // Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s. \n", $stmt->error);
            return false;       
        }

        // Delete Category
        public function delete() {
            $query = 'DELETE FROM ' . $this->table .
                ' WHERE id = ?';
            
            $stmt = $this->conn->prepare($query);

            // Clean the data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind the "?"
            $stmt->bindParam(1, $this->id);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            printf("Error: %s. \n", $stmt->error);
            return false;
        }
}