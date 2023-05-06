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

        $sql2 = "SELECT * FROM users WHERE instemail_users=? and usertype_users=3";
        $query2 = $conn->prepare($sql2);
        $query2->execute([$instEmail]);
        $row2 = $query2->fetch();

        if($row2==0){
          $_SESSION['error']="Invalid Institutional Email.";
        }elseif($row2 && password_verify($pwd,$row2['pwd_users'])){
          $_SESSION['user'] = $row2['id_users'];
          header("location: authenticate_superadmin.php");
        }else{
            $_SESSION['error']="Invalid Password";
        }
        
      }else{
        $_SESSION['error']=" Input Institutional Email and Password";
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

        $stmt = $conn->prepare("SELECT * FROM users WHERE instemail_users=?");
        $stmt2 = $conn->prepare("SELECT * FROM users WHERE empnum_users=?");

         
      //execute the statement
      $stmt->execute([$instemail_users]); 
      $stmt2->execute([$empnum_users]);
         
      //fetch result
      $user = $stmt->fetch();
      $user2 = $stmt2->fetch();
      
      
      if($user) 
        $_SESSION['error']="Email Already Exist.";
        else if($user2)
          $_SESSION['error']="Employee Number Already Exist.";
          
        
        
       
        else{

        
        $sql = "INSERT INTO  users (flname_users,hnr_users,instemail_users,empnum_users,pwd_users,usertype_users) VALUES (?,?,?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$flname_users,$hnr_users, $instemail_users, $empnum_users, $pwdhashed, $usertype_users]);
      
      } 
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

      $stmt = $conn->prepare("SELECT * FROM users WHERE instemail_users=?");
      $stmt2 = $conn->prepare("SELECT * FROM users WHERE empnum_users=?");
      
    
     
      //execute the statement
      $stmt->execute([$instemail_users]); 
      $stmt2->execute([$empnum_users]);
         
      //fetch result
      $user = $stmt->fetch();
      $user2 = $stmt2->fetch();
      
      
      if($user) 
        $_SESSION['error']="Email Already Exist.";
        else if($user2)
          $_SESSION['error']="Employee Number Already Exist.";
          
        
        
       
        else{

        $sql = "INSERT INTO  users (flname_users,hnr_users,instemail_users,empnum_users,pwd_users,usertype_users) VALUES (?,?,?,?,?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$flname_users, $hnr_users, $instemail_users, $empnum_users, $pwdhashed, $usertype_users]);
      
      } 
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

      
      if($user) 
        $_SESSION['error']="Email Already Exist.";
        else if($user2)
          $_SESSION['error']="Studnum Already Exist.";
          if($user3){
            $_SESSION['error']="Gmail Already Exist.";
          }
        

      }else{
    
        $sql = "INSERT INTO students (flname_std,instemail_std,studnum_std,gflname_std,gemail_std,crs_id,yrlvl_id,sec_id,qrcode_std) VALUES (?,?,?,?,?,?,?,?,?)";
        $result = $conn->prepare($sql);
        $result->execute([$fullname,$email,$studnum,$gflname,$gemail,$crsname,$yrlvl,$sectname,$qrimage]);

          if($result){
            
              



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
    
    
  



//---ADD SUBJECT
  function addSub($name,$code,$units){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['name'] != "" || $_POST['code'] != "" || $_POST['units'] != ""){  

        $name=$_POST["name"];
        $code=$_POST["code"];
        $units=$_POST["units"];

        $stmt = $conn->prepare("SELECT * FROM subjects WHERE code_subj=?");
        $stmt2 = $conn->prepare("SELECT * FROM subjects WHERE name_subj=?");
  
        //execute the statement
        $stmt->execute([$code]); 
        $stmt2->execute([$name]);
        
        //fetch result
        $codesubj = $stmt->fetch();
        $namesubj = $stmt2->fetch();
        
        
        if($codesubj) 
          $_SESSION['error']="Subject Code Already Exist.";
          else if ($namesubj)
            $_SESSION['error']="Subject Name Already Exist.";
            
          
          
         
          
        else{

        $sql = "INSERT INTO  subjects (`name_subj`,`code_subj`, `units_subj`) VALUES (?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$units]);
      
      }  
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

        $stmt = $conn->prepare("SELECT * FROM sections WHERE code_sec=?");
        //execute the statement
        $stmt->execute([$code]); 
        //fetch result
        $codesec = $stmt->fetch();
        if($codesec) {
          $_SESSION['error']="Section Code Already Exist.";
            
          }   
        else{
       

        $sql = "INSERT INTO  sections (`code_sec`, `crs_id`, `yrlvl_id`) VALUES (?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$code,$crs,$yrlvl]);
      
      }  
    }
  }
}

  

 

