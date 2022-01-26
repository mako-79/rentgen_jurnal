<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])){
	$login = $_SESSION['Login'];
?>
<div id=menublock>
<div class=menu>

    <div class=<?=$_SERVER['REQUEST_URI'] == "/"?'link':''?>><a href="<? echo $path?>/">На главную</a></div>
    <div class=<?=$_SERVER['REQUEST_URI'] == "/jurnal/jurnal.php"?'link':''?>><a href="<? echo $path?>/jurnal/jurnal.php">Рентген</a></div>
	<?if($level>5){?>
    <div class=<?=$_SERVER['REQUEST_URI'] == "/jurnal_fizio/jurnal.php"?'link':''?>><a href="<? echo $path?>/jurnal_fizio/jurnal.php">Физиотерапия</a></div>
	 <?}?>
	 <div class=<?=$_SERVER['REQUEST_URI'] == "/spr/jurnal.php"?'link':''?>><a href="<? echo $path?>/spr/jurnal.php">Справочники</a></div>
	<?if($level>7){?>
		<div class="<?=$_SERVER['REQUEST_URI'] == "/master/list_groups.php"?'link':''?>"><a href='<? echo $path?>/master/list_groups.php'>Группы</a></div>
  		<div class="<?=$_SERVER['REQUEST_URI'] == "/master/list_users.php"?'link':''?>"><a href='<? echo $path?>/master/list_users.php'>Пользователи</a></div>
  	<?}?>
</div>
<div style="clear:both"></div>
</div>
<?php
    }else{
        echo "<h1>Ошибка</h1>";
        echo "<p>Нет доступа. Можете <a href=\"index.php\">попробовать ещё раз</a>.</p>";
    }?>