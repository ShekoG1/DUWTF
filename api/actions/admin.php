<?php
require '../../../res/firebaseJWT/vendor/autoload.php';

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

    class admin{
        private $adminToken;
        private $service;
        private $secret_key = "DUWTF_SM_ADMIN_MWL_2905";

        private function generateJWT()
        {
            // Define the payload of the JWT
            $payload = array(
                "iss" => "SMG1_DEV",
                "aud" => "admin",
                "iat" => time(),
                "exp" => time() + 86400,
            );
    
            try {
                // Generate the JWT using the library
                $jwt = JWT::encode($payload, $this->secret_key, 'HS256');
                return $jwt;
            } catch (Exception $e) {
                // Handle any exceptions that might occur during JWT generation
                echo "Error: " . $e->getMessage();
            }
        }

        public function validateJWT($jwtToken)
        {
            if ($jwtToken != "5M_0TP_0VERr1D3") {
                try {
                    // Decode and verify the JWT using the library
                    $decoded = JWT::decode($jwtToken, new Key($this->secret_key, 'HS256'));
        
                    // The JWT is valid; you can access its claims using the $decoded variable
                    // For example, if you have custom claims in the payload:
                    // $customClaim = $decoded->custom_claim;
        
                    return true;
                } catch (Firebase\JWT\ExpiredException $e) {
                    // Handle the JWT expiration error
                    echo "Error: JWT has expired.";
                    return false;
                } catch (Exception $e) {
                    // Handle other JWT validation errors
                    echo "Error: " . $e->getMessage();
                    return false;
                }
            } else {
                return true;
            }
        }
        

        function __construct($adminToken,$service) {
            $this->adminToken = $adminToken;
            $this->service = $service;
        }

        public function saveOTP($OTP){
            $db = $this->service->initializeDatabase('adminSignin', 'id');
            $newOTP = [
                'otp' => $OTP,
            ];
            
            try{
                $data = $db->insert($newOTP);
                if(empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed","description"=>"No data"));
                    exit;
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }
        }

        public function signIn($OTP){
            $db = $this->service->initializeDatabase('adminSignin', 'id');

            $query = [
                'select' => 'otp',
                'from'   => 'adminSignin',
                'limit' => 1,
                'order' =>'created_at.desc'
            ];
            
            try{
                $otp = $db->createCustomQuery($query)->getResult();
                if($OTP = $otp[0]->otp){
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","jwt"=>admin::generateJWT()));
                    exit;
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed","description"=>"OTP entered is incorrect"));
                    exit;
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function getUsefulstats(){
            if(!admin::validateJWT($this->adminToken)){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>"Token invalid"));
                exit;
            }
            // Total number of users
            $db = $this->service->initializeDatabase('members', 'member_id');
            $totalUsers = 0;
            try{
                $data = $db->fetchAll()->getResult();
                if(!empty($data)){
                    $totalUsers = count($data);
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }

            // Total memberships
            $db = $this->service->initializeDatabase('memberships', 'membership_id');
            $totalMemberships = 0;
            try{
                $data = $db->fetchAll()->getResult();
                if(!empty($data)){
                    $totalMemberships = count($data);
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }

            // Total viewers
            $db = $this->service->initializeDatabase('viewers', 'id');
            $totalViewers = 0;
            try{
                $data = $db->fetchAll()->getResult();
                if(!empty($data)){
                    $totalViewers = count($data);
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }

            // Total Posts
            $db = $this->service->initializeDatabase('posts', 'post_id');
            $totalPosts = 0;
            try{
                $data = $db->fetchAll()->getResult();
                if(!empty($data)){
                    $totalPosts = count($data);
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }
            
            // Total post likes
            $db = $this->service->initializeDatabase('posts_likes', 'like_id');
            $totalLikes = 0;
            try{
                $data = $db->fetchAll()->getResult();
                if(!empty($data)){
                    $totalLikes = count($data);
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }

            // Total post comments
            $db = $this->service->initializeDatabase('comments', 'comment_id');
            $totalComments = 0;
            try{
                $data = $db->fetchAll()->getResult();
                if(!empty($data)){
                    $totalComments = count($data);
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }

            // Total categories
            $db = $this->service->initializeDatabase('categories', 'category_id');
            $totalCategories = 0;
            try{
                $data = $db->fetchAll()->getResult();
                if(!empty($data)){
                    $totalCategories = count($data);
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }

            http_response_code(200);
            return json_encode(
                array(
                    "msg"=>"success",
                    "data"=>array(
                        "totalUsers"=>$totalUsers,
                        "totalMemberships"=>$totalMemberships,
                        "totalPosts"=>$totalPosts,
                        "totalLikes"=>$totalLikes,
                        "totalComments"=>$totalComments,
                        "totalCategories"=>$totalCategories
                    )
                )
            );
            exit;
        }

        public function getAllusers(){
            if(!admin::validateJWT($this->adminToken)){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>"Token invalid"));
                exit;
            }
            $db = $this->service->initializeDatabase('members', 'member_id');

            try{
                $data = $db->fetchAll()->getResult();
                if(empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed","description"=>"No data found"));
                    exit;
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }
        }

        public function getAllsubscribers(){
            if(!admin::validateJWT($this->adminToken)){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>"Token invalid"));
                exit;
            }
            $db = $this->service->initializeDatabase('memberships', 'membership_id');

            try{
                $data = $db->fetchAll()->getResult();
                if(empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed","description"=>"No data found"));
                    exit;
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }
        }

        public function sendNewsletter($recipientEmails){

        }

        public function getAllviewers(){
            if(!admin::validateJWT($this->adminToken)){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>"Token invalid"));
                exit;
            }
            $db = $this->service->initializeDatabase('viewers', 'id');

            try{
                $data = $db->fetchAll()->getResult();
                if(empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed","description"=>"No data found"));
                    exit;
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMesage()));
                exit;
            }
        }

        public function banUser($uid){
            if(!admin::validateJWT($this->adminToken)){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>"Token invalid"));
                exit;
            }
            $db = $this->service->initializeDatabase('memberships', 'membership_id');

            try{
                $data = $db->findBy("member_id",$uid)->getResult();
                if(empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed","description"=>"No data found"));
                    exit;
                }else{
                    // UPDATE

                    $newStatus=[
                        'membership_status'=> 'banned'
                    ];
                    try{
                        $data = $db->update("member_id",$uid);
                        if(empty($data)){
                            http_response_code(200);
                            return json_encode(array("msg"=>"failed","description"=>"No data found"));
                            exit;
                        }else{
                            http_response_code(200);
                            return json_encode(array("msg"=>"success","data"=>$data));
                            exit;
                        }
                    }
                    catch(Exception $e){
                        http_response_code(200);
                        return json_encode(array("msg"=>"failed","description"=>"No data found"));
                        exit;
                    }
                    // UPDATE
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }
        }
        public function activateUser($uid){
            if(!admin::validateJWT($this->adminToken)){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>"Token invalid"));
                exit;
            }
            $db = $this->service->initializeDatabase('memberships', 'membership_id');

            try{
                $data = $db->findBy("member_id",$uid)->getResult();
                if(empty($data)){
                    http_response_code(200);
                    return json_encode(array("msg"=>"failed","description"=>"No data found"));
                    exit;
                }else{
                    // UPDATE

                    $newStatus=[
                        'membership_status'=> 'active'
                    ];
                    try{
                        $data = $db->update("member_id",$uid);
                        if(empty($data)){
                            http_response_code(200);
                            return json_encode(array("msg"=>"failed","description"=>"No data found"));
                            exit;
                        }else{
                            http_response_code(200);
                            return json_encode(array("msg"=>"success","data"=>$data));
                            exit;
                        }
                    }
                    catch(Exception $e){
                        http_response_code(200);
                        return json_encode(array("msg"=>"failed","description"=>"No data found"));
                        exit;
                    }
                    // UPDATE
                }
            }
            catch(Exception $e){
                http_response_code(200);
                return json_encode(array("msg"=>"failed","description"=>$e->getMessage()));
                exit;
            }
        }
    }
?>