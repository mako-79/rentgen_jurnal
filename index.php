<?php 
include "header.php"; 
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login']) && !empty($_SESSION['time']) && 1200 > (time()-$_SESSION['time'])) {
	
	$_SESSION['time']=time();
	$login = $_SESSION['Login'];
	$sql_select_level = "SELECT t1.level FROM groups as t1,users as t2 WHERE t1.id = t2.group_id AND t2.login = '$login';";
	$result_lvl = mysql_query($sql_select_level);
	$level = mysql_result($result_lvl,0,'level');
	
	include "tasks.php";
    }else if(!empty($_POST['username']) && !empty($_POST['password']))  {
	// позволим пользователю войти на сайт 
	$username = mysql_real_escape_string($_POST['username']);  
	$password = md5(mysql_real_escape_string($_POST['password']));  
	
	$checklogin = mysql_query("SELECT * FROM users WHERE login = '".$username."' AND Password = '".$password."'");  

	if(mysql_num_rows($checklogin) == 1){  
    	    $row = mysql_fetch_array($checklogin);  
		if($row['enable']==1){
	
	    		//$email = $row['EmailAddress'];
    	    		$_SESSION['Login'] = $username;
    	    		$_SESSION['Username'] = $row['Username'];  
    	    		//$_SESSION['EmailAddress'] = $email;  
    	    		$_SESSION['LoggedIn'] = 1;
			$_SESSION['time']=time();  
 
    	    		echo "<h1>Авторизация выполнена!</h1>";
    	    		echo "<p>Сейчас вы будете перенаправлены в закрытый раздел.</p>";  
    	    		echo "<meta http-equiv='refresh' content='1;index.php'>";  
		}else{
 			echo "<h1>Ошибка</h1>";  
    	    		echo "<p>Данный логин заблокирован.</p>";  
		}
	}  else  {  
    	    echo "<h1>Ошибка</h1>";  
    	    echo "<p>Данный логин/пароль не найден. Можете <a href=\"index.php\">попробовать ещё раз</a>.</p>";  
	}
    }else{
	include "login.php";
    }

include "footer.php"; 
?>