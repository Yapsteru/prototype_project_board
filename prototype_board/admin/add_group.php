<?php

include ('../db_connect.php');
session_start();
$group_name = $_POST['group_name'];


    date_default_timezone_set('Asia/Manila');
    $todays_date = date("Y-m-d H:i:s");
    $sql="INSERT INTO `groups` (`group_id`, `group_name`, `date_added`) VALUES (NULL, '$group_name', '$todays_date')";
    $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));
    if($q){
      header('location: ../admin/index.php?page=groups');
    }else{
      echo "Sorry, there was an error uploading your file.";
    }

?>