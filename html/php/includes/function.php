<?php
require_once 'config.php';
require_once 'action.php';


function signup($fname,$lname,$schoolid,$cnum,$email,$pwd){

    global $conn;

    $sql = "INSERT INTO users (fname, lname, schoolid, cnumber, email, pwd) VALUES (?, ?, ?, ?, ?, ?)";
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fname,$lname,$schoolid,$cnum,$email,$hashedPwd]);
        header("location: ../signup-index.php?signup=successful");
    } catch (PDOException $e){
        echo '<span style="color:red;text-align:center;">' .$sql. '</span>' .$e->getMessage();
    }

}




function login($email,$pwd){
    global $conn;
    $sql= "SELECT * FROM users WHERE users_email =:email";

    try{
        $stmt = $conn->prepare($sql);
        $statement = $conn->prepare($sql);
        $stmt->execute(array(':email'=>$email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $pwdHashed = $statement->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]['users_pwd']);

        if($stmt->rowCount() > 0){

            if($email == $row['users_email']){

                if($checkPwd){
                    header("location: ../login-index.php?error=none");
                }else{
                    header("location: ../login-index.php?error=none");
                }


            }else{
                header("location: ../login-index.php?error=loginfailed2");

            }

        }else{
            header("location: ../login-index.php?error=loginfailed3");
        }


    }catch (PDOException $e){
        echo '<span style="color:red;text-align:center;">' .$sql. '</span>' .$e->getMessage();
    }
}


function addClass($subname, $subcode, $sectcode, $day, $fromtime, $totime){
  global $conn;
  $sql = "INSERT INTO class (subname, subcode, sectcode, day, fromtime, totime) VALUES (?, ?, ?, ?, ?, ?)";

  try {
      $stmt = $conn->prepare($sql);
      $stmt->execute([$subname, $subcode, $sectcode, $day, $fromtime, $totime]);
      header("location: ../signup-index.php?signup=successful");
  } catch (PDOException $e){
      echo '<span style="color:red;text-align:center;">' .$sql. '</span>' .$e->getMessage();
  }
}



function delClass(){
    global $conn;
  $sql= "DELETE FROM class WHERE idclass = :idclass";
    try{
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idclass'=>$idclass]);
        header("location: ../signup-index.php?delelete=successful");
    }catch (PDOException $e){
        echo header("location: ../signup-index.php?delete=error");
        $e->getMessage();
    }
  }






?>
