<?php
declare(strict_types=1);
require_once('config.php');

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;


session_start();
class dbfunction{

  


//---LOGIN
  function login($instEmail,$pwd){
     global $conn;

    if(ISSET($_POST['btnLogin'])){
      if($_POST['instEmail'] != "" || $_POST['pwd'] != ""){

        $instEmail = $_POST['instEmail'];
        $pwd = $_POST['pwd']; 

        $sql = "SELECT * FROM users WHERE instemail_users=? and usertype_users=1";
        $query = $conn->prepare($sql);
        $query->execute([$instEmail]);
        $row = $query->fetch();

        if($row==0){
          $_SESSION['error']="Invalid Institutional Email.";
        }elseif($row && password_verify($pwd,$row['pwd_users'])){
          $_SESSION['user'] = $row['id_users'];
          header("location: authenticate_client.php");
        }else{
            $_SESSION['error']="Invalid Password";
        }

        $sql2 = "SELECT * FROM users WHERE instemail_users=? and usertype_users=2";
        $query2 = $conn->prepare($sql2);
        $query2->execute([$instEmail]);
        $row2 = $query2->fetch();

        if($row2==0){
          $_SESSION['error']="Invalid Institutional Email.";
        }elseif($row2 && password_verify($pwd,$row2['pwd_users'])){
          $_SESSION['user'] = $row2['id_users'];
          header("location: authenticate_admin.php");
        }else{
            $_SESSION['error']="Invalid Password";
        }
        
      }else{
        $_SESSION['error']="Please Enter Institutional Email and Password.";
      } 
    }
  }      
   
  

//---ADD USER(SUPERADMIN)
  function addUserSupAdmin($hnr_users,$flname_users,$instemail_users,$empnum_users,$pwdhashed,$usertype_users){
    global $conn;
    if(ISSET($_POST['addbtnSA'])){
      if($_POST['hnr'] != "" || $_POST['name'] != "" || $_POST['email'] != "" || $_POST['empnum'] != "" || $_POST['pwd'] != "" || $_POST['usertype'] != ""){  

 
        $hnr_users=$_POST["hnr"];
        $flname_users=$_POST["name"];
        $instemail_users=$_POST["email"];
        $empnum_users=$_POST["empnum"];
        $usertype_users=$_POST["usertype"];
        $pwd_users="1234";
        $pwdhashed=password_hash($pwd_users,PASSWORD_DEFAULT);

        
        $sql = "INSERT INTO  users (flname_users,hnr_users,instemail_users,empnum_users,pwd_users,usertype_users) VALUES (?,?,?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$flname_users,$hnr_users, $instemail_users, $empnum_users, $pwdhashed, $usertype_users]);
      
      } 
    }
  }



//---ADD USER(ADMIN)
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
        $pwdhashed=password_hash($pwd_users,PASSWORD_DEFAULT);

        $sql = "INSERT INTO  users (flname_users,hnr_users,instemail_users,empnum_users,pwd_users,usertype_users) VALUES (?,?,?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$flname_users, $hnr_users, $instemail_users, $empnum_users, $pwdhashed, $usertype_users]);
      
      } 
    }
  }

  

//---ADD STUDENT
  function addStd($fullname,$email,$studnum,$gflname,$gemail,$crsname,$yrlvl,$sectname){
    require_once('../../vendor/autoload.php');
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

      $path = '../../images/qrcodes/';
      $qrloc = $path.$fullname.$studnum.".svg";
      $qrimage = $fullname.$studnum.".svg"; 

      //check if existing
      $stmt = $conn->prepare("SELECT * FROM students WHERE instemail_std=?");
      $stmt2 = $conn->prepare("SELECT * FROM students WHERE studnum_std=?");
      $stmt3 = $conn->prepare("SELECT * FROM students WHERE gemail_std=?");
    
     
      //execute the statement
      $stmt->execute([$email]); 
      $stmt2->execute([$studnum]);
      $stmt3->execute([$gemail]);    
      //fetch result
      $user = $stmt->fetch();
      $user2 = $stmt2->fetch();
      $user3 = $stmt3->fetch();

      

      

      
      if($user) {
        $_SESSION['error']="Email Already Exist.";
        if($user2){
          $_SESSION['error']="Studnum Already Exist.";
          if($user3){
            $_SESSION['error']="Gmail Already Exist.";
          }
        }
      }else{
    
        $sql = "INSERT INTO students (flname_std,instemail_std,studnum_std,gflname_std,gemail_std,crs_id,yrlvl_id,sec_id,qrcode_std) VALUES (?,?,?,?,?,?,?,?,?)";
        $result = $conn->prepare($sql);
        $result->execute([$fullname,$email,$studnum,$gflname,$gemail,$crsname,$yrlvl,$sectname,$qrimage]);

          if($result){
            
              echo '<script type="text/javascript">';
              echo 'alert("Added Successfully")';  //not showing an alert box.
              echo '</script>';



              //GENERATING AND SAVING QR CODE TO IMAGES FOLDER
              $options = new QROptions(
                [
                    'eccLevel' => QRCode::ECC_L,
                    'outputType' => QRCode::OUTPUT_MARKUP_SVG,
                    'version' => 5
                ]
                );

                
                $qrcode=(new QRCode($options))->render($studnum, $qrloc);


              
            }
      }
    }
  }



