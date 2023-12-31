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
            if(json_decode(auth::validateSignup($emailAddress))->msg == "success"){
                $auth = $this->auth_service->createAuth();
                try{
                    // Create user in Auth table and get returned uuid
                    $user_metadata = [
                        'name' => "$fName $lName",
                        'email' => $emailAddress,
                    ];
                    $auth->createUserWithEmailAndPassword($emailAddress, $password, $user_metadata);
                    $data = $auth->data();
                    $uuid = $data->id;
                    // Create member in members table, and validate that the record has been created
                    $createMemberresult = json_decode(auth::createMember($fName,$lName,$emailAddress,$uuid));
                    if($createMemberresult->msg == "success"){
                        // Create membership in the memberships table, and validate that the record has been created
                        $createMembershipresult = json_decode(auth::createMembership($memberType,$uuid,$createMemberresult->data[0]->member_id));
                        if($createMembershipresult->msg == "success"){
                            http_response_code(200);
                            return json_encode(array("msg"=>"success", "data"=>$data));
                        }else{
                            http_response_code(200);
                            return json_encode(array("msg"=>"failed", "description"=>"Could not create membership", "error"=>$createMembershipresult));
                        }
                    }else{
                        http_response_code(200);
                        return json_encode(array("msg"=>"failed", "description"=>"Could not create member", "error"=>$createMemberresult));
                    }
                }
                catch(Exception $e){
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed", "description"=>$auth->getError()));
                }
            }else{
                http_response_code(200);
                return json_encode(array("msg"=>"failed", "description"=>"A member with this email address already exists!"));
            }
        }
        
        public function signIn($emailAddress,$password){
            $auth = $this->auth_service->createAuth();
            try{
                $auth->signInWithEmailAndPassword($emailAddress, $password);
                // Get the returned data generated by request
                $data = $auth->data(); 
            
                if(isset($data->access_token)){
                    // Get the user data
                    $userData = $data->user;
    
                    // Create JWT
                    $token = $auth->getUser($data->access_token);
                    $name = $token->user_metadata->name;
                    $name = explode(" ", $name);
                    $f_name = $name[0];
                    $l_name = $name[1];
                    $emailAddress = $token->email;
                    $uid = $token->id;

                    http_response_code(200);
                    echo json_encode(array(
                        "msg"=>"success",
                        "data"=>array(
                            "jwt"=>$data->access_token,
                            "token"=>$token->user_metadata,
                            "uid" =>$uid
                        ),
                    ));
                    exit;
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
        public function deleteUser($userToDelete,$token){
            // Attempt to remove the user
            // DELETE FUNCTION NOT AVAILABLE IN PHP SUPABASE
            // INSTEAD UPDATE EMAIL TO NULL
            $auth = $this->auth_service->createAuth();
            
            try{
                //the parameters 2 (email) and 3(password) are null because this data will not be changed
                $data = $auth->updateUser($token, "null@duwtf.co.za", "NULL_DUWTF_", ['null'=>'user_deleted']);
                return json_encode($data); // show all user data returned
            }
            catch(Exception $e){
                return $auth->getError();
            }

            // Remove the user from users table
            return auth::removeUser($userToDelete);
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
        private function createMembership($memberType, $uuid, $memberId){
            $db = $this->service->initializeDatabase('memberships', 'membership_id');
            $startDate = date("Y-m-d H:i:s.u");

            $newMember = [
                'member_id' => $memberId,
                'membership_status' => 'active',
                'membership_uid' => $uuid,
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
        private function updateUID($user_id,$membership_id, $uuid){
            // Update Membership table
            $db = $this->service->initializeDatabase('memberships', 'membership_id');

            $updateMembershipuser = [
                'membership_uid' => $uuid,
            ];
            
            try{
                $data = $db->update($membership_id, $updateMembershipuser);
                if(!empty($data)){
                    // Update users table
                    $db = $this->service->initializeDatabase('members', 'member_id');

                    $updateMemberuser = [
                        'membership_uid' => $uuid,
                    ];
                    
                    try{
                        $data = $db->update($user_id, $updateMemberuser);
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

        private function removeUser($userToDelete){
            $db = $this->service->initializeDatabase('members', 'member_id');

            try{
                $data = $db->findBy("membership_uid", "$userToDelete")->getResult();
                if(!empty($data)){
                    try{
                        $data = $db->delete($data[0]->member_id);
                        if(!empty($data)){
                            http_response_code(200);
                            return json_encode(array("msg"=>"failed","description"=>"Could not find record specified"));
                            exit;
                        }else{
                            http_response_code(200);
                            return json_encode(array("msg"=>"failed","description"=>"Could not delete member"));
                            exit;
                        }
                    }catch(Exception $e){
                        http_response_code(200);
                        return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                        exit;
                    }
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>"No Member with that UID found"));
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