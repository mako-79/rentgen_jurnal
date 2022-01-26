<?
include ("../base.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login']) ) {

        require "../sub/functions.php";
	$login = $_SESSION['Login'];	
	$level = GetLvlByLogin($login);
	$uid = GetUserIdByLogin($login);

    if($level>3){
    include('classImage.php');
	$ndt = "";
	if (isset($_POST['n_dt'])) {		
		$nldt = $_POST['n_dt'];
		$ndt = DateTimeParseBackToDtTm($nldt);
		$tdt = date("Y-m-d h:i:s");
		if($ndt == 0){$ndt = $tdt;}

		$lgdt = date_parse_from_format("Y-m-d h:i:s", $ndt);
		$lday = $lgdt['day'];
		$lmon = $lgdt['month'];
		$lyear = $lgdt['year'];	
		mkdir('uploads/'.$lyear);
		mkdir('uploads/'.$lyear.'/'.$lmon);
		mkdir('uploads/'.$lyear.'/'.$lmon.'/'.$lday);
		mkdir('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/sm');
	}

				 
        $n_dop = "";
	if (isset($_POST['n_dop'])) {		
		$n_dop = $_POST['n_dop'];
		$n_dop = htmlspecialchars($n_dop);
		$n_dop = urldecode($n_dop);
			echo $n_dop;
	}

	if (isset($_POST['n_user_id'])){
		for ( $i=0; $i < count( $_POST['n_user_id'] ); $i++ ){
			$n_user_id = $_POST['n_user_id'];
			//$result2 = mysql_query ("INSERT INTO jurnal (regdate,PID,dop) VALUES('$ndt','$n_user_id[$i]','$n_dop')") or die("Query failed ".mysql_error());
			//echo $n_user_id;
		}
	}else{
	 	echo "[no select]";
	}

        //////////////////////////////////////////////////////////////////////
	// Загрузка файла
	$valid_formats = array("png","jpg","JPG","PNG");
        $max_file_size = 1024*1000000; //10000 kb
	$path = "uploads/"; // Upload directory
	$n_user_id = $_POST['n_user_id'];
	$name = $_FILES['files']['name']; 

	if ($_FILES['files']['error'] == 4) {
		        continue; // Skip file if any error found
	}	       	
	
        if ($_FILES['files']['error'] == 0){	           

	 	//if ($_FILES['upfiles']['size'] > $max_file_size){
		//       	echo $name." is too large!.";
		//}else if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
		//	echo $name."is not a valid format";
		//}else{
		   
		   if (isset($_POST['n_id'])){
				$n_id = $_POST['n_id'];
				
				$pathname = $n_id."-".$name;
				$fullpath = $path."".$pathname;
			

			if (is_uploaded_file($_FILES['files']['tmp_name'])) {
				$filename = $_FILES['files']['tmp_name'];
		        	if(@move_uploaded_file($filename, "uploads/".$lyear."/".$lmon."/".$lday."/".$pathname)){
		        	    
					echo "Файл корректен и был успешно загружен в каталог!";
					$result5 = mysql_query("INSERT INTO ph_files (name,path,mid,PID) VALUES('$pathname','$pathname','$n_id','$n_user_id')");
					
					$nimage = new SimpleImage();
					$nimage->load("uploads/".$lyear."/".$lmon."/".$lday."/".$pathname);
					$nwidth = $nimage->getWidth();
					if($nwidth > 1200){
					    $nimage->resizeToWidth(1200);
					    $nimage->save('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/'.$pathname);
					}
					
					$simage = new SimpleImage();
					$simage->load('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/'.$pathname);
					
					$simage->resizeToWidth(150);
					$simage->save('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/sm/'.$pathname);
					
				} else {
					    echo "Возможная атака с помощью файловой загрузки!\n";
			        }
			}
		   }
		//}
	}
	
    }	
}else{
	include "../login.php";
}
    ?>