<?php

/**
*
*	@Author			:	Frankis Ismail Mrpixel
*	@Title			:	FeedCBUtility utility class
*	@Date/time		:	Tuesday 16/04/2011
*	@Update			:	Thursday 12/04/2012
*	@Description	: 	Class Utility for feed combobox list 
*						Usage ;  
*
*							FeedCBUtility::feedCBWithValue('your_desired_tablename',array("field1","field2"),'your_cb_instance_name','options others');
*
*						Example;
*
*							FeedCBUtility::feedCBWithValue('your_desired_tablename',array("CODE","DESCRIPTION"),'your_cb_instance_name'); --> no options others
*
*							FeedCBUtility::feedCBWithValue('your_desired_tablename',array("CODE","DESCRIPTION"),'your_cb_instance_name',true); --> have options others
*
*/

//include("Utility.class.php");


class FeedCBUtility{
	private $db;

	public static function feedCBWithValue($tblname,array $opsnvalfield,$cbname,$optothers=false){
		
		$db = DataBase::getInstance();
		if(is_object($db)){
			$sql = "SELECT * FROM ".$tblname;
			$row = $db->executeGrab($sql);
			if(is_array($row)){
				$len = count($row);
				echo "<select name='$cbname' id='$cbname' class='form-control'>\n";
				echo "<option>-- Please select --</option>\n";
				for($i=0;$i<$len;$i++){
					echo "<option value='".$row[$i][$opsnvalfield[0]]."'>".$row[$i][$opsnvalfield[1]]."</option>\n";	
				}
			}
		
					echo ($optothers)?"<option>Lain-lain</option>\n":'';
						
					echo "</select>\n";	
		}

	}

	public static function feedCBbranch($tblname,array $opsnvalfield,$cbname,$optothers=false){
		
		$db = DataBase::getInstance();
		if(is_object($db)){
			$sql = "SELECT * FROM ".$tblname;
			$row = $db->executeGrab($sql);
			if(is_array($row)){
				$len = count($row);
				echo "<select name='$cbname' id='$cbname' class='form-control'>\n";
				echo "<option>-- Pilih Cawangan --</option>\n";
				for($i=0;$i<$len;$i++){
					echo "<option value='".$row[$i][$opsnvalfield[0]]."'>".$row[$i][$opsnvalfield[1]]."</option>\n";	
				}
			}
		
					echo ($optothers)?"<option>Lain-lain</option>\n":'';
						
					echo "</select>\n";	
		}

	}

	public static function feedCBFilterBranchNDate($adminbranchid,$todayDT){
		
		$db = DataBase::getInstance();
		if(is_object($db)){
			$sql = "SELECT * FROM ".VIEW_USER_DETAILS." WHERE usrlvl=4 AND idbranch=".(int)$adminbranchid;
			$row = $db->executeGrab($sql);
			if(is_array($row)){
				$len = count($row);
				echo "<select name='cbstaff' id='cbstaff' class='form-control'>\n";
				echo "<option>-- Sila pilih --</option>\n";
				for($i=0;$i<$len;$i++){
					//echo $row[$i]['iduser']."<br/>";
					//echo "<option value='".$row[$i]['iduser']."'>".$row[$i]['userlogin_fullname']."</option>\n";	

					if(self::isExist($row[$i]['iduser'],$todayDT)){
						
					}else{
						echo "<option value='".$row[$i]['iduser']."'>".$row[$i]['userlogin_fullname']."</option>\n";	
					}
				}
			}	
						
			echo "</select>\n";	
		}

	}

	private static function isExist($userid,$todayDate){

		$db = DataBase::getInstance();
		if(is_object($db)){
			$sql = "SELECT * FROM ".VIEW_USER_TRANS." WHERE iduser=".(int)$userid." AND transaction_collect_date='".$todayDate."'";

			$row = $db->executeSingle($sql);
			if(is_array($row)){
				return true;
			}else if(is_bool($row)){
				return false;
			}
		}
		

	}

