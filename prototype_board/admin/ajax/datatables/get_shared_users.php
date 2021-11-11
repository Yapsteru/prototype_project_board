<?php
    $file_id = $_POST['file_id'];
    $conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
    $db = mysqli_select_db($conn,"db_fms");
    $sql = "SELECT a.share_id as share_id,b.name as name,b.user_id as user_id,c.filename as filename,c.f_id as f_id FROM `share` a INNER join users b on a.user_id=b.user_id INNER JOIN files c on a.file_id=c.f_id where c.f_id = '$file_id'";

    $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

        $response["data"] = array();
        while ($data = mysqli_fetch_array($q)) {
            $list["share_id"] = $data["share_id"];
            $list["name"] = $data["name"];
            $list["user_id"] = $data["user_id"];
            $list["filename"] = $data["filename"];
            $list["f_id"] = $data["f_id"];
            array_push($response["data"], $list);
        }
    	echo json_encode($response);



?>