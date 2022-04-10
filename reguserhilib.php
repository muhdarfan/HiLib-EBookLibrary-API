<?php 
include("classes/DataBase.class.php");
include("classes/RandomStringUtils.class.php");
include('phpqrcode/qrlib.php'); 

date_default_timezone_set('Asia/kuala_lumpur');
$TodayDateTime = date("Y-m-d H:i:s");
$fname = $_POST['fnval'];
$matrix = $_POST['mval'];
$email = $_POST['emailval'];
$hp = $_POST['hpval'];
$uname = $_POST['unval'];
$upass = $_POST['upval'];

/*
$fname = "BADIGOL BIN SEMAUN";
$matrix = "PSAS012020";
$email = "badigol@gmail.com";
$hp = "0126469237";


$uname = "badigol";
$upass = "123";
*/
$compqrcodefn = $matrix;
$db = DataBase::getInstance();
if(is_object($db)){
	$filename = $compqrcodefn.".png";
	$sqlinsrtusr = "INSERT INTO ".TBL_USERS."(fname,matrixno,email,hp,qrcodeimg_fn,uname,upass,reg_dt) VALUES ('".$fname."','".$matrix."','".$email."','".$hp."','".$filename."','".$uname."','".$upass."','".$TodayDateTime."')";
	$res = $db->executeOperation($sqlinsrtusr);
	if($res){
	    $tempDir = "imgqrcode"; 
		$pngAbsoluteFilePath = $tempDir."/".$filename; 
		QRcode::png($compqrcodefn, $pngAbsoluteFilePath); 
		$arr['msg'] = "1";
        echo json_encode($arr);
	}else{
		$arr['msg'] = "0";
        echo json_encode($arr);
	}
}
?>