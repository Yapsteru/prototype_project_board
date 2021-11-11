<!DOCTYPE html>
<?php
$conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
$db = mysqli_select_db($conn,"db_fms");
$sql = "SELECT * FROM files";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));
$sql2 = "SELECT * FROM groups";
$q2 = mysqli_query($conn,$sql2) or die (mysqli_error($conn));

$sql3 = "SELECT * FROM groups";
$q3 = mysqli_query($conn,$sql3) or die (mysqli_error($conn));

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


<div class="col-2">
		<div class="first-modal">
			<!-- Trigger/Open The Modal -->
			<button class="modal-button" href="#myModal1"> + New User</button>

				<!-- The Modal -->
				<div id="myModal1" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	<div class="modal-header">
				      <span class="close">×</span>
				      <h2>Add User</h2>
			    	</div>

				    <div class="modal-body">
				    	<div class="form-body">
						<form method="post" action="index.php?page=users.php">
						<div class="input-group">
									<label>Username</label>
									<input type="text" name="username" >
								</div>
								<div class="input-group">
									<label>Name</label>
									<input type="text" name="name">
								</div>
								<div class="input-group">
									<label>Email</label>
									<input type="email" name="email">
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
	
<div class="first-modal">
			<!-- Trigger/Open The Modal -->
	
				<!-- The update Modal -->
				<div id="UpdateFile" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	<div class="modal-header">
				      <span class="close">×</span>
				      <h2>Update User</h2>
			    	</div>

				    <div class="modal-body">
				    	<div class="form-body">
						<form action="update_user.php" method="post" enctype="multipart/form-data">
						<div class="input-group">
									<label style="display:none">user_id</label>
									<input style="display:none" type="text" name="u_user_id" id="u_user_id">
								</div>
						<div class="input-group">
									<label>Username</label>
									<input type="text" name="u_username" id="u_username">
								</div>
								<div class="input-group">
									<label>Name</label>
									<input type="text" name="u_name" id="u_name">
								</div>
								<div class="input-group">
									<label>Email</label>
									<input type="email" name="u_email" id="u_email">
								</div>
								<div class="input-group">
									<label>User type</label>
									<select name="u_user_type" id="u_user_type" style="  height: 40px;
									width: 93%;
									padding: 5px 10px;
									background: white;
									font-size: 16px;
									border-radius: 5px;
									border: 1px solid gray;">
									
										<option value="admin">Admin</option>
										<option value="user">User</option>
									</select>
								</div>
								<div id="u_user" class="input-group" style="display:none">
									<label>User Group</label>
									<select name="u_user_group" id="u_user_group" style="  height: 40px;
									width: 93%;
									padding: 5px 10px;
									background: white;
									font-size: 16px;
									border-radius: 5px;
									border: 1px solid gray;">
									<?php
									while($row = mysqli_fetch_assoc($q3))
									{
								?> 
								<option value="<?php echo $row['group_id']?>"><?php echo  $row['group_name'];?></option>
								<?php
								}
								?>
									</select>
								</div>
							
								<br>
								<div class="input-group">
									<button type="submit" class="btn" name="register_btn"> + Update User</button>
								</div>
						</form>
				    	</div>
				    </div>
				  </div>
				</div>
		</div>
<div id="tbody">

	<table class="table table-sm table-bordered" id="mydataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                  
                      <th width="35%">Name</th>
                      <th width="20%">Email</th>
                      <th width="25%">User type</th>
                      <th width="20%">Group</th>
					  <th width="20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
               
                  </tbody>
                </table>
	
	</div>

	

	
<script>
$(document).ready(function() {
	get_products_data();
	$(function() {
        $('#user_type').change(function(){
			
			if($(this).val()=="user"){  
				$('#' + $(this).val()).show();
			}else{
				 $('#user').hide();
			}
          
        });
    });
	$(function() {
        $('#u_user_type').change(function(){
			
			if($(this).val()=="user"){  
				$('#u_user').show();
			}else{
				 $('#u_user').hide();
			}
          
        });
    });
} );

function get_products_data(){
    $("#mydataTable").DataTable().destroy();
    $("#mydataTable").dataTable({
    
      "ajax":{
        "type":"POST",
        "url":"ajax/datatables/get_users.php",
        "data":"",
        "processing":true
      },
      "columns":[
      {
        "data":"name"
      },
	  {
        "data":"email",
      },  {
        "data":"user_type",
      },
      {
        "data":"group_name",
      },
      {
        "mRender": function(data,type,row){
            return "<div class='dropdown'> <button class='dropbtn'>Action<i class='bx bx-down-arrow' ></i></button><div class='dropdown-content'><a onclick='selected_id("+JSON.stringify(row)+")'>Edit User</a><a onclick='delete_file("+JSON.stringify(row)+")'>Delete</a></div></div>";
        }
      },
      ]
    });
  }


  function delete_file(val){
	if (confirm('Are you sure you want to delete '+val.name+'?')) {
  // Save it!
  url = "./ajax/delete_user.php";
    
      $.post(url,{user_id: val.user_id}, function(data){
		console.log(data);
            if(data == 1){
				window.location.href = "index.php?page=users";
    		}else{
     
 			}
});

  console.log('Thing was saved to the database.');
} else {
  // Do nothing!
  console.log('Thing was not saved to the database.');
}
}

  
function selected_id(val){
	
	var modals = document.querySelectorAll('.modal');
	modal = document.querySelector('#UpdateFile');
	modal.style.display = "block";
	document.getElementById("u_user_id").value = val.user_id;
	document.getElementById("u_username").value = val.username;
	document.getElementById("u_name").value = val.name;
	document.getElementById("u_email").value = val.email;
	// document.getElementById("u_user_type").value = val.user_type;
	// document.getElementById("u_user_group").value =val.group_id;
	document.getElementById("u_password").value = val.password;
	document.getElementById("u_c_password").value = val.password;

	if(val.user_type=="user"){
		$("#u_user_type").val(val.user_type);
	
		$("#u_user").show()
		$("#u_user_group").val(val.group_id);
	}else{
		$("#u_user_type").val(val.user_type);
		$("#u_user").hide()
	
	}


}

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