<?php
    require "../../globals.php";
    require "../../actions/posts.php";

    // Declarations
    $postTitle = $_POST['postTitle'];
    $postContent = $_POST['postContent'];
    $categoryId = $_POST['categoryId'];

    // Validations
    if(empty($postTitle)){
        throwError("Post title cannot be empty");
    }
    if(empty($postContent)){
        throwError("Post content cannot be empty");
    }
    if(empty($categoryId)){
        throwError("Category Id cannot be empty");
    }
    if(!is_numeric($categoryId)){
        throwError("Category must be a numeric value");
    }
    $postTitle = trim($postTitle);
    $postContent = trim($postContent);
    $categoryId = trim($categoryId);

    $posts = new posts($service);

    $result = $posts->createPost($postTitle,$postContent,$categoryId);

    echo $result;
?>