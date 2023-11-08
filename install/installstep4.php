<?php  
require_once('../global.php');
//$row_settings = $db->get_row("select * from tb_cps_settings");//SELECT DATE_FORMAT(license_install_date, '%d/%m/%Y' )  from tb_cps_settings
$row_settings = $db->get_row("select inputfolderpath,archivefolderpath,inputfileformat,inputfiledelimiter,outputfolderpath,outputfileformat,outputfiledelimiter,typeofprinter,printermodel,chk_taken_from,chk_no_from,chk_no_to,nooffailedpasswordattempt,password_expiry,homescreen_text,poweredby,banklogo,country,help_employeeid,help_helplineno1,help_emailid,autolockminutes,help_contactperson,help_helplineno2,license_type,DATE_FORMAT(license_install_date, '%d/%m/%Y' ) as license_install_date,license_period,DATE_FORMAT(license_end_date, '%d/%m/%Y' ) as license_end_date,license_no_of_users,license_cheque_leaves,license_users_leaves,license_users_leaves_value from tb_cps_settings");//SELECT DATE_FORMAT(license_install_date, '%d/%m/%Y' )  from tb_cps_settings

if(count($row_settings)<0)
{
	$row_settings = (object) array ( "inputfolderpath" => "","archivefolderpath" =>  "","inputfileformat" =>  "","inputfiledelimiter" => "","outputfolderpath" => "","outputfileformat" =>  "","outputfiledelimiter" => "","typeofprinter" =>  "","printermodel" =>  "","chk_taken_from" =>  "","chk_no_from" =>  "","chk_no_to" =>  "","nooffailedpasswordattempt" =>  "","password_expiry" =>  "","homescreen_text" =>  "","poweredby" =>  "","banklogo" => "","country" =>  "","help_employeeid" =>  "","help_helplineno1" =>  "","help_emailid" =>  "","autolockminutes" =>  "","help_contactperson" =>  "","help_helplineno2" =>  "","license_type" => "","license_install_date" =>  "","license_period" =>  "","license_end_date" =>  "","license_no_of_users" =>  "","license_cheque_leaves" => "" );
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
<?php include('../includes.php'); ?>
<script type="text/javascript">
	var vRules = {txtInputFolder: { required:true }, txtOutputFolder: { required:true },txtArchiveFolder: { required:true },ddlLicensetype: { required:true }, ddlTypeOfPrinter: { required:true }, ddlTypeOfPrinterModel: { required:true }, txthelp_emailid: { email:true }};
	var vMessages = {txtInputFolder: { required: "<br/>Please enter input folder name." }, txtOutputFolder: { required: "<br/>Please enter output folder name." }, txtArchiveFolder: { required: "<br/>Please enter archive folder name." }, ddlLicensetype: { required: "<br/>Please select license type." }, ddlTypeOfPrinter: { required: "<br/>Please select printer brand." }, ddlTypeOfPrinterModel: { required: "<br/>Please select printer model." },txthelp_emailid:{email:"<br>Please enter correct email id</br>"}};
	$(document).ready(function() {
		$('#response,#ajax_loading,.loading').hide();
		$('#submit').button();
		
		$('#install_date').datepicker({changeMonth: true, changeYear: true, showButtonPanel: false, yearRange:'-70:+10', minDate: null, dateFormat: 'mm/dd/yy' });
		$('#txtdateofinstallyearly').datepicker({changeMonth: true, changeYear: true, showButtonPanel: false, yearRange:'-70:+10', minDate: null, dateFormat: 'dd/mm/yy' });
		$('#txtdateofinstallonetime').datepicker({changeMonth: true, changeYear: true, showButtonPanel: false, yearRange:'-70:+10', minDate: null, dateFormat: 'dd/mm/yy' });
		$('#txtdateofinstallrevenue').datepicker({changeMonth: true, changeYear: true, showButtonPanel: false, yearRange:'-70:+10', minDate: null, dateFormat: 'dd/mm/yy' });
				
		$('#frmSettings').validate({
			rules: vRules,
			messages: vMessages,
			submitHandler: function(form) {
				$('#frmSettings').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
						formData.push({ "name": "type", "value": "json" });
						$('.loading').show();
					}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
						if (resObj.status) {
								window.location = 'installstep6.php';
						} else {	
							$('.loading').hide();
							$('#response').html('<div class="errormsg_boundary" width="100%">'+resObj.htmlcontent+'<div>').show();
						}
					}
				});
			}
		});
	});
	
