<?
include ("../base.php");
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
    $login = $_SESSION['Login'];
    $level = GetLvlByLogin($login);;
    if($level>3){
	require "../sub/func_db.php";
      
      	$n_name = "";
	if (isset($_POST['n_name'])){		
		$n_name = $_POST['n_name'];
		$n_name = htmlspecialchars($n_name);
		$n_name = urldecode($n_name);
	}
  	$dop = "";
	if (isset($_POST['dop'])){		
		$dop = $_POST['dop'];
		$dop = htmlspecialchars($dop);
		$dop = urldecode($dop);
	}

        $result2 = mysql_query ("INSERT INTO spr (name,dop) VALUES('$n_name','$dop')");
	echo "Успешно!";

	
    }
}
    ?>