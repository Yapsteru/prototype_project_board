<?php
$user_id = $_GET ['user_id'];
$name = $_GET ['name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project Board</title>
    <link rel="stylesheet" type="text/css" href="../css/create_user.css">
</head>
<body>
    <div class="header">
        <h2>Admin - Delete user</h2>
    </div>
    <div class="form-body">
        <form method="post" action="delete_confirm.php?user_id=<?php echo $user_id?>">
            <div class="delete-user">
                <h1>Are you sure to Delete <i><?php echo "$name"?>?</i></h1>
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="confrim">Yes</button>
            </div>
        </form>
    </div>
</body>
</html>