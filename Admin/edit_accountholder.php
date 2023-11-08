<?php 
require_once('../global.php');	
$rowbank = $db->get_row("select bank_code,bank_name from tb_bankdetails");
$row = $db->get_row("select * from tb_accountholdermaster where ach_Id = '".$_REQUEST['ahid']."'");
$page_name = "branch_master";
authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php include('../includes.php'); ?>

<script type="text/javascript" src="<?php echo ROOT_SCRIPTS; ?>jquery.timepicker.js"></script>
<link rel="stylesheet" href="<?php echo ROOT_STYLES;  ?>jquery.timepicker.css" type="text/css">


	<script type="text/javascript">
		var vRules = { txtAccNo: { required:true }, txtAccName: { required:true},ddlTrCode: { required:true}, ach_Authorized_Signatory1:{required:true}, txtAdd1:{required:true}, ddlcountry: { required:true }, ddlstate: { required:true }, ddlcity: { required:true }, ddlsuburb: { required:true }, branchpin: { required:true }, txtTelePhoneResidence: { required:true }, txtTelePhoneOffice: { required:true }, txtMobileNo: {required:true}, txtEmailId: {required:true,email:true}};
		var vMessages = { txtAccNo: {required: "<br/>Please enter account no." }, txtAccName: { required: "<br/>Please enter account name."}, ddlTrCode: { required: "<br/>Select TR code."}, ach_Authorized_Signatory1: { required: "<br/>Please enter authorized signatory."}, txtAdd1: { required: "<br/>Please enter address 1"},ddlcountry: {required: "<br/>Please select country" }, ddlstate: {required: "<br/>Please select state" }, ddlcity: {required: "<br/>Please select city" }, ddlsuburb: {required: "<br/>Please select suburb" }, branchpin: {required: "<br/>Please enter pincode"}, txtTelePhoneResidence: {required: "<br/>Please enter residence telephone" }, txtTelePhoneOffice: { required: "<br/>Please enter Office TelePhone"}, txtMobileNo: { required: "<br/>Please enter mobile no"}, txtEmailId: { required: "<br/>Please enter email id.", email:"<br>Please enter correct email id</br>"}};
		$(document).ready(function() {			
			
			$('#response,#ajax_loading,.loading').hide();
			$('#submit').button();		
		
			$('#accountmaster').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#accountmaster').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
							$('#submitdiv').hide();
						}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									alert("Account holder details are added sucessfully.");
									window.location = resObj.loc;
									//window.location = '<?php echo $_SERVER['PHP_SELF']; ?>';
							} else {	
								$('.loading').hide();
								$('#submitdiv').show();					
								$('#response').html('<div class="errormsg_boundary">'+resObj.htmlcontent+'<div>').show();
							}
						}
					});
				}
			});
			
		});
	</script>
	<SCRIPT LANGUAGE="JavaScript">
		
		
		function manageWorkingDays1(checkboxlist1,checkboxlist2,checkboxlist3)
		{
			var c = document.getElementsByName("chkWeekDays[]");
		}
		
		function manageWorkingDays(object)
		{
			alert(object.id);
			thisid 	 = object.id;
			id_arr 	 = thisid.split('_');
			day_type = id_arr[0];
			day		 = id_arr[1];
			
			switch(day_type){
				case 'chkWeekDays':
					todiable1 = 'chkHalfDays_';
					todiable2 = 'chkHoliDays_';
					todiable3 = 'chkNonBankingDays_';
					pagename = 'Banking days';
					break;
				
				case 'chkHalfDays':
					todiable1 = 'chkWeekDays_';
					todiable2 = 'chkHoliDays_';
					todiable3 = 'chkNonBankingDays_';
					pagename = 'Banking Half days';
					break;
				
				case 'chkHoliDays':
					todiable1 = 'chkHalfDays_';
					todiable2 = 'chkWeekDays_';
					todiable3 = 'chkNonBankingDays_';
					pagename = 'HoliDays';
					break;
					
				case 'chkNonBankingDays':	
					todiable1 = 'chkHalfDays_';
					todiable2 = 'chkWeekDays_';
					todiable3 = 'chkHoliDays_';
					pagename = 'Non Banking Days';
				
			}
			
			if(object.checked){
				if(day_type=="chkHalfDays" || day_type=="chkHoliDays" || day_type=="chkNonBankingDays")
				{
					var elementname = day_type+"[]";
					var getallelement = document.getElementsByName(elementname);
					var total=0;
					for(i=0;i<getallelement.length;i++)
					{
						if(getallelement[i].checked)
							total++;
					}
					if(total>1)
					{
						if(confirm("Normally "+pagename+" are one in a week ,are you sure?"))
						{
							document.getElementById(todiable1+day).disabled = true;
							document.getElementById(todiable2+day).disabled = true;
							document.getElementById(todiable3+day).disabled = true;
						}
						else
						{
							document.getElementById(thisid).checked = false;
						}
					}
					else
					{
						document.getElementById(todiable1+day).disabled = true;
						document.getElementById(todiable2+day).disabled = true;
						document.getElementById(todiable3+day).disabled = true;
					}
				}
			}else{
				document.getElementById(todiable1+day).disabled = false;
				document.getElementById(todiable2+day).disabled = false;
				document.getElementById(todiable3+day).disabled = false;
			}
		}
	</script>
	<script type="text/javascript">
		function showStates(str)
		{
			
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					
					document.getElementById("divstatelist").innerHTML="";
					document.getElementById("divstatelist").innerHTML=xmlhttp.responseText;
					document.getElementById("divloadingstate").style.display="none";
				}
				else
				{
					document.getElementById("divloadingstate").style.display="block";
				}
			}
			xmlhttp.open("GET","post_accountholder.php?contid="+str,true);
			xmlhttp.send();
		}
		function showCity(str)
		{
			
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					
					document.getElementById("divcitylist").innerHTML="";
					document.getElementById("divcitylist").innerHTML=xmlhttp.responseText;
					document.getElementById("divloadingcity").style.display="none";
				
				}
				else
				{
					document.getElementById("divloadingcity").style.display="block";
				}
			}
			xmlhttp.open("GET","post_accountholder.php?stateid="+str,true);
			xmlhttp.send();
		}
		function showSuburb(str)
		{
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("divsuburblist").innerHTML="";
					document.getElementById("divsuburblist").innerHTML=xmlhttp.responseText;
					document.getElementById("divloadingsuburb").style.display="none";
				}
				else
				{
					document.getElementById("divloadingsuburb").style.display="block";
				}
			}
			xmlhttp.open("GET","post_accountholder.php?cityid="+str,true);
			xmlhttp.send();
		}
		function showpostalcode(str)
		{
			if (window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("divpostalcode").innerHTML="";
					document.getElementById("divpostalcode").innerHTML=xmlhttp.responseText;
					document.getElementById("divloadingcode").style.display="none";
				}
				else
				{
					document.getElementById("divloadingcode").style.display="block";
				}
			}
			xmlhttp.open("GET","post_accountholder.php?suburbid="+str,true);
			xmlhttp.send();
		}
	</script>
	
	<SCRIPT LANGUAGE="JavaScript">
		
		
		function manageWorkingDays1(checkboxlist1,checkboxlist2,checkboxlist3)
		{
			var c = document.getElementsByName("chkWeekDays[]");
		}
		
		function manageWorkingDays(object)
		{
			thisid 	 = object.id;
			id_arr 	 = thisid.split('_');
			day_type = id_arr[0];
			day		 = id_arr[1];
			
			switch(day_type){
				case 'chkWeekDays':
					todiable1 = 'chkHalfDays_';
					todiable2 = 'chkHoliDays_';
					todiable3 = 'chkNonBankingDays_';
					pagename = 'Banking days';
					break;
				
				case 'chkHalfDays':
					todiable1 = 'chkWeekDays_';
					todiable2 = 'chkHoliDays_';
					todiable3 = 'chkNonBankingDays_';
					pagename = 'Banking Half days';
					break;
				
				case 'chkHoliDays':
					todiable1 = 'chkHalfDays_';
					todiable2 = 'chkWeekDays_';
					todiable3 = 'chkNonBankingDays_';
					pagename = 'HoliDays';
					break;
					
				case 'chkNonBankingDays':	
					todiable1 = 'chkHalfDays_';
					todiable2 = 'chkWeekDays_';
					todiable3 = 'chkHoliDays_';
					pagename = 'Non Banking Days';
				
			}
			
			if(object.checked){
				if(day_type=="chkHalfDays" || day_type=="chkHoliDays" || day_type=="chkNonBankingDays")
				{
					var elementname = day_type+"[]";
					var getallelement = document.getElementsByName(elementname);
					var total=0;
					for(i=0;i<getallelement.length;i++)
					{
						if(getallelement[i].checked)
							total++;
					}
					if(total>1)
					{
						if(confirm("Normally "+pagename+" are one in a week ,are you sure?"))
						{
							document.getElementById(todiable1+day).disabled = true;
							document.getElementById(todiable2+day).disabled = true;
							document.getElementById(todiable3+day).disabled = true;
						}
						else
						{
							document.getElementById(thisid).checked = false;
						}
					}
					else
					{
						document.getElementById(todiable1+day).disabled = true;
						document.getElementById(todiable2+day).disabled = true;
						document.getElementById(todiable3+day).disabled = true;
					}
				}
				else{
					document.getElementById(todiable1+day).disabled = true;
					document.getElementById(todiable2+day).disabled = true;
					document.getElementById(todiable3+day).disabled = true;
				}
			}else{
				document.getElementById(todiable1+day).disabled = false;
				document.getElementById(todiable2+day).disabled = false;
				document.getElementById(todiable3+day).disabled = false;
			}
		}
	</script>
	
	<SCRIPT LANGUAGE="JavaScript">
		function textCounter(field,cntfield,maxlimit) {
			if (field.value.length > maxlimit) // if too long...trim it!
			field.value = field.value.substring(0, maxlimit);
			else
			cntfield.value = maxlimit - field.value.length;
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
			else
			{
				return true;
			}	
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
	  
		function showclrcity()
		{
			if(document.getElementById("divclrcitylist").style.display == "none"){
				document.getElementById("divclrcitylist").style.display="block";
			}else{
				document.getElementById("divclrcitylist").style.display="none";
			}
		}
		
		function showclrcode()
		{
			if(document.getElementById("divclrbankcode").style.display == "none"){
				document.getElementById("divclrbankcode").style.display="block";
			}else{
				document.getElementById("divclrbankcode").style.display="none";
				document.getElementById("txtclrbankcode").value = "";
			}
		}
		
		function fillbranchcode()
		{
			var bankname = document.getElementById("branchname").value;
			if(bankname != ""){
				if(bankname.length > 3){
					var bankcode = bankname.substring(0, 3);
					document.getElementById("branchcode").value = bankcode + "001";
				}else{
					document.getElementById("branchcode").value = bankname + "001";
				}
			}		
		}
	  
      //-->
   </SCRIPT>
	
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT_STYLES; ?>../timePicker.css" />
	<style>
	 .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
	 .ui-timepicker-div dl { text-align: left; }
	 .ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
	 .ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
	 .ui-timepicker-div td { font-size: 90%; }
	 .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
	</style>
</head>

<body>

<?php require_once('adminheader.php');	?>              
<div id="formdiv">
	<div id="formheading">Branch Masters For <?php echo $rowbank->bank_name; ?></div>
	<div id="formfields">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
			<form id="accountmaster" name="accountmaster" method="post" action="post_accountholder.php?do=edit&ahid=<?php echo $_REQUEST["ahid"]; ?>" >
			<table width="880" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left" valign="top">&nbsp;</td>
			  </tr>
			  <tr>
				<td align="left" valign="top"><div id="response"></div></td>
			  </tr>
			  <tr>
				<td align="left" valign="top">
				<input type="hidden" name="branchid" id="branchid" value="<?php echo stripslashes($row-> branch_id); ?>" style="width:373px;" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						
				  <tr>
					<td align="left" valign="top" width="100%">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td height="35" align="left" valign="top" width="23%"><label>Account Number</label><span class="red">*</span></td>
						<td align="left" valign="top" width="80%"><label>
						<input type="text" name="txtAccNo" id="txtAccNo" value="<?php echo stripslashes($row->ach_account_No); ?>" style="width:190px;" onKeyPress = "return isNumberKey(event);" />
					  </label></td>
					  </tr>
					   <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Account Name</label></td>
						<td align="left" valign="top" width="80%"><label>
						<input type="text" name="txtAccName" id="txtAccName" value="<?php echo stripslashes($row->ach_account_Name); ?>" style="width:190px;" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
					  </label></td>
					  </tr>
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Branch</label></td>
						<td align="left" valign="top" width="80%"><label>
							<select name="ddlBranch" id="ddlBranch" style="width:198px; height:26px;">
								<option value=""> Select Branch</option><span class="red">*</span>
								<?php $arrayBranch =  $db->get_results("SELECT * FROM tb_branchdetails");?>													
								<?php foreach($arrayBranch as $branch):?>
									<?php if($branch->branch_id == $row->ach_Branch):?>
										<option value="<?php echo $branch->branch_id; ?>" selected=selected ><?php echo $branch->branch_name; ?></option>
									<?php else:?>	
										<option value="<?php echo $branch->branch_id; ?>" ><?php echo $branch->branch_name; ?></option>
									<?php endif;?>
								<?php ENDFOREACH; ?>
							</select>						
					  </label></td>
					  </tr>
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Bearer Order</label>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" name="txtBearerOrder" id="txtBearerOrder" value="<?php echo stripslashes($row->ach_Bearer_Order); ?>" style="width:190px;" />
							</label>
						</td>
					  </tr>
					  					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Transaction Code</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<select name="ddlTrCode" id="ddlTrCode" style="width:198px; height:26px;">
							<option value=""> Select Tr Code</option>
								<?php 
									$rowgetTrCode =  $db->get_results("select * from tb_cps_transactioncodes");
									foreach($rowgetTrCode as $eachTrCode){
								?>
									<option value="<?php echo $eachTrCode->transactioncode_id; ?>" <?php if(stripslashes($eachTrCode->transactioncode_id)== $row->ach_Transaction_Code){echo "Selected";} ?>><?php echo $eachTrCode->transactioncodedescription.'('.$eachTrCode->transactioncode.')'; ?></option>
								<?php 
									} 
								?>
							</select>
						</td>
					  </tr>
					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>At Par</label>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" name="txtAtPar" maxlength="3" id="txtAtPar" value="<?php echo stripslashes($row->txtAtPar); ?>" style="width:190px;" />
							</label>
						</td>
					  </tr>
					  
					  <tr>
					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Joint Name 1</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" name="txtJointName1" id="txtJointName1" value="<?php echo stripslashes($row->ach_Joint_Name1); ?>" style="width:190px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
							</label>
						</td>
					  </tr>
					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Joint Name 2</label>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" name="txtJointName2" id="txtJointName2" value="<?php echo stripslashes($row->ach_Joint_Name2); ?>" style="width:190px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
							</label>
						</td>
					  </tr>
					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Authorized Signatory 1</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" name="ach_Authorized_Signatory1" id="ach_Authorized_Signatory1" value="<?php echo stripslashes($row->ach_Authorized_Signatory1); ?>" style="width:190px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
							</label>
						</td>
					  </tr>
					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Authorized Signatory 2</label>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" name="ach_Authorized_Signatory2" id="ach_Authorized_Signatory2" value="<?php echo stripslashes($row->ach_Authorized_Signatory2); ?>" style="width:190px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
							</label>
						</td>
					  </tr>
					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Authorized Signatory 3</label>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" name="ach_Authorized_Signatory3" id="ach_Authorized_Signatory3" value="<?php echo stripslashes($row->ach_Authorized_Signatory3); ?>" style="width:190px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
							</label>
						</td>
					  </tr>
					  
					  
					  
					  
					</table></td>
					<td width="270" align="left" valign="top"></td>
				  </tr>
				  
				</table></td>
			  </tr>
			 
			  <tr>
				<td align="left" valign="top">
				<table width="91%" border="0" cellspacing="0" cellpadding="0">
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Address Line1</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="txtAdd1" id="txtAdd1"  style="width:300px;" value="<?php echo stripslashes($row->ach_Address1); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />&nbsp;<label>(35 characters)</label>
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Address Line2</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="txtAdd2" id="txtAdd2"  style="width:300px;" value="<?php echo stripslashes($row->ach_Address2); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />&nbsp;<label>(35 characters)</label>
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Country</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<select name="ddlcountry" id="ddlcountry" style="width:190px; height:26px;" onchange="showStates(this.value)">
							<option value=""> Select Country</option>
								<?php 
									$rowgetcountry =  $db->get_results("select * from tb_countrymaster");
									foreach($rowgetcountry as $eachcountry){
								?>
									<option value="<?php echo $eachcountry->country_id; ?>" <?php if(stripslashes($eachcountry->country_id)== $row->ach_Country){echo "Selected";} ?>><?php echo $eachcountry->country_name; ?></option>
								<?php 
									} 
								?>
							</select>
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>State</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<div id ="divloadingstate" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
							<div id="divstatelist">
								<select name="ddlstate" id="ddlstate" style="width:190px; height:26px;" onchange="showCity(this.value)">
									<option value=""> Select State</option>
									<?php 
										$rowgetstate =  $db->get_results("select * from tb_statemaster where country_id = ".$row->ach_Country."");
										foreach($rowgetstate as $eachstate){
									?>
									<option value="<?php echo $eachstate->state_id; ?>" <?php if(stripslashes($eachstate->state_id)== $row->ach_State){echo "Selected";} ?>><?php echo $eachstate->state_name; ?></option>
									<?php 
										} 
									?>
								</select>
							</div>
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>City</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<div id ="divloadingcity" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
							<div id="divcitylist">
								<select name="ddlcity" id="ddlcity" style="width:190px; height:26px;" onchange="showSuburb(this.value)" >
								<option value=""> Select City </option>
								<?php 
									$rowgetcity =  $db->get_results("select * from tb_citymaster where state_id = ".$row->ach_State."");
									foreach($rowgetcity as $eachcity){
								?>
								<option value="<?php echo $eachcity->city_id; ?>" <?php if(stripslashes($eachcity->city_id)== $row->ach_City){echo "Selected";} ?>><?php echo $eachcity->city_place; ?></option>
								<?php 
									} 
								?>
							</select>
							</div>
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Subrub</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<div id ="divloadingsuburb" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
							<div id="divsuburblist">
								<select name="ddlsuburb" id="ddlsuburb" style="width:190px; height:26px;" onchange="showpostalcode(this.value)">
								<option value=""> Select Suburb </option>
								<?php 
									$rowgetsuburb =  $db->get_results("select * from tb_suburbmaster where city_id = '".$row->ach_City."'");
									foreach($rowgetsuburb as $eachsuburb){
								?>
								<option value="<?php echo $eachsuburb->suburb_id; ?>" <?php if(stripslashes($eachsuburb->suburb_id)== $row->ach_Suburb){echo "Selected";} ?>><?php echo $eachsuburb->suburb_name; ?></option>
								<?php 
									} 
								?>
							</select>
							</div>
						</label>
					</td>
				</tr>
				
				
				<tr>
					<td width="25%" height="35" align="left" valign="top"><label>Zip/Pin Code</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<div id ="divloadingcode" style="display:none"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
							<div id="divpostalcode" name="divpostalcode">
								<input type="text" name="branchpin" id="branchpin" value="<?php echo stripslashes($row->ach_Pincode); ?>" style="width:190px;" readonly="true" />
							</div>	
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Telephone Residence</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="txtTelePhoneResidence" id="txtTelePhoneResidence" value="<?php echo stripslashes($row->ach_Telephone_Residence); ?>" maxlength="15" onkeypress="return isNumberKey(event)" style="width:190px;" />
						</label>
					</td>
				</tr>
				 				 				 
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Telephone Office</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="txtTelePhoneOffice" id="txtTelePhoneOffice" value="<?php echo stripslashes($row->ach_Telephone_Office); ?>" maxlength="15" onkeypress="return isNumberKey(event)" style="width:190px;" />
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Mobile No.</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							+91<input type="text" name="txtMobileNo" id="txtMobileNo" value="<?php echo stripslashes($row->ach_Mobile_No); ?>" maxlength="15" onkeypress="return isNumberKey(event)" style="width:167px;" />
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>EmailID</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="txtEmailId" id="txtEmailId" value="<?php echo stripslashes($row->ach_emailId); ?>" style="width:190px;" />
						</label>
					</td>
				</tr>
				
				<tr>
					<td align="left" valign="top">&nbsp;</td>
					<td align="left" valign="top">&nbsp;</td>
				</tr>
				<tr>
					<td align="left" valign="top">&nbsp;</td>
					<td align="left" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="100%" align="left" valign="top">
								<?php if(authentication_groups_pemissions($page_name,"","Y","","Y")):?>
								<input name="submit" type="submit" id="submit" value="Save Details"  style="height:30px; width:150px" />
								<input type="submit" name="submit1" id="submit1" value="Save and Close" class="submitbutton" />
								<?php endif;?>
								<input type="button" name="submit2" id="submit2" value="Discard" class="submitbutton" onClick="window.location.href='adminhome.php'" />
								<input type="button" name="submit3" id="submit3" value="Go to home" class="submitbutton" onClick="window.location.href='adminhome.php'" />
								<div class="loading"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
							</td>
							<td width="35%" align="left" valign="top"></td>
						</tr>
						</table>
					</td>
				</tr>
				
				</table>
				</td>
				</tr>
				<tr>
				<td align="left" valign="top">&nbsp;</td>
				</tr>
				</table>
			 </form>
			</td>
		</tr>
	  </table>
	</div>
</div>
</div>
</div>
</div>	
<?php require_once('../footer.php');	?> 	
</body>
</html>
