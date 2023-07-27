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
    <script defer>
        sendOTPmail();

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
            let otp = document.querySelector("#char1").value + document.querySelector("#char2").value + document.querySelector("#char3").value + document.querySelector("#char4").value + document.querySelector("#char5").value;

            //Fetch Query to endpoint
            var myHeaders = new Headers();
            myHeaders.append("Cookie", "PHPSESSID=5u23lk0g3ncl4j53ie1hg1g2ch");

            var formdata = new FormData();
            formdata.append("otp", otp);

            var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: formdata,
            redirect: 'follow'
            };

            fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/admin/authorize.php", requestOptions)
            .then(response => response.text())
            .then(result => success(JSON.parse(result)))
            .catch(error => console.log('error', error));
        }
        function sendOTPmail(){
            
                var formdata = new FormData();

                var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
                };

                fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/email/sendOTP.php", requestOptions)
                .then(response => response.text())
                .then(result => {
                    alert("You've got mail! Check your email for your admin OTP");
                })
                .catch(error => {
                    alert(`<p>Error: ${error}</p>`)
                });
        }
        function success(result){
            if(result.msg == "success"){
                const jwt = result.jwt;
                const days = 1;
                // Set cookie
                var expires = "";
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
                
                document.cookie = "DUWTF_ADMIN=" + (jwt || "")  + expires + "; path=/";

                // Relocate
                window.location.href= "./Dashboard/";
            }else{
                alert("Error: "+JSON.stringify(result));
            }
        }

    </script>
</body>
</html>