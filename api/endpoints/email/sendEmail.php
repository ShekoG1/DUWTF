<?php
    require 'PhPMailer/vendor/autoload.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    function sendOTPmail(){
        $generated_password = generateRandomString(5);

        $mail = new PHPMailer;
        // $mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.theshekharmaharaj.com;atlas.ondedicated.hosting';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'hello@theshekharmaharaj.com';                 // SMTP username
        $mail->Password = '$H3K0GOne';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                // TCP port to connect to
        
        $mail->setFrom('hello@theshekharmaharaj.com', 'Shekhar Maharaj');
        $mail->addAddress("shekharmaharaj2905@gmail.com", "Shekhar Maharaj"); 
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Your Sign-in Request';
        $mail->Body    = "Hi there<br/><br/>Your OTP is:<br/><br/><span style='font-size:4rem'>$generated_password</span><br/><br/>";

        if(!$mail->send()) {
            return false;
        } else {
            return $generated_password;
        }
        $mail->SmtpClose();
    }
    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>