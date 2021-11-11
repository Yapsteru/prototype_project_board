<?php

$folder_id=$_POST['folder_id'];
$fname=$_POST['folder_name'];

include ('../../db_connect.php');

$sql="DELETE FROM folder WHERE folder_id = $folder_id";
$q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

if($q){

my_folder_delete("../../uploads/".$fname);
echo 1;

}else{
echo 0;
}


function my_folder_delete($path) {
    if(!empty($path) && is_dir($path) ){
        $dir  = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS); //upper dirs are not included,otherwise DISASTER HAPPENS :)
        $files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $f) {if (is_file($f)) {unlink($f);} else {$empty_dirs[] = $f;} } if (!empty($empty_dirs)) {foreach ($empty_dirs as $eachDir) {rmdir($eachDir);}} rmdir($path);
    }
}


?>