//---ADD SUBJECT
  function addSub($name,$code,$units){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['name'] != "" || $_POST['code'] != "" || $_POST['units'] != ""){  

        $name=$_POST["name"];
        $code=$_POST["code"];
        $units=$_POST["units"];
       

        $sql = "INSERT INTO  subjects ( `name_subj`, `code_subj`,`units_subj`) VALUES (?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$units]);
      
      }  
    }
  }



//---ADD SECTION
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



//---ADD SCHEDULE
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



//---ADD COURSE
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



//---ADD DEPARTMENT
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



//---ADD BUILDING
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



//---ADD ROOM
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



//---UPDATE SCHEDULE
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



//---UPDATE STUDENT
  function updStd($flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['flname'] != "" || $_POST['email'] != "" || $_POST['studnum'] != "" || $_POST['gflname'] != "" || $_POST['gemail'] != "" || $_POST['crs'] != "" || $_POST['yr'] != "" || $_POST['sec'] != ""){
        $id=$_REQUEST['updid'];
        $flname=$_POST['flname'];
        $email=$_POST['email'];
        $studnum=$_POST['studnum'];
        $gflname=$_POST['gflname'];
        $gemail=$_POST['gemail'];
        $crs=$_POST['crs'];
        $yr=$_POST['yr'];
        $sec=$_POST['sec'];

        $sql="SELECT * from students where id_std=?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);

        $sql="UPDATE students set id_std=?, flname_std=?, instemail_std=?, studnum_std=?, gflname_std=?, gemail_std=?, crs_id=?, yrlvl_id=?, sec_id=? where id_std=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec,$id]);

        header("location: ../students.php");
        
      }
    }
  }



//---UPDATE USER(ADMIN)
  function updUsrAdmin($hnr,$flname,$email,$empnum,$pwd){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['hnr'] != "" || $_POST['flname'] != "" || $_POST['email'] != "" || $_POST['empnum'] != "" || $_POST['pwd'] != ""){
        $id=$_REQUEST['updid'];
        $hnr=$_POST['hnr'];
        $flname=$_POST['flname'];
        $email=$_POST['email'];
        $empnum=$_POST['empnum'];
        $pwd=$_POST['pwd'];

        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$id]);

        header("location: ../teachers.php");


        
      }
    }
  }



//---UPDATE USER(SUPERADMIN)
  function updUsrSupAdmin($hnr,$flname,$email,$empnum,$pwd,$usertype){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['hnr'] != "" || $_POST['flname'] != "" || $_POST['email'] != "" || $_POST['empnum'] != "" || $_POST['pwd'] != "" || $_POST['usertype'] != ""){
        $id=$_REQUEST['updid'];
        $hnr=$_POST['hnr'];
        $flname=$_POST['flname'];
        $email=$_POST['email'];
        $empnum=$_POST['empnum'];
        $pwd=$_POST['pwd'];
        $usertype=$_POST['usertype'];
       
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$usertype,$id]);

        header("location: ../users.php");


        
      }
    }
  }



//---UPDATE BUILDING
  function updBldg($name,$code){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['name'] != "" || $_POST['code']){

        $id=$_REQUEST['updid'];
        $name=$_POST['name'];
        $code=$_POST['code'];
        
       
        $sql="UPDATE building set name_bldg=?, code_bldg=? where id_bldg=?";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$id]);

        header("location: ../buildings.php");


        
      }
    }
  }



