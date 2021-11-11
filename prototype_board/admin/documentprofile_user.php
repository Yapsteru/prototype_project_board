<!DOCTYPE html>
<?php
$conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
$db = mysqli_select_db($conn,"db_fms");
$sql = "SELECT * FROM files";
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
<!-- The Modal Rename modal-->
<div id="UpdateFile" class="modal">
<!-- Modal content -->
<div class="modal-content">
  <div class="modal-body">
	  <div class="form-body">
	  <form action="update_folder_name.php" method="post" enctype="multipart/form-data">
  
			  <?php echo display_error(); ?>

			  <div class="input-group">
				  
			 	  <label>Folder old Name</label>
				  <input type="text" id="folder_old_name" name="folder_old_name" value="">

			 	  <label>Folder id</label>
				  <input type="text" id="folder_id" name="folder_id" value="">
				  <label>Folder path</label>
				  <input type="text" id="folder_path" name="folder_path" value="">

			
		
				  <label>Folder Name</label>
				  <input type="text" id="folder_name" name="folder_name" value="">

			  </div>
			  
		  
			  <br>
			  <div class="input-group">
				  <button type="submit" class="btn" name="update_file_btn" value="Upload Image"> Update Folder Name</button>
			  
			  </div>
		  </form>
	  </div>
  </div>
</div>
</div>

<div class="col-2">
		<div class="first-modal">
			<!-- Trigger/Open The Modal -->
		
				<!-- The Modal -->
				<div id="ModalFile" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	

				    <div class="modal-body">
				    	<div class="form-body">
				    	<form action="add_folder.php" method="post" enctype="multipart/form-data">
					
								<?php echo display_error(); ?>

								<div class="input-group">
									<label>Document Profile Name</label>
									<input type="text" name="folder_name">
                                    <label>Description</label>
									<input type="text" name="desc">
									
								</div>
								<div id="user" class="input-group" >
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

						
								<br>
								<div class="input-group">
									<button type="submit" class="btn" name="uploadfile_btn" value="uploadfile_btn"> + Add</button>
								
								</div>
							</form>
				    	</div>
				    </div>
				  </div>
				</div>
		</div>
</div>
	

<div id="tbody">

	<table class="table table-sm table-bordered" id="mydataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                  
                      <th width="35%">Document Profile</th>
					  <th width="25%">Group</th>
                      <th width="20%">Date Uploaded</th>
				
                      <th width="25%">Remarks</th>
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
} );

function get_products_data(){
    $("#mydataTable").DataTable().destroy();
    $("#mydataTable").dataTable({
    
      "ajax":{
        "type":"POST",
        "url":"ajax/datatables/get_folders_user.php",
        "data":"",
        "processing":true
      },
      "columns":[
      {
        "data":"folder_name"
      },
	  {
        "data":"group_name",
      },
	  {
        "data":"date_created",
      },
      {
        "data":"desc",
      },
      {
        "mRender": function(data,type,row){
            return "<div class='dropdown'> <button class='dropbtn'>Action<i class='bx bx-down-arrow' ></i></button><div class='dropdown-content'><a href='index.php?page=documentprofile_details&folder_name="+JSON.stringify(row.folder_name)+"&folder_path="+JSON.stringify(row.folder_path)+"&folder_id="+JSON.stringify(row.folder_id)+"' >Open</a></div></div>";
        }
      },
      ]
    });
  }

  function selected_id(val){
	
	var modals = document.querySelectorAll('.modal');
	modal = document.querySelector('#UpdateFile');
	modal.style.display = "block";


	document.getElementById("folder_name").value = val.folder_name;
	document.getElementById("folder_id").value = val.folder_id;
	document.getElementById("folder_path").value = val.folder_path;
	document.getElementById("folder_old_name").value = val.folder_name;


}


  function delete_file(val){
	if (confirm('Are you sure you want to delete '+val.folder_name+'?')) {
  // Save it!
  url = "./ajax/delete_folder.php";
    
      $.post(url,{folder_id: val.folder_id,folder_name:val.folder_name}, function(data){
		console.log(data);
            if(data == 1){
				window.location.href = "index.php?page=documentprofile";
    		}else{
     
 			}
});

  console.log('Thing was saved to the database.');
} else {
  // Do nothing!
  console.log('Thing was not saved to the database.');
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