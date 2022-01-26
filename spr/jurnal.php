<?php include "../header.php"; ?>

<?if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {

	$login = $_SESSION['Login'];	
	$level = GetLvlByLogin($login);
	$uid = GetUserIdByLogin($login);
	include "../task_menu.php"; 
	
    if($level>3){
    	$cat_id = 0;
    	$cat_name;
	    if (isset($_GET['cat_id'])){
	        $cat_id = $_GET['cat_id'];
	    	    $result_c = mysql_query("SELECT name FROM spr WHERE id=".$cat_id."");
	    	    $cat_name = mysql_num_rows($result_c) ? mysql_result($result_c, 0) : '';
	    }
    ?>
    <script type="text/javascript" src="/spr/js/jurnal.js"></script>
    
    <div align=center><h4><?=($cat_name != ''?' <a href=\'/spr/jurnal.php\'>назад в Справочники >> </a>':'')?> Справочник<?=($cat_name != ''?' '.$cat_name:'и')?> </h4></div>
    <div class="navbar">
	    <div class="btnbar">
		<input type=button class="btn" id="add-form-btn" value="Добавить">
		<?if($level>7){?>
		<input type=button class="btn" id="del-task-btn" value="Удалить">
		<?}?>
	    </div>
    </div>
    <div class="list">
      
	<table class="list-tasks" id="ListTasks">
		<form id=deltaskform name=deltaskform>	
	    <?
	    $suser;
	    $sdate;
	    $edate;
	    $stype;
	    $cnt_str;
		$spoint="";
		$spoint2="";
	        $href = "spr/jurnal.php?suser=".$suser."&sdate=".$sdate."&edate=".$edate."&stype=".$stype."&cnt_str=".$cnt_str."";
	    ?>
	    <tr align=center class=toptasks>
		<td>№ п/п</td><td>Название</td><td></td><td></td>
		<td>Все <input type="checkbox" value="checkbox" onchange="for(i in this.form.elements) this.form.elements[i].checked = checked"></td>
	    </tr>

	    <?
	$sql_select;

	//if($level>7){		
		//$term = "AND g.level = ".$level."";
		//$term2 = "AND g2.level = ".$level."";
		
	        $sql_select = "SELECT id,name,dop,cat_id,uet FROM spr WHERE id>0 and cat_id=".$cat_id." ORDER BY id;"; 
	//}else
		$result = mysql_query($sql_select) or die("Query failed ".mysql_error()); 
		$row = mysql_fetch_array($result);
		$i=1;
		
		$result_next = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME = 'spr';");
		$new_lid = mysql_result($result_next,0,'AUTO_INCREMENT');
	    
		if(mysql_num_rows($result)>0){
		
		    do{
			$lid = $row['id'];
		        $name = $row['name'];
		        $dop = $row['dop'];
			$uet = $row['uet'];
			$cat_id = $row['cat_id'];
		        $lhref = "spr/jurnal.php";

                        $result_sub = mysql_query("SELECT cat_id FROM spr WHERE id=".$cat_id.";");
			$pre_cat_id = mysql_result($result_sub,0,'cat_id');
			
		    	echo "<tr align=center id='td-".$lid."' class=''>";
			    echo "<td>".$lid."</td>";

			if($pre_cat_id>0){
			    echo "<td align=left class='dt_".$lid."'>" . $name . "</td>";
			}else{
                              echo "<td align=left class='dt_".$lid."'><a href=\"/".$lhref."/?cat_id=".$lid."\">" . $name . "</a></td>";
			}

			if($cat_id==2 || $cat_id==325 || $cat_id==3){
                                 echo "<td class='dt_".$lid."'>" . $uet . "</td>";
			}
			    echo "<td class='dt_".$lid."'>" . $dop . "</td>";	
			    echo "<td align=center>";
				    echo "<img width=20 class=\"edit-click\" id=\"" .$lid. "\" src=\"/images/edit.png\">";
		    ?>
			    <script>
					$("#<?=$lid?>").click(function(){
        				   $.arcticmodal({
            					type: 'ajax',
		                			url: '/spr/edit-form.php',
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
			    <td align=center>
				<input type=checkbox class=checkbox name=did id=did value="<?=$lid?>">
			    </td>
			</tr>
			<?
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
    <?
    } 
}
include "../footer.php"; ?>