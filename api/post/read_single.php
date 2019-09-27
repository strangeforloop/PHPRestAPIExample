<?php
    // Headers
    header('Access-Control-Allow-Origin: *'); // public, no auth needed
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate a blog post object
    $post = new Post($db);

    // use super global to get the url param for id .../?id=whatev
    $post->id = isset($_GET['id']) ?  $_GET['id'] : die();

    // get a single post
    $post->read_single();

    // return json data - create array
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );

    // make JSON 
    print_r(json_encode($post_arr));