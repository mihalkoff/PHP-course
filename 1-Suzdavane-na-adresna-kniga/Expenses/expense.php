<?php
mb_internal_encoding('UTF-8');
$pageTitle = 'Въвеждане на разход';
include 'includes/header.php';

if($_POST){
    $expenseName=trim($_POST['expenseName']);
    $expenseName=str_replace('!', '', $expenseName);
    $sum=trim($_POST['sum']);
    $sum=str_replace('!', '', $sum);
    $selectedGroup=(int)$_POST['group'];
    $error=false;
    if(mb_strlen($expenseName)<=3 || preg_match('~[0-9]~', $expenseName)){
        echo '<p>Невалидно име</p>';
        $error=true;
    }
    if($sum<=0 || !is_numeric($sum)){
        echo '<p>Невалидна сума</p>';
        $error=true;
    }    
    if(!array_key_exists($selectedGroup, $groups)){
        echo '<p>Невалидна група</p>';
        $error=true;
    }
    if(!$error){
        $result=date("d.m.Y").'!'.$expenseName.'!'.$sum.'!'.$selectedGroup."\n";
        if(file_put_contents('data.txt',$result,FILE_APPEND))
        {
            echo '<p>Записът е успешен</p>';
        }
    }
}
?>

<a href="index.php">Списък</a>
<form method="POST">
    <div>Име: <input type="text" name="expenseName"/></div>
    <div>Сума: <input type="text" name="sum"/></div>
    <div>Вид: 
        <select name="group">
            <?php
            foreach ($groups as $key=>$value){
				echo '<option value="'.$key.'">'.$value.'</option>';
            }
            ?>
        </select>           
    </div>        
    <div><input type="submit" value="Добави" /></div>
</form>

<?php
include 'includes/footer.php';
?>