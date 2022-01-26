<?php 
include "../header.php"; 
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login']) ) {
	
	$login = $_SESSION['Login'];
	$level = GetLvlByLogin($login);
	echo "<p>Сейчас вы будете перенаправлены в закрытый раздел.</p>";  
	    echo "<meta http-equiv='refresh' content='2;jurnal.php'>";  
    }else if(!empty($_POST['username']) && !empty($_POST['password']))  {
	// позволим пользователю войти на сайт 
	$username = mysql_real_escape_string($_POST['username']);  
	$password = md5(mysql_real_escape_string($_POST['password']));  
	$checklogin = mysql_query("SELECT * FROM users WHERE login = '".$username."' AND Password = '".$password."'");  

	if(mysql_num_rows($checklogin) == 1){  
    	    $row = mysql_fetch_array($checklogin);  
		if($row['enable']==1){
	
	    		$email = $row['EmailAddress'];
    	    		$_SESSION['Login'] = $username;
    	    		$_SESSION['Username'] = $row['Username'];  
    	    		$_SESSION['EmailAddress'] = $email;  
    	    		$_SESSION['LoggedIn'] = 1;
			$_SESSION['time']=time();  
 
    	    		echo "<h1>Авторизация выполнена!</h1>";
    	    		echo "<p>Сейчас вы будете перенаправлены в закрытый раздел.</p>";  
    	    		echo "<meta http-equiv='refresh' content='2;jurnal.php'>";  
		}else{
 			echo "<h1>Ошибка</h1>";  
    	    		echo "<p>Данный логин заблокирован.</p>";  
		}
	}  else  {  
    	    echo "<h1>Ошибка</h1>";  
    	    echo "<p>Данный логин/пароль не найден. Можете <a href=\"/index.php\">попробовать ещё раз</a>.</p>";  
	}
    }else{
	include "../login.php";
    }
include "../footer.php"; ?>