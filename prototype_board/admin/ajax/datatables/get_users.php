<?php

session_start();
$user_id = $_SESSION['user_id'];
    $conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
    $db = mysqli_select_db($conn,"db_fms");
    $sql = "SELECT * FROM users order by user_id DESC";
    $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

        $response["data"] = array();
        while ($data = mysqli_fetch_array($q)) {
            $list["user_id"] = $data["user_id"];
            $list["group_id"] = $data["group_id"];
            
            $group_id =$data["group_id"];
            if($group_id==0){
                $list["group_name"] =  "admin";
            }else{
                $sql2 = "SELECT group_name FROM groups where group_id = '$group_id'";
                $q2 = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
             
                            while($r = mysqli_fetch_assoc($q2))
                            {
                        
                                $list["group_name"] =  $r['group_name'];
                            }
            }
         

            $list["username"] = $data["username"];
            $list["name"] = $data["name"];
            $list["email"] = $data["email"];
            $list["user_type"] = $data["user_type"];
            $list["password"] = $data["password"];
        
            array_push($response["data"], $list);
        }
    	echo json_encode($response);



?>