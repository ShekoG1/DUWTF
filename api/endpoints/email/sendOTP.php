<?php
require 'sendEmail.php';
require "../../globals.php";
require "../admin/saveOTP.php";

$otp = sendOTPmail();
saveOTP($otp);
?>