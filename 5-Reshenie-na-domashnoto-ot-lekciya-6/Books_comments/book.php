<?php
$pageTitle='Книга';
include './includes/header.php';

if(isset($_GET['book_id'])){
	isUserLogged();
	?>
	<a href="index.php">Книги</a>
	<br/>
	<br/>
	<?php
	$bookId = (int) $_GET['book_id'];
    $bookId = mysqli_real_escape_string($connection, $bookId);
	
	$sql='SELECT books.book_id, books.book_title, authors.author_id, authors.author_name
	FROM books
	INNER JOIN books_authors 
	ON books.book_id=books_authors.book_id
	INNER JOIN authors
	ON authors.author_id=books_authors.author_id
	WHERE books.book_id ='.$bookId.' 
	ORDER BY books.book_title ASC';
	
	$result = mysqli_query($connection,$sql);
	if ($result->num_rows > 0) {			
		showTable($result);
	}else{
		echo 'Няма резултати!';
	}
	
	$sql='SELECT *
	FROM books AS b
	INNER JOIN books_comments AS bc
	ON b.book_id=bc.book_id
	INNER JOIN comments AS c
	ON bc.comment_id=c.comment_id
	INNER JOIN comments_users AS cu
	ON c.comment_id=cu.comment_id
	INNER JOIN users AS u
	ON cu.user_id=u.user_id
	WHERE b.book_id ='.$bookId.'
	ORDER BY c.comment_date ASC';
	
	$result = mysqli_query($connection,$sql);
	if ($result->num_rows > 0) {			
		showComments($result);
	}else{
		echo 'Няма коментари!';
	}
	
	if(isset($_SESSION['isLogged'])){
		?>
		<br/>
		<br/>
		<form method="POST">
			Напиши коментар:<br/>
			<textarea name="comment"></textarea><br/><br/>
			<input type="submit" name="submitComment" value="Изпрати"/>
		</form>
		<?php
		if(isset($_POST['submitComment'])){
			$comment=stripslashes(htmlspecialchars($_POST['comment']));
			$comment=mysqli_real_escape_string($connection, $comment);
			if(mb_strlen($comment) > 0 && mb_strlen($comment) < 250){
				$date=date('Y-m-d H:i:s');
				$sql='INSERT INTO comments (comment_date, comment_txt)
				VALUES ("'.$date.'","'.$comment.'")';
				mysqli_query($connection,$sql);
				
				$lastCommentInsertedId = mysqli_insert_id($connection);
				$sql='INSERT INTO books_comments (book_id, comment_id)
				VALUES ("'.$bookId.'","'.$lastCommentInsertedId.'")';
				mysqli_query($connection,$sql);
				
				$userID=(int)$_SESSION['userID'];
				$sql='INSERT INTO comments_users (comment_id, user_id)
				VALUES ("'.$lastCommentInsertedId.'","'.$userID.'")';
				mysqli_query($connection,$sql);
				header('Location: book.php?book_id='.$bookId);
				exit;
			}else{
				echo 'Не сте написали коментар или е прекалено дълъг!';
			}
		}
	}
}

include './includes/footer.php';
?>