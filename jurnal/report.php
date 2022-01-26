<?php include "../header.php"; ?>

<?if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login'])) {

    $login = $_SESSION['Login'];	
    $level = GetLvlByLogin($login);
    $uid = GetUserIdByLogin($login);
    include "../task_menu.php"; 
	
    if($level>3){

	function getCountTab($mon,$spr,$uid){
                //$result = mysql_query("SELECT count(1) FROM jurnal WHERE regdate like '2021-'.($mon<10?'0'.$mon:$mon).'%'");
		if($mon<10){
			$mon = '0'.$mon;
		}
		$result = mysql_query("SELECT count(1) FROM jurnal WHERE regdate like '2021-".$mon."%' ".($uid>0?'and emp_id='.$uid:'')." ") or die("Query failed ".mysql_error());
		$res = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		echo $res;

	}

	function getCountTab2($mon,$spr,$grpby,$uid,$pln){
                $result = mysql_query("SELECT count(1) FROM 
			( SELECT j.pid FROM jurnal j 
				WHERE j.regdate like '2021-".($mon<10?'0'.$mon:$mon)."%' 
					".($spr>0?'and j.spr_id='.$spr:'')." ".($uid>0?'and j.emp_id='.$uid:'')." 
						and (dop ".($pln==2?'':'not')." like '%пленк%' or dop ".($pln==2?'':'not')." like '%руках%')
						".($grpby<2?'group by j.pid':'')."
							 ) p;") or die("Query failed ".mysql_error());
		$res = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		echo $res;
	}

	function getCountTab3($mon,$spr){
                $result = mysql_query("SELECT count(1) FROM ( SELECT j.pid FROM jurnal j WHERE j.regdate like '2021-".($mon<10?'0'.$mon:$mon)."%' group by j.pid ) p;") or die("Query failed ".mysql_error());
		$res = mysql_num_rows($result) ? mysql_result($result, 0) : '';
		echo $res;
	}
	$user_id1 = 49634;//Галянова
	$user_id2 = 150636;//Шерстобитова
	$user_id4 = 156622;//Боброва
	$user_id3 = 161549;//Савченко
        $user_id5 = 169906;//Безхлебная
        
	$cnt = 12;
	?>
    <div align=center><h3>Отчет рентген</h3></div>
    <div class="navbar">

	    <div class="btnbar">
		<input type=button class="btn" value="Журнал" onclick="document.location.href='/jurnal/jurnal.php'">
		<input type=button class="btn" value="Печать" onClick="javascript:RepPrint('print-content');">
	    </div>
    </div>

    <div class="list" id=report>  

	<table class="list-tasks" id="ListTasks">
	    <tr align=center class=toptasks>
		<td rowspan=2>Месяц</td>
	        <td rowspan=2>Кол-во посещений</td>
		<td rowspan=2>Всего пациентов</td>	
		<td colspan=2>ОПТГ</td>
		<td colspan=2>радиовизиограф</td>
		<td colspan=2>прицельный</td>
	    </tr>
	    <tr style="font-size:10px;">
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>снимков</td>
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>снимков</td>
		<td>Кол-во<br>пац-в</td><td>Кол-во<br>снимков</td>
	    </tr>
	<?
	 $mons = array("Январь"=>1,"Февраль"=>2,"Март"=>3,"Апрель"=>4,"Май"=>5,"Июнь"=>6,"Июль"=>7,"Август"=>8,"Сентябрь"=>9,"Октябрь"=>10,"Ноябрь"=>11,"Декабрь"=>12);
	?>
	<tr style="font-size:10px;">
		 <td colspan=9>Галянова Наталья Николаевна</td>
	</tr>
	<?
	 for ($i=1; $i <= 12; $i++){
	?>	
	<tr style="font-weight:bold;font-size:12px;text-align:center;">
		<td><? echo array_search($i, $mons);?></td>
		<td><?	echo getCountTab($i,0,$user_id1);	 ?></td>
		<td><?	echo getCountTab2($i,0,0,$user_id1); ?></td>
		<td><?	echo getCountTab2($i,4,0,$user_id1); ?></td>
		<td><?	echo getCountTab2($i,4,2,$user_id1);?></td>
		<td><?	echo getCountTab2($i,5,0,$user_id1); ?></td>
		<td><?	echo getCountTab2($i,5,2,$user_id1);?></td>
		<td><?	echo getCountTab2($i,6,0,$user_id1); ?></td>
		<td><?	echo getCountTab2($i,6,2,$user_id1);?></td>
	</tr> 
	<?
	  }
	?>
	<tr style="font-size:10px;">
		 <td colspan=9>Шерстобитова Татьяна Владиславовна</td>
	</tr>
	<?
	 for ($i=1; $i <= 12; $i++){
	?>
	<tr style="font-weight:bold;font-size:12px;text-align:center;">
		<td><? echo array_search($i, $mons);?></td>	
		<td><?	echo getCountTab($i,0,$user_id2);	 ?></td>
		<td><?	echo getCountTab2($i,0,0,$user_id2); ?></td>
		<td><?	echo getCountTab2($i,4,0,$user_id2); ?></td>
		<td><?	echo getCountTab2($i,4,2,$user_id2);?></td>
		<td><?	echo getCountTab2($i,5,0,$user_id2); ?></td>
		<td><?	echo getCountTab2($i,5,2,$user_id2);?></td>
		<td><?	echo getCountTab2($i,6,0,$user_id2); ?></td>
		<td><?	echo getCountTab2($i,6,2,$user_id2);?></td>
	</tr>
	<?}?>
	<tr style="font-size:10px;">
		 <td colspan=9>Савченко Павел Сергеевич</td>
	</tr>	
	<?
	 for ($i=5; $i <= 12; $i++){
	?>
	<tr style="font-weight:bold;font-size:12px;text-align:center;">    
		<td><? echo array_search($i, $mons);?></td>	
		<td><?	echo getCountTab($i,0,161549);	 ?></td>
		<td><?	echo getCountTab2($i,0,0,$user_id3); ?></td>
		<td><?	echo getCountTab2($i,4,0,$user_id3); ?></td>
		<td><?	echo getCountTab2($i,4,2,$user_id3);?></td>
		<td><?	echo getCountTab2($i,5,0,$user_id3); ?></td>
		<td><?	echo getCountTab2($i,5,2,$user_id3);?></td>
		<td><?	echo getCountTab2($i,6,0,$user_id3); ?></td>
		<td><?	echo getCountTab2($i,6,2,$user_id3);?></td>
	</tr>
	<?
	  }
	?>
	<tr style="font-size:10px;">
		 <td colspan=9>Безхлебная Виктория Викторовна</td>
	</tr>	
	<?
	 for ($i=5; $i <= 12; $i++){
	?>
	<tr style="font-weight:bold;font-size:12px;text-align:center;">    
		<td><? echo array_search($i, $mons);?></td>	
		<td><?	echo getCountTab($i,0,161549);	 ?></td>
		<td><?	echo getCountTab2($i,0,0,$user_id5); ?></td>
		<td><?	echo getCountTab2($i,4,0,$user_id5); ?></td>
		<td><?	echo getCountTab2($i,4,2,$user_id5);?></td>
		<td><?	echo getCountTab2($i,5,0,$user_id5); ?></td>
		<td><?	echo getCountTab2($i,5,2,$user_id5);?></td>
		<td><?	echo getCountTab2($i,6,0,$user_id5); ?></td>
		<td><?	echo getCountTab2($i,6,2,$user_id5);?></td>
	</tr>
	<?
	  }
	?>
	<tr style="font-size:10px;">
		 <td colspan=9>Боброва Нина Николевна</td>
	</tr>	
	<?
	 for ($i=1; $i <= 12; $i++){
	?>
	<tr style="font-weight:bold;font-size:12px;text-align:center;">
		<td><? echo array_search($i, $mons);?></td>	
		<td><?	echo getCountTab($i,0,$user_id4);	 ?></td>
		<td><?	echo getCountTab2($i,0,0,$user_id4); ?></td>
		<td><?	echo getCountTab2($i,4,0,$user_id4); ?></td>
		<td><?	echo getCountTab2($i,4,2,$user_id4);?></td>
		<td><?	echo getCountTab2($i,5,0,$user_id4); ?></td>
		<td><?	echo getCountTab2($i,5,2,$user_id4);?></td>
		<td><?	echo getCountTab2($i,6,0,$user_id4); ?></td>
		<td><?	echo getCountTab2($i,6,2,$user_id4);?></td>
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