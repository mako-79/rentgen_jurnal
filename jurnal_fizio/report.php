<?php include "../header.php"; ?>

<?if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {

	$login = $_SESSION['Login'];	
	$level = GetLvlByLogin($login);
	$uid = GetUserIdByLogin($login);
	include "../task_menu.php"; 
	
    if($level>3){

       	function getCountUet($mon,$spr,$uid){
		if($mon<10){
			$mon = '0'.$mon;
		}
		$result = mysql_query("SELECT sum(s.uet) FROM jurnal_fizio j 
							JOIN spr s ON s.id=j.spr_id 
								WHERE j.regdate like '2021-".$mon."%' 
								".($spr>0?'and j.spr_id='.$spr:'')."
								".($uid>0?'and emp_id='.$uid:'')." ") or die("Query failed ".mysql_error());
		$res = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		echo $res;

	}

	function getCountTab2($mon,$spr,$grpby,$uid,$pln){
                $result = mysql_query("SELECT count(1) FROM 
			( SELECT j.pid FROM jurnal_fizio j 
				WHERE j.regdate like '2021-".($mon<10?'0'.$mon:$mon)."%' 
					".($spr>0?'and j.spr_id='.$spr:'')." ".($uid>0?'and j.emp_id='.$uid:'')." 
						".($pln==2?'and dop like \'%закончен%\'':'')." 
						".($grpby==2?'group by j.pid':'')."
							 ) p;") or die("Query failed ".mysql_error());
		$res = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		echo $res;
	}

	?>
    <div align=center><h3>Отчет физиотерапия</h3></div>
    <div class="navbar">

	    <div class="btnbar">
		<input type=button class="btn" value="Журнал" onclick="document.location.href='/jurnal_fizio/jurnal.php'">
		<input type=button class="btn" value="Печать" onClick="javascript:RepPrint('print-content');">
	    </div>
    </div>

    <div class="list" id=report>  


	<table class="list-tasks" border=0>
	    <tr align=center class=toptasks>
		<td rowspan=2>Месяц</td>
	        <td rowspan=2>Кол-во ед-ц</td>
	        <td rowspan=2>Кол-во посещений</td>
		<td rowspan=2>Всего направлено</td>	
	        <td rowspan=2>Закончен</td>
		<td colspan=3>Электрофорез
		</td>
		<td colspan=3>УВЧ</td>
		<td colspan=3>УФО</td>
		<td colspan=3>Ремтерапия</td>
		<td colspan=3>Лазеротерапия</td>
		<td colspan=3>Контролируемая<br>чистка</td>
	    </tr>
	    <tr style="font-size:10px;">
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>проц-р</td><td>ует</td>
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>проц-р</td><td>ует</td>
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>проц-р</td><td>ует</td>
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>проц-р</td><td>ует</td>
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>проц-р</td><td>ует</td>
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>проц-р</td><td>ует</td>
	    </tr>

	<?
	 $mons = array("Январь"=>1,"Февраль"=>2,"Март"=>3,"Апрель"=>4,"Май"=>5,"Июнь"=>6,"Июль"=>7,"Август"=>8,"Сентябрь"=>9,"Октябрь"=>10,"Ноябрь"=>11,"Декабрь"=>12);
	for ($i=1; $i <= 8; $i++){
	?>
	    <tr style="font-weight:bold;font-size:12px;text-align:center;">
		<td><? echo array_search($i, $mons);?></td>	
		<td><?	echo getCountUet($i,0,0);	 ?></td>
		<td><?	echo getCountTab2($i,0,0);	 ?></td>
		<td><?		echo getCountTab2($i,0,2);	 ?></td>
		<td><?		echo getCountTab2($i,0,2,0,2);	 ?></td>
		<td><?		echo getCountTab2($i,7,2,0,0);	 ?></td>
		<td><?		echo getCountTab2($i,7,0,0,0);	 ?></td>
		<td><?		echo getCountUet($i,7,0);	 ?></td>
		<td><?		echo getCountTab2($i,12,2,0,0);	 ?></td>
		<td><?		echo getCountTab2($i,12,0,0,0);	 ?></td>
		<td><?		echo getCountUet($i,12,0);	 ?></td>
		<td><?		echo getCountTab2($i,9,2,0,0);	 ?></td>
		<td><?		echo getCountTab2($i,9,0,0,0);	 ?></td>
		<td><?		echo getCountUet($i,9,0);	 ?></td>
		<td><?		echo getCountTab2($i,11,2,0,0);	 ?></td>
		<td><?		echo getCountTab2($i,11,0,0,0);	 ?></td>
		<td><?		echo getCountUet($i,11,0);	 ?></td>
		<td><?		echo getCountTab2($i,13,2,0,0);	 ?></td>
		<td><?		echo getCountTab2($i,13,0,0,0);	 ?></td>
		<td><?		echo getCountUet($i,13,0);	 ?></td>
		
		<td><?		echo getCountTab2($i,146,2,0,0);	 ?></td>
		<td><?		echo getCountTab2($i,146,0,0,0);	 ?></td>
		<td><?		echo getCountUet($i,146,0);	 ?></td>
		
	    </tr>
	<?
	  }
	?>	
	    	</table>
    </div>
<script type="text/javascript">
	function RepPrint(strid) {
		var prtContent = document.getElementById('report');
 		  var WinPrint = window.open('','','left=50,top=50,width=800,height=600,toolbar=0,scrollbars=1,status=0');
			  WinPrint.document.write('');
		        WinPrint.document.write(prtContent.innerHTML);
			WinPrint.document.write('<style>table td{border:1px solid #000;padding:5px;}</style>');
			WinPrint.document.close();
			  WinPrint.focus();
			  WinPrint.print();
			   prtContent.innerHTML=strOldOne;
		}
</script>
<style>	input[type=text],
	select{
		padding:5px;font-size:14px;
		border-radius:5px;
	}
</style>

    <?
    	}  
}else{
	include "../login.php"; 
}
include "../footer.php"; ?>