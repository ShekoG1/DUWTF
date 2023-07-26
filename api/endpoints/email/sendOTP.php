<?php
require 'sendEmail.php';
require "../../globals.php";
require "../admin/saveOTP.php";
require "../../actions/admin.php";

$otp = sendOTPmail();

if(empty($otp)){
    throwError("Admin token cannot be empty!");
}

$auth = new auth("5M_0TP_0VERr1D3",$service);
$result = $auth->saveOTP($OTP);

echo $result;
?>