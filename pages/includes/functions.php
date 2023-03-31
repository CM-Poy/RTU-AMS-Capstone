<?php
require_once('config.php');

class dbfunction{

  function login($schoolid,$pwd){
     global $conn;
    if(ISSET($_POST['btnLogin'])){
      if($_POST['instEmail'] != "" || $_POST['pwd'] != ""){
        $instEmail = $_POST['instEmail'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * FROM `users` WHERE `instemail_users`=? and `pass_users`=? and `usertype_users`=1";
        $query = $conn->prepare($sql);
        $query->execute(array($instEmail,$pwd));
        $row = $query->rowCount();
        $fetch = $query->fetch();


        if($row > 0) {
          $_SESSION['user'] = $fetch['id_users'];
          header("location: authenticate_client.php");
        } else{
          echo "
          <script>alert('Invalid username or password')</script>
          <script>window.location = ../home.php</script>
          ";
        }

        $sql = "SELECT * FROM `users` WHERE `instemail_users`=? and `pass_users`=? and `usertype_users`=2";
        $query = $conn->prepare($sql);
        $query->execute(array($instEmail,$pwd));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if($row > 0) {
          $_SESSION['user'] = $fetch['id_users'];
          header("location: authenticate_admin.php");
        } else{
          echo "
          <script>alert('Invalid username or password')</script>
          <script>window.location = ../home.php</script>
          ";
        }

        }
        

     
      }else{
        echo "
          <script>alert('Please complete the required field!')</script>
          <script>window.location = ../home.php</script>
        ";
      }
    }
  


  
  
}


