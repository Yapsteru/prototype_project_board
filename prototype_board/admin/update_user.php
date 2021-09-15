<?php
$user_id = $_GET ['user_id'];
  
$conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
$db = mysqli_select_db($conn,"db_fms");

$sql = "SELECT * FROM users WHERE user_id = $user_id";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

$r = mysqli_fetch_assoc($q); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Project Board</title>
	<link rel="stylesheet" type="text/css" href="../css/create_user.css">
</head>
<body>
	<div class="header">
		<h2>Admin - Update user</h2>
	</div>
	<br>
	<div class="form-body">
		<form method="post" action="update_confirm.php?user_id=<?php echo $user_id?>">

			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" value="<?php echo $r['username']; ?>">
			</div>
			<div class="input-group">
				<label>Name</label>
				<input type="text" name="name" value="<?php echo $r['name']; ?>">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="email" name="email" value="<?php echo $r['email']; ?>">
			</div>
			<div class="input-group">
				<label>User type</label>
				<select name="user_type" id="user_type" value="<?php echo $r['user_type']; ?>">
					<option value=""></option>
					<option value="admin">Admin</option>
					<option value="user">User</option>
				</select>
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password" value="<?php echo $r['password']; ?>">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="update"> Update user</button>
			</div>
		</form>
	</div>
</body>
</html>