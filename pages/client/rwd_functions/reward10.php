<?php
require('../../includes/config.php');
session_start();

$idschd=$_SESSION['schdid'];

      global $conn;
        if(isset($_GET['id'])){

          $std=$_GET['id'];
          $date= date('Y-m-d');
          
          $sql = "INSERT into rewards (schd_id, std_id, reward, `date`) VALUES (?,?,10,?)";
          $result = $conn->prepare($sql);
          $result->execute([$idschd,$std,$date]);

          header("location: ../reward.php");
        }
?>
    
    
