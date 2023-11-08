<?php require_once('../global.php');
	
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
		echo "<input type='text' name='txtpin' id='txtpin' style='width:150px;' value='".$rowpostalcode->suburb_postal_code ."' readonly='true' />";
		}
		else{
			echo "<input type='text' name='txtpin' id='txtpin' style='width:150px;' value='' readonly='true' />";
		}
	}
	
	//Make sure if bank table is empty.
	  
		

	if(isset($_REQUEST['txtbankname']) && $_REQUEST['txtbankname'] != "" ){
	// assign posted variable value to variables
	$sqldelete = "DELETE FROM tb_bankdetails";
	$db->query($sqldelete);
	$bankname = $_REQUEST['txtbankname'];
	//$bankcode = "BNK0001";
	$bankcode = $_REQUEST['txtbankcode'];
	$bankadd1 = $_REQUEST['branchaddress1'];
	$bankadd2 = $_REQUEST['branchaddress2'];
	$bankadd3 = $_REQUEST['branchaddress3'];
	$bankcountry = $_REQUEST['ddlcountry'];
	$bankstate = $_REQUEST['ddlstate'];
	$bankcity = $_REQUEST['ddlcity'];
	$banksuburb = $_REQUEST['ddlsuburb'];			
	$bankpin = $_REQUEST['txtpin'];
	$bankcontno1 = $_REQUEST['txtcontno1'];
	$bankcontno2 = $_REQUEST['txtcontno2'];
	$bankcontperson1 = $_REQUEST['txtcontper1'];
	$bankcontperson2 = $_REQUEST['txtcontper2'];
	$branchemail = $_REQUEST['txtemailid'];
	$bankwebsite = $_REQUEST['txtwebsite'];
	
	//inserting the data into tb_bankdetails table
	$namer_id = $db->query("INSERT INTO tb_bankdetails (bank_name,bank_code,bank_address1,bank_address2,bank_address3,bank_country_id,bank_state_id,bank_city_id,bank_suburb_id,bank_pin,bank_contact_no1,bank_contact_no2,bank_contact_per1,bank_contact_per2,bank_emailid,bank_website) value ('".$bankname."','".$bankcode."','".$bankadd1."','".$bankadd2."','".$bankadd3."','".$bankcountry."','".$bankstate."','".$bankcity."','".$banksuburb."','".$bankpin."','".$bankcontno1."','".$bankcontno2."','".$bankcontperson1."','".$bankcontperson2."','".$branchemail."','".$bankwebsite."')");
	echo '{"status":"true"}';
	$db->closeDb();
	exit();	
}
	
	
?>