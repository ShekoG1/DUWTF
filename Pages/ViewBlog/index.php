<?php
    $postId = explode("-",$_POST['id'])[1];
    // $colorHex = $_POST['colorHex'];
    // $user = $_COOKIE['DUWTF_USER'];
    // $userId = $user->id;

    // TEST
    $userId = 1;
    // END TEST
    
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
    <link rel="stylesheet" href="./../../style/globals.css">
    <link rel="stylesheet" href="./../../style/view.css">
    <!-- JAVASCRIPT -->
    <link rel="stylesheet" href="./../../js/globals.js">
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
                <div id="make-comment">
                    <input type="text" placeholder="Leave your comment here..." id="comment">
                    <button onclick="makeComment()">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-send" viewBox="0 0 16 16"> <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/> </svg>
                        </i>
                    </button>
                </div>
                <?php
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/components/message_container.php',
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
    <script>
        function makeComment(){
            let comment = 
            var formdata = new FormData();
            formdata.append("userId", <?php echo $userId; ?>);
            formdata.append("postId", <?php echo $postId; ?>);
            formdata.append("comment", comment);

            var requestOptions = {
            method: 'POST',
            body: formdata,
            redirect: 'follow'
            };

            fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/posts/makeComment.php", requestOptions)
            .then(response => response.text())
            .then(result => {
                response = JSON.parse(result);
                if(response.msg == "success"){
                    showSuccess("<p>Comment added successfully</p>")
                    sleep(3000);
                    window.location.reload();
                }else{
                    showError("<p>Could not add comment!</p>")
                }
            })
            .catch(error => {
                showError(`<p>Error: ${error}</p>`)
            });
        }
    </script>
</body>
</html>