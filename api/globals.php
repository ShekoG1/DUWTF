<?php
    require "../../../res/SupaBase_PHP/vendor/autoload.php";

    // General Queries
    $supabase_url = 'https://veokrizkmgfcbicrltjs.supabase.co/rest/v1/';
    $supabase_api_key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZlb2tyaXprbWdmY2JpY3JsdGpzIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU3Mjg5NjMsImV4cCI6MjAwMTMwNDk2M30.J50tZ2e5VOw7-i-7mqEcmjYJjD0wq6weZ96AirEbMjQ';
    $GLOBALS['service'] = new PHPSupabase\Service($supabase_api_key, $supabase_url);
    // Auth Queries
    $supabase_auth_url = 'https://veokrizkmgfcbicrltjs.supabase.co/auth/v1/';
    $GLOBALS['auth_service'] = new PHPSupabase\Service($supabase_api_key, $supabase_auth_url);

    // General Globals
    $GLOBALS['site_url'] = "localhost/projects/DearUniverseWTF/";

    // CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

    // Global functions
    function throwError($description){
        http_response_code(200);
        echo json_encode(array("msg"=>"failed","description"=>"$description"));
        exit;
    }
    function returnError($description){
        http_response_code(200);
        return json_encode(array("msg"=>"failed","description"=>"$description"));
        exit;
    }

?>