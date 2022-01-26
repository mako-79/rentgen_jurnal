<?php include ("../base.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
    $login = $_SESSION['Login'];
    
    $level = GetLvlByLogin($login);
    $luid = GetUserIdByLogin($login);
    $lname = GetUserNameById($luid);
    
    if($level>3){?>
    
    <div id="add_modal_form">
	<input type=button id="add_modal_close" value=x>
	
	<form method=POST id="add-task-form" action='add-task.php'>
	    <input type=hidden id=n_id value=<?echo $new_lid?>>
	
	    <div class="add_form_div">
		<div class=div>
		    Дата: <input maxlength=20 type=text class=date id=n_dt name=n_dt value="<?=date("d.m.Y H:i");?>" style='width:200px;'>
		</div><div style="clear:both;"></div>
		<div class=div>  ФИО: <input type="text" id="s_user" name="s_user" class="n_name" style='width:400px;' />
				    <input type="hidden" id="id_user" name="id_user" />
		</div>
	    	<div style="clear:both;"></div>
	    	<div class=div>  Врач: <input type="text" id="s_emp" name="s_emp" class="n_emp" value="<? if($level==7){ echo $lname; }?>" style='width:400px;' />
				    <input type="hidden" id="id_emp" name="id_emp" value="<? if($level==7){ echo $luid; } ?>" />
		</div>
                <div style="clear:both;"></div>
		<div class=div>  Процедура
			    <select name=n_procedura id=n_procedura style="width:150px;">
				<option selected value=''>Выбрать:</option>
				<?
				$result_grow = mysql_query("SELECT id,name FROM spr WHERE cat_id = 2 ORDER BY name ASC;");
				$grow = mysql_fetch_array($result_grow);
				do{
				    echo "<option value='". $grow['id'] ."'>". $grow['name'] ."</option>";
				}
				while($grow = mysql_fetch_array($result_grow));
				?>
			    </select>
			<!--form enctype="multipart/form-data" action="messfile_upload.php" method="POST">
    				<input type="hidden" name="MAX_FILE_SIZE" value="550000000" />
    				прирепить файл <input type="file" name="upfiles" id="upfiles" />
			</form-->
		</div>
                <div style="clear:both;"></div>
		<div class=div>  № процедуры: <input type="text" id="cnt_proc" name="cnt_proc"  style='width:100px;' /></div>
                <div style="clear:both;"></div>
		<div class="div2">
		    Комментарий:
		    <br><textarea placeholder="Текст задания" style="width:300px;height:100px;" type=text id=n_dop name=n_dop></textarea>
			<br>
		</div>
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
	.div_sel_users{
		width:100%;
		height:100px;
		position:relative;
		overflow:auto;	
	}
	.div_sel_user{
		padding:2px;
		margin:1px;
		float:left;
		border:1px solid #898989;
	}
	.add_form_div .div{
		float:left; padding:5px; margin:3px;
	}
	.add_form_div .div select{
		max-width:200px; padding:5px; margin:3px;
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