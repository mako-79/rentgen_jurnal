<?php include "../header.php"; ?>

<?if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {

	$login = $_SESSION['Login'];	
	$level = GetLvlByLogin($login);
	$uid = GetUserIdByLogin($login);
	include "../task_menu.php"; 
	
    if($level>3){?>
	<script type="text/javascript" src="js/jurnal.js"></script>
	<script type="text/javascript" src="js/users.js"></script>    
	<script type="text/javascript" src="js/emps.js"></script>
    <div align=center><h3>Журнал рентген-снимков <?=DateTimeParseToDtTm(date('Y-m-d H:i:s'))?></h3></div>
    <div class="navbar">

	    <div class="btnbar">
		<input type=button class="btn" id="add-form-btn" value="Добавить">
		<!--input type=button class="btn" id="give-jurnal-btn" value="Распространить"-->
		<?if($level>7){?>
		<input type=button class="btn" id="del-task-btn" value="Удалить">
		<?}?>
	    </div>
    </div>

    <div class="list">  
		<form id=deltaskform name=deltaskform>		    
	    <?
	$suser;
	$sgroup;
	$sort;
	$cnt_str;
	$sdate;
	$edate;$stip;
	if(!$cnt_str) $cnt_str = 50;

        if($_GET['action'] == 'clear'){
		$_SESSION['sgroup'] = '';
		$_SESSION['suser'] = ''; 
		$_SESSION['semp'] = ''; $_SESSION['semp2'] = ''; 
		$_SESSION['stip'] = '';
		$_SESSION['cnt_str'] = '';
		$_SESSION['sort'] = '';
		$_SESSION['sdate'] = '';
		$_SESSION['edate'] = '';
		}

	if(!empty($_GET['sdate'])){
		$sdate = $_GET['sdate'];
	        $_SESSION['sdate'] = $_GET['sdate'];
	}else
	if(!empty($_SESSION['sdate'])){
                $sdate = $_SESSION['sdate'];
	}else{
                $_SESSION['sdate']=date("d.m.Y 00:00");
	}
        
	if(!empty($_GET['edate'])){
		$edate = $_GET['edate'];
	        $_SESSION['edate'] = $_GET['edate'];
	}else
	if(!empty($_SESSION['edate'])){
                $edate = $_SESSION['edate'];
	}else{
		$_SESSION['edate'] = date("d.m.Y 23:55");
	}
	
	if(!empty($_GET['suser'])){
		$suser = $_GET['suser'];
	        $_SESSION['suser'] = $suser;
		$sdate = '';$edate='';
	}else{
		$_SESSION['suser'] = '';
	}

	if(!empty($_GET['semp'])){
		$semp = $_GET['semp'];
	        $_SESSION['semp'] = $semp;
	}else{
		$_SESSION['semp'] = '';
	}

	if(!empty($_GET['semp2'])){
		$semp2 = $_GET['semp2'];
	        $_SESSION['semp2'] = $semp2;
	}else{
		$_SESSION['semp2'] = '';
	}

	if(!empty($_GET['stip'])){
		$stip = $_GET['stip'];
	        $_SESSION['stip'] = $stip;
	}else{
		$_SESSION['stip'] = '';
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

       	if(!empty($_GET['cnt_str'])){
		$cnt_str = $_GET['cnt_str'];
	        $_SESSION['cnt_str'] = $cnt_str;
	}else if(!empty($_SESSION['cnt_str'])){	
	        $cnt_str = $_SESSION['cnt_str'];
	}else{
		$cnt_str=50;
		$_SESSION['cnt_str'] = '';
	}

	
        $href = "/jurnal/jurnal.php?suser=".$suser."&sdate=".$sdate."&edate=".$edate."&stip=".$stip."&semp=".$semp."&semp2=".$semp2."&cnt_str=".$cnt_str."";

?>	
	<form method=GET action="list_users.php">
		<strong>Поиск</strong>
		дата: с <input type=text class=sdate name=sdate value="<? echo $sdate?>"> по <input type=text class=edate name=edate value="<? echo $edate?>">  <br />
		ФИО пациента <input type=text id=suser name=suser value="<? echo $suser?>">
		ФИО врача <input type=text id=semp name=semp value="<? echo $semp?>">
		ФИО лаборанта <input type=text id=semp2 name=semp2 value="<? echo $semp2?>">
		тип:  <select id=stip name=stip style="width:200px;">
			<option value=''>Выбрать тип
				<?
				$result_grow = mysql_query("SELECT id,name FROM spr WHERE cat_id = 3 ORDER BY name ASC;");
				$grow = mysql_fetch_array($result_grow);
				do{
				    echo "<option ".($grow['id']==$_SESSION['stip']?'selected':'')." value='". $grow['id'] ."'>". $grow['name'] ."</option>";
				}
				while($grow = mysql_fetch_array($result_grow));
				?>
			    </select>
		кол-во строк <input type=text class="cnt_str" name="cnt_str" style="width:35px" value="<? echo $cnt_str?>"><br />
		   <input type=submit class=btn value="Поиск">
		<input type=button class=btn value="Сброс" onclick="document.location.href='/jurnal/jurnal.php?action=clear&sgroup=&suser=&semp=&semp2=&stip=&sdate=&edate=&sort=<? echo $sort?>'">
	</form>
<?
        $spoint=""; 	$spoint2="";	$spoint3="";	
	$spoint4="";	$spoint5="";	$spoint6=""; $spoint7="";

	if($suser != "")
		$spoint = "AND (SELECT lower(Username) FROM users WHERE id = j.PID) LIKE lower('%".$suser."%')";

	if($semp != "")
		$spoint2 = "AND lower(u.Username) LIKE lower('%".$semp."%')";

	if($semp2 != "")
		$spoint7 = "AND lower(u2.Username) LIKE lower('%".$semp2."%')";

	if($sgroup != "")
		$spoint3 = "AND g.id = '".$sgroup."'";

	if($stip != "")
		$spoint6 = "AND j.spr_id = '".$stip."'";

        if($sdate != ""){
                $sdate1 = DateTimeParseBackToDtTm($sdate);
		//$sdate_ = "".$sdate_.":00";
		$spoint4 = "AND j.regdate >= '".$sdate1."'";
	        }
	if($edate != ""){
                $edate1 = DateTimeParseBackToDtTm($edate);
		//$edate_ = "".$edate_.":00";
		$spoint5 = "AND j.regdate <= '".$edate1."'";
	        }
     
	///////////////////////////////////////////////////////////////////////////////////
	$page;
	
	if(!$page || $page==0){$page=1;}

	    if(isset($_GET["page"])){
		$page = $_GET['page'];
	    }else if(isset($_POST["Page"])){
		$page = $_POST['Page'];
	    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////		        
?>
	<div align="center">
	<? 
	if($suser == ""){
		$term1 = "AND u2.login = '".$login."'";
		$term2 = "AND u.login = '".$login."'";
	}

  	$result_cnt = mysql_query("SELECT count(1) FROM jurnal j 
						JOIN users u ON u.id=j.EMP_ID
						JOIN groups g ON g.id=u.group_id 
						JOIN users u2 ON u2.id=j.EMP
						JOIN groups g2 ON g2.id=u2.group_id 
						LEFT JOIN ph_files ph on ph.mid=j.id 
					WHERE j.id>0 ".($level==5?$term1:'')." 
					".($level==7?$term2:'')." 
					".$spoint." ".$spoint2." ".$spoint4." ".$spoint5." ".$spoint6." ".$spoint7."" ) or die("Query failed ".mysql_error());
  	
	$allcnt = mysql_num_rows($result_cnt) ? mysql_result($result_cnt, 0) : '';

	$in_page = $cnt_str;
	$ltmp = $allcnt%$in_page;
        $pages = ceil($allcnt/$in_page);
        //$_SESSION['task_time'] = time();
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
	всего:<?=$allcnt?>
 	</div>

	<table class="list-tasks" id="ListTasks">	    

	    <tr align=center class=toptasks>
		<td>Номер</td>
	        <td>Дата/Время</td>
	        <td>Пациент (дата рожд.)</td>
	        <td>К врачу</td>
		<?if($level>7){?>
	        <td>Кто записал</td>
		<?}?>
		<td>Вид иссл-я</td>
		<td>Доза</td>
		<td>Снимок</td>
		<td>Кол-во</td><td>Комм-й(№ зуба)</td>
		<td>Все <input type="checkbox" value="checkbox" onchange="for(i in this.form.elements) this.form.elements[i].checked = checked"></td>
	    </tr>

	    <?
		$sql_select = "SELECT j.id,j.regdate,j.PID,j.dop,j.EMP,j.EMP_ID,j.spr_id,j.spr_id2,j.cnt_ph,u.spec
					FROM jurnal j 
						JOIN users u ON u.id=j.EMP
						JOIN groups g ON g.id=u.group_id 
						JOIN users u2 ON u2.id=j.EMP_ID
						JOIN groups g2 ON g2.id=u2.group_id 
					WHERE j.id>0 ".($level==5?$term1:'')." ".($level==7?$term2:'')." ".$spoint." ".$spoint2." ".$spoint4." ".$spoint5." ".$spoint6."  ".$spoint7." ORDER BY j.ID DESC LIMIT ".$start.", ".$in_page; 

		$result = mysql_query($sql_select) or die("Query failed ".mysql_error()); 
		$row = mysql_fetch_array($result);
		$i=1;
	
		$result_next = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME = 'jurnal';");
		$new_lid = mysql_num_rows($result_next) ? mysql_result($result_next, 0) : '';
	    
		if(mysql_num_rows($result)>0){
		
		    do{
			$lid = $row['id'];
		        $user = $row['PID'];
		        $emp = $row['EMP'];
		        $oper = $row['EMP_ID'];
		        $path = $row['path'];
		        $spec = $row['spec'];
		        $spr_id = $row['spr_id'];$spr_id2 = $row['spr_id2'];

		        $uname =  GetUserNameById($user);
			$birthdate =  GetBirthdateById($user);
		        $empname =  GetUserNameById($emp);
		        $rname =  GetUserNameById($oper);

			$spr_row = mysql_query("SELECT name FROM spr WHERE id = ".$spr_id.";");
			$sprname = mysql_num_rows($spr_row) ? mysql_result($spr_row, 0) : '';

			$spr_row2 = mysql_query("SELECT name FROM spr WHERE id = ".$spr_id2.";");
			$sprname2 = mysql_num_rows($spr_row2) ? mysql_result($spr_row2, 0) : '';
			
		        $dop = $row['dop'];
		        $gdt = DateTimeParseToDtTm($row['regdate']); 
			$birthdate = DateToDt($birthdate);

                        $regdate = $row['regdate'];
			$lgdt = date_parse_from_format("Y-m-d h:i:s", $regdate);
			$lday = $lgdt['day'];
			$lmon = $lgdt['month'];
			$lyear = $lgdt['year'];	

		    	echo "<tr align=center id='td-".$lid."' class=''>";
			    echo "<input type=hidden name=user_id id='tuser_id".$lid."' value='".$user."'>";
			    //echo "<td>".$lid."</td>";
			    echo "<td>".$i."</td>";
				echo "<td class='dt_".$lid."'>" . $gdt . "</td>";
				echo "<td class='dt_".$lid."'><b>" . $uname . "</b><br /><span style='font-size:12px'>".$birthdate."</span></td>";
				echo "<td class='dt_".$lid."'>" . $empname . " <br /><span style='font-size:12px'>" . $spec . "</span></td>";
				if($level>7){
					echo "<td class='dt_".$lid."'>" . $rname . "</td>";
				}
				echo "<td class='dt_".$lid."'>" . $sprname . "</td>";
				echo "<td class='dt_".$lid."'>" . $sprname2 . "</td>";
				
				echo "<td>";
					$result_ph = mysql_query("SELECT id,path FROM ph_files WHERE mid = ".$lid." ORDER BY name ASC;");
					$row_ph = mysql_fetch_array($result_ph);
					if(mysql_num_rows($result_ph)>0){
					do{
						$lpath = $row_ph['path'];
						$lpid = $row_ph['id'];
						$upload_path = "uploads/";
					    //echo "<img height=40 src=\"uploads/".$row_ph['path']."\">";
						echo "<a class=\"group3 eimg\" href=\"".$upload_path.$lyear."/".$lmon."/".$lday."/".$lpath."\">
								<img id=\"img".$lpid."\" height=40 src=\"".$upload_path.$lyear."/".$lmon."/".$lday."/sm/".$lpath."\"></a>";
						if($level>3){
					?>
						
					      	<br /><br /><img width=20 src="/images/print2.png" onClick="javascript:CallPrint<?=$lpid?>('print-content');">
                                	     	<script type="text/javascript">
			                        function CallPrint<?=$lpid?>(strid) {
 							 //var prtContent = document.getElementById('img<?=$lpid?>');
							  var WinPrint = window.open('','','left=50,top=50,width=800,height=600,toolbar=0,scrollbars=1,status=0');
								  WinPrint.document.write('');
								  //WinPrint.document.write(prtContent.innerHTML);
								<?if($spr_id==4){?>
								  	WinPrint.document.write('<img id="img<?=$lpid?>" width=100% src="<?=$upload_path?><?=$lyear?>/<?=$lmon?>/<?=$lday?>/<?=$lpath?>">');
								<?}else{?>
									WinPrint.document.write('<img id="img<?=$lpid?>" width=30% src="<?=$upload_path?><?=$lyear?>/<?=$lmon?>/<?=$lday?>/<?=$lpath?>">');
								<?}?>
								        WinPrint.document.write('<br /><br /><b>Информация о пациенте:</b><br />');
				
									WinPrint.document.write('ФИО:<b><?=$uname?></b><br />');
									WinPrint.document.write('Дата рожд.:<b><?=$birthdate?></b><br />');
									WinPrint.document.write('Дата иссл.:<b><?=$gdt?></b><br />');
									WinPrint.document.write('Комм-й(№зуба):<b><?=$dop?></b><br />');
									WinPrint.document.close();
								  WinPrint.focus();
								  WinPrint.print();
								   prtContent.innerHTML=strOldOne;
							}
						</script>
						<?}
					}
					while($row_ph = mysql_fetch_array($result_ph));
					}
				echo "</td>";
				echo "<td class='dt_".$lid."'>" . mysql_num_rows($result_ph) . "</td>";
				echo "<td class='dt_".$lid."'>" . $dop . "</td>";
				
				echo "<td align=center>";
				    echo "<img width=20 class=\"edit-click\" id=\"" .$lid. "\" src=\"/images/edit.png\">";
		    		echo "<span id=\"tdd-" .$lid. "\">";
		    		//include "edit-form.php";
		    		echo "</span>"; ?>
				    <script>
					$("#<?=$lid?>").click(function(){
        				   $.arcticmodal({
            					type: 'ajax',
		                			url: '/jurnal/edit-form.php',
            						ajax: {
                					type: 'POST',
                					    data: {
								new_id:'<?=$lid?>',
							    }
            						}
        				    });
    					});
				    </script>
			        <?
				echo "<span style='display:none'></span>";
			    echo "</td>";
			    echo "<td align=center>";
			    	echo "<input type=checkbox class=checkbox name=did id=did value=\"".$lid."\">";
			    echo "</td>";
			echo "</tr>";
			$i++;
		    }
		    while($row = mysql_fetch_array($result));
	    }
	?></form>
	</table>
	<?
	    include 'add-form.php';
    ?>
    </div>
<style>
	.eimg img{
		margin:3px;
		padding:4px;
	}
	input[type=text],
	select{
		padding:5px;font-size:14px;
		border-radius:5px;
	}
</style>
    <?
	}  
}else{
	include "../login.php";
}

include "../footer.php"; ?>