</script>

<script type="text/javascript">

	function licensctype(gettype){		
		if(gettype == "yearly"){
			document.getElementById("divyearly").style.display = "block"
			document.getElementById("divonetime").style.display = "none"
			document.getElementById("divrevinue").style.display = "none"
		}
		else if(gettype == "onetime"){
			document.getElementById("divyearly").style.display = "none"
			document.getElementById("divonetime").style.display = "block"
			document.getElementById("divrevinue").style.display = "none"
		}
		else if(gettype == "revenue"){
			document.getElementById("divyearly").style.display = "none"
			document.getElementById("divonetime").style.display = "none"
			document.getElementById("divrevinue").style.display = "block"
		}
	}
	
	function calclicenseperiod(){
		var instlndate = document.getElementById("txtdateofinstallyearly").value;
		if(instlndate != ""){
			
			var input = instlndate;
            var datePart = input.match(/\d+/g); 
            var day = datePart[0] 
            var month = datePart[1] 
            var year = datePart[2]; 
            var ddmmyy =  month + '/' + day + '/' + year;
			
			var totaldays = document.getElementById("ddllicenseperiod").value * 365 - 1;
			var myDate = new Date(ddmmyy);
			myDate.setDate(myDate.getDate() + totaldays);
			var curr_date = myDate.getDate();
			var curr_month = myDate.getMonth()+1;
			var curr_year = myDate.getFullYear();
			
			if(curr_date >= 1 && curr_date <= 9)
				curr_date = "0"+curr_date;
				
			if(curr_month >= 1 && curr_month <= 9)
				curr_month = "0"+curr_month;
				
			document.getElementById("txtlicenseupto").value =   curr_date + "/" + curr_month + "/" + curr_year;
		}
	}
	
	function calclicenseperiodforonetime(){
		var instlndate = document.getElementById("txtdateofinstallonetime").value;
		if(instlndate != ""){
		
			var input = instlndate;
            var datePart = input.match(/\d+/g); 
            var day = datePart[0] 
            var month = datePart[1] 
            var year = datePart[2]; 
            var ddmmyy =  month + '/' + day + '/' + year;
					
			var totaldays = 364;
			var myDate = new Date(ddmmyy);
			myDate.setDate(myDate.getDate() + totaldays);
			var curr_date = myDate.getDate();
			var curr_month = myDate.getMonth()+1;
			var curr_year = myDate.getFullYear();
			
			if(curr_date >= 1 && curr_date <= 9)
				curr_date = "0"+curr_date;
				
			if(curr_month >= 1 && curr_month <= 9)
				curr_month = "0"+curr_month;
						
			document.getElementById("txtlicenseuptoonetime").value =   curr_date + "/" + curr_month + "/" + curr_year;
		}
	}
	
	
	
</script>

<SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			alert("Only numbers allowed");
            return false;
		}

         return true;
      }
	  
	  function isNumberKey1(evt)
      {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			return true;
		}
		else
		{
			alert("Only Characters allowed");
			return false;
		}
      }
      //-->
   </SCRIPT>

</head>

<body>

