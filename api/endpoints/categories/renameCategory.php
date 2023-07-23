<?php
    require "../../globals.php";
    require "../../actions/categories.php";

    // Declarations
    $categoryId = $_POST['categoryId'];
    $categoryNewname = $_POST['categoryNewname'];

    // Validations
    if(empty($categoryNewname)){
        throwError("Categpry title cannot be empty");
    }
    if(empty($categoryId)){
        throwError("Category id cannot be empty");
    }
    $categoryNewname = trim($categoryNewname);

    $categories = new categories($service);

    $result = $categories->renameCategory($categoryId, $categoryNewname);

    echo $result;
?>