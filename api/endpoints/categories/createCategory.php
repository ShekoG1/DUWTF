<?php
    require "../../globals.php";
    require "../../actions/categories.php";

    // Declarations
    $categoryTitle = $_POST['categoryTitle'];

    // Validations
    if(empty($categoryTitle)){
        throwError("Categpry title cannot be empty");
    }
    $categoryTitle = trim($categoryTitle);

    $categories = new categories($service);

    $result = $categories->createCategory($categoryTitle);

    echo $result;
?>