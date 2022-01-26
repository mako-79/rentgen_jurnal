<?php 
//include "../base.php";

////////////////////////////////////////////////////////////////////////
////////    USERS
////////////////////////////////////////////////////////////////////////
/// id пользователя по логину
function GetUserIdByLogin($login){
		$sql_select = "SELECT id FROM users WHERE login = '$login';";
		$result = mysql_query($sql_select);
		$uid = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		return $uid;
}
/// id пользователя по логину
function GetLvlByLogin($login){
		//$sql_select = "SELECT id FROM users WHERE login = '$login';";
		$sql_select = "SELECT t1.level FROM groups as t1,users as t2 WHERE t1.id = t2.group_id AND t2.login = '$login';";
		$result = mysql_query($sql_select);
		$uid = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		return $uid;
}
////   Имя пользоватлея по id пользователя
function GetUserNameById($uid){
	$user_name;
	if($uid != ''){
		$sql_select = "SELECT Username FROM users WHERE id = '$uid'";
		$result = mysql_query($sql_select);
		$delimiter = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		return $delimiter;
	}
}

////   Имя пользоватлея по id пользователя
function GetFamById($uid){
	$user_name;
	if($uid != ''){
		$sql_select = "SELECT Username FROM users WHERE id = '$uid'";
		$result = mysql_query($sql_select);
		$delimiter = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		return $delimiter;
	}
}

////   Имя пользоватлея по id пользователя
function GetBirthdateById($uid){
	if($uid >0){
		$sql_select = "SELECT birthdate FROM users WHERE id = '$uid'";
		$result = mysql_query($sql_select);
		$delimiter = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		return $delimiter;
	}
}

////   Имя пользоватлея по id пользователя
function GetLoginById($uid){
	$user_name;
	if($uid != ''){
		$sql_select = "SELECT login FROM users WHERE id = '$uid'";
		$result = mysql_query($sql_select);
		$delimiter = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		return $delimiter;
	}
}

///// имя группы по id пользователя
function GetGroupNameByUserId($uid){
	$sql_select = "SELECT t1.gname FROM groups as t1,users as t2 WHERE t1.id = t2.group_id AND t2.id = '$uid';";
	$result = mysql_query($sql_select);  	$gnm = mysql_num_rows($result) ? mysql_result($result, 0) : '';
	return $gnm;
}
///// имя группы по id
function GetGroupById($gid){
	$sql_select = "SELECT gname FROM groups WHERE id = '$gid';";
	$result = mysql_query($sql_select);  	$nm = mysql_num_rows($result) ? mysql_result($result, 0) : '';
	return $nm;
}

function GetUserIdByGroupId($gid){
		$sql_select = "SELECT id FROM users WHERE group_id = '$gid';";
		$result = mysql_query($sql_select);		$nm = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		return $nm;
}

function GetGroupIdByUserId($gid){
        $sql_select = "SELECT group_id FROM users WHERE id = '$gid'";
	$result = mysql_query($sql_select);		$nm = mysql_num_rows($result) ? mysql_result($result, 0) : '';
	return $nm;
}

