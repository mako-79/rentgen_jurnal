<?include ("../base.php");
//include ("../header.php");
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])){	
	$login = $_SESSION['Login'];	
	require "../sub/functions.php";
	$level = GetLvlByLogin($login);
	$luid = GetUserIdByLogin($login);	
if($level>3){
	$name;
	$dop;


	if (isset($_POST['dop']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$dop = $_POST['dop'];
		$dop = urldecode($dop);
		$dop = htmlspecialchars($dop);
		$result1 = mysql_query ("UPDATE jurnal_fizio SET dop=\"".$dop."\",EMP_ID =".$luid." WHERE id = '$task_id'");
	}
	
	$dt = "";
	if ($_POST['task_id'] > 0){ 
	    $task_id = $_POST['task_id'];
	    if ($_POST['dt'] > 0 && isset($_POST['dt'])) {		
		$dt = $_POST['dt'];
		$dt = DateTimeParseBackToDtTm($dt);
		$result1 = mysql_query ("UPDATE jurnal_fizio SET regdate='$dt',EMP_ID =".$luid." WHERE id = '$task_id'");
	    }	
	
    	    if($_POST['user_id'] > 0){		
			$userid = $_POST['user_id'];
			$result1 = mysql_query ("UPDATE jurnal_fizio SET PID = '$userid',EMP_ID =".$luid." WHERE id = '$task_id'");
	    }

	    if($_POST['emp_id'] > 0){		
			$empid = $_POST['emp_id'];
			$result1 = mysql_query ("UPDATE jurnal_fizio SET EMP = '$empid',EMP_ID =".$luid." WHERE id = '$task_id'");
	    }	
	}
	
	if (isset($_POST['procedura']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$pr = $_POST['procedura'];
		$result1 = mysql_query ("UPDATE jurnal_fizio SET spr_id=\"".$pr."\",EMP_ID =".$luid."  WHERE id = '$task_id'");
	}

	if (isset($_POST['cnt_proc']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$cnt_proc = $_POST['cnt_proc'];
		$result1 = mysql_query ("UPDATE jurnal_fizio SET cnt_proc=\"".$cnt_proc."\",EMP_ID =".$luid."  WHERE id = '$task_id'");
	}
  }
}
?>