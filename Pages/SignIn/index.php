<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="./../../res/bootstrap/css/bootstrap.css">
    <script src="./../../res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../../style/globals.css">
    <link rel="stylesheet" href="./../../style/auth.css">
    <!-- JAVASCRIPT -->
    <script src="./../../js/globals.js"></script>
</head>
<body>
    <div id="content">
        <div id="form">
            <h1 class="neonPurple">Sign In</h1>
            <!-- EMAIL -->
            <div class="row input-container">
                <div class="col-12 neonPink form-label" id="emailAddress-label">
                    Email Address:
                </div>
                <div class="col-12 form-input">
                    <input type="email" id="emailAddress" class="neonInput" onchange="validateEmailaddress()">
                </div>
                <div class="col-12 neonRed form-error" id="emailAddress-error">

                </div>
            </div>
            <!-- PASSWORD -->
            <div class="row input-container">
                <div class="col-12 neonPink form-label" id="password-label">
                    Password:
                </div>
                <div class="col-12 form-input passwordInputcontainer">
                    <input type="password" id="password" class="neonInput" placeholder="Enter Your Password" onchange="validatePassword()">
                    <div id="wrapper" class="eye-open">
                        <div id="icon-eye" onclick="togglePassword(false)">
                            <svg width="50" height="50" viewBox="-20 -200 320 400" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                <g id="eye" stroke-width="25" fill="none">
                                    <g id="eye-lashes" stroke="currentColor">
                                        <line x1="140" x2="140" y1="90" y2="180" />
                                        <line x1="70"  x2="10"  y1="60" y2="140" />
                                        <line x1="210" x2="270" y1="60" y2="140" />
                                    </g>
                                    
                                    <path id="eye-bottom" d="m0,0q140,190 280,0" stroke="currentColor" />
                                    <path id="eye-top"    d="m0,0q140,190 280,0" stroke="currentColor" />

                                    <circle id="eye-pupil" cx="140" cy="0" r="40" fill="currentColor" stroke="none" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-12 neonRed form-error" id="password-error">
                </div>
            </div>
            <!-- SUBMIT -->
            <div class="row input-container">
                <button class="col-12 submit" onclick="signUp()">
                    SignIn
                </button>
                <div class="col-12 neonRed form-error" id="submit-error">

                </div>
            </div>
        </div>
    </div>
    <script>
        toggleClass("wrapper");
        toggleClass("confirmWrapper");
        let validFname = false;
        let validLname = false;
        let validEmailaddress = false;
        let validPassword = false;

        function signIn(){
            let form_error = document.querySelector("#submit-error");
            form_error.innerHTML = ""
            form_error.style.display = "none";

            // Get inputs
            let emailAddress = document.querySelector("#emailAddress").value;
            let password = document.querySelector("#password").value;

            if(validFname && validLname && validEmailaddress && validPassword){
                var formdata = new FormData();
                formdata.append("emailAddress", emailAddress);
                formdata.append("password", password);

                var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
                };

                fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/auth/signIn.php", requestOptions)
                .then(response => response.text())
                .then(result => {
                    // Show success
                    const data = JSON.parse(result);
                    if(data.msg == "success"){
                        window.location.href = "https://localhost/projects/DearUniverseWTF/"
                    }else{
                        form_error.innerHTML = `<p><strong>Error:</strong><em>${data.description}</em><p>`;
                        form_error.style.display = "inline-block";
                    }
                })
                .catch(error => console.log('error', error));
            }else{
                form_error.innerHTML = "<p>Please fix all errors on the form before submitting!<p>"
                form_error.style.display = "inline-block";
            }
        }

        function validateEmailaddress(){
            
            let emailAddress = document.querySelector("#emailAddress").value;
            let emailAddress_input = document.querySelector("#emailAddress");
            let emailAddress_label = document.querySelector("#emailAddress-label");
            let emailAddress_error = document.querySelector("#emailAddress-error");

            if(!isValidEmail(emailAddress)){
                emailAddress_input.classList.remove("neonInput");
                emailAddress_input.classList.add("neonInput-error");
                emailAddress_label.classList.remove("neonpurple");
                emailAddress_label.classList.add("neonRed");
                emailAddress_error.innerHTML = "<p>Email address must contain an '@' symbol and a valid domain name, for exmaple: <em>cooldomain.com</em><p>"
                emailAddress_error.style.display = "inline-block";
                validEmailaddress = false;
            }else{
                emailAddress_input.classList.add("neonInput");
                emailAddress_input.classList.remove("neonInput-error");
                emailAddress_label.classList.add("neonpurple");
                emailAddress_label.classList.remove("neonRed");
                emailAddress_error.innerHTML = "";
                emailAddress_error.style.display = "none";
                validEmailaddress = true;
            }
        }
        function validatePassword(){
            
            let password = document.querySelector("#password").value;
            let password_input = document.querySelector("#password");
            let password_label = document.querySelector("#password-label");
            let password_error = document.querySelector("#password-error");
                console.log(isValidPassword(password));
            if(!isValidPassword(password)){
                password_input.classList.remove("neonInput");
                password_input.classList.add("neonInput-error");
                password_label.classList.remove("neonpurple");
                password_label.classList.add("neonRed");
                password_error.innerHTML = "<p>Password must contain a number, a special character and have a length of more than 10 characters<p>"
                password_error.style.display = "inline-block";
                validPassword = false;
            }else{
                password_input.classList.add("neonInput");
                password_input.classList.remove("neonInput-error");
                password_label.classList.add("neonpurple");
                password_label.classList.remove("neonRed");
                password_error.innerHTML = "";
                password_error.style.display = "none";
                validPassword = true;
            }
        }
    </script>
</body>
</html>