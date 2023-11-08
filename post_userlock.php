<?php require_once('global.php');
	$un = $_REQUEST['username'];
	$pass = md5($_REQUEST['password']);	
	if(isset($_REQUEST['username']) && !empty($_REQUEST['username']) && isset($_REQUEST['password']) && !empty($_REQUEST['password']) ) {			
		$sql="SELECT * FROM tb_printadmin WHERE username like binary '".mysql_real_escape_string($un)."' and password like binary '".mysql_real_escape_string($pass)."' and password_status = 1";
		$row_user = $db->get_row($sql);		
		$count = count($row_user);		
		if($count > 0) {
				$_SESSION['expire'] = time() + ($_SESSION['autolockminutes'] * 60);
				echo '{"status":"true"}';
			exit();
		}
		else {
			unset($sumbit);
			echo '{"error":"true", "htmlcontent":"Incorrect username or password or password expired."}';
			exit(0);
		}
	}
?>