<?php

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
                <input type="text" id="char1" maxlength="1" oninput="jumpToNextField(this,2)" class="otp">
                <input type="text" id="char2" maxlength="1" oninput="jumpToNextField(this,3)" class="otp">
                <input type="text" id="char3" maxlength="1" oninput="jumpToNextField(this,4)" class="otp">
                <input type="text" id="char4" maxlength="1" oninput="jumpToNextField(this,5)" class="otp">
                <input type="text" id="char5" maxlength="1" oninput="jumpToNextField(this,-1)" class="otp">
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
                // document.querySelector("#loginBtn").focus();
                validate();
            }
        }
        function validate(){
            let char1 = document.querySelector("#char1").value;
            let char2 = document.querySelector("#char2").value;
            let char3 = document.querySelector("#char3").value;
            let char4 = document.querySelector("#char4").value;
            let char5 = document.querySelector("#char5").value;

            //Fetch Query to endpoint

            var myHeaders = new Headers();
            myHeaders.append("Cookie", "PHPSESSID=5u23lk0g3ncl4j53ie1hg1g2ch");

            var formdata = new FormData();
            formdata.append("char1", char1);
            formdata.append("char2", char2);
            formdata.append("char3", char3);
            formdata.append("char4", char4);
            formdata.append("char5", char5);

            var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: formdata,
            redirect: 'follow'
            };

            fetch("http://localhost/projects/DearUniverseWTF/Admin/authorize.php", requestOptions)
            .then(response => response.text())
            .then(result => success(result))
            .catch(error => console.log('error', error));
        }
        function success(result){
            if(result == "success"){
                window.location.href= "./Dashboard/";
            }
        }

    </script>
</body>
</html>