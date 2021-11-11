<?php $load = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';?>
<?php
include('../functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
	<link rel = "stylesheet" type="text/css" href="../css/responsive.css" />
	<link rel = "stylesheet" type="text/css" href="../css/select2.min.css" />
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<title>Project Board</title>
<?php 

	if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  header("location: ../login.php");
}
?>
</head>
<body>
	<div class="header">
		<div class="navbar">
			<ul>
				<li style="font-size: 30px; font-weight: bold;">Project Board</li>
				<li style="float: right;"><small>
                  <i style="color: red;"><?php if (isset($_SESSION['success'])) : ?>
                            <?php 
                              echo $_SESSION['success']; 
                              unset($_SESSION['success']);
                            ?>
                          <?php endif ?></i>
              </small><img src="../images/user.png" >
                   <?php  if (isset($_SESSION['user'])) : ?>
                      <strong><?php echo $_SESSION['user']['name']; ?></strong>
                      <small>
                        <i  style="color: red;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                        | <a href="../index.php?logout='1'" style="color: #102E37;"> <i class='bx bx-power-off' ></i>Logout</a>
                      </small>
                    <?php endif ?></li>
			</ul>
		</div>
	</div>

	<div class="row">
		<div class="col-2 col-s-2 sidebar">
			<ul>
		      <li <?php if($load == 'share') {echo 'class="active"';} ?>><a href="index.php?page=share"><i class='bx bx-share-alt'></i>Shared Files</a></li>
		      <li <?php if($load == 'files') {echo 'class="active"';} ?>><a href="index.php?page=files"><i class='bx bx-file-blank'></i>Files</a></li>
			  <li <?php if($load == 'documentprofile') {echo 'class="active"';} ?>><a href="index.php?page=documentprofile"><i class='bx bx-folder'></i>Document Profiles</a></li>
			 <?php if($_SESSION['user_type']=="admin"){
?><li <?php if($load == 'users') {echo 'class="active"';} ?>><a href="index.php?page=users"><i class='bx bx-user'></i>Users</a></li><?php
			  }?>
	 <?php if($_SESSION['user_type']=="admin"){
?><li <?php if($load == 'groups') {echo 'class="active"';} ?>><a href="index.php?page=groups"><i class='bx bx-group'></i>Groups</a></li><?php
			  }?>
		    </ul>
		</div>

		<div class="col-10 col-s-9 content">
			<?php
			if($_SESSION['user_type']=="admin"){
	          switch ($load) {
	            case 'share':
	            require_once('share.php');
	            break;
				case 'sharefiles':
					require_once('sharefiles.php');
					break;
	            case 'files':
	              require_once('files.php');
	              break;
	            case 'users':
	              require_once('users.php');
	              break;
	             case 'update':
	              require_once('update_user.php');
	              break;
	            case 'delete':
	              require_once('delete_user.php');
	              break;     
				case 'documentprofile':
				  require_once('documentprofile.php');
				  break;  
				case 'documentprofile_details':
				  require_once('documentprofile_detail.php');
				  break;
				  case 'groups':
					require_once('groups.php');
					break;       
	            default:
	              require_once('share.php');
	              break;  
	          	}
			}else{
				switch ($load) {
					case 'share':
					require_once('share.php');
					break;
					case 'sharefiles':
						require_once('sharefiles.php');
						break;
					case 'files':
					  require_once('files.php');
					  break;
					case 'users':
					  require_once('users.php');
					  break;
					 case 'update':
					  require_once('update_user.php');
					  break;
					case 'delete':
					  require_once('delete_user.php');
					  break;     
					case 'documentprofile':
					  require_once('documentprofile_user.php');
					  break;  
					case 'documentprofile_details':
					  require_once('documentprofile_detail.php');
					  break;
					  case 'groups':
						require_once('groups.php');
						break;       
					default:
					  require_once('share.php');
					  break;  
					  }
			}
			?>
		</div>
	</div>

</body>
</html>