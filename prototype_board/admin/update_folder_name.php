<?php
include ('../db_connect.php');
session_start();
$user_id = $_SESSION['user_id'];


	$file_id    =  $_POST['folder_id'];
	$folder_newname    =  $_POST['folder_name'];
	$folder_path    =  $_POST['folder_path'];
    $folder_old_name    =  $_POST['folder_old_name'];
    $rename_update_new_folder_path = "../uploads/".$folder_newname;
	$rename_new_folder_path = "C:/xampp/htdocs/prototype_project_board/prototype_board/uploads/".$folder_newname;
	$old_foleder_path = "C:/xampp/htdocs/prototype_project_board/prototype_board/uploads/".$folder_old_name;

	$newname =$rename_new_foleder_path;

	if (rename($old_foleder_path,$rename_new_folder_path)) {

        $sql="UPDATE `folder` SET folder_path ='$rename_update_new_folder_path',`folder_name` = '$folder_newname' WHERE `folder`.`folder_id` = '$file_id'";
        $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

      

	if ($q) {
        header('location: ../admin/index.php?page=documentprofile');
	}else{
        echo 'err';
    }

	} else {
		$message = sprintf(
			'There was an error renaming file %s',
		
		);
    }
?>