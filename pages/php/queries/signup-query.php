<?php
session_start();
require_once '../includes/config.php';
global $conn;


if(ISSET($_POST['register'])){

  if($_POST['schoolid'] != "" || $_POST['pwd'] != "" || $_POST['fname'] != "" || $_POST['lname'] != "" || $_POST['cnum'] != "" || $_POST['email'] != ""){

    try{
      $schoolid = $_POST['schoolid'];
      $fname= $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $cnum = $_POST['cnum'];
      // md5 encrypted
      // $password = md5($_POST['password']);
      $pwd = $_POST['pwd'];
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO `users` VALUES ('','$fname','$lname', '$schoolid', '$cnum', '$email', '$pwd')";
      $conn->exec($sql);

    }catch(PDOException $e){
      echo $e->getMessage();
    }

    $_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
    $conn = null;
    header('location: ../../../index.php');

  }else{
    echo "
      <script>alert('Please fill up the required field!')</script>
      <script>window.location = '../../draftreg.php'</script>
    ";
  }
}

 ?>
