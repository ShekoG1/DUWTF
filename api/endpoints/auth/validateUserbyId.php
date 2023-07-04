<?php
    require "../../globals.php";
    require "../../actions/auth.php";

    // Declarations
    $userId = $_POST['userId'];

    // Validations
    if(empty($userId)){
        throwError("User Id cannot be empty");
    }
    if(!is_numeric($userId)){
        throwError("User Id must be a numeric value");
    }
    $userId = trim($userId);

    $auth = new auth($service,$auth_service);

    $result = $auth->validateUserbyId($userId);

    echo $result;
?>