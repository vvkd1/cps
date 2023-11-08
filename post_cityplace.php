<?php
require_once('global.php');

if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delcity') && isset($_REQUEST['cid']) && !empty($_REQUEST['cid']) ) {
		//$db->query("delete from tb_citymaster where city_id = ".$_REQUEST['cid']."");
		$db->query("update tb_citymaster set is_delete = 1 where city_id = ".$_REQUEST['cid']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
}else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'add')) {
		if(isset($_REQUEST['txtcityplace']) && !empty($_REQUEST['txtcityplace'])) {
			if($result = $db->get_results("Select * from tb_citymaster where city_place = '".$_REQUEST['txtcityplace']."' and is_delete = 0")){			
				echo '{"error":"true", "htmlcontent":"Duplicate city place"}';
				$db->closeDb();
				exit();	
			}
			else{
				$sql = "Insert into tb_citymaster (city_code,city_place,city_name_al,country_id,state_id,is_delete) values('','".$_REQUEST['txtcityplace']."','','".$_REQUEST['ddlcountry']."','".$_REQUEST['ddlstate']."',0)";
				$db->query($sql);
				
				$row = $db->get_row("SELECT cast( max( cast( city_id AS CHAR ) ) AS char ) AS city_id FROM tb_citymaster where is_delete = 0");
				$cityid = $row->city_id;
								
				$citycode = array();
				$citycode = placecodemaker("tb_citymaster","city_name_al",$_REQUEST['txtcityplace']);
				
				$db->query("update tb_citymaster set city_code = '".$citycode['placecode'].$citycode['cid']."',city_name_al = '".$citycode['placecode']."' where city_id = ".$cityid."");
				
				if($_REQUEST['submit1'] == 'Save and Close') {
				$location = 'home.php';
				} else {
					$location = 'edit_cityplace.php?do=edit&cid='.$cityid;
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
		if(isset($_REQUEST['txtcityplace']) && !empty($_REQUEST['txtcityplace'])) {
				if($result = $db->get_results("Select * from tb_citymaster where city_place = '".$_REQUEST['txtcityplace']."' and city_id not in (".$_REQUEST['cid'].") and is_delete = 0")){	
				echo '{"error":"true", "htmlcontent":"Duplicate city place"}';
				$db->closeDb();
				exit();
			}
			else{				
				$cid = $_REQUEST['cid'];
				$cplace = strtoupper(substr($_REQUEST['txtcityplace'], 0, 3)); 
				$cityplacecount = $db->get_row("SELECT SUBSTRING( city_code, 4, 6 ) as placeid FROM tb_citymaster where city_id = ".$_REQUEST['cid']." and is_delete = 0");
				$citycode = $cplace.$cityplacecount->placeid; 
								
				$sql = "update tb_citymaster set city_code = '".$citycode."',city_place = '".$_REQUEST['txtcityplace']."',country_id=".$_REQUEST['ddlcountry'].",state_id=".$_REQUEST['ddlstate']." where city_id = ".$_REQUEST['cid']."";//
				$db->query($sql);
				
				if($_REQUEST['submit1'] == 'Update and Close') {
					$location = 'home.php';
				} else {
					$location = 'manage_cityplace.php';
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
if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'activate') && isset($_REQUEST['cid']) && !empty($_REQUEST['cid']) ) {
	$db->query("update tb_citymaster set is_delete = 0 where city_id = ".$_REQUEST['cid']."");
	echo '{"status":"true"}';
	$db->closeDb();
	exit();
}
if(isset($_GET["contid"]) && $_GET["contid"] != ""){
	$rowgetcountry =  $db->get_results("select * from tb_statemaster where country_id = ".$_GET["contid"]." and is_delete = 0");
		
	echo "<select name='ddlstate' id='ddlstate' style='width:190px; height:26px;'>
	<option value=''> Select State</option>";
	foreach($rowgetcountry as $eachcountry){
		echo "<option value='". $eachcountry->state_id ."'>".$eachcountry->state_name."</option>";
	}
	echo "</select>";
}
else{
	echo "<select name='ddlstate' id='ddlstate' style='width:190px; height:26px;'>
	<option value=''> Select State </option>";
	echo "</select>";
}

?>