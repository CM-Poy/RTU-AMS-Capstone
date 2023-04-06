<?php
require_once('config.php');

class dbfunction{

  function login($instEmail,$pwd){
     global $conn;
    if(ISSET($_POST['btnLogin'])){
      if($_POST['instEmail'] != "" || $_POST['pwd'] != ""){
        $instEmail = $_POST['instEmail'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * FROM `users` WHERE `instemail_users`=? and `pwd_users`=? and `usertype_users`=1";
        $query = $conn->prepare($sql);
        $query->execute(array($instEmail,$pwd));
        $row = $query->rowCount();
        $fetch = $query->fetch();


        if($row > 0) {
          $_SESSION['user'] = $fetch['id_users'];
          header("location: authenticate_client.php");
        } else{
          echo "
          <script>alert('Invalid username or password')</script>
          <script>window.location = authenticate_client.php</script>
          ";
        }

        $sql = "SELECT * FROM `users` WHERE `instemail_users`=? and `pwd_users`=? and `usertype_users`=2";
        $query = $conn->prepare($sql);
        $query->execute(array($instEmail,$pwd));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if($row > 0) {
          $_SESSION['user'] = $fetch['id_users'];
          header("location: authenticate_admin.php");
        } else{
          echo "
          <script>alert('Invalid username or password')</script>
          <script>window.location = authenticate_admin.php</script>
          ";
        }

        }else{
          echo "
            <script>alert('Please complete the required field!')</script>
          ";
        }
        

      }
      
    }

    function updCrs($code_crs, $name_crs, $dept, $id_crs){
      global $conn;
      
        if(ISSET($_POST['updCrsBtn'])){
          $id_crs=$_POST["id"];
        
          $name_crs=$_POST["name"];
         $code_crs=$_POST["code"];
         $dept=$_POST["dept"];
      
          $sql = "UPDATE courses SET code_crs=? , name_crs=?, id_dept_fk=? WHERE id_crs=?";
          $query = $conn->prepare($sql);
          $query->execute(array($code_crs, $name_crs, $dept, $id_crs));
            
            
      
        }
      
    

    }


  function addUser($hnr_users,$flname_users,$instemail_users,$empnum_users,$pwd_users,$usertype_users){
    global $conn;
    if(ISSET($_POST['addUserBtn'])){
      if($_POST['addhnr'] != "" || $_POST['addname'] != "" || $_POST['addemail'] != "" || $_POST['addempnum'] != "" || $_POST['addpwd'] != "" || $_POST['addusertype'] != ""){  

        $id_users=$_POST["addid"];
        $hnr_users=$_POST["addhnr"];
        $flname_users=$_POST["addname"];
        $instemail_users=$_POST["addemail"];
        $empnum_users=$_POST["addempnum"];
        $pwd_users=$_POST["addpwd"];
        $usertype_users=$_POST["addusertype"];

        $sql = "INSERT INTO  users (flname_users,hnr_users,instemail_users,empnum_users,pwd_users,usertype_users) VALUES (?,?,?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute(array([$hnr_users,$flname_users, $instemail_users, $empnum_users, $pwd_users, $usertype_users]));
      


  

  
        

      }
      
    }




  }
}


