<?php
include ('../db_connect.php');
session_start();

	$file_id    =  $_POST['file_id'];
	$user_id    =  $_POST['user_id'];
	$filename    =  $_POST['filename'];

	$intfile_id = (int)$file_id;

        $sql="INSERT INTO `share` (`share_id`, `user_id`, `file_id`) VALUES (NULL, '$user_id', '$intfile_id');";
        $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

      

	if ($q) {
        header('location: ../admin/index.php?page=sharefiles&f_id="'.$file_id.'"&filename="'.$filename.'"');
	}else{
        echo 'err';
    }

?>