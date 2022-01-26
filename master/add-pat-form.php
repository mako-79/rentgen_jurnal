<?php include "../base.php";?>
<div id="add_modal_form">
    <input type=button id="add_modal_close" value=x>
	<form method=POST id="add-user-form" action='add-user.php'>
	    <input type=hidden id=n_id value="<?echo $new_lid?>">
	    <div>
		<div class="hor">
        		<div>
			    Логин*:
			    <br><input maxlength=150 type=text id=n_login name=n_login style='width:200px;'>
			    <span id=err_1></span>
			</div>
			<div>
			    ФИО*:
			    <br><input maxlength=150 type=text id=n_fio name=n_fio style='width:400px;'>
			    <span id=err_2></span>
			</div>
		</div>
		<!--div>
		    Email*:
		    <br><input maxlength=150 type=text id=n_email name=n_email style='width:300px;'>
		    <span id=err_2></span>
		</div-->
		<div class="hor">
			<div>Группа<br>
			    <select id=n_group_id>
			<?
			$sql_select_grow = "SELECT id,gname,level FROM groups ORDER BY gname ASC";
			$result_grow = mysql_query($sql_select_grow);
			$grow = mysql_fetch_array($result_grow);
			do{
			    echo "<option value='". $grow['id'] ."'>". $grow['gname'] ."</option>";
			}
			    while($grow = mysql_fetch_array($result_grow));
			?>
			    </select>
			</div>
			<div>
			    Пароль*:
			    <br><input maxlength=50 type=text id=n_pass name=n_pass style='width:300px;'>
			    <span id=err_3></span>
			</div>
			<div>
			    Подтвердить пароль*:
			    <br><input maxlength=50 type=text id=n_repass name=n_repass style='width:300px;'>
			    <span id=err_4></span>
			</div>
		</div>
		<div class="hor">
			<div>
			    Дата рождения:
			    <br><input maxlength=20 type=text class=bdt id=n_bdt name=n_bdt style='width:130px;'>
			</div>
		</div>
		<div>
		    Телефон:
		    <br><input maxlength=300 type=text id=n_phone name=n_phone style='width:210px;'>
		 	<br>
		</div>
	    </div>		
	    <div>
		<input type=button id="add-user-btn" value='OK'>
		<input type=button id="add_modal_reject" value='Отмена'>
	    </div>	
	</form>
</div>
<div id="add_modal_overlay"></div>
<style>
.hor div{ 
	display:inline-grid;width:300px;
}
select{
	padding:3px;
}
</style>