function GetGroupIdByGrAdminId($gid){
		$dsql_select_level = "SELECT id FROM groups WHERE gr_admin_id = '$gid';";
	        $result = mysql_query($dsql_select_level);	$id = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		return $id;
}
///// Список пользователей id по id группе
function GetUserIdListByGroupId($nm,$gid){
               	$ret = " AND (";
		$sql_select = "SELECT id FROM users WHERE group_id = '$gid';";
	        $result = mysql_query($sql_select);
		$i = 1;
		$allRows = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		do{
			$luid = $row['id'];
			if($allRows == $i){
				$ret.=" ".$nm." = ".$luid."";	        
			}else{
				$ret.=" ".$nm." = ".$luid." OR";	
			}
			$i++;
		}
		while($row = mysql_fetch_array($result));
		$ret .= " )";
	return $ret;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function PagePrint($start, $count) { 
	$HrefPage='';//----Создаём переменную которая будет содержать постраничный вывод
	$number=10;//----Количество записей на странице
	/*Подсчитываем количество страниц, где $count - общее количество записей, $number - количество записей на странице*/
	$CountPage=(int)(($count+$number-1)/$number);
 	/*Перебираем в цикле все страницы*/
 	for($link=1; $link <= $CountPage; $link++):
 	$PageStart=($link - 1) * $number;//----Рассчитываем точку выборки из базы данных
 	$HrefPage=$HrefPage."<a href=".getenv('PHP_SELF')."?start=".$PageStart." target=_parent>".$link."</a>";//--Формируем ссылки
 	endfor;
return $HrefPage;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DateTimeParseToDtTm($ldt){
     $lgdt = date_parse_from_format("Y-m-d h:i:s", $ldt);
		if($lgdt[day]<10) $lgdt[day] = "0".$lgdt[day];
		if($lgdt[month]<10) $lgdt[month] = "0".$lgdt[month];
		if($lgdt[hour]<10) $lgdt[hour] = "0".$lgdt[hour];
		if($lgdt[minute]<10) $lgdt[minute] = "0".$lgdt[minute];
		$gdt = $lgdt[day].".".$lgdt[month].".".$lgdt[year]." ".$lgdt[hour].":".$lgdt[minute];	
	return $gdt;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DateTimeParseToDt($ldt){
     $lgdt = date_parse_from_format("Y-m-d h:i:s", $ldt);
		if($lgdt[day]<10) $lgdt[day] = "0".$lgdt[day];
		if($lgdt[month]<10) $lgdt[month] = "0".$lgdt[month];
		if($lgdt[hour]<10) $lgdt[hour] = "0".$lgdt[hour];
		if($lgdt[minute]<10) $lgdt[minute] = "0".$lgdt[minute];
		$gdt = $lgdt[day].".".$lgdt[month].".".$lgdt[year];	
	return $gdt;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DateToDt($ldt){
     $lgdt = date_parse_from_format("Y-m-d", $ldt);
		if($lgdt[day]<10) $lgdt[day] = "0".$lgdt[day];
		if($lgdt[month]<10) $lgdt[month] = "0".$lgdt[month];
		$gdt = $lgdt[day].".".$lgdt[month].".".$lgdt[year];	
	return $gdt;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DateTimeParseToTm($ldt){
     $lgdt = date_parse_from_format("Y-m-d h:i:s", $ldt);
		if($lgdt[day]<10) $lgdt[day] = "0".$lgdt[day];
		if($lgdt[month]<10) $lgdt[month] = "0".$lgdt[month];
		if($lgdt[hour]<10) $lgdt[hour] = "0".$lgdt[hour];
		if($lgdt[minute]<10) $lgdt[minute] = "0".$lgdt[minute];
		$gdt = $lgdt[hour].":".$lgdt[minute];	
	return $gdt;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DateTimeParseBackToDtTm($ldt){
     $lgdt = date_parse_from_format("d.m.Y h:i", $ldt);
		if($lgdt[day]<10) $lgdt[day] = "0".$lgdt[day];
		if($lgdt[month]<10) $lgdt[month] = "0".$lgdt[month];
		if($lgdt[hour]<10) $lgdt[hour] = "0".$lgdt[hour];
		if($lgdt[minute]<10) $lgdt[minute] = "0".$lgdt[minute];
		$gdt = $lgdt[year]."-".$lgdt[month]."-".$lgdt[day]." ".$lgdt[hour].":".$lgdt[minute].":00";	
	return $gdt;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DateParseBackToDt($ldt){
     $lgdt = date_parse_from_format("d.m.Y", $ldt);
		if($lgdt[day]<10) $lgdt[day] = "0".$lgdt[day];
		if($lgdt[month]<10) $lgdt[month] = "0".$lgdt[month];
		$gdt = $lgdt[year]."-".$lgdt[month]."-".$lgdt[day];
	return $gdt;
}


function get_active($login){
  //  $sql_select_level = "SELECT active FROM mailbox WHERE username = '".$login."';";
 //   $result_lvl = mysql_query($sql_select_level);
   // $level = mysql_result($result_lvl,0,'active');
    //return $level;
}
//////////////////////////////////////////////////////////////////////////////
function get_filesize($file)
{
    if(!file_exists($file)) return "Файл  не найден";

  $filesize = filesize($file);

if($filesize > 1024){
$filesize = ($filesize/1024);
    if($filesize > 1024){
    $filesize = ($filesize/1024);
        if($filesize > 1024) {
        $filesize = ($filesize/1024);
        $filesize = round($filesize, 1);
        return $filesize." ГБ";       
        } else {
        $filesize = round($filesize, 1);
        return $filesize." MБ";   
        }       
    } else {
    $filesize = round($filesize, 1);
    return $filesize." Кб";   
    }  
    } else {
    $filesize = round($filesize, 1);
    return $filesize." байт";   
    }
}

//объявляем функцию, которая принимает один параметр - путь к папке
function dir_size($dir) {
   //в эту переменную будем накапливать размеры всех найденных файлов
   $totalsize=0;
   //открываем папку
   if ($dirstream = @opendir($dir)) {
      //перебираем все найденные файлы и папки
      while (false !== ($filename = readdir($dirstream))) {
         // если это не сама папка и не её родитель
         if ($filename!="." && $filename!=".."){
            //если это файл - накапливаем его размер
            if (is_file($dir."/".$filename)) $totalsize+=filesize($dir."/".$filename);
            //если это папка - уходим в рекурсию и накапливаем её результат
            if (is_dir($dir."/".$filename)) $totalsize+=dir_size($dir."/".$filename);
         }
      }
   }
   //закрываем папку
   closedir($dirstream);
   //возвращаем накопленное значение размеров
   return $totalsize;
}
//////////////////////////////////
function getDirectorySize($folderPath)
{
  $files = scandir($folderPath);
  unset($files[0], $files[1]);
  $size = 0;
  foreach ($files as $file) {
    if (file_exists($folderPath . '/' . $file)) {
      $size += filesize($folderPath . '/' . $file);
      if (is_dir($folderPath . '/' . $file)) {
        $size += $this->getDirectorySize($folderPath . '/' . $file);
      }
    }

  }

  return $size;
}

function dirSize($directory) { 
    $size = 0; 
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){ 
                $size+=$file->getSize(); 
                    } 
                        return $size; 
                        }
//////////////////////////////////
function getExtension($filename) {
    return end(explode(".", $filename));
}

?>