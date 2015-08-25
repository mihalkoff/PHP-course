<?php
$pageTitle='Upload';
include 'includes/header.php';
echo " <a href='files.php'>Files</a> ";
echo " <a href='destroy.php'>Logout</a> ";

if(isset($_POST['upload'])){
	if(count($_FILES)>0){
		if(move_uploaded_file($_FILES['uploadedFile']['tmp_name'], 'data'.DIRECTORY_SEPARATOR.$_FILES['uploadedFile']['name'])){
			echo "File is uploaded";
		}else{
			echo "Error";
		}
	}
}
?>
<form method="POST" enctype="multipart/form-data">
	<div>File: <input type="file" name="uploadedFile"/></div>
	<div><input type="submit" name="upload" value="Upload"/></div>
</form>
<?php
include 'includes/footer.php';
?>