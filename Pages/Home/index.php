<?php

    //Declarations
    // $categoryId = $_POST['categoryId']; 
    $categoryId = 1;

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
            <form action="./../ViewBlog/" method="post" id="latest_post" class="col-sm-12 col-md-7 col-lg-7">
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
                            $content .= '... <input type="submit" class="read-more" value="Read More">';
                            echo $content;
                        }else{
                            echo $contentRaw;
                        }
                    ?>
                    </div>
                </div>
                <div id="post-interactions">
                    <div id="post-comments">
                        <i><img src="../../assets/icons/comment-text.svg" alt="comment icon" width="25"></i>Comments (<?php echo $postComments; ?>)
                    </div>
                    <div id="post-likes">
                        <i><img src="../../assets/icons/hand-thumbs-up-fill.svg" alt="Likes icon" width="25"></i> Likes (<?php echo $postLikes ?>)
                    </div>
                </div>

                <ad>
                    
                </ad>
            </form>
            <div class="col-sm-12 col-md-5 col-lg-5">
                <h2>Previous Posts:</h2>
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
                                </li>
                                EOD;
                            }

                        }

                    ?>
                </ul>

            </div>
        </div>
    </div>
</body>
</html>