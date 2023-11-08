<?php require_once('../global.php');
			
	if(isset($_REQUEST['user0']) && !empty($_REQUEST['user0']) ) {
		$db->query("delete from tb_cps_groups");
		$db->query("delete from tb_cps_grouppermissions");
		for($i = 0; $i <= $_REQUEST['usercount']; $i++)
		{
			$un = "";
			$un = $_REQUEST['user'.$i];
			if($un != "")
			{
				$sql = "INSERT INTO tb_cps_groups (group_name,group_createddate) VALUES ('".$un."','".date('Y-m-d')."')";
				$db->query($sql);
			}
		}
		echo '{"status":"true"}';
		exit();		
	}
?>