<?php
$connection = mysqli_connect('localhost', 'root', '', 'books') or die('Cannot init database.');
mysqli_set_charset($connection, 'utf8');