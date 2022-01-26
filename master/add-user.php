<?include "../base.php";
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])){

    $login = $_SESSION['Login'];
    require "../sub/functions.php";
    $level = GetLvlByLogin($login);
    
    if($level>3){

       $nlogin;
	$npassword;
       if (isset($_POST['n_login'])) {
		$nlogin = $_POST['n_login'];
		if ($nlogin == '') {
			unset($nlogin);
		}
	} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
	
	if (isset($_POST['n_pass'])) { 
		$npassword = $_POST['n_pass']; 
		
		if ($npassword == ''){
		    unset($npassword);
		}
	}
    
	$nlogin = stripslashes($nlogin);
	$nlogin = htmlspecialchars($nlogin);
        $nlogin = trim($nlogin); 
	
	$npassword = stripslashes($npassword);
	$npassword = htmlspecialchars($npassword);
	$npassword = md5(mysql_real_escape_string($npassword));
        //удаляем лишние пробелы
	
	$npassword = trim($npassword);
	
	// проверка на существование пользователя с таким же логином
	$result = mysql_query("SELECT id FROM users WHERE login = '$nlogin'");
	$myrow = mysql_fetch_array($result);
	if (!empty($myrow['id'])) {
	    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
	}

	
	$ngrid = "";
	if (isset($_POST['n_group_id'])) {		
		$ngrid = $_POST['n_group_id'];
	}
	
	$nfio = "";
	if (isset($_POST['n_fio'])) {		
		$nfio = $_POST['n_fio'];
		$nfio = stripslashes($nfio);
		$nfio = htmlspecialchars($nfio);
	}

	$nbdt = "";
	if (isset($_POST['n_bdt'])) {		
		$nbdt = $_POST['n_bdt'];
		$nbdt = DateParseBackToDt($nbdt);
	}

 	$ndop = "";
	if (isset($_POST['n_dop'])) {		
		$ndop = $_POST['n_dop'];
		$ndop = stripslashes($ndop);
		$ndop = htmlspecialchars($ndop);
	}

	// если такого нет, то сохраняем данные
	$resultadd = mysql_query ("INSERT INTO users (login,Username,Password,group_id,enable,birthdate,dop) VALUES('$nlogin','$nfio','$npassword','$ngrid','1','$nbdt','$ndop')");
	// Проверяем, есть ли ошибки
		if ($resultadd=='TRUE'){
	    		echo "Пользователь успешно добавлен! <br> <a href='index.php'>Главная страница</a>";
		}else{
	    		echo "Ошибка! Пользователь не добавлен.($nlogin,$nfio,$npassword,$ngrid')";
		}
    }
}

    ?>