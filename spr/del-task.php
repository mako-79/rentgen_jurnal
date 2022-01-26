<?php include "../base.php";
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	$login = $_SESSION['Login'];
	$sql_select_level = "SELECT t1.level FROM groups as t1,users as t2 WHERE t1.id = t2.group_id AND t2.login = '$login';";	
	$result_lvl = mysql_query($sql_select_level);
	$level = mysql_result($result_lvl,0,'level');
    if($level>3){
	if(isset($_POST["did"])){
		$did = $_POST["did"];
		$s1 = "DELETE FROM spr WHERE id = '".$did."'";
		mysql_query($s1) or die("Query failed");
		echo "Удаление выполнено!";
	}
    }
}
?>