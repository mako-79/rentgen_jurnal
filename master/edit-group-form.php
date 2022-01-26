<?php 
    include "../base.php";
?>
<div id=e_modal_form<? echo $lid ?>>
    <input type=button id="e_modal_close" value=x>
	<form id="e-user-form">
	    <input type=hidden name=group_id id=group_id<? echo $lid ?> value='<? echo $lid ?>'>
	    <div>
		<div>
		    Наименование*:
		    <br><input maxlength=150 type=text id=name<? echo $lid ?> name=name value='<?=$row["gname"]?>' style='width:200px;'>
		    <span id=err_1></span>
		</div>
		<br>
		<div>
                    Уровень*:
		    <br><select id=level<? echo $lid ?>>
				<option <?if($row['level'] == 9){ echo "selected";}?> value=9>Руководство
			    <option <?if($row['level'] == 7){ echo "selected";}?> value=7>Врачи=	
			    <option <?if($row['level'] == 5){ echo "selected";}?> value=5>Операторы
			    <option <?if($row['level'] == 3){ echo "selected";}?> value=3>Пользователи	
                            <option <?if($row['level'] == 1){ echo "selected";}?> value=1>Гости
		    </select>
		    <span id=err_1></span>
		</div>
		<br>
		<br>
	    </div>
	    <div>
		<input type=button class="save-group-btn" id="<? echo $lid?>" value='OK'>
		<input type=button id="e_modal_reject" value='Отмена'>
	    </div>	
	</form>
</div>
<div id="e_modal_overlay<? echo $lid ?>"></div>