<?php
    require_once "../../globals.php";

    class auth{

        private $service;
        private $auth_service;

        function __construct($service,$auth_service) {
            $this->service = $service;
            $this->auth_service = $auth_service;
        }

        public function signUp($fName,$lName,$emailAddress,$memberType,$password){
            $userExistsresult = json_decode(auth::validateSignup($emailAddress));
            if($userExistsresult->msg == "success"){
                $auth = $this->auth_service->createAuth();
                $createMembershipresult = json_decode(auth::createMembership($memberType));

                if($createMembershipresult->msg == "success"){
                    $newMembershipid = $createMembershipresult->data[0]->membership_id;
                    $newMembershipuid = $createMembershipresult->data[0]->membership_uid;
                    $createMemberresult = json_decode(auth::createMember($fName,$lName,$emailAddress,$newMembershipuid));

                    if($createMemberresult->msg == "success"){
                        $newMemberid = $createMemberresult->data[0]->member_id;
                        $updateMembershipresult = json_decode(auth::updateMembershipuser($newMemberid,$newMembershipid));

                        if($updateMembershipresult->msg == "success"){
                            try{
                                $user_metadata = [
                                    'name' => "$fName $lName",
                                    'email' => $emailAddress
                                ];
                                $auth->createUserWithEmailAndPassword($emailAddress, $password, $user_metadata);
                                $data = $auth->data();

                                http_response_code(200);
                                return json_encode(array("msg"=>"success", "data"=>$data));
                                // echo "TEST5";
                            }
                            catch(Exception $e){
                                auth::returnError($auth->getError());
                                // echo "TEST".$auth->getError();
                            }
                        }else{
                            auth::returnError($updateMembershipresult->description);
                            // echo "TEST1";
                        }
                    }else{
                        auth::returnError($createMemberresult->description);
                        // echo "TEST2";
                    }
                }else{
                    auth::returnError(json_encode($createMembershipresult));
                    // echo "TEST3".json_encode($createMembershipresult);
                }
            }else{
                // auth::returnError("A member with this email address already exists!");
                http_response_code(200);
                return json_encode(array("msg"=>"failed", "description"=>"A member with this email address already exists!"));
            }
        }
        
        public function signIn($emailAddress,$password){
            $auth = $this->auth_service->createAuth();
            try{
                $auth->signInWithEmailAndPassword($email, $password);
                // Get the returned data generated by request
                $data = $auth->data(); 
            
                if(isset($data[0]->access_token)){
                    // Get the user data
                    $userData = $data[0]->user;
    
                    // Create JWT
                    // Get the token, first name and last name
                    $token = $auth->getUser($data[0]->access_token);
                    $name = $token->user_metadata[0]->name;
                    $name = explode(" ", $name);
                    $f_name = $name[0];
                    $l_name = $name[1];
                    $email = $token->email;
    
                    $_GLOBALS['token'] = $data[0]->access_token;
    
                    // Get user ID
                    $uid = db_control::getUserid($service,$email);
    
                    if($uid =="failed"){
                        http_response_code(200);
                        echo json_encode(array("msg"=>"failed", "description" => "Could not find user with email: $email"));
                        exit;
                    }else{
                        http_response_code(200);
                        echo json_encode(array("msg"=>"success", "token"=>$token, "access_token"=>$data[0]->access_token));
                        exit;
                    }
                }else{
                    http_response_code(200);
                    echo json_encode(array("msg"=>"failed", "description" => "Token not set"));
                    exit;
                }
            }
            catch(Exception $e){
                http_response_code(200);
                echo json_encode(array("msg"=>"failed","description"=>$auth->getError()));
                exit;
            }
        }

        public function validateUserbyId($memberId){
            $db = $this->service->initializeDatabase('members', 'member_id');

            try{
                $data = $db->findBy("member_id",$memberId)->getResult();
                if(empty($data)){
                    return auth::returnError("Could not find user");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                return auth::returnError($e->getMessage());
            }
        }
        private function validateSignup($emailAddress){
            $db = $this->service->initializeDatabase('members', 'member_id');

            try{
                $data = $db->findBy("member_email_address",$emailAddress)->getResult();
                if(empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>"No existing members found"));
                    exit;
                }else{
                    return auth::returnError("Found a member with this email address");
                }
            }
            catch(Exception $e){
                return auth::returnError($e->getMessage());
            }
        }

        private function createMember($fName,$lName,$emailAddress,$membershipUid){
            $db = $this->service->initializeDatabase('members', 'member_id');

            $newMember = [
                'member_first_name' => $fName,
                'member_last_name' => $lName,
                'member_email_address' => $emailAddress,
                'membership_uid' => $membershipUid,
            ];
            
            try{
                $data = $db->insert($newMember);
                if(empty($data)){
                    return auth::returnError("Could not create membership");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                return auth::returnError($e->getMessage());
            }
        }
        private function createMembership($memberType){
            $db = $this->service->initializeDatabase('memberships', 'membership_id');
            $membershipUid = auth::generateMembershipUid();
            $startDate = date("Y-m-d H:i:s.u");

            $newMember = [
                'membership_uid' => $membershipUid,
                'membership_status' => 'active',
                'membership_type' => $memberType,
                'membership_start_date' => $startDate
            ];
            
            try{
                $data = $db->insert($newMember);
                if(empty($data)){
                    return auth::returnError("Could not create membership");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                }
            }
            catch(Exception $e){
                return auth::returnError($e->getMessage());
            }
        }
        private function updateMembershipuser($memberId,$membershipId){
            $db = $this->service->initializeDatabase('memberships', 'membership_id');

            $updateMembershipuser = [
                'member_id' => $memberId,
            ];
            
            try{
                $data = $db->update($membershipId, $updateMembershipuser);
                if(!empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                }else{
                    return auth::returnError("Could not update membership");
                }
            }
            catch(Exception $e){
                return auth::returnError($e->getMessage());
            }
        }
        private function generateMembershipUid(){
            $key = "DUWTF";
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
        
            // Generate a random string of length 5
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            // Combine the key and the random string
            $uid = $key . $randomString;

            // Check if UID already exists
            $checkExistsresult = json_decode(auth::findNumberofRecordsBy("members","member_id","membership_uid",$uid));
            
            if($checkExistsresult->msg == "failed"){

                return json_encode(array("msg"=>"success","data"=>$uid));

            }else{
                auth::generateMembershipUid();
            }
        }

        private function findNumberofRecordsBy($tableName,$tablePK,$column,$equalsValue){
            $db = $this->service->initializeDatabase($tableName, $tablePK);

            try{
                $data = $db->findBy("$column", "$equalsValue")->getResult(); //Searches for products that have the value "PlayStation 5" in the "productname" column
                if(empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed","description"=>"Could not find record specified"));
                    exit;
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>count($data)));
                    exit;
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }
        }

        private function returnError($description){
            http_response_code(200);
            return json_encode(array("msg"=>"failed","description"=>"$description"));
            exit;
        }
    }
?>