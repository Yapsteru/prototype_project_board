<?php

$file_id=$_POST['file_id'];
$fname=$_POST['fname'];
$folder_path = $_POST['folder_path'];
include ('../../db_connect.php');

$sql="DELETE FROM files WHERE f_id = $file_id";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

if($q){
unlink('../'.$folder_path.'/'.$fname);
echo 1;
}else{
echo 0;
}
?>