<?php

session_start();
$user_id = $_SESSION['user_id'];
$folder_id = $_REQUEST['folder_id'];
    $conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
    $db = mysqli_select_db($conn,"db_fms");
    $sql = "SELECT * FROM files where folder_id='$folder_id'";
    $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

        $response["data"] = array();
        while ($data = mysqli_fetch_array($q)) {
            $list["f_id"] = $data["f_id"];
            $list["folder_id"] = $data["folder_id"];

            $f_id =$data["folder_id"];
            $sql2 = "SELECT folder_path,folder_name FROM folder where folder_id = '$f_id'";
            $q2 = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
         
						while($r = mysqli_fetch_assoc($q2))
						{
                            $list["folder_path"] =  $r['folder_path'];
                            $list["folder_name"] =  $r['folder_name'];
                        }

            $list["user_id"] = $data["user_id"];
            $list["date_uploaded"] = $data["date_uploaded"];
            $list["filename"] = $data["filename"];
            $list["file_type"] = $data["file_type"];
            $list["remarks"] = $data["remarks"];
            $list["file_type"] = $data["file_type"];
            $list["file_path"] = $data["file_path"];
            array_push($response["data"], $list);
        }
    	echo json_encode($response);



?>