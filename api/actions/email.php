<?php
    require "../../endpoints/email/PhPMailer/vendor/autoload.php";

    class email{

        private $mailer;

        function __construct() {
            $this->mailer = new PHPMailer\PHPMailer\PHPMailer();
        }

        public function sendNewsletter($to, $subject, $body)
        {

            $_HEADER = "
                <div style='border:1px solid white; padding:20px; color:white;'>
                    <table>
                        <tr>
                            <td>
                                <h3>Dear Universe...WTF?</h3>
                                <h1>$subject</h1>
                            </td>
                        <tr>
                    </table>
                </div>
                <div>
            ";
            $_FOOTER = "
                </div>
                <div>
                    <table>
                        <tr>
                            <td>Dear Universe...WTF?</td>
                        <tr>
                    </table>
                </div>
            ";

            try {
                // Server settings
                $this->mailer->SMTPDebug = 3;  
                $this->mailer->isSMTP();
                $this->mailer->Host       = 'mail.theshekharmaharaj.com;atlas.ondedicated.hosting'; // Your SMTP server host
                $this->mailer->SMTPAuth   = true; // Enable SMTP authentication
                $this->mailer->Username   = 'hello@theshekharmaharaj.com'; // SMTP username
                $this->mailer->Password   = '$H3K0GOne'; // SMTP password
                $this->mailer->SMTPSecure = 'tls'; // Enable TLS encryption; `ssl` also accepted
                $this->mailer->Port       = 587; // TCP port to connect to, typically 587
    
                // Sender details
                $this->mailer->setFrom('hello@theshekharmaharaj.com', 'Shekhar Maharaj');
    
                // Recipient
                if (is_array($to)) {
                    foreach ($to as $recipient) {
                        $this->mailer->addAddress($recipient);
                    }
                } else {
                    $this->mailer->addAddress($to);
                }
    
                // Email content
                $this->mailer->isHTML(true);
                $this->mailer->Subject = $subject;
                $this->mailer->Body    = $body;
    
                if ($this->mailer->send()) {
                    return json_encode(array('msg'=>'success'));
                } else {
                    return json_encode(array('msg'=>'failed'));
                }
            } catch (Exception $e) {
                return json_encode(array('msg'=>'failed', 'description'=>$e));
            }
        }
    }
?>