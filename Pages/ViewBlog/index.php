<?php
    $postId = explode("-",$_POST['id'])[1];
    
    // Get Post
    $postCurl = curl_init();
    
    curl_setopt_array($postCurl, array(
      CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/posts/getPostbyId.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('postId' => $postId),
    ));
    
    $postResponse = json_decode(curl_exec($postCurl));
    
    curl_close($postCurl);
    $postResponsedata;
    if($postResponse->msg == "success"){
        $postResponsedata = $postResponse->data;
    }else{
        $postResponsedata = null;
    }

    // Get post likes
    $postLikecurl = curl_init();
    
    curl_setopt_array($postLikecurl, array(
      CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/posts/getPostlikes.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('postId' => $postId),
    ));
    
    $postLikeresponse = curl_exec($postLikecurl);
    
    curl_close($postLikecurl);
    $postLikedata = json_decode($postLikeresponse);
    if($postLikedata->msg == "success"){
        $postLikes = count($postLikedata->data);
    }else{
        $postLikes = 0;
    }

    // Get post comments
    $postCommentcurl = curl_init();
    
    curl_setopt_array($postCommentcurl, array(
      CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/posts/getPostcomments.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('postId' => $postId),
    ));
    
    $postCommentresponse = curl_exec($postCommentcurl);
    
    curl_close($postCommentcurl);
    $postCommentdata = json_decode($postCommentresponse);
    if($postCommentdata->msg == "success"){
        $postComments = count($postCommentdata->data);
    }else{
        $postComments = 0;
    }

// Declarations
$postTitle = $postResponsedata[0]->post_title;
$postContent = $postResponsedata[0]->post_content;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $postTitle ?></title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="./../../res/bootstrap/css/bootstrap.css">
    <script src="./../../res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../../style/global.css">
    <link rel="stylesheet" href="./../../style/landing.css">
    <link rel="stylesheet" href="./../../style/home.css">
</head>
<body>
    <?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/components/nav.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    ?>
    <div class="container-fluid">
        <div class="row">
            <h1><?php echo $postTitle; ?></h1>
            <div id="written-content">
                <?php
                    echo $postContent;
                ?>
            </div>
            <div id="comments">
                <h2>Comments (<?php echo $postComments; ?>)</h2>
                <?php
                    if($postComments > 0){
                        foreach ($postCommentdata->data as $comment) {
                            $tempDate = new DateTime($comment->created_at);
                            $tempDate = $tempDate->format('F j, Y \a\t H:i:s');

                            echo <<<EOD
                            <li>
                                <div class="comment">
                                    <div class="comment-text">
                                        $comment->comment
                                    </div>

                                    <div class="comment-created">
                                    Created: $tempDate
                                    </div>
                                </div>
                            </li>
                            EOD;
                        }
                    }else{
                        echo "<h3>Nothing to see here...yet!</h3>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>