<?php
    session_start();
    include "../api/endpoints/email/sendEmail.php";
    $otp = sendOTPmail();
    $_SESSION['otp'] = $otp;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="./../res/bootstrap/css/bootstrap.css">
    <script src="./../../res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../style/globals.css">
    <link rel="stylesheet" href="./../style/nav.css">
    <link rel="stylesheet" href="./../style/admin.css">
    <!-- JAVASCRIPT -->
    <script src="./../../js/globals.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div id="login">
            <h1>Enter your OTP</h1>
            <div class="opt">
                <input type="number" id="char1" class="otp">
                <input type="number" id="char2" class="otp">
                <input type="number" id="char3" class="otp">
                <input type="number" id="char4" class="otp">
                <input type="number" id="char5" class="otp">
            </div>
            <input type="submit" value="login" onclick="validate()">
        </div>
    </div>
    <script>
        function validate(){
            let char1 = document.querySelector("#char1").value;
            let char2 = document.querySelector("#char2").value;
            let char3 = document.querySelector("#char3").value;
            let char4 = document.querySelector("#char4").value;
            let char5 = document.querySelector("#char5").value;
        }
    </script>
</body>
</html>