	public static function feedCBWithValueTH($tblname,array $opsnvalfield,$cbname,$optothers=false){
		
		$db = DataBase::getInstance();
		if(is_object($db)){
			$sql = "SELECT * FROM ".$tblname;
			$row = $db->executeGrab($sql);
			if(is_array($row)){
				$len = count($row);
				echo "<select name='$cbname' id='$cbname'>\n";
				echo "<option>-- Sila pilih --</option>\n";
				for($i=0;$i<$len;$i++){
					echo "<option value='".$row[$i][$opsnvalfield[0]]."'>".$row[$i][$opsnvalfield[1]]."</option>\n";	
				}
			}
		
					echo ($optothers)?"<option>Lain-lain</option>\n":'';
						
					echo "</select>\n";	
		}

	}

	public static function feedCBEditDepart($val){
			
			$db = DataBase::getInstance();

			if(is_object($db)){

				$querygrab = "SELECT * FROM ".TBL_DEPARTMENT;
				$row = $db->executeGrab($querygrab);
				if(is_array($row)){
					$len = count($row);
					echo "<select name='faccb' id='faccb' class='form-control'>\n";
						echo "<option>-- Please select --</option>\n";
						for($i=0;$i<$len;$i++){
							if((int)$val == $row[$i]['iddepart']){
								echo "<option value='".$row[$i]['iddepart']."' selected='selected'>".$row[$i]['depart_desc']."</option>\n";		
							}else{
								echo "<option value='".$row[$i]['iddepart']."'>".$row[$i]['depart_desc']."</option>\n";		
							}
						}
					echo "</select>\n"; 
				}
			}//end if
			
	}//end function
	

	public static function feedCBEditStatus($val){
			
			$db = DataBase::getInstance();

			if(is_object($db)){

				$querygrab = "SELECT * FROM ".TBL_STATUS;
				$row = $db->executeGrab($querygrab);
				if(is_array($row)){
					$len = count($row);
					echo "<select name='cbstatus' id='cbstatus' class='form-control'>\n";
						echo "<option>-- Please select --</option>\n";
						for($i=0;$i<$len;$i++){
							if((int)$val == $row[$i]['idstatus']){
								echo "<option value='".$row[$i]['idstatus']."' selected='selected'>".$row[$i]['status_desc']."</option>\n";		
							}else{
								echo "<option value='".$row[$i]['idstatus']."'>".$row[$i]['status_desc']."</option>\n";		
							}
						}
					echo "</select>\n"; 
				}
			}//end if
			
	}//end function

	public static function feedCBEditStatusUser($iduser,$val){

			$arrstatus = array("ACTIVE","NOT ACTIVE");
			
			
					$len = count($arrstatus);

						echo "<select name='cbstatuser' id='cbstatuser' class='form-control'>\n";
							echo "<option>-- Please select --</option>\n";
							for($i=0;$i<$len;$i++){
								if($val == $arrstatus[$i]){
									echo "<option value='".$arrstatus[$i]."' selected='selected'>".$arrstatus[$i]."</option>\n";		
								}else{
									echo "<option value='".$arrstatus[$i]."'>".$arrstatus[$i]."</option>\n";		
								}
							}
						echo "</select>\n"; 
			
			
			
	}//end function

	public static function feedCBEditUserLevel($iduser,$val){

			     $arrstatus = array("SUPERADMIN","ADMIN","RESIDENTS");
			
			
					$len = count($arrstatus);

						echo "<select name='cbuserlevel' id='cbuserlevel' class='form-control'>\n";
							echo "<option>-- Please select --</option>\n";
							for($i=0;$i<$len;$i++){
								if($val == $arrstatus[$i]){
									echo "<option value='".$arrstatus[$i]."' selected='selected'>".$arrstatus[$i]."</option>\n";		
								}else{
									echo "<option value='".$arrstatus[$i]."'>".$arrstatus[$i]."</option>\n";		
								}
							}
						echo "</select>\n"; 
			
			
			
	}//end function
	
