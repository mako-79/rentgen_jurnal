<?
include ("../base.php");
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
    $login = $_SESSION['Login'];
    $level = GetLvlByLogin($login);;
    if($level>3){
	require "../sub/func_db.php";
      
      	$dop = "";
	if (isset($_POST['dop'])){		
		$dop = $_POST['dop'];
		$dop = htmlspecialchars($dop);
		$dop = urldecode($dop);
	}

	$tdt = date("Y-m-d h:i:s");
	  if ($_POST['ugroup_id']>0) {		
		$user_id = $_POST['user_id'];
                $result2 = mysql_query ("INSERT INTO jurnal_fizio (regdate,user_id,dop) VALUES('$tdt','$user_id','$dop')");
		echo "Успешно!";
	  }
	
    }
}
    ?>