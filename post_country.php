<?php
require_once('global.php');

if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delcountry') && isset($_REQUEST['cid']) && !empty($_REQUEST['cid']) ) {
		$db->query("delete from tb_countrymaster where country_id = ".$_REQUEST['cid']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
		
}else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'add')) {
		if(isset($_REQUEST['txtcountryname']) && !empty($_REQUEST['txtcountryname']) && isset($_REQUEST['txtcountrycode']) && !empty($_REQUEST['txtcountrycode'])) {
			if($result = $db->get_results("Select * from tb_countrymaster where country_code = '".$_REQUEST['txtcountrycode']."'")){
				echo '{"error":"true", "htmlcontent":"Duplicate Country Code."}';
				$db->closeDb();
				exit();
			}
			else if($result = $db->get_results("Select * from tb_countrymaster where country_name = '".$_REQUEST['txtcountryname']."'")){
				echo '{"error":"true", "htmlcontent":"Duplicate Country Name."}';
				$db->closeDb();
				exit();
			}
			else{
				$sql = "Insert into tb_countrymaster (country_name,country_code) values('".$_REQUEST['txtcountryname']."','".$_REQUEST['txtcountrycode']."')";
				$db->query($sql);
				//echo '{"status":"true"}';
				//exit();
				if($_REQUEST['submit1'] == 'Save and Close') {
				$location = 'home.php';
				} else {
					$location = 'manage_country.php';
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
else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'edit') && isset($_REQUEST['cid']) && ($_REQUEST['cid'] != '')) {
		if(isset($_REQUEST['txtcountryname']) && !empty($_REQUEST['txtcountryname']) && isset($_REQUEST['txtcountrycode']) && !empty($_REQUEST['txtcountrycode'])) {
			if($result = $db->get_results("Select * from tb_countrymaster where country_code = '".$_REQUEST['txtcountrycode']."' and country_id  not in(".$_REQUEST['cid'].")")){
				echo '{"error":"true", "htmlcontent":"Duplicate Country Code."}';
				$db->closeDb();
				exit();
			}
			else if($result = $db->get_results("Select * from tb_countrymaster where country_name = '".$_REQUEST['txtcountryname']."' and country_id  not in(".$_REQUEST['cid'].")")){
				echo '{"error":"true", "htmlcontent":"Duplicate Country Name."}';
				$db->closeDb();
				exit();
			}
			else{
				$sql = "update tb_countrymaster set country_name = '".$_REQUEST['txtcountryname']."',country_code = '".$_REQUEST['txtcountrycode']."' where country_id = ".$_REQUEST['cid']."";
				$db->query($sql);
				//echo '{"status":"true"}';
				//exit();
				if($_REQUEST['submit1'] == 'Update and Close') {
				$location = 'home.php';
				} else {
					$location = 'manage_country.php';
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