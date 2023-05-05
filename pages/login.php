<!DOCTYPE html>
<html lang="en">

<?php 



include('includes/header.php'); 
require('includes/config.php');

if(isset($_POST['btnLogin'])){
    include('includes/functions.php');
    $obj=new dbfunction();
    $obj->login($_POST['instEmail'],$_POST['pwd']);
    }

if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = false;
}

?>
  
<head>
    <link rel='icon' href='../images/rtu-logo.png'/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Log in page</title>
</head>
<body>

    <section class="side">
        <img src="../images/rtu-logo.png" alt="">
    </section>
    
    <section class="main">
        <div class="login-container">
            <p class="title">ATTENDANCE MANAGEMENT SYSTEM</p>
            <div class="separator"></div>
            <p class="welcome-message">Provide Registered Credentials</p>
                    <?php if ($_SESSION['error']): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo $_SESSION['error'];?></strong>
                        </div>
                        <?php   
                            $_SESSION['error'] = false;
                        ?>
                    <?php endif ?>
            <form class="login-form" method="post">
                <div class="form-control">
                    <input type="text" name="instEmail" placeholder="Instituitional Email">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="password" name="pwd" placeholder="Password">
                    <i class="fas fa-lock"></i>
                </div>

                <button name="btnLogin" class="submit"  type="submit">Log in</button>
            </form>
        </div>
    </section>
    
</body>
</html>