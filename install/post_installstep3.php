<?php require_once('../global.php');
	
	
	if(isset($_GET["contid"])){
		if($_GET["contid"] != ""){
		$rowgetcountry =  $db->get_results("select * from tb_statemaster where country_id = ".$_GET["contid"]." and is_delete = 0");
			
		echo "<select name='ddlstate' id='ddlstate' style='width:150px; height:26px;' onchange='showCity(this.value)'>
		<option value=''> Select State</option>";
		foreach($rowgetcountry as $eachcountry){
			echo "<option value='". $eachcountry->state_id ."'>".$eachcountry->state_name."</option>";
		}
		echo "</select>";
		}
		else{
		echo "<select name='ddlstate' id='ddlstate' style='width:150px; height:26px;'>
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
		echo "<select name='ddlsuburb' id='ddlsuburb' style='width:150px; height:26px;' onchange='showpostalcode(this.value)'>
		<option value=''> Select Suburb</option>";
		foreach($rowgetcity as $eachsuburb){
			echo "<option value='". $eachsuburb->suburb_id ."'>".$eachsuburb->suburb_name."</option>";
		}
		echo "</select>";
		}
		else{
			echo "<select name='ddlsuburb' id='ddlsuburb' style='width:150px; height:26px;'>
			<option value=''> Select Suburb </option>";
			echo "</select>";
		}
	}
	if(isset($_GET["suburbid"])){
		if($_GET["suburbid"] != ""){
		$rowpostalcode =  $db->get_row("select * from tb_suburbmaster where suburb_id = '".$_GET["suburbid"]."' and is_delete = 0");
		echo "<input type='text' name='branchpin' id='branchpin' style='width:150px;' value='".$rowpostalcode->suburb_postal_code ."' readonly='true' />";
		}
		else{
			echo "<input type='text' name='branchpin' id='branchpin' style='width:150px;' value='' readonly='true' />";
		}
	}
	
	
	
