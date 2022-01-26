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
		</div>
		<div style="clear:both;"></div>
		<div class=div id="show_o">  ФИО: <input type="text" id="s_user" name="s_user" class="n_name" style='width:400px;' />
				    <input type="hidden" id="id_user" name="id_user" />
		</div>
		<div class=div>Новый  <input type="checkbox" id="new_pat" /></div>  
		<div style="clear:both;"></div>

		<div style="display:none;background:#eee;" id="show_n">
			<?
                        $result_next = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_NAME = 'users';");
			$new_pat = mysql_num_rows($result_next) ? mysql_result($result_next, 0) : '';
			?>
			<input type="hidden" id="id_nuser" name="id_nuser" value="<?=$new_pat?>"/>
                      	<div class=div style="width:120px;">Фамилия:</div>
			<div class=div> <input type="text" id="n_fname" name="n_fname" class="n_name" style='width:300px;' /></div>
			<div style="clear:both;"></div>

			<div class=div style="width:120px;">Имя:</div> 
			<div class=div><input type="text" id="n_name" name="n_name" class="n_name" style='width:300px;' /></div>
			<div style="clear:both;"></div>

			<div class=div style="width:120px;">Отчество:</div> 
			<div class=div><input type="text" id="n_sname" name="n_sname" class="n_name" style='width:300px;' /></div>
			<div style="clear:both;"></div>

		        <div class=div style="width:120px;">Дата рождения:</div>
			<div class=div><input maxlength=20 type=text class=bdt id=n_bdt name=n_bdt autocomplete="off" style='width:130px;'></div>

			<div class=div style="width:120px;">Телефон:</div>
			<div class=div><input maxlength=300 type=text id=n_phone name=n_phone style='width:210px;'></div>

		</div>
		
	    	<div style="clear:both;"></div>
	    	<div class=div>  Врач: <input type="text" id="s_emp" name="s_emp" class="n_emp" value="<? if($level==7){ echo $lname; }?>" style='width:400px;' />
				    <input type="hidden" id="id_emp" name="id_emp" value="<? if($level==7){ echo $luid; } ?>" />
		</div>
                <div style="clear:both;"></div>
		<div class=div>
			<!--form enctype="multipart/form-data" action="messfile_upload.php" method="POST"-->
    				<!--input type="hidden" name="MAX_FILE_SIZE" value="550000000" />
    				прирепить файл <input type="file" name="upfiles" id="upfiles" /-->
			<textarea id="pasteArea" placeholder="Paste Image Here"></textarea>
			<img width=100 id="pastedImage"></img>
				<!--input type="file" name="upfiles" id="upfiles" style="display:none;"/-->
    				<!--div style="width: 200px; height: 40px; background: grey" id="pasteTarget">Вставить фото</div-->
			<!--/form-->
		</div>
                <div style="clear:both;"></div>
		<div class=div>  Вид рентгенологического исследования
			    <select name=n_proc id=n_proc style="width:150px;">
				<option selected value=''>Выбрать:</option>
				<?
				$result_grow = mysql_query("SELECT id,name FROM spr WHERE cat_id = 3 ORDER BY name ASC;");
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
		<!--div class=div>  Кол-во снимков: <input type="hidden" id="cnt_ph" name="cnt_ph"  style='width:100px;' /></div>
                <div style="clear:both;"></div-->

		<div class=div>  Доза облучения
			    <select name=n_doza id=n_doza style="width:150px;">
				<option selected value=''>Выбрать:</option>
				<?
				$result_grow = mysql_query("SELECT id,name FROM spr WHERE cat_id = 17 ORDER BY name ASC;");
				$grow = mysql_fetch_array($result_grow);
				do{
				    echo "<option value='". $grow['id'] ."'>". $grow['name'] ."</option>";
				}
				while($grow = mysql_fetch_array($result_grow));
				?>
			    </select>
		</div>
                <div style="clear:both;"></div>

		<div class="div2">
		    Комментарий:
		    <br><textarea placeholder="Комментарий (№ зуба)" style="width:300px;height:100px;" type=text id=n_dop name=n_dop></textarea>
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
		max-width:200px;
	}
	.add_form_div .div2{
		width:47%;
		padding:5px;
		float:left;
	}
    </style>
<script>
$('#new_pat').change(function(){
        if (this.checked) {
		$('#show_n').fadeIn('slow');
		$('#show_o').fadeOut('slow');
        }else {
		$('#show_o').fadeIn('slow');
            	$('#show_n').fadeOut('slow');
        }                   
    });
</script>

    <?
    }
}
?>