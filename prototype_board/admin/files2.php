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
<!-- The Modal -->
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
	<div class="row">
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
				    	<form action="upload.php" method="post" enctype="multipart/form-data">
						<input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input" style="align:center">
								<?php echo display_error(); ?>

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
<div class="col-2">
		<div class="first-modal">
			<!-- Trigger/Open The Modal -->
			<button class="modal-button" href="#ModalFolder"> + Add Folder</button>

				<!-- The Modal -->
				<div id="ModalFolder" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				    <div class="modal-body">
				    	<div class="form-body">
				    	<form action="upload.php" method="post" enctype="multipart/form-data">
					
								<?php echo display_error(); ?>

								<div class="input-group">
									<label>Folder Name</label>
									<input type="text" name="username" value="<?php echo $username; ?>">
								</div>
								
							
								<br>
								<div class="input-group">
									<button type="submit" class="btn" name="add_folder_btn" value="Upload Image"> + Add Folder</button>
								
								</div>
							</form>
				    	</div>
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
				<th width="50%">File Name</th>
				<th width="10%">Remarks</th>
				<th width="10%">Date uploaded</th>
				<th width="10%"></th>
			</tr>
			<?php
		
						while($r = mysqli_fetch_assoc($q))
						{
					?> 
			 	<tr>
			 		<td><?php echo $r['filename'];?></td>
					 <td><?php echo $r['remarks'];?></td>
					 <td><?php echo $r['date_uploaded'];?></td>
					<?php $file_id = $r['f_id'];
					$fname =  $r['filename'];
					$fpath =  $r['file_path'];
					
					?>
		
		</td>
		<td>
		

		<div class="dropdown">
						  <button class="dropbtn">Action</button>
						  <div class="dropdown-content">
						  <a href="../uploads/<?php echo $fname;?>" rel="nofollow">View</a>
						 	<a href="../uploads/<?php echo $fname;?>" download>Download</a>
							 <a onclick="selected_id('<?php echo $file_id;?>','<?php echo $fname;?>','<?php echo $fpath;?>')"> Rename</a>
		
							<a onclick="delete_file('<?php echo $file_id;?>','<?php echo $fname;?>','<?php echo $fpath;?>')"> Delete</a>
		 					<a onclick="delete_file('<?php echo $file_id;?>','<?php echo $fname;?>','<?php echo $fpath;?>')"> Share</a>
						</div>
						</div>
	</td>
</div>
					</td>
			 	</tr>
			 		<?php 
						}
					?>
		</table>
	</div>

	

	
<script>

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


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

function delete_file(val,val2,fpath){
	if (confirm('Are you sure you want to delete '+val2+'?')) {
  // Save it!
  url = "./ajax/delete_file.php";
    
      $.post(url,{file_id: val,fname:val2}, function(data){
		console.log(data);
            if(data == 1){
				window.location.href = "index.php?page=files";
    		}else{
     
 			}
});

  console.log('Thing was saved to the database.');
} else {
  // Do nothing!
  console.log('Thing was not saved to the database.');
}
}

function selected_id (val,val2,file_path){
	var modals = document.querySelectorAll('.modal');
	modal = document.querySelector('#UpdateFile');
	modal.style.display = "block";
	let str = val2;
const myArr = str.split(".");


	document.getElementById("file_path").value = file_path;
	document.getElementById("file_id").value = val;
	document.getElementById("file_name").value = val2;
	document.getElementById("file_newname").value = myArr[0];
}

function downloadfile(){
	$.fileDownload('../uploads/document.pdf')
    .done(function () { alert('File download a success!'); })
    .fail(function () { alert('File download failed!'); });
}



</script>
</body>
</html>