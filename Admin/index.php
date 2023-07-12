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
    <script src="./../res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../style/globals.css">
    <link rel="stylesheet" href="./../style/nav.css">
    <link rel="stylesheet" href="./../style/admin.css">
    <!-- JAVASCRIPT -->
    <!-- <script src="./../js/globals.js"></script> -->
</head>
<body>
    <div class="container">
        <div id="login">
            <div id="login-header">
                <h1>Enter your OTP</h1>
                <p>A One-Time-Password (OTP) has been sent to the your <em>Admin Email Address</em>. Please check your inbox and enter in the OTP</p>
            </div>
            <div id="opt">
                <input type="number" id="char1" maxlength="1" oninput="jumpToNextField(this,2)" class="otp">
                <input type="number" id="char2" maxlength="1" oninput="jumpToNextField(this,3)" class="otp">
                <input type="number" id="char3" maxlength="1" oninput="jumpToNextField(this,4)" class="otp">
                <input type="number" id="char4" maxlength="1" oninput="jumpToNextField(this,5)" class="otp">
                <input type="number" id="char5" maxlength="1" oninput="jumpToNextField(this,-1)" class="otp">
            </div>
            <div id="login-footer">
                <input type="submit" id="loginBtn" value="LOGIN" onclick="validate()">
            </div>
        </div>
    </div>
    <script>
        function jumpToNextField(currentField, nextFieldId) {
            if(nextFieldId != -1){
                if (currentField.value.length >= currentField.maxLength) {
                    document.getElementById(`char${nextFieldId}`).focus();
                }
            }else{
                document.querySelector("#loginBtn").focus();
            }
        }
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