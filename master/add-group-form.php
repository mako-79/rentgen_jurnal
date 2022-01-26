<?php include "../base.php";

?>
<div id="add_modal_form">
    <input type=button id="add_modal_close" value=x>
	<form method=POST id="add-group-form" action='add-group.php'>
	    <input type=hidden id=n_id value="<?echo $new_lid?>">
	    <div>
		<div>
		    Наименование*:
		    <br><input maxlength=150 type=text id=n_name name=n_name style='width:200px;'>
		    <span id=err_1></span>
		</div>
		<div>
		    Уровень*:
		    <br><select id=n_level name=n_level>
			    <option value=9>Руководство
			    <option value=7>Врачи
			    <option value=5>Операторы
			    <option value=3>Пользователи
		    </select>
		    <span id=err_1></span>
		</div>
		<input type=button id="add-group-btn" value='OK'>
		<input type=button id="add_modal_reject" value='Отмена'>
	    </div>	
	</form>
</div>
<div id="add_modal_overlay"></div>
