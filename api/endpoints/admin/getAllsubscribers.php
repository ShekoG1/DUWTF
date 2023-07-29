<?php

// getAllusers

require "../../globals.php";
require "../../actions/admin.php";

$adminToken = $_POST['adminToken'];

if(empty($adminToken)){
    throwError("Admin token cannot be empty!");
}

$admin = new admin($adminToken,$service);

$result = $admin->getAllsubscribers();

echo $result;