//---UPDATE COURSE
  function updCrs($name,$code,$dept){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['name'] != "" || $_POST['code'] != "" || $_POST['dept']){
        
        $id=$_REQUEST['updid'];
        $name=$_POST['name'];
        $code=$_POST['code'];
        $dept=$_POST['dept'];
            
        $sql="UPDATE courses set name_crs=?, code_crs=?, dept_id=? where id_crs  =?";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$dept,$id]);

        header("location: ../courses.php");
        
      }
    }
  }



//---UPDATE DEPARTMENT
  function updDept($name,$code,$dept){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['name'] != "" || $_POST['code']){
        
        $id=$_REQUEST['updid'];
        $name=$_POST['name'];
        $code=$_POST['code'];
        $dept=$_POST['dept'];       
       
        $sql="UPDATE departments set name_dept=?, code_dept=? where id_dept  =?";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$id]);

        header("location: ../departments.php");
        
      }
    }
  }



//---UPDATE ROOM
  function updRm($code,$bldg){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['code'] != "" || $_POST['bldg']){
        
        $id=$_REQUEST['updid'];
        $bldg=$_POST['bldg'];
        $code=$_POST['code'];
       
        $sql="UPDATE room set code_room=?, bldg_id=? where id_room  =?";
        $query = $conn->prepare($sql);
        $query->execute([$code,$bldg,$id]);

        header("location: ../rooms.php");
        
      }
    }
  }



//---UPDATE SECTION
  function updSec($code,$crs,$yr){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['code'] != "" || $_POST['crs'] != "" || $_POST['yr'] ){
        
        $id=$_REQUEST['updid'];
        $code=$_POST['code'];
        $crs=$_POST['crs'];
        $yr=$_POST['yr'];
       
        $sql="UPDATE sections set code_sec=?, crs_id=?, yrlvl_id=? where id_sec=?";
        $query = $conn->prepare($sql);
        $query->execute([$code,$crs,$yr,$id]);

        header("location: ../sections.php");
        
      }
    }
  }



//---UPDATE SUBJECT
  function updSub($name,$code,$units){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['name'] != "" || $_POST['code'] != "" || $_POST['units'] ){
        
        $id=$_REQUEST['updid'];
        $name=$_POST['name'];
        $code=$_POST['code'];
        $units=$_POST['units'];
       
        $sql="UPDATE subjects set name_subj=?, code_subj=?, units_subj=? where id_subj=?";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$units,$id]);

        header("location: ../subjects.php");
        
      }
    }
  }



//---UPDATE PASSWORD(USER)
  function updUsrPwd($oldpwd,$newpwd,$conpwd){
    
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['oldpwd'] != "" || $_POST['newpwd'] != "" || $_POST['conpwd'] ){
        
        $id=$_REQUEST['updid'];
        $oldpwd=$_POST['oldpwd'];
        $newpwd=password_hash($_POST['newpwd'],PASSWORD_DEFAULT);
        $conpwd=password_hash($_POST['conpwd'],PASSWORD_DEFAULT);

        $sql="SELECT * FROM users where id_users=?";
        $query= $conn->prepare($sql);
        $query->execute([$id]);
        $row = $query->fetch();
        

        if($row > 0){
          if(password_verify($oldpwd,$row['pwd_users'])){
            if($newpwd===$conpwd){

              $sql2="UPDATE users set pwd_users=? where id_users=?";
              $query2 = $conn->prepare($sql2);
              $query2->execute([$newpwd,$id]);

             echo "UPDAT SUCCESS";
            }else{
              echo "Passwords are incorrect. Must be the same.";
              //$_SESSION['pwderror']="Passwords are incorrect. Must be the same.";

            }

          }else{
            echo "Invalid Old Password.";
           //$_SESSION['pwderror']="Invalid Old Password.";
          }

        }else{
          echo "No Records Found.";
         //$_SESSION['pwderror']="No Records Found.";
        }     
      }       
    }
  }

  



//---DELETE SCHEDULE
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



//---DELETE USER
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



//---DELETE STUDENT
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



//---DELETE BUILDING
  function delBldg($idbldg){
    global $conn;
    if(ISSET($_POST['btnDel'])){
      if($_POST['idbldg'] != ""){
        $idbldg=$_POST['idbldg'];

        $sql="DELETE from building where id_bldg=?";
        $query = $conn->prepare($sql);
        $query->execute([$idbldg]);
      }
    }
  }



//---DELETE COURSE
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



//---DELETE DEPARTMENT
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



//---DELETE ROOM
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



//---DELETE SECTION
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



//---DELETE SUBJECT
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



