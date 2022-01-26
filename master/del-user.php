<?php 
include "../base.php"; 

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	
    $login = $_SESSION['Login'];
	$result_lvl = mysql_query("SELECT t1.level FROM groups as t1,users as t2 WHERE t1.id = t2.group_id AND t2.login = '$login';") or die("Query failed ".mysql_error());
	$level = mysql_result($result_lvl,0,'level');

    if($level>5){

	if(isset($_POST["did"])){
		$did = $_POST["did"];
		////Удаляем пользователя
		$resdel = mysql_query("DELETE FROM users WHERE id = ".$did."") or die("Query failed ".mysql_error());
		//$s1 = "UPDATE users SET enable=2 WHERE id = '".$did."'";
	    echo $_POST["did"];
	    echo "Удаление пользователей завершено.";
	}
    }
}
?>