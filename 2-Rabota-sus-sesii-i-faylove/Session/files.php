<?php
$pageTitle='Files';
include 'includes/header.php';

echo " <a href='upload.php'>Upload</a> ";
echo " <a href='destroy.php'>Logout</a> ";
$files = scandir('data');
if(count($files)>2){
?>
	<table border="1">
		<tr><th>Filename</th></tr>
		<?php
		foreach($files as $key=>$value){
			if($value!='.' && $value!='..'){
				echo '<tr><td><a href="download.php?file='.$value.'">'.$value.'</a></td></tr>';
			}
		}
		?>
	</table>
	
<?php
}else{
	echo "<p>No uploaded files!</p>";
}
include 'includes/footer.php';
?>