	public static function feedCBEdit($tblname,array $arrtmp,$cbname){
			
			$db = DataBase::getInstance();

			if(is_object($db)){

				//echo $arrtmp[0];

				$flddb1 = $arrtmp[0];
				$flddb2 = $arrtmp[1];
				$fldvalpass = $arrtmp[2];

				
				$querygrab = "SELECT ".$flddb1.",".$flddb2." FROM ".$tblname;

				//echo $querygrab;
				
				$row = $db->executeGrab($querygrab);
				if(is_array($row)){
					$len = count($row);
					echo "<select name=\"{$cbname}\" id=\"{$cbname}\" class='form-control'>\n";
						echo "<option>-- Please select --</option>\n";
						for($i=0;$i<$len;$i++){
							//echo "VALUE PASS ".(int)$fldvalpass." : VALUE DB ".$row[$i][$flddb1];
							if((int)$fldvalpass == $row[$i][$flddb1]){
								echo "<option value='".$row[$i][$flddb1]."' selected='selected'>".$row[$i][$flddb2]."</option>\n";		
							}else{
								echo "<option value='".$row[$i][$flddb1]."'>".$row[$i][$flddb2]."</option>\n";		
							}							
						}
					echo "</select>\n"; 
				
				}		
				
			}//end if
			
	}//end function

	public static function feedCBEditStatusJqueryActive($tblname,$cbname){
			
			$db = DataBase::getInstance();

			if(is_object($db)){

				
				$querygrab = "SELECT bilstatus,status_desc FROM ".$tblname;

				//echo $querygrab;
				
				$row = $db->executeGrab($querygrab);
				if(is_array($row)){
					$len = count($row);
					echo "<select name=\"{$cbname}\" id=\"{$cbname}\" class='form-control'>\n";
						echo "<option>-- Please select --</option>\n";
						for($i=0;$i<$len;$i++){
							//echo "VALUE PASS ".(int)$fldvalpass." : VALUE DB ".$row[$i][$flddb1];
							if("1" == $row[$i]['bilstatus']){
								echo "<option value='".$row[$i]['bilstatus']."' selected='selected'>".$row[$i]['status_desc']."</option>\n";		
							}else{
								echo "<option value='".$row[$i]['bilstatus']."'>".$row[$i]['status_desc']."</option>\n";		
							}							
						}
					echo "</select>\n"; 
				
				}		
				
			}//end if
			
	}//end function

	public static function feedCBEditStatusJqueryNotActive($tblname,$cbname){
			
			$db = DataBase::getInstance();

			if(is_object($db)){

				
				$querygrab = "SELECT bilstatus,status_desc FROM ".$tblname;

				//echo $querygrab;
				
				$row = $db->executeGrab($querygrab);
				if(is_array($row)){
					$len = count($row);
					echo "<select name=\"{$cbname}\" id=\"{$cbname}\" class='form-control'>\n";
						echo "<option>-- Please select --</option>\n";
						for($i=0;$i<$len;$i++){
							//echo "VALUE PASS ".(int)$fldvalpass." : VALUE DB ".$row[$i][$flddb1];
							if("2" == $row[$i]['bilstatus']){
								echo "<option value='".$row[$i]['bilstatus']."' selected='selected'>".$row[$i]['status_desc']."</option>\n";		
							}else{
								echo "<option value='".$row[$i]['bilstatus']."'>".$row[$i]['status_desc']."</option>\n";		
							}							
						}
					echo "</select>\n"; 
				
				}		
				
			}//end if
			
	}//end function

	
	
	public static function feedCBEditGender($tblname,$val,$cbname){
			
			$db = DataBase::getInstance();

			if(is_object($db)){

				$querygrab = "SELECT bilg,gender_desc FROM ".$tblname;
				$row = $db->executeGrab($querygrab);
				if(is_array($row)){
					$len = count($row);
					echo "<select name=\"{$cbname}\" id=\"{$cbname}\" class='form-control'>\n";
						echo "<option>-- Please select --</option>\n";
						for($i=0;$i<$len;$i++){
							if((int)$val == $row[$i]['bilg']){
								echo "<option value='".$row[$i]['bilg']."' selected='selected'>".$row[$i]['gender_desc']."</option>\n";		
							}else{
								echo "<option value='".$row[$i]['bilg']."'>".$row[$i]['gender_desc']."</option>\n";		
							}
						}
					echo "</select>\n"; 
				}
			}//end if
			
	}//end function

