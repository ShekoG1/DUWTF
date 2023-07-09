<?php

    //Declarations
    $categoryId = !empty($_POST['categoryId']) ? $_POST['categoryId'] : 1; 
    $cookieSet;
    if(isset($_COOKIE['DUWTF_USER'])){
        $cookieSet = true;
    }else{
        $cookieSet = false;
    }

    // Get the latest post
    $latestPostcurl = curl_init();

    curl_setopt_array($latestPostcurl, array(
    CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/posts/getLatestpost.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array("categoryId" => $categoryId),
    ));

    $latestPostresponse = curl_exec($latestPostcurl);

    curl_close($latestPostcurl);
    $latestPostsdata = json_decode($latestPostresponse);
    $latestPosts;
    if($latestPostsdata->msg == "success"){
        $latestPosts = $latestPostsdata->data[0];
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
      CURLOPT_POSTFIELDS => array('postId' => $latestPosts->post_id),
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
      CURLOPT_POSTFIELDS => array('postId' => $latestPosts->post_id),
    ));
    
    $postCommentresponse = curl_exec($postCommentcurl);
    
    curl_close($postCommentcurl);
    $postCommentdata = json_decode($postCommentresponse);
    if($postCommentdata->msg == "success"){
        $postComments = count($postCommentdata->data);
    }else{
        $postComments = 0;
    }
    
    // Get 10 latest posts
    $latest10Postscurl = curl_init();
    
    curl_setopt_array($latest10Postscurl, array(
      CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/posts/getLatest10postsPercategory.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('categoryId' => $categoryId),
    ));
    
    $latest10PostscurlResponse = curl_exec($latest10Postscurl);
    
    curl_close($latest10Postscurl);
    
    $latest10Postsdata = json_decode($latest10PostscurlResponse);
    $latest10Posts;
    if($latest10Postsdata->msg == "success"){
        $latest10Posts = $latest10Postsdata;
    }else{
        $latest10Posts = null;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUWTF</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="./../../res/bootstrap/css/bootstrap.css">
    <script src="./../../res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../../style/globals.css">
    <link rel="stylesheet" href="./../../style/nav.css">
    <link rel="stylesheet" href="./../../style/home.css">
    <!-- JAVASCRIPT -->
    <script src="./../../js/globals.js"></script>
</head>
<body onload="setActive()">

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
    <div class="container-fluid" id="content">
        <form action="" method="post">
            <!-- <input type="text" id="hdn-frm-color" name="color"> -->
            <input type="number" id="hdn-frm-catid" name="categoryId">
            <input type="submit" id="hdn-frm-sbmt">
        </form>
        <div class="row">
            <form action="./../ViewBlog/" method="post" id="latest_post" class="col-sm-12 col-md-7 col-lg-7">
                <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>">
                <input type="hidden" class="hdn-frm-color" name="color">
                <input type="hidden" id="id" name="id" value="DUWTF-<?php echo $latestPosts->post_id ?>">
                <div id="post-details">
                    <div id="post-uploaded">
                        Uploaded:<?php
                        $date = new DateTime($latestPosts->created_at);
                        echo $date->format('F j, Y \a\t H:i:s'); ?>
                    </div>
                    <div id="post-title">
                        <?php
                            echo $latestPosts->post_title
                        ?>
                    </div>
                    <div id="post-content">
                    <?php
                        // strip tags to avoid breaking any html
                        $contentRaw = strip_tags($latestPosts->post_content);
                        $lengthOfcontent = strlen($contentRaw);
                        $maxLengthtoShow = $lengthOfcontent/100*25;
                        if (strlen($contentRaw) > $maxLengthtoShow) {
                            // truncate string
                            $contentCut = substr($contentRaw, 0, $maxLengthtoShow);
                            $endPoint = strrpos($contentCut, ' ');

                            //if the string doesn't contain any space then it will cut without word basis.
                            $content = $endPoint? substr($contentCut, 0, $endPoint) : substr($contentCut, 0);
                            $content .= '... <input type="submit" class="read-more neonBlue" value="Read More">';
                            echo $content;
                        }else{
                            echo $contentRaw;
                        }
                    ?>
                    </div>
                </div>
                <div id="post-interactions">
                    <div id="post-comments">
                        <i>
                        <svg id="comment-icon" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 512 512"> <path fill="var(--ci-primary-color, currentColor)" d="M496,496H448.771L379.249,368H40a24.028,24.028,0,0,1-24-24V40A24.028,24.028,0,0,1,40,16H472a24.028,24.028,0,0,1,24,24ZM48,336H398.284L464,456.993V48H48Z" class="ci-primary"/> </svg>
                        </i>Comments (<?php echo $postComments; ?>)
                    </div>
                    <div id="post-likes">
                        <i>
                        <svg id="like-icon" xmlns="http://www.w3.org/2000/svg" width="35" height="35" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                        </i> Likes (<?php echo $postLikes ?>)
                    </div>
                </div>

                <ad>
                    
                </ad>
            </form>
            <div class="col-sm-12 col-md-5 col-lg-5">
                <h2 id="previous-posts-heading">Previous Posts:</h2>
                <ul id="previous-posts-container">
                    <?php
                    
                        if($latest10Posts == null){
                            echo "<li class='duwtf-error'>Could not find any posts!</li>";
                        }else{

                            foreach ($latest10Posts->data as $post) {
                                $tempDate = new DateTime($post->created_at);
                                $tempDate = $tempDate->format('F j, Y \a\t H:i:s');

                                echo <<<EOD
                                <li>
                                    <form action="./../ViewBlog/" method="post" onclick="viewPreviouspost($post->post_id)">
                                        <input type="hidden" class="hdn-frm-color" name="color">
                                        <input type="hidden" id="id" name="id" value="DUWTF-$post->post_id">
                                        <input type="submit" class="hdn-submit" id="DUWTF-POST-$post->post_id">
                                        <div class="previous-post">
                                            <div class="previous-post-title">
                                                $post->post_title
                                            </div>

                                            <div class="previous-post-info">
                                            Created: $tempDate
                                            </div>
                                            <div class="previous-post-interactions">
                                                <div class="previous-post-likes">
                
                                                </div>
                                                <div class="previous-posts-num-comments">
                
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                                EOD;
                            }

                        }

                    ?>
                </ul>

            </div>
        </div>
    </div>
    <script>
        function setActive(){
            // NAV
            let navItem = document.querySelector("#duwtf-category-<?php echo $categoryId;?>")
            let color = navItem.getAttribute('data-color-scheme');
            navItem.classList.add(`${color}-active`);
            // COMMENT
            let commentIcon = document.querySelector("#comment-icon");
            let postComments = document.querySelector("#post-comments");
            commentIcon.classList.add(`${color}-icon`);
            postComments.classList.add(`play${titleCase(color)}`);
            // LIKE
            let likeIcon = document.querySelector("#like-icon");
            let postLikes = document.querySelector("#post-likes");
            likeIcon.classList.add(`${color}-icon`);
            postLikes.classList.add(`play${titleCase(color)}`);
            // CREATED AT
            let createdAt = document.querySelector("#post-uploaded");
            createdAt.classList.add(`play${titleCase(color)}`);
            // PREVIOUS POSTS
            let previousPostscontainer = document.querySelector("#previous-posts-container");
            let previousPostsheading = document.querySelector("#previous-posts-heading")
            previousPostsheading.classList.add(`neon${titleCase(color)}`)
            previousPostscontainer.classList.add(`box${titleCase(color)}`);
            // PREVIEW CONTAINER
            let postDetails = document.querySelector("#post-details");
            let previousPosts = document.querySelectorAll(".previous-post");
            postDetails.classList.add(`box${titleCase(color)}`);
            for(let i = 0; i < previousPosts.length; i++){
                previousPosts[i].classList.add(`play${titleCase(color)}`);
            }
            // NEXT PAGE
            let hdn_frm_color = document.querySelectorAll(".hdn-frm-color");
            for(let i=0; i < hdn_frm_color.length; i++){
                hdn_frm_color[i].value = color;
            }
        }

        document.onload = setActive();
        setProfile(<?php echo $cookieSet; ?>);
    </script>
</body>
</html>