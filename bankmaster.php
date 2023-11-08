<?php 
require_once('global.php');	
$row = $db->get_row("select * from tb_bankdetails");
$jq = true;
$form = true;
$valid = true;	
$ui = true;
$page_name = "bank_master";

$printersinfo = "";
if(!empty($row->bank_printers)){
	$printersinfo = unserialize($row->bank_printers);
}

authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<link rel="stylesheet" href="css/stylecss.css" type="text/css" />
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		var vRules = { txtbankname: { required:true }, ddlcountry: { required:true }, ddlstate:{required:true},ddlcity: { required:true },ddlsuburb: { required:true },branchaddress1: { required:true },txtpin: { required:true }, txtEmailCont1: {email:true }};
		var vMessages = { txtbankname: { required: "<br/>Please enter bank name." }, ddlcountry: { required: "<br/>Please select country." }, ddlstate:{required:"<br/>Please select state."},ddlcity: { required:"<br/>Please select city." },ddlsuburb: { required:"<br/>Please select location." },branchaddress1: { required:"Please enter address line 1." },txtpin: { required:"<br/>Please enter zip/pin code." }, txtcontper1: { required: "<br/>Please enter contact person 1." },txtMobile1: { required:"<br/>Please enter Mob no." }, txtLLCont1: { required: "<br/>Please enter land line No." },txtEmailCont1: {required:"<br/>Please enter emailid.", email:"<br>Please enter correct email id</br>"}};
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
									alert("Bank details updated Sucessfully.");
									//window.location = "bankmaster.php";
									window.location = resObj.loc;
							} else {	
								$('.loading').hide();
								$('#response').html('<div class="errormsg_boundary">'+resObj.htmlcontent+'<div>').show();
							}
						}
						
					});
				}
			});
		});
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
            return false;

         return true;
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
			xmlhttp.open("GET","post_bankmaster.php?contid="+str,true);
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
			xmlhttp.open("GET","post_bankmaster.php?stateid="+str,true);
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
			xmlhttp.open("GET","post_bankmaster.php?cityid="+str,true);
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
			xmlhttp.open("GET","post_bankmaster.php?suburbid="+str,true);
			xmlhttp.send();
		}
	</script>
	<SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			if(charCode != 08)
			{
				alert("Only numbers allowed");
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	  
	  function isNumberKey1(evt)
      {
        var charCode = (evt.which) ? evt.which : event.keyCode
		//alert(charCode);
        if (charCode > 31 && (charCode < 48 || charCode > 57) || charCode == 08)
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

<?php require_once('header.php');	?>
                
                <div id="formdiv">
                	<div id="formheading">Bank Master</div>
                    <div id="formfields">
                    <form id="frmbankmaster" name="frmbankmaster" method="post" action="post_bankmaster.php" autocomplete="off">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
						  <table width="880" border="0" cellspacing="0" cellpadding="0">
 
   <tr>
    <td align="left" valign="top" style="height:35px"><div id="response"></div></td>
  </tr>
  
	<tr>
		<td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>      
				<td width="24%" align="left" valign="top"><label>Bank Name</label><span class="red">*</span></td>
				<td width="89%" height="35" align="left" valign="top"><label>
					<input type="text" name="txtbankname" id="txtbankname" style="width:655px;" value="<?php echo stripslashes($row->bank_name); ?>" maxlength="80" onKeyPress="return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
					</label>
				</td>
			</tr>
		  </table>
		</td>
	</tr>
	
	<tr>
		<td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>      
				<td width="24%" align="left" valign="top"><label>Bank Code</label><span class="red">*</span></td>
				<td width="89%" height="35" align="left" valign="top"><label>
					<input type="text" name="txtbankcode" id="txtbankcode" maxlength="4" style="width:655px;" value="<?php echo stripslashes($row->bank_code); ?>" maxlength="35" onKeyPress = "return isNumberKey(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
					</label>
				</td>
			</tr>
		  </table>
		</td>
	</tr>
	
	<tr>
		<td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>      
				<td width="11%" align="left" valign="top"><label>Address Line1</label><span class="red">*</span></td>
				<td width="34%" height="35" align="left" valign="top"><label>
					<input type="text" name="branchaddress1" id="branchaddress1" style="width:300px;" maxlength="35" value="<?php echo stripslashes($row->bank_address1); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" />&nbsp;<label>(35 characters)</label>
					</label>
				</td>
			</tr>
		  </table>
		</td>
	</tr>
	
	
	<tr>
		<td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>      
				<td width="11%" align="left" valign="top"><label>Address Line2</label></td>
				<td width="34%" height="35" align="left" valign="top"><label>
					<input type="text" name="branchaddress2" id="branchaddress2"  style="width:300px;" maxlength="35" value="<?php echo stripslashes($row->bank_address2); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" />&nbsp;<label>(35 characters)</label>
					</label>
				</td>
			</tr>
		  </table>
		</td>
	</tr>
	
	<tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
         <td width="11%" height="35" align="left" valign="top"><label>Address Line3</label></td>
		<td width="34%" align="left" valign="top">
			<label>
				<input type="text" name="branchaddress3" id="branchaddress3"  style="width:300px;" maxlength="35" value="<?php echo stripslashes($row->bank_address3); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" />&nbsp;<label>(35 characters)</label>				
			</label>
		</td>        
        </tr>
		</table></td>
	</tr>
	
	<tr>
		<td colspan="2" align="left" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>      
					<td width="11%" align="left" valign="top"><label>Country</label><span class="red">*</span></td>
					<td width="34%" align="left" valign="top" height="35">
						<label>
							<select name="ddlcountry" id="ddlcountry" style="width:190px; height:26px;" onchange="showStates(this.value)">
							<option value=""> Select Country</option>
								<?php 
									$rowgetcountry =  $db->get_results("select * from tb_countrymaster");
									foreach($rowgetcountry as $eachcountry){
								?>
									<option value="<?php echo $eachcountry->country_id; ?>" <?php if(stripslashes($eachcountry->country_id)== $row->bank_country_id){echo "Selected";} ?>><?php echo $eachcountry->country_name; ?></option>
								<?php 
									} 
								?>
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
					<td width="11%" align="left" valign="top"><label>State</label><span class="red">*</span></td>
					<td width="34%" height="35" align="left" valign="top">
						<label>
							<div id ="divloadingstate" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
							<div id="divstatelist">
								<select name="ddlstate" id="ddlstate" style="width:190px; height:26px;" onchange="showCity(this.value)">
									<option value=""> Select State</option>
									<?php 
										$rowgetstate =  $db->get_results("select * from tb_statemaster where country_id = ".$row->bank_country_id."");
										foreach($rowgetstate as $eachstate){
									?>
									<option value="<?php echo $eachstate->state_id; ?>" <?php if(stripslashes($eachstate->state_id)== $row->bank_state_id){echo "Selected";} ?>><?php echo $eachstate->state_name; ?></option>
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
					<td width="11%" align="left" valign="top"><label>City</label><span class="red">*</span></td>
					<td width="34%" align="left" valign="top" height="35">
						<label>
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
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td colspan="2" align="left" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>      
					<td width="11%" align="left" height="35" valign="top"><label>location</label><span class="red">*</span></td>
					<td width="34%" align="left" valign="top">
						<label>
							<div id ="divloadingsuburb" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
							<div id="divsuburblist">
								<select name="ddlsuburb" id="ddlsuburb" style="width:190px; height:26px;" onchange="showpostalcode(this.value)">
								<option value=""> Select location </option>
								<?php 
									$rowgetsuburb =  $db->get_results("select * from tb_suburbmaster where city_id = '".$row->bank_city_id."'");
									if($rowgetsuburb){
									foreach($rowgetsuburb as $eachsuburb){
								?>
								<option value="<?php echo $eachsuburb->suburb_id; ?>" <?php if(stripslashes($eachsuburb->suburb_id)== $row->bank_suburb_id){echo "Selected";} ?>><?php echo $eachsuburb->suburb_name; ?></option>
								<?php 
									} 
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
					<td width="11%" align="left" height="35" valign="top"><label>Zip/Pin Code</label><span class="red">*</span></td>
					<td width="34%" align="left" valign="top">
						<label>
							<div id ="divloadingcode" style="display:none"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>
							<div id="divpostalcode" name="divpostalcode">
								<input type="text" name="txtpin" id="txtpin" style="width:255px;" value="<?php echo stripslashes($row->bank_pin); ?>" readonly="true" />
							<div>
						</label>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
  <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
        <td width="11%" height="35" align="left" valign="top"><label>Contact Person 1 Name</label></td>
			<td width="34%" align="left" valign="top"><label>
				<input type="text" name="txtcontper1" id="txtcontper1" style="width:255px;" value="<?php echo stripslashes($row->bank_contact_per1); ?>" maxlength="35" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>
				</label>
			</td>        
        </tr>
      </table></td>
  </tr>
  
  <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>      
        <td width="11%" align="left" valign="top"><label>Contact Person 1 Mob No.</label></td>
        <td width="34%" height="35" align="left" valign="top"><label>
          <input type="text" name="txtMobile1" id="txtMobile1" style="width:255px;" value="<?php echo stripslashes($row->bank_contact_no1); ?>" maxlength="35" onKeyPress = "return isNumberKey(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>
          </label></td>
        </tr>
      </table></td>
  </tr>
  
   <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>      
        <td width="11%" align="left" valign="top"><label>Contact Person 1 Land Line No.</label></td>
        <td width="34%" height="35" align="left" valign="top"><label>
          <input type="text" name="txtLLCont1" id="txtLLCont1" style="width:255px;" value="<?php echo stripslashes($row->bank_contact_per_LL1); ?>" maxlength="35" onKeyPress = "return isNumberKey(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>
          </label></td>
        </tr>
      </table></td>
  </tr>
  
   <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>      
        <td width="11%" align="left" valign="top"><label>Contact Person 1 EmailId</label></td>
        <td width="34%" height="35" align="left" valign="top"><label>
          <input type="text" name="txtEmailCont1" id="txtEmailCont1" style="width:255px;" value="<?php echo stripslashes($row->bank_emailid); ?>" maxlength="35" />
          </label></td>
        </tr>
      </table></td>
  </tr>
  
  <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>      
        <td width="11%" align="left" valign="top"><label>Contact Person 2 Name</label></td>
        <td width="34%" height="35" align="left" valign="top"><label>
          <input type="text" name="txtcontper2" id="txtcontper2" style="width:255px;" value="<?php echo stripslashes($row->bank_contact_per2); ?>" maxlength="35" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>
          </label></td>
        </tr>
      </table></td>
  </tr>
  
  <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>      
        <td width="11%" align="left" valign="top"><label>Contact Person 2 Mob No.</label></td>
        <td width="34%" height="35" align="left" valign="top"><label>
          <input type="text" name="txtMobile2" id="txtMobile2" style="width:255px;" value="<?php echo stripslashes($row->bank_contact_no1); ?>" maxlength="35" onKeyPress = "return isNumberKey(event)" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>
          </label></td>
        </tr>
      </table></td>
  </tr>
  
  <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>      
        <td width="11%" align="left" valign="top"><label>Contact Person 2 Land Line No.</label></td>
        <td width="34%" height="35" align="left" valign="top"><label>
          <input type="text" name="txtLLCont2" id="txtLLCont2" style="width:255px;" value="<?php echo stripslashes($row->bank_contact_per_LL2); ?>" maxlength="35" onKeyPress = "return isNumberKey(event)" onKeyUp="javascript:this.value=this.value.toUpperCase();"/>
          </label></td>
        </tr>
      </table></td>
  </tr>
 
  <tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>      
        <td width="11%" align="left" valign="top"><label>Contact Person 2 EmailId</label></td>
        <td width="34%" height="35" align="left" valign="top"><label>
          <input type="text" name="txtEmailCont2" id="txtEmailCont2" style="width:255px;" value="<?php echo stripslashes($row->bank_emailid2); ?>" maxlength="35" />
          </label></td>
        </tr>
      </table></td>
  </tr>
 
	<tr>
    <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>      
        <td width="11%" align="left" valign="top"><label>Web Site</label></td>
        <td width="34%" height="35" align="left" valign="top"><label>
          <label>http://</label><input type="text" name="txtwebsite" id="txtwebsite"  style="width:213px;" value="<?php echo stripslashes($row->bank_website); ?>"  maxlength="50"/>
          </label></td>
        </tr>
      </table></td>
  </tr>

  <tr>
					<td colspan="2" align="left" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="25%" align="left" valign="top"><label>Printer Name </label><span class="red">*</span></td>
								<td width="25%" align="left" valign="top">
									<input type="text" class="required" title="Please enter printer name" name="printername[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[0][0]; ?>" style="width:190px;" />
								</td>
								<td width="22%" align="left" valign="top"><label>Tray Name 1/2 </label><span class="red">*</span></td></td>
								<td width="28%" height="35" align="left" valign="top">
									<input type="text" class="required" name="printertray1[]" title="Please enter tray 1" value="<?php if(!empty($printersinfo)) echo $printersinfo[0][1]; ?>" style="width:100px;" />&nbsp;
									<input type="text" name="printertray2[]" class="required" title="Please enter tray 2" value="<?php if(!empty($printersinfo)) echo $printersinfo[0][2]; ?>" style="width:100px;" />
								</td>
							</tr>
							<!--<tr>
								<td width="25%" align="left" valign="top"><label>Printer Ip/Name 2</label></td>
								<td width="25%" align="left" valign="top">
									<input type="text" name="printername[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[1][0]; ?>" style="width:190px;" />
								</td>
								<td width="22%" align="left" valign="top"><label>Tray Name 1/2 </label></td></td>
								<td width="28%" height="35" align="left" valign="top">
									<input type="text" name="printertray1[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[1][1]; ?>" style="width:100px;" />&nbsp;
									<input type="text" name="printertray2[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[1][2]; ?>" style="width:100px;" />
								</td>
							</tr>
							<tr>
								<td width="25%" align="left" valign="top"><label>Printer Ip/Name 3</label></td>
								<td width="25%" align="left" valign="top">
									<input type="text" name="printername[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[2][0]; ?>" style="width:190px;" />
								</td>
								<td width="22%" align="left" valign="top"><label>Tray Name 1/2 </label></td></td>
								<td width="28%" height="35" align="left" valign="top">
									<input type="text" name="printertray1[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[2][1]; ?>" style="width:100px;" />&nbsp;
									<input type="text" name="printertray2[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[2][2]; ?>" style="width:100px;" />
								</td>
							</tr>
							<tr>
								<td width="25%" align="left" valign="top"><label>Printer Ip/Name 4</label></td>
								<td width="25%" align="left" valign="top">
									<input type="text" name="printername[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[3][0]; ?>" style="width:190px;" />
								</td>
								<td width="22%" align="left" valign="top"><label>Tray Name 1/2 </label></td></td>
								<td width="28%" height="35" align="left" valign="top">
									<input type="text" name="printertray1[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[3][1]; ?>" style="width:100px;" />&nbsp;
									<input type="text" name="printertray2[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[3][2]; ?>" style="width:100px;" />
								</td>
							</tr>
							<tr>
								<td width="25%" align="left" valign="top"><label>Printer Ip/Name 5</label></td>
								<td width="25%" align="left" valign="top">
									<input type="text" name="printername[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[4][0]; ?>" style="width:190px;" />
								</td>
								<td width="22%" align="left" valign="top"><label>Tray Name 1/2 </label></td></td>
								<td width="28%" height="35" align="left" valign="top">
									<input type="text" name="printertray1[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[4][1]; ?>" style="width:100px;" />&nbsp;
									<input type="text" name="printertray2[]" value="<?php if(!empty($printersinfo)) echo $printersinfo[4][2]; ?>" style="width:100px;" />
								</td>
							</tr>-->
						</table>
					</td>
				</tr>
  
  <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" align="left" valign="top">
				<?php if(authentication_groups_pemissions("bank_master","","Y","","Y")):?>
				<input name="submit1" type="submit" id="submit1" value="Save"/>
				<input type="submit" name="submit1" id="submit1" value="Save and Close" class="submitbutton" />
				<?php endif;?>
				<input type="button" name="submit2" id="submit2" value="Cancel" class="submitbutton" onClick="window.location.href='home.php'" />
				
				<div class="loading"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
            </td>
            <td width="34%" align="left" valign="top"></td>
          </tr>
		  <tr>
			<td>
				&nbsp;
			</td>
		  </tr>
        </table></td>
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
<?php require_once('footer.php');	?> 	
</body>
</html>