	public static function feedCBWithValueEMployee(){
		
		$db = DataBase::getInstance();
		if(is_object($db)){
			$sql = "SELECT * FROM ".VIEW_EMPL_DETAILS." WHERE status_activation=1";
			$row = $db->executeGrab($sql);
			if(is_array($row)){
				$len = count($row);
				echo "<select name='biluser' id='biluser' class='form-control'>\n";
				echo "<option>-- Please select --</option>\n";
				for($i=0;$i<$len;$i++){

					$fullname = Utility::getFullNameByUserID($row[$i]['biluser']);

					$desc = $row[$i]['empnum']." - ".$fullname;

					echo "<option value='".$row[$i]['biluser']."'>".$desc."</option>\n";	
				}
			}				
					echo "</select>\n";	
		}

	}

	public static function feedCBPosBranchMngr($usrlvlid){
		
		$db = DataBase::getInstance();
		if(is_object($db)){
			$sql = "SELECT * FROM ".TBL_POSITION;
			$row = $db->executeGrab($sql);
			if(is_array($row)){
				$len = count($row);
				echo "<select name='poscb' id='poscb' class='form-control'>\n";
					echo "<option>-- Please select --</option>\n";
					for($i=0;$i<$len;$i++){
						if($row[$i]['idpos'] == "3" || $row[$i]['idpos'] == "5" || $row[$i]['idpos'] == "6"){
							echo "<option value='".$row[$i]['idpos']."'>".$row[$i]['pos_desc']."</option>\n";
						}
							
					}
			}				
				echo "</select>\n";	
		}

	}

	public static function feedCBUsrLvlBranchMngr($usrlvlid){
		
		$db = DataBase::getInstance();
		if(is_object($db)){
			$sql = "SELECT * FROM ".TBL_USERLEVEL;
			$row = $db->executeGrab($sql);
			if(is_array($row)){
				$len = count($row);
				echo "<select name='usrlvlcb' id='usrlvlcb' class='form-control'>\n";
					echo "<option>-- Please select --</option>\n";
					for($i=0;$i<$len;$i++){
						if($row[$i]['biluserlvl'] == "3" || $row[$i]['biluserlvl'] == "4"){
							echo "<option value='".$row[$i]['biluserlvl']."'>".$row[$i]['usrlvl_desc']."</option>\n";
						}
							
					}
			}				
				echo "</select>\n";	
		}

	}

	public static function feedCBEditPosBrnchMngr($valpass,$usrlvlid){
			
			$db = DataBase::getInstance();
			if(is_object($db)){
				$querygrab = "SELECT * FROM ".TBL_POSITION;
				$row = $db->executeGrab($querygrab);
				if(is_array($row)){
					$len = count($row);
					echo "<select name='poscb' id='poscb' class='form-control'>\n";
						echo "<option>-- Please select --</option>\n";
						for($i=0;$i<$len;$i++){
							if((int)$valpass == $row[$i]['idpos']){
								echo "<option value='".$row[$i]['idpos']."' selected='selected'>".$row[$i]['pos_desc']."</option>\n";		
							}else{
								if($row[$i]['idpos'] == "3" || $row[$i]['idpos'] == "5" || $row[$i]['idpos'] == "6"){
									echo "<option value='".$row[$i]['idpos']."'>".$row[$i]['pos_desc']."</option>\n";
								}		
							}							
						}
					echo "</select>\n"; 
				}		
			}//end if	
	}//end function

	public static function feedCBEditUsrLvlBrnchMngr($valpass,$usrlvlid){
			
			$db = DataBase::getInstance();
			if(is_object($db)){
				$querygrab = "SELECT * FROM ".TBL_USERLEVEL;
				$row = $db->executeGrab($querygrab);
				if(is_array($row)){
					$len = count($row);
					echo "<select name='usrlvlcb' id='usrlvlcb' class='form-control'>\n";
						echo "<option>-- Please select --</option>\n";
						for($i=0;$i<$len;$i++){
							if((int)$valpass == $row[$i]['biluserlvl']){
								echo "<option value='".$row[$i]['biluserlvl']."' selected='selected'>".$row[$i]['usrlvl_desc']."</option>\n";		
							}else{
								if($row[$i]['biluserlvl'] == "3" || $row[$i]['biluserlvl'] == "4"){
									echo "<option value='".$row[$i]['biluserlvl']."'>".$row[$i]['usrlvl_desc']."</option>\n";
								}		
							}							
						}
					echo "</select>\n"; 
				}		
			}//end if	
	}//end function




}
/* end class FeedCBUtility */


						
?>
