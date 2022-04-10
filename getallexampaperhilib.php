<?php 

include("classes/DataBase.class.php");

date_default_timezone_set('Asia/kuala_lumpur');


$todayDateTime = date('Y-m-d H:i:s');

$db = DataBase::getInstance();

if(is_object($db)){
	$appl_arr = array();
	$sqlsel = "SELECT * FROM TBL_PREV_EXAMS";
	$row = $db->executeGrab($sqlsel);

	if(is_array($row)){
		$len = count($row);
		if($len>0){
			for($i=0;$i<$len;$i++){
				$appl_arr[] = array(
					"IDEXAM" => $row[$i]['idexams'],
					"FILENAME" => $row[$i]['file_name'],
					"FAC" => $row[$i]['fac'],
					"COURSE" => $row[$i]['course_name'],
					"CATEGORY" => $row[$i]['category']
				);	
			}//end for looping
			header('Cache-Control: private,max-age=0');
			echo json_encode($appl_arr);
		}else{
			echo null;
		}
	}else if(is_bool($row)){
		echo null;
	}
}
?>