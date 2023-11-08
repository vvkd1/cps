<?php require_once('global.php');
	$un = $_REQUEST['userid'];	
	$pass = md5($_REQUEST['password']);	
	
	if(isset($_REQUEST['userid']) && !empty($_REQUEST['userid']) && isset($_REQUEST['password']) && !empty($_REQUEST['password']) ) {	

		$settingsql = "SELECT nooffailedpasswordattempt,password_expiry,autolockminutes FROM tb_cps_settings";
		$rowsetting = $db->get_row($settingsql);
	
		//$sql="SELECT * FROM tb_printadmin WHERE username like binary '".mysql_real_escape_string($un)."' and password like binary '".mysql_real_escape_string($pass)."' and password_status = 1 AND user_type = ".$_REQUEST["ddlType"]."";
		$sql="SELECT * , DATE_ADD(create_date, INTERVAL ".$rowsetting->password_expiry." DAY) as total_date, CURDATE() as 'current_date',user_status,user_type FROM tb_printadmin WHERE userid like binary '".mysql_real_escape_string($un)."' and password like binary '".mysql_real_escape_string($pass)."' and password_status = 1 ";
		$row_user = $db->get_row($sql);	
		//echo $sql;
		//print_r($row_user);	
		//die();		
		$count = count($row_user);		
		if($count > 0) {

			if($row_user->user_status==1){
				 $todaydate=date('Y-m-d H:i:s');
				 $last15DaysDate = date("Y-m-d H:i:s", strtotime($todaydate . " -16 days"));
				
				 $lastLoginDate=date('Y-m-d H:i:s',strtotime($row_user->lastlogintime));
				
				if(strtotime($last15DaysDate) < strtotime($lastLoginDate)||$row_user->user_type==2){
					
					if(strtotime($row_user->total_date) >= strtotime($row_user->current_date)){
						$_SESSION['group_id'] = $row_user->group_id;
						$_SESSION['admin_id'] = $row_user->adminid;
						$_SESSION['admin_username'] = $row_user->username;
						$_SESSION['admin_userid'] = $row_user->userid;
						$_SESSION['autolockminutes'] = $rowsetting->autolockminutes; // taking now logged in time
						$_SESSION['expire'] = time() + ($rowsetting->autolockminutes * 60) ; // ending a session in 30     minutes from the starting time
						//$_SESSION['user_type'] = $_REQUEST["ddlType"];
						$_SESSION['user_type'] = $row_user->user_type;
						$lastlogintime=date('Y-m-d H:i:s');
						$sql = "UPDATE tb_printadmin SET lastlogintime = '".$lastlogintime."',incorrect_attempt = 0 WHERE userid = '".$_REQUEST['userid']."'";
						$db->query($sql);
						echo '{"status":"true"}';
						exit();
					}
					else{

						unset($sumbit);
						echo '{"error":"true", "htmlcontent":"Your password has been deactivated. please contact to administrator."}';
						exit(0);
					}
				}else{
					$sql = "UPDATE tb_printadmin SET user_status = 0 WHERE userid = '".$_REQUEST['userid']."'";
					$db->query($sql);
						unset($sumbit);
						echo '{"error":"true", "htmlcontent":"Your password has been deactivated. please contact to administrator."}';
						exit(0);
				}
			}else{
				unset($sumbit);
					echo '{"error":"true", "htmlcontent":"Your account has been deactivated, please contact to administrator."}';
					exit(0);
			}
		}
		else {
			$sql = "UPDATE tb_printadmin SET incorrect_attempt = incorrect_attempt + 1 WHERE userid = '".$_REQUEST['userid']."'";
			$db->query($sql);
			if($rowsetting->nooffailedpasswordattempt>0)
			{
				$sqlgetusername = "select incorrect_attempt from tb_printadmin where userid='".$_REQUEST['userid']."'";	
				$row = $db->get_row($sqlgetusername);			
				if(count($row)>0)
				{
					$noofincorrectpassworddone = $row->incorrect_attempt;
					if($noofincorrectpassworddone>=$rowsetting->nooffailedpasswordattempt)
					{
						$sql = "UPDATE tb_printadmin SET password_status = 0, is_temp_password = 0 WHERE userid = '".$_REQUEST['userid']."'";
						$db->query($sql);
						echo '{"error":"true", "htmlcontent":"Your password has been blocked. Please contact to system administrator."}';
						exit(0);
					}
				}
			}			
			unset($sumbit);
			echo '{"error":"true", "htmlcontent":"Incorrect Userid or password."}';
			exit(0);
		}
	}
?>