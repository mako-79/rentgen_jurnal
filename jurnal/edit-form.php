<?php 
include("../base.php");
include("header.php");
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
	$login = $_SESSION['Login'];	
	require "../sub/functions.php";
	$level = GetLvlByLogin($login);
    if($level>3){
///////////////////////////////////////////////////////////
	if(isset($_POST['new_id'])){
		$new_id = $_POST['new_id'];
		$lid = $new_id;
	        $sql_select = "SELECT j.regdate,j.PID,j.dop,ph.path,j.EMP,j.EMP_ID,j.spr_id,j.spr_id2,j.cnt_ph FROM jurnal j LEFT JOIN ph_files ph on ph.mid=j.id WHERE j.id = ".$lid."";
	        $row = mysql_query($sql_select) or die("Query failed ".$lid." ".mysql_error());
		$regdate = mysql_result($row,0,'regdate');
		$lpat_id = mysql_result($row,0,'PID');
		$lemp_id = mysql_result($row,0,'EMP');
		$luser_id = mysql_result($row,0,'EMP_ID');
		$lspr_id = mysql_result($row,0,'spr_id');
		$lspr_id2 = mysql_result($row,0,'spr_id2');
		$cnt_ph = mysql_result($row,0,'cnt_ph');
		$dop = mysql_result($row,0,'dop');
			$lgdt = date_parse_from_format("Y-m-d h:i:s", $regdate);
			$lday = $lgdt['day'];
			$lmon = $lgdt['month'];
			$lyear = $lgdt['year'];	

	    ?>
	<div style="background:#fefefe;width:100%;min-width:600px;padding:10px;" class="div_zform">

	    <form id="save-task-form" action="save-task.php" data-form="ajax">

    	    <div class=hor2>
		<div class=div>
		    Дата: <input maxlength=20 type=text class=date id=regdt value="<?=DateTimeParseToDtTm($regdate);?>" style='width:130px;' />
		    <span id=err_4></span>
		</div>

		<div class=div>Пациент:
			<strong><?
			$result_prow = mysql_query("SELECT case when a.Username is null then a.surname else a.Username end FROM users as a,groups as b WHERE a.id = ".$lpat_id." ORDER BY b.gname ASC") or die("Query failed ".mysql_error());
			$username = mysql_num_rows($result_prow) ? mysql_result($result_prow, 0) : '';
			$result_prow2 = mysql_query("SELECT a.id FROM users as a,groups as b WHERE a.id = ".$lpat_id." ORDER BY b.gname ASC") or die("Query failed ".mysql_error());
			$userid = mysql_num_rows($result_prow2) ? mysql_result($result_prow2, 0) : '';
			//echo "".$username;
			?>

                        <input type="text" id="s_user2" name="s_user" class="n_name" value="<?=$username?>" style='width:400px;' />

			</strong>
			<input type="hidden" id="id_user2" value="<?=userid?>"/>
		</div>
		<div style="clear:both;"></div>
		<div class=div>Врач: <strong>
			<?
			$result_vrow = mysql_query("SELECT a.Username FROM users as a,groups as b WHERE a.id = '".$lemp_id."' ORDER BY b.gname ASC") or die("Query failed ".mysql_error());
			$vname = mysql_num_rows($result_vrow) ? mysql_result($result_vrow, 0) : '';
			echo "".$vname;
			?> </strong>
		</div>
		<div style="clear:both;"></div>
		<?if($level>7){?>
		<div class=div>Кто записал: <strong>
			<?
			$result_urow = mysql_query("SELECT a.Username FROM users as a,groups as b WHERE a.id = '".$luser_id."' ORDER BY b.gname ASC") or die("Query failed ".mysql_error());
			$uname = mysql_num_rows($result_urow) ? mysql_result($result_urow, 0) : '';
			echo "".$uname;
			?> </strong>
		</div>
		<div style="clear:both;"></div>
		<?}?>
		<div class=div>
			<?$result_ph = mysql_query("SELECT id,path FROM ph_files WHERE mid = ".$lid." ORDER BY name ASC;");
				$row_ph = mysql_fetch_array($result_ph);
				if(mysql_num_rows($result_ph)>0){
				do{
					$path = $row_ph['path'];
					$img_id = $row_ph['id'];
				   //echo "<img height=40 src=\"uploads/".$row_ph['path']."\">";
					echo "<div class=\"eimg\" id=\"img".$img_id."\"><a class=\"group4\" href=\"uploads/".$lyear."/".$lmon."/".$lday."/".$path."\"><img height=50 src=\"uploads/".$lyear."/".$lmon."/".$lday."/sm/".$path."\"></a><span id=".$img_id." class='x del_ph'>x</span></div>";
				}
				while($row_ph = mysql_fetch_array($result_ph));
				}
			?>
			<div style="clear:both;"></div>
    			<textarea id="pasteArea2" placeholder="Paste Image Here"></textarea>
			<img width=100 id="pastedImage2-1"></img>
			<img width=100 id="pastedImage2-2"></img>
			<img width=100 id="pastedImage2-3"></img>
			<img width=100 id="pastedImage2-4"></img>
			<img width=100 id="pastedImage2-5"></img>
		</div>
                <div style="clear:both;"></div>

		<div class=div>Вид рентгенологического исследования: <strong>
			<?
			$result_urow = mysql_query("SELECT a.name FROM spr a WHERE a.id = '".$lspr_id."'") or die("Query failed ".mysql_error());
			$sprname = mysql_num_rows($result_urow) ? mysql_result($result_urow, 0) : '';
			//echo "".$sprname;
				
			?> </strong>
			<select name=proc id=proc style="width:150px;">
				<option selected value=''>Выбрать:</option>
				<?
				$result_grow = mysql_query("SELECT id,name FROM spr WHERE cat_id = 3 ORDER BY name ASC;");
				$grow = mysql_fetch_array($result_grow);
				do{
				    echo "<option ".($grow['id']==$lspr_id?'selected':'')." value='". $grow['id'] ."'>". $grow['name'] ."</option>";
				}
				while($grow = mysql_fetch_array($result_grow));
				?>
			    </select>
		</div>
		<div style="clear:both;"></div>
		<div class=div style='display:none'>  Кол-во снимков: <input type="text" id="ph" value="<?=mysql_num_rows($result_ph)?>" style='width:100px;' /></div>
                <div style="clear:both;display:none"></div>
                <div class=div>Доза облучения: <strong>
			<?
			$result_urow = mysql_query("SELECT a.name FROM spr a WHERE a.id = '".$lspr_id2."'") or die("Query failed ".mysql_error());
			$sprname = mysql_num_rows($result_urow) ? mysql_result($result_urow, 0) : '';
			//echo "".$sprname;
				
			?> </strong>
			<select name=doza id=doza style="width:150px;">
				<option selected value=''>Выбрать:</option>
				<?
				$result_grow = mysql_query("SELECT id,name FROM spr WHERE cat_id = 17 ORDER BY name ASC;");
				$grow = mysql_fetch_array($result_grow);
				do{
				    echo "<option ".($grow['id']==$lspr_id2?'selected':'')." value='". $grow['id'] ."'>". $grow['name'] ."</option>";
				}
				while($grow = mysql_fetch_array($result_grow));
				?>
			    </select>
		</div>
		
		<div class=div2>
		    Комментарий (№ зуба):
		    <br><textarea placeholder="Комментарий (№ зуба)" style="width:98%;height:50px;" type=text id=dop name=dop value='<? echo $dop?>'><? echo $dop?></textarea>
		</div>

	    </div>	
	    <div style="clear:both;"></div>
	    <div>
		<input type=button class="save-task-btn" id="<? echo $lid?>" value='OK'>
		<input type=button id="e_modal_reject" value='Отмена'>
	    </div>	
	</form>
	</div>
	<script>
                $(document).ready(function(){
	    	var ac_config2 = {
		        source:'users.php',
        		select: function(event, ui) { 
			    $('#id_user2').val(ui.item.value); 
        			event.preventDefault(); 
		    	    $("#s_user2").val(ui.item.label); 
		    	},    
		        minLength:2
		    };
		    $("#s_user2").autocomplete(ac_config2);
		});
	</script>
    <style>
        .hor .leftdiv{ 
        	float:left;
		width:250px;
	}
	.hor2 .div{ 
		padding:5px;
		margin:5px 2px;
		width:98%;
		border:1px solid #999;
	}
	.eimg{
		position:relative;
		float:left;
		padding:3px;
	}

	.eimg .x{
	       position:absolute;
		width:5px;
		height:5px;
		top:-5px;
		right:-3px;
		z-index:2;
		padding:5px;
		line-height:0.3;
		border:1px solid #cc0000;
		border-radius:20px;
		font-size:10px;
		color:#cc0000;
		background:#fefefe;
		cursor:point;
	}

	.eimg img{
		margin:3px;
		padding:4px;
	}
	
	</style>
<?	}
    }
}
?>