<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../../style/globals.css">
    <!-- JAVASCRIPT -->
    <script src="./../../js/globals.js"></script>
</head>
<style>
    .container{
        padding: 100px;
        height: 100%;
    }
    body{
        background-image: url("../../assets/leaves.jpg");
        background-attachment:fixed;
        background-position: right;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-color: black;
    }
    .content{
        display:flex;
        justify-content: center;
        align-items:center;
    }
    .content h1{
        font-size: 70px;
    }
    .content p {
        text-align: center;
        font-size: 50px;
    }

</style>
<body>
    <div class="container">
        <div class="heading content">
            <h1 class="neonText">You signed up!</h1>
        </div>
        
        <div class="message content">
            <p class="neonText">Congrats on signing up for the coolest blog ever!<br/>You may now sign in <a class="neonBlue" href="https://duwtf-de7cb1deecd8.herokuapp.com/Pages/SignIn">here</a></p>
        </div>
    </div>
    <?php
        include "../../components/footer.php"
    ?>
</body>
</html>