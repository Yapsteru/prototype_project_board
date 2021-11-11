<!DOCTYPE html>
<?php
$conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
$db = mysqli_select_db($conn,"db_fms");
$sql = "SELECT * FROM users";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));
$sql2 = "SELECT * FROM groups";
$q2 = mysqli_query($conn,$sql2) or die (mysqli_error($conn));

 include_once('../functions.php')
?>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel = "stylesheet" type="text/css" href="../css/create_user.css" />
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="button-align">
		<div class="first-modal">
			<!-- Trigger/Open The Modal -->
			<button class="modal-button" href="#myModal1"> + New User</button>

				<!-- The Modal -->
				<div id="myModal1" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	<div class="modal-header">
				      <span class="close">×</span>
				      <h2>New User</h2>
			    	</div>

				    <div class="modal-body">
				    	<div class="form-body">
				    		<form method="post" action="index.php?page=users.php">

								<?php echo display_error(); ?>

								<div class="input-group">
									<label>Username</label>
									<input type="text" name="username" value="<?php echo $username; ?>">
								</div>
								<div class="input-group">
									<label>Name</label>ddddddddddddd
									<input type="text" name="name" value="<?php echo $name; ?>">
								</div>
								<div class="input-group">
									<label>Email</label>
									<input type="email" name="email" value="<?php echo $email; ?>">
								</div>
								<div class="input-group">
									<label>User type</label>
									<select name="user_type" id="user_type" >
									
										<option value="admin">Admin</option>
										<option value="user">User</option>
									</select>
								</div>
								<div id="user" class="input-group" style="display:none">
									<label>User Group</label>
									<select name="user_group" id="user_group" style="  height: 40px;
  width: 93%;
  padding: 5px 10px;
  background: white;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;">
									<?php
									while($row = mysqli_fetch_assoc($q2))
									{
								?> 
								<option value="<?php echo $row['group_id']?>"><?php echo  $row['group_name'];?></option>
								<?php
								}
								?>
									</select>
								</div>
								<div class="input-group">
									<label>Password</label>
									<input type="password" name="password_1">
								</div>
								<div class="input-group">
									<label>Confirm password</label>
									<input type="password" name="password_2">
								</div>
								<br>
								<div class="input-group">
									<button type="submit" class="btn" name="register_btn"> + Add user</button>
								</div>
							</form>
				    	</div>
				    </div>
				  </div>
				</div>
		</div>
</div>
	<br>
	<hr>
	<br>

	<div id="tbody">
		<table width="100%">
			<tr>
				<th width="20%">Name</th>
			    <th width="30%">Username</th>
			    <th width="20%">Email</th>
			    <th width="20%">Type</th>
			    <th width="30%"></th>
			</tr>
			<?php
						while($r = mysqli_fetch_assoc($q))
						{
					?> 
			 	<tr>
			 		<td><?php echo $r['name'];?></td>
					<td><?php echo $r['username'];?></td>
					<td><?php echo $r['email'];?></td>
					<td><?php echo $r['user_type'];?></td>
					<?php $user_id = $r['user_id']?>
					<td> 
						<div class="dropdown">
						  <button class="dropbtn">Action</button>
						  <div class="dropdown-content">
						    <a href = "index.php?page=update&user_id=<?php echo $user_id;?>"> Update </a>
							<a href = "index.php?page=delete&user_id=<?php echo $user_id;?>&name=<?php echo $r['name'];?>"> Delete </a>
						  </div>
						</div>
					</td>
			 	</tr>
			 		<?php 
						}
					?>
		</table>
	</div>

<script>

$(document).ready(function() {

    $(function() {
        $('#user_type').change(function(){
			
			if($(this).val()=="user"){  
				$('#' + $(this).val()).show();
			}else{
				 $('#user').hide();
			}
          
        });
    });
} );



// Get the button that opens the modal
var btn = document.querySelectorAll("button.modal-button");

// All page modals
var modals = document.querySelectorAll('.modal');

// Get the <span> element that closes the modal
var spans = document.getElementsByClassName("close");

// When the user clicks the button, open the modal
for (var i = 0; i < btn.length; i++) {
 btn[i].onclick = function(e) {
    e.preventDefault();
    modal = document.querySelector(e.target.getAttribute("href"));
    modal.style.display = "block";
 }
}

// When the user clicks on <span> (x), close the modal
for (var i = 0; i < spans.length; i++) {
 spans[i].onclick = function() {
    for (var index in modals) {
      if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
    }
 }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
     for (var index in modals) {
      if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
     }
    }
}
</script>
</body>
</html>