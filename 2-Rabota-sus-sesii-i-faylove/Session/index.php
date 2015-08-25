<?php
$pageTitle='Login';
include 'includes/header.php';

$loginData = array('username'=>'user', 'pass'=>'qwerty');
if($_SESSION['isLogged']==1){
	header('Location: files.php');
}else{
	if(isset($_POST['login'])){
		$username=trim(stripslashes(htmlspecialchars($_POST['username'])));
		$pass=trim(stripslashes(htmlspecialchars($_POST['pass'])));
		if($username==$loginData['username'] && $pass==$loginData['pass']){
			$_SESSION['isLogged']=true;
			header('Location: files.php');
			exit;
		}else{
			echo "Грешни данни!";
		}
	}
	?>
	<form method="POST">
		<div>Име: <input type="text" name="username"/></div>
		<div>Парола: <input type="password" name="pass"/></div>       
		<div><input type="submit" name='login' value="Влез" /></div>
	</form>
<?php
}
include 'includes/footer.php';
?>