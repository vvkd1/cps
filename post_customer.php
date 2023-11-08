<?php
require_once('global.php');

if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delsub') && isset($_REQUEST['cust_id']) && !empty($_REQUEST['cust_id']) ) {
		//$db->query("delete from tb_customer where cust_id = ".$_REQUEST['cust_id']."");
		$db->query("delete from tb_customer where cust_id = ".$_REQUEST['cust_id']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
}else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'add')) {
		if(isset($_REQUEST['txtcustname']) && !empty($_REQUEST['txtcustname'])) {
			if($result = $db->get_results("Select * from tb_customer where cust_name = '".$_REQUEST['txtcustname']."' OR cust_short_name = '".$_REQUEST['txtcustname']."'")){
				echo '{"error":"true", "htmlcontent":"duplicat customer"}';
				$db->closeDb();
				exit();
			}else{
				$sql = "Insert into tb_customer (cust_name,cust_short_name,cust_address,cust_acc_no) values('".$_REQUEST['txtcustname']."','".$_REQUEST['txtcustshortname']."','".$_REQUEST['txtadd']."','".$_REQUEST['txtaccno']."')";
				$db->query($sql);
				
				$row = $db->get_row("SELECT max(cust_id) AS cust_id FROM tb_customer");
				$suburbid = $row->cust_id;
					
				if($_REQUEST['submit1'] == 'Save and Close') {
				$location = 'home.php';
				} else {
					$location = 'edit_customer.php?do=edit&cust_id='.$suburbid;
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
else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'edit') && isset($_REQUEST['cust_id']) && ($_REQUEST['cust_id'] != '')) {
		if(isset($_REQUEST['txtcustname']) && !empty($_REQUEST['txtcustname'])) {		
			if($result = $db->get_results("Select * from tb_customer where cust_name = '".$_REQUEST['txtcustname']."' and cust_id not in (".$_REQUEST['cust_id'].")")){
				echo '{"error":"true", "htmlcontent":"duplicat customer"}';
				$db->closeDb();
				exit();
			}
			else{
				$cust_id = $_REQUEST['cust_id'];
				$sql = "update tb_customer set cust_name = '".$_REQUEST['txtcustname']."',cust_short_name = '".$_REQUEST['txtcustshortname']."',cust_acc_no = '".$_REQUEST['txtaccno']."',cust_address='".$_REQUEST['txtadd']."' where cust_id = '".$_REQUEST['cust_id']."'";
				$db->query($sql);
				
				if($_REQUEST['submit1'] == 'Update and Close') {
					$location = 'home.php';
				} else {
					$location = 'edit_customer.php?do=edit&cust_id='.$_REQUEST['cust_id'];
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


?>