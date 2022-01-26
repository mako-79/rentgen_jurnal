<?php include ("../base.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
    $login = $_SESSION['Login'];
    
    $level = GetLvlByLogin($login);
    $luid = GetUserIdByLogin($login);
    $lname = GetUserNameById($luid);
    
    if($level>3){
	//$cat_id=0;
	if (isset($_GET['cat_id'])) {
	    $cat_id = $_GET['cat_id'];
	}else{
	    $cat_id=0;
	}
    ?>
    
    <div id="add_modal_form">
	<input type=button id="add_modal_close" value=x>
	
	<form method=POST id="add-task-form" action='add-task.php'>
	    <input type=hidden id=n_id value=<?=$new_lid?> />
	    <input type=hidden id=n_cat_id value=<?=$cat_id?> />
	
	    <div class="add_form_div">
		
		<div class=div>  Название: <input type="text" id="n_name" name="n_name" class="n_name" style='width:400px;' /></div>
	        <div style="clear:both;"></div>
		<div class="div2">
		    Текст:
		    <br><textarea placeholder="Текст задания" style="width:300px;height:100px;" type=text id=n_dop name=n_dop></textarea>
			<br>
		</div>
		<?if($level>7){?>
		    <div style="clear:both;"></div>
		    <!--input type="text" id="n_uet" name="n_uet" class="n_uet" style='width:80px;' /-->
		    УЕТ: <input type=number id="n_uet" step=0.01 />
		<?}?>
	    </div>	
	    <div style="clear:both;"></div>
	    
	    <div align=center>
	        	<input type=button id="add-task-btn" value='OK'>
			<input type=button id="add_modal_reject" value='Отмена'>
	    </div>	
	
	    </form>
    </div>
    
    <div id="add_modal_overlay"></div>
<style>
	.add_form_div .div{
		float:left; padding:5px; margin:3px;
	}
	.add_form_div .div select{
		max-width:200px;
	}
	.add_form_div .div2{
		width:47%;
		padding:5px;
		float:left;
	}
    </style>
    <?
    }
}
?>