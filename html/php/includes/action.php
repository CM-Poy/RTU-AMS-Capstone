<?php
require_once 'config.php';
require_once 'function.php';
global $conn;

if(isset($_POST["submitreg"])){

    // grabbing data
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
        // echo "empty input!"
        header("location: ../signup-index.php?error=emptyinput");

    }elseif (!preg_match("/^[a-zA-Z\s]+$/",$fname) || !preg_match("/^[a-zA-Z\s]+$/",$lname)) {
        // echo "invalid name!"
        header("location: ../signup-index.php?error=invalidname");

    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        // echo "invalid email!"
        header("location: ../signup-index.php?error=invalidemail");

    }elseif ($pwd !== $pwdRepeat) {
        // echo "passwords dont match!"
        header("location: ../signup-index.php?error=passwordmatch");
    
    }elseif	(strlen($pwd) < 8) {
        header("location: ../signup-index.php?error=passwordminimum");
    
    }elseif($stmt->rowCount() > 0){

        if($email == $row['email']){

            header("location: ../signup-index.php?error=registeredemail");
        }
    
    }else{
        signup($fname,$lname,$schoolid,$cnumber,$email,$pwd);

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
    
?>