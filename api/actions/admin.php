<?php
    class admin{
        private $adminToken;

        function __construct($adminToken) {
            $this->adminToken = $adminToken;
        }

        public function getUsefulstats(){

        }

        public function getAllusers(){

        }

        public function getAllsubscribers(){

        }

        public function sendNewsletter($recipientEmails){

        }

        public function getAllviewers(){

        }

        public function banUser($uid){

        }

        public function blockUser($uid,$toDate){

        }

        private function validateToken(){

        }
    }
?>