<?php
    // Headers
    header('Access-Control-Allow-Origin: *'); // public, no auth needed
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // error_log("You messed up!", 3, "../../my-errors.log");

    // Instantiate a blog post object
    $post = new Post($db);

    // Get raw posted data from postman, which is in json format
    $data = json_decode(file_get_contents("php://input"));

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;
    
    // Create post
    if ($post->create()) {
        echo json_encode(
            array('message' => 'Post Created')
        );
    } else {
        echo json_encode (
            array('message' => 'Post Not Created') 
        );
    }