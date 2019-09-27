<?php
    // Headers
    header('Access-Control-Allow-Origin: *'); // public, no auth needed
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate a blog post object
    $post = new Post($db);

    // Get raw posted data submited, which is in json format -- JUST THE ID
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to delete
    $post->id = $data->id;
    
    // Delete post
    if ($post->delete()) {
        echo json_encode(
            array('message' => 'Post Deleted')
        );
    } else {
        echo json_encode (
            array('message' => 'Post Not Deleted') 
        );
    }