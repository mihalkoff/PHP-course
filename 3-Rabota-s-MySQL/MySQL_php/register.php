<?php
$pageTitle='Register';
include('includes/header.php');

if(isset($_SESSION['isLogged'])===true){
	header('Location: messages.php');
	exit;
}else{
	if(isset($_POST['register'])){
		if(empty($_POST['username'])||empty($_POST['pass'])){
			echo 'There is no username or password!';
		}else{
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
			
			if(strlen($username)<5 || strlen($pass)<5){
				echo 'Username or password is less than 5 symbols!';
			}else{
				$sql='SELECT username FROM users WHERE username="'.$username.'"';
				$q=mysqli_query($connection,$sql);
				if(!$q){
					echo 'Error in Database!';
				}else{
					if($q->num_rows>0){
						echo 'The username is already used!';
					}else{
						$sql='INSERT INTO users (username,pass) 
							VALUES ("'.$username.'","'.$pass.'")';
						$q=mysqli_query($connection,$sql);
						if(!$q){
							echo 'Error in Database!';
						}else{
							//$SESSION['isLogged']=true;
							//$SESSION['username']=$username;
							//$SESSION['userID']=mysqli_insert_id($connection);
							header('Location: index.php');
							exit;
						}
					}
				}
			}
		}
	}
}
?>

<form method="POST">
	<div>Username: <input type="text" name="username"/></div>
	<div>Password: <input type="password" name="pass"/></div>       
	<div><input type="submit" name='register' value="Register" /></div>
</form>
<br/>
<div><a href='index.php'>Login page</a></div>

<?php
include 'includes/footer.php';
?>