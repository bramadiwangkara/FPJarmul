<?php
$dir = getcwd().DIRECTORY_SEPARATOR . "/upload/";
$files = glob($dir . '/*');
foreach($files as $file){
    unlink($file);
}
echo "<script>alert('List file telah di reset!')</script>";
?>