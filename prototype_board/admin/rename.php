<?php



<?php

include ('../db_connect.php');
session_start();
$user_id = $_SESSION['user_id'];

$oldname = '../uploads/te.jpg';
$newname = '../uploads/te2.jpg';

if (rename($oldname, $newname)) {
    $sql="UPDATE `files` SET `filename` = 'te.jpg' WHERE `files`.`f_id` = 1";
    $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));
    if($sql){
      header('location: ../admin/index.php?page=files');
    }else{
      echo "Sorry, there was an error uploading your file.";
    }
} else {
	$message = sprintf(
		'There was an error renaming file %s',
		$oldname
	);
    echo $message;
}





// INSERT INTO `files` (`f_id`, `user_id`, `filename`, `file_type`, `date_uploaded`, `feedback`, `file_path`) VALUES (NULL, '', 'test', 'testtes', '', 'test', 'test');
?>



