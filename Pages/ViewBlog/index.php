<?php
    $postId = explode("-",$_POST['id'])[1];
    $categoryId = !empty($_POST['categoryId']) ? $_POST['categoryId'] : 1; 
    $color = ucwords($_POST['color']);
    $cookieSet;
    if(isset($_COOKIE['DUWTF_USER'])){
        $user = json_decode($_COOKIE['DUWTF_USER']);
        $userId = $user->token->uid;
        $cookieSet = true;
    }else{
        $userId = -1;
        $cookieSet = false;
    }
    
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
$postCreated = $postResponsedata[0]->created_at;

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
    <link rel="stylesheet" href="./../../style/nav.css">
    <link rel="stylesheet" href="./../../style/view.css">
    <!-- JAVASCRIPT -->
    <script src="./../../js/globals.js"></script>
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
    <form action="../Home" method="post">
        <!-- <input type="text" id="hdn-frm-color" name="color"> -->
        <input type="number" id="hdn-frm-catid" name="categoryId">
        <input type="submit" id="hdn-frm-sbmt">
    </form>
    <div class="container-fluid">
        <div class="row" id="content">
            <div id="post" class="col-12 row box<?php echo $color;?>">
                <h1 class="col-12 neon<?php echo $color; ?>" id="title"><?php echo $postTitle; ?></h1>
                <span class="col-12 play<?php echo $color; ?>" id="created-at">
                    <?php
                        $tempDate = new DateTime($postCreated);
                        $tempDate = $tempDate->format('F j, Y \a\t H:i:s');

                        echo $tempDate;
                    ?>
                </span>
                <div class="col-12 neon" id="written-content">
                    <?php
                        echo $postContent;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <h2 class="col-12 neon<?php echo $color;?>">Comments (<?php echo $postComments; ?>)</h2>
            <div class="col-sm-12 col-md-12 col-lg-6" id="comments">
                <div id="make-comment">
                    <textarea type="text" class="neonInput" placeholder="Leave your comment here..." id="comment"></textarea>
                    <button onclick="makeComment()">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" id="sendSVG" width="36" height="36" fill="white" class="bi bi-send" viewBox="0 0 16 16"> <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/> </svg>
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
                                <div class="comment">
                                    <div class="made-by play$color">
                                        $comment->member_id
                                    </div>
                                    <div class="comment-text play$color">
                                        $comment->comment
                                    </div>
                                    <div class="comment-created play$color">
                                    Created: $tempDate
                                    </div>
                                </div>
                            EOD;
                        }
                    }else{
                        echo "<h3 class='play$color'>Nothing to see here...yet!</h3>";
                    }
                ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6" id="logo">
                    <h1 class="neon<?php echo $color; ?>">Dear Universe...WTF???</h1>
            </div>
        </div>
    </div>
    <?php
        include "../../components/footer.php"
    ?>
    <script>
        function makeComment(){
            let comment = document.querySelector("#comment").value;
            var formdata = new FormData();
            let userId = <?php echo $userId?>;

            if(userId != "" && userId != -1){
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
            }else{
                alert("You are not logged in! Please login to comment");
            }
        }
        setProfile(<?php echo $cookieSet; ?>);
    </script>
</body>
</html>