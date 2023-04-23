<?php 
require('../includes/config.php');
include('../includes/header.php');
session_start();


require "../includes/authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: ../authenticate_client.php");
    die();
}
$Authenticator = new Authenticator();




$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

if (!$checkResult) {
    $_SESSION['failed'] = true;
    header("location: ../authenticate_client.php");
    die();
} 


header('location:today.php');

?>