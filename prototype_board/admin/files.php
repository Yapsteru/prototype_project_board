<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel = "stylesheet" type="text/css" href="../css/upload.css" />
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<div class="button-align">

		<div class="first-modal">
			<!-- Trigger/Open The Modal -->
			<button class="modal-button" href="#myModal1"><i class='bx bx-upload'></i>Upload File</button>

				<!-- The Modal -->
				<div id="myModal1" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				  	<div class="modal-header">
				      <span class="close">×</span>
				      <h2>Select File to Upload:</h2>
			    	</div>
				    <div class="modal-body">
				     	<form action="upload_file.php" id="manage_files">
				     		<br>
				     		<input type="file" name="file" size="4" required="required" />
				     		<br>
				     		<br>
				     		<label for="" class="control-label">Feedback:</label>
				     		<br>
				     		<textarea name="feedback" id="" cols="30" rows="10"></textarea>
				     		<br>
				     		<br>
				     		<label for="is_public"><input type="checkbox" name="is_public" id="is_public"><i> Share to All Users</i></label>
				     		<br>
				     		<br>
				     		<input type="submit" name="uploadBtn" value="Upload" />
				     	</form>
					     	<br>
					     	<br>
				    </div>
				  </div>
				</div>
		</div>

		<div class="second-modal">
			<!-- Trigger/Open The Modal -->
			<button class="modal-button" href="#myModal2">Open Modal</button>

			<!-- The Modal -->
			<div id="myModal2" class="modal">

			  <!-- Modal content -->
			  <div class="modal-content">
			    <div class="modal-header">
			      <span class="close">×</span>
			      <h2>Modal Header</h2>
			    </div>
			    <div class="modal-body">
			      <p>Some text in the Modal Body</p>
			      <p>Some other text...</p>
			    </div>
			    <div class="modal-footer">
			      <h3>Modal Footer</h3>
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
				<th width="40%" class="">Filename</th>
				<th width="20%" class="">Date</th>
				<th width="40%" class="">Feedback</th>
			</tr>
		</table>
	</div>

<script>
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