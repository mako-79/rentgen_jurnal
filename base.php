<?php session_start();

$dbhost = "localhost"; // Адрес сервера MySQL. На локальном сервере этот параметр всегда будет 'localhost', но на хостинге он соответствует адресу хостера.
$dbname = "RENTGEN"; // Имя базы данных 
$dbuser = "rentgen_user"; // Пользователь базы данных
$dbpass = "!2Htynuty3!"; // Пароль пользователя базы данных  

date_default_timezone_set('Europe/Kaliningrad');
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die("Ошибка MySQL: " . mysql_error());
mysql_select_db($dbname) or die("Ошибка MySQL: " . mysql_error());
mysql_query("SET NAMES 'utf8'"); 
mysql_query("SET CHARACTER SET 'utf8'");
mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");
?>