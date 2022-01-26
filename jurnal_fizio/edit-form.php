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
	        $sql_select = "SELECT j.regdate,j.PID,j.dop,j.EMP,j.EMP_ID,j.spr_id,j.cnt_proc,j.lech,j.giglech FROM jurnal_fizio j WHERE j.id = ".$lid."";
	        $row = mysql_query($sql_select) or die("Query failed ".$lid." ".mysql_error());
		$regdate = mysql_result($row,0,'regdate');
		$lpat_id = mysql_result($row,0,'PID');
		$lemp_id = mysql_result($row,0,'EMP');
		$luser_id = mysql_result($row,0,'EMP_ID');
		$lspr_id = mysql_result($row,0,'spr_id');
		$cnt_proc = mysql_result($row,0,'cnt_proc');
		$lech = mysql_result($row,0,'lech');
		$giglech = mysql_result($row,0,'giglech');
		$dop = mysql_result($row,0,'dop');
	    ?>
	<div style="background:#fefefe;width:100%;min-width:600px;padding:10px;" class="div_zform">
	    <form id="e-user-form" action="save-user.php" data-form="ajax">
    	    <div class=hor2>
		<div class=div>
		    Дата: <input maxlength=20 type=text class=date id=dt name=dt value="<?=DateTimeParseToDtTm($regdate);?>" style='width:130px;' />
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
		<div class=div>Врач:
			<?
			$result_vrow = mysql_query("SELECT a.id,a.Username FROM users as a,groups as b WHERE a.id = '".$lemp_id."' ORDER BY b.gname ASC") or die("Query failed ".mysql_error());
			$vname = mysql_result($result_vrow, 0,'Username');
			$vid = mysql_result($result_vrow, 0,'id');
			echo "".$vname;
			?>
			<!--input type="text" id="s_emp2" name="s_emp2" class="emp" value="<? echo $vname; ?>" style='width:400px;' />
				    <input type="hidden" id="id_emp2" name="id_emp" value="<? echo $vid;  ?>" /-->
		</div>
		<div style="clear:both;"></div>
		<div class=div>Кто записал: 
			<?
			$result_urow = mysql_query("SELECT a.Username FROM users as a,groups as b WHERE a.id = '".$luser_id."' ORDER BY b.gname ASC") or die("Query failed ".mysql_error());
			$uname = mysql_num_rows($result_urow) ? mysql_result($result_urow, 0) : '';
			echo "".$uname;
			
			?>
		</div>
		<div style="clear:both;"></div>
		<div class=div>Процедура: <strong>
			<?
			$result_urow = mysql_query("SELECT a.name FROM spr a WHERE a.id = '".$lspr_id."'") or die("Query failed ".mysql_error());
			$sprname = mysql_num_rows($result_urow) ? mysql_result($result_urow, 0) : '';
			//echo "".$sprname;
				
			?> </strong>
			<select name=procedura id=procedura style="width:150px;">
				<option selected value=''>Выбрать:</option>
				<?
				$result_grow = mysql_query("SELECT id,name FROM spr WHERE cat_id = 2 ORDER BY name ASC;");
				$grow = mysql_fetch_array($result_grow);
				do{
				    echo "<option ".($grow['id']==$lspr_id?'selected':'')." value='". $grow['id'] ."'>". $grow['name'] ."</option>";
				}
				while($grow = mysql_fetch_array($result_grow));
				?>
			    </select>
		</div>
		<div style="clear:both;"></div>
		<div class=div>  № процедуры: <input type="text" id="cnt_pr" name="cnt_pr" value="<? echo $cnt_proc?>" style='width:100px;' /></div>
                <div style="clear:both;"></div>
		<div class=div2>
		    Комментарий:
		    <br><textarea placeholder="Комментарий" style="width:98%;height:50px;" type=text id=dop name=dop value='<? echo $dop?>'><? echo $dop?></textarea>
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
	</style>
<?	}
    }
}
?>