//---ADD SCHEDULE
  function addSchd($user,$sub,$sec,$day,$strtime,$endtime,$room){
    
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['usrName'] != "" || $_POST['subName'] != "" || $_POST['secName'] != "" || $_POST['day'] != "" || $_POST['strTime'] != "" || $_POST['endtime_schd'] != "" || $_POST['room_id'] != ""){  

        function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }
        $user = $_POST['usrName'];
        $sub = $_POST['subName'];
        $sec = $_POST['secName'];
        $day = $_POST['day'];
        $strtime = $_POST['strTime'];
        $endtime = $_POST['endTime'];
        $room = $_POST['room'];

        
        $stmt ="SELECT * FROM schedules WHERE  day_schd=? AND room_id=? AND ((strtime_schd <= ? AND endtime_schd >= ?) OR (strtime_schd <=? AND endtime_schd >= ?))";
        $query = $conn->prepare($stmt);
        $query->execute([$day,$room,$strtime,$strtime,$endtime,$endtime]);
        $row = $query->rowCount();
        $fetch = $query->fetch();

        if($row>0){
          $_SESSION['error']="ERROR: Schedules Overlapping.";
            
        }else{
       
       

        $sql = "INSERT INTO  schedules (`user_id`, `sub_id`, `sec_id`, `day_schd`, `strtime_schd`, `endtime_schd`, `room_id`) VALUES (?,?,?,?,?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$user,$sub,$sec,$day,$strtime,$endtime,$room]);
      
      }  
    }
  }
}





//---ADD COURSE
  function addCrs($name,$code,$dept){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['name'] != "" || $_POST['code'] != ""  || $_POST['dept'] != ""){  

 
        $name=$_POST["name"];
        $code=$_POST["code"];
        $dept=$_POST["dept"];
        $stmt = $conn->prepare("SELECT * FROM courses WHERE name_crs=?");
        $stmt2 = $conn->prepare("SELECT * FROM courses WHERE code_crs=?");
  
        //execute the statement
        $stmt->execute([$name]); 
        $stmt2->execute([$code]);
        
        //fetch result
        $namecrs = $stmt->fetch();
        $codecrs = $stmt2->fetch();
        
        
        if($namecrs) 
          $_SESSION['error']="Course Name Already Exist.";
          else if($codecrs)
            $_SESSION['error']="Course code Already Exist.";
            
          
        else{
       

        $sql = "INSERT INTO  courses (`name_crs`,`code_crs`,`dept_id`) VALUES (?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$dept]);
      
      }  
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
       
        $stmt = $conn->prepare("SELECT * FROM departments WHERE name_dept =?");
        $stmt2 = $conn->prepare("SELECT * FROM departments WHERE code_dept =?");
  
        //execute the statement
        $stmt->execute([$name]); 
        $stmt2->execute([$code]);

        
        //fetch result
        $namedepart = $stmt->fetch();
        $codedepart = $stmt2->fetch();
        
        
        if($namedepart)
          $_SESSION['error']="Department Name Already Exist.";
          else if($codedepart)
            $_SESSION['error']="Department code Already Exist.";
            
      
        else{  

        $sql = "INSERT INTO  departments (`name_dept`,`code_dept`) VALUES (?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code]);
      
      }  
    }
  }
}
    
  



