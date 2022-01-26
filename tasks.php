<?php

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])){

	$login = $_SESSION['Login'];
	$level = GetLvlByLogin($login);//mysql_result($result_lvl,0,'level');
	$limit;
	if($level>3){
		$_SESSION['sdate']=date("d.m.Y 00:00");
		$_SESSION['edate']=date("d.m.Y 23:59");
?>
    <div class="main_inner">
	<?// даём доступ пользователю к главной странице
        include "task_menu.php";?>
	<br>
	    <div class="button">
                <a href='/jurnal/jurnal.php'>ЖУРНАЛ РЕНТГЕН</a>
	    </div>
<?if($level>5){?>
	    <div class="button">
                <a href='/jurnal_fizio/jurnal.php'>ЖУРНАЛ ФИЗИОТЕРАПИЯ</a>
	    </div>
	    <div style="clear:both;"></div>
<?}?>
    </div>
    <?
    }
}
?>