
<?php
    $postCurl = curl_init();
    
    curl_setopt_array($postCurl, array(
      CURLOPT_URL => 'https://duwtf-de7cb1deecd8.herokuapp.com/api/endpoints/posts/getLatest4posts.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST'
    ));
    
    $postResponse = json_decode(curl_exec($postCurl));
    
    curl_close($postCurl);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUWTF</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="res/bootstrap/css/bootstrap.css">
    <script src="res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="style/landing.css">
</head>
<body>
    <div class="col-12" id="nav">
        <?php
            if(isset($_COOKIE['DUWTF_USER'])){
                echo <<<EOD
                    <a class="nav-item boxBlue neonRed" href="Pages/Profile/">Profile</a>
                EOD;
            }else{
                echo <<<EOD
                    <span class="nav-item"><a class="authLink neonRed" href="Pages/SignUp/">SignUp</a>/<a class="authLink neonBlue" href="Pages/SignIn">SignIn</a></span>
                EOD;    
            }
        ?>
        <a class="nav-item boxPink playPink" href="Pages/Home/">Home</a>
        <a class="nav-item boxLime playLime" href="Pages/ViewBlog/Latest/">Latest Post</a>
        <a class="nav-item boxRed playRed" href="#">Contact Me</a>
    </div>
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-6 row">
                <div class="col-12 row" id="logo-container">
                    <div class="col-12 boxPink" id="logo">
                        <span class="D_U neonPink">Dear Universe...</span><br/>
                        <span class="WTF neonPink">WTF???</span>
                    </div>
                </div>
                <div class="col-12 neonText" id="about">
                    <p>Join me as I share details of my crazy day to day activities...</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6 row">

                <?php
                $postNumbercount = 0;
                    foreach($postResponse->data as $post){
                        $postNumbercount++;
                        $data = json_encode($post);
                        echo <<<EOD
                        <div class="col-lg-5 col-md-12 col-sm-12 sticky-note-container">
                            <div class="sticky-note boxBlue playBlue">
                                <div class="number-container">
                                    0$postNumbercount.
                                </div>
                                <div class="blog-title">
                                    <h5>$post->post_title</h5>
                                </div>
                            </div>
                        </div>
                        EOD;
                    }
                
                ?>

                <!--<div class="col-lg-5 col-md-12 col-sm-12 sticky-note-container">
                    <div class="sticky-note boxRed playRed">
                        <div class="number-container">
                            01.
                        </div>
                        <div class="blog-title">
                            <h5>Cudddle with the cat</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-sm-12 sticky-note-container">
                    <div class="sticky-note boxBlue playBlue">
                        <div class="number-container">
                            02.
                        </div>
                        <div class="blog-title">
                            <h5>Latest blog </h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-sm-12 sticky-note-container">
                    <div class="sticky-note boxPurple playPurple">
                        <div class="number-container">
                            03.
                        </div>
                        <div class="blog-title">
                            <h5>Latest blog </h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-12 col-sm-12 sticky-note-container">
                    <div class="sticky-note boxLime playLime">
                        <div class="number-container">
                            04.
                        </div>
                        <div class="blog-title">
                            <h5>Latest blog </h5>
                        </div>
                    </div>
                </div>-->

            </div>
        </div>
    </div>
    <?php
        include "./components/footer.php"
    ?>
</body>
</html>