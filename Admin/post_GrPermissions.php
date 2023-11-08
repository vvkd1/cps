<?php
require_once('global.php');

if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delstate') && isset($_REQUEST['sid']) && !empty($_REQUEST['sid']) ) {
		//$db->query("delete from tb_statemaster where state_id = ".$_REQUEST['sid']."");
		$db->query("update tb_statemaster set is_delete = 1 where state_id = ".$_REQUEST['sid']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
}else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'add')) {
		if(isset($_REQUEST['txtstate']) && !empty($_REQUEST['txtstate'])) {
			if($result = $db->get_results("Select * from tb_statemaster where state_name = '".$_REQUEST['txtstate']."' and is_delete = 0")){		
				echo '{"error":"true", "htmlcontent":"Duplicate State Name."}';
				$db->closeDb();
				exit();
			}
			else{
				$countryid = ($_REQUEST['ddlcountry']);
				
				$sql = "Insert into tb_statemaster (state_code,state_name,state_name_al,country_id,is_delete) values('','".$_REQUEST['txtstate']."','','".$countryid."',0)";
				$db->query($sql);
				
				$row = $db->get_row("SELECT max( state_id ) AS state_id FROM tb_statemaster where is_delete = 0");
				$stateid = $row->state_id;
								
				$statecode = array();
				$statecode = placecodemaker("tb_statemaster","state_name_al",$_REQUEST['txtstate']);				
				$db->query("update tb_statemaster set state_code = '".$statecode['placecode'].$statecode['cid']."',state_name_al = '".$statecode['placecode']."' where state_id = ".$stateid."");
				
				if($_REQUEST['submit1'] == 'Save and Close') {
					$location = 'home.php';
				} else {
					$location = 'edit_state.php?do=edit&sid='.$stateid;
				}
				echo '{"status":"true", "loc":"'.$location.'"}';
				exit();
			}
		}
		else{
			echo '{"error":"true", "htmlcontent":"Something went wrong please try again."}';
			$db->closeDb();
			exit();
		}
}
else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'edit') && isset($_REQUEST['sid']) && ($_REQUEST['sid'] != '')) {
		if(isset($_REQUEST['txtstate']) && !empty($_REQUEST['txtstate'])) {	
			if($result = $db->get_results("Select * from tb_statemaster where state_name = '".$_REQUEST['txtstate']."' and state_id not in (".$_REQUEST['sid'].") and is_delete = 0")){		
				echo '{"error":"true", "htmlcontent":"Duplicate state"}';
				$db->closeDb();
				exit();
			}
			else{
			
				$countryid = $_REQUEST['ddlcountry'];
				$sid = $_REQUEST['sid'];
				$splace = strtoupper(substr($_REQUEST['txtstate'], 0, 3)); 
				
				$stateplacecount = $db->get_row("SELECT SUBSTRING( state_code, 4, 6 ) as placeid FROM tb_statemaster where state_id = ".$_REQUEST['sid']." and is_delete = 0");
				$statecode = $splace.$stateplacecount->placeid; 
				
				$sql = "update tb_statemaster set state_code = '".$statecode."',state_name_al = '".$splace."',state_name = '".$_REQUEST['txtstate']."',country_id = ".$countryid." where state_id = ".$_REQUEST['sid']."";
				$db->query($sql);
				
				if($_REQUEST['submit1'] == 'Update and Close') {
					$location = 'home.php';
				} else {
					$location = 'manage_state.php';
				}
				echo '{"status":"true", "loc":"'.$location.'"}';
				exit();
			}
		}
		else{
			echo '{"error":"true", "htmlcontent":"Something went wrong please try again."}';
			$db->closeDb();
			exit();
		}
}
else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'activate') && isset($_REQUEST['sid']) && !empty($_REQUEST['sid']) ) {
	$db->query("update tb_statemaster set is_delete = 0 where state_id = ".$_REQUEST['sid']."");
	echo '{"status":"true"}';
	$db->closeDb();
	exit();
}  

?>