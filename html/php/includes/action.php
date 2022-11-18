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




class classTableView {


  public function view(){
    global $conn;
    $sql = "SELECT * from class";
    $result = $conn->prepare($sql);
    $result->execute();
    if($result->rowCount() > 0){
      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        echo '
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
          <link rel="stylesheet" href="../css/STYLE.css">
          <tr>

              <form action= "php/includes/update-class.php" method= "post">
                <td>'.$row["subname"].'</td>
              </form>
                <td>'.$row["subcode"].'</td>
                <td>'.$row["sectcode"].'</td>
                <td>'.$row["day"].'</td>
                <td>'.$row["time"].'</td>

            <td><a href="Edit-class.php"><button name="addclass" type="button" class= "btn btn-primary"><i class<i class="bi bi-pen"></i>

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
            </svg></button></a>

            <button name="delclass" type="button" class="btn btn-danger"><i
               class="far fa-trash-alt"></i>

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg></button></td>
               </tr>
        ';
      }
    }
  }
}







?>
