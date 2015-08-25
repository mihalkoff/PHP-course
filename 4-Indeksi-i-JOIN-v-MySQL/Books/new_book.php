<?php
$pageTitle='Добави нова книга';
include './includes/header.php';
require_once './includes/dbconnection.php';
?>

<a href="index.php">Книги</a>
<br/>
<br/>

<form method='POST'>
	Име на книгата: <input type="text" name="book"/>
	<br/>
	<br/>
	<?php
		$sql='SELECT author_id,author_name
		FROM authors';
		$result = mysqli_query($connection,$sql);
		if ($result->num_rows > 0) {
			echo '<div><select name="authors[]" multiple>';
			while($row = mysqli_fetch_assoc($result)){
				echo '<option value="'.$row['author_id'].'">'
				.$row['author_name'].'</option>';
			}
			echo '</select></div>'; 
		}else{
			echo 'No authors';
		}
	?>
	<br/>
	<input type="submit" name="add_book" value="Добави"/>
</form>

<?php
if(isset($_POST['add_book'])){
	$bookName=stripslashes(htmlspecialchars($_POST['book']));
	$bookName=mysqli_real_escape_string($connection, $bookName);
	if (mb_strlen($bookName) > 3 && mb_strlen($bookName) < 250){
		$sql='SELECT book_title FROM books WHERE book_title="'.$bookName.'"';
		$result = mysqli_query($connection,$sql);
		if(!$result->num_rows){
			foreach ($_POST['authors'] as $key=>$value){        
				$authors[] = (int) $value;
			}
			$sql = 'INSERT INTO books (book_title) 
			VALUES ("'.$bookName.'")';
			mysqli_query($connection,$sql);
			
			$lastBookInsertedId = mysqli_insert_id($connection);    
			foreach ($authors as $key=>$value){        
				$values[]="($lastBookInsertedId, $value)";  
			}
			$sql='INSERT INTO books_authors (book_id,author_id)           
			VALUES '.implode(",",$values);    
			mysqli_query($connection, $sql);
		}else{
			echo'Вече има тази книга!';
		}
	}else{
		echo 'Грешни данни!';
	}
}

include 'includes/footer.php';
?>