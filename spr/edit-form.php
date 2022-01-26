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
	        $sql_select = "SELECT name,dop,cat_id,uet FROM spr WHERE id = ".$lid."";
	        $row = mysql_query($sql_select) or die("Query failed ".$lid." ".mysql_error());
		$name = mysql_result($row,0,'name');
		$cat_id = mysql_result($row,0,'cat_id');
		$dop = mysql_result($row,0,'dop');
		$uet = mysql_result($row,0,'uet');

		    $result_c = mysql_query("SELECT name FROM spr WHERE id=".$cat_id."");
	    	    $cat_name = mysql_num_rows($result_c) ? mysql_result($result_c, 0) : '';
	    ?>
	<div style="background:#fefefe;width:100%;min-width:600px;padding:10px;" class="div_zform">
		<?=$cat_name?>
	    <form id="e-user-form" action="save-user.php" data-form="ajax">
		<input type=hidden id=cat_id value=<?=$cat_id?> />
    	    <div class=hor2>

		<div class=div>  Название: <input type="text" id="nname" name="nname" class="n_name" style='width:400px;' value='<? echo $name?>' />
		</div>
		<?if(($level>3){?>
		    <div style="clear:both;"></div>
		    <!--input type="text" id="n_uet" name="n_uet" class="n_uet" style='width:80px;' /-->
		    УЕТ: <input type=number id="uet" step='0.01' value="<?=$uet?>"/>
		<?}?>

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