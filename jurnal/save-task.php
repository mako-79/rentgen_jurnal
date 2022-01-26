<?include ("../base.php");
//include ("../header.php");
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])){	
	$login = $_SESSION['Login'];	
	require "../sub/functions.php";
	$level = GetLvlByLogin($login);
	
if($level>3){
	$name;
	$dop;

	if (isset($_POST['regdt']) && $_POST['task_id'] > 0) {		
		$dt = $_POST['regdt'];
		$dt = DateTimeParseBackToDtTm($dt);
		$task_id = $_POST['task_id'];
		$result1 = mysql_query ("UPDATE jurnal SET regdate='$dt' WHERE id = '$task_id'") or die("Query failed ".mysql_error());
	}	
	
	if($_POST['user_id'] > 0 && $_POST['task_id'] > 0){		
			$userid = $_POST['user_id'];
			$result1 = mysql_query ("UPDATE jurnal SET PID = '$userid' WHERE id = '$task_id'") or die("Query failed ".mysql_error());
	}

	if (isset($_POST['proc']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$pr = $_POST['proc'];
		$result1 = mysql_query ("UPDATE jurnal SET spr_id=\"".$pr."\" WHERE id = '$task_id'") or die("Query failed ".mysql_error());
	}

	if (isset($_POST['doza']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$pr = $_POST['doza'];
		$result1 = mysql_query ("UPDATE jurnal SET spr_id2=\"".$pr."\" WHERE id = '$task_id'") or die("Query failed ".mysql_error());
	}

	if (isset($_POST['ph']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$ph = $_POST['ph'];
		$result1 = mysql_query ("UPDATE jurnal SET cnt_ph=\"".$ph."\" WHERE id = '$task_id'") or die("Query failed ".mysql_error());
	}

	if (isset($_POST['dop']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$dop = $_POST['dop'];
		$dop = urldecode($dop);
		$dop = htmlspecialchars($dop);
		echo $dop;
		$result1 = mysql_query ("UPDATE jurnal SET dop=\"".$dop."\" WHERE id = '$task_id'") or die("Query failed ".mysql_error());
	}
		
	
	echo "Изменения сохранены.";
  }
}
?>