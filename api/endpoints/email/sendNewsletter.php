<?php
    require "../../globals.php";
    require "../../actions/email.php";

    // Declarations
    $recipientEmails = $_POST['recipientEmails'];

    // Validations
    if(empty($recipientEmails)){
        throwError("User Id cannot be empty");
    }

    $userId = trim($recipientEmails);

    $email = new email($phpMailer,$fromEmail);

    $result = $email->sendNewsletter($userId,$postId);

    echo $result;
?>