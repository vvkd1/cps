<?php 
require_once('global.php');	
$rowbank = $db->get_row("select bank_code,bank_name from tb_bankdetails");
$row = $db->get_row("select * from tb_branchdetails where branch_id = 0");
$page_name = "branch_master";
authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php include('includes.php'); ?>

<script type="text/javascript" src="<?php echo ROOT_SCRIPTS; ?>jquery.timepicker.js"></script>
<link rel="stylesheet" href="<?php echo ROOT_STYLES;  ?>jquery.timepicker.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo ROOT_STYLES; ?>timePicker.css" />
<style>
 .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
 .ui-timepicker-div dl { text-align: left; }
 .ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
 .ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
 .ui-timepicker-div td { font-size: 90%; }
 .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
</style>
<script type="text/javascript">
	var vRules = {
			ddlBranchName: { required:true },
			bankCode: { required:true },
			branchCode: { required:true },
			cityCode: { required:true },
			ddlAccountType: { required:true },
			mircACNo: { required:true },
			noOfBooks: { required:true },
			bookSize: { required:true },
			custName: { required:true },
			custShortName: { required:true },
			address1: { required:true },
			ddlcountry: { required:true }, 
			city: { required:true }, 
			pin: { required:true }, 
			Bearer_Order: { required:true },
			custACNo: { required:true }
	};
	var vMessages = { 
			ddlBranchName: {required: "<br/>Please select branch name" }, 
			bankCode: { required: "<br/>Please enter bank code."}, 
			branchCode: { required: "<br/>Please enter branch code."}, 
			cityCode: { required: "<br/>Please enter city code" }, 
			ddlAccountType: { required: "<br/>Please select account type"},
			mircACNo: {required: "<br/>Please enter MICR account no" },
			noOfBooks: {required: "<br/>Please enter no of books" }, 
			bookSize: { required: "<br/>Please enter book size"}, 
			atpar: { required: "<br/>Please select atpar"}, 
			custName: { required: "<br/>Please enter customer name."}, 
			custShortName: { required: "<br/>Please enter customer short name."}, 
			address1: { required: "<br/>Please enter address"}, 
			city: {required: "<br/>Please enter city" }, 
			pin: {required: "<br/>Please enter pin" },
			Bearer_Order: {required: "<br/>Please enter Bearer/Order" },
			custACNo: { required:"<br/>Please enter customer account no/Order"} 
	};
	$(document).ready(function() {			
		$('#response,#ajax_loading,.loading').hide();
		$('#submit').button();				
		$('#manualentry').validate({
			rules: vRules,
			messages: vMessages,
			submitHandler: function(form) {
				$('#manualentry').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
						formData.push({ "name": "type", "value": "json" });
						$('.loading').show();
						$('#submitdiv').hide();
					}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
						if (resObj.status) {
								window.location = "personalprint2.php";
								//window.location = '<?php echo $_SERVER['PHP_SELF']; ?>';
						} else {	
							$('.loading').hide();
							$('#submitdiv').show();					
							$('#response').html('<div style="color:red" class="errormsg_boundary">'+resObj.htmlcontent+'<div>').show();
						}
					}
				});
			}
	});
		
	});

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
		xmlhttp.open("GET","post_branchmaster.php?contid="+str,true);
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
		xmlhttp.open("GET","post_branchmaster.php?stateid="+str,true);
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
		xmlhttp.open("GET","post_branchmaster.php?cityid="+str,true);
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
		xmlhttp.open("GET","post_branchmaster.php?suburbid="+str,true);
		xmlhttp.send();
	}

	function textCounter(field,cntfield,maxlimit) {
		if (field.value.length > maxlimit) // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
		else
		cntfield.value = maxlimit - field.value.length;
	}

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
	  
		function showclrcity()
		{
			if(document.getElementById("divclrcitylist").style.display == "none"){
				document.getElementById("divclrcitylist").style.display="block";
			}else{
				document.getElementById("divclrcitylist").style.display="none";
			}
		}
		
		
	function showchkno(showval){
		if(showval == "12"){
			document.getElementById("divchkno").style.display = "none";
		} 
		else{
			document.getElementById("divchkno").style.display = "block";
		}
	}
	
	function showBranchCityCode(str)
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
				var totalresponse = xmlhttp.responseText.split("@");
				
				document.getElementById("divBranchCode").innerHTML="";
				document.getElementById("divBranchCode").innerHTML=totalresponse[0];
				
				document.getElementById("divCityCode").innerHTML="";
				document.getElementById("divCityCode").innerHTML=totalresponse[1];
				
				//document.getElementById("divsuburblist").innerHTML="";
				//document.getElementById("divsuburblist").innerHTML=xmlhttp.responseText;
				//document.getElementById("divloadingsuburb").style.display="none";
			}
			else
			{
				//document.getElementById("divloadingsuburb").style.display="block";
			}
		}
		xmlhttp.open("GET","personalprint_post.php?branchID="+str,true);
		xmlhttp.send();
	}
	function changeAtpa(obj)
	{
		if($(obj).attr("checked"))
		{
			$("#atpar,.atpar").show();
			$("#atpar").rules("add", {
			  required: true
			});
		}
		else
		{
			$("#atpar,.atpar").hide();
			$("#atpar").rules("add", {
			  	required: false
			});
		}
	}
