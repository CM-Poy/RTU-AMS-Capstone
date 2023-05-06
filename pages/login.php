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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/css_admin/adminstyle.css">
    <link rel="stylesheet" href="../../css/css_admin/tableadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../css/css_front/frontstyle.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    <?php if ($_SESSION['error']): ?>
                           <!-- Error Message HTML -->
                           <div class="validation"> 
                            <strong><?php echo $_SESSION['error'];?></strong>
                        </div>
                               <!-- End Error Message HTML -->
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