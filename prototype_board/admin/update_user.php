<?php
include ('../db_connect.php');
session_start();
$user_id = $_SESSION['user_id'];
$u_user_id    =  $_POST['u_user_id'];
	$u_username    =  $_POST['u_username'];
	$u_name    =  $_POST['u_name'];
	$u_email    =  $_POST['u_email'];

	$u_user_group    =  $_POST['u_user_group'];
	$u_user_type    =  $_POST['u_user_type'];


	if($u_user_type=='user'){
		$sql="UPDATE `users` SET `username` = '$u_username', `name` = '$u_name', `email` = '$u_email', `name` = '$u_name', `group_id` = '$u_user_group', `user_type` = '$u_user_type' WHERE `user_id` = '$u_user_id'";
		$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));
		if ($q) {
			header('location: ../admin/index.php?page=users');
		}else{
			echo 'err';
		}
	
	}else{
		$sql="UPDATE `users` SET `username` = '$u_username', `name` = '$u_name', `email` = '$u_email', `name` = '$u_name', `group_id` = '0', `user_type` = '$u_user_type' WHERE `user_id` = '$u_user_id'";
		$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));
		if ($q) {
			header('location: ../admin/index.php?page=users');
		}else{
			echo 'err';
		}
	
	}

?>