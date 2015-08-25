<?php
$pageTitle='Messages';
include('includes/header.php');
?>
<div><a href='new_message.php'>Add new message</a></div>
<br/>

<?php
if(isset($_SESSION['isLogged'])===true){
	$connection = mysqli_connect('localhost','root','','homework_mysql');
	if(!$connection){
		echo 'No connection to Database!';
		exit;
	}
	mysqli_set_charset($connection,'utf8');
	
	$username=mysqli_real_escape_string($connection,$SESSION['username']);
	$sql='SELECT msg_date,username,msg_title,msg_text 
			FROM messages 
			WHERE username="'.$username.'"
			ORDER by msg_date ASC';
	$q=mysqli_query($connection,$sql);
	if(!$q){
		echo 'Error in Database!';
	}else{
		if($q->num_rows>0){
			echo '<table><tr><th>Date</th><th>User</th><th>Title</th><th>Text</th></tr>';
			while($row=$q->fetch_assoc()){
				echo '<tr><td>'.$row['msg_date'].'</td>
					<td>'.$row['username'].'</td>
					<td>'.$row['msg_title'].'</td>
					<td>'.$row['msg_text'].'</td></tr>';
			}
			echo '</table>';
		}else{
			echo 'No results';
		}
	}
}

include('includes/footer.php');
?>