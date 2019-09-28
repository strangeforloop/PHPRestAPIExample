<?php
    // Headers
    header('Access-Control-Allow-Origin');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate a DB and connect to it
    $database = new Database();
    $db = $database->connect();

    // Instantiate a category object
    $category = new Category($db);

    // Get the id from the URL params
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get a single category
    $category->read_single();

    // Make array to use in JSON
    $category_array = array(
        'id' => $category->id,
        'name' => $category->name
    );

    print_r(json_encode($category_array));



