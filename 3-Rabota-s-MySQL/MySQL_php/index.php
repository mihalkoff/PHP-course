<?php
$pageTitle='Login';
include 'includes/header.php';

if(isset($_SESSION['isLogged'])===true){
	header('Location: messages.php');
	exit;
}else{
	if(isset($_POST['login'])){
		$connection = mysqli_connect('localhost','root','','homework_mysql');
		if(!$connection){
			echo 'No connection to Database!';
			exit;
		}
		mysqli_set_charset($connection,'utf8');
		
		$username=trim(stripslashes(htmlspecialchars($_POST['username'])));
		$pass=trim(stripslashes(htmlspecialchars($_POST['pass'])));
		$username=mysqli_real_escape_string($connection,$username);
		$pass=mysqli_real_escape_string($connection,$pass);
		
		$sql='SELECT username,pass FROM users
				WHERE username="'.$username.'" AND pass="'.$pass.'"';
		$q=mysqli_query($connection,$sql);
		
		if($q->num_rows>0){
			$row=$q->fetch_assoc();
			$_SESSION['isLogged']=true;
			//$_SESSION['userID']=$row['user_id'];
			$_SESSION['username']=$username;
			header('Location: messages.php');
			exit;
		}else{
			echo 'Wrong username or password!';
		}
	}
	?>
	<form method="POST">
		<div>Username: <input type="text" name="username"/></div>
		<div>Password: <input type="password" name="pass"/></div>       
		<div><input type="submit" name='login' value="Log in" /></div>
	</form>
	<br/>
	<div><a href='register.php'>Registration page</a></div>
<?php
}
include 'includes/footer.php';
?>