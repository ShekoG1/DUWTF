<?php
    class admin{
        private $adminToken;
        private $service;

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
            $db = $service->initializeDatabase('adminSignin', 'id');

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
                    return json_encode(array("msg"=>"success","data"=>"No data to return"));
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

        public function sendNewsletter($recipientEmails){

        }

        public function getAllviewers(){
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

        private function validateToken(){

        }
    }
?>