<?php

require "../../globals.php";
require "../../actions/admin.php";

$adminToken = $_POST['adminToken'];

if(empty($adminToken)){
    throwError("Admin token cannot be empty!");
}

$auth = new auth($adminToken,$service);

$result = $auth->getAllviewers();

echo $result;