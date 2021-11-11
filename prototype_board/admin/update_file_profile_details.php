<?php
include ('../db_connect.php');
session_start();
$user_id = $_SESSION['user_id'];
$folder_id    =  $_POST['folder_id'];
    $folder_path    =  $_POST['folder_path'];
    $folder_name    =  $_POST['folder_name'];
	$file_id    =  $_POST['file_id'];
	$file_path    =  $_POST['file_path'];
	$file_name    =  $_POST['file_name'];
	$file_newname    =  $_POST['file_newname'];


	$file_old_name = explode(".", $file_name);

	$file_type = $file_old_name[1];
    $complete_file_name = $file_newname.'.'.$file_type;
	$rename_new_file_path = "../uploads/".$file_newname.'.'.$file_type;

	$oldname =$file_path;
	$newname =$rename_new_file_path;

	if (rename($oldname, $newname)) {

        $sql="UPDATE `files` SET `file_path` = '$newname', `filename` = '$complete_file_name' WHERE `files`.`f_id` = '$file_id'";
        $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

      

	if ($q) {
        header('location: ../admin/index.php?page=documentprofile_details&folder_name='.$folder_name.'&folder_path='.$folder_path.'&folder_id='.$folder_id);
    }else{
        echo 'err';
    }

	} else {
		$message = sprintf(
			'There was an error renaming file %s',
			$oldname
		);
    }
?>