<?php
$pageTitle='Добави нов автор';
include './includes/header.php';

isUserLogged();
?>

<a href="index.php">Книги</a>
<br/>
<br/>

<form method='POST'>
	Автор: <input type="text" name="author"/>     
	<input type="submit" name="add_author" value="Добави"/>
</form>

<?php
if(isset($_POST['add_author'])){
	$authorName=stripslashes(htmlspecialchars($_POST['author']));
	$authorName=mysqli_real_escape_string($connection, $authorName);
	if (mb_strlen($authorName) > 3 && mb_strlen($authorName) < 250){
		$sql='SELECT author_name FROM authors WHERE author_name="'.$authorName.'"';
		$result = mysqli_query($connection,$sql);
		if(!$result->num_rows){
			$sql = 'INSERT INTO authors (author_name) 
			VALUES ("'.$authorName.'")';
			mysqli_query($connection,$sql);
		}else{
			echo'Вече има този автор!';
		}
	}else{
		echo 'Грешни данни!';
	}
}

$sql='SELECT author_id,author_name
FROM authors';

$result = mysqli_query($connection,$sql);
if ($result->num_rows > 0) {			
?>
	<table border="1" cellspacing="0" cellpadding="5">
		<thead>
			<tr>
				<th>Автори</th>
			</tr>
		</thead>
		<tbody>
		<?php
			while($row = mysqli_fetch_assoc($result)){
				echo '<tr><td><a href="index.php?author_id='.$row['author_id'].'">'.$row['author_name'].'</a></td></tr>';
			}
		?>
		</tbody>
	</table>
	
<?php
}else{
	echo 'Няма резултати!';
}
include 'includes/footer.php';
?>