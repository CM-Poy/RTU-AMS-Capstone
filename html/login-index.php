<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOG IN</title>
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
    margin-top: 200px;
    

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
.reghere{
    color: yellow;
}



    </style>

    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div id="whole" class="container h-100">
  <div class="row ">
    <div class="col-sm-2 my-auto">
      <img class="rtu-Logo rounded mx-auto d-block " src="rtu_logo.png" >
    </div>
    <div class="col-sm-6 my-auto ">
      RIZAL TECHNOLOGICAL UNIVERSITY<br>
      ATTENDANCE MANAGEMENT SYSTEM<br>
      <p class="twofa">WITH TWO-FACTOR AUTHENTICATION</p>
    </div>
    <div class="col-sm-4 my-auto">
        <div class="cardcolor text-white" style="border-radius: 1rem; height:420px; width: 400px;">
          <div class="card-body p-5">


            <div class="spacing">
              <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeEmailX">EMAIL</label>
                <input  type="email" id="typeEmailX" class="form-control form-control-lg" placeholder="@gmail.com" required />

              </div>

              <div class="spacing2">
                <label class="form-label" for="typePasswordX" >PASSWORD</label>
                <input type="password" id="typePasswordX" class="form-control form-control-lg" required  />
              </div><br>

              <center><a href="auth-email.php"><button class="btn color-white btn-outline-light btn-lg px-5">Login</button></center></a>
              <center><p><a class="forg" href="#!">Forgot password?</a></p></center>

            <div>
              <center><p class="mb-0">Don't have an account Yet? <a href="signup-index.php" class="reghere">Register Here</a></center>
              </p>

</div>
    </div>
  </div>
</div>
    
        
    </div>


</body>
</html>