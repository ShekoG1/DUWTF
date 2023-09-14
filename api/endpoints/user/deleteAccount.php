<?php
    require "../../globals.php";
    require "../../actions/auth.php";

    // Declarations
    $uid = $_POST['uid'];
    $token = $_POST['token'];

    // Validations
    if(empty($uid)){
        throwError("UID cannot be empty");
    }
    $uid = trim($uid);

    $auth = new auth($service, $auth_service);

    $result = $auth->deleteUser($uid,$token);

    echo $result;
?>