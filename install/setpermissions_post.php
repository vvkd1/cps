<?php require_once('../global.php');
	$un = $_REQUEST['username'];
	$pass = md5($_REQUEST['password']);	
	if(isset($_REQUEST['username']) && !empty($_REQUEST['username']) && isset($_REQUEST['password']) && !empty($_REQUEST['password']) ) {
		$sql = "INSERT INTO tb_printadmin (username,password,lastlogintime) VALUES ('".$un."','".mysql_real_escape_string($pass)."','".date('Y-m-d')."')";
		if($db->query($sql))
		{		
		  echo '{"status":"true"}';
		  exit();
		}
		else 
		{
			unset($sumbit);
			echo '{"status":"false", "htmlcontent":"Error Occured Please Try Again."}';
			exit();
		}
	}
?>