//---ADD BUILDING
  function addBldg($code,$name){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['name'] != "" || $_POST['code'] != ""  ){  
        $name=$_POST["name"];
        $code=$_POST["code"];
       

        $stmt = $conn->prepare("SELECT * FROM building WHERE name_bldg=?");
        $stmt2 = $conn->prepare("SELECT * FROM building WHERE code_bldg=?");
  
        //execute the statement
        $stmt->execute([$name]); 
        $stmt2->execute([$code]);
        
        //fetch result
        $namebldg = $stmt->fetch();
        $codebldg = $stmt2->fetch();
        
        
        if($namebldg) 
          $_SESSION['error']="Building Name Already Exist.";
          else if($codebldg)
            $_SESSION['error']="Building Code Already Exist.";
            
          
          
         
          
        else{
      
        $sql = "INSERT INTO building (`name_bldg`, `code_bldg`) VALUES (?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code]);
      
      } 
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

        $stmt = $conn->prepare("SELECT * FROM room WHERE code_room=?");
       
        //execute the statement
     
        $stmt->execute([$code]);
        
        //fetch result
        
        $coderoom = $stmt->fetch();
        
        
        if($coderoom) 
          $_SESSION['error']="Room Already Exist.";
            
          
         
          
        else{
      
        $sql = "INSERT INTO room (`code_room`, `bldg_id`) VALUES (?,?)";
        $query = $conn->prepare($sql);
        $query->execute([$code,$bldg]);
      
      }  
    }
  }
}



//---UPDATE SCHEDULE
  function updSchd($user,$sub,$sec,$day,$strtime,$endtime,$room){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['user'] != "" || $_POST['sub'] != "" || $_POST['sec'] != "" || $_POST['day'] != "" || $_POST['strtime'] != "" || $_POST['endtime'] != "" || $_POST['room'] != ""){
        function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }
        $id=$_REQUEST['updid'];
        $sql="SELECT * FROM schedules WHERE id_schd=?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);
         $check = $query->fetch();


       

        
        $user=$_POST['user'];
        $sub=$_POST['sub'];
        $sec=$_POST['sec'];
        $day=$_POST['day'];
        $strtime=$_POST['strtime'];
        $endtime=$_POST['endtime'];
        $room=$_POST['room'];
        

        if ($user == $check['user_id'] && $sub == $check['sub_id'] && $sec == $check['sec_id'] && $day == $check['day_schd'] &&  
        $strtime ==  $check['strtime_schd'] && $endtime ==  $check['endtime_schd']  && $room ==  $check['room_id']) {
          header("location: ../schedules.php");
          exit();
        }
        if($user != $check['user_id']){
          $sql="UPDATE schedules set  user_id=?  where id_schd=?";
          $query = $conn->prepare($sql);
          $query->execute([$user,$id]);
  
          header("location: ../schedules.php");
        }
        if($sub != $check['sub_id']){
          $sql="UPDATE schedules set  sub_id=?  where id_schd=?";
          $query = $conn->prepare($sql);
          $query->execute([$sub,$id]);
  
          header("location: ../schedules.php");
        }
        if($sec != $check['sec_id']){
          $sql="UPDATE schedules set  sec_id=?  where id_schd=?";
          $query = $conn->prepare($sql);
          $query->execute([$sec,$id]);
  
          header("location: ../schedules.php");
        }

        $stmt ="SELECT * FROM schedules WHERE  day_schd=? AND room_id=? AND ((strtime_schd <= ? AND endtime_schd >= ?) OR (strtime_schd <=? AND endtime_schd >= ?))";
        $query = $conn->prepare($stmt);
        $query->execute([$day,$room,$strtime,$strtime,$endtime,$endtime]);
        $row = $query->rowCount();
        $fetch = $query->fetch();

        

          if($row>0){
          phpAlert( "ERROR\\n\\nSchedule overlapped" ); 
          
          
           }
    
        else{



        $sql="UPDATE schedules set id_schd=?, user_id=?, sub_id=?, sec_id=?, day_schd=?, strtime_schd=?, endtime_schd=?, room_id=? where id_schd=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$user,$sub,$sec,$day,$strtime,$endtime,$room,$id]);

        header("location: ../schedules.php");


        
      }
    }
  }
}


