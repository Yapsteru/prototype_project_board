<?php

$share_id=$_POST['share_id'];


include ('../../db_connect.php');

$sql="DELETE FROM share WHERE share_id = $share_id";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

if($q){
echo 1;
}else{
echo 0;
}
?>