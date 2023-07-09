<?php
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $emailAddress = $_POST['emailAddress'];
    $access_token = $_POST['access_token'];

    $cookieName = "DUWTF-USER";
    $cookiePath = "../../DUWTF_COOKIES";
    $cookieValue = json_encode(array(
        "fName"=>$f_name,
        "lName"=>$l_name,
        "emailAddress"=>$emailAddress,
        "jwt"=>$access_token
    ));
    $expiryTime = time() + (5 * 24 * 60 * 60); // 5 days in seconds
    setcookie($cookieName, $cookieValue, $expiryTime);

    echo json_encode(array(
        "msg"=>"success"
    ));
?>