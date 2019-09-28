<?php
    // Headers
    header('Access-Control-Allow-Origin: *'); // public, no auth needed
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate a blog category object
    $category = new Category($db);

    // Get the raw data submited, which is in json format
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to delete specifc category
    $category->id = $data->id;
    
    // Delete category
    if ($category->delete()) {
        echo json_encode(
            array('message' => 'Category Deleted')
        );
    } else {
        echo json_encode (
            array('message' => 'Category Not Deleted') 
        );
    }