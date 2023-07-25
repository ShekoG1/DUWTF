<?php
    session_start();

    if(
        empty($_POST['char1']) ||    
        empty($_POST['char2']) ||    
        empty($_POST['char3']) ||
        empty($_POST['char4']) ||    
        empty($_POST['char5'])
    ){
    // Throw Error
    echo "failed";
    }else{
        // Validate OTP
        $correctOtp = str_split($_SESSION['otp']);

        if(
            $_POST['char1'] == $correctOtp[0] &&
            $_POST['char2'] == $correctOtp[1] &&
            $_POST['char3'] == $correctOtp[2] &&
            $_POST['char4'] == $correctOtp[3] &&
            $_POST['char5'] == $correctOtp[4] 
        ){
            // Return Success
            echo "success";
        }else{
            // Return Error
            echo "failed1";
        }
    }

    session_destroy();
?>