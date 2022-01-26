<?
include ("../base.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login']) ) {

        require "../sub/functions.php";
	$login = $_SESSION['Login'];	
	$level = GetLvlByLogin($login);
	$luid = GetUserIdByLogin($login);
    if($level>3){

	$ndt = "";
	if (isset($_POST['n_dt'])) {		
		$ldt = $_POST['n_dt'];
		$ndt = DateTimeParseBackToDtTm($ldt);
		
		$tdt = date("Y-m-d H:i:s");
		if($ndt == 0){$ndt = $tdt;}
	}
	
        $spr_id = "";
	if (isset($_POST['n_pr'])) {		
		$spr_id = $_POST['n_pr'];
	}

        $spr_id2 = "";
	if (isset($_POST['n_doza'])) {		
		$spr_id2 = $_POST['n_doza'];
	}

        $n_dop = "";
	if (isset($_POST['n_dop'])) {		
		$n_dop = $_POST['n_dop'];
		$n_dop = htmlspecialchars($n_dop);
		$n_dop = urldecode($n_dop);
			echo $n_dop;
	}

	if (isset($_POST['n_user_id'])){
			$n_user_id = $_POST['n_user_id'];
			$n_emp_id = $_POST['n_emp_id'];
			$result2 = mysql_query ("INSERT INTO jurnal (regdate,PID,dop,EMP,EMP_ID,spr_id,spr_id2) VALUES('$ndt','$n_user_id','$n_dop','$n_emp_id','$luid','$spr_id','$spr_id2') ") or die("Query failed ".mysql_error());
	}else{
	 	echo "[no select]";
	}
    }	
}else{
	include "../login.php";
}
    ?>