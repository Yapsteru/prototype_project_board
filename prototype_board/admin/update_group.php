<?php
include ('../db_connect.php');
session_start();
$u_group_id = $_POST['u_group_id'];
$u_group_name    =  $_POST['u_group_name'];



		$sql="UPDATE groups SET `group_name` = '$u_group_name' WHERE `group_id` = '$u_group_id'";
		$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));
		if ($q) {
			header('location: ../admin/index.php?page=groups');
		}else{
			echo 'err';
		}


?>