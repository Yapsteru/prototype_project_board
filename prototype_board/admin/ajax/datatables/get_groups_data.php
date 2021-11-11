<?php

session_start();
    $conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
    $db = mysqli_select_db($conn,"db_fms");
    $sql = "SELECT * FROM groups";
    $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

        $response["data"] = array();
        while ($data = mysqli_fetch_array($q)) {
            $list["group_id"] = $data["group_id"];
            $list["group_name"] = $data["group_name"];
            array_push($response["data"], $list);
        }
    	echo json_encode($response);
?>