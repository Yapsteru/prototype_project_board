<?php $load = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';?>
<?php
include('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" type="text/css" href="css/responsive.css" />
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<title>Project Board</title>
<?php 
  if (!isset($_SESSION['user'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
?>
</head>
<body>
	<div class="header">
		<div class="navbar">
			<ul>
				<li style="font-size: 30px; font-weight: bold;">Project Board</li>
				<li style="float: right;"><small>
                  <i style="color: #888;"><?php if (isset($_SESSION['success'])) : ?>
                            <?php 
                              echo $_SESSION['success']; 
                              unset($_SESSION['success']);
                            ?>
                          <?php endif ?></i>
              </small><img src="images/user.png" >
                   <?php  if (isset($_SESSION['user'])) : ?>
                      <strong><?php echo $_SESSION['user']['name']; ?></strong>
                      <small>
                        <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                        | <a href="index.php?logout='1'" style="color: white;"> <i class='bx bx-power-off' ></i>Logout</a>
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
		    </ul>
		</div>

		<div class="col-10 col-s-9 content">
			<?php
	          switch ($load) {
	            case 'share':
	            require_once('share.php');
	            break;
	            case 'files':
	              require_once('files.php');
	              break;
	            default:
	              require_once('share.php');
	              break;  
	          	}
			?>
		</div>
	</div>

</body>
</html>