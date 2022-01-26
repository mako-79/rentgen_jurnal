<?
include "../base.php";

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])){

    $login = $_SESSION['Login'];
    require "../sub/functions.php";
    $level = GetLvlByLogin($login);
    
    if($level>3){
	/// Проверяем и Сохраняем логин     
        if (isset($_POST['login'])) {
		$nlogin = $_POST['login'];
		
		if($_POST['user_id'] > 0 && $nlogin != ''){
		    $nlogin = stripslashes($nlogin);
		    $nlogin = htmlspecialchars($nlogin);
		    $nlogin = trim($nlogin);
		    $user_id = $_POST['user_id'];
		    $result = mysql_query("SELECT id FROM users WHERE login = '$nlogin'") or die("Query failed ".mysql_error());
		    $myrow = mysql_fetch_array($result);
		    if (empty($myrow['id'])) {
			$result1 = mysql_query ("UPDATE users SET login='$nlogin' WHERE id = '$user_id'") or die("Query failed ".mysql_error());
		    }
		}
	} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
	if($level>5){
	    if (isset($_POST['n_pass'])){
		$npassword = $_POST['n_pass'];
		
		
		if($_POST['user_id'] > 0 && $npassword != ''){
		    $npassword = stripslashes($npassword);
		    $npassword = htmlspecialchars($npassword);
		    $npassword = md5(mysql_real_escape_string($npassword));
		    $npassword = trim($npassword);
		    $user_id = $_POST['user_id'];
		    $result2 = mysql_query ("UPDATE users SET Password='$npassword' WHERE id = '$user_id'") or die("Query failed ".mysql_error());
		}
	    }
	}

	$grid = "";
	if (isset($_POST['group'])) {		
		$grid = $_POST['group'];
		if($_POST['user_id'] > 0){
		    $user_id = $_POST['user_id'];
		    $result4 = mysql_query ("UPDATE users SET group_id = '$grid' WHERE id = '$user_id'") or die("Query failed ".mysql_error());
		}
	}	

	
	$nfio = "";
	if (isset($_POST['fio'])) {		
		$nfio = $_POST['fio'];
		$nfio = stripslashes($nfio);
		$nfio = htmlspecialchars($nfio);
		if($_POST['user_id'] > 0){
		    $user_id = $_POST['user_id'];
		    $result5 = mysql_query ("UPDATE users SET Username = '$nfio' WHERE id = '$user_id'") or die("Query failed ".mysql_error());
		}
	}
	
	    $bdt = "";
		if (isset($_POST['bdt'])) {		
			$bdt = $_POST['bdt'];
			$bdt = DateParseBackToDt($bdt);
			if($_POST['user_id'] > 0){
			    $user_id = $_POST['user_id'];
			   $result5 = mysql_query ("UPDATE users SET birthdate = '$bdt' WHERE id = '$user_id'") or die("Query failed ".mysql_error());
	        	}
	    	}

	$ndop = "";
	if (isset($_POST['dop'])) {		
		$ndop = $_POST['dop'];
		$ndop = stripslashes($ndop);
		$ndop = htmlspecialchars($ndop);
		if($_POST['user_id'] > 0){
		    $user_id = $_POST['user_id'];
		    $result5 = mysql_query ("UPDATE users SET dop = '$ndop' WHERE id = '$user_id'") or die("Query failed ".mysql_error());
		}
	}

						    		
	if($level>5){
		$enbl = "";
		if (isset($_POST['enable'])) {		
			$enbl = $_POST['enable'];
			if($_POST['user_id'] > 0){
			    $user_id = $_POST['user_id'];
			    $result5 = mysql_query ("UPDATE users SET enable = '$enbl' WHERE id = '$user_id'") or die("Query failed ".mysql_error());
			}
		}
	}
	
    }
}?>