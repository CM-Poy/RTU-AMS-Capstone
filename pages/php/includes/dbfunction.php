<?php
require_once('config.php');

class dbfunction{

  function login($schoolid,$pwd){
     global $conn;
    if(ISSET($_POST['login'])){
      if($_POST['schoolid'] != "" || $_POST['pwd'] != ""){
        $schoolid = $_POST['schoolid'];
        // md5 encrypted
        // $password = md5($_POST['password']);
        $pw = $_POST['pwd'];
        $sql = "SELECT * FROM `users` WHERE `schoolid`=? AND `pwd`=? ";
        $query = $conn->prepare($sql);
        $query->execute(array($schoolid,$pwd));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if($row > 0) {
          $_SESSION['user'] = $fetch['idusers'];
          header("location: home.php");
        } else{
          echo "
          <script>alert('Invalid username or password')</script>
          <script>window.location = ../index.php</script>
          ";
        }
      }else{
        echo "
          <script>alert('Please complete the required field!')</script>
          <script>window.location = ../index.php</script>
        ";
      }
    }
  }


  function register($fname,$lname,$schoolid,$email,$pwd,$cnum){
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
  			header('location:../index.php');

  		}else{
  			echo "
  				<script>alert('Please fill up the required field!')</script>
  				<script>window.location = 'draftreg.php'</script>
  			";
  		}
  	}
  }
}

?>
