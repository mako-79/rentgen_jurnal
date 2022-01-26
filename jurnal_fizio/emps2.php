<?php include ("../base.php");
	if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	
	$login = $_SESSION['Login'];
	$sql_select_level = "SELECT t1.level,t2.id FROM groups as t1,users as t2 WHERE t1.id = t2.group_id AND t2.login = '$login';";
	$result_lvl = mysql_query($sql_select_level);
	$level = mysql_result($result_lvl,0,'level');
	
  if($level>3){
    if (isset($_GET['term'])) {
	 $s_fio = trim(strip_tags($_GET['term']));
	
	$matches=array();
	$query=mysql_query("SELECT u.id,u.Username FROM users u JOIN groups g ON g.id=u.group_id WHERE LOWER(u.Username) LIKE LOWER('%".$s_fio."%') AND g.level=7");

	while($users=mysql_fetch_array($query) and $i<10){
		$matches[]=
		    array('value' => $users['id'],'label' => $users['Username']);
	}
	
	 echo json_encode($matches);
    }
   }
}
?>