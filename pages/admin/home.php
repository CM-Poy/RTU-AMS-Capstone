<!doctype html>
<html lang="en">

<?php 

  include('../includes/header.php'); 
  require('../includes/config.php');

  require ("../includes/authenticator.php");
  session_start();
  if ($_SERVER['REQUEST_METHOD'] != "POST") {
      header("location: ../authenticate_admin.php");
      die();
  }

  $Authenticator = new Authenticator();
  $checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

  if (!$checkResult) {
      $_SESSION['failed'] = true;
      header("location: ../authenticate_admin.php");
      die();
  } 

  header('location:teachers.php');

?>
  