//---UPDATE STUDENT
  function updStd($flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['flname'] != "" || $_POST['email'] != "" || $_POST['studnum'] != "" || $_POST['gflname'] != "" || $_POST['gemail'] != "" || $_POST['crs'] != "" || $_POST['yr'] != "" || $_POST['sec'] != ""){
        function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }
       
        $id=$_REQUEST['updid'];
        $sql="SELECT * FROM students WHERE id_std=?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);
         $check = $query->fetch();


        $flname=$_POST['flname'];
        $email=$_POST['email'];
        $studnum=$_POST['studnum'];
        $gflname=$_POST['gflname'];
        $gemail=$_POST['gemail'];
        $crs=$_POST['crs'];
        $yr=$_POST['yr'];
        $sec=$_POST['sec'];

        if ($flname == $check['flname_std'] && $email == $check['instemail_std'] && $studnum == $check['studnum_std'] && $gflname == $check['gflname_std'] &&  $gemail ==  $check['gemail_std'] && $crs==  $check['crs_id']  && $yr ==  $check['yrlvl_id'] && $sec ==  $check['sec_id']) {
          header("location: ../students.php");
          exit();
        }

        if($flname != $check['flname_std']){
          
            $sql="UPDATE students set id_std=?, flname_std=?, instemail_std = ?, studnum_std=?, gflname_std=?, gemail_std=?, crs_id=?, yrlvl_id=?, sec_id=? where id_std=?";
            $query = $conn->prepare($sql);
            $query->execute([$id,$flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec,$id]);
            header("location: ../students.php");  
        }
        if($crs!= $check['crs_id']){
          
            $sql="UPDATE students set id_std=?, flname_std=?, instemail_std = ?, studnum_std=?, gflname_std=?, gemail_std=?, crs_id=?, yrlvl_id=?, sec_id=? where id_std=?";
            $query = $conn->prepare($sql);
            $query->execute([$id,$flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec,$id]);
            header("location: ../students.php");  
        }
        if($yr != $check['yrlvl_id']){
          
            $sql="UPDATE students set id_std=?, flname_std=?, instemail_std = ?, studnum_std=?, gflname_std=?, gemail_std=?, crs_id=?, yrlvl_id=?, sec_id=? where id_std=?";
            $query = $conn->prepare($sql);
            $query->execute([$id,$flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec,$id]);
            header("location: ../students.php");  
        }
         if($yr != $check['yrlvl_id']){
          
            $sql="UPDATE students set id_std=?, flname_std=?, instemail_std = ?, studnum_std=?, gflname_std=?, gemail_std=?, crs_id=?, yrlvl_id=?, sec_id=? where id_std=?";
            $query = $conn->prepare($sql);
            $query->execute([$id,$flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec,$id]);
            header("location: ../students.php");  
  
         
        }
        if($studnum != $check['studnum_std']){
          $stmt ="SELECT * FROM students WHERE  studnum_std = ? ";
          $query = $conn->prepare($stmt);
          $query->execute([ $studnum]);
          $row = $query->rowCount();
          $fetch = $query->fetch();
    
            if($row>0){
            phpAlert( "ERROR\\n\\nStudent Number Already Exist" ); 
          }
          else{
            $sql="UPDATE students set id_std=?, flname_std=?, instemail_std = ?, studnum_std=?, gflname_std=?, gemail_std=?, crs_id=?, yrlvl_id=?, sec_id=? where id_std=?";
            $query = $conn->prepare($sql);
            $query->execute([$id,$flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec,$id]);
            
  
          header("location: ../students.php");
            }
          }
          if($email != $check['instemail_std']){
            $stmt ="SELECT * FROM students WHERE  instemail_std = ? ";
            $query = $conn->prepare($stmt);
            $query->execute([ $email]);
            $rows = $query->rowCount();
            $fetch = $query->fetch();
      
              if($rows>0){
              phpAlert( "ERROR\\n\\nEmail Already Exist" ); 
            }
            else{
              $sql="UPDATE students set id_std=?, flname_std=?, instemail_std = ?, studnum_std=?, gflname_std=?, gemail_std=?, crs_id=?, yrlvl_id=?, sec_id=? where id_std=?";
              $query = $conn->prepare($sql);
              $query->execute([$id,$flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec,$id]);
              header("location: ../students.php");  
    
            
              }
            }
            if($gemail != $check['gemail_std']){
              $stmt ="SELECT * FROM students WHERE  gemail_std = ? ";
              $query = $conn->prepare($stmt);
              $query->execute([ $gemail]);
              $rows = $query->rowCount();
              $fetch = $query->fetch();
        
                if($rows>0){
                phpAlert( "ERROR\\n\\nGuardian Email Already Exist" ); 
              }
              else{
                $sql="UPDATE students set id_std=?, flname_std=?, instemail_std = ?, studnum_std=?, gflname_std=?, gemail_std=?, crs_id=?, yrlvl_id=?, sec_id=? where id_std=?";
                $query = $conn->prepare($sql);
                $query->execute([$id,$flname,$email,$studnum,$gflname,$gemail,$crs,$yr,$sec,$id]);
                header("location: ../students.php");  
      
              
                }
              }
          
        }
      }
    } 
  
    

  

  





