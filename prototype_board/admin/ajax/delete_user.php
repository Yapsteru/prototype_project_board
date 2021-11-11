<?php

$user_id=$_POST['user_id'];


include ('../../db_connect.php');

$sql="DELETE FROM users WHERE user_id = $user_id";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

if($q){
echo 1;
}else{
echo 0;
}
?>