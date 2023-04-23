<!DOCTYPE html>
<html lang="en">

  <?php include('admin/header.php'); 
    require('includes/config.php');
    ?>
  
<head>
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
            <form class="login-form">
                <div class="form-control">
                    <input type="text" placeholder="Instituitional Email">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="password" placeholder="Password">
                    <i class="fas fa-lock"></i>
                </div>

                <button href="#" class="submit"  >Log in</button>
            </form>
        </div>
    </section>
    
</body>
</html>