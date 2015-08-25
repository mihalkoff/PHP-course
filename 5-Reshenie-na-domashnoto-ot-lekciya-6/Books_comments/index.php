<?php
$pageTitle='Всички книги';
include './includes/header.php';

isUserLogged();
if(isset($_GET['author_id'])){
	?>
	<a href="index.php">Книги</a>
	<br/>
	<br/>
	<?php
	$authorId = (int) $_GET['author_id'];
    $authorId = mysqli_real_escape_string($connection, $authorId);
	
	$sql='SELECT * FROM books_authors AS b1, books_authors AS b2
	INNER JOIN authors ON authors.author_id = b2.author_id
	INNER JOIN books ON b2.book_id = books.book_id
	WHERE b1.author_id ='.$authorId.' 
	AND b2.book_id = b1.book_id';
}else{
	?>
	<a href="new_book.php">Нова книга</a>&nbsp;
	<a href="new_author.php">Нов автор</a>&nbsp;
	<a href="login.php">Вход</a>&nbsp;
	<a href="register.php">Регистрация</a>
	<br/>
	<br/>
	<?php
	$sql='SELECT books.book_id, books.book_title, authors.author_id, authors.author_name
	FROM books
	INNER JOIN books_authors 
	ON books.book_id=books_authors.book_id
	INNER JOIN authors
	ON authors.author_id=books_authors.author_id
	ORDER BY books.book_title ASC';
}

$result = mysqli_query($connection,$sql);
if ($result->num_rows > 0) {			
	showTable($result);
}else{
	echo 'Няма резултати!';
}
include './includes/footer.php';
?>