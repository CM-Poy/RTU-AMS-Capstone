<html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <style type="text/css">
    #bg{
    background-image: url("loginregbg.png");
    height: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    }

    #card{ 
      margin-left: 770px;
      margin-top: -470px;
      padding-right: -500px;

     
    }
    .univ{
      text-shadow: 2px 2px black;
      font-family: Sans-serif;
      font-size: 40px;
      padding-left: 50px;
      margin-top: -20px;
      margin-left: -40px;
     
    }
    .univ2{
      text-shadow: 2px 2px black;
      font-family: Sans-serif;
      font-size: 40px;
      padding-left: 430px;
      margin-top:-95px;
     
    }
     .twofa{
      text-shadow: 2px 2px black;
      font-family: Sans-serif;
      font-size: 20px;
      padding-left: 432px;
      margin-top: -30px}
      

      html{
        overflow-x: hidden;
        overflow-y: hidden;
      }
      #logo{
        padding-top: 330px;
        display: flex;
        align-items: center;
        margin-left: 250px;

      }
      .cardcolor{
        background-color: #194F90;
        size: 50px;
      }
      .reghere{
        color: #DAA520;
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


  </style>

  <body>

        <section id="bg" class=" gradient-custom">
          <div id="logo">
           <img src="rtu_logo.png"> <p class="univ text-white">  Rizal Technological University</p></div>
            <p class="univ2 text-white"> Attendance Management System</p>
            <p class="twofa text-white">With Two-Factor Authentication</p>


  <form action= "php/includes/function.php" method= "post">      


        <div class="container py-5 h-20">
          <div  class="">
            <div id="card" class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="cardcolor text-white" style="border-radius: 1rem; height: 740px; padding-top: -100;">
                <div class="card-body p-5">

                  <div class="inputspace1">
                    <div class="form-outline form-white mb-4">
                      <label class="form-label">FIRST NAME</label>
                      <input type="Username" name="fname" id="typeEmailX" class="form-control form-control-lg" />

                      <div class="inputspace2">
                    <div class="form-outline form-white mb-4">
                      <label class="form-label">LAST NAME</label>
                      <input type="Username" name="lname" id="typeEmailX" class="form-control form-control-lg" />
                      
                      <div class="inputspace3">
                    <div class="form-outline form-white mb-4">
                      <label class="form-label">SCHOOL ID</label>
                      <input type="number" name="schoolid" id="typeEmailX" class="form-control form-control-lg" />

                    </div>
                    <div class="inputspace4">
                    <div class="form-outline form-white mb-4">
                      <label class="form-label" >CONTACT NO.</label>
                      <input type="number" name="cnum" id="typeEmailX" class="form-control form-control-lg" />

                    </div>
                    </div>
                    <div class="inputspace5">
                    <div class="form-outline form-white mb-4">
                      <label class="form-label" for="typeEmailX">EMAIL</label>
                      <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg" />


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

                    <center><button class="btn btn-outline-light btn-lg px-5" name="sumbitreg" type="submit">REGISTER</button></center>
                  
                  

                  <div>
                    <center><p class="mb-0">Already have an account? <a href="login-index.html" class="reghere">Log In Here</a></center>
                    </p>
                  </div>
      </div>
      </div>
      </div>

    </form>
</section>

  </body>
</html>