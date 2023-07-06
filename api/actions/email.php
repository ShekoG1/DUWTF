<?php
    class email{
        private $phpMailer;
        private $fromEmail;

        function __construct($phpMailer,$fromEmail) {
            $this->phpMailer = $phpMailer;
            $this->fromEmail = $fromEmail;
        }

        public function sendNewsletter(string $recipientEmails){
            
        }
    }
?>