<?php
ob_start();
session_start();
$file = basename($_GET['file']);
$folderName = 'data';
$filePath = realpath("data".DIRECTORY_SEPARATOR.$file);
if(!$filePath){  
	die('No such file!');
}else{
	$mm_type = "application/octet-stream";
	header("Cache-Control: public, must-revalidate");
	header("Pragma: hack");
	header("Content-Type: $mm_type");
	header("Content-Length: " .(string)(filesize($filePath)));
	header("Content-Disposition: attachment; filename = $file");
	header("Content-Transfer-Encoding: binary\n");
	ob_end_clean();                
	readfile($filePath);
	exit;
}
?>