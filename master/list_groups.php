<?php include "../header.php"; 

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	$login = $_SESSION['Login'];
	$level = GetLvlByLogin($login);
	include "../task_menu.php"; 
    if($level>3){
?>
    <script type="text/javascript" src="js/add_group.js"></script>
    	    <script type="text/javascript" src="js/save_group.js"></script>
    	    	    <script type="text/javascript" src="js/del_group.js"></script>
    	    		<script type="text/javascript" src="js/add_user.js"></script>
    	    			    <script type="text/javascript" src="js/del_user.js"></script>
    	    			    
    	    			    
<div align=center><h3>Таблица групп</h3></div>
<div class="list">
    <div><input type=button id="add-form-btn" value="Добавить"><input type=button id="del-group-btn" value="Удалить"></div>
    
    <table class="list-groups" id="ListGroups">
	<tr>
		<td>ID</td>
		<td>Название группы</a></td>
		<td>Уровень</td>
	</tr>
<?
	$sql_select = "SELECT * FROM groups ORDER BY id"; 
	$result = mysql_query($sql_select); 
	$row = mysql_fetch_array($result);
	
	$sql_select_next = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME = 'groups';";
	$result_next = mysql_query($sql_select_next);
	$new_lid = mysql_result($result_next,0,'AUTO_INCREMENT');
	$ret;
	do{
	    $lid = $row['id'];
		$lvl_name;
		if($row['level']==3){
                     $lvl_name = "Пользователи";
		}else if($row['level']==5){
                     $lvl_name = "Операторы";
		}else if($row['level']==7){
                     $lvl_name = "Врачи";
		}else if($row['level']==9){
                     $lvl_name = "Руководство";
		}
	
	if(mysql_num_rows($result)>0){

	    echo "<tr id='td-".$row['id']."'>";
		echo "<td class='td_".$row['id']."'>" . $row['id'] . "</td>";
		echo "<td class='nm_".$row['id']."'>" . $row['gname'] . "</td>";
		//echo "<td>" . $row['enable'] . "</td>";
		echo "<td>" . $lvl_name . " </td>";
		echo "<td>";
		    echo "<img width=20 class=\"edit-click\" id=\"" .$lid. "\" src=\"/images/edit.png\">";
		    echo "<span id=\"tdd-" .$lid. "\">";
		    	include "edit-group-form.php";
		    echo "</span>";
		echo "</td>";
	        
		echo "<td><form id=deluserform><input type=checkbox class=checkbox name=did id=did value=\"".$lid."\"></form></td>";
		//echo "<td>" . $row['Password'] . "</td>";
		echo "</tr>";
		}
	}
	while($row = mysql_fetch_array($result));?>
	</table>
	<?include "add-group-form.php";?>
</div>
<?
    }
}
include "../footer.php"; ?>