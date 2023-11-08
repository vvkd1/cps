<?php require_once('../global.php');
	$un = $_REQUEST['username'];
	$pass = md5($_REQUEST['password']);	
	$createdate = date("Y-m-d");
	
	$cleardatabase = "DELETE FROM tb_printadmin";
	$db->query($cleardatabase);
	if(isset($_REQUEST['username']) && !empty($_REQUEST['username']) && isset($_REQUEST['password']) && !empty($_REQUEST['password']) ) {
		$sql = "INSERT INTO tb_printadmin (username,userid,password,lastlogintime,user_type,password_status,create_date,is_temp_password) VALUES ('".$un."','".$un."','".mysql_real_escape_string($pass)."','".date('Y-m-d')."',2,1,'".$createdate."',1)";
		//echo $sql;
		//die();		
		$db->query($sql);
	echo '{"status":"true"}';
	exit;
	}
?>