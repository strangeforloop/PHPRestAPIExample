<?php

    header('Access-Control-Allow-Origin: *'); // public, no auth needed
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../Models/Category.php';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    // Get input
    $data = json_decode(file_get_contents("php://input"));

    $category->id = $data->id;
    $category->name = $data->name;
    
    // Create category
    if ($category->create()) {
        echo json_encode(
            array('message' => 'Category Created')
        );
    } else {
        echo json_encode (
            array('message' => 'Category Not Created') 
        );
    }