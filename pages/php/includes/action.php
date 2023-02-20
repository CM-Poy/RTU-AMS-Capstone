<?php
require_once 'config.php';
require_once 'function.php';
global $conn;








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


if(isset($_POST["delclass"])){

  $idclass=$row["idclass"];
  delClass();
}



if(isset($_POST["submitaddclass"])){

  $subname = $_POST["subname"];
  $subcode = $_POST["subcode"];
  $sectcode = $_POST["sectcode"];
  $day = $_POST["day"];

  $fromtime = $_POST["fromtime"];
  $totime = $_POST["totime"];

addClass($subname, $subcode, $sectcode, $day, $time);
}







?>
