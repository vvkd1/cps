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
	echo "<input type='text' name='branchpin' id='branchpin' style='width:190px;' value='".$rowpostalcode->suburb_postal_code ."' readonly='true' />";
}
else{
	echo "<input type='text' name='branchpin' id='branchpin' style='width:190px;' value='' readonly='true' />";
}
}

if(isset($_POST['txtAccNo']) && $_POST['txtAccNo'] != ""){	
		$accountNo = $_POST['txtAccNo'];		
		$accountName = $_REQUEST['txtAccName'];		
		$bearerOrder = $_POST['txtBearerOrder'];		
		$TRcode = $_POST['ddlTrCode'];		
		$atPar = $_POST['txtAtPar'];		
		$jointName1 = $_POST['txtJointName1'];
		$jointName2 = $_POST['txtJointName2'];
		$authSig1 = $_POST['ach_Authorized_Signatory1'];
		$authSig2 = $_POST['ach_Authorized_Signatory2'];
		$authSig3 = $_POST['ach_Authorized_Signatory3'];
		$add1 = $_POST['txtAdd1'];
		$add2 = $_POST['txtAdd1'];		
		$country = $_POST['ddlcountry'];
		$state = $_POST['ddlstate'];
		$city = $_POST['ddlcity'];
		$suburb = $_POST['ddlsuburb'];
		$pincode = $_POST['branchpin'];
		$resTelephone = $_POST['txtTelePhoneResidence'];
		$offTelephone = $_POST['txtTelePhoneOffice'];
		$mobileNo = $_POST['txtMobileNo'];
		$branch = $_POST['ddlBranch'];
		$email = $_POST['txtEmailId'];
		
		if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'edit') && isset($_REQUEST['ahid']) && ($_REQUEST['ahid'] != '')){
		
		// update query
		$namer_id = $db->query("UPDATE tb_accountholdermaster SET 
		ach_account_No = '".$accountNo."', 
		ach_account_Name = '".$accountName."',
		ach_Bearer_Order = '".$bearerOrder."',
		ach_Transaction_Code = '".$TRcode."',
		ach_At_Par = '".$atPar."',
		ach_Joint_Name1 = '".$jointName1."', 
		ach_Joint_Name2 = '".$jointName2."',
		ach_Authorized_Signatory1 = '".$authSig1."',
		ach_Authorized_Signatory2 = '".$authSig2."',
		ach_Authorized_Signatory3 = '".$authSig3."',
		ach_Address1 = '".$add1."', 
		ach_Address2 = '".$add2."',
		ach_Suburb = '".$suburb."',
		ach_City = '".$city."',
		ach_State = '".$state."',
		ach_Country = '".$country."',
		ach_Pincode = '".$pincode."',
		ach_Telephone_Residence = '".$resTelephone."',
		ach_Telephone_Office = '".$offTelephone."',
		ach_Branch = '".$branch."',
		ach_emailId = '".$email."',
		ach_Mobile_No = '".$mobileNo."' WHERE ach_Id = '".$_REQUEST['ahid']."'
		 ");
						 
		if($_POST['submit1'] == 'Save and Close') {
			$location = 'adminhome.php';
		} else {
			$location = 'manage_accountholder.php';
		}

		echo '{"status":"true", "loc":"'.$location.'"}';
		exit();	
	}
	else
	{
		//Insert Qry
		$sql = "INSERT INTO tb_accountholdermaster
				(ach_account_No,ach_account_Name,ach_Bearer_Order,ach_Transaction_Code,ach_At_Par,ach_Joint_Name1,ach_Joint_Name2,ach_Authorized_Signatory1,ach_Authorized_Signatory2,ach_Authorized_Signatory3,ach_Address1,ach_Address2,ach_Suburb,ach_City,ach_State,ach_Country,ach_Pincode,ach_Telephone_Residence,ach_Telephone_Office,ach_Mobile_No,ach_Branch,ach_emailId)
				VALUES
				('".$accountNo."','".$accountName."','".$bearerOrder."','".$TRcode."','".$atPar."','".$jointName1."','".$jointName2."','".$authSig1."','".$authSig2."','".$authSig3."','".$add1."','".$add2."','".$suburb."','".$city."','".$state."','".$country."','".$pincode."','".$resTelephone."','".$offTelephone."','".$mobileNo."','".$branch."','".$email."')";
				$db->query($sql);
				
											
				if($_POST['submit1'] == 'Save and Close') {
					$location = 'adminhome.php';
				} else {
					$location = 'manage_accountholder.php';
				}
				
				echo '{"status":"true", "loc":"'.$location.'"}';
				exit();	
	}
	}
	
	if(isset($_POST['do']) && ($_POST['do'] == 'delaccholder') && isset($_POST['ahid']) && !empty($_POST['ahid']) ) {
	$db->query("delete from tb_accountholdermaster where ach_Id  = ".$_POST['ahid']."");
	echo '{"status":"true"}';
	$db->closeDb();
	exit();
}	
		
?>