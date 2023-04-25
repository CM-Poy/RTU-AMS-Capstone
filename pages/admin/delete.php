<?php 
                    require('../includes/config.php');

                   
 $post_id = $_REQUEST['id'];
 $pdo_statement = $conn->prepare("delete from students where id_std=" . $post_id);
 $result = $pdo_statement->execute();
 if (!empty($result) ){
   
 echo "<script language='javascript'>";
                    echo 'window.location.replace("students.php");';
                    echo "</script>";
                }
                  ?>