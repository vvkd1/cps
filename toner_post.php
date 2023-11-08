<?php require_once('global.php');
	if($_POST)
	{
		if($_REQUEST['toner_leaves_capacity'] != "")
		{
			
					
					$sql = "UPDATE tb_cps_settings set toner_leaves_capacity='".$_REQUEST['toner_leaves_capacity']."'";
					$db->query($sql);
				
				
					if($_REQUEST['submit2'] == 'Update and Close') {
						$location = 'tonersetting.php';
					} else{
						$location = "tonersetting.php";
					}	
					echo '{"status":"true", "loc":"'.$location.'"}';
					exit();	
				
		}
	}

	
?>

