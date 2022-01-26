<?php include "../base.php";
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	$login = $_SESSION['Login'];
	$sql_select_level = "SELECT t1.level FROM groups as t1,users as t2 WHERE t1.id = t2.group_id AND t2.login = '$login';";	
	$result_lvl = mysql_query($sql_select_level);
	$level = mysql_result($result_lvl,0,'level');
    if($level>3){
	if(isset($_POST["did"])){
		$did = $_POST["did"];
		$dsql_select = "SELECT j.regdate,ph.path FROM jurnal j LEFT JOIN ph_files ph on ph.mid=j.id WHERE j.id = ".$did."";
		$dresult = mysql_query($dsql_select) or die("Query failed ".mysql_error());
                $drow = mysql_fetch_array($dresult);
		do{
			$dpath = $drow['path'];	
			$regdate = $drow['regdate'];
			$lgdt = date_parse_from_format("Y-m-d h:i:s", $regdate);
			$lday = $lgdt['day'];
			$lmon = $lgdt['month'];
			$lyear = $lgdt['year'];	
			unlink('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/sm/'.$dpath);
			unlink('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/'.$dpath);
		}
		while($drow = mysql_fetch_array($dresult));

		$s1 = "DELETE FROM ph_files WHERE mid = '".$did."'";
		mysql_query($s1) or die("Query failed");

		$s1 = "DELETE FROM jurnal WHERE id = '".$did."'";
		mysql_query($s1) or die("Query failed");
		
		echo "Удаление выполнено!";
	}
    }
}
?>