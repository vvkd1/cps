<?php  require_once('../global.php');
$bankcode = $db->get_row("SELECT max(bank_code) as bank_code,bank_name from tb_bankdetails"); 
$row = $db->get_row("select * from tb_branchdetails");
$rowweekday = "";
$rowhalfday = "";
$rowholiday = "";

if(count($row) < 1)
{
	$row = (object) array( "branch_id" =>  "","branch_code" =>  "","branch_name" =>  "","branch_micr" =>  "","branch_atparmicrcode" =>  "","branch_address1" =>  "","branch_address2" =>  "","branch_address3" =>  "","branch_country_id" =>  "","branch_state_id" =>  "","branch_city_id" =>  "","branch_suburb_id" =>  "","branch_pin" =>  "","branch_telephone1" =>  "","branch_telephone2" =>  "","branch_contactperson1" =>  "","branch_contactperson2" =>  "","branch_contactpersonmobile1" =>  "","branch_contactpersonmobile2" =>  "","branch_email1" =>  "","branch_email2" =>  "","branch_holiday" => "","branch_neftifsccode" =>  "","branch_working_hours" =>  "","branch_clearingthrough" => "","branch_clearingcenter" =>  "");
	$rowweekday = (object) array ( "monday" =>  "","tuesday" =>  "","wednesday" =>  "","thursday" =>  "","friday" =>  "","saturday" =>  "","sunday" =>  "","opening_time1" =>  "","opening_time2" =>  "","closing_time1" =>  "","closing_time2" => "" );
	$rowhalfday = (object) array ( "monday" =>  "","tuesday" =>  "","wednesday" =>  "","thursday" =>  "","friday" =>  "","saturday" =>  "","sunday" =>  "","opening_time1" =>  "","opening_time2" =>  "" );
	$rowholiday = (object) array ( "monday" =>  "","tuesday" =>  "","wednesday" =>  "","thursday" =>  "","friday" =>  "","saturday" =>  "","sunday" =>  "");
	$rownonworkingdays = (object) array ( "monday" =>  "","tuesday" =>  "","wednesday" =>  "","thursday" =>  "","friday" =>  "","saturday" =>  "","sunday" =>  "");
}
else
{
	$rowweekday = $db->get_row("select * from tb_cps_weekdays WHERE branch_id = $row->branch_id");
	$rowhalfday = $db->get_row("select * from tb_cps_halfdays WHERE branch_id = $row->branch_id");
	$rowholiday = $db->get_row("select * from tb_cps_holidays WHERE branch_id = $row->branch_id");
	$rownonworkingdays = $db->get_row("select * from tb_cps_nonworkingdays WHERE branch_id = $row->branch_id");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
<?php include('../includes.php'); ?>

<script type="text/javascript" src="<?php echo ROOT_SCRIPTS; ?>jquery.timepicker.js"></script>
<link rel="stylesheet" href="<?php echo ROOT_STYLES;  ?>jquery.timepicker.css" type="text/css">


	<script type="text/javascript">
		var vRules = { branchname: { required:true }, branchatpermirc: { required:true},branchmirc: { required:true}, branchemail1:{required:true,email:true}, branchtelephone1:{required:true}, ddlcountry: { required:true }, ddlstate: { required:true }, ddlcity: { required:true }, ddlsuburb: { required:true }, branchaddress1: { required:true }, branchtelephone2: { required:true }, branchNEFT: { required:true }, branchpin: { required:true },branchcontact1: { required:true },branchcontact2: { required:true }};
		var vMessages = { branchname: {required: "<br/>Please enter branch name" }, branchatpermirc: { required: "<br/>Please enter branch at per MIRC code."}, branchmirc: { required: "<br/>Please enter branch MIRC code."}, branchemail1: { required: "<br/>Please enter correct email.", email:"<br>Please enter correct email id."}, branchtelephone1: { required: "<br/>Please enter telephone 1."},ddlcountry: {required: "<br/>Please select country" }, ddlstate: {required: "<br/>Please select state" }, ddlcity: {required: "<br/>Please select city" }, ddlsuburb: {required: "<br/>Please select suburb" }, branchaddress1: {required: "Please enter address line1" }, branchtelephone2: { required: "<br/>Please enter telephone 2."}, branchpin: { required: "<br/>Please enter zip/pin code."}, branchNEFT: { required: "<br/>Please enter RTGS/NEFT IFSC code."}, branchcontact1: { required: "<br/>Please enter contact official 1."}, branchcontact2: { required: "<br/>Please enter contact official 2."}};
		$(document).ready(function() {
					
			$('#response,#ajax_loading,.loading').hide();
			$('#submit1').button();		
		
			$('#frminstallstep3').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frminstallstep3').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
							$('#submitdiv').hide();
						}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									window.location = "installstep4.php";
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
      //-->
   </SCRIPT>
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
			xmlhttp.open("GET","post_installstep3.php?contid="+str,true);
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
			xmlhttp.open("GET","post_installstep3.php?stateid="+str,true);
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
			xmlhttp.open("GET","post_installstep3.php?cityid="+str,true);
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
			xmlhttp.open("GET","post_installstep3.php?suburbid="+str,true);
			xmlhttp.send();
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
	</script>
	<link rel="stylesheet" href="<?php echo ROOT_STYLES;  ?>jquery.time.slider.css" type="text/css">
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
				<div id="formheading">Branch Master for <?php echo $bankcode->bank_name; ?></div>
				<div id="formfields">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
								<form id="frminstallstep3" name="frminstallstep3" method="post" action="post_installstep3.php" autocomplete="off" >
									<table width="880" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top">&nbsp;</td>
										</tr>
										<tr>
											<td align="left" valign="top"><div id="response"></div></td>
										</tr>
										<tr>
											<td align="left" valign="top">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td align="left" valign="top" width="100%">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td height="35" align="left" valign="top" width="20%"><label>Branch Name</label><span class="red">*</span></td>
																	<td align="left" valign="top"  width="80%"><label>
																	<input type="text" name="branchname" id="branchname" value="<?php echo stripslashes($row->branch_name); ?>" style="width:379px;" maxlength="50" onblur="fillbranchcode();" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress = "return isNumberKey1(event);"  />
																	</label></td>
																</tr>
																<tr>
																	<td height="35" align="left" valign="top" width="20%"><label>Branch Code</label><span class="red">*</span></td>
																	<td align="left" valign="top"  width="80%"><label>
																	<input type="text" name="branchcode" id="branchcode" readonly="true" value="<?php echo stripslashes($row->branch_code); ?>" style="width:379px;" maxlength="50" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress = "return isNumberKey1(event);"  />
																	</label></td>
																</tr>
																<tr>
																	<td height="35" align="left" valign="top" width="20%"><label>Bank Code & Name</label></td>
																	<td align="left" valign="top"  width="80%"><label>
																	<input type="text" name="bankcode" id="bankcode" readonly="true" value="<?php echo "".$bankcode->bank_code." ".$bankcode->bank_name.""; ?>" style="width:379px;" />
																	</label></td>
																</tr>
																<tr>
																<td colspan="2" align="left" valign="top">
																	<table width="100%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																		<td width="20%" height="35" align="left" valign="top"><label>At Par MICR Code</label><span class="red">*</span></td>
																		<td width="29%" align="left" valign="top"><label>
																		<input type="text"  name="branchatpermirc" id="branchatpermirc" style="width:120px;" maxlength="3" value="<?php echo stripslashes($row->branch_atparmicrcode); ?>"/>
																		</label></td>
																		<td width="19%" align="left" valign="top"><label>Branch MICR</label><span class="red">*</span></td>
																		<td align="left" valign="top"><label>
																		<input type="text" name="branchmirc" id="branchmirc" style="width:130px;" maxlength="3" value="<?php echo stripslashes($row->branch_micr); ?>"/>
																		</label></td>
																		</tr>
																	</table>
																</td>
																</tr>

															</table>
														</td>
														<td width="270" align="left" valign="top">
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="left" valign="top">
												<table width="91%" border="0" cellspacing="0" cellpadding="0">
													
													<tr>
														<td width="22%" height="35" align="left" valign="top"><label>Address Line1</label><span class="red">*</span></td>
														<td width="78%" align="left" valign="top">
															<input type="text" name="branchaddress1" id="branchaddress1" style="width:300px;" value="<?php echo stripslashes($row->branch_address1); ?>" maxlength="35" onKeyUp="javascript:this.value=this.value.toUpperCase();" />&nbsp;<label>(35 characters)</label>
														</td>
													</tr>

													<tr>
														<td width="22%" height="35" align="left" valign="top"><label>Address Line2</label></td>
														<td width="78%" align="left" valign="top">
															<input type="text" name="branchaddress2" id="branchaddress2" style="width:300px;" value="<?php echo stripslashes($row->branch_address2); ?>" maxlength="35" onKeyUp="javascript:this.value=this.value.toUpperCase();" />&nbsp;<label>(35 characters)</label>
														</td>
													</tr>

													<tr>
														<td width="22%" height="35" align="left" valign="top"><label>Address Line3</label></td>
														<td width="78%" align="left" valign="top">
															<input type="text" name="branchaddress3" id="branchaddress3"  style="width:300px;"  value="<?php echo stripslashes($row->branch_address3); ?>" maxlength="35" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>&nbsp;<label>(35 characters)</label>
														</td>
													</tr>

													<tr>
														<td colspan="2" align="left" valign="top">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td width="22%" align="left" valign="top"><label>Country</label><span class="red">*</span></td>
																<td width="28%" align="left" valign="top" height="35">
																<label>
																<select name="ddlcountry" id="ddlcountry" style="width:200px; height:26px;" onchange="showStates(this.value)">
																<option value=""> Select Country</option>
																<?php 
																$rowgetcountry =  $db->get_results("select * from tb_countrymaster");
																foreach($rowgetcountry as $eachcountry){
																?>
																<option value="<?php echo $eachcountry->country_id; ?>" <?php if(stripslashes($eachcountry->country_id)== "105"){echo "Selected";} ?> ><?php echo $eachcountry->country_name; ?></option>
																<?php 
																} 
																?>
																</select>
																</label>
																</td>
																<td width="22%" align="left" valign="top"><label>State</label><span class="red">*</span></td>
																<td width="28%" height="35" align="left" valign="top">
																<label>
																<!--<div id="divstatelist">
																<select name="ddlstate" id="ddlstate" style="width:200px; height:26px;">
																<option value="">State will be added after installation</option>
																</select>
																</div>-->
																<div id ="divloadingstate" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
																<div id="divstatelist" style="float:left">
																
																	<select name="ddlstate" id="ddlstate" style="width:150px; height:26px;" onchange="showCity(this.value)">
																		<option value=""> Select State</option>
																		<?php 
																			$rowgetstate =  $db->get_results("select * from tb_statemaster");
																			foreach($rowgetstate as $eachstate){
																		?>
																		<option value="<?php echo $eachstate->state_id; ?>" <?php if(stripslashes($eachstate->state_id)== $row->branch_state_id){echo "Selected";} ?>><?php echo $eachstate->state_name; ?></option>
																		<?php 
																			} 
																		?>
																	</select>
																</div>
																</label>
																</td>
															</tr>
														</table>
														</td>
													</tr>

													<tr>
														<td colspan="2" align="left" valign="top">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="22%" align="left" valign="top"><label>City</label><span class="red">*</span></td>
																	<td width="28%" align="left" valign="top" height="35">
																	<label>
																	
																	</label>
																	<div id ="divloadingcity" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
																	<div id="divcitylist" style="float:left">																	
																		<select name="ddlcity" id="ddlcity" style="width:150px; height:26px;" onchange="showSuburb(this.value)" >
																		<option value=""> Select City </option>
																		<?php 
																			$rowgetcity =  $db->get_results("select * from tb_citymaster where state_id = ".$row->branch_state_id."");														
																			foreach($rowgetcity as $eachcity){
																		?>
																			<option value="<?php echo $eachcity->city_id; ?>" <?php if(stripslashes($eachcity->city_id) == stripslashes($row->branch_city_id) ){echo "Selected";} ?>><?php echo $eachcity->city_place; ?></option>
																	
																		<?php 
																			} 
																		?>
																		</select>
																	</div>
																	</td>
																	<td width="22%" align="left" valign="top"><label>Suburb</label><span class="red">*</span></td>
																	<td width="28%" align="left" valign="top">
																	<label>
																	<!--<div id="divsuburblist">
																	<select name="ddlsuburb" id="ddlsuburb" style="width:200px; height:26px;" >
																	<option value="">Suburb will be added after installation</option>
																	</select>
																	</div>-->
																	<div id ="divloadingsuburb" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
																	<div id="divsuburblist" style="float:left">
																	
																	<select name="ddlsuburb" id="ddlsuburb" style="width:150px; height:26px;" onchange="showpostalcode(this.value)">
																	<option value=""> Select Suburb </option>
																	<?php 
																		$rowgetsuburb =  $db->get_results("select * from tb_suburbmaster where city_id = '".$row->branch_city_id."'");
																		foreach($rowgetsuburb as $eachsuburb){
																	?>
																	<option value="<?php echo $eachsuburb->suburb_id; ?>" <?php if(stripslashes($eachsuburb->suburb_id)== $row->branch_suburb_id){echo "Selected";} ?>><?php echo $eachsuburb->suburb_name; ?></option>
																	<?php 
																		} 
																	?>
																	</select>
																	</div>
																	</label>
																	</td>
																</tr>
															</table>
														</td>
													</tr>



													<tr>
														<td colspan="2" align="left" valign="top">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="22%" align="left" valign="top"><label>Zip/Pin Code </label><span class="red">*</span></td>
																	<td width="28%" align="left" valign="top">
																	<label>
																	<div id ="divloadingcode" style="display:none"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
																	<div id="divpostalcode" name="divpostalcode" style="float:left">
																		<input type="text" name="branchpin" id="branchpin" style="width:150px;" value="<?php echo stripslashes($row->branch_pin); ?>" readonly="true" />
																	</div>
																	</label>
																	</td>
																	<td width="22%" align="left" valign="top"><label></label></td>
																	<td width="28%" height="35" align="left" valign="top"><label>

																	</label></td>
																</tr>
															</table>
														</td>
													</tr>

													
													<tr>
														<td colspan="2" align="left" valign="top">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="22%" align="left" valign="top"><label>Email Address1 </label><span class="red">*</span></td>
																	<td width="28%" align="left" valign="top">
																	<input type="text" name="branchemail1" id="branchemail1" style="width:190px;" maxlength="35" value="<?php echo stripslashes($row->branch_email1); ?>" />
																	</td>
																	<td width="22%" align="left" valign="top"><label>Email Address2 </label></td>
																	<td width="28%" height="35" align="left" valign="top">
																	<input type="text" name="branchemail2" id="branchemail2" style="width:190px;" maxlength="35" value="<?php echo stripslashes($row->branch_email2); ?>" />
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td colspan="2" align="left" valign="top">
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																	<td width="22%" align="left" valign="top"><label>RTGS/NEFT IFSC Code </label><span class="red">*</span></td>
																	<td width="28%" align="left" valign="top"><input type="text" name="branchNEFT" id="branchNEFT" style="width:190px;" maxlength="11" value="<?php echo stripslashes($row->branch_neftifsccode); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></td>
																	<td width="22%" align="left" valign="top">&nbsp;</td>
																	<td width="28%" height="35" align="left" valign="top">&nbsp;</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													
													<tr>
														<td colspan="2" align="left" valign="top">
															 <fieldset>
																<legend><label><b>Contact Details</b></label></legend>
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td align="left" valign="top">&nbsp;</td>
																		
																	</tr>
																	<tr>
																		<td colspan="2" align="left" valign="top">
																			<table width="100%" border="0" cellspacing="0" cellpadding="0">
																				<tr>
																					<td width="22%" align="left" valign="top"><label>Telephone1 </label><span class="red">*</span></td>
																					<td width="28%" align="left" valign="top"><label>
																					+91<input type="text" name="branchtelephone1" id="branchtelephone1"  style="width:164px;" maxlength="15" value="<?php echo stripslashes($row->branch_telephone1); ?>" onkeypress="return isNumberKey(event)" />
																					</label></td>
																					<td width="22%" align="left" valign="top"><label>Telephone2 </label><span class="red">*</span></td>
																					<td width="28%" height="35" align="left" valign="top"><label>
																					+91<input type="text" name="branchtelephone2" id="branchtelephone2" style="width:164px;" maxlength="15" onkeypress="return isNumberKey(event)" value="<?php echo stripslashes($row->branch_telephone2); ?>"  />
																					</label></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2" align="left" valign="top">
																			<table width="100%" border="0" cellspacing="0" cellpadding="0">
																				<tr>
																					<td width="22%" align="left" valign="top"><label>Contact Official 1 </label><span class="red">*</span></td>
																					<td width="28%" align="left" valign="top">
																					<input type="text" name="branchcontact1" id="branchcontact1"  style="width:190px;" maxlength="35" value="<?php echo stripslashes($row->branch_contactperson1); ?>" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();"  />
																					</td>
																					<td width="22%" align="left" valign="top"><label>Mobile Contact Official 1 </label></td>
																					<td width="28%" height="35" align="left" valign="top"><label>
																					+91<input type="text" name="branchcontactmobile1" id="branchcontactmobile1"  style="width:164px;" maxlength="15" onkeypress="return isNumberKey(event)"  value="<?php echo stripslashes($row->branch_contactpersonmobile1); ?>"/>
																					</label></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2" align="left" valign="top">
																			<table width="100%" border="0" cellspacing="0" cellpadding="0">
																				<tr>
																					<td width="22%" align="left" valign="top"><label>Contact Official 2 </label><span class="red">*</span></td>
																					<td width="28%" align="left" valign="top">
																					<input type="text" name="branchcontact2" id="branchcontact2" style="width:190px;" maxlength="35" value="<?php echo stripslashes($row->branch_contactperson2); ?>" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();"  />
																					</td>
																					<td width="22%" align="left" valign="top"><label>Mobile Contact Official 2 </label></td>
																					<td width="28%" height="35" align="left" valign="top"><label>
																					+91<input type="text" name="branchcontactmobile2" id="branchcontactmobile2" style="width:164px;" maxlength="15" onkeypress="return isNumberKey(event)" value="<?php echo stripslashes($row->branch_contactpersonmobile2); ?>" />
																					</label></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</fieldset>
														</td>
													</tr>
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top"><label>Banking days-FULL</label></td>
														<td align="left" valign="top"  class="name">

														<table style="width:100%">
															<tr>
																<td style="width:150px">
																	<input type="checkbox" name="chkWeekDays[]" id="chkWeekDays_Mon" value="Mon" onclick="manageWorkingDays(this)" <?php echo (isset($rowweekday->monday) && $rowweekday->monday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Monday<br/>
																	<input type="checkbox" name="chkWeekDays[]" id="chkWeekDays_Tue" value="Tue" onclick="manageWorkingDays(this)" <?php echo (isset($rowweekday->tuesday) && $rowweekday->tuesday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Tuesday<br/>
																	<input type="checkbox" name="chkWeekDays[]" id="chkWeekDays_Wed" value="Wed" onclick="manageWorkingDays(this)" <?php echo (isset($rowweekday->wednesday) && $rowweekday->wednesday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Wednesday<br/>
																	<input type="checkbox" name="chkWeekDays[]" id="chkWeekDays_Thu" value="Thu" onclick="manageWorkingDays(this)" <?php echo (isset($rowweekday->thursday) && $rowweekday->thursday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Thursday<br/>
																	<input type="checkbox" name="chkWeekDays[]" id="chkWeekDays_Fri" value="Fri" onclick="manageWorkingDays(this)" <?php echo (isset($rowweekday->friday) && $rowweekday->friday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Friday<br/>
																	<input type="checkbox" name="chkWeekDays[]" id="chkWeekDays_Sat" value="Sat" onclick="manageWorkingDays(this)" <?php echo (isset($rowweekday->saturday) && $rowweekday->saturday == 1) ? "checked=true" : ""; ?>/>&nbsp;&nbsp;Saturday<br/>
																	<input type="checkbox" name="chkWeekDays[]" id="chkWeekDays_Sun" value="Sun" onclick="manageWorkingDays(this)" <?php echo (isset($rowweekday->sunday) && $rowweekday->sunday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Sunday<br/>
																	</td>
																	<td valign="top" align="left"> 
																		<table>
																			<tr>
																			<th>
																			FROM(hh:mm)
																			</th>
																			<th>
																			TO(hh:mm)
																			</th>
																			</tr>
																			<tr>
																			<td>
																				<script>
																				  $(function() {
																					$('#txtWeekDaysFrom1').timepicker({ 'timeFormat': 'H:i' });
																					$('#txtWeekDaysTo1').timepicker({ 'timeFormat': 'H:i' });
																					$('#txtWeekDaysFrom2').timepicker({ 'timeFormat': 'H:i' });
																					$('#txtWeekDaysTo2').timepicker({ 'timeFormat': 'H:i' });
																					$('#txtHalfDaysFrom1').timepicker({ 'timeFormat': 'H:i' });
																					$('#txtHalfDaysTo1').timepicker({ 'timeFormat': 'H:i' });
																				  });
																				</script>
																				<input type="text" id="txtWeekDaysFrom1" name="txtWeekDaysFrom1" value="<?php echo stripslashes($rowweekday->opening_time1); ?>" class="time" size="20" />&nbsp;(hr)
																			</td>
																			<td>
																			<input type="text" id="txtWeekDaysTo1" name="txtWeekDaysTo1" value="<?php echo stripslashes($rowweekday->closing_time1); ?>"  class="time" size="20" />&nbsp;(hr)
																			</td>
																			</tr>
																			<tr>
																			<td>
																			<input type="text" id="txtWeekDaysFrom2" name="txtWeekDaysFrom2" value="<?php echo stripslashes($rowweekday->opening_time2); ?>"  class="time" size="20" />&nbsp;(hr)
																			</td>
																			<td>
																			<input type="text" id="txtWeekDaysTo2" name="txtWeekDaysTo2" value="<?php echo stripslashes($rowweekday->closing_time2); ?>"  class="time" size="20" />&nbsp;(hr)
																			</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top"><label>Banking days-HALF</label></td>
														<td align="left" valign="top" class="name">

															<table style="width:100%">
																<tr>
																	<td style="width:150px">
																	<input type="checkbox" name="chkHalfDays[]" id="chkHalfDays_Mon" value="Mon" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->monday) && $rowhalfday->monday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Monday<br/>
																	<input type="checkbox" name="chkHalfDays[]" id="chkHalfDays_Tue" value="Tue" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->tuesday) && $rowhalfday->tuesday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Tuesday<br/>
																	<input type="checkbox" name="chkHalfDays[]" id="chkHalfDays_Wed" value="Wed" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->wednesday) && $rowhalfday->wednesday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Wednesday<br/>
																	<input type="checkbox" name="chkHalfDays[]" id="chkHalfDays_Thu" value="Thu" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->thursday) && $rowhalfday->thursday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Thursday<br/>
																	<input type="checkbox" name="chkHalfDays[]" id="chkHalfDays_Fri" value="Fri" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->friday) && $rowhalfday->friday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Friday<br/>
																	<input type="checkbox" name="chkHalfDays[]" id="chkHalfDays_Sat" value="Sat" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->saturday) && $rowhalfday->saturday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Saturday<br/>
																	<input type="checkbox" name="chkHalfDays[]" id="chkHalfDays_Sun" value="Sun" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->sunday) && $rowhalfday->sunday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Sunday<br/>
																	</td>
																	<td valign="top"> 
																	<table>
																	<tr>
																	<th>
																	FROM(hh:mm)
																	</th>
																	<th>
																	TO(hh:mm)
																	</th>
																	</tr>
																	<tr>
																	<td>
																	<input type="text" id="txtHalfDaysFrom1" name="txtHalfDaysFrom1" value="<?php echo stripslashes($rowhalfday->opening_time1); ?>" class="time" size="20" />&nbsp;(hr)
																	</td>
																	<td>
																	<input type="text" id="txtHalfDaysTo1" name="txtHalfDaysTo1" value="<?php echo stripslashes($rowhalfday->closing_time1); ?>" class="time" size="20" />&nbsp;(hr)
																	</td>
																	</tr>
																	</table>
																	</td>
																</tr>
															</table>

														</td>
													</tr>
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top"><label>NON Banking Days</label></td>
														<td align="left" valign="top" class="name">

															<table style="width:100%">
																<tr>
																	<td>
																		<input type="checkbox" name="chkNonBankingDays[]" id="chkNonBankingDays_Mon" value="Mon" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->monday) && $rowhalfday->monday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Monday<br/>
																		<input type="checkbox" name="chkNonBankingDays[]" id="chkNonBankingDays_Tue" value="Tue" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->tuesday) && $rowhalfday->tuesday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Tuesday<br/>
																		<input type="checkbox" name="chkNonBankingDays[]" id="chkNonBankingDays_Wed" value="Wed" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->wednesday) && $rowhalfday->wednesday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Wednesday<br/>
																		<input type="checkbox" name="chkNonBankingDays[]" id="chkNonBankingDays_Thu" value="Thu" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->thursday) && $rowhalfday->thursday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Thursday<br/>
																		<input type="checkbox" name="chkNonBankingDays[]" id="chkNonBankingDays_Fri" value="Fri" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->friday) && $rowhalfday->friday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Friday<br/>
																		<input type="checkbox" name="chkNonBankingDays[]" id="chkNonBankingDays_Sat" value="Sat" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->saturday) && $rowhalfday->saturday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Saturday<br/>
																		<input type="checkbox" name="chkNonBankingDays[]" id="chkNonBankingDays_Sun" value="Sun" onclick="manageWorkingDays(this)" <?php echo (isset($rowhalfday->sunday) && $rowhalfday->sunday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Sunday<br/>
																	</td>
																	<td valign="top"> 
																	&nbsp;
																	</td>
																</tr>
															</table>

														</td>
													</tr>
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top"><label>Weekly holiday</label></td>
														<td align="left" valign="top"  class="name">

														<table style="width:100%">
															<tr>
																<td>
																<input type="checkbox" name="chkHoliDays[]" id="chkHoliDays_Mon" value="Mon" onclick="manageWorkingDays(this)" <?php echo (isset($rowholiday->monday) && $rowholiday->monday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Monday<br/>
																<input type="checkbox" name="chkHoliDays[]" id="chkHoliDays_Tue" value="Tue" onclick="manageWorkingDays(this)" <?php echo (isset($rowholiday->tuesday) && $rowholiday->tuesday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Tuesday<br/>
																<input type="checkbox" name="chkHoliDays[]" id="chkHoliDays_Wed" value="Wed" onclick="manageWorkingDays(this)" <?php echo (isset($rowholiday->wednesday) && $rowholiday->wednesday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Wednesday<br/>
																<input type="checkbox" name="chkHoliDays[]" id="chkHoliDays_Thu" value="Thu" onclick="manageWorkingDays(this)" <?php echo (isset($rowholiday->thursday) && $rowholiday->thursday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Thursday<br/>
																<input type="checkbox" name="chkHoliDays[]" id="chkHoliDays_Fri" value="Fri" onclick="manageWorkingDays(this)" <?php echo (isset($rowholiday->friday) && $rowholiday->friday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Friday<br/>
																<input type="checkbox" name="chkHoliDays[]" id="chkHoliDays_Sat" value="Sat" onclick="manageWorkingDays(this)"  <?php echo (isset($rowholiday->saturday) && $rowholiday->saturday == 1) ? "checked=true" : ""; ?> />&nbsp;&nbsp;Saturday<br/>
																<input type="checkbox" name="chkHoliDays[]" id="chkHoliDays_Sun" value="Sun" onclick="manageWorkingDays(this)" <?php echo (isset($rowholiday->sunday) && $rowholiday->sunday == 1) ? "checked=true" : ""; ?>/>&nbsp;&nbsp;Sunday<br/>
																</td>
																<td valign="top"> 
																&nbsp;
																</td>
															</tr>
														</table>

														</td>
													</tr>
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top"><label>Clearing through</label></td>
														<td align="left" valign="top" class="name">
															<input type="radio" name = "radClearing" value="0" onclick="showclrcode()" <?php if(stripslashes($row->branch_clearingthrough)==0) echo "checked=true"; ?> />&nbsp;&nbsp;Self<br/>
															<input type="radio" name = "radClearing" value="1" onclick="showclrcode()" <?php if(stripslashes($row->branch_clearingthrough)==1) echo "checked=true"; ?> />&nbsp;&nbsp;Any other bank<br/>
															<div id="divclrbankcode" name="divclrbankcode" <?php if($row->branch_clearingthrough == 1){echo "style='display:block;  padding-top:8px'";}else{echo "style='display:none;  padding-top:8px'";} ?> >
																<label>Bank Code</label>&nbsp; - &nbsp;<input type="text" id="txtclrbankcode" name="txtclrbankcode" value="<?php echo stripslashes($row->clr_bank_code); ?>" />
															</div>
														</td>
													</tr>	
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top"><label>Clearing centre</label></td>
														<td align="left" valign="top" class="name">
															<input type="radio" name = "radClearingcentre"  value="0" onclick="showclrcity()"  <?php if(stripslashes($row->branch_clearingcenter)==0) echo "checked=true"; ?> />&nbsp;&nbsp;Same<br/>
															<input type="radio" name = "radClearingcentre"  value="1" onclick="showclrcity()" <?php if(stripslashes($row->branch_clearingcenter)==1) echo "checked=true"; ?> />&nbsp;&nbsp;Any other center<br/>
															
																<div id="divclrcitylist" <?php if($row->branch_clearingcenter == 1){echo "style='display:block;  padding-top:8px'";}else{echo "style='display:none;  padding-top:8px'";} ?>>
																	<label>Select City</label>&nbsp; - &nbsp;<select name="ddlclrcity" id="ddlclrcity" style="width:190px; height:26px;">
																	<option value="0"> Select City </option>
																	<?php 
																		$rowgetcity =  $db->get_results("select * from tb_citymaster");
																		foreach($rowgetcity as $eachcity){
																	?>
																	<option value="<?php echo $eachcity->city_id; ?>" <?php if(stripslashes($eachcity->city_id)== $row->clr_bank_city){echo "Selected";} ?>><?php echo $eachcity->city_place; ?></option>
																	<?php 
																		} 
																	?>
																	</select>
																
																</div>
														</td>
													</tr>  
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr> 

													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top">&nbsp;</td>
													</tr>
													<tr>
														<td align="left" valign="top">&nbsp;</td>
														<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
														<td width="100%" align="right" valign="top">
														<input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Back to previous page" onclick="window.location='installstep2.php'"  />&nbsp;&nbsp;<input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Click here to Edit" onclick="document.getElementById('branchname').focus();"  />&nbsp;&nbsp;<input name="submit1" type="submit" id="submit1" value="Go to next page" />
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
</body>
</html>
