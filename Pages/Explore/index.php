<?php
// GET ALL POSTS

// Declarations

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $postTitle ?></title>
</head>
<body>
    <?php
        // CURL to get nav
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
            <div id="postPreview">
                <div id="image-container">

                </div>
                <div id="written-content">

                </div>
                <div id="comments">
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>