<?
include "../base.php";
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	
	$login = $_SESSION['Login'];
	
	$sql_select_level = "SELECT t1.level FROM groups as t1,users as t2 WHERE t1.id = t2.group_id AND t2.login = '$login';";
	
	$result_lvl = mysql_query($sql_select_level);
	$level = mysql_result($result_lvl,0,'level');
   if($level>5){
        if (isset($_POST['name'])) {
		$nname = $_POST['name'];
		
		if($_POST['group_id'] > 0 && $nname != ''){
		    $group_id = $_POST['group_id'];
		    $result = mysql_query("SELECT id FROM groups WHERE gname = '$nname'");
		    $myrow = mysql_fetch_array($result);
		    if (empty($myrow['id'])) {
			$result1 = mysql_query ("UPDATE groups SET gname='$nname' WHERE id = '$group_id'");
		    }
		}
	} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
	if (isset($_POST['level'])) {
		$lvl = $_POST['level'];
		
		if($_POST['group_id'] > 0 && $lvl > 0){
		    $group_id = $_POST['group_id'];
		    	$result1 = mysql_query ("UPDATE groups SET level='$lvl' WHERE id = '$group_id'");
		}
	} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
   }
}	
    ?>
