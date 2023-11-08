<?php require_once('global.php');
	
	$un = $_REQUEST['txtusername'];
	$uid = $_REQUEST['txtuserid'];
	if($_REQUEST['txtpassword'] != "")
	$pass = md5($_REQUEST['txtpassword']);	
	else
	$pass = "";
	$createdate = date("Y-m-d");
	$groupid = "";//$_REQUEST['ddlusergp'];	
	$usertype = $_REQUEST['ddlusergptype'];
	
	if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'add')){
		if(isset($_REQUEST['txtusername']) && !empty($_REQUEST['txtusername']) && isset($_REQUEST['txtpassword']) && !empty($_REQUEST['txtpassword']) ) 
		{
			if($result = $db->get_results("select * from tb_printadmin where username = '".$_REQUEST['txtusername']."'") ){				
				echo '{"error":"true", "htmlcontent":"User Name Already Exists."}';
				exit(0);
			}
			else{
			
				$sql = "Insert into tb_printadmin (username,userid,password,lastlogintime,group_id,user_type,password_status,create_date,is_temp_password) values('". $un ."','". $uid ."','". $pass ."','". date('Y-m-d') ."','". $groupid ."','". $usertype ."',1,'".$createdate."',0)";
				$db->query($sql);
				
				$sqlpassword = "Insert into tb_cps_adminpasswords (adminid,password,date) values('". $uid ."','". $pass ."','". date("y-m-d") ."')";
				$db->query($sqlpassword);
				
				if($_REQUEST['submit2'] == 'Save and Close') {
					$location = 'home.php';
				} else{
						$location = 'adduserprint.php';
				}	
				echo '{"status":"true", "loc":"'.$location.'"}';
				exit();	
			}
		}
		else {
		echo '{"status":"false"}';
			exit();
		}
	}else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'edit') && isset($_REQUEST['adminid']) && ($_REQUEST['adminid'] != ''))
	{
		$oldpassword = $_REQUEST['txtoldpassword'];
		if($pass != "")
		{
			$checkoldpassword = "SELECT * FROM tb_printadmin WHERE password = '".md5($oldpassword)."' AND adminid = '".$_REQUEST['adminid']."' ";
			//print_r($checkoldpassword);
			$result = $db->get_row($checkoldpassword);
			if(count($result)>0)
			{
				if(checkLastPassword($pass,$result->userid))
				{
					$sql = "update tb_printadmin set password = '".$pass."' where adminid = '".$_REQUEST['adminid']."'";
					$db->query($sql);
					
					$sqlpassword = "Insert into tb_cps_adminpasswords (adminid,password,date) values('". $result->userid ."','". $pass ."','". date("y-m-d") ."')";
					$db->query($sqlpassword);
					
					
					if($_REQUEST['submit2'] == 'Update and Close') {
						$location = 'home.php';
					} else{
							$location = 'edituserprint.php?do=edit&adminid='.$_REQUEST['adminid'];
					}	
					echo '{"status":"true", "loc":"'.$location.'"}';
					exit();	
				}
				else
				{
					echo '{"error":"true","msg":"New password cannot be same as last 3 password."}';
					exit();	
				}
			}
			else
			{
				echo '{"error":"true","msg":"Incorrect old password."}';
				exit();	
			}
		}
		if(isset($_REQUEST['txtnewpassword']) && !empty($_REQUEST['txtnewpassword']) && isset($_REQUEST['txtrenewpassword']) && !empty($_REQUEST['txtrenewpassword'])  && isset($_REQUEST['adminid']) && $_REQUEST['adminid'] != '') 
		{
			$updated_at=date('Y-m-d H:i:s');
			if($_REQUEST['txtnewpassword'] == $_REQUEST['txtrenewpassword'])
			{
				$sql_set = "update tb_printadmin set incorrect_attempt = 0, password_status = 1, password = '".md5($_REQUEST['txtrenewpassword'])."',updated_by='".$_SESSION['admin_id']."',updated_at = '".$updated_at."' where adminid = '".$_REQUEST['adminid']."'";
				$db->query($sql_set);
			}
			else
			{
				echo '{"error":"true","msg":"Password does not match."}';
				exit();	
			}
		}

		if(isset($_REQUEST['ddluserstatus'])){

			if($_REQUEST['ddluserstatus']==1){
			$updated_at=date('Y-m-d H:i:s');
			$sql_set = "update tb_printadmin set lastlogintime = '".$updated_at."',incorrect_attempt = 0, password_status = 1, user_status = '".$_REQUEST['ddluserstatus']."',updated_by='".$_SESSION['admin_id']."',updated_at = '".$updated_at."' where adminid = '".$_REQUEST['adminid']."'";
			
			}else{
			$updated_at=date('Y-m-d H:i:s');	
			$sql_set = "update tb_printadmin set user_status = '".$_REQUEST['ddluserstatus']."',updated_at = '".$updated_at."' where adminid = '".$_REQUEST['adminid']."'";
			}
				$db->query($sql_set);
		}

		if(isset($_REQUEST['ddlusergptype'])){

			$updated_at=date('Y-m-d H:i:s');
		
			$sql_set = "update tb_printadmin set user_type = '".$_REQUEST['ddlusergptype']."',updated_at = '".$updated_at."' where adminid = '".$_REQUEST['adminid']."'";
			$db->query($sql_set);
		}
		//else
		//{
			//$sql = "update tb_printadmin set user_type = '".$usertype."', group_id='".$groupid."', create_date='".$createdate."' where adminid = '".$_REQUEST['adminid']."'";
			//$db->query($sql);
			
			if($_REQUEST['submit2'] == 'Update and Close') {
				$location = 'home.php';
			} else{
					$location = 'edituserprint.php?do=edit&adminid='.$_REQUEST['adminid'];
			}	
			echo '{"status":"true", "loc":"'.$location.'"}';
			exit();
		//}
	}
	if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'deluser') && isset($_REQUEST['uid']) && ($_REQUEST['uid'] != ''))//
	{
		$db->query("delete from tb_printadmin where adminid  = ".$_REQUEST['uid']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
	}
	
?>

