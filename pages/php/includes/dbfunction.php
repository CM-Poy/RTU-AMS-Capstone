<?php
require_once('config.php');

class dbfunction{

  function login($schoolid,$pwd){
      global $pdo;

        	if(ISSET($_POST['login'])){

            if($_POST['schoolid'] != "" || $_POST['pwd'] != ""){
        			$schoolid = $_POST['schoolid'];
        			// md5 encrypted
        			// $password = md5($_POST['password']);
        			$pwd = $_POST['pwd'];
        			$sql = "SELECT * FROM `users` WHERE `schoolid`=? AND `pwd`=? ";
        			$query = $pdo->prepare($sql);
        			$query->execute(array($schoolid,$pwd));
        			$row = $query->rowCount();
        			$fetch = $query->fetch();

              if($row > 0) {
        			$fetch['idusers'];
        				header("location:dash.php");
        			}else{
        				echo "
        				<script>alert('Invalid username or password')</script>
        				<script>window.location =../'index.php'</script>
        				";
        			}

            }else{
              echo "
              <script>alert('Please complete the required field!')</script>
              <script>window.location =../'index.php'</script>
              ";
            }
      }
    }


    function register($schoolid,$pwd){
      global $pdo;

        if(ISSET($_POST['register'])){
          if($_POST['schoolid'] != "" || $_POST['pwd'] != ""){
              $schoolid= $_POST['schoolid'];
              $pwd = $_POST['pwd'];
              // md5 encrypted
              // $password = md5($_POST['password']);

              $sql = "INSERT INTO `users` VALUES ('','','','$schoolid','','', '$pwd')";
              $pdo->exec($sql);

            $_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
            $pdo = null;
            header('location:login-index.php');
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
