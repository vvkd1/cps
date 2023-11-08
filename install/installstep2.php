<?php  
require_once('../global.php');
$row = $db->get_row("select * from tb_bankdetails");
if(count($row) < 1)
{
	$row = (object) array( "bank_id" =>  "","bank_name" =>  "","bank_code" =>  "","bank_address1" =>  "","bank_address2" =>  "","bank_address3" =>  "","bank_country_id" =>  "","bank_state_id" =>  "","bank_city_id" =>  "","bank_suburb_id" =>  "","bank_pin" =>  "","bank_contact_no1" =>  "","bank_contact_no2" =>  "","bank_contact_per1" =>  "","bank_contact_per2" =>  "","bank_emailid" =>  "","bank_website" =>  "") ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
<?php include('../includes.php'); ?>
<script type="text/javascript">
		var vRules = { txtbankname: { required:true }, ddlcountry: { required:true },branchaddress1: { required:true },txtcontno1: { required:true },txtemailid: { required:true,email:true }, ddlstate: { required:true }, ddlcity: { required:true }, ddlsuburb: { required:true }, txtpin: { required:true }, txtcontno2: { required:true }, txtcontper1: { required:true } , txtcontper2: { required:true }};
		var vMessages = { txtbankname: { required: "<br/>Please enter bank name." }, ddlcountry: { required: "<br/>Please select country." },branchaddress1: { required:"Please enter address line 1." },txtcontno1: { required:"<br/>Please enter contact no 1." },txtemailid: {required:"<br/>Please enter emailid.", email:"<br>Please enter correct email id</br>"}, ddlstate: { required: "<br/>Please select state." }, ddlcity: { required: "<br/>Please select city." }, ddlsuburb: { required: "<br/>Please select suburb." }, txtpin: { required: "<br/>Please select zip/pin." }, txtcontno2: { required: "<br/>Please enter contact no. 2." }, txtcontper1: { required: "<br/>Please enter contact person 1." }, txtcontper2: { required: "<br/>Please enter contact person 2." } };
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit1').button();		
			$('#frmbankmaster').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frmbankmaster').ajaxSubmit({
						target: '#response', 
						beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, 
						clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									window.location = "installstep3.php";
							} else {	
								$('.loading').hide();
								$('#response').html('<div class="red">'+resObj.htmlcontent+'<div>').show();
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
			xmlhttp.open("GET","post_installstep2.php?contid="+str,true);
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
			xmlhttp.open("GET","post_installstep2.php?stateid="+str,true);
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
			xmlhttp.open("GET","post_installstep2.php?cityid="+str,true);
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
			xmlhttp.open("GET","post_installstep2.php?suburbid="+str,true);
			xmlhttp.send();
		}
		
		function fillbankcode()
		{
			var bankname = document.getElementById("txtbankname").value;
			if(bankname != ""){
				if(bankname.length > 3){
					var bankcode = bankname.substring(0, 3);
					document.getElementById("txtbankcode").value = bankcode + "001";
				}else{
					document.getElementById("txtbankcode").value = bankname + "001";
				}
			}
			
		}
	</script>
	
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
					<div id="formheading">Bank Master</div>
					<div id="formfields">
						<form id="frmbankmaster" name="frmbankmaster" method="post" action="post_installstep2.php" autocomplete="off">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
										<table width="880" border="0" cellspacing="0" cellpadding="0">

											<tr>
												<td align="left" valign="top" style="height:35px"><div id="response"></div></td>
												</tr>
												<tr>
												<td align="left" valign="top" width="16%"><label>Bank Name </label><span class="red">*</span></td>
												<td height="35" align="left" width="84%" valign="top"><label>
												<input type="text" name="txtbankname" id="txtbankname" style="width:655px;" value="<?php echo stripslashes($row->bank_name); ?>" maxlength="35" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress = "return isNumberKey1(event);" />
												</label></td>
											</tr>

											<tr>
												<td align="left" valign="top" width="16%"><label>Bank Code </label></td>
												<td height="35" align="left" width="84%" valign="top"><label>
												<input type="text" readonly="true" name="txtbankcode" id="txtbankcode" style="width:655px;" value="<?php echo stripslashes($row->bank_code); ?>" onfocus="fillbankcode();" maxlength="35" onKeyUp="javascript:this.value=this.value.toUpperCase();" onKeyPress = "return isNumberKey1(event);" />
												</label></td>
											</tr>

											<tr>
												<td width="16%" height="35" align="left" valign="top"><label>Address Line1</label><span class="red">*</span></td>
												<td width="84%" align="left" valign="top">
												<input type="text" name="branchaddress1" id="branchaddress1"  style="width:300px;"  value="<?php echo stripslashes($row->bank_address1); ?>" maxlength="35" onKeyUp="javascript:this.value=this.value.toUpperCase();" />&nbsp;<label>(35 characters)</label>
												</td>
											</tr>

											<tr>
												<td width="16%" height="35" align="left" valign="top"><label>Address Line2</label></td>
												<td width="84%" align="left" valign="top">
												<input type="text" name="branchaddress2" id="branchaddress2"  style="width:300px;" value="<?php echo stripslashes($row->bank_address2); ?>" maxlength="35" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>&nbsp;<label>(35 characters)</label>
												</td>
											</tr>

											<tr>
												<td width="16%" height="35" align="left" valign="top"><label>Address Line3</label></td>
												<td width="84%" align="left" valign="top">
												<input type="text" name="branchaddress3" id="branchaddress3"  style="width:300px;" value="<?php echo stripslashes($row->bank_address3); ?>" maxlength="35" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>&nbsp;<label>(35 characters)</label>
												</td>
											</tr>



											<tr>
												<td colspan="2" align="left" valign="top">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="16%" align="left" valign="top"><label>Country</label><span class="red">*</span></td>
															<td width="34%" align="left" valign="top" height="35">
															<label>
															<select name="ddlcountry" id="ddlcountry" style="width:190px; height:26px;" onchange="showStates(this.value)" >
																<option value=""> Select Country</option>
																<?php 
																$rowgetcountry =  $db->get_results("select * from tb_countrymaster");
																foreach($rowgetcountry as $eachcountry){
																?>
																<option value="<?php echo $eachcountry->country_id; ?>" <?php if(stripslashes($eachcountry->country_id)== "105"){echo "Selected";} ?>><?php echo $eachcountry->country_name; ?></option>
																<?php 
																} 
																?>
															</select>
															</label>
															</td>
															<td width="16%" align="left" valign="top"><label>State</label><span class="red">*</span></td>
															<td width="34%" height="35" align="left" valign="top">
															<label>
																<div id ="divloadingstate" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
																<div id="divstatelist">
																	<select name="ddlstate" id="ddlstate" style="width:190px; height:26px;" onchange="showCity(this.value)">
																		<option value=""> Select State</option>
																		<?php 
																			$rowgetstate =  $db->get_results("select * from tb_statemaster");
																			foreach($rowgetstate as $eachstate){
																		?>
																		<option value="<?php echo $eachstate->state_id; ?>" <?php if(stripslashes($eachstate->state_id)== $row->bank_state_id){echo "Selected";} ?>><?php echo $eachstate->state_name; ?></option>
																		<?php 
																			} 
																		?>
																	</select>
																</div>
																<!--<select name="ddlstate" id="ddlstate" style="width:200px; height:26px;">
																<option value="">State will be added after installation</option>-->
															</select>
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
															<td width="16%" align="left" valign="top"><label>City</label><span class="red">*</span></td>
															<td width="34%" align="left" valign="top" height="35">
															<label>
																<!--<div id="divcitylist">
																<select name="ddlstate" id="ddlstate" style="width:200px; height:26px;">
																<option value="">City will be added after installation</option>
																</select>
																</div>-->
																<div id ="divloadingcity" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
																<div id="divcitylist">
																	<select name="ddlcity" id="ddlcity" style="width:190px; height:26px;" onchange="showSuburb(this.value)" >
																	<option value=""> Select City </option>
																	<?php 
																		$rowgetcity =  $db->get_results("select * from tb_citymaster where state_id = ".$row->bank_state_id."");
																		foreach($rowgetcity as $eachcity){
																	?>
																	<option value="<?php echo $eachcity->city_id; ?>" <?php if(stripslashes($eachcity->city_id)== $row->bank_city_id){echo "Selected";} ?>><?php echo $eachcity->city_place; ?></option>
																	<?php 
																		} 
																	?>
																	</select>
																</div>
															</label>
															</td>
															<td width="16%" align="left" valign="top"><label>Suburb</label><span class="red">*</span></td>
															<td width="34%" align="left" valign="top">
															<label>
																<!--<div id="divsuburblist">
																<select name="ddlstate" id="ddlstate" style="width:200px; height:26px;">
																<option value="">Suburb will be added after installation</option>
																</select>
																</div>-->
																<div id ="divloadingsuburb" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
																<div id="divsuburblist">
																	<select name="ddlsuburb" id="ddlsuburb" style="width:190px; height:26px;" onchange="showpostalcode(this.value)">
																	<option value=""> Select Suburb </option>
																	<?php 
																		$rowgetsuburb =  $db->get_results("select * from tb_suburbmaster where city_id = '".$row->bank_city_id."'");
																		foreach($rowgetsuburb as $eachsuburb){
																	?>
																	<option value="<?php echo $eachsuburb->suburb_id; ?>" <?php if(stripslashes($eachsuburb->suburb_id)== $row->bank_suburb_id){echo "Selected";} ?>><?php echo $eachsuburb->suburb_name; ?></option>
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
															<td width="16%" align="left" valign="top"><label> Zip/Pin Code </label><span class="red">*</span></td>
															<td width="34%" align="left" valign="top">
															<label>
																<div id ="divloadingcode" style="display:none"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
																<div id="divpostalcode" name="divpostalcode" style="float:left">
																	<input type="text" name="txtpin" id="txtpin" style="width:150px;" readonly value="<?php echo stripslashes($row->bank_pin); ?>" />
																</div>
															</label>
															</td>
															<td width="16%" align="left" valign="top"><label> </label></td>
															<td width="34%" height="35" align="left" valign="top"><label>

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
															<td width="16%" align="left" valign="top"><label>Contact No.1</label><span class="red">*</span></td>
															<td width="34%" align="left" valign="top"><label>
															+91<input type="text" name="txtcontno1" id="txtcontno1" style="width:230px;" value="<?php echo stripslashes($row->bank_contact_no1); ?>" maxlength="15" onkeypress="return isNumberKey(event)" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
															</label></td>
															<td width="16%" align="left" valign="top"><label>Contact No.2</label><span class="red">*</span></td>
															<td width="34%" height="35" align="left" valign="top"><label>
															+91<input type="text" name="txtcontno2" id="txtcontno2" style="width:230px;" value="<?php echo stripslashes($row->bank_contact_no2); ?>" maxlength="15" onkeypress="return isNumberKey(event)" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
															</label></td>
														</tr>
													</table>
												</td>
											</tr>

											<tr>
												<td colspan="2" align="left" valign="top">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="16%" align="left" valign="top"><label>Contact Person 1 </label><span class="red">*</span></td>
															<td width="34%" align="left" valign="top"><label>
															<input type="text" name="txtcontper1" id="txtcontper1" style="width:255px;" value="<?php echo stripslashes($row->bank_contact_per1); ?>" maxlength="35" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
															</label></td>
															<td width="16%" align="left" valign="top"><label>Contact Person 2 </label><span class="red">*</span></td>
															<td width="34%" height="35" align="left" valign="top"><label>
															<input type="text" name="txtcontper2" id="txtcontper2" style="width:255px;" value="<?php echo stripslashes($row->bank_contact_per2); ?>" maxlength="35" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
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
															<td width="16%" align="left" valign="top"><label>EmailId</label><span class="red">*</span></td>
															<td width="34%" align="left" valign="top"><label>
															<input type="text" name="txtemailid" id="txtemailid" style="width:255px;" value="<?php echo stripslashes($row->bank_emailid); ?>" maxlength="35"/>
															</label></td>
															<td width="16%" align="left" valign="top"><label>Web Site</label></td>
															<td width="34%" height="35" align="left" valign="top">
															<label>http://</label><input type="text" name="txtwebsite" id="txtwebsite" style="width:210px;" value="<?php echo stripslashes($row->bank_website); ?>" maxlength="50"/>
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
												<td align="left" valign="top">&nbsp;</td>
												<td align="left" valign="top">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="100%" align="right" valign="top">
															<input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Back to previous page" onclick="window.location='installstep1.php'"  />&nbsp;&nbsp;<input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Click here to Edit" onclick="document.getElementById('txtbankname').focus();"  />&nbsp;&nbsp;<input name="submit1" type="submit" id="submit1" value="Go to next page"/>
															<div class="loading"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
															</td>
															<td width="35%" align="left" valign="top"></td>
														</tr>
														<tr>
															<td>
															&nbsp;
															</td>
														</tr>
													</table>
												</td>
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
