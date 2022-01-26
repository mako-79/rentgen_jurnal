<?
include ("../base.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login']) ) {

        require "../sub/functions.php";
	$login = $_SESSION['Login'];	
	$level = GetLvlByLogin($login);
	$luid = GetUserIdByLogin($login);
    if($level>3){
	
	$n_fname = "";
	if (isset($_POST['n_fname'])) {		
		$n_fname = $_POST['n_fname'];
		$n_fname = stripslashes($n_fname);
		$n_fname = htmlspecialchars($n_fname);
	}

	$n_name = "";
	if (isset($_POST['n_name'])) {		
		$n_name = $_POST['n_name'];
		$n_name = stripslashes($n_name);
		$n_name = htmlspecialchars($n_name);
	}

	$n_sname = "";
	if (isset($_POST['n_sname'])) {		
		$n_sname = $_POST['n_sname'];
		$n_sname = stripslashes($n_sname);
		$n_sname = htmlspecialchars($n_sname);
	}

	$n_fio = "";
	if($n_fname != '' && $n_name != ''){
		$n_fio = $n_fname." ".$n_name." ".$n_sname;
	}

	$nbdt = "";
	if (isset($_POST['n_bdt'])) {		
		$nbdt = $_POST['n_bdt'];
		$nbdt = DateParseBackToDt($nbdt);
	}

	$nph = "";
	if (isset($_POST['n_phone'])) {		
		$nph = $_POST['n_phone'];
	}
	
	$result_next = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME = 'users';");
	$n_uid = mysql_num_rows($result_next) ? mysql_result($result_next, 0) : '';	
	
     	$result_ch = mysql_query("SELECT id FROM jurnal j WHERE SURNAME = '$n_fname' AND FIRSTNAME = '$n_name' AND LASTNAME = '$n_sname' AND birthdate = '$nbdt'");
	$chid = mysql_num_rows($result_ch) ? mysql_result($result_ch, 0) : '';		

	if($chid>0){      
		echo "Ошибка! Такой пациент ".$nfio." существует";
	}else{
		$resultadd = mysql_query ("INSERT INTO users (Username,SURNAME,FIRSTNAME,LASTNAME,group_id,birthdate,enable,phone) VALUES('$n_fio','$n_fname','$n_name','$n_sname',4,'$nbdt','1','$nph')") or die("Query failed ".mysql_error());
		// Проверяем, есть ли ошибки
		if ($resultadd=='TRUE'){
			echo "Пользователь успешно добавлен!";
		}else{
	    		echo "Ошибка! Пользователь не добавлен.(".$nfio.")";
		}
	}
     }
}
    ?>