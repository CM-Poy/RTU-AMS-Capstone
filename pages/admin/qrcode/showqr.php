<!DOCTYPE html>
<html lang="en">

<?php 



include('../../includes/header.php'); 
require('../../includes/config.php');

$id=$_REQUEST['qrid'];

global $conn;
$sql = "SELECT flname_std ,qrcode_std from students where students.id_std=?";
$result = $conn->prepare($sql);
$result->execute([$id]);

    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            
            $name=$row['flname_std'];
            $qrcode=$row['qrcode_std'];
        }
    }


?>
  
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../../css/css_update/updatestyle.css">
    
    <title>QR CODE</title>
</head>
<body>

    
   
<div class="edit-wrapper">
        <div class="edit-container">
            <p class="title">QR CODE</p>
            <div class="separator"></div>
            <form method="post">
              
              <label><?php echo $name; ?></label>
                <div class="form-control">
                  <img src="../../../images/qrcodes/<?php echo $qrcode; ?>" alt="NO QR AVAILABLE" width="400" height="400">
                </div>

                <a href="../students.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Back" ></a>
            </form>
          </div>
        </div>

    
</body>
</html>
<script>
window.addEventListener('load', function() {
  // Get the current page URL
  var currentUrl = window.location.href;
  
  // Change the URL to the desired format
  var newUrl = currentUrl + '?rtuams-showqr-std?=rms';
  window.history.pushState({ path: newUrl }, '', newUrl);
});
</script>