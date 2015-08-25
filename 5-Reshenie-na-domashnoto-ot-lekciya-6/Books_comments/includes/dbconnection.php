<?php
$connection = mysqli_connect('localhost', 'root', '', 'books_comments') or die('Cannot init database.');
mysqli_set_charset($connection, 'utf8');