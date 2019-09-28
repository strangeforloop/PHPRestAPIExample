<?php
    // Headers
    header('Access-Control-Allow-Origin: *'); // public, no auth needed
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate a blog category object
    $category = new Category($db);

    // Get all categories
    $result = $category->read();
    $num_rows = $result->rowCount();

    if ($num_rows > 0) {
        // Put each elem from categories result into an array
        $categories_arr = array();
        $categories_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $category_item = array(
                'id' => $row['id'],
                'name' => $row['name']
            );     

            array_push($categories_arr['data'], $category_item);
        } 

        // Turn PHP array to JSON & output
            echo json_encode($categories_arr);
    } else {
        // No categories
        echo json_encode(
            array('message' => 'No Categories Found')
        );

    }

