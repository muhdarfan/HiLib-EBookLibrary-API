<?php

/*
	

	@Author			:   		Frankis Ismail (Mrpixel)
	@Date			:			03 May 2016


*/



class Utility{
	private $db;



	public static function getUserBranchByID($id){
		$userbranch;

		$db = DataBase::getInstance();
		
		if(is_object($db)){

			$selsql = "SELECT * FROM ".VIEW_USER_DETAILS." WHERE iduser=".(int)$id;
			$row = $db->executeSingle($selsql);
			if(is_array($row)){
				$userbranch = $row['daerah_desc'];
			}
		}

		return $userbranch;
	}

	public static function getUserBranchIDbyID($id){
		$userbranch;

		$db = DataBase::getInstance();
		
		if(is_object($db)){

			$selsql = "SELECT * FROM ".TBL_USER." WHERE iduser=".(int)$id;
			$row = $db->executeSingle($selsql);
			if(is_array($row)){
				$userbranch = $row['idbranch'];
			}
		}

		return $userbranch;
	}

	public static function getUserLevelInfoByID($id){
		$userlevelstr;

		$db = DataBase::getInstance();
		
		if(is_object($db)){

			$selsql = "SELECT * FROM ".TBL_LOGIN." WHERE idusr=".(int)$id;
			$row = $db->executeSingle($selsql);
			if(is_array($row)){
				$userlevelstr = $row['usrlevel'];
			}
		}

		return $userlevelstr;
	}



	public static function getUserLevelDescById($id){
		$userlevelstr;

		$db = DataBase::getInstance();
		
		if(is_object($db)){

			$selsql = "SELECT * FROM ".TBL_USERLEVEL." WHERE iduserlvl=".(int)$id;
			$row = $db->executeSingle($selsql);
			if(is_array($row)){
				$userlevelstr = $row['userlvl_desc'];
			}
		}

		return $userlevelstr;
	}

	public static function getFullNameByUserID($id){
		$fullname;

		$db = DataBase::getInstance();
		
		if(is_object($db)){

			$selsql = "SELECT * FROM ".TBL_USER." WHERE iduser=".(int)$id;
			$row = $db->executeSingle($selsql);
			if(is_array($row)){
				$fullname = $row['fullname'];
			}
		}

		return $fullname;
	}

	
	public static function getEmpDetailsByID($id){
		$detailsstr;

		$db = DataBase::getInstance();
		
		if(is_object($db)){

			/*
			1	status_activation	tinyint(1)			Yes	NULL	
	22	status_desc	varchar(30)	latin1_swedish_ci		No	None	
	23	attendance_set_slot	tinyint(2)			Yes	NULL	
	24	time_in	time			Yes	NULL	
	25	time_out	time			Yes	NULL	
	26	set_name	varchar(20)	latin1_swedish_ci		Yes	NULL	
	27	status
			*/

			$selsql = "SELECT * FROM ".VIEW_EMPL_DETAILS." WHERE biluser=".(int)$id;
			$row = $db->executeSingle($selsql);
			if(is_array($row)){
				$detailsstr = $row['empnum']."|".$row['biluser']."|".$row['kwsp']."|".$row['socso']."|".$row['perkeso']."|".$row['join_date']."|".$row['start_date']."|".$row['idpos']."|".$row['pos_desc']."|".$row['idempstat']."|".$row['emp_stat_desc']."|".$row['iddepart']."|".$row['depart_desc']."|".$row['idbranch']."|".$row['branch_desc']."|".$row['total_leave_set']."|".$row['balance_leave']."|".$row['status_activation']."|".$row['status_desc']."|".$row['attendance_set_slot']."|".$row['time_in']."|".$row['time_out']."|".$row['set_name']."|".$row['status'];
			}
		}

		return $detailsstr;
	}

	public static function getUserDetailsByID($id){
		$detailsstr;

		$db = DataBase::getInstance();
		
		if(is_object($db)){

			$selsql = "SELECT * FROM ".VIEW_USERDETAILS." WHERE biluser=".(int)$id;
			$row = $db->executeSingle($selsql);
			if(is_array($row)){
				$detailsstr = $row['biluser']."|".$row['fullname']."|".$row['icnum']."|".$row['dob']."|".$row['bilg']."|".$row['gender_desc']."|".$row['bilms']."|".$row['marital_desc']."|".$row['address']."|".$row['postcode']."|".$row['ID_NEGERI']."|".$row['NAMA_NEGERI']."|".$row['id']."|".$row['country_name']."|".$row['hpnum']."|".$row['email']."|".$row['account_bank_num']."|".$row['account_bank_holder_name']."|".$row['acc_bank_name']."|".$row['BANK_NAME']."|".$row['nextkinname']."|".$row['nextkinphone']."|".$row['username']."|".$row['password']."|".$row['biluserlvl']."|".$row['usrlvl_desc']."|".$row['bilstatus']."|".$row['status_desc']."|".$row['activeid'];
			}
		}

		return $detailsstr;
	}
	
	
	public static function getDevRegIDByID($id){
		$devregid;

		$db = DataBase::getInstance();
		
		if(is_object($db)){

			$selsql = "SELECT * FROM ".TBL_DEVICE_REGISTERED." WHERE userid=".(int)$id;
			$row = $db->executeSingle($selsql);
			if(is_array($row)){
				$devregid = $row['dev_reg_id'];
			}
		}

		return $devregid;
	}



}


?>