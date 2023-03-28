<?php
session_start();
require "includes/authenticator.php";


$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $Authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}


$qrCodeUrl = $Authenticator->getQR('myPHPnotes', $_SESSION['auth_secret']);


if (!isset($_SESSION['failed'])) {
    $_SESSION['failed'] = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RTU AMS AUTHENTICATION</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <meta name="description" content="Implement Google like Time-Based Authentication into your existing PHP application. And learn How to Build it? How it Works? and Why is it Necessary these days."/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link rel='shortcut icon' href='/favicon.ico'  />
    <style>
        body,html {
            height: 100%;
        }       


        .bg { 
            /* The image used */
            background-image: url("../images/blurbg.png");
            /* Full height */
            height: 100%; 
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
           
            background-size: cover;
        }
        .header{
            font-size: 25px;
            text-align: center;
            font-family: serif;
            color: #1434A4;

        }
        #card{
            border-radius: 10px;
        }
        hr{
        position: relative;
        top: 10px;
        border: none;
        height: 1px;
        background: black;
        margin-bottom: 30px;
        }
        
    
    </style>
</head>
<body  class="bg">
    <div class="container">
        <div class="logo">
        <div class="row">
            <div class="col-md-6 offset-md-3" id="card" style="background: white; padding: 20px; box-shadow: 0px 0px 10px grey; margin-top: 60px;">
                <img src="../images/rtu-logo.png" style="width: 150px; margin-bottom: 10px;  margin-top: 0px; margin-left:190px;">
                <b><p class="header">RTU-BONI ATTENDANCE MANAGEMENT SYSTEM AUTHENTICATOR</p></b>
                <p style="font-style: italic; text-align: center;">Powered by Google Authenticator</p>
                <hr>
                <form action="admin/index.php" method="post">
                    <div style="text-align: center;">
                        <?php if ($_SESSION['failed']): ?>
                            <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> Invalid Code.
                            </div>
                            <?php   
                                $_SESSION['failed'] = false;
                            ?>
                        <?php endif ?>
                            
                            <img style="text-align: center;;" class="img-fluid" src="<?php   echo $qrCodeUrl ?>" alt="Verify this Google Authenticator"><br><br>        
                            <input type="text" class="form-control" name="code" placeholder="******" style="font-size: xx-large;width: 200px;border-radius: 5px;text-align: center;display: inline;color: #0275d8;"><br> <br>    
                            <button type="submit" class="btn btn-md btn-primary" id="ver" style="width: 200px;border-radius: 5px; background-color: #1434A4;">Verify</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>