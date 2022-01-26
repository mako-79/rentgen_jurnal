<?php  include "../header.php"; 
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	$login = $_SESSION['Login'];
	$level = GetLvlByLogin($login);
include "../task_menu.php"; 
    if($level>5){

?>
    <script type="text/javascript" src="js/add_group.js"></script>
    <script type="text/javascript" src="js/save_group.js"></script>
    <script type="text/javascript" src="js/del_group.js"></script>
    <script type="text/javascript" src="js/add_user.js"></script>
    <script type="text/javascript" src="js/del_user.js"></script>
    	    			    
    	    			    
<div align=center><h3>Таблица пользователей</h3></div>
    <div><input type=button class=btn id="add-form-btn" value="Добавить"> <input type=button class=btn id="del-user-btn" value="Удалить"></div>
</div>
<?
	$slogin;
	$sgroup;
	$sort;
	$cnt_str;
	
	if(!$cnt_str) $cnt_str = 50;

        if($_GET['action'] == 'clear'){
		$_SESSION['sgroup'] = '';
		$_SESSION['suser'] = '';
		$_SESSION['cnt_str'] = '';
		$_SESSION['sort'] = '';
		}
	
	if(!empty($_GET['suser'])){
		$suser = $_GET['suser'];
	        $_SESSION['suser'] = $suser;
	}else{
		$_SESSION['suser'] = '';
	}
	
	if(!empty($_GET['sgroup'])){
		$sgroup = $_GET['sgroup'];
	        $_SESSION['sgroup'] = $sgroup;
	}else if(!empty($_SESSION['sgroup'])){	
	        $sgroup = $_SESSION['sgroup'];
	}else{
		$_SESSION['sgroup'] = '';
	}
	
	if(!empty($_GET['sort'])){
		$sort = $_GET['sort'];
	        $_SESSION['sort'] = $sort;
	}else{
		$_SESSION['sort'] = '';
	}
?>	
	<form method=GET action="list_users.php">
		<strong>Поиск</strong>
		по ФИО <input id=suser name=suser value="<? echo $suser?>">
		по группе:  <select id=sgroup name=sgroup style="width:200px;">
			<option value=''>Выбрать группу
		<?
			$sgresult = mysql_query("SELECT id,gname FROM groups ORDER BY gname ASC;"); 
			$sgrow = mysql_fetch_array($sgresult);
	                do{
			    echo "<option ";
			    if($_SESSION['sgroup'] == $sgrow['id']){ 
				echo "selected";
			    }
			    echo " value='". $sgrow['id'] ."'>". $sgrow['gname'] ."</option>";
			}
			    while($sgrow = mysql_fetch_array($sgresult));
		?>
		</select>
		   <input type=submit class=srch-btn value="Поиск">
		<input type=button class=srch-btn value="Сброс" onclick="document.location.href='/master/list_users.php?action=clear&sgroup=&suser=&sort=<? echo $sort?>'">
	</form>

<div class="list"> 
    <table class="list-users" id="ListUsers">
	<tr>
		<th></th>
		<?if($sgroup != 4){?>
			<th>Логин</th>
		<?}?>
		<th>ФИО</th>
		<th>ДР</th>
		<?if($sgroup == ''){?>
		<th>Группа</th>
		<?}?>
		<?if($sgroup == 4){?>
			<th>Телефон</th>
			<th>Адрес</th>
		<?}?>
		<th>Ком.</th>
	</tr>
<?
        $spoint="";
	$spoint2="";
	$spoint3="";

	if($suser != "")
		$spoint = "AND lower(t1.Username) LIKE lower('%".$suser."%')";

	if($sgroup != "")
		$spoint2 = "AND t2.id = '".$sgroup."'";
	     
	if($sort == 'group'){
		$spoint3 = "t2.gname ASC";
	}else if($sort == 'name'){
		$spoint3 = "t1.Username ASC";
	}else{
		$spoint3 = "t2.gname ASC";
	}
	///////////////////////////////////////////////////////////////////////////////////
	$page;
	
	if(!$page || $page==0){$page=1;}

	    if(isset($_GET["page"])){
		$page = $_GET['page'];
	    }else if(isset($_POST["Page"])){
		$page = $_POST['Page'];
	    }

	$href = "/master/list_users.php?sgroup=".$sgroup."&suser=".$suser."&sort=".$sort."";
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////		        
?>
	<div align="center">
	<? 
  	$result_cnt = mysql_query("SELECT count(1) FROM users t1 LEFT JOIN groups t2 ON t1.group_id = t2.id WHERE t1.id>0 ".$spoint." ".$spoint2." ORDER BY ".$spoint3."") or die("Query failed ".mysql_error());;
  	$allcnt = mysql_num_rows($result_cnt) ? mysql_result($result_cnt, 0) : '';

	$in_page = 30;
	$ltmp = $allcnt%$in_page;
        $pages = ceil($allcnt/$in_page);
	$start = $page*$in_page-$in_page;
	$end = ($page*$in_page)-1;
	
	if($end >= $allcnt) $end = $allcnt-1;
	
        if($pages>0){
		#две назад
		echo "<div>";
	  	if(($page-2)>0){
	  		$ptwoleft="<a href='".$href."&page=".($page-2)."'>".($page-2)."</a>  ";
		}else{
	  		$ptwoleft=null;
		}
			
		#одна назад
		if(($page-1)>0){
			$poneleft="<a href='".$href."&page=".($page-1)."'>".($page-1)."</a>  ";
	 		$ptemp=($page-1);
		}else{
	  		$poneleft=null;
	  		$ptemp=null;
		}
			
		#две вперед
		if(($page+2)<=$pages){
	  		$ptworight="  <a href='".$href."&page=".($page+2)."'>".($page+2)."</a>";
		}else{
	  		$ptworight=null;
		}
			
		#одна вперед
		if(($page+1)<=$pages){
	  		$poneright="  <a href='".$href."&page=".($page+1)."'>".($page+1)."</a>";
	  		$ptemp2=($page+1);
		}else{
	  		$poneright=null;
	  		$ptemp2=null;
		}		
			
		# в начало
		if($page!=1 && $ptemp!=1 && $ptemp!=2){
	  		$prevp="<a href='".$href."' title='В начало'><<</a> ";
		}else{
	  		$prevp=null;
		}   
			
		#в конец 
		if($page!=$pages && $ptemp2!=($pages-1) && $ptemp2!=$pages){
	  		$nextp=" ...  <a href='".$href."page=".$pages."'".$pages."'>$pages</a>";
		}else{
	  		$nextp=null;
		}
		echo "<br>".$prevp.$ptwoleft.$poneleft.'<span class="num_page_not_link"><b>'.$page.'</b></span>'.$poneright.$ptworight.$nextp; 
		echo "</div>";	
	 }	
	?>
	<span id="rez" style="font-size:20px; font-weight:bold; text-align: center"></span>
 	</div>
	</div>	        
<?	        
        $sql_select = "SELECT t1.id,t1.login,t1.Username,t1.Password,t1.group_id,t2.gname,t2.level,t1.birthdate,t1.birthdate_f,t1.enable,t1.phone,t1.adres,t1.dop
    			    FROM users t1 LEFT JOIN groups t2 ON t1.group_id = t2.id 
				WHERE t1.id>0 ".$spoint." ".$spoint2." ORDER BY ".$spoint3." LIMIT ".$start.", ".$in_page;
	    $result = mysql_query($sql_select) or die("Query failed ".mysql_error());
	    $row = mysql_fetch_array($result);
	    
		
		$result_next = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME = 'users';");
		$new_lid = mysql_num_rows($result_next) ? mysql_result($result_next, 0) : '';

	    $ret;
	    do{
	        $lid = $row['id'];
	        $luser = $row['Username'];
	    	$enable = $row['enable'];
		$group_id = $row['group_id'];
		$bdt = $row['birthdate'];
		$phone = $row['phone'];
		$adres = $row['adres'];
		$dop = $row['dop'];
		$bdt2 = $row['birthdate_f'];
		$nbdt = DateParseBackToDt($bdt2);
		
		if(mysql_num_rows($result)>0){
	    
	    	    echo "<tr class='".$sel_a."' id='td-".$row['id']."'>";

			echo "<td width=20>" . $row['id'] . "</td>";
                        if($sgroup != 4){
	    			echo "<td width=150>" . $row['login'] . "</td>";
	    		}
	    		echo "<td width=250>" . $row['Username'] . "</td>";
	    		echo "<td width=150>" . DateTimeParseToDt($bdt)  . "</td>";
			if($sgroup == ''){
	    	        echo "<td width=180>" . $row['gname'] . " </td>";
	    	        
			}
			if($sgroup == 4){
		    	    echo "<td width=180>" . ($row['phone'] != ''?$row['phone']:'') . "</td>";
		    	    echo "<td width=180>" . $adres . "</td>";
		    	}
			    echo "<td class='dt_".$lid."'>" . $dop . "</td>";	
		    echo "<td>";
		    	echo "<img width=20 class=\"edit-click\" id=\"" .$lid. "\" src=\"/images/edit.png\">";
		?>
		<script>
			$("#<?=$lid?>").click(function(){
        		   $.arcticmodal({
            			type: 'ajax',
            			url: '/master/edit-user-form.php',
            				ajax: {
                				type: 'POST',
                				data: {
							new_id:'<?=$lid?>',
						}
            				}
        			});
    			});

			</script>
		</td>
		<td><form id=deluserform><input type=checkbox class=checkbox name=did id=did value="<?=$lid?>"></form></td>
	    </tr>
	    <?}
	}
	while($row = mysql_fetch_array($result));
	?>
    </table>
	<? include "add-user-form.php";   ?>
</div>
<?
	}
}
include "../footer.php"; ?>