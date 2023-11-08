<?php require_once('global.php');

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
	echo "<select name='ddlsuburb' id='ddlsuburb' style='width:190px; height:26px;' onchange='showpostalcode(this.value)'>
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
if(isset($_GET["suburbid"])){
	if($_GET["suburbid"] != ""){
	$rowpostalcode =  $db->get_row("select * from tb_suburbmaster where suburb_id = '".$_GET["suburbid"]."' and is_delete = 0");
	echo "<input type='text' name='branchpin' id='branchpin' style='width:190px;' value='".$rowpostalcode->suburb_postal_code ."' readonly='true' />";
}
else{
	echo "<input type='text' name='branchpin' id='branchpin' style='width:190px;' value='' readonly='true' />";
}
}

if(isset($_REQUEST['branchname']) && $_REQUEST['branchname'] != ""){	
		$branch_id = $_REQUEST['branchid'];
		$branchname = $_REQUEST['branchname'];
		$branchaddress1 = $_REQUEST['branchaddress1'];
		$branchaddress2 = $_REQUEST['branchaddress2'];
		$branchaddress3 = $_REQUEST['branchaddress3'];
		$branchcountry = $_REQUEST['ddlcountry'];
		$branchstate = $_REQUEST['ddlstate'];
		$branchcity = $_REQUEST['ddlcity'];
		$branchsuburb = $_REQUEST['ddlsuburb'];
		$branchpin = $_REQUEST['branchpin'];
		$branchtelephone1 = $_REQUEST['branchtelephone1'];
		$branchtelephone2 = $_REQUEST['branchtelephone2'];
		$branchcontper1 = $_REQUEST['branchcontact1'];
		$branchcontper2 = $_REQUEST['branchcontact2'];
		$branchmobilecontper1 = $_REQUEST['branchcontactmobile1'];
		$branchmobilecontper2 = $_REQUEST['branchcontactmobile2'];
		$branchemail1 = $_REQUEST['branchemail1'];
		$branchemail2 = $_REQUEST['branchemail2'];
		$branchmirc = $_REQUEST['branchmirc'];
		$branchatpermirc = $_REQUEST['branchatpermirc'];
		$branchNEFT = $_REQUEST['branchNEFT'];
		$branch_clearingthrough = $_REQUEST['radClearing'];
		$branch_clearingcenter = $_REQUEST['radClearingcentre'];
		$branch_clearingbankcode = $_REQUEST['txtclrbankcode'];
		$branch_clearingcity = $_REQUEST['ddlclrcity'];
		$branchcode = $_REQUEST['branchcode'];
		$cityCode = $_REQUEST['cityCode'];
		$branchServices = $_REQUEST['branchservices'];

		$branchregbusihrs = $_REQUEST['branchregbusihrs'];
		$branchhalfbusihrs = $_REQUEST['branchhalfbusihrs'];
		$branchsundayworking = $_REQUEST['branchsundayworking'];
		$branchtollfreeno = $_REQUEST['branchtollfreeno'];
		
// ===================================================== update query ===================================================
		
		if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'edit') && isset($_REQUEST['brid']) && ($_REQUEST['brid'] != '')){		
			$namer_id = $db->query("UPDATE tb_branchdetails SET 
			branch_name = '".$branchname."', 
			branch_code = '".$branchcode."',
			branch_City_Code = '".$cityCode."',
			branch_address1 = '".$branchaddress1."',
			branch_address2 = '".$branchaddress2."',
			branch_address3 = '".$branchaddress3."',
			branch_country_id = '".$branchcountry."', 
			branch_state_id = '".$branchstate."',
			branch_city_id = '".$branchcity."',
			branch_suburb_id = '".$branchsuburb."',
			branch_pin = '".$branchpin."',
			branch_telephone1 = '".$branchtelephone1."', 
			branch_telephone2 = '".$branchtelephone2."',
			branch_contactperson1 = '".$branchcontper1."',
			branch_contactperson2 = '".$branchcontper2."',
			branch_contactpersonmobile1 = '".$branchmobilecontper1."',
			branch_contactpersonmobile2 = '".$branchmobilecontper2."',
			branch_email1 = '".$branchemail1."',
			branch_email2 = '".$branchemail2."',
			branch_micr = '".$branchmirc."',
			branch_atparmicrcode = '".$branchatpermirc."',
			branch_neftifsccode = '".$branchNEFT."',
			branch_clearingthrough = '".$branch_clearingthrough."',
			branch_clearingcenter = '".$branch_clearingcenter."',
			clr_bank_code = '".$branch_clearingbankcode."',
			branch_Services = '".$branchServices."',
			branch_reg_busi_hrs = '".$branchregbusihrs."',
			branch_half_busi_hrs = '".$branchhalfbusihrs."',
			branch_sunday_working = '".$branchsundayworking."',
			branch_tollfree_no = '".$branchtollfreeno."',
			clr_bank_city = '".$branch_clearingcity."' WHERE branch_id = '".$_REQUEST['brid']."'
		 ");
			
		if($_REQUEST['submit1'] == 'Save and Close') {
			$location = 'home.php';
		} else {
			$location = 'add_branch.php';
		}
		echo '{"status":"true", "loc":"'.$location.'"}';
		exit();	
		
	}
	else
	{
		// =========================================== Insert query ===================================================

		$sql = "INSERT INTO tb_branchdetails
				(branch_name,branch_code,branch_address1,branch_address2,branch_address3,branch_country_id,branch_state_id,branch_city_id,branch_suburb_id,branch_pin,branch_telephone1,branch_telephone2,branch_contactperson1,branch_contactperson2,branch_contactpersonmobile1,branch_contactpersonmobile2,branch_email1,branch_email2,branch_micr,branch_atparmicrcode,branch_neftifsccode,branch_clearingthrough,branch_clearingcenter,clr_bank_code,clr_bank_city,branch_City_Code,branch_Services, branch_reg_busi_hrs,branch_half_busi_hrs,branch_sunday_working,branch_tollfree_no)     
				VALUES
				('".$branchname."','".$branchcode."','".$branchaddress1."','".$branchaddress2."','".$branchaddress3."','".$branchcountry."','".$branchstate."','".$branchcity."','".$branchsuburb."','".$branchpin."','".$branchtelephone1."','".$branchtelephone2."','".$branchcontper1."','".$branchcontper2."','".$branchmobilecontper1."','".$branchmobilecontper2."','".$branchemail1."','".$branchemail2."','".$branchmirc."','".$branchatpermirc."','".$branchNEFT."','".$branch_clearingthrough."','".$branch_clearingcenter."','".$branch_clearingbankcode."','".$branch_clearingcitycenter."','".$cityCode."','".$branchServices."','".$branchregbusihrs."','".$branchhalfbusihrs."','".$branchsundayworking."','".$branchtollfreeno."')";
				$branch_id = $db->query($sql,ARRAY_N,true); 
				if($_REQUEST['submit1'] == 'Save and Close') {
					$location = 'home.php';
				} else {
					$location = 'add_branch.php';
				}
				echo '{"status":"true", "loc":"'.$location.'"}';
				exit();	
	}
	}
	
	if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delbranch') && isset($_REQUEST['brid']) && !empty($_REQUEST['brid']) ) {
	$db->query("delete from tb_branchdetails where branch_id  = ".$_REQUEST['brid']."");
	echo '{"status":"true"}';
	$db->closeDb();
	exit();
}	
		
?>