if(isset($_REQUEST['branchname']) && $_REQUEST['branchname'] != ""){

		
		//Empty Database related to branch.
		$sqldeletebranch = "DELETE FROM tb_branchdetails";
		$sqldeleteweekdays = "DELETE FROM tb_cps_weekdays";
		$sqldeletehalfdays = "DELETE FROM tb_cps_halfdays";
		$sqldeleteholidays = "DELETE FROM tb_cps_holidays";
		$sqldeletenonworkingdays = "DELETE FROM tb_cps_nonworkingdays";
		
		$db->query($sqldeletebranch);
		$db->query($sqldeleteweekdays);
		$db->query($sqldeletehalfdays);
		$db->query($sqldeleteholidays);
		$db->query($sqldeletenonworkingdays);
		
		//Store all post data in variables.
		$branchid = $_REQUEST['branchid'];
		$branchcode = $_REQUEST['branchcode'];
		$bankcode = $_REQUEST['bankcode'];
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
		
		// Update query 
				 
		$sql = "INSERT INTO tb_branchdetails
			(branch_name,branch_code,bank_code,branch_address1,branch_address2,branch_address3,branch_country_id,branch_state_id,branch_city_id,branch_suburb_id,branch_pin,branch_telephone1,branch_telephone2,branch_contactperson1,branch_contactperson2,branch_contactpersonmobile1,branch_contactpersonmobile2,branch_email1,branch_email2,branch_micr,branch_atparmicrcode,branch_neftifsccode,branch_clearingthrough,branch_clearingcenter,clr_bank_code,clr_bank_city)
			VALUES
			('".$branchname."','".$branchcode."','".$bankcode."','".$branchaddress1."','".$branchaddress2."','".$branchaddress3."','".$branchcountry."','".$branchstate."','".$branchcity."','".$branchsuburb."','".$branchpin."','".$branchtelephone1."','".$branchtelephone2."','".$branchcontper1."','".$branchcontper2."','".$branchmobilecontper1."','".$branchmobilecontper2."','".$branchemail1."','".$branchemail2."','".$branchmirc."','".$branchatpermirc."','".$branchNEFT."','".$branch_clearingthrough."','".$branch_clearingcenter."','".$branch_clearingbankcode."','".$branch_clearingcity."')";
		$branch_id = $db->query($sql,ARRAY_N,true);
			
		
		//Store all post data in variables for weekdays.
		$monday = (isset($_POST["chkWeekDays"]) && in_array("Mon",$_POST["chkWeekDays"])) ? "1" : "0";
		$tuesday = (isset($_POST["chkWeekDays"]) && in_array("Tue",$_POST["chkWeekDays"])) ? "1" : "0";
		$wednesday = (isset($_POST["chkWeekDays"]) && in_array("Wed",$_POST["chkWeekDays"])) ? "1" : "0";
		$thursday = (isset($_POST["chkWeekDays"]) && in_array("Thu",$_POST["chkWeekDays"])) ? "1" : "0";
		$friday = (isset($_POST["chkWeekDays"]) && in_array("Fri",$_POST["chkWeekDays"])) ? "1" : "0";
		$saturday = (isset($_POST["chkWeekDays"]) && in_array("Sat",$_POST["chkWeekDays"])) ? "1" : "0";
		$sunday = (isset($_POST["chkWeekDays"]) && in_array("Sun",$_POST["chkWeekDays"])) ? "1" : "0";
		$opening_time1 = $_POST["txtWeekDaysFrom1"];
		$opening_time2 = $_POST["txtWeekDaysFrom2"];
		$closing_time1 = $_POST["txtWeekDaysTo1"];
		$closing_time2 = $_POST["txtWeekDaysTo2"];

		$sqlinsertweekdays = "INSERT INTO tb_cps_weekdays
							(branch_id,monday,tuesday,wednesday,thursday,friday,saturday,sunday,opening_time1,opening_time2,closing_time1,closing_time2)
							VALUES
							('".$branch_id."','".$monday."','".$tuesday."','".$wednesday."','".$thursday."','".$friday."','".$saturday."','".$sunday."','".$opening_time1."','".$opening_time2."','".$closing_time1."','".$closing_time2."')
							";
		$db->query($sqlinsertweekdays);	

			
		//Store all post data in variables for halfdays.
		$monday = (isset($_POST["chkHalfDays"]) && in_array("Mon",$_POST["chkHalfDays"])) ? "1" : "0";
		$tuesday = (isset($_POST["chkHalfDays"]) && in_array("Tue",$_POST["chkHalfDays"])) ? "1" : "0";
		$wednesday = (isset($_POST["chkHalfDays"]) && in_array("Wed",$_POST["chkHalfDays"])) ? "1" : "0";
		$thursday = (isset($_POST["chkHalfDays"]) && in_array("Thu",$_POST["chkHalfDays"])) ? "1" : "0";
		$friday = (isset($_POST["chkHalfDays"]) && in_array("Fri",$_POST["chkHalfDays"])) ? "1" : "0";
		$saturday = (isset($_POST["chkHalfDays"]) && in_array("Sat",$_POST["chkHalfDays"])) ? "1" : "0";
		$sunday = (isset($_POST["chkHalfDays"]) && in_array("Sun",$_POST["chkHalfDays"])) ? "1" : "0";
		$opening_time1 = $_POST["txtHalfDaysFrom1"];
		$closing_time1 = $_POST["txtHalfDaysTo1"];
		

		$sqlinsertHalfdays = "INSERT INTO tb_cps_halfdays
							(branch_id,monday,tuesday,wednesday,thursday,friday,saturday,sunday,opening_time1,closing_time1)
							VALUES
							('".$branch_id."','".$monday."','".$tuesday."','".$wednesday."','".$thursday."','".$friday."','".$saturday."','".$sunday."','".$opening_time1."','".$closing_time1."')
							";
							
		$db->query($sqlinsertHalfdays);					
		
		//Store all post data in variables for Non working days.
		$monday = (isset($_POST["chkNonBankingDays"]) && in_array("Mon",$_POST["chkNonBankingDays"])) ? "1" : "0";
		$tuesday = (isset($_POST["chkNonBankingDays"]) && in_array("Tue",$_POST["chkNonBankingDays"])) ? "1" : "0";
		$wednesday = (isset($_POST["chkNonBankingDays"]) && in_array("Wed",$_POST["chkNonBankingDays"])) ? "1" : "0";
		$thursday = (isset($_POST["chkNonBankingDays"]) && in_array("Thu",$_POST["chkNonBankingDays"])) ? "1" : "0";
		$friday = (isset($_POST["chkNonBankingDays"]) && in_array("Fri",$_POST["chkNonBankingDays"])) ? "1" : "0";
		$saturday = (isset($_POST["chkNonBankingDays"]) && in_array("Sat",$_POST["chkNonBankingDays"])) ? "1" : "0";
		$sunday = (isset($_POST["chkNonBankingDays"]) && in_array("Sun",$_POST["chkNonBankingDays"])) ? "1" : "0";
		
		$sqlinsertNonWorkingDays = "INSERT INTO tb_cps_nonworkingdays
							(branch_id,monday,tuesday,wednesday,thursday,friday,saturday,sunday)
							VALUES
							('".$branch_id."','".$monday."','".$tuesday."','".$wednesday."','".$thursday."','".$friday."','".$saturday."','".$sunday."')
							";
		$db->query($sqlinsertNonWorkingDays);					
		
		
		//Store all post data in variables for Holidays.
		$monday = (isset($_POST["chkHoliDays"]) && in_array("Mon",$_POST["chkHoliDays"])) ? "1" : "0";
		$tuesday = (isset($_POST["chkHoliDays"]) && in_array("Tue",$_POST["chkHoliDays"])) ? "1" : "0";
		$wednesday = (isset($_POST["chkHoliDays"]) && in_array("Wed",$_POST["chkHoliDays"])) ? "1" : "0";
		$thursday = (isset($_POST["chkHoliDays"]) && in_array("Thu",$_POST["chkHoliDays"])) ? "1" : "0";
		$friday = (isset($_POST["chkHoliDays"]) && in_array("Fri",$_POST["chkHoliDays"])) ? "1" : "0";
		$saturday = (isset($_POST["chkHoliDays"]) && in_array("Sat",$_POST["chkHoliDays"])) ? "1" : "0";
		$sunday = (isset($_POST["chkHoliDays"]) && in_array("Sun",$_POST["chkHoliDays"])) ? "1" : "0";
		
		$sqlinsertHolidays = "INSERT INTO tb_cps_holidays
							(branch_id,monday,tuesday,wednesday,thursday,friday,saturday,sunday)
							VALUES
							('".$branch_id."','".$monday."','".$tuesday."','".$wednesday."','".$thursday."','".$friday."','".$saturday."','".$sunday."')
							";
		$db->query($sqlinsertHolidays);					
		
		echo '{"status":"true"}';
		$db->closeDb();
		exit();	
	} 
	 
		
?>