<?php

$group_id=$_POST['group_id'];


include ('../../db_connect.php');

$sql="DELETE FROM groups WHERE group_id  = $group_id";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

if($q){
echo 1;
}else{
echo 0;
}
?>