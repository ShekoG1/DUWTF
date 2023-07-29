<?php
    require "../../globals.php";
    require "../../actions/email.php";

    // Declarations
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    // Validations
    if(empty($to)){
        throwError("Send-to list cannot be empty");
    }
    if(empty($subject)){
        throwError("Subject cannot be empty");
    }
    if(empty($body)){
        throwError("Body cannot be empty");
    }

    $email = new email();

    $result = $email->sendNewsletter($to, $subject, $body);

    echo $result;
?>