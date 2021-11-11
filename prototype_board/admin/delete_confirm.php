<?php

$user_id=$_GET['user_id'];


include ('../db_connect.php');

$sql="DELETE FROM users WHERE user_id = $user_id";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

header ("location: ../admin/index.php?page=users");
?>