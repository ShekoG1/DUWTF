<?php
    require "../../globals.php";
    require "../../actions/posts.php";

    // Declarations
    $categoryId = $_POST['categoryId'];

    // Validations
    if(empty($categoryId)){
        throwError("Category Id cannot be empty");
    }
    if(!is_numeric($categoryId)){
        throwError("Category must be a numeric value");
    }
    $categoryId = trim($categoryId);

    $posts = new posts($service);

    $result = $posts->getPostbyCategory($categoryId);

    echo $result;

?>