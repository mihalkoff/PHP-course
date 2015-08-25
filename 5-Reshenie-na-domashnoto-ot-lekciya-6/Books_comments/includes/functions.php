<?php

function isUserLogged(){
	if(isset($_SESSION['isLogged'])){
		echo 'Здравей, '.$_SESSION['username'].'&nbsp;<a href="logout.php">Излез</a><br/><br/>';
	}
}

function showTable($result){
	echo '<table border="1" cellspacing="0" cellpadding="5">
		<thead>
			<tr>
				<th>Книга</th>
				<th>Автори</th>
			</tr>
		</thead>
		<tbody>';
			$arr=array();
			while($row = mysqli_fetch_assoc($result)){
				$arr[$row['book_id']]['book_title']=$row['book_title'];
				$arr[$row['book_id']]['authors'][$row['author_id']]=$row['author_name'];
			}
			
			foreach($arr as $key=>$value){
				echo '<tr><td><a href="book.php?book_id='.$key.'">'.$value['book_title'].'</td><td>';
				foreach($value['authors'] as $key2=>$value2){
					echo '<a href="index.php?author_id='.$key2.'">'.$value2.'</a> ';
				}
				echo '</td></tr>';
			}
		echo '</tbody>
	</table><br/><br/>';
}

function showComments($result){		
	echo '<table border="1" cellspacing="0" cellpadding="5">
		<thead>
			<tr>
				<th colspan="3">Коментари за книгата</th>
			</tr>
			<tr>
				<th>Дата</th>
				<th>Потребител</th>
				<th>Коментар</th>
			</tr>
		</thead>
		<tbody>';
			while($row = mysqli_fetch_assoc($result)){
				echo '<tr><td>'.$row['comment_date'].'</td><td>'.$row['user_name'].'</td><td>'.$row['comment_txt'].'</td></tr>';
			}
		echo '</tbody>
	</table><br/><br/>';
}