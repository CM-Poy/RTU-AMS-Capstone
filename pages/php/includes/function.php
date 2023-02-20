<?php
require_once 'config.php';


    if(isset($_POST["submitreg"])){

      if(isset($_POST['fname'],$_POST['lname'],$_POST['schoolid'],$_POST['cnumber'],$_POST['email'],$_POST['pwd'])
      && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['schoolid']) && !empty($_POST['cnumber']) && !empty($_POST['email']) && !empty($_POST['pwd'])){


        $fname = trim($_POST["fname"]);
        $lname = trim($_POST["lname"]);
        $schoolid = trim($_POST["schoolid"]);
        $cnumber = trim($_POST["cnumber"]);
        $email = trim($_POST["email"]);
        $pwd = trim($_POST["pwd"]);
        $pwdRepeat = trim($_POST["pwdrepeat"]);

        $options = array("cost"=>4);
        $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
              $sql= "SELECT * FROM users WHERE email =:email";
              $stmt = $pdo->prepare($sql);
              $p = ['email'=>$email];
              $stmt->execute($p);

            if($stmt->rowCount() == 0){

                $sql = "INSERT INTO users (fname, lname, schoolid, cnumber, email, pwd) VALUES (:fname,:lname,:schoolid,:cnumber,:email,:pwd)";

                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':fname'=>$fname,
                        ':lname'=>$lname,
                        ':schoolid'=>$schoolid,
                        ':cnumber'=>$cnumber,
                        ':email'=>$email,
                        ':pwd'=>$hashPassword
                        ];

                    $handle->execute($params);

                    $success = 'User registered successfully.';

                }catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }

            }else{
                $valFname = $fname;
                $valLname = $lname;
                $valSchoolId = $schoolid;
                $valCnumber = $cnumber;
                $valEmail = '';
                $valPwd = $pwd;

                $errors[] = 'E-mail is already used.';
            }

        }else{
            $errors[] = "Invalid E-mail";
        }

    }else{

        if(!isset($_POST['fname']) || empty($_POST['fname'])){
            $errors[] = 'First name is required';
        }else{
            $valFname = $_POST['fname'];
        }

        if(!isset($_POST['lname']) || empty($_POST['lname'])){
            $errors[] = 'Last name is required';
        }else{
            $valLname = $_POST['lname'];
        }

        if(!isset($_POST['schoolid']) || empty($_POST['schoolid'])){
            $errors[] = 'School ID is required';
        }else{
            $valSchoolId = $_POST['schoolid'];
        }

        if(!isset($_POST['cnumber']) || empty($_POST['cnumber'])){
            $errors[] = 'E-mail is required';
        }else{
            $valCnumber = $_POST['cnumber'];
        }

        if(!isset($_POST['email']) || empty($_POST['email'])){
            $errors[] = 'E-mail is required';
        }else{
            $valEmail = $_POST['email'];
        }


        if(!isset($_POST['pwd']) || empty($_POST['pwd'])){
            $errors[] = 'Password is required';
        }else{
            $valPassword = $_POST['pwd'];
        }

    }
  }











?>
