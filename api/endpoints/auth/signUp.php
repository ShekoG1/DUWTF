<?php
    require "../../globals.php";
    require "../../actions/auth.php";

    // Declarations
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $emailAddress = $_POST['emailAddress'];
    // $memberType = $_POST['memberType'];
    $memberType = "regular";
    $password = $_POST['password'];

    // Validations
    if(empty($fName)){
        throwError("First name cannot be empty");
    }
    if(empty($lName)){
        throwError("Last name cannot be empty");
    }
    if(empty($emailAddress)){
        throwError("Email Addrees cannot be empty");
    }
    // if(empty($memberType)){
    //     throwError("Member type cannot be empty");
    // }
    if(empty($password)){
        throwError("Password cannot be empty");
    }

    $fName = trim($fName);
    $lName = trim($lName);
    $emailAddress = trim($emailAddress);
    // $memberType = trim($memberType);
    $password = trim($password);

    if (preg_match('/\d/', $fName)) {
        throwError("First name cannot contain numbers");
    }
    if (preg_match('/\d/', $lName)) {
        throwError("Last name cannot contain numbers");
    }

    if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
        throwError("Email address is invalid");
    }

    if($memberType != "cool_dude" && $memberType != "regular"){
        throwError("Membership type is not valid!");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $auth = new auth($service,$auth_service);

    $result = $auth->signUp($fName,$lName,$emailAddress,$memberType,$hashedPassword);

    echo $result;
?>