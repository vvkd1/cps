<?php
require_once('global.php');

if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delsub') && isset($_REQUEST['suid']) && !empty($_REQUEST['suid']) ) {
		//$db->query("delete from tb_suburbmaster where suburb_id = ".$_REQUEST['suid']."");
		$db->query("update tb_suburbmaster set is_delete = 1 where suburb_id = ".$_REQUEST['suid']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
     }else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'add')) {
		if(isset($_REQUEST['txtsuburb']) && !empty($_REQUEST['txtsuburb'])) {
			if($result = $db->get_results("Select * from tb_suburbmaster where suburb_name = '".$_REQUEST['txtsuburb']."' and is_delete = 0")){
				echo '{"error":"true", "htmlcontent":"duplicat suburb"}';
				$db->closeDb();
				exit();	
			}
			else if($result = $db->get_results("Select * from tb_suburbmaster where suburb_postal_code = '".$_REQUEST['txtpostalcode']."' and is_delete = 0")){
				echo '{"error":"true", "htmlcontent":"duplicat postal code"}';
				$db->closeDb();
				exit();
			}
			else{
				
			    
				//$sql = "Insert into tb_citymaster (city_code,city_place,city_name_al,country_id,state_id) values('','".$_REQUEST['txtcityplace']."','','".$_REQUEST['ddlcountry']."','".$_REQUEST['ddlstate']."')";
				$sql = "Insert into tb_suburbmaster (suburb_code,suburb_name_al,suburb_name,suburb_postal_code,country_id,state_id,city_id,is_delete) values('','','".$_REQUEST['txtsuburb']."','".$_REQUEST['txtpostalcode']."','".$_REQUEST['ddlcountry']."','".$_REQUEST['ddlstate']."','".$_REQUEST['ddlcity']."',0)";
				$db->query($sql);
				
				$row = $db->get_row("SELECT max(suburb_id) AS suburb_id FROM tb_suburbmaster where is_delete = 0");
				$suburbid = $row->suburb_id;
								
				$suburbcode = array();
				$suburbcode = placecodemaker("tb_suburbmaster","suburb_name_al",$_REQUEST['txtsuburb']);
				
				$db->query("update tb_suburbmaster set suburb_code = '".$suburbcode['placecode'].$suburbcode['cid']."',suburb_name_al = '".$suburbcode['placecode']."' where suburb_id = ".$suburbid."");
				
				if($_REQUEST['submit1'] == 'Save and Close') {
				$location = 'home.php';
				} else {
					$location = 'edit_suburb.php?do=edit&suid='.$suburbid;
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
else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'edit') && isset($_REQUEST['suid']) && ($_REQUEST['suid'] != '')) {
		if(isset($_REQUEST['txtsuburb']) && !empty($_REQUEST['txtsuburb'])) {		
			if($result = $db->get_results("Select * from tb_suburbmaster where suburb_name = '".$_REQUEST['txtsuburb']."' and suburb_id not in (".$_REQUEST['suid'].") and is_delete = 0")){
				echo '{"error":"true", "htmlcontent":"duplicat suburb"}';
				$db->closeDb();
				exit();
			}
			else if($result = $db->get_results("Select * from tb_suburbmaster where suburb_postal_code = '".$_REQUEST['txtpostalcode']."' and suburb_id not in (".$_REQUEST['suid'].") and is_delete = 0")){
				echo '{"error":"true", "htmlcontent":"duplicat postal code"}';
				$db->closeDb();
				exit();
			}
			else{
			
				$suid = $_REQUEST['suid'];
				$subplace = strtoupper(substr($_REQUEST['txtsuburb'], 0, 3)); 
				$subplacecount = $db->get_row("SELECT SUBSTRING( suburb_code, 4, 6 ) as placeid FROM tb_suburbmaster where suburb_id = ".$_REQUEST['suid']." and is_delete = 0");
				$subcode = $subplace.$subplacecount->placeid; 
				
				$sql = "update tb_suburbmaster set suburb_postal_code = '".$_REQUEST['txtpostalcode']."',suburb_code = '".$subcode."',suburb_name = '".$_REQUEST['txtsuburb']."',country_id=".$_REQUEST['ddlcountry'].",state_id=".$_REQUEST['ddlstate'].",city_id='".$_REQUEST['ddlcity']."' where suburb_id = ".$_REQUEST['suid']."";
				$db->query($sql);
				
				if($_REQUEST['submit1'] == 'Update and Close') {
					$location = 'home.php';
				} else {
					$location = 'edit_suburb.php?do=edit&suid='.$_REQUEST['suid'];
				}
				echo '{"status":"true", "loc":"'.$location.'"}';
				exit();
				
				//$sql = "update tb_suburbmaster set suburb_name = '".$_REQUEST['txtsuburb']."',suburb_postal_code = '".$_REQUEST['txtpostalcode']."',country_id=".$_REQUEST['ddlcountry'].",state_id=".$_REQUEST['ddlstate'].",city_id=".$_REQUEST['ddlcity']." where suburb_id = ".$_REQUEST['suid']."";//
				//$db->query($sql);
				
				//if($_REQUEST['submit1'] == 'Update and Close') {
					//$location = 'home.php';
				//} else {
					//$location = 'manage_suburb.php';
				//}
				//echo '{"status":"true", "loc":"'.$location.'"}';
				//exit();		
			}			
		}
		else{
			echo '{"error":"true", "htmlcontent":"Something went wrong please try again."}';
			$db->closeDb();
			exit();
		}
}
if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'activate') && isset($_REQUEST['suid']) && !empty($_REQUEST['suid']) ) {
	$db->query("update tb_suburbmaster set is_delete = 0 where suburb_id = ".$_REQUEST['suid']."");
	echo '{"status":"true"}';
	$db->closeDb();
	exit();
}
if(isset($_GET["contid"])){
	if($_GET["contid"] != ""){
	$rowgetcountry =  $db->get_results("select * from tb_statemaster where country_id = ".$_GET["contid"]." and is_delete = 0");
		
	echo "<select name='ddlstate' id='ddlstate' style='width:190px; height:26px;' onchange='showCity(this.value)'>
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
}


if(isset($_GET["stateid"])){
	if($_GET["stateid"] != ""){
	$rowgetcity =  $db->get_results("select * from tb_citymaster where state_id = ".$_GET["stateid"]." and is_delete = 0");
	echo "<select name='ddlcity' id='ddlcity' style='width:190px; height:26px;' onchange='showSuburb(this.value)'>
	<option value=''> Select City</option>";
	foreach($rowgetcity as $eachcity){
		echo "<option value='". $eachcity->city_id ."'>".$eachcity->city_place."</option>";
	}
	echo "</select>";
}
else{
	echo "<select name='ddlcity' id='ddlcity' style='width:190px; height:26px;'>
	<option value=''> Select City </option>";
	echo "</select>";
}
}

if(isset($_GET["cityid"])){
	if($_GET["cityid"] != ""){
	$rowgetcity =  $db->get_results("select * from tb_suburbmaster where city_id = '".$_GET["cityid"]."' and is_delete = 0");
	echo "<select name='ddlsuburb' id='ddlsuburb' style='width:190px; height:26px;'>
	<option value=''> Select Suburb</option>";
	foreach($rowgetcity as $eachsuburb){
		echo "<option value='". $eachsuburb->suburb_id ."'>".$eachsuburb->suburb_name."</option>";
	}
	echo "</select>";
}
else{
	echo "<select name='ddlsuburb' id='ddlsuburb' style='width:190px; height:26px;'>
	<option value=''> Select Suburb </option>";
	echo "</select>";
}
}

?>