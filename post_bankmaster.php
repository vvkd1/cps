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
	echo "<input type='text' name='txtpin' id='txtpin' style='width:255px;' value='".$rowpostalcode->suburb_postal_code ."' readonly='true' />";
}
else{
	echo "<input type='text' name='txtpin' id='txtpin' style='width:255px;' value='' readonly='true' />";
}
}

if(isset($_POST['txtbankname']) && $_POST['txtbankname'] != "" ){
	// assign posted variable value to variables
	$bankname = $_POST['txtbankname'];
	$bankcode = $_POST['txtbankcode'];
	$bankadd1 = $_POST['branchaddress1'];
	$bankadd2 = $_POST['branchaddress2'];
	$bankadd3 = $_POST['branchaddress3'];
	$bankcountry = $_POST['ddlcountry'];
	$bankstate = $_POST['ddlstate'];
	$bankcity = $_POST['ddlcity'];
	$banksuburb = $_POST['ddlsuburb'];			
	$bankpin = $_POST['txtpin'];
	$bankcontno1 = $_POST['txtMobile1'];
	$bankcontno2 = $_POST['txtMobile2'];
	$bankcontperson1 = $_POST['txtcontper1'];
	$bankcontperson2 = $_POST['txtcontper2'];	
	$bankcontnoLL1 = $_POST['txtLLCont1'];
	$bankcontnoLL2 = $_POST['txtLLCont2'];	
	$bankemail = $_POST['txtEmailCont1'];
	$bankemail2 = $_POST['txtEmailCont2'];	
	$bankwebsite = $_POST['txtwebsite'];
	
	$arrayPrinters=array();	
	foreach($_REQUEST['printername'] as $key=>$value)
	{
		$arrayPrinters[] = array($value,$_REQUEST['printertray1'][$key],$_REQUEST['printertray2'][$key]);
	}
	
	// update query 
	$namer_id = $db->query("update tb_bankdetails set 
	bank_name='".$bankname."', 
	bank_code='".$bankcode."',
	bank_address1='".$bankadd1."',
	bank_address2='".$bankadd2."',
	bank_address3='".$bankadd3."', 
	bank_country_id='".$bankcountry."',
	bank_state_id='".$bankstate."',
	bank_city_id='".$bankcity."',
	bank_suburb_id='".$banksuburb."',
	bank_pin = '".$bankpin."',	
	bank_contact_no1 = '".$bankcontno1."',
	bank_contact_no2 = '".$bankcontno2."',			
	bank_contact_per1='".$bankcontperson1."',
	bank_contact_per2='".$bankcontperson2."',	
	bank_contact_per_LL1='".$bankcontnoLL1."',
	bank_contact_per_LL2='".$bankcontnoLL2."',
	bank_emailid2='".$bankemail2."',	
	bank_emailid='".$bankemail."',
	bank_printers = '".serialize($arrayPrinters)."',
	bank_website='".$bankwebsite."'
	 ");	
		
	//echo '{"status":"true"}';
	//$db->closeDb();
	//exit();
	if($_POST['submit1'] == 'Save and Close') {
	$location = 'home.php';
	} else {
		$location = 'bankmaster.php';
	}
	
	echo '{"status":"true", "loc":"'.$location.'"}';
	exit();	
}

?>