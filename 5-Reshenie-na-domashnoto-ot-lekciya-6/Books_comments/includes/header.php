<?php
require_once './includes/dbconnection.php';
include './includes/functions.php';
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset='utf-8'/>
		<title><?php echo $pageTitle; ?></title>
	</head>
	<body>
	<?php
	session_start();
	mb_internal_encoding('UTF-8');
	?>