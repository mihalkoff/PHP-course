<?php
$pageTitle='Списък с разходи';
include 'includes/header.php';
?>

<a href="expense.php">Добави нов разход</a>
<form method="GET">
	<select name="filter">
		<?php
		foreach ($filters as $key=>$value) {
			if($_GET){
				if($key==(int)$_GET['filter']){
					echo '<option value="'.$key.'" selected>'.$value.'</option>';
				}else{
					echo '<option value="'.$key.'">'.$value.'</option>';
				}
			}else{
				if($key==6){
					echo '<option value="'.$key.'" selected>'.$value.'</option>';
				}else{
					echo '<option value="'.$key.'">'.$value.'</option>';
				}
			}
		}
		?>
	</select>     
    <input type="submit" value="Филтрирай"/>
</form>
<table border="1">
    <tr>
        <th>Дата</th>
        <th>Име</th>
        <th>Сума</th>
        <th>Вид</th>
    </tr>
    <?php
	$totalSum=0;
    if(file_exists('data.txt')){
        $result = file('data.txt');
        foreach ($result as $value) {
            $columns = explode('!', $value);
			$trimmedColumns=trim($columns[3]);
			if($_GET){
				if((int)$_GET['filter']==$trimmedColumns || (int)$_GET['filter']==6){
					$totalSum+=$columns[2];
					echo '<tr>
						<td>'.$columns[0].'</td>
						<td>'.$columns[1].'</td>
						<td>'.$columns[2].'</td>
						<td>'.$groups[trim($columns[3])].'</td>
						</tr>';
				}
			}else{
				$totalSum+=$columns[2];
				echo '<tr>
					<td>'.$columns[0].'</td>
					<td>'.$columns[1].'</td>
					<td>'.$columns[2].'</td>
					<td>'.$groups[trim($columns[3])].'</td>
					</tr>';
			}
        }
		echo '<tr>
			<td>------</td>
			<td>------</td>
			<td>'.$totalSum.'</td>
			<td>------</td>
			</tr>';
    }
    ?>
</table>

<?php
include 'includes/footer.php';
?>
