<?php

require "../../globals.php";
require "../../actions/admin.php";

$otp = $_POST['otp'];

if(empty($otp)){
    throwError("OTP cannot be empty!");
}

$otp = trim($otp);

$admin = new admin("5M_0TP_0VERr1D3",$service);
echo $admin->signIn($otp);
?>