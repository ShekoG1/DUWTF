<?php
    require "../../globals.php";
    require "../../actions/posts.php";

    // Declarations
    $postId = $_POST['postId'];

    // Validations
    if(empty($postId)){
        throwError("Post Id cannot be empty");
    }
    if(!is_numeric($postId)){
        throwError("Post Id must be a numeric value");
    }
    $postId = trim($postId);

    $posts = new posts($service);

    $result = $posts->getPostbyId($postId);

    echo $result;

?>