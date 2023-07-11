<?php

    require '../../../res/PhP Mailer/vendor/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    function sendMail($full_name,$email_address,$message,$type){
        $mail = new PHPMailer;
        if($type == "message_recieved"){
            $mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.theshekharmaharaj.com;atlas.ondedicated.hosting';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'hello@theshekharmaharaj.com';                 // SMTP username
            $mail->Password = '$H3K0GOne';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                // TCP port to connect to
        
            $mail->setFrom('hello@theshekharmaharaj.com', 'Shekhar Maharaj');
            $mail->addAddress($email_address, $full_name); 

            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Your Contact Request';
            $mail->Body    = '<span style="font-size:20px">Hello there!</span><br/>Thankyou for taking the time to view my personal website, I do hope that you are pleased with your visit. I have recieved your contact request and I will be in contact with you soon. Until then, please do have a wonderful day!<br/><br/>This is an automated response. Please do not reply to this email. For direct enquiries please email <a href="shekharmaharaj2905@gmail.com">shekharmaharaj2905@gmail.com</a><br/><br/>Kind regards,<br/>Shekhar Maharaj<br/>084 894 7990<br/>';
            $mail->AltBody = 'Hello there!

            Thankyou for taking the time to view my personal website, I do hope that you are pleased with your visit. Please note that I have recieved your contact request and I will be in contact with you soon. Until then, please do have a wonderful day!
            
            This is an automated response. Please do not reply to this email. For direct enquiries please email shekharmaharaj2905@gmail.com
            
            Kind regards,
            Shekhar Maharaj';

            if(!$mail->send()) {
                // echo 'Message could not be sent.';
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                return false;
            } else {
                // echo 'Message has been sent';
                return true;
            }
        }else{
            $mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.theshekharmaharaj.com;atlas.ondedicated.hosting';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'hello@theshekharmaharaj.com';                 // SMTP username
            $mail->Password = '$H3K0GOne';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                // TCP port to connect to

            $mail->setFrom('hello@theshekharmaharaj.com', 'Shekhar Maharaj');
            $mail->addAddress('shekharmaharaj2905@gmail.com', 'Shekhar Maharaj');

            $mail->Subject = 'You have a contact request from '.$full_name;
            $mail->Body    = 'Hello there Shekhar, you have a contact request from '.$full_name.'<br/><br/>Email: '.$email_address.'<br/><br/>Message: <br/>'.$message;
            $mail->AltBody = 'Hello there!

            You have a new contact request. Please check your admin dashboard immediately!';

            if(!$mail->send()) {
                // echo 'Message could not be sent.';
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                return false;
            } else {
                // echo 'Message has been sent';
                return true;
            }

            sleep(10);
            $mail->SmtpClose();
            sleep(10);
        }
    }
    function sendInternationalvisitorMail($country, $region, $city){
        $date = new DateTime();
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

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'You have an international visitor';
        $mail->Body    = "Hi there<br/><br/>You have an international visitor from: $country, $region, $city at ".date("F jS, Y", strtotime($date));

        if(!$mail->send()) {
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            // echo 'Message has been sent';
            return true;
        }
   

        sleep(10);
        $mail->SmtpClose();
        sleep(10);
    }
    function sendOTPmail(){
        $generated_password = generateRandomString(10);

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

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Your Sign-in Request';
        $mail->Body    = "Hi there<br/><br/>Your OTP is:<br/><br/><span style='font-size:4rem'>$generated_password</span><br/><br/>";

        if(!$mail->send()) {
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            // echo 'Message has been sent';
            // SAVE OTP TO DB
            // $db_control->saveOTP($generated_password);
            return $generated_password;
        }
   

        sleep(10);
        $mail->SmtpClose();
        sleep(10);
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