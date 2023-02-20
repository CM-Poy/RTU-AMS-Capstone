<?php
session_start();
require_once('php/includes/config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTER</title>
    <style>

body{
    background-image: url("loginregbg.png");
    background-size: cover;
    background-repeat: no-repeat;
}



.cardcolor{
    background-image: linear-gradient(to right, #12608E, #218DCB);


}
.col-sm-6{
      text-shadow: 2px 2px 5px black;
      font-family: Sans-serif;
      font-size: 25px;
      color: white;

}
#whole{
    margin-top: 35px;


}
{
    font-size: 10px;
}
.twofa{
    font-size: 12px;

}
.forg{
    color: white;
}
.inputspace1{
        margin-top: -30px;
        margin-left: -30px;
        margin-right: -30px;
      }
      .inputspace2{
        margin-top: 7px;
      }
      .inputspace3{
        margin-top: 7px;
      }
      .inputspace4{
        margin-top: -16px;
      }
      .inputspace4{
        margin-top: -16px;
      }
      .inputspace5{
        margin-top: -16px;
      }
      .inputspace6{
        margin-top: 7px;

      }
      .inputspace7{
        margin-top: -17px;
        margin-bottom: -20px;
      }
      .btn{
      margin-top: -5px;
      margin-bottom: 10px;

     }
     .loghere{
    color: yellow;
}



    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <form action= "php/includes/function.php" method= "post">

            <div id="whole" class="container h-100">
          <div class="row ">
            <div class="col-sm-2 my-auto">
              <img class="rtu-Logo" src="rtu_logo.png" >
            </div>
            <div class="col-sm-6 my-auto">
              RIZAL TECHNOLOGICAL UNIVERSITY<br>
              ATTENDANCE MANAGEMENT SYSTEM<br>
              <p class="twofa">WITH TWO-FACTOR AUTHENTICATION</p>
            </div>
            <div class="col-sm-4 my-auto">
                <div class="cardcolor text-white" style="border-radius: 1rem; height: 750px; width: 400px;">
                  <div class="card-body p-5">

                  <?php
                    if(isset($errors) && count($errors) > 0){
                      foreach($errors as $error_msg){
                        echo '<div class="alert alert-danger">'.$error_msg.'</div>';
                      }
                    }

                    if(isset($success)){
                        echo '<div class="alert alert-success">'.$success.'</div>';
                      }
                  ?>

                    <div class="inputspace1">
                      <div class="form-outline form-white mb-4">
                        <label class="form-label">FIRST NAME</label>
                        <input type="text" name="fname" id="typeEmailX" class="form-control form-control-lg" />

                        <div class="inputspace2">
                      <div class="form-outline form-white mb-4">
                        <label class="form-label">LAST NAME</label>
                        <input type="text" name="lname" id="typeEmailX" class="form-control form-control-lg" />

                        <div class="inputspace3">
                      <div class="form-outline form-white mb-4">
                        <label class="form-label">SCHOOL ID</label>
                        <input type="text" name="schoolid" id="typeEmailX" class="form-control form-control-lg" placeholder="Ex: 2028-104574" />

                      </div>
                      <div class="inputspace4">
                      <div class="form-outline form-white mb-4">
                        <label class="form-label" >CONTACT NO.</label>
                        <input type="text" name="cnumber" id="typeEmailX" class="form-control form-control-lg" max="11" min="11" />

                      </div>
                      </div>
                      <div class="inputspace5">
                      <div class="form-outline form-white mb-4">
                        <label class="form-label" for="typeEmailX">EMAIL</label>
                        <input type="text" name="email" id="typeEmailX" class="form-control form-control-lg" placeholder="@gmail.com" />


                          <div class="inputspace6">
                            <div class="form-outline form-white mb-4">
                              <label class="form-label">PASSWORD</label>
                              <input type="password" name="pwd" id="typeEmailX" class="form-control form-control-lg" />

                            </div>

                      <div class="inputspace7">
                      <div class="form-outline form-white mb-4">
                        <label class="form-label" for="typePasswordX">CONFIRM PASSWORD</label>
                        <input type="password" name="pwdrepeat" id="typePasswordX" class="form-control form-control-lg" />
                      </div>

                      <center><button class="btn btn-outline-light btn-lg px-5" name="submitreg" type="submit">REGISTER</button></a></center>
                      <div>
                      <center><p class="mb-0">Already have an account? <a href="login-index.php" class="loghere">Log in Here</a></center>
                      </p>

        </div>




            </div>
          </div>
        </div>


            </div>

  </form>

</body>
</html>
