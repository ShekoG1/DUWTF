<?php
    require "../../globals.php";
    require "../../actions/posts.php";

    $posts = new posts($service);

    $result = $posts->get4Latestposts();

    echo $result;

?>