//---UPDATE USER(ADMIN)
  function updUsrAdmin($hnr,$flname,$email,$empnum,$pwd){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['hnr'] != "" || $_POST['flname'] != "" || $_POST['email'] != "" || $_POST['empnum'] != "" || $_POST['pwd'] != ""){
        function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }

        $id=$_REQUEST['updid'];
        $sql="SELECT * FROM users WHERE id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);
         $check = $query->fetch();

         
        $hnr=$_POST['hnr'];
        $flname=$_POST['flname'];
        $email=$_POST['email'];
        $empnum=$_POST['empnum'];
        $pwd=$_POST['pwd'];
        $pwdhashed=password_hash($pwd,PASSWORD_DEFAULT);

        if ($hnr == $check['hnr_users'] && $flname == $check['flname_users'] && $email == $check['instemail_users'] &&  $empnum == $check['empnum_users'] &&  $pwd ==  $check['pwd_users']) {
          header("location: ../teachers.php");
          exit();
        }
        if($hnr != $check['hnr_users']){  
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users= ?, empnum_users=?, pwd_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwdhashed,$id]);

        header("location: ../teachers.php"); 
      }
      if($flname != $check['flname_users']){
          
            
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users= ?, empnum_users=?, pwd_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$id]);

        header("location: ../teachers.php");  
    }
    if($email != $check['instemail_users']){
      $stmt ="SELECT * FROM users WHERE  instemail_users = ? ";
      $query = $conn->prepare($stmt);
      $query->execute([ $email]);
      $rows = $query->rowCount();
      $fetch = $query->fetch();

        if($rows>0){
        phpAlert( "ERROR\\n\\n Email Already Exist" ); 
      }
      else{
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users= ?, empnum_users=?, pwd_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$id]);

        header("location: ../teachers.php");   

      
        }
      }
      if($empnum != $check['empnum_users']){
        $stmt ="SELECT * FROM users WHERE  empnum_users = ? ";
        $query = $conn->prepare($stmt);
        $query->execute([ $empnum]);
        $rows = $query->rowCount();
        $fetch = $query->fetch();
  
          if($rows>0){
          phpAlert( "ERROR\\n\\nEmployee Number Already Exist" ); 
        }
        else{
          $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users= ?, empnum_users=?, pwd_users=? where id_users=?";
          $query = $conn->prepare($sql);
          $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$id]);
  
          header("location: ../teachers.php");  

        
          }
        }
        if($pwd != $check['pwd_users']){
          
               
          $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users= ?, empnum_users=?, pwd_users=? where id_users=?";
          $query = $conn->prepare($sql);
          $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$id]);
  
          header("location: ../teachers.php"); 
        }

        

        
      }
    }
  }

  



