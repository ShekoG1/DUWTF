<?php
require 'sendEmail.php';
require "../../globals.php";
require "../../actions/admin.php";

$otp = sendOTPmail();

if(empty($otp)){
    throwError("Admin token cannot be empty!");
}

$admin = new admin("5M_0TP_0VERr1D3",$service);
$result = $admin->saveOTP($otp);

echo $result;
?>