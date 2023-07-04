<?php
    require "../../globals.php";
    require "../../actions/categories.php";

    $categories = new categories($service);

    $result = $categories->getAllcategories();

    echo $result;

?>