//---UPDATE USER(SUPERADMIN)
  function updUsrSupAdmin($hnr,$flname,$email,$empnum,$pwd,$usertype){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['hnr'] != "" || $_POST['flname'] != "" || $_POST['email'] != "" || $_POST['empnum'] != "" || $_POST['pwd'] != "" || $_POST['usertype'] != ""){

       function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }

        $id=$_REQUEST['updid'];
        $sql="SELECT * FROM users WHERE id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);
         $check = $query->fetch();

         
        $hnr=$_POST['hnr'];
        $flname=$_POST['flname'];
        $email=$_POST['email'];
        $empnum=$_POST['empnum'];
        $pwd=$_POST['pwd'];
        $usertype=$_POST['usertype'];
        $pwdhashed=password_hash($pwd,PASSWORD_DEFAULT);
       

        if ($hnr == $check['hnr_users'] && $flname == $check['flname_users'] && $email == $check['instemail_users'] &&  $empnum == $check['empnum_users'] &&  $pwd ==  $check['pwd_users'] &&  $usertype ==  $check['usertype_users']) {
          header("location: ../users.php");
          exit();
        }
        if($hnr != $check['hnr_users']){  
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwdhashed,$usertype,$id]);

        header("location: ../users.php");
      }
      if($flname != $check['flname_users']){
          
            
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwdhashed,$usertype,$id]);

        header("location: ../users.php"); 
    }
    if($email != $check['instemail_users']){
      $stmt ="SELECT * FROM users WHERE  instemail_users = ? ";
      $query = $conn->prepare($stmt);
      $query->execute([$email]);
      $rows = $query->rowCount();
      $fetch = $query->fetch();

        if($rows>0){
        phpAlert( "ERROR\\n\\n Email Already Exist" ); 
      }
      else{
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$usertype,$id]);

        header("location: ../users.php");  

      
        }
      }
      if($empnum != $check['empnum_users']){
        $stmt ="SELECT * FROM users WHERE empnum_users = ? ";
        $query = $conn->prepare($stmt);
        $query->execute([$empnum]);
        $rows = $query->rowCount();
        $fetch = $query->fetch();
  
          if($rows>0){
          phpAlert( "ERROR\\n\\nEmployee Number Already Exist" ); 
        }
        else{
          $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$usertype,$id]);

        header("location: ../users.php");
        }
      }
        if($pwd != $check['pwd_users']){
          
               
          $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$usertype,$id]);

        header("location: ../users.php");
        }
        if($usertype != $check['usertype_users']){  
          $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
          $query = $conn->prepare($sql);
          $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$usertype,$id]);
  
          header("location: ../users.php");
        

       
        


        
      }
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
        
        function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }

        $id=$_REQUEST['updid'];
        $sql="SELECT * FROM courses WHERE id_crs=?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);
         $check = $query->fetch();

        $name=$_POST['name'];
        $code=$_POST['code'];
        $dept=$_POST['dept'];

        if ($name == $check['name_crs'] && $code == $check['code_crs'] && $dept == $check['dept_id']) {
          header("location: ../courses.php");
          exit();
        }
        if($name != $check['name_crs']){
          $stmt ="SELECT * FROM courses WHERE name_crs = ? ";
          $query = $conn->prepare($stmt);
          $query->execute([$name]);
          $rows = $query->rowCount();
          $fetch = $query->fetch();
    
            if($rows>0){
            phpAlert( "ERROR\\n\\nCourse Name Already Exist" ); 
          }
          else{
            $sql="UPDATE courses set name_crs=?, code_crs=?, dept_id=? where id_crs  =?";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$dept,$id]);

        header("location: ../courses.php");
          }
        }
        if($code != $check['code_crs']){
          $stmt ="SELECT * FROM courses WHERE code_crs = ? ";
          $query = $conn->prepare($stmt);
          $query->execute([$code]);
          $rows = $query->rowCount();
          $fetch = $query->fetch();
    
            if($rows>0){
            phpAlert( "ERROR\\n\\nCourse Code Already Exist" ); 
          }
          else{
            $sql="UPDATE courses set name_crs=?, code_crs=?, dept_id=? where id_crs  =?";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$dept,$id]);

        header("location: ../courses.php");
          }
        }
            
        
        
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
  function delUserSuperAdmin($iduser){
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




}