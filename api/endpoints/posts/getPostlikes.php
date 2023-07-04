<?php
    require "../../globals.php";
    require "../../actions/posts.php";

    // Declarations
    $postId = $_POST['postId'];

    // Validations
    if(empty($postId)){
        throwError("Post Id cannot be empty");
    }

    $posts = new posts($service);

    $result = $posts->getPostlikes($postId);

    echo $result;

?>