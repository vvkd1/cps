<?php require_once('global.php');
	$un = $_REQUEST['txtusername'];
	$pass = md5($_REQUEST['txtpassword']);	
		
	if(isset($_REQUEST['txtusername']) && !empty($_REQUEST['txtusername']) && isset($_REQUEST['txtpassword']) && !empty($_REQUEST['txtpassword']) ) 
	{	
		$sql = "Insert into tb_reprintadmin (username,password,lastlogintime) values('". $un ."','". $pass ."','". date('Y-m-d') ."')";
		$db->query($sql);	
		echo '{"status":"true"}';
		exit();
	}
	else {
	echo '{"status":"false"}';
		exit();
	}
	
?>

