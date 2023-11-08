<?php
require_once('global.php');

if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'del') && isset($_REQUEST['tid']) && !empty($_REQUEST['tid']) ) {
		$db->query("update tb_cps_transactioncodes SET transactionstatus = 1 where transactioncode_id = ".$_REQUEST['tid']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
		
}else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'add')) {
		if(isset($_REQUEST['txttransactioncodedescription']) && !empty($_REQUEST['txttransactioncodedescription']) && isset($_REQUEST['txttransactioncode']) && !empty($_REQUEST['txttransactioncode'])) {
			if($result = $db->get_results("Select * from tb_cps_transactioncodes where transactioncode = '".$_REQUEST['txttransactioncode']."'")){
				echo '{"error":"true", "htmlcontent":"Duplicate TR Code."}';
				$db->closeDb();
				exit();
			}
			else{
				$sql = "Insert into tb_cps_transactioncodes (transactioncodedescription,transactioncode) values('".$_REQUEST['txttransactioncodedescription']."','".$_REQUEST['txttransactioncode']."')";
				$db->query($sql);
				//echo '{"status":"true"}';
				//exit();
				if($_REQUEST['submit1'] == 'Save and Close') {
				$location = 'home.php';
				} else {
					$location = 'manage_transaction.php';
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
else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'edit') && isset($_REQUEST['tid']) && ($_REQUEST['tid'] != '')) {
		if(isset($_REQUEST['txttransactioncodedescription']) && !empty($_REQUEST['txttransactioncodedescription']) && isset($_REQUEST['txttransactioncode']) && !empty($_REQUEST['txttransactioncode'])) {
			if($result = $db->get_results("Select * from tb_cps_transactioncodes where transactioncode = '".$_REQUEST['txttransactioncode']."' and transactioncode_id  not in(".$_REQUEST['tid'].")")){
				echo '{"error":"true", "htmlcontent":"Duplicate TR Code."}';
				$db->closeDb();
				exit();
			}
			else{
				$sql = "update tb_cps_transactioncodes set transactioncodedescription = '".$_REQUEST['txttransactioncodedescription']."',transactioncode = '".$_REQUEST['txttransactioncode']."' where transactioncode_id = ".$_REQUEST['tid']."";
				$db->query($sql);
				//echo '{"status":"true"}';
				//exit();
				if($_REQUEST['submit1'] == 'Update and Close') {
				$location = 'home.php';
				} else {
					$location = 'manage_transaction.php';
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
if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'activate') && isset($_REQUEST['tid']) && !empty($_REQUEST['tid']) ) {
		$db->query("update tb_cps_transactioncodes SET transactionstatus = 0 where transactioncode_id = ".$_REQUEST['tid']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
		
}  

?>