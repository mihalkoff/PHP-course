<?php
$pageTitle='New message';
include('includes/header.php');

if(isset($_SESSION['isLogged'])===true){
	if(isset($_POST['submit'])){
		if(empty($_POST['title'])||empty($_POST['message'])){
			echo 'There is no title or message!';
		}else{
			$connection = mysqli_connect('localhost','root','','homework_mysql');
			if(!$connection){
				echo 'No connection to Database!';
				exit;
			}
			mysqli_set_charset($connection,'utf8');
			
			$title=stripslashes(htmlspecialchars($_POST['username']));
			$msg=stripslashes(htmlspecialchars($_POST['pass']));
			$title=mysqli_real_escape_string($connection,$title);
			$msg=mysqli_real_escape_string($connection,$msg);
			
			if(strlen($title)>50 || strlen($msg)>250){
				echo 'Title or message is too long!';
			}else{
				$username=$SESSION['username'];
				$date=('Y-m-d H:i:s');
				$sql='INSERT INTO messages (msg_date,msg_title,msg_text,username)
						VALUES ("'.$date.'","'.$title.'","'.$msg.'","'.$username.'")';
				$q=mysqli_query($connection,$sql);
				if(!$q){
					echo 'Error in Database!';
				}else{
					header('Location: messages.php');
					exit;
				}
			}
		}
	}
}
?>

	<form method="POST">
		<div>Title: <input type="text" name="title"/></div>
		<div>Message: <textarea name="message"/></textarea></div>       
		<div><input type="submit" name='submit' value="Submit" /></div>
	</form>

<?php
include 'includes/footer.php';
?>