<?php
$pageTitle='Вход';
include './includes/header.php';

if(isset($_SESSION['isLogged'])){
	header('Location: index.php');
	exit;
}else{
	if(isset($_POST['login'])){
		$username=trim(stripslashes(htmlspecialchars($_POST['username'])));
		$pass=trim(stripslashes(htmlspecialchars($_POST['pass'])));
		$username=mysqli_real_escape_string($connection,$username);
		$pass=mysqli_real_escape_string($connection,$pass);
		$sql='SELECT * FROM users
				WHERE user_name="'.$username.'" AND user_pass="'.$pass.'"';
		$result = mysqli_query($connection,$sql);
		
		if($result->num_rows>0){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['isLogged']=true;
			$_SESSION['userID']=$row['user_id'];
			$_SESSION['username']=$username;
			header('Location: index.php');
			exit;
		}else{
			echo 'Грешно име или парола!<br/><br/>';
		}
	}
	?>
	<a href="index.php">Книги</a>
	<br/>
	<br/>
	<form method="POST">
		<div>Име: <input type="text" name="username"/></div>
		<div>Парола: <input type="password" name="pass"/></div>   
		<br/>
		<div><input type="submit" name='login' value="Вход" /></div>
	</form>
	<br/>
<?php
}
include './includes/footer.php';
?>