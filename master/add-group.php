<?
include "../base.php";

        if (isset($_POST['n_name'])) {
		$nname = $_POST['n_name'];
		if ($nname == '') {
			unset($nname);
		} 
	} 
	$nname = stripslashes($nname);
	$nname = htmlspecialchars($nname);
	//удаляем лишние пробелы
	$nname = trim($nname);

	if (isset($_POST['n_level'])) {
		$nlvl = $_POST['n_level'];
		$nlvl = trim($nlvl);
	}
	// проверка на существование пользователя с таким же логином
	$result = mysql_query("SELECT id FROM groups WHERE name = '$nname'");
	$myrow = mysql_fetch_array($result);
		if (!empty($myrow['id'])) {
	    		exit ("Извините, введённое вами наименование уже зарегистрировано. Введите другой логин.");
		}

	$result2 = mysql_query ("INSERT INTO groups (gname,level,enable) VALUES('$nname','$nlvl','1')") or die("Query failed ".mysql_error());
	

?>