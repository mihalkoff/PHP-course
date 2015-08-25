<?php
$pageTitle='Регистрация';
include('./includes/header.php');

if(isset($_SESSION['isLogged'])){
	header('Location: index.php');
	exit;
}else{
	if(isset($_POST['register'])){
		$username=trim(stripslashes(htmlspecialchars($_POST['username'])));
		$pass=trim(stripslashes(htmlspecialchars($_POST['pass'])));
		$username=mysqli_real_escape_string($connection,$username);
		$pass=mysqli_real_escape_string($connection,$pass);
		
		if (mb_strlen($username) >=3 && mb_strlen($username) < 50 && mb_strlen($pass) >=3 && mb_strlen($pass) < 50){
			$sql='SELECT * FROM users WHERE user_name="'.$username.'"';
			$result=mysqli_query($connection,$sql);
			if($result->num_rows){
				echo 'Името вече е заето!<br/><br/>';
			}else{
				$sql='INSERT INTO users (user_name,user_pass) 
					VALUES ("'.$username.'","'.$pass.'")';
				$result=mysqli_query($connection,$sql);
				if($result){
					$_SESSION['isLogged']=true;
					$_SESSION['username']=$username;
					$_SESSION['userID']=mysqli_insert_id($connection);
					header('Location: index.php');
					exit;
				}
			}
		}else{
			echo 'Твърде късо/дълго име или парола!<br/><br/>';
		}
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
	<div><input type="submit" name='register' value="Регистрирай" /></div>
</form>

<?php
include './includes/footer.php';
?>