<?php
    require_once "../../globals.php";
    require_once "../../actions/auth.php";

    class posts{

        private $service;

        function __construct($service) {
            $this->service = $service;
        }

        public function getAllposts(){
            $db = $this->service->initializeDatabase('posts', 'post_id');

            try{
                $data = $db->fetchAll()->getResult();
                if(empty($data)){
                    return returnError("Could not find posts");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function getPostbyId($postId){
            $db = $this->service->initializeDatabase('posts', 'post_id');

            try{
                $data = $db->findBy("post_id",$postId)->getResult();
                if(empty($data)){
                    return returnError("Could not find posts");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function getPostbyCategory($categoryId){
            $db = $this->service->initializeDatabase('posts', 'post_id');

            try{
                $data = $db->findBy("category_id",$categoryId)->getResult();
                if(empty($data)){
                    return returnError("Could not find posts");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function getLatestpost($categoryId){
            $query = $this->service->initializeQueryBuilder();

            try{
                $data = $query->select('*')
                            ->from('posts')
                            ->where('category_id','eq.'.$categoryId)
                            ->order('created_at.desc')
                            ->range('0-0')
                            ->execute()
                            ->getResult();
      
                return json_encode(array("msg"=>"success","data"=>$data));            
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function get4Latestposts(){
            $query = $this->service->initializeQueryBuilder();

            try{
                $data = $query->select('*')
                            ->from('posts')
                            ->order('created_at.desc')
                            ->range('0-3')
                            ->execute()
                            ->getResult();
      
                return json_encode(array("msg"=>"success","data"=>$data));            
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function getLatest10postsPercategory($categoryId){
            $query = $this->service->initializeQueryBuilder();

            try{
                $data = $query->select('*')
                            ->from('posts')
                            ->where('category_id','eq.'.$categoryId)
                            ->order('created_at.desc')
                            ->range('0-10')
                            ->execute()
                            ->getResult();
      
                return json_encode(array("msg"=>"success","data"=>$data));            
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function makeComment($userId,$postId,$comment){

            $db = $this->service->initializeDatabase('comments', 'comment_id');
            $newComment = [
                'comment' => $comment,
                'member_id' => $userId,
                'post_id' => $postId,
            ];
            
            try{
                $data = $db->insert($newComment);
                if(empty($data)){
                    return returnError("Could not create comment");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function likePost($memberId, $postId){
            $db = $this->service->initializeDatabase('posts', 'post_id');
            $likeDb = $this->service->initializeDatabase('post_likes', 'like_id');

            // Find post
            try{
                $data = $db->findBy("post_id",$postId)->getResult();
                /*
                If the post does not exist, then we do not add a row.
                */
                if(!empty($data)){

                    // Check if user has already liked this post

                    $query = [
                        'select' => 'post_id',
                        'from'   => 'post_likes',
                        'where' => 
                        [
                            'member_id' => "eq.$memberId"
                        ]
                    ];
                    
                    try{
                        $existingRows = $likeDb->createCustomQuery($query)->getResult();
                    }
                    catch(Exception $e){
                        echo $e->getMessage();
                    }

                    if(empty($existingRows)){
                        // Update post
                        $newLike = [
                            'member_id' => $memberId,
                            'post_id'=> $postId
                        ];
                        
                        try{
                            $data = $likeDb->insert($newLike);
                            if(empty($data)){
                                return returnError("Could not add like");
                            }else{
                                http_response_code(200);
                                return json_encode(array("msg"=>"success","data"=>$data));
                                exit;
                            }
                        }
                        catch(Exception $e){
                            return returnError($e->getMessage());
                        }
                    }else{
                        return returnError("A row with this post id and member id already exists. You cannot like a post twice");
                    }
                }else{
                    return returnError("Could not find post");
                }
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function getPostlikes($postId){
            $db = $this->service->initializeDatabase('post_likes', 'like_id');

            try{
                $data = $db->findBy("post_id",$postId)->getResult();
                if(empty($data)){
                    return returnError("Could not find posts");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
        public function getPostcomments($postId){
            $db = $this->service->initializeDatabase('comments', 'comment_id');

            try{
                $data = $db->findBy("post_id",$postId)->getResult();
                if(empty($data)){
                    return returnError("Could not find posts");
                }else{
                    http_response_code(200);
                    return json_encode(array("msg"=>"success","data"=>$data));
                    exit;
                }
            }
            catch(Exception $e){
                return returnError($e->getMessage());
            }
        }
    }
?>