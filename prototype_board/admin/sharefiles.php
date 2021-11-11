<!DOCTYPE html>
<?php
$conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
$file_id = $_REQUEST['f_id'];
$filename = $_REQUEST['filename'];
$db = mysqli_select_db($conn,"db_fms");
$sql = "SELECT b.name,b.user_id,c.filename FROM `share` a INNER join users b on a.user_id=b.user_id INNER JOIN files c on a.file_id=c.f_id where c.f_id = '$file_id'";

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
<h1>SHARED FILE <?php echo $filename;?></h1>
<div class="col-2">
		<div class="first-modal">
			<!-- Trigger/Open The Modal -->
			<button class="modal-button" href="#ModalFile"> + Add Shared User</button>

				<!-- The Modal -->
				<div id="ModalFile" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	<div class="modal-header">
				      <span class="close">×</span>
				      <h2>Add Shared User</h2>
			    	</div>

				    <div class="modal-body">
				    	<div class="form-body">
				    	<form action="share_user.php" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <label>File_id</label>
                            <input type="text" id="file_id" name="file_id" value='<?php $Str = trim($file_id, '"'); echo $Str;?>'>
                            <label>File Name</label>
                            <input type="text" id="filename" name="filename" value='<?php echo $filename;?>'>

                         
                            <label>SELECT USER</label>
                                <select class="custom-select" name="user_id" id="user_id" style="width:100%;">
                                    <option value="0">Select User:</option>
                                        <?php 
                                            $supplier = mysqli_query($conn,"SELECT * FROM users");
                                            while($row = mysqli_fetch_array($supplier)){
                                        ?>
                                            <option 
                                        value="<?php echo $row['user_id'];?>"><?php echo $row['name']?></option>
                                        <?php } ?>
                                    </select>
                        </div>
                           

                                
                            
                                    <br>
								<div class="input-group">
									<button type="submit" class="btn" name="uploadfile_btn" value="uploadfile_btn"> + Share</button>
								
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

                      <th width="80%">Shared Users</th>
                      <th width="20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
	</div>
<script>
$(document).ready(function() {
	get_products_data(<?php echo $file_id;?>);
    $('.custom-select').select2();
} );

function get_products_data(file_id){
    console.log(file_id);
    $("#mydataTable").DataTable().destroy();
    $("#mydataTable").dataTable({
    
      "ajax":{
        "type":"POST",
        "url":"ajax/datatables/get_shared_users.php",
        "data":{file_id:file_id},
        "processing":true
      },
      "columns":[
      {
        "data":"name"
      },
	 
      {
        "mRender": function(data,type,row){
            return "<button class='dropbtn' onclick='delete_user("+JSON.stringify(row)+")'>Remove</button>";
        }
      },
      ]
    });
  }


  function delete_user(val){
	if (confirm('Are you sure you want to delete '+val.name+'?')) {
  // Save it!
  url = "./ajax/delete_shareduser.php";
    
      $.post(url,{share_id: val.share_id}, function(data){
		console.log(data);
            if(data == 1){
				window.location.href = "index.php?page=sharefiles&f_id="+val.f_id+"&filename="+val.filename+"";
    		}else{
     
 			}
});

  console.log('Thing was saved to the database.');
} else {
  // Do nothing!
  console.log('Thing was not saved to the database.');
}
}

  
// function selected_id(val){
	
// 	var modals = document.querySelectorAll('.modal');
// 	modal = document.querySelector('#UpdateFile');
// 	modal.style.display = "block";
// 	let str = val.filename;
// const myArr = str.split(".");
// 	document.getElementById("file_path").value = val.file_path;
// 	document.getElementById("file_id").value = val.f_id;
// 	document.getElementById("file_name").value = val.filename;
// 	document.getElementById("file_newname").value = myArr[0];

// }

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