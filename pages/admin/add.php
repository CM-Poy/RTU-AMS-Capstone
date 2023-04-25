<?php
ob_start();
include('header.php'); 
require('../includes/config.php');
if(isset($_POST['addbtn']))
{
    if(isset($fullname) || isset($email) || isset($studnum) || isset($gname) || isset($gemail)){
    $fullname = $_POST['flname'];
    $email = $_POST['email'];
    $studnum = $_POST['studnum'];
    $gname = $_POST['guardianname'];
    $gemail = $_POST['guardianemail'];
    

    $sql = "INSERT INTO students (flname_std, instemail_std, studnum_std, gflname_std, gemail_std) VALUES (:flname, :email, :studnum, :guardianname, :guardianemail)";
    $result = $conn->prepare($sql);

    $data = [
        ':flname' => $fullname,
        ':email' => $email,
        ':studnum' => $studnum,
        ':guardianname' => $gname,
        ':guardianemail' => $gemail,
    ];
    $result->execute($data);
}
}
?>