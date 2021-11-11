<!DOCTYPE html>
<?php
$conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
$db = mysqli_select_db($conn,"db_fms");
$sql = "SELECT * FROM files";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

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
<!-- The Modal Rename modal-->
<div id="UpdateFile" class="modal">
<!-- Modal content -->
<div class="modal-content">
  <div class="modal-body">
	  <div class="form-body">
	  <form action="update_file.php" method="post" enctype="multipart/form-data">
  
			  <?php echo display_error(); ?>

			  <div class="input-group">
				  <label>File_id</label>
				  <input type="text" id="file_id" name="file_id" value="">

				  <label>File Path</label>
				  <input type="text" id="file_path" name="file_path" value="">

				  <label>File Name</label>
				  <input type="text" id="file_name" name="file_name" value="">
				  <label>File Name</label>
				  <input type="text" id="file_newname" name="file_newname" value="">

			  </div>
			  
		  
			  <br>
			  <div class="input-group">
				  <button type="submit" class="btn" name="update_file_btn" value="Upload Image"> Update File</button>
			  
			  </div>
		  </form>
	  </div>
  </div>
</div>
</div>

<div class="col-2">
		<div class="first-modal">
			<!-- Trigger/Open The Modal -->
			<button class="modal-button" href="#ModalFile"> Add Group</button>

				<!-- The Modal -->
				<div id="ModalFile" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	<div class="modal-header">
				      <span class="close">×</span>
				      <h2>Add Group</h2>
			    	</div>

				    <div class="modal-body">
				    	<div class="form-body">
				    	<form action="add_group.php" method="post" enctype="multipart/form-data">
					
								<div class="input-group">
									<label>Group Name</label>
									<input type="text" name="group_name">
								</div>
								
						
								<br>
								<div class="input-group">
									<button type="submit" class="btn" name="uploadfile_btn" value="uploadfile_btn"> Add Group</button>
								
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
				<div id="UpdateGroups" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	<div class="modal-header">
				      <span class="close">×</span>
				      <h2>Update Group</h2>
			    	</div>

				    <div class="modal-body">
				    	<div class="form-body">
						<form action="update_group.php" method="post" enctype="multipart/form-data">
						<div class="input-group">
									<label style="display:none">Group id</label>
									<input style="display:none" type="text" name="u_group_id" id ="u_group_id">
									<label>Group Name</label>
									<input type="text" name="u_group_name" id ="u_group_name">
								</div>
								<div class="input-group">
									<button type="submit" class="btn" name="uploadfile_btn" value="uploadfile_btn"> Update Group</button>
								
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
                      
                  
                      <th width="80%">Group Name</th>
                    
                      <th width="20%">Action</th>
             
                    </tr>
                  </thead>
                  <tbody>
               
                  </tbody>
                </table>
	
	</div>

	

	
<script>
$(document).ready(function() {
	get_groups_data();
} );

function get_groups_data(){
    $("#mydataTable").DataTable().destroy();
    $("#mydataTable").dataTable({
    
      "ajax":{
        "type":"POST",
        "url":"ajax/datatables/get_groups_data.php",
        "data":"",
        "processing":true
      },
      "columns":[
      {
        "data":"group_name"
      },{
        "mRender": function(data,type,row){
			return "<div class='dropdown'> <button class='dropbtn'>Action<i class='bx bx-down-arrow' ></i></button><div class='dropdown-content'><a onclick='selected_id("+JSON.stringify(row)+")'>Edit</a><a onclick='delete_file("+JSON.stringify(row)+")'>Delete</a></div></div>";

        }
      },
	  
      ]
    });
  }


  function delete_file(val){
	if (confirm('Are you sure you want to delete '+val.group_name+'?')) {
  // Save it!
  url = "./ajax/delete_group.php";
    
      $.post(url,{group_id: val.group_id}, function(data){
		console.log(data);
            if(data == 1){
				window.location.href = "index.php?page=groups";
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
	modal = document.querySelector('#UpdateGroups');
	modal.style.display = "block";

	document.getElementById("u_group_id").value = val.group_id;
	document.getElementById("u_group_name").value = val.group_name;


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