<div id="topdivlogo">
<div id="titlediv">Cheque Personalization System</div>
</div>
<div id="innerpage-maindiv">
<div class="clear">&nbsp;</div>
<div class="middle-maindiv">
<div class="middlesubdiv">
<div id="formdiv">
<div id="formheading">CPS Parameters</div>
<div id="formfields">
<form id="frmSettings" name="frmSettings" action="post_installstep4.php" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0"
	style="border: 1px solid; border-color: #cccccc;">
	<tr>
		<td align="left" valign="top" style="padding-left: 16px; padding-top: 16px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="15%" height="35" align="left" valign="top"><label>Input
					File Format</label></td>
					<td width="85%" align="left" valign="top">
						<select name="ddlFileFormat" id="ddlFileFormat" style="width: 220px;" onChange="setdelimitersetting(this.value,'divddlInputDelimiter');" >
							<option value = "Excel" <?php if($row_settings->inputfileformat=="Excel") echo "selected=selected"; ?> >Excel</option>
							<option value = "CSV" <?php if($row_settings->inputfileformat=="CSV") echo "selected=selected"; ?>>CSV</option>
						</select>
					</td>
				</tr>
				<tr>
					<td height="35" align="left" valign="top"><label>Output File Format</label></td>
					<td align="left" valign="top">
						<select name="ddlOutputFileFormat" id="ddlOutputFileFormat" style="width: 220px;" onChange="setdelimitersetting(this.value,'divddlOutputDelimiter');" >
							<option value = "Excel" <?php if($row_settings->outputfileformat=="Excel") echo "selected=selected"; ?>>Excel</option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td height="35" align="left" valign="top"><label>Archive Folder</label></td>
					<td align="left" valign="top">
						<!--<input type="text" name="txtArchiveFolder" id="txtArchiveFolder" style="width: 220px;" maxlength="100" value="<?php //echo $row_settings->archivefolderpath; ?>" />&nbsp;<label>(Ex. D:\Folder Name\)</label>-->
						<input type="text" name="txtArchiveFolder" id="txtArchiveFolder" style="width: 220px;" readonly="true" maxlength="100" value="uploads/" />&nbsp;<label>(Ex. D:\Folder Name\)</label>
					</td>
				</tr>
				
				
				<tr>
					<td align="left" valign="top" height="35px" width="20%">
						<label>Cheque Serial No Generation</label>
					</td>
					<td class="name"  valign="top" height="35px">
						<input type="radio" name="chk1" selected="true" <?php if($row_settings->chk_taken_from == "0" ){echo "checked";} ?> checked value="0" onClick="showchkno('bank')" >Bank generated<br/>
						<input type="radio" name="chk1" value="1" <?php if($row_settings->chk_taken_from == "1" ){echo "checked";} ?> onClick="showchkno('chkno')">System generated	(Different series for all transaction codes)<br/><br										
					</td>
				</tr>
				
				<tr>
					<td height="35" align="left" valign="top"><label>No of failed password attempt</label></td>
					<td align="left" valign="top">
						<input type="text" name="txtnooffailedpasswordattempt" id="txtnooffailedpasswordattempt" style="width: 20px;" value="<?php if($row_settings->nooffailedpasswordattempt != ""){echo $row_settings->nooffailedpasswordattempt;}else{echo "3";} ?>" maxlength="2" onkeypress="return isNumberKey(event)"  />&nbsp;<label>(Password will automatically expire after it.)</label>
					</td>
				</tr>
				
				<tr>
					<td height="35" align="left" valign="top"><label>Password Expire</label></td>
					<td align="left" valign="top">
						<input type="text" name="txtpasswordexpiry" id="txtpasswordexpiry" style="width: 25px;" value="<?php echo $row_settings->password_expiry; ?>" maxlength="3" onkeypress="return isNumberKey(event)"  />&nbsp;<label>(In days)</label>
					</td>
				</tr>
				
				<tr>
					<td height="35" align="left" valign="top"><label>Home Screen Text</label></td>
					<td align="left" valign="top">
						<input type="text" name="txthomescreen_text" id="txthomescreen_text" style="width: 220px;" maxlength="100" value = "<?php echo $row_settings->homescreen_text; ?>"  />&nbsp;<label> (Text to show on home page)</label>
					</td>
				</tr>
				<tr>
					<td height="35" align="left" valign="top"><label>Auto Lock</label></td>
					<td align="left" valign="top">
						<input type="text" name="txtautolockminutes" id="txtautolockminutes" style="width: 50px;" maxlength="5" onkeypress="return isNumberKey(event)" value = "<?php echo $row_settings->autolockminutes; ?>" />&nbsp;<label> (Minutes after login user will be logged out.)</label>
					</td>
				</tr>
				<tr>
					<td height="35" align="left" valign="top"><label>Powered by</label></td>
					<td align="left" valign="top">
						<input type="text" name="txtpoweredby" id="txtpoweredby" style="width: 220px;" maxlength="50" value = "<?php echo $row_settings->poweredby; ?>" />&nbsp;<label> </label>
					</td>
				</tr>
				<tr>
					<td height="35" align="left" valign="top"><label>Image Logo</label><span class="red">*</span></td>
					<td align="left" valign="top">
						<input type="file" name="banklogo" id="banklogo" /> 
					</td>
				</tr>
				
				<tr>
					<td height="35" align="left" valign="top"><label>Select Default Country</label></td>
					<td align="left" valign="top">
						<select name="ddlcountry" id="ddlcountry" style="width:190px; height:26px;" >
							<option value="0"> Select Country</option>
							<?php 
								
								$rowgetcountry =  $db->get_results("select * from tb_countrymaster");
								foreach($rowgetcountry as $eachcountry){
							?>
								<option value="<?php echo $eachcountry->country_id; ?>" <?php if(stripslashes($eachcountry->country_id)== $row_settings->country){echo "Selected";} ?> ><?php echo $eachcountry->country_name; ?></option>
							<?php 
								} 
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
					&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<label><h3>HelpLine</h3></label>
					<hr/>
					
					</td>
				</tr>
				<tr>
					<td>
					&nbsp;
					</td>
				</tr>
				
				<tr>
					<td height="35" align="left" valign="top"><label>Contact Person</label></td>
					<td align="left" valign="top">
						<input type="text" name="txthelp_contactperson" id="txthelp_contactperson" style="width: 220px;" maxlength="50" onKeyUp="javascript:this.value=this.value.toUpperCase();" onkeypress="return isNumberKey1(event)" value = "<?php echo $row_settings->help_contactperson; ?>" />&nbsp;<label> </label>
					</td>
				</tr>
				<tr>
					<td height="35" align="left" valign="top"><label>Helpline No 1</label></td>
					<td align="left" valign="top">
						<input type="text" name="txthelp_helplineno1" id="txthelp_helplineno1" style="width: 220px;" maxlength="15" value = "<?php echo $row_settings->help_helplineno1; ?>" onkeypress="return isNumberKey(event)" />&nbsp;<label> </label>
					</td>
				</tr>
				<tr>
					<td height="35" align="left" valign="top"><label>Helpline No 2</label></td>
					<td align="left" valign="top">
						<input type="text" name="txthelp_helplineno2" id="txthelp_helplineno2" style="width: 220px;" maxlength="15" value = "<?php echo $row_settings->help_helplineno2; ?>" onkeypress="return isNumberKey(event)"  />&nbsp;<label> </label>
					</td>
				</tr>
				<tr>
					<td height="35" align="left" valign="top"><label>Email ID</label></td>
					<td align="left" valign="top">
						<input type="text" name="txthelp_emailid" id="txthelp_emailid" style="width: 220px;" maxlength="50" value = "<?php echo $row_settings->help_emailid; ?>" />&nbsp;<label> </label>
					</td>
				</tr>
				<tr>
					<td>
					&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<label><h3>License</h3></label>
					<hr/>
					</td>
				</tr>
				<tr>
					<td>
					&nbsp;
					</td>
				</tr>
				<tr>
					<td height="35" align="left" valign="top"><label>Select License Type</label><span class="red">*</span></td>
					<td align="left" valign="top">
						<select name="ddlLicensetype" id="ddlLicensetype" style="width: 220px;" onChange="licensctype(this.value)" >
							<option value="">Select License Type</option>
							<option value="onetime" <?php if($row_settings->license_type == "onetime"){echo "selected" ;} ?>>One Time</option>
							<option value="yearly"  <?php if($row_settings->license_type == "yearly"){echo "selected" ;} ?>>Yearly</option>
							<option value="revenue" <?php if($row_settings->license_type == "revenue"){echo "selected" ;} ?>>Revenue Model</option>						
						</select>
					</td>
				</tr>
				<tr>
					<td>
					&nbsp;
					</td>
					<td>
						<div id="divyearly" <?php if($row_settings->license_type == "yearly"){echo "style='display:block'";}else{echo "style='display:none'";} ?> style="width:100%; float:left">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td height="35" align="left" valign="top" width="20%">
										<label>Date Of Installation</label><span class="red">*</span>
									</td>
									<td align="left" valign="top">
										<input type="text" name="txtdateofinstallyearly" id="txtdateofinstallyearly" value="<?php if($row_settings->license_type == "yearly"){ echo $row_settings->license_install_date; } ?>" style="width: 220px;" onchange="calclicenseperiod()" />
									</td>
								</tr>
								<tr>
									<td height="35" align="left" valign="top">
										<label>Select Year</label>
									</td>
									<td align="left" valign="top">
										<select name="ddllicenseperiod" id="ddllicenseperiod" style="width: 220px;" onChange="calclicenseperiod()" >
											<option value="1" <?php if($row_settings->license_type == "yearly"){ if($row_settings->license_period == "1"){echo "selected" ;}} ?>>1</option>
											<option value="2" <?php if($row_settings->license_type == "yearly"){ if($row_settings->license_period == "2"){echo "selected" ;}} ?>>2</option>
											<option value="3" <?php if($row_settings->license_type == "yearly"){ if($row_settings->license_period == "3"){echo "selected" ;}} ?>>3</option>
											<option value="4" <?php if($row_settings->license_type == "yearly"){ if($row_settings->license_period == "4"){echo "selected" ;}} ?>>4</option>
											<option value="5" <?php if($row_settings->license_type == "yearly"){ if($row_settings->license_period == "5"){echo "selected" ;}} ?>>5</option>
										</select>
									</td>
								</tr>
								<tr>
									<td height="35" align="left" valign="top">
										<label>License Upto</label>
									</td>
									<td align="left" valign="top">
										<input type="text" name="txtlicenseupto" id="txtlicenseupto" value="<?php if($row_settings->license_type == "yearly"){ echo $row_settings->license_end_date;} ?>" style="width: 220px;" readonly="true" />
									</td>
								</tr>
								<tr>
									<td  height="35" align="left" valign="top" width="20%">
										<label>Users/Leaves</label>
									</td>
									<td align="left" valign="top">
										<label>
											<input type="radio" name="radlicense_users_leaves_yearly" value="0" checked <?php if($row_settings->license_type == "yearly"){ if($row_settings->license_users_leaves == "0" ){echo "checked";}} ?> >No of User
											<input type="radio" name="radlicense_users_leaves_yearly" value="1" <?php if($row_settings->license_type == "yearly"){ if($row_settings->license_users_leaves == "1" ){echo "checked";}} ?>  >No of Cheque Leaves
										</label>
									</td>
								</tr>
								<tr>
									<td  height="35" align="left" valign="top">
										<label>No Of Users/Leaves</label><span class="red">*</span>
									</td>
									<td align="left" valign="top">
										<input type="text" name="txtlicense_users_leaves_value_yearly" id="txtlicense_users_leaves_value" value="<?php if($row_settings->license_type == "yearly"){ echo $row_settings->license_users_leaves_value; } ?>" style="width: 220px;" maxlength="10" onkeypress="return isNumberKey(event)" />
									</td>
								</tr>
							</table>
						</div>
						<div id="divonetime" <?php if($row_settings->license_type == "onetime"){echo "style='display:block'";}else{echo "style='display:none'";} ?> style="width:100%; float:left">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td height="35" align="left" valign="top" width="20%">
										<label>Date Of Installation</label><span class="red">*</span>
									</td>
									<td align="left" valign="top">
										<input type="text" name="txtdateofinstallonetime" id="txtdateofinstallonetime" value="<?php if($row_settings->license_type == "onetime"){ echo $row_settings->license_install_date;} ?>" style="width: 220px;" onchange="calclicenseperiodforonetime()" />
									</td>
								</tr>
								<tr>
									<td  height="35" align="left" valign="top">
										<label>License Upto</label>
									</td>
									<td align="left" valign="top">
										<input type="text" name="txtlicenseuptoonetime" id="txtlicenseuptoonetime" value="<?php if($row_settings->license_type == "onetime"){ echo $row_settings->license_end_date;} ?>" style="width: 220px;" />
									</td>
								</tr>
								<tr>
									<td  height="35" align="left" valign="top" width="20%">
										<label>Users/Leaves</label>
									</td>
									<td align="left" valign="top"><label>
										<input type="radio" name="radlicense_users_leaves_onetime" value="0" checked <?php if($row_settings->license_type == "onetime"){ if($row_settings->license_users_leaves == "0" ){echo "checked";}} ?> >No of User
										<input type="radio" name="radlicense_users_leaves_onetime" <?php if($row_settings->license_type == "onetime"){ if($row_settings->license_users_leaves == "1" ){echo "checked";}} ?> value="1" >No of Cheque Leaves
									</label></td>
								</tr>
								<tr>
									<td  height="35" align="left" valign="top">
										<label>No Of Users/Leaves</label><span class="red">*</span>
									</td>
									<td align="left" valign="top">
										<input type="text" name="txtlicense_users_leaves_value_onetime" id="txtlicense_users_leaves_value_onetime" value="<?php if($row_settings->license_type == "onetime"){ echo $row_settings->license_users_leaves_value;} ?>" style="width: 220px;" maxlength="10" onkeypress="return isNumberKey(event)" />
									</td>
								</tr>
							</table>
						</div>
						<div id="divrevinue" <?php if($row_settings->license_type == "revenue"){echo "style='display:block'";}else{echo "style='display:none'";} ?> style="width:100%;  float:left">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td height="35" align="left" valign="top" width="20%">
										<label>Date Of Installation</label><span class="red">*</span>
									</td>
									<td align="left" valign="top">
										<input type="text" name="txtdateofinstallrevenue" id="txtdateofinstallrevenue" value="<?php if($row_settings->license_type == "revenue"){ echo $row_settings->license_install_date;} ?>" style="width: 220px;" onchange="calclicenseperiodforonetime()" />
									</td>
								</tr>
								<tr>
									<td  height="35" align="left" valign="top" width="20%">
										<label>Users/Leaves</label>
									</td>
									<td align="left" valign="top"><label>
										<input type="radio" name="radlicense_users_leaves_revinue" value="0" checked <?php if($row_settings->license_type == "revenue"){ if($row_settings->license_users_leaves == "0" ){echo "checked";}} ?> >No of User
										<input type="radio" name="radlicense_users_leaves_revinue" <?php if($row_settings->license_type == "revenue"){ if($row_settings->license_users_leaves == "1" ){echo "checked";}} ?> value="1" >No of Cheque Leaves
									</label></td>
								</tr>
								<tr>
									<td  height="35" align="left" valign="top">
										<label>No Of Users/Leaves</label><span class="red">*</span>
									</td>
									<td align="left" valign="top">
										<input type="text" name="txtlicense_users_leaves_value_revinue" id="txtlicense_users_leaves_value_revinue" style="width: 220px;" value="<?php if($row_settings->license_type == "revenue"){ echo $row_settings->license_users_leaves_value; }?>" maxlength="10" onkeypress="return isNumberKey(event)" />
									</td>
								</tr>
							</table>
						</div>
						<div id="divdemo" style="display:none; width:100%;  float:left">
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td width="20%">
									
									</td>
								</tr>
							</table>
						</div>	
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
						<div id="response" class="red"></div>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top" style="padding-right: 16px;" colspan="2">
						<input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Back to previous page" onclick="window.location='installstep3.php'"  /> &nbsp;&nbsp; <input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Click here to Edit" onclick="document.getElementById('ddlFileFormat').focus();"  /> &nbsp;&nbsp;<input type="submit" name="submit1" id="submit1" value="Go to next page" class="submitbutton" />
					</td>
				</tr>
				<tr>
							
					<td align="right" valign="top" style="padding-right: 16px;">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</div>

</div>
</div>
</div>
</div>
</body>
</html>
