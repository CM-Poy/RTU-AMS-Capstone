<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CODE VERIFICATION</title>
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
.spacing{
        margin-top: -20px;
        margin-left: -30px;
        margin-right: -30px;
        margin-bottom: -20px;
      }
      .spacing2{
        margin-top: 10px;
        margin-bottom: 10px;
      }
      label{
        margin-bottom: 0px;
      }
      .btn{
        margin-top: 10px;
        margin-bottom: 10px;
      }
      .phone{
        padding-left: 200px;
        padding-right: -50px;
        padding-top: 90px;
        font-size: 10px;

      }
      .res{
        padding-left:230px ;
        color: red;
        padding-top: 50px;
        

      }
      .phonetxt{
        color: white;
      }
      #tb{
        margin-top: 50px;

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


<div class="spacing2">
                <label class="form-label">CODE HAS BEEN SENT TO:</label>
              </div>
              <div>
                <center><p><b><a class="res" href="#!">RESEND</a></p></center></b>
                <input type="CODE" id="tb" class="form-control form-control-lg" />
              </div>

              
              <center><a href="dash.php"><button class="btn btn-outline-light btn-lg px-5" type="submit">CONFIRM</button></center>
              </a>
              <div class="phone text-white">
              <p><a class="phonetxt" href="#!"><b>USE PHONE NUMBER</a></p></b></div>
              
              

        
 </div>
    </div>
  </div>
</div>
    
        
    </div>


</body>
</html>