<?php
session_start();
require_once '../includes/config.php';

global $conn;
if(ISSET($_POST['login'])){

 if($_POST['schoolid'] != "" || $_POST['pwd'] != ""){
   $schoolid = $_POST['schoolid'];
   // md5 encrypted
   // $password = md5($_POST['password']);
   $pwd = $_POST['pwd'];
   $sql = "SELECT * FROM `users` WHERE `schoolid`=? AND `pwd`=? ";
   $query = $conn->prepare($sql);
   $query->execute(array($schoolid,$pwd));
   $row = $query->rowCount();
   $fetch = $query->fetch();

   if($row > 0) {
     $_SESSION['user'] = $fetch['idusers'];
     header("location: ../../dash.php");

   }else{
     echo "
     <script>alert('Invalid username or password')</script>
     <script>window.location = '../../../index.php'</script>
     ";
   }

 }else{
   echo "
     <script>alert('Please complete the required field!')</script>
     <script>window.location = '../../../index.php'</script>
   ";
 }
}

?>
