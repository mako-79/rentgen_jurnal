<?php 
include("../base.php");
include("header.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {
    $login = $_SESSION['Login'];
    require "../sub/functions.php";
    $level = GetLvlByLogin($login);
    
    if($level>3){
    /////////////////////////////////////////////////////
	if(isset($_POST['new_id'])){
	    $new_id = $_POST['new_id'];
	    $lid = $new_id;
	    
	    $sql_select_row = "SELECT t1.login,t1.Username,t1.group_id,t2.level,t1.birthdate,t1.enable,t1.phone,t1.dop FROM users t1 JOIN groups t2 ON t2.id = t1.group_id WHERE t1.id = ".$lid.";";
		$result_row = mysql_query($sql_select_row) or die("Query failed ".mysql_error());
		$l_login = mysql_result($result_row,0,'login');
	        $fio = mysql_result($result_row,0,'Username');
	        $group_id = mysql_result($result_row,0,'group_id');
	        $ulvl = mysql_result($result_row,0,'level');
	        $enbl = mysql_result($result_row,0,'enable');
	        $birthdate = mysql_result($result_row,0,'birthdate');
		$birthdate = DateTimeParseToDt($birthdate);
	        $phone = mysql_result($result_row,0,'phone');
		$dop = mysql_result($result_row,0,'dop');
?>
    	    
    <div style="background:#fefefe;width:100%;min-width:600px;padding:10px;" class="div_zform">
	<form id="e-user-form" action="save-user.php" data-form="ajax">
	    <input type=hidden name=user_id id=user_id value=<? echo $lid ?>>
		<input type=hidden name=ogroup id=ogroup value=<? echo $group_id ?>>
	    <div>
		<div class="hor">
			<div style='width:230px;'>
			    Логин*:
			    <br><input maxlength=150 type=text id="login" name="login" value="<?echo $l_login?>" style="width:200px;" /><span id=err_1></span>
			</div>
			<div style='width:320px;'>
			    ФИО*:
			    <br><input maxlength=250 type="text" id="fio" name="fio" value="<?echo $fio;?>" style="width:300px;" /><span id=err_1></span>
			</div>
		<br>
		<?if($level>5){?>
		<div class="hor">
			<div>Группа<br>
			    <select id=group name=group>
			<?
			$sql_select_grow = "SELECT id,gname,level FROM groups ORDER BY gname ASC";
			$result_grow = mysql_query($sql_select_grow);
			$grow = mysql_fetch_array($result_grow);
			do{
			    echo "<option ".($group_id == $grow['id']?'selected':'')." value='". $grow['id'] ."'>". $grow['gname'] ."</option>";
			}
			    while($grow = mysql_fetch_array($result_grow));
			?>
			    </select>
			</div>

			<div style='width:220px;'>
			    Пароль*:<input maxlength=50 type=text id="n_pass" name="n_pass" style='width:200px;' /><span id=err_2></span>
			</div>
			<div style='width:220px;'>
			    Подтвердить пароль*:<input maxlength=50 type=text id="n_repass" name="n_repass" style='width:200px;' /><span id=err_3></span>
			</div>
		</div>
		<?}else{?>
                        <input type=hidden id="n_pass" name="n_pass"  />
                        <input type=hidden id="n_pass" name="n_repass"  />
		<?}?>
		<div class="hor">
			<div style='width:130px;'>
			    Дата рождения:
			    <br><input maxlength=20 type=text class=bdt id="bdt" name="bdt" value="<? echo $birthdate?>" style="width:120px;">
			</div>
			
		</div>
		<div>
		    Телефон:<input maxlength=400 type=text id=phone name="phone" style='width:310px;' value="<? echo $phone?>">
		</div>
		<div style="clear:both;"></div>
		<br />
		<div>
		    Комментарий:
		    <br><textarea placeholder="Комментарий" cols=120 rows=5 type=text id=dop name="dop" value="<? echo $dop?>"><? echo $dop?></textarea>
		</div><br />
	    </div>	
	    <div> <br />
		<input type=button class="save-user-btn" id="<? echo $lid?>" value='OK'>
		<input type=button id="e_modal_reject" value='Отмена'>
	    </div>	
	</form>
    </div>
    
    <style>
    .chgroups{
    	position:relative;overflow:auto;min-width:800px;max-width:1200px;height:100px;width:100%;
    }
    .chinput{
    	float:left;padding:3px;margin:2px;border:1px solid #aaa;
    }
    .hor div{ 
    	display:inline-grid;width:300px;
    }

    .hor2 div{ 
    	display:inline-grid; width:130px;
    }

    select{
    	padding:3px;
    }
    </style>

    <?
	}
    }
}
?>