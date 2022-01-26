<?
include ("../base.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login']) ) {

        require "../sub/functions.php";
	$login = $_SESSION['Login'];	
	$level = GetLvlByLogin($login);
	$luid = GetUserIdByLogin($login);
    if($level>3){
	
        $n_name = "";
	if (isset($_POST['n_name'])) {		
		$n_name = $_POST['n_name'];
		$n_name = htmlspecialchars($n_name);
		$n_name = urldecode($n_name);
			echo $n_name;
	}
        
        $n_cat_id = 0;
	if (isset($_POST['n_cat_id'])) {		
		$n_cat_id = $_POST['n_cat_id'];
	}

        $n_uet = "";
	if (isset($_POST['n_uet'])) {		
		$n_uet = $_POST['n_uet'];
	}

	
        $n_dop = "";
	if (isset($_POST['n_dop'])) {		
		$n_dop = $_POST['n_dop'];
		$n_dop = htmlspecialchars($n_dop);
		$n_dop = urldecode($n_dop);
			echo $n_dop;
	}

	if ($n_name != '') {		
	    $result = mysql_query ("INSERT INTO spr (name,cat_id,dop,uet) VALUES('$n_name','$n_cat_id','$n_dop','$n_uet')") or die("Query failed ".mysql_error());
	}else{
	 	echo "[no select]";
	}
    }	
}else{
	include "../login.php";
}
    ?>