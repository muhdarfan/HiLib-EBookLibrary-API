<?php 
include("classes/DataBase.class.php");
include("classes/Utility.class.php");

date_default_timezone_set('Asia/kuala_lumpur');

$todayDateTime = date('Y-m-d H:i:s');
$username = $_POST['usrname'];
$userpass = $_POST['usrpass'];
$db = DataBase::getInstance();

if(is_object($db)){
    $sqlsel = "SELECT * FROM ".TBL_USERS." WHERE uname='".$username."' AND upass='".$userpass."'";
    $row = $db->executeSingle($sqlsel);
    if(is_array($row)){
        if(count($row)>0){
            //echo "YES ADE REKOD BOH";
            $arr['msg'] = "1";
            $arr['USERID'] = $row['idusers'];
            $arr['UFN'] = $row['fname'];
            $arr['UMAT'] = $row['matrixno'];
            $arr['UEMAIL'] = $row['email'];
            $arr['UHP'] = $row['hp'];
            $arr['UQRCODEIMGFN'] = $row['qrcodeimg_fn'];
            $arr['UNAME'] = $row['uname'];
            $arr['ULEVEL'] = $row['ulevel'];
            $arr['USTATUS'] = $row['status'];
            
            echo json_encode($arr);    
        }else{
            $arr['msg'] = "0";
            
            echo json_encode($arr);
        }
    }else if(is_bool($row)){
        $arr['msg'] = "0";
        echo json_encode($arr);
    }
}
?>