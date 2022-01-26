<?php include ("../base.php");
	if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	
	$login = $_SESSION['Login'];
	require "../sub/functions.php";
	$level = GetLvlByLogin($login);
	
  if($level>3){
    //$term = trim(strip_tags($_GET['term']));
    
    if (isset($_GET['term'])) {
	 $s_fio = trim(strip_tags($_GET['term']));
	
	$matches=array();
	
	//$query=mysql_query("SELECT id,Username FROM users WHERE CONVERT(Username USING utf8) LIKE _utf8 '".$s_fio."' COLLATE utf8_general_ci");
	$query=mysql_query("SELECT u.id,u.Username,u.birthdate FROM users u JOIN groups g ON g.id=u.group_id WHERE LOWER(u.Username) LIKE LOWER('%".$s_fio."%') AND g.level=3");

	while($users=mysql_fetch_array($query) and $i<10){
		$matches[]=
		    array('value' => $users['id'],'label' => $users['Username']." ".DateTimeParseToDt($users['birthdate']));
	}
	
	 echo json_encode($matches);
    }
   }
}
?>