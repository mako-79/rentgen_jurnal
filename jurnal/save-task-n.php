<?
include ("../base.php");

if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Login']) ) {

        require "../sub/functions.php";
	$login = $_SESSION['Login'];	
	$level = GetLvlByLogin($login);
	$uid = GetUserIdByLogin($login);

    if($level>3){
        include('classImage.php');
        //////////////////////////////////////////////////////////////////////
	// Загрузка файла
	$valid_formats = array("png","jpg","JPG","PNG");
        $max_file_size = 1024*1000000; //10000 kb
        
	$path = "uploads/"; // Upload directory
	$user_id = $_POST['user_id'];
	$img_id = $_POST['img_id'];

        $dt = "";
	$lgdt;
	
	if (isset($_POST['regdt'])) {		
		$ldt = $_POST['regdt'];
		$dt = DateTimeParseBackToDtTm($ldt);
		
		$lgdt = date_parse_from_format("Y-m-d h:i:s", $dt);
		$lday = $lgdt['day'];
		$lmon = $lgdt['month'];
		$lyear = $lgdt['year'];	
		echo "=".$lday." ".$lmon." ".$lyear;
		
		mkdir('uploads/'.$lyear);
		mkdir('uploads/'.$lyear.'/'.$lmon);
		mkdir('uploads/'.$lyear.'/'.$lmon.'/'.$lday);
                mkdir('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/sm');					
	}


	$name = $_FILES['files']['name'];
	$name = $img_id."-".$name;
	//echo $name."-".$user_id;
	
	if ($_FILES['files']['error'] == 4) {
		continue; // Skip file if any error found
	}	       	
	
        if ($_FILES['files']['error'] == 0){	           

	 	//if ($_FILES['upfiles']['size'] > $max_file_size){
		//       	echo $name." is too large!.";
		//}else 
		if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
			echo $name."is not a valid format";
		}else{
		        //echo "taskid = ".$_POST['task_id']".$_FILES['files']['tmp_name'];
			//echo "=".$name;
		   if (isset($_POST['task_id'])){
				$task_id = $_POST['task_id'];
				$pathname = $task_id."-".$name;
				$fullpath = $path."".$pathname;
			        

			if (is_uploaded_file($_FILES['files']['tmp_name'])) {
				$filename = $_FILES['files']['tmp_name'];
		        	if(@move_uploaded_file($filename, "uploads/".$lyear."/".$lmon."/".$lday."/".$pathname)){
                                       	//echo "Файл корректен и был успешно загружен в каталог! uploads/".$lyear."/".$lmon."/".$lday."/".$pathname;
                                        $result5 = mysql_query("INSERT INTO ph_files (name,path,mid,PID) VALUES('$pathname','$pathname','$task_id','$user_id')");
				
					$nimage = new SimpleImage();
                                      	$nimage->load("uploads/".$lyear."/".$lmon."/".$lday."/".$pathname);
					$nwidth = $nimage->getWidth();
					if($nwidth > 1200){
					    $nimage->resizeToWidth(1200);
					    $nimage->save('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/'.$pathname);
					}
					
					$simage = new SimpleImage();
					//$simage->load("uploads/".$pathname);
					$simage->load('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/'.$pathname);
					$simage->resizeToWidth(150);
					//$simage->save("uploads/sm/".$pathname);
					$simage->save('uploads/'.$lyear.'/'.$lmon.'/'.$lday.'/sm/'.$pathname);

				} else {
					    echo "Возможная атака с помощью файловой загрузки!\n";
			        }
			}
		   }
		}
	}
	
    }	
}else{
	include "../login.php";
}
?>