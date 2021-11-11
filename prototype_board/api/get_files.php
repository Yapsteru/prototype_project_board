
<?php

$db = mysqli_connect('localhost', 'root', '', 'db_fms');
$sql = "SELECT * FROM files";
$q = mysqli_query($db,$sql) or die (mysqli_error($conn));

    $response_array['data'] = array();
  

    while($r = mysqli_fetch_assoc($q))
    {
        $response["filename"] =$r['filename'];;
        $response["file_path"] =$r['file_path'];;
	    array_push($response_array['data'], $response);
    }





    echo json_encode($response_array);

    
?>