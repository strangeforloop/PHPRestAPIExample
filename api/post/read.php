<?php
    // Headers
    header('Access-Control-Allow-Origin: *'); // public, no auth needed
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & connect to it
    $database = new Database();
    $db = $database->connect();

    // error_log("You messed up!", 3, "../../my-errors.log");

    // Instantiate a blog post object
    $post = new Post($db);
    
    // Blog post query
    $result = $post->read();
    $num_rows = $result->rowCount();

    // Check if any posts
    if ($num_rows > 0) {
        // Post Array
        $posts_array = array();
        $posts_array['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            //$row['title'];
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );

            // Push this info to "data"
            array_push($posts_array['data'], $post_item);
        }

        // Turn PHP array to JSON & output
        echo json_encode($posts_array);
    } else {
        // No posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );

    }
