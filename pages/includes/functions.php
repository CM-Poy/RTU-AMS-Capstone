<?php
require_once('config.php');
session_start();
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
        }else{
          $_SESSION['error']="Invalid Institutional Email or Password.";
        }


      }elseif($_POST['instEmail'] != "" || $_POST['pwd'] != ""){
        $sql = "SELECT * FROM `users` WHERE `instemail_users`=? and `pwd_users`=? and `usertype_users`=2";
        $query = $conn->prepare($sql);
        $query->execute(array($instEmail,$pwd));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if($row > 0) {
          $_SESSION['user'] = $fetch['id_users'];
          header("location: authenticate_admin.php");
        }else{
          $_SESSION['error']="Invalid Institutional Email or Password.";
        }


      }elseif($_POST['instEmail'] != "" || $_POST['pwd'] != ""){
        $sql = "SELECT * FROM `users` WHERE `instemail_users`=? and `pwd_users`=? and `usertype_users`=3";
        $query = $conn->prepare($sql);
        $query->execute(array($instEmail,$pwd));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if($row > 0) {
          $_SESSION['user'] = $fetch['id_users'];
          header("location: authenticate_superadmin.php");
        }else{
          $_SESSION['error']="Invalid Institutional Email or Password.";
        }
      }else{
        $_SESSION['error']="Please enter Institutional Email and Password.";
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



  function addUserSupAdmin($hnr_users,$flname_users,$instemail_users,$empnum_users,$pwd_users,$usertype_users){
    global $conn;
    if(ISSET($_POST['addbtnSA'])){
      if($_POST['hnr'] != "" || $_POST['name'] != "" || $_POST['email'] != "" || $_POST['empnum'] != "" || $_POST['pwd'] != "" || $_POST['usertype'] != ""){  

 
        $hnr_users=$_POST["hnr"];
        $flname_users=$_POST["name"];
        $instemail_users=$_POST["email"];
        $empnum_users=$_POST["empnum"];
        $usertype_users=$_POST["usertype"];
        $pwd_users="1234";

        $sql = "INSERT INTO  users (flname_users,hnr_users,instemail_users,empnum_users,pwd_users,usertype_users) VALUES (?,?,?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$hnr_users,$flname_users, $instemail_users, $empnum_users, $pwd_users, $usertype_users]);
      
      } 
    }
  }


  function addUserAdmin($hnr_users,$flname_users,$instemail_users,$empnum_users,$pwd_users,$usertype_users){
    global $conn;
    if(ISSET($_POST['addbtnA'])){
      if($_POST['hnr'] != "" || $_POST['name'] != "" || $_POST['email'] != "" || $_POST['empnum'] != "" || $_POST['pwd'] != "" || $_POST['usertype'] != ""){  

 
        $hnr_users=$_POST["hnr"];
        $flname_users=$_POST["name"];
        $instemail_users=$_POST["email"];
        $empnum_users=$_POST["empnum"];
        $usertype_users="1";
        $pwd_users="1234";

        $sql = "INSERT INTO  users (flname_users,hnr_users,instemail_users,empnum_users,pwd_users,usertype_users) VALUES (?,?,?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$hnr_users,$flname_users, $instemail_users, $empnum_users, $pwd_users, $usertype_users]);
      
      } 
    }
  }


  function addStd($fullname,$email,$studnum,$gflname,$gemail,$crsname,$yrlvl,$sectname){
    global $conn;
    if(isset($_POST['addbtn'])){
        
      $fullname = $_POST['flname'];
      $email = $_POST['email'];
      $studnum = $_POST['studnum'];
      $gflname = $_POST['gflname'];
      $gemail = $_POST['gemail'];
      $crsname = $_POST['crsNameStd'];
      $yrlvl = $_POST['yrLvlStd'];
      $sectname = $_POST['sectNameStd'];
      
      
      

      $sql = "INSERT INTO students (	
      flname_std,
      instemail_std,	
      studnum_std,	
      gflname_std,	
      gemail_std,	
      crs_id,	
      yrlvl_id,	
      sec_id) VALUES (:flname, :email, :studnum, :gflname, :gemail, :crsNameStd, :yrLvlStd, :sectNameStd)";
      $result = $conn->prepare($sql);

      $data = [
          ':flname' => $fullname,
          ':email' => $email,
          ':studnum' => $studnum,
          ':gflname' => $gflname,
          ':gemail' => $gemail,
          ':crsNameStd' => $crsname,
          ':yrLvlStd' => $yrlvl,
          ':sectNameStd' => $sectname,
      ];
      $result->execute($data);
    }
  }



  function updStd($fullname,$email,$studnum,$gflname,$gemail,$crsname,$yrlvl,$sectname){
    global $conn;
    if(isset($_POST['updbtn'])){
        
        $fullname = $_POST['flname'];
        $email = $_POST['email'];
        $studnum = $_POST['studnum'];
        $gflname = $_POST['gflname'];
        $gemail = $_POST['gemail'];
        $crsname = $_POST['crs'];
        $yrlvl = $_POST['yrlvl'];
        $sectname = $_POST['sect'];
        $studid = $_POST['id'];
        
    
        $sql = "UPDATE students set  `flname_std`=?, `instemail_std` =?, `studnum_std` =?,  `gflname_std` =?, `gemail_std` =?,`crs_id` =?, `yrlvl_id` =?,  `sec_id` =? where `id_std` = ?";

        $conn->prepare($sql)->execute([$fullname,$email,$studnum,$gflname,$gemail,$crsname,$yrlvl,$sectname,$studid]);
      
    }
  }



  function addSub($code,$name,$units){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['code'] != "" || $_POST['name'] != "" || $_POST['units'] != ""){  

 
        $code=$_POST["code"];
        $name=$_POST["name"];
        $units=$_POST["units"];
       

        $sql = "INSERT INTO  subjects (`code_subj`, `name_subj`, `units_subj`) VALUES (?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$code,$name,$units]);
      
      }  
    }
  }



  function addSec($code,$crs,$yrlvl){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['code'] != "" || $_POST['crsName'] != "" || $_POST['yrlvl'] != ""){  

 
        $code=$_POST["code"];
        $crs=$_POST["crsName"];
        $yrlvl=$_POST["yrlvl"];
       

        $sql = "INSERT INTO  sections (`code_sec`, `crs_id`, `yrlvl_id`) VALUES (?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$code,$crs,$yrlvl]);
      
      }  
    }
  }



  function addSchd($user,$sub,$sec,$day,$strtime,$endtime,$room){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['usrName'] != "" || $_POST['subName'] != "" || $_POST['secName'] != "" || $_POST['day'] != "" || $_POST['strTime'] != "" || $_POST['endtime_schd'] != "" || $_POST['room_id'] != ""){  

 
        $user = $_POST['usrName'];
        $sub = $_POST['subName'];
        $sec = $_POST['secName'];
        $day = $_POST['day'];
        $strtime = $_POST['strTime'];
        $endtime = $_POST['endTime'];
        $room = $_POST['room'];
       

        $sql = "INSERT INTO  schedules (`user_id`, `sub_id`, `sec_id`, `day_schd`, `strtime_schd`, `endtime_schd`, `room_id`) VALUES (?,?,?,?,?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$user,$sub,$sec,$day,$strtime,$endtime,$room]);
      
      }  
    }
  }



  function addCrs($name,$code,$dept){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['code'] != "" || $_POST['name'] != "" || $_POST['dept'] != ""){  

 
        $name=$_POST["name"];
        $code=$_POST["code"];
        $dept=$_POST["dept"];
       

        $sql = "INSERT INTO  courses (`code_crs`, `name_crs`, `dept_id`) VALUES (?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$code,$name,$dept]);
      
      }  
    }
  }



  function addDept($name,$code){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['name'] != "" || $_POST['code'] != ""){  

 
        $name=$_POST["name"];
        $code=$_POST["code"];
       

        $sql = "INSERT INTO  departments (`name_dept`, `code_dept`) VALUES (?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code]);
      
      }  
    }
  }

  

}

