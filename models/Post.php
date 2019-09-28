<?php
    class Post {
        // DB Stuff
        private $conn; 
        private $table = 'posts';

        // Post Properties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        // Get/Read Posts
        public function read() {
            $query = 'SELECT 
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM
                    ' . $this->table . ' p
                LEFT JOIN
                    categories c ON p.category_id = c.id  
                ORDER BY
                    p.created_at DESC';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);   // prepare is PDO

            // Execute Query
            $stmt->execute();

            return $stmt;       
        }

        // Read Single Post
        public function read_single() {
            $query = 'SELECT 
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM
                    ' . $this->table . ' p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                WHERE
                    p.id = ?
                LIMIT 0,1';


            // Prepare Statement
            $stmt = $this->conn->prepare($query);   // prepare is PDO

            // Bind ID to ? above
            $stmt->bindParam(1, $this->id);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties to use from API endpoint
            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
        }

    // Create Post
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . 
            ' SET
                title = :title,      
                body = :body,
                author = :author,
                category_id = :category_id';
            
                // the :word is a named param, defined further down
         
        // Prepare Statement
        $stmt = $this->conn->prepare($query);
                
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind data - for the named params :whatev in the query
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    // Update Post
    public function update() {
        // Update query
        $query = 'UPDATE ' . $this->table . 
            ' SET
                title = :title,      
                body = :body,
                author = :author,
                category_id = :category_id
            WHERE
                id = :id';
            
                // the :word is a named param, defined further down
         
        // Prepare Statement
        $stmt = $this->conn->prepare($query);
                
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data - for the named params :whatev in the query
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    // Delete Post
    public function delete() {
        // Delete query
        $query = 'DELETE FROM ' . $this->table .
            ' WHERE 
                id = :id';
        
        $stmt = $this->conn->prepare($query);

        // Clean id
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Bind id to param
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }
}