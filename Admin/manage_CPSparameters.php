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
	var vRules = {txtInputFolder: { required:true }, txtOutputFolder: { required:true },txtArchiveFolder: { required:true },};
	var vMessages = {txtInputFolder: { required: "<br/>Please enter input folder name." }, txtOutputFolder: { required: "<br/>Please enter output folder name." }, txtArchiveFolder: { required: "<br/>Please enter archive folder name." }};
	$(document).ready(function() {
		$('#response,#ajax_loading,.loading').hide();
		$('#submit').button();		
		$('#frmSettings').validate({
			rules: vRules,
			messages: vMessages,
			submitHandler: function(form) {
				$('#frmSettings').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
						formData.push({ "name": "type", "value": "json" });
						$('.loading').show();
					}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
						if (resObj.status) {
								alert("Save Sucessfully");
								window.location = 'manage_CPSparameters.php';
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
<?php require_once('adminheader.php');	?>   
<div id="innerpage-maindiv">
<div class="middle-maindiv">
<div id="formdiv">
<div id="formheading">CPS Parameters</div>
<div id="formfields">
<form id="frmSettings" name="frmSettings" action="post_CPSparameters.php" method="post" enctype="multipart/form-data" >
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
						<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
						<div id="response" class="red"></div>
					</td>
				</tr>
				<tr>
					<td align="left" valign="top" style="padding-right: 16px;" colspan="2">						
						<input type="submit" name="submit1" id="submit1" value="Save" class="submitbutton" />
						
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
</body>
</html>