</script>
</head>
<body>

<?php require_once('header.php');	?>              
<div id="formdiv">
	
	<div id="formheading">Manual Print For <?php echo $rowbank->bank_name; ?></div>
	<div id="formfields">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
			<form id="manualentry" name="manualentry" method="post" action="personalprint_post.php" >
			<table width="880" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left" valign="top">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" valign="top"></td>
			  </tr>
			  <tr>
				<td align="left" valign="top">
				<input type="hidden" name="branchid" id="branchid" value="<?php echo stripslashes($row-> branch_id); ?>" style="width:373px;" />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
						
				  <tr>
					<td align="left" valign="top" width="100%">

					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  
					<tr>
						<td height="35" align="left" valign="top" width="20%"><label>Bank Name</label>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" name="bankname" id="bankname" readonly value="<?php echo "".$rowbank->bank_name.""; ?>" style="width:379px;" />
							</label>
						</td>
					</tr>
					   <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Branch Name</label><span class="red">*</span></td>
						<td align="left" valign="top" width="80%">
							<label>
								<select name="ddlBranchName" id="ddlBranchName" style="width:198px; height:26px;" onchange="showBranchCityCode(this.value)">
										<option value=""> Select Branch </option>
										<?php 
											$rowgetbranch =  $db->get_results("select branch_id,branch_name from tb_branchdetails");
											foreach($rowgetbranch as $eachbranch){
										?>
											<option value="<?php echo $eachbranch->branch_id; ?>"><?php echo $eachbranch->branch_name; ?></option>
										<?php 
											} 
										?>
								</select>
							</label>
						</td>
					  </tr>					
					  					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Bank Code</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" maxlength="4" value="<?php echo "".$rowbank->bank_code.""; ?>" readonly="true" name="bankCode" id="bankCode" style="width:190px;" />
							</label>
						</td>
					  </tr>
					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>Branch Code</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<div id="divBranchCode" >
								<label>
									<input type="text" maxlength="4" value="" readonly="true" name="branchCode" id="branchCode" style="width:190px;" />
								</label>
							</div>
						</td>
					  </tr>
					  
					  <tr>
						<td height="35" align="left" valign="top" width="20%"><label>City Code</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<div id="divCityCode" >
								<label>
									<input type="text" maxlength="4" value="" readonly="true" name="cityCode" id="cityCode" style="width:190px;" />
								</label>
							</div>
						</td>
					  </tr>
					  <tr>
					   <td height="35" align="left" valign="top" width="20%"><label>IFSC Code</label>
					   </td>
					   <td align="left" valign="top" width="80%">
						  <label>
						  <input type="text" value="<?php echo stripslashes($row->branch_neftifsccode); ?>" name="branchNEFT" id="branchNEFT" maxlength="11" style="width:190px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" />
						  </label>
					   </td>
					</tr>
					<tr>
						<td height="35" align="left" valign="top" width="20%"><label>Account Type</label><span class="red">*</span></td>
						<td align="left" valign="top" width="80%">
						<label>
							<select name="ddlAccountType" id="ddlAccountType" style="width:198px; height:26px;">
								<option value=""> Select Account Type </option>
								<?php 
								$rowgetbranch =  $db->get_results("select transactioncode,transactioncodedescription from tb_cps_transactioncodes");
								foreach($rowgetbranch as $eachbranch){
								?>
								<option value="<?php echo $eachbranch->transactioncode; ?>"><?php echo $eachbranch->transactioncodedescription; ?></option>
								<?php 
								} 
								?>
							</select>
						</label>
						</td>
					</tr>					  
					
					<tr>
						<td>
							
						</td>
						<td>						
							<?php
								$row = $db->get_row("SELECT chk_taken_from FROM tb_cps_settings");
								if($row->chk_taken_from == "0"){
							?>
								<div id="divchkno"> 
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top" width="17%" height="35px">
												<label>Cheque No. From</label><span class="red">*</span>
											</td>
											<td align="left" valign="top" width="83%">
												<input type="text" name="txtchqnofrom" id="txtchqnofrom" value="" style="width: 220px;" maxlength="10" onkeypress="return isNumberKey(event)"  />
											</td>
										</tr>
										<tr>
											<td align="left" valign="top" width="17%" height="35px">
												<label>Cheque No. To</label><span class="red">*</span>
											</td>
											<td align="left" valign="top" width="83%">
												<input type="text" name="txtchqnoto" id="txtchqnoto" value="" style="width: 220px;" maxlength="10" onkeypress="return isNumberKey(event)" />
											</td>
										</tr>
									</table>
								</div>
							<?php 
								}
							?>
						</td>
					</tr>					
					<tr>
						<td height="35" align="left" valign="top" width="20%"><label>Customer A/C No.</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" value="" name="custACNo" id="custACNo" style="width:190px;" maxlength="20" />
							</label>
						</td>
					</tr>
					<tr>
						<td height="35" align="left" valign="top" width="20%"><label>MIRC A/C No.</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" value="" name="mircACNo" id="mircACNo" style="width:190px;" maxlength="6" onkeypress="return isNumberKey(event)" />
							</label>
						</td>
					</tr>
					
					<tr>
						<td height="35" align="left" valign="top" width="20%"><label>No Of Books</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" value="" name="noOfBooks" id="noOfBooks" style="width:190px;" maxlength="2" onkeypress="return isNumberKey(event)" />
							</label>
						</td>
					</tr>
					
					<tr>
						<td height="35" align="left" valign="top" width="20%"><label>Book SIze</label><span class="red">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<label>
								<input type="text" value="" name="bookSize" id="bookSize" style="width:190px;" maxlength="3" onkeypress="return isNumberKey(event)" />
							</label>
						</td>
					</tr>
					
					<tr>
						<td height="35" align="left" valign="top" width="20%"><label>Bearer/Order</label><span class="red">*</span></td>
						<td align="left" valign="top" width="80%">
							<label>
								<select name="Bearer_Order" id="Bearer_Order" style="width:198px; height:26px;">
									<option value="">== Select ==</option>
									<option value="0">Bearer</option>
									<option value="1">Order</option>
								</select>
							</label>
						</td>
					</tr>
					
					<tr>
						<td height="35" align="left" valign="top" width="20%"><label>Atpar</label><span class="red atpar" style="display: none;">*</span>
						</td>
						<td align="left" valign="top" width="80%">
							<label><span><input type="checkbox" id="chk_atpar" name="chk_atpar" onchange="changeAtpa(this);" /> </span></label>
							<label>
								<span><input type="text" value="" name="atpar" id="atpar" style="width:174px;display: none;" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></span>
							</label>
						</td>
					</tr>
					
					
					
					</table>
					</td>
					<td width="270" align="left" valign="top"></td>
				  </tr>
				  
				</table></td>
			  </tr>
			 
			  <tr>
				<td align="left" valign="top">
				<table width="80%" border="0" cellspacing="0" cellpadding="0">				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Customer Name</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="custName" id="custName"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />			
						</label>
					</td>
				</tr>
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Customer Short Name</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="custShortName" id="custShortName"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />			
						</label>
					</td>
				</tr>				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Joint Name 1</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="jointName1" id="jointName1"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Joint Name 2</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="jointName2" id="jointName2"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Sign Authority 1</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="signAuth1" id="signAuth1"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />&nbsp;<label>
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Sign Authority 2</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="signAuth2" id="signAuth2"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />&nbsp;<label>
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Sign Authority 3</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="signAuth3" id="signAuth3"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Address Line1</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="address1" id="address1"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />&nbsp;<label>(35 characters)</label>
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Address Line2</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="address2" id="address2"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />&nbsp;<label>(35 characters)</label>
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Address Line3</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="branchaddress3" id="branchaddress3"  style="width:300px;" value="" onKeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="35" />&nbsp;<label>(35 characters)</label>
							
						</label>
					</td>
				</tr>
				
				<tr>
					<td width="25%" height="35" align="left" valign="top"><label>City</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">						
						<input type="text" name="city" id="city" value="" style="width:190px;" />							
					</td>
				</tr>
				
											
				<tr>
					<td width="25%" height="35" align="left" valign="top"><label>Zip/Pin Code</label><span class="red">*</span></td>
					<td width="78%" align="left" valign="top">						
						<input type="text" name="pin" id="pin" value="" style="width:190px;" />							
					</td>
				</tr>
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Cust Res No.</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="custResNo" id="custResNo" value="" maxlength="15" onkeypress="return isNumberKey(event)" style="width:190px;" />
						</label>
					</td>
				</tr>
				
				
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Cust Off No.</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="custOffNo" id="custOffNo" value="" maxlength="15" onkeypress="return isNumberKey(event)" style="width:190px;" />
						</label>
					</td>
				</tr>
				 
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Cust Mobile No.</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							+91<input type="text" name="custMobNo" id="custMobNo" value="" maxlength="15" onkeypress="return isNumberKey(event)" style="width:167px;" />
						</label>
					</td>
				</tr> 
				
<!--				<tr>-->
<!--					<td width="22%" height="35" align="left" valign="top"><label>PR Code</label></td>-->
<!--					<td width="78%" align="left" valign="top">-->
<!--						<label>-->
<!--							<input type="text" name="PRCOde" id="PRCOde" value="" style="width:190px;" />-->
<!--						</label>-->
<!--					</td>-->
<!--				</tr> -->
<!--				-->
				<tr>
					<td width="22%" height="35" align="left" valign="top"><label>Cust Email Id</label></td>
					<td width="78%" align="left" valign="top">
						<label>
							<input type="text" name="custEmailId" id="custEmailId" value="" style="width:190px;" />
						</label>
					</td>
				</tr>
											
				<tr>
					<td align="left" valign="top">&nbsp;</td>
					<td align="left" valign="top"><div id="response"></div></td>
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
								<input type="button" name="submit2" id="submit2" value="Discard" class="submitbutton" onClick="window.location.href='home.php'" />
								<input type="button" name="submit3" id="submit3" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
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
<?php require_once('footer.php');	?> 	
</body>
</html>
