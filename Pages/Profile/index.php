<?php
    $cookieSet;
    if(isset($_COOKIE['DUWTF_USER'])){
        $user = json_decode($_COOKIE['DUWTF_USER']);
        $userId = $user->token->uid;
        $name = explode(" ",$user->token->name);
        $fName = $name[0];
        $lName = $name[1];
        $emailAddress = $user->token->email;
        $cookieSet = true;
    
        // GET USER INFO
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/auth/validateUserbyId.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('userId' => $userId),
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);
        
        if($response->msg == "success"){
            $createdAt = $response->data[0]->created_at;
        }else{
            $createdAt = "Could not find data";
        }
    }else{
        $userId = -1;
        $cookieSet = false;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="./../../res/bootstrap/css/bootstrap.css">
    <script src="./../../res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../../style/globals.css">
    <link rel="stylesheet" href="./../../style/nav.css">
    <link rel="stylesheet" href="./../../style/profile.css">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row profile-detail-container">
                    <div class="col-12 profile-detail neonBlue">
                        <h1>Profile</h1>
                    </div>
                </div>
                <div class="row profile-detail-container">
                    <div class="col-12 profile-detail-label neonPink">
                        First Name:
                    </div>
                    <div class="col-12 profile-detail neonBlue">
                        <?php echo $fName; ?>
                    </div>
                </div>
                <div class="row profile-detail-container">
                    <div class="col-12 profile-detail-label neonPink">
                        Last Name:
                    </div>
                    <div class="col-12 profile-detail neonBlue">
                    <?php echo $lName; ?>
                    </div>
                </div>
                <div class="row profile-detail-container">
                    <div class="col-12 profile-detail-label neonPink">
                        Email Address:
                    </div>
                    <div class="col-12 profile-detail neonBlue">
                    <?php echo $emailAddress; ?>
                    </div>
                </div>
                <!-- <div class="row profile-detail-container">
                    <div class="col-12 profile-detail-label">
                        User Type
                    </div>
                    <div class="col-12 profile-detail">
                        <?php #echo $fName; ?>
                    </div>
                </div> -->
                <div class="row profile-detail-container">
                    <div class="col-12 profile-detail-label neonPink">
                        Signed Up
                    </div>
                    <div class="col-12 profile-detail neonBlue">
                        <?php
                            $tempDate = new DateTime($createdAt);
                            $tempDate = $tempDate->format('F j, Y \a\t H:i:s');
                            echo $tempDate;
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row profile-detail-container" id="danger-zone">
                    <div class="col-12 danger-zone neonRed">DANGER ZONE</div>
                    <div class="col-12 danger-detail">
                        <button class="neonInput-error playRed">
                            Change Email Address
                        </button>
                    </div>
                    <div class="col-12 danger-detail">
                        <button class="neonInput-error playRed">
                            Reset Password
                        </button>   
                    </div>
                    <div class="col-12 danger-detail">
                        <button class="neonInput-error playRed">
                            Delete Account
                        </button>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include "../../components/footer.php"
    ?>

    <script>
        const cookieSet = <?php echo $cookieSet; ?>;
        if(!cookieSet){
            window.location.href = "http://localhost/projects/DearUniverseWTF/";
        }
        setProfile(<?php echo $cookieSet; ?>);
    </script>
</body>
</html>