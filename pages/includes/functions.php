<?php
declare(strict_types=1);

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require_once('config.php');
session_start();

class dbfunction{

  

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
        $pwdhashed=md5($pwd_users,false);

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
        $pwdhashed=md5($pwd_users,false);

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
          else if($user3)
            $_SESSION['error']="Guardian Email Already Exist.";
        
        
       
        else{   

          require_once ('../../vendor/autoload.php');
          require_once ('../../vendor/phpqrcode/qrlib.php');
          $qrimage = $fullname.$studnum.".svg";
          
          $path='../../images/qrcodes/'.$qrimage;
          $options = new QROptions(
            [
              'eccLevel' => QRCode::ECC_L,
              'outputType' => QRCode::OUTPUT_MARKUP_SVG,
              'version' => 5,
            ]
          );
          
          $qrcode = (new QRCode($options))->render($qrimage, $path);
       
        
      
      
        $sql = "INSERT INTO students (flname_std,instemail_std,studnum_std,gflname_std,gemail_std,crs_id,yrlvl_id,sec_id,qrcode_std) VALUES (?,?,?,?,?,?,?,?,?)";
        $result = $conn->prepare($sql);
        $result->execute([$fullname,$email,$studnum,$gflname,$gemail,$crsname,$yrlvl,$sectname,$qrimage]);
    
    }
  }
}




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

  

 

  function addSchd($user,$sub,$day,$strtime,$endtime,$room){
    global $conn;
    if(ISSET($_POST['addbtn'])){
      if($_POST['usrName'] != "" || $_POST['subName'] != "" || $_POST['day'] != "" || $_POST['strTime'] != "" || $_POST['endtime_schd'] != "" || $_POST['room_id'] != ""){  

        function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }
        $user = $_POST['usrName'];
        $sub = $_POST['subName'];
        $day = $_POST['day'];
        $strtime = $_POST['strTime'];
        $endtime = $_POST['endTime'];
        $room = $_POST['room'];

        
        $stmt ="SELECT * FROM schedules WHERE  day_schd=? AND room_id=? AND ((strtime_schd <= ? AND endtime_schd > ?) OR (strtime_schd < ? AND endtime_schd >= ?) OR (strtime_schd >= ? AND endtime_schd <= ?) OR (strtime_schd <= ? AND endtime_schd >= ?))";
        $query = $conn->prepare($stmt);
        $query->execute([$day,$room,$strtime,$strtime,$endtime,$endtime,$strtime,$endtime,$strtime,$endtime]);
        $row = $query->rowCount();
        $fetch = $query->fetch();

        if($row > 0){
          $_SESSION['error']="ERROR: Schedules Overlapping.";
            
        }else{
       
       

        $sql = "INSERT INTO  schedules (`user_id`, `sub_id`, `day_schd`, `strtime_schd`, `endtime_schd`, `room_id`) VALUES (?,?,?,?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$user,$sub,$day,$strtime,$endtime,$room]);


        



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
}





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
            $_SESSION['error']="Course Code Already Exist.";
            
          
        else{
       

        $sql = "INSERT INTO  courses (`name_crs`,`code_crs`,`dept_id`) VALUES (?,?,?)  ";
        $query = $conn->prepare($sql);
        $query->execute([$name,$code,$dept]);
      
      }  
    }
  }
}




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
    
  




  function addBldg($name,$code){
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
        $day=$_POST['day'];
        $strtime=$_POST['strtime'];
        $endtime=$_POST['endtime'];
        $room=$_POST['room'];
        

        if ($user == $check['user_id'] && $sub == $check['sub_id'] && $day == $check['day_schd'] &&  
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

        $stmt ="SELECT * FROM schedules WHERE  day_schd=? AND room_id=? AND ((strtime_schd <= ? AND endtime_schd > ?) OR (strtime_schd < ? AND endtime_schd >= ?) OR (strtime_schd >= ? AND endtime_schd <= ?) OR (strtime_schd <= ? AND endtime_schd >= ?))";
        $query = $conn->prepare($stmt);
        $query->execute([$day,$room,$strtime,$strtime,$endtime,$endtime,$strtime,$endtime,$strtime,$endtime]);
        $row = $query->rowCount();
        $fetch = $query->fetch();

        

          if($row>0){
          phpAlert( "ERROR\\n\\nSchedule overlapped" ); 
          
          
           }
    
        else{



        $sql="UPDATE schedules set id_schd=?, user_id=?, sub_id=?, sec_id=?, day_schd=?, day_schd=?, strtime_schd=?, endtime_schd=?, room_id=? where id_schd=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$user,$sub,$day,$strtime,$endtime,$room,$id]);

        header("location: ../schedules.php");


        
      }
    }
  }
}

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

        if ($hnr == $check['hnr_users'] && $flname == $check['flname_users'] && $email == $check['instemail_users'] &&  $empnum == $check['empnum_users'] &&  $pwd ==  $check['pwd_users']) {
          header("location: ../teachers.php");
          exit();
        }
        if($hnr != $check['hnr_users']){  
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users= ?, empnum_users=?, pwd_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$id]);

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

        if ($hnr == $check['hnr_users'] && $flname == $check['flname_users'] && $email == $check['instemail_users'] &&  $empnum == $check['empnum_users'] &&  $pwd ==  $check['pwd_users'] &&  $usertype ==  $check['usertype_users']) {
          header("location: ../users.php");
          exit();
        }
        if($hnr != $check['hnr_users']){  
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$usertype,$id]);

        header("location: ../users.php");
      }
      if($flname != $check['flname_users']){
          
            
        $sql="UPDATE users set id_users=?, hnr_users=?, flname_users=?, instemail_users=?, empnum_users=?, pwd_users=?, usertype_users=? where id_users=?";
        $query = $conn->prepare($sql);
        $query->execute([$id,$hnr,$flname,$email,$empnum,$pwd,$usertype,$id]);

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


  function updSub($name,$code,$units){
    global $conn;
    if(ISSET($_POST['updBtn'])){
      if($_REQUEST['updid'] !="" || $_POST['name'] != "" || $_POST['code'] != "" || $_POST['units'] ){

        function phpAlert($msg) { echo '<script type="text/javascript">alert("' . $msg . '")</script>'; }
        
        $id=$_REQUEST['updid'];
        $sql="SELECT * FROM subjects WHERE id_subj=?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);
         $check = $query->fetch();

        $name=$_POST['name'];
        $code=$_POST['code'];
        $units=$_POST['units'];

        if ($name == $check['name_subj'] && $code == $check['code_subj'] && $units == $check['units_subj']) {
          header("location: ../subjects.php");
          exit();
        }

        if($name != $check['name_subj']){
          $stmt ="SELECT * FROM subjects WHERE name_subj = ? ";
          $query = $conn->prepare($stmt);
          $query->execute([$name]);
          $rows = $query->rowCount();
          $fetch = $query->fetch();
    
            if($rows>0){
            phpAlert( "ERROR\\n\\nSubject Name Already Exist" ); 
          }
          else{
            $sql="UPDATE subjects set name_subj=?, code_subj=?, units_subj=? where id_subj=?";
            $query = $conn->prepare($sql);
            $query->execute([$name,$code,$units,$id]);
    
            header("location: ../subjects.php");
          }
        }
        if($code != $check['code_subj']){
          $stmt ="SELECT * FROM subjects WHERE code_subj = ? ";
          $query = $conn->prepare($stmt);
          $query->execute([$code]);
          $rows = $query->rowCount();
          $fetch = $query->fetch();
    
            if($rows>0){
            phpAlert( "ERROR\\n\\nSubject Code Already Exist" ); 
          }
          else{
            $sql="UPDATE subjects set name_subj=?, code_subj=?, units_subj=? where id_subj=?";
            $query = $conn->prepare($sql);
            $query->execute([$name,$code,$units,$id]);
    
            header("location: ../subjects.php");
          }
        }
       
      
        
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


  function remStd($idstd){
    global $conn;
    if(ISSET($_POST['btnRem'])){
      if($_POST['idstd'] != ""){

        $idstd=$_POST['idstd'];
        $id=$_REQUEST['enid'];

        $sql="DELETE from std_enrolled where std_id=? and schd_id=?";
        $query = $conn->prepare($sql);
        $query->execute([$idstd,$id]);
      }
    }
  }




  function enrStd($idstd){
    global $conn;
    if(ISSET($_POST['btnEnstd'])){
      if($_POST['idstd'] != ""){
        
        
        
        

        $idstd=$_POST['idstd']; 
        $id=$_REQUEST['enid'];
       

        $stmt = $conn->prepare("SELECT * FROM std_enrolled WHERE std_id=? AND schd_id=?");
       
  
        //execute the statement
        $stmt->execute([$idstd,$id]); 
       
        
        //fetch result
        
       
        
        
        if($stmt->rowCount() > 0){
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $_SESSION['error']="Student Already Enrolled.";
       
            
          
          }}else{

        $sql="SELECT * FROM students where id_std=?";
        $query = $conn->prepare($sql);
        $query->execute([$idstd]);
        if($query->rowCount() > 0){
          while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $sec=$row['sec_id'];

            $sql2="INSERT INTO std_enrolled (`schd_id`,`std_id`,`sec_id`) VALUES (?,?,?)";
            $query2 = $conn->prepare($sql2);
            $query2->execute([$id,$idstd,$sec]);
            
          }
        }

       
      }
    }
  }
}


function enrSec($idsec){
  global $conn;
  if(ISSET($_POST['btnEnsec'])){
    if($_POST['idsec'] != ""){

      $idsec=$_POST['idsec'];
      
      $id=$_REQUEST['enid'];

      $stmt = $conn->prepare("SELECT * FROM std_enrolled WHERE sec_id=? AND schd_id=?");
      
       
  
      //execute the statement
      $stmt->execute([$idsec,$id]); 
     
      
      //fetch result
      
     
      
      
      if($stmt->rowCount() > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['error']="Section Already Enrolled.";
        }}

        else{
      

      $sql="SELECT * from students where sec_id=?";
      $query = $conn->prepare($sql);
      $query->execute([$idsec]);

      if($query->rowCount() > 0){
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
          
          $idstd=$row["id_std"];
          $sec=$row['sec_id'];
          $id=$_REQUEST['enid'];


          $sql2="INSERT INTO std_enrolled (schd_id,`std_id`,`sec_id`) VALUES (?,?,?)";
          $query2 = $conn->prepare($sql2);
          $query2->execute([$id,$idstd,$sec]);

          $sql4="DELETE FROM std_enrolled where schd_id = ? AND sec_id != ?";
          $query4 = $conn->prepare($sql4);
          $query4->execute([$id,$sec]);


          $sql3="SELECT * FROM schedules WHERE id_schd=?";
          $query3 = $conn->prepare($sql3);
          $query3->execute([$id]);
          if($query3->rowCount() > 0){
            while ($row = $query3->fetch(PDO::FETCH_ASSOC)){
              $sql4="UPDATE schedules set id_schd=?, sec_id=? where id_schd=?";
              $query4 = $conn->prepare($sql4);
              $query4->execute([$id,$idsec,$id]);
            }
          }
        }
      }  
    }
  }
}
}
}











