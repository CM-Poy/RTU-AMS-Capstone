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


        if($_POST['instEmail'] != "" || $_POST['pwd'] != ""){
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


        if($_POST['instEmail'] != "" || $_POST['pwd'] != ""){
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
        }

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


      //  $sql2="SELECT * schedules WHERE user_id=?, sub_id=?, sec_id=?, day_schd=?, strtime_schd=?, endtime_schd=?, room_id=?";
      //  $result = $conn->prepare($sql2);
      //  $result->execute([$user,$sub,$sec,$day,$strtime,$endtime,$room]);
       // if($result->rowCount() > 0){
       //   while ($result->fetch(PDO::FETCH_ASSOC)){
       //     echo "nope.";
      //    }
       // }
      
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


  function addBldg($code,$name){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['code'] != "" || $_POST['name'] != ""){  
        $code=$_POST["code"];
        $name=$_POST["name"];
      
        $sql = "INSERT INTO building (`name_bldg`, `code_bldg`) VALUES (?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$code,$name]);
      
      }  
    }
  }


  function addRoom($code,$bldg){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['code'] != "" || $_POST['name'] != ""){  
        $code=$_POST["code"];
        $bldg=$_POST["bldg"];
      
        $sql = "INSERT INTO room (`code_room`, `bldg_id`) VALUES (?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$code,$bldg]);
      
      }  
    }
  }


  
  function updSchd($user,$sub,$sec,$day,$strtime,$endtime,$room){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['user'] != "" || $_POST['sub'] != "" || $_POST['sec'] != "" || $_POST['day'] != "" || $_POST['strtime'] != "" || $_POST['endtime'] != "" || $_POST['room'] != ""){
        $id=$_REQUEST['updid'];
        $user=$_POST['user'];
        $sub=$_POST['sub'];
        $sec=$_POST['sec'];
        $day=$_POST['day'];
        $strtime=$_POST['strtime'];
        $endtime=$_POST['endtime'];
        $room=$_POST['room'];

        $sql="UPDATE schedules set id_schd=?, user_id=?, sub_id=?, sec_id=?, day_schd=?, strtime_schd=?, endtime_schd=?, room_id=? where id_schd=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$user,$sub,$sec,$day,$strtime,$endtime,$room,$id]);

        header("location: ../schedules.php");


        
      }
    }
  }








  function delSchd($idschd){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idschd'] != ""){
        $idschd=$_POST['idschd'];

        $sql="DELETE from schedules where id_schd=?";
        $query = $conn->prepare($sql);
        $query->execute([$idschd]);
      }
    }
  }


  function delUserAdmin($iduser){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idusers'] != ""){
        $iduser=$_POST['idusers'];

        $sql="DELETE from users where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$iduser]);
      }
    }
  }


  function delStd($idstd){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idstd'] != ""){
        $idstd=$_POST['idstd'];

        $sql="DELETE from students where id_std=?";
        $query = $conn->prepare($sql);
        $query->execute([$idstd]);
      }
    }
  }


  function delBldg($idbldg){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idbldg'] != ""){
        $idstd=$_POST['idbldg'];

        $sql="DELETE from building where id_bldg=?";
        $query = $conn->prepare($sql);
        $query->execute([$idstd]);
      }
    }
  }


  function delCrs($idcrs){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idcrs'] != ""){
        $idcrs=$_POST['idcrs'];

        $sql="DELETE from courses where id_crs=?";
        $query = $conn->prepare($sql);
        $query->execute([$idcrs]);
      }
    }
  }


  function delDept($iddept){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['iddept'] != ""){
        $idcrs=$_POST['iddept'];

        $sql="DELETE from departments where id_dept=?";
        $query = $conn->prepare($sql);
        $query->execute([$iddept]);
      }
    }
  }


  function delRoom($idroom){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idroom'] != ""){
        $idroom=$_POST['idroom'];

        $sql="DELETE from room where id_room=?";
        $query = $conn->prepare($sql);
        $query->execute([$idroom]);
      }
    }
  }


  function delSec($idsec){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idsec'] != ""){
        $idsec=$_POST['idsec'];

        $sql="DELETE from sections where id_sec=?";
        $query = $conn->prepare($sql);
        $query->execute([$idsec]);
      }
    }
  }


  function delSub($idsub){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idsub'] != ""){
        $idsub=$_POST['idsub'];

        $sql="DELETE from subjects where id_subj=?";
        $query = $conn->prepare($sql);
        $query->execute([$idsub]);
      }
    }
  }

  

}

