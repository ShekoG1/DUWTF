<?php

require "../../globals.php";
require "../../actions/admin.php";

$otp = $_POST['otp'];

if(empty($otp)){
    throwError("OTP cannot be empty!");
}

$otp = trim($otp);

?>