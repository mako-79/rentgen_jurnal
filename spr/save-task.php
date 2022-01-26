<?include ("../base.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])){	
	$login = $_SESSION['Login'];	
	require "../sub/functions.php";
	$level = GetLvlByLogin($login);
		
if($level>3){
	echo "[".$_POST['name']."]";;
	$name;
	$dop;

	if (isset($_POST['name']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$name = $_POST['name'];
		$name = urldecode($name);
		$name = htmlspecialchars($name);
		echo $name;
		$result2 = mysql_query ("UPDATE spr SET name=\"".$name."\" WHERE id = '$task_id'") or die("Query failed ".mysql_error());
	}

    	if (isset($_POST['cat_id']) && $_POST['task_id'] > 0) {		
    		$cat_id = $_POST['cat_id'];
    		$result1 = mysql_query ("UPDATE spr SET cat_id=\"".$cat_id."\" WHERE id = '$task_id'") or die("Query failed ".mysql_error());
        }

    	if (isset($_POST['uet']) && $_POST['task_id'] > 0) {		
    		$uet = $_POST['uet'];
    		$result1 = mysql_query ("UPDATE spr SET uet=\"".$uet."\" WHERE id = '$task_id'") or die("Query failed ".mysql_error());
        }
	    		    

	
	if (isset($_POST['dop']) && $_POST['task_id'] > 0){
		$task_id = $_POST['task_id'];
		$dop = $_POST['dop'];
		$dop = urldecode($dop);
		$dop = htmlspecialchars($dop);
		$result3 = mysql_query ("UPDATE spr SET dop=\"".$dop."\" WHERE id = '$task_id'") or die("Query failed ".mysql_error());
	}
  }
}
?>