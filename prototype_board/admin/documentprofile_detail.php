<!DOCTYPE html>
<?php
$folder_path = $_REQUEST['folder_path'];
$folder_name  = $_REQUEST['folder_name'];
$folder_id = $_REQUEST['folder_id'];
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
	  <form action="update_file_profile_details.php" method="post" enctype="multipart/form-data">
  
			  <?php echo display_error(); ?>

			  <div class="input-group">
			  	  <label style="display:none">folder_path</label>
				  <input type="text" id="folder_path" name="folder_path" value="<?php  $Str = trim($folder_path, '"'); echo $Str;?>" style="display:none">
				  <label style="display:none">folder_name</label>
				  <input type="text" id="folder_id" name="folder_id" value="<?php  $Str = trim($folder_id, '"'); echo $Str;?>" style="display:none">
				  <label style="display:none">folder_name</label>
				  <input type="text" id="folder_name" name="folder_name" value="<?php  $Str = trim($folder_name, '"'); echo $Str;?>" style="display:none">

				  <label style="display:none">File_id</label>
				  <input type="text" id="file_id" name="file_id" value="" style="display:none">

				  <label style="display:none">File Path</label>
				  <input type="text" id="file_path" name="file_path" value="" style="display:none">

				  <label style="display:none">File Name</label>
				  <input style="display:none" type="text" id="file_name" name="file_name" value="">
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

<h1>Document Profile: <?php  $Str = trim($folder_name, '"'); echo $Str;?></h1>

<div class="col-2">
		<div class="first-modal">
			<!-- Trigger/Open The Modal -->
			<button class="modal-button" href="#ModalFile"> + Upload</button>

				<!-- The Modal -->
				<div id="ModalFile" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	<div class="modal-header">
				      <span class="close">×</span>
				      <h2>Add File</h2>
			    	</div>

				    <div class="modal-body">
				    	<div class="form-body">
				    	<form action="upload_documentprofile.php" method="post" enctype="multipart/form-data">
						<input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input" style="align:center">
								<?php echo display_error(); ?>

                                <div class="input-group">
									<label>Folder ID</label>
									<input type="text" name="folder_id" value="<?php  $Str = trim($folder_id, '"'); echo $Str;?>">
								</div>
                                <div class="input-group">
									<label>Folder PATH</label>
									<input type="text" name="folder_path" value="<?php  $Str = trim($folder_path, '"'); echo $Str;?>">
								</div>

                                <div class="input-group">
									<label>Folder Name</label>
									<input type="text" name="folder_name" value="<?php  $Str = trim($folder_name, '"'); echo $Str;?>">
								</div>

								<div class="input-group">
									<label>Remarks</label>
									<input type="text" name="remarks">
								</div>
								
						
								<br>
								<div class="input-group">
									<button type="submit" class="btn" name="uploadfile_btn" value="uploadfile_btn"> + Upload File</button>
								
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
                      
                  
                      <th width="35%">File Name</th>
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
	get_products_data(<?php echo $folder_id;?>);
} );

function get_products_data(val){
    $("#mydataTable").DataTable().destroy();
    $("#mydataTable").dataTable({
    
      "ajax":{
        "type":"POST",
        "url":"ajax/datatables/get_files_data_by_folder.php",
        "data":{ "folder_id" : val,},
        "processing":true
      },
      "columns":[
      {
        "data":"filename"
      },
	  {
        "data":"date_uploaded",
      },
      {
        "data":"remarks",
      },
      {
        "mRender": function(data,type,row){
            return "<div class='dropdown'> <button class='dropbtn'>Action<i class='bx bx-down-arrow' ></i></button><div class='dropdown-content'><a href="+row.file_path+" rel='nofollow'>View</a><a href="+row.file_path+" download>Download</a><a onclick='selected_id("+JSON.stringify(row)+")'>Rename</a><a onclick='delete_file("+JSON.stringify(row)+")'>Delete</a><a href='index.php?page=sharefiles&f_id="+JSON.stringify(row.f_id)+"&filename="+JSON.stringify(row.filename)+"'>Share</a></div></div>";
        }
      },
      ]
    });
  }


  function delete_file(val){
	if (confirm('Are you sure you want to delete '+val.folder_path+'?')) {
  url = "./ajax/delete_file_profile.php";
      $.post(url,{file_id: val.f_id,fname:val.filename,folder_path:val.folder_path}, function(data){
		console.log(data);
            if(data == 1){
				window.location.href = 'index.php?page=documentprofile_details&folder_name='+val.folder_name+'&folder_path='+val.folder_path+'&folder_id='+val.folder_id;
    		}else{
				alert('failed to delete');
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
	let str = val.filename;
const myArr = str.split(".");
	document.getElementById("file_path").value = val.file_path;
	document.getElementById("file_id").value = val.f_id;
	document.getElementById("file_name").value = val.filename;
	document.getElementById("file_newname").value = myArr[0];

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
