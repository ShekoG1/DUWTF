<?php
    require_once "../../globals.php";

    class categories{

        private $service;

        function __construct($service) {
            $this->service = $service;
        }

        public function getAllcategories(){
            $db = $this->service->initializeDatabase('categories', 'category_id');

            try{
                $data = $db->fetchAll()->getResult();
                if(empty($data)){
                    return returnError("Could not create membership");
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
        public function createCategory($title){
            $db = $this->service->initializeDatabase('categories', 'category_id');
            $newCategory = [
                'category_name' => $title,
            ];
            
            try{
                $data = $db->insert($newCategory);
                if(empty($data)){
                    return returnError("Could not create category");
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
        public function renameCategory($categoryId, $categoryNewname){
            $db = $this->service->initializeDatabase('categories', 'category_id');
            $updateCategory = [
                'category_name' => $categoryNewname,
            ]; 
            
            try{
                $data = $db->update($categoryId, $updateCategory);
                if(empty($data)){
                    return returnError("Could not create category");
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