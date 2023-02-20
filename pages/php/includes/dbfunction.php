<?php
require_once('config.php');

class dbfunction{

  function login($schoolid,$pwd){
      global $pdo;

        	if(ISSET($_POST['submit'])){
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
        			} else{
        				echo "
        				<script>alert('Invalid username or password')</script>
        				<script>window.location =../'index.php'</script>
        				";
        			}
        	}
        }
      }
    }


?>
