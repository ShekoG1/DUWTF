<?php
    require "../../globals.php";
    require "../../actions/auth.php";

    // Declarations
    $emailAddress = $_POST['emailAddress'];
    $password = $_POST['password'];

    // Validations
    if(empty($emailAddress)){
        throwError("Email address cannot be empty");
    }
    if(empty($password)){
        throwError("Password cannot be empty");
    }
    $emailAddress = trim($emailAddress);
    // $password = trim($password);

    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $auth = new auth($service,$auth_service);

    $result = $auth->signIn($emailAddress,$password);

    echo $result;
?>