<?php
    require "../../globals.php";
    require "../../actions/posts.php";

    // Declarations
    $userId = $_POST['userId'];
    $postId = $_POST['postId'];
    $comment = $_POST['comment'];

    // Validations
    if(empty($userId)){
        throwError("User Id cannot be empty");
    }
    if(empty($postId)){
        throwError("Post Id cannot be empty");
    }
    if(empty($comment)){
        throwError("Comment cannot be empty");
    }

    if(!is_numeric($userId)){
        throwError("User Id must be a numeric value");
    }
    if(!is_numeric($postId)){
        throwError("Post Id must be a numeric value");
    }

    $comment = strip_tags($comment);

    $userId = trim($userId);
    $postId = trim($postId);
    $comment = trim($comment);

    $posts = new posts($service);

    $result = $posts->makeComment($userId,$postId,$comment);

    echo $result;
?>