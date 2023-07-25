<?php

// getUsefulstats

require "../../globals.php";
require "../../actions/admin.php";

function saveOTP($OTP){
// $adminToken = $_POST['adminToken'];
// $OTP = $_POST['OTP'];

if(empty($adminToken)){
    throwError("Admin token cannot be empty!");
}

$auth = new auth("5M_0TP_0VERr1D3",$service);

$result = $auth->signIn($OTP);

return $result;
}