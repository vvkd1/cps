<?php require_once('global.php');
	if($_POST)
	{
		if($_REQUEST['txtpassword'] != "")
		{
			$oldpassword = $_REQUEST['txtoldpassword'];
			$password = $_REQUEST['txtpassword'];	
			$checkoldpassword = "SELECT * FROM tb_printadmin WHERE password = '".md5($oldpassword)."' AND adminid = '".$_SESSION['admin_id']."' ";
			$result = $db->get_row($checkoldpassword);
			if(count($result)>0)
			{
				if(checkLastPassword(md5($password),$_SESSION["admin_userid"]))
				{
					$sql = "UPDATE tb_printadmin SET password = '".md5($password)."', is_temp_password = 1 WHERE adminid = '".$_SESSION['admin_id']."'";		
					$db->query($sql);
					
					$sqlpassword = "Insert into tb_cps_adminpasswords (adminid,password,date) values('". $_SESSION['admin_userid'] ."','". md5($password) ."','". date("y-m-d") ."')";
					$db->query($sqlpassword);		
				
					if($_REQUEST['submit1'] == 'Save') {
						session_destroy();
						$location = 'logout.php';
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
	}	
?>

