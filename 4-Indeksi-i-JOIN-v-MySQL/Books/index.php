<?php
$pageTitle='Всички книги';
include './includes/header.php';
require_once './includes/dbconnection.php';

if(isset($_GET['author_id'])){
	?>
	<a href="index.php">Книги</a>
	<br/>
	<br/>
	<?php
	$authorId = (int) $_GET['author_id'];
    $authorId = mysqli_real_escape_string($connection, $authorId);
	
	/*$sql='SELECT * FROM books_authors as ba 
	INNER JOIN books as b 
	ON ba.book_id=b.book_id
	INNER JOIN books_authors as bba
	ON bba.book_id=ba.book_id
	INNER JOIN authors as a
	ON bba.author_id=a.author_id
	WHERE ba.author_id='.$authorId;*/
	$sql='SELECT * FROM books_authors AS b1, books_authors AS b2
	LEFT JOIN authors ON authors.author_id = b2.author_id
	LEFT JOIN books ON b2.book_id = books.book_id
	WHERE b1.author_id ='.$authorId.' 
	AND b2.book_id = b1.book_id';
}else{
	?>
	<a href="new_book.php">Нова книга</a>&nbsp;
	<a href="new_author.php">Нов автор</a>
	<br/>
	<br/>
	<?php
	$sql='SELECT books.book_id, books.book_title, authors.author_id, authors.author_name
	FROM books 
	LEFT JOIN books_authors 
	ON books.book_id=books_authors.book_id
	LEFT JOIN authors
	ON authors.author_id=books_authors.author_id';
}

$result = mysqli_query($connection,$sql);
if ($result->num_rows > 0) {			
?>
	<table border="1" cellspacing="0" cellpadding="5">
		<thead>
			<tr>
				<th>Книга</th>
				<th>Автори</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$arr=array();
			while($row = mysqli_fetch_assoc($result)){
				$arr[$row['book_id']]['book_title']=$row['book_title'];
				$arr[$row['book_id']]['authors'][$row['author_id']]=$row['author_name'];
			}
			
			foreach($arr as $key=>$value){
				echo '<tr><td>'.$value['book_title'].'</td><td>';
				foreach($value['authors'] as $key2=>$value2){
					echo '<a href="index.php?author_id='.$key2.'">'.$value2.'</a> ';
				}
				echo '</td></tr>';
			}
		?>
		</tbody>
	</table>
	
<?php
}else{
	echo 'No results!';
}
include 'includes/footer.php';
?>