<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
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
            <h1 class="neonPurple">Sign Up</h1>
            <!-- FIRST NAME -->
            <div class="row input-container">
                <div class="col-12 neonPink form-label" id="fName-label">
                    First Name:
                </div>
                <div class="col-12 form-input">
                    <input type="text" id="fName" class="neonInput" onchange="validateFname()">
                </div>
                <div class="col-12 neonRed form-error" id="fName-error">

                </div>
            </div>
            <!-- LAST NAME -->
            <div class="row input-container">
                <div class="col-12 neonPink form-label" id="lName-label">
                    Last Name:
                </div>
                <div class="col-12 form-input">
                    <input type="text" id="lName" class="neonInput" onchange="validateLname()">
                </div>
                <div class="col-12 neonRed form-error" id="lName-error">

                </div>
            </div>
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
            <div class="row input-container">
                <div class="col-12 neonPink form-label" id="confirmPassword-label">
                    Confirm Password:
                </div>
                <div class="col-12 form-input passwordInputcontainer">
                    <input type="password" id="confirmPassword" class="neonInput" placeholder="Confirm Your Password" onchange="validateConfirmpassword()">
                    <div id="confirmWrapper" class="eye-open">
                        <div id="icon-eye" onclick="togglePassword(true)">
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
                <div class="col-12 neonRed form-error" id="confirmPassword-error">

                </div>
            </div>

            <!-- SUBMIT -->
            <div class="row input-container">
                <button class="col-12 submit" onclick="signUp()">
                    Confirm
                </button>
                <div class="col-12 neonRed form-error" id="submit-error">

                </div>
                <div class="col-12 neonBlue" id="opposite-auth">
                    <p>Or you can <a href="http://localhost/projects/DearUniverseWTF/Pages/SignIn">Signin here</a></p>
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

        function signUp(){
            let form_error = document.querySelector("#submit-error");
            form_error.innerHTML = ""
            form_error.style.display = "none";

            // Get inputs
            let fName = document.querySelector("#fName").value;
            let lName = document.querySelector("#lName").value;
            let emailAddress = document.querySelector("#emailAddress").value;
            let password = document.querySelector("#password").value;
            let confirmPassword = document.querySelector("#confirmPassword").value;

            if(validFname && validLname && validEmailaddress && validPassword){
                var formdata = new FormData();
                formdata.append("fName", fName);
                formdata.append("lName", lName);
                formdata.append("emailAddress", emailAddress);
                // formdata.append("memberType", "regular");
                formdata.append("password", password);

                var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
                };

                fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/auth/signUp.php", requestOptions)
                .then(response => response.text())
                .then(result => {
                    // Show success
                    const data = JSON.parse(result);
                    if(data.msg == "success"){
                        document.querySelector("#form").innerHTML = `
                            <h1 class="neonBlue">Check Your Mail!</h1>
                            <div class="row input-container">
                                <div class="col-12 neonGreen form-label" id="fName-label">
                                    <h2 class="neonBlue">The Next Step</h2>
                                    <p class="neonBlue">An email has been sent to <strong><em>shekharmaharaj2905@gmail.com</em></strong>. Please click on the link provided in that email to confirm your account.</p>
                                    <p class="neonBlue">Once your account is confirmed, you may then <strong><em>Signin</em></strong> using the email and password you entered previously.</p>
                                    <h3 class="neonBlue">Thankyou for joining!</h3>
                                </div>
                            </div>
                        `;
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

        function validateFname(){
            
            let fName = document.querySelector("#fName").value;
            let fName_input = document.querySelector("#fName");
            let fName_label = document.querySelector("#fName-label");
            let fName_error = document.querySelector("#fName-error");

            if(!nameIsvalid(fName)){
                fName_input.classList.remove("neonInput");
                fName_input.classList.add("neonInput-error");
                fName_label.classList.remove("neonpurple");
                fName_label.classList.add("neonRed");
                fName_error.innerHTML = "<p>First name cannot contain any numbers or special characters!<p>"
                fName_error.style.display = "inline-block";
                validFname = false;
            }else{
                fName_input.classList.add("neonInput");
                fName_input.classList.remove("neonInput-error");
                fName_label.classList.add("neonpurple");
                fName_label.classList.remove("neonRed");
                fName_error.innerHTML = "";
                fName_error.style.display = "none";
                validFname = true;
            }
        }
        function validateLname(){
            
            let lName = document.querySelector("#lName").value;
            let lName_input = document.querySelector("#lName");
            let lName_label = document.querySelector("#lName-label");
            let lName_error = document.querySelector("#lName-error");

            if(!nameIsvalid(lName)){
                lName_input.classList.remove("neonInput");
                lName_input.classList.add("neonInput-error");
                lName_label.classList.remove("neonpurple");
                lName_label.classList.add("neonRed");
                lName_error.innerHTML = "<p>Last name cannot contain any numbers or special characters!<p>"
                lName_error.style.display = "inline-block";
                validLname = false;
            }else{
                lName_input.classList.add("neonInput");
                lName_input.classList.remove("neonInput-error");
                lName_label.classList.add("neonpurple");
                lName_label.classList.remove("neonRed");
                lName_error.innerHTML = "";
                lName_error.style.display = "none";
                validLname = true;
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
        function validateConfirmpassword(){
            
            let password = document.querySelector("#password").value;
            let confirmPassword = document.querySelector("#confirmPassword").value;
            let confirmPassword_input = document.querySelector("#confirmPassword");
            let confirmPassword_label = document.querySelector("#confirmPassword-label");
            let confirmPassword_error = document.querySelector("#confirmPassword-error");

            if(confirmPassword != password){
                confirmPassword_input.classList.remove("neonInput");
                confirmPassword_input.classList.add("neonInput-error");
                confirmPassword_label.classList.remove("neonpurple");
                confirmPassword_label.classList.add("neonRed");
                confirmPassword_error.innerHTML = "<p>Password does not match your previous password entry<p>"
                confirmPassword_error.style.display = "inline-block";
                validPassword = false;
            }else{
                confirmPassword_input.classList.add("neonInput");
                confirmPassword_input.classList.remove("neonInput-error");
                confirmPassword_label.classList.add("neonpurple");
                confirmPassword_label.classList.remove("neonRed");
                confirmPassword_error.innerHTML = "";
                confirmPassword_error.style.display = "none";
                validPassword = true;
            }

        }
    </script>
</body>
</html>