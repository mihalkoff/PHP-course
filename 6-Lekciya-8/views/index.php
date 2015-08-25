<?php
include './inc/functions.php';

if (isset($_GET['author_id'])) {
    $author_id = (int) $_GET['author_id'];
    $q = mysqli_query($db, 'SELECT * FROM books_authors AS b1, books_authors AS b2
	INNER JOIN authors ON authors.author_id = b2.author_id
	INNER JOIN books ON b2.book_id = books.book_id
	WHERE b1.author_id ='.$author_id.' 
	AND b2.book_id = b1.book_id');
} else {
    $q = mysqli_query($db, 'SELECT * FROM books as b INNER JOIN 
    books_authors as ba ON b.book_id=ba.book_id INNER JOIN authors as a
    ON a.author_id=ba.author_id');
}

$result = array();
while ($row = mysqli_fetch_assoc($q)) {
    $result[$row['book_id']]['book_title'] = $row['book_title'];
    $result[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
}

//Data
$data=array();
$data['title']='Списък';
$data['result']=$result;
$data['content']='./templates/index_public.php';
render($data,'./templates/layouts/normal_layout.php');