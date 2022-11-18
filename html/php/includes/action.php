<?php
require_once 'config.php';
require_once 'function.php';
global $conn;


class signupErrorHandlers{

        public function errorHandlers(){

          if(isset($_POST["submitreg"])){

            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $schoolid = $_POST["schoolid"];
            $cnumber = $_POST["cnumber"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            $pwdRepeat = $_POST["pwdrepeat"];


            global $conn;
            $sql= "SELECT * FROM users WHERE email =:email";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':email'=>$email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($fname) || empty($lname) || empty($email) || empty($schoolid) || empty($cnumber) || empty($pwd) || empty($pwdRepeat)) {

                echo '
                <style>
                .error{
                  margin-top: -40px;
                  margin-left: -30px;
                  margin-right: -30px;
                  color:red;
                  background-color: #25a5be;
                }
                </style>

                <div class="error">
                  <label class="form-label">Please fill up the form.</label>
                </div><br>';

            }elseif (!preg_match("/^[a-zA-Z\s]+$/",$fname) || !preg_match("/^[a-zA-Z\s]+$/",$lname)) {

                echo '
                <style>
                .error{
                  margin-top: -40px;
                  margin-left: -30px;
                  margin-right: -30px;
                  color:red;
                  background-color: #25a5be;
                }
                </style>

                <div class="error">
                  <label class="form-label">Please enter a valid name.</label>
                </div><br>';

            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){

                echo '
                <style>
                .error{
                  margin-top: -40px;
                  margin-left: -30px;
                  margin-right: -30px;
                  color:red;
                  background-color: #25a5be;
                }
                </style>

                <div class="error">
                  <label class="form-label">Please enter a valid email.</label>
                </div><br>';

            }elseif ($pwd !== $pwdRepeat) {

                echo '
                <style>
                .error{
                  margin-top: -40px;
                  margin-left: -30px;
                  margin-right: -30px;
                  color:red;
                  background-color: #25a5be;
                }
                </style>

                <div class="error">
                  <label class="form-label">Passwords dont match.</label>
                </div><br>';

            }elseif	(strlen($pwd) < 8) {

                echo '
                <style>
                .error{
                  margin-top: -40px;
                  margin-left: -30px;
                  margin-right: -30px;
                  color:red;
                  background-color: #25a5be;
                }
                </style>

                <div class="error">
                  <label class="form-label">Please enter a password with a minimum of 8 characters.</label>
                </div><br>';

            }elseif($stmt->rowCount() > 0){

                if($email == $row['email']){

                    echo '
                    <style>
                    .error{
                      margin-top: -40px;
                      margin-left: -30px;
                      margin-right: -30px;
                      color:red;
                      background-color: #25a5be;
                    }
                    </style>

                    <div class="error">
                      <label class="form-label">Please enter a valid email.</label>
                    </div><br>';
                  }

            }else{
                signup($fname,$lname,$schoolid,$cnumber,$email,$pwd);
            }
          }
        }
      }





if(isset($_POST["submitlog"])){

    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    if (empty($email) || empty($pwd)) {
        // echo "empty input!"
        header("location: ../login-index.php?error=emptyinput");

    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        // echo "invalid email!"
        header("location: ../login-index.php?error=invalidemail");

    }else{
          login($email,$pwd);

    }
}


if(isset($_POST["delclass"])){

  $idclass=$row["idclass"];
  delClass();
}



if(isset($_POST["submitaddclass"])){

  $subname = $_POST["subname"];
  $subcode = $_POST["subcode"];
  $sectcode = $_POST["sectcode"];
  $day = $_POST["day"];

  $fromtime = $_POST["fromtime"];
  $totime = $_POST["totime"];

addClass($subname, $subcode, $sectcode, $day, $time);
}







?>
