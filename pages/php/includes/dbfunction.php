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


    function register($cshort,$cfull,$fname,$mname,$lname,$gender,$gname,$ocp,$income,$category,$ph,
                      $nation,$mobno,$email,$country,$state,$city,$padd,$cadd,$board1,$board2,$roll1,$roll2,
    				   $pyear1,$pyear2,$sub1,$sub2,$marks1,$marks2,$fmarks1,$fmarks2,$session){

     			        $db = Database::getInstance();
    		           	$mysqli = $db->getConnection();

    		           //	echo $session;exit;
       $query = "INSERT INTO `registration` (`course`, `subject`, `fname`, `mname`, `lname`, `gender`, `gname`, `ocp`,
                         `income`, `category`, `pchal`, `nationality`, `mobno`, `emailid`, `country`, `state`, `dist`,
    					 `padd`, `cadd`, `board`, `board1`,`roll`,`roll1`,`pyear`,`yop1`,`sub`,`sub1`,`marks`,`marks1`,
    					 `fmarks`,`fmarks1`,`session`,regno)
                       VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    			        $reg=rand();
    			        $stmt= $mysqli->prepare($query);
    			        if(false===$stmt){

    			     	trigger_error("Error in query: " . mysqli_connect_error(),E_USER_ERROR);
    			    }

    			    else{

    			$stmt->bind_param('sssssssssssssssssssssssssssssssss',
    		         	$cshort,$cfull,$fname,$mname,$lname,$gender,$gname,$ocp,$income,$category,$ph,$nation,$mobno,
    					$email,$country,$state,$city,$padd,$cadd,$board1,$board2,$roll1,$roll2,$pyear1,$pyear2,
    					$sub1,$sub2,$marks1,$marks2,$fmarks1,$fmarks2,$session,$reg);
    			$stmt->execute();
    		   	echo "<script>alert('Successfully Registered , your registration number is $reg')</script>";
    		 	//header('location:login.php');

    		  }



           }

  }


?>
