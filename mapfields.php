<?php 
	require_once('global.php');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<link rel="stylesheet" href="css/stylecss.css" type="text/css" />
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	/*
	$('input[name="d_datatype[]"]').each(function(){
	  alert($(this).val());
	});
	*/
	
});
	
	function submitform() {
		var result_array = [];
		$.each($('input[name="d_datatype[]"]'), function(index, value) { 
		  //alert(index + ': ' + $(this).val() + ': '+$(this).attr('rel')); 
		  var id = $(this).attr('id');
		  var d_dt = $(this).val(); // defined / our datatype
		  //get defined len textbox id
		  var len_txtbox_id = $(this).attr('rel').split(':')[0]; //
		  var txt_len = $("#"+len_txtbox_id).val(); // defined / our length
		  //get user selected datatype name
		  var dt_dropdown_id = $(this).attr('rel').split(':')[1];
		  var u_dt = $("#"+dt_dropdown_id).val();
		  // get user entered len
		  var len_user_id = $(this).attr('rel').split(':')[2];
		  var u_len = $("#"+len_user_id).val();
		  var maxlen_user_id = len_txtbox_id+'Max';
		  alert(u_len);
		  var u_maxlen = $("#"+maxlen_user_id).val();
			
		  //alert("Values are "+d_dt+" : "+txt_len+" : "+u_dt+" : "+u_len);		  
		  if(d_dt == u_dt &&  (parseInt(u_len) >= parseInt(txt_len) && parseInt(u_len) <= parseInt(u_maxlen)   )) {
			  $("#status_"+id).html("Correct");
			  result_array.push('yes');
		  } else {
			  $("#status_"+id).html("Wrong");
			  result_array.push('no');
		  }		  
		}); // end of each
		  var result= $.inArray('no', result_array);
		  if(result == -1 ) { // means no not found in array return true
		  	//alert("Function will return true");
			return true;
		  } else {
		  	//alert("Function will return false");
			return false;
		  }
		
	} // end of function
</script>
</head>

<body>

<div id="topdivlogo">
	<div id="titlediv">Cheque Personalization System</div>
	</div>
	<div id="innerpage-maindiv">

		<div class="middle-maindiv">
			<div class="middlesubdiv">
				
				<div id="formdiv">
					<div id="formheading">Input File Details</div>
					<div id="formfields">
						<form name="frmmapfields" id="frmmapfields" action="post_mapfields.php" method="post">
							<table width="100%%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
								<tr>
									<td align="left" valign="top" style="width:40%; padding-left:16px; padding-top:16px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th width="5%">
													Sr no
												</th>
												<th width="20%">
													Field Name
												</th>
												<th width="11%">
													Data Type
												</th>
												<th width="7%">
													Min Length
												</th>
												<th width="7%">
													Max Length
												</th>
												<th width="26%">
													Bank Field Name
												</th>
												<th width="18%">
													Bank Data Type
												</th>
												<th width="9%">
													Length
												</th>
												<th width="4%">Status</th>
											</tr>
											<tr>
												<td align="left" valign="top"><label>1)</label></td>
												<td align="left" valign="top">
													<label>Unique Request No</label>
													<input type="hidden" name="systemfieldname[]" value="Unique Request No" />
												</td>
												<td align="left" valign="top">
												<label>Numeric</label>
												<input type="hidden" id="dd_ddlUniqueRequestNo" name="d_datatype[]" value="N" rel="dl_ddlUniqueRequestNo:ddlUniqueRequestNo:txtUniqueRequestNoLength" />
												</td>
												<td height="35" align="left" valign="top"><label>10</label>
												<input type="hidden" id="dl_ddlUniqueRequestNo" name="d_len[]" value="10" /></td>
												<td height="35" align="left" valign="top"><label>15</label>
												<input type="hidden" id="dl_ddlUniqueRequestNoMax" name="d_lenMax[]" value="15" /></td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtUniqueRequestNo" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlUniqueRequestNo" name="ddlDataType[]" style="width:100px;">													
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtUniqueRequestNoLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlUniqueRequestNo">&nbsp;</td>
											</tr>
											
											<tr>
												<td align="left" valign="top"><label>1 a)</label></td>
												<td align="left" valign="top">
													<label>Effective Date</label>
													<input type="hidden" name="systemfieldname[]" value="Effective Date" />
												</td>
												<td align="left" valign="top"><label>Date</label>
												<input type="hidden" id="dd_ddlEffectiveDate" name="d_datatype[]" value="D"  rel="dl_ddlEffectiveDate:ddlEffectiveDate:txtEffectiveDateLength" /></td>
												<td height="35" align="left" valign="top"><label>10</label>
												<input type="hidden" id="dl_ddlEffectiveDate" name="d_len[]" value="10"  />
												<td height="35" align="left" valign="top"><label>10</label>
												<input type="hidden" id="dl_ddlEffectiveDateMax" name="d_lenMax[]" value="10"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtEffectiveDate" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlEffectiveDate" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtEffectiveDateLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlEffectiveDate">&nbsp;</td>
											</tr>
											
											<tr>	
												<td align="left" valign="top"><label>2)</label></td>
												<td align="left" valign="top">
													<label>Bank Code</label>
													<input type="hidden" name="systemfieldname[]" value="Bank Code" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlBankCode" name="d_datatype[]" value="N"  rel="dl_ddlBankCode:ddlBankCode:txtBankCodeLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlBankCode" name="d_len[]" value="3"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlBankCodeMax" name="d_lenMax[]" value="3"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtBankCode" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlBankCode" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtBankCodeLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlBankCode" >&nbsp;</td>

											</tr>
											<tr>
												<td align="left" valign="top"><label>3)</label></td>
												<td align="left" valign="top">
													<label>Branch Code</label>
													<input type="hidden" name="systemfieldname[]" value="Branch Code" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlBranchCode" name="d_datatype[]" value="N"  rel="dl_ddlBranchCode:ddlBranchCode:txtBranchCodeLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlBranchCode" name="d_len[]" value="3"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlBranchCodeMax" name="d_lenMax[]" value="3"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtBranchCode" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlBranchCode" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtBranchCodeLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlBranchCode" >&nbsp;</td>
											</tr> 
											<tr>
												<td align="left" valign="top"><label>4)</label></td>
												<td align="left" valign="top">
												<label>City Code</label>
												<input type="hidden" name="systemfieldname[]" value="City Code" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlCityCode" name="d_datatype[]" value="N"  rel="dl_ddlCityCode:ddlCityCode:txtCityCodeLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlCityCode" name="d_len[]" value="3"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlCityCodeMax" name="d_lenMax[]" value="3"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtCityCode" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlCityCode" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtCityCodeLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlCityCode">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>5)</label></td>
												<td align="left" valign="top">
												<label>Account No</label>
												<input type="hidden" name="systemfieldname[]" value="Account No" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlaccountno" name="d_datatype[]" value="N"  rel="dl_ddlaccountno:ddlBankCode:txtaccountnoLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>15</label>
													<input type="hidden" id="dl_ddlaccountno" name="d_len[]" value="15"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>15</label>
													<input type="hidden" id="dl_ddlaccountnoMax" name="d_lenMax[]" value="15"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtaccountno" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlaccountno" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtaccountnoLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlaccountno" >&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>6)</label></td>	
												<td align="left" valign="top">
												<label>Branch Id</label>
												<input type="hidden" name="systemfieldname[]" value="Branch Id" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlBranchID" name="d_datatype[]" value="N"  rel="dl_ddlBranchID:ddlBranchID:txtBranchIDLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>5</label>
													<input type="hidden" id="dl_ddlBranchID" name="d_len[]" value="5"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>5</label>
													<input type="hidden" id="dl_ddlBranchIDMax" name="d_lenMax[]" value="5"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtBranchID" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlBranchID" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtBranchIDLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlBranchID" >&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>7)</label></td>	
												<td align="left" valign="top">
												<label>MICR Acc No</label>
												<input type="hidden" name="systemfieldname[]" value="MICR Acc No" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlMicrAccNo" name="d_datatype[]" value="N"  rel="dl_ddlMicrAccNo:ddlMicrAccNo:txtMicrAccNoLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>6</label>
													<input type="hidden" id="dl_ddlMicrAccNo" name="d_len[]" value="6"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>6</label>
													<input type="hidden" id="dl_ddlMicrAccNoMax" name="d_lenMax[]" value="6"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtMicrAccNo" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlMicrAccNo" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtMicrAccNoLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlMicrAccNo">&nbsp;</td>
											</tr>
											<tr>	
												<td align="left" valign="top"><label>8)</label></td>	
												<td align="left" valign="top">
												<label>Customer Name</label>
												<input type="hidden" name="systemfieldname[]" value="Customer Name" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlCustName" name="d_datatype[]" value="V"  rel="dl_ddlCustName:ddlCustName:txtCustNameLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlCustName" name="d_len[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlCustNameMax" name="d_lenMax[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtCustName" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlCustName" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtCustNameLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlCustName">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>9)</label></td>	
												<td align="left" valign="top">
												<label>No of Books</label>
												<input type="hidden" name="systemfieldname[]" value="No of Books" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlNoofBooks" name="d_datatype[]" value="N"  rel="dl_ddlNoofBooks:ddlNoofBooks:txtNoofBooksLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlNoofBooks" name="d_len[]" value="3"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlNoofBooksMax" name="d_lenMax[]" value="3"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtNoofBooks" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlNoofBooks" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtNoofBooksLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlNoofBooks" >&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>10)</label></td>	
												<td align="left" valign="top">
												<label>Bearer/Order</label>
												<input type="hidden" name="systemfieldname[]" value="Bearer/Order" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlBearerOrder" name="d_datatype[]" value="V"  rel="dl_ddlBearerOrder:ddlBearerOrder:txtBearerOrderLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>1</label>
													<input type="hidden" id="dl_ddlBearerOrder" name="d_len[]" value="1"  />	
												</td>
												<td height="35" align="left" valign="top">
													<label>1</label>
													<input type="hidden" id="dl_ddlBearerOrderMax" name="d_lenMax[]" value="1"  />	
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtBearerOrder" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlBearerOrder" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtBearerOrderLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlBearerOrder">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>11)</label></td>	
												<td align="left" valign="top">
												<label>Book Size</label>
												<input type="hidden" name="systemfieldname[]" value="Book Size" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlBookSize" name="d_datatype[]" value="N"  rel="dl_ddlBookSize:ddlBookSize:txtBookSizeLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlBookSize" name="d_len[]" value="3"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>3</label>
													<input type="hidden" id="dl_ddlBookSizeMax" name="d_lenMax[]" value="3"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtBookSize" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlBookSize" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtBookSizeLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlBookSize">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>11 a)</label></td>	
												<td align="left" valign="top">
												<label>Tr Code</label>
												<input type="hidden" name="systemfieldname[]" value="Tr Code" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlTrCode" name="d_datatype[]" value="N"  rel="dl_ddlTrCode:ddlTrCode:txtTrCodeLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>2</label>
													<input type="hidden" id="dl_ddlTrCode" name="d_len[]" value="2"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>2</label>
													<input type="hidden" id="dl_ddlTrCodeMax" name="d_lenMax[]" value="2"  />
												</td>
												<td align="left" valign="top" height="35"><input type="text" name="txtFieldName[]" id="txtTrCode" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlTrCode" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtTrCodeLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlTrCode">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>12)</label></td>	
												<td align="left" valign="top">
												<label>At Par</label>
												<input type="hidden" name="systemfieldname[]" value="At Par" />
												</td>
												<td align="left" valign="top">
													<label>Numeric</label>
													<input type="hidden" id="dd_ddlAtPar" name="d_datatype[]" value="N"  rel="dl_ddlAtPar:ddlAtPar:txtAtParLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>1</label>
													<input type="hidden" id="dl_ddlAtPar" name="d_len[]" value="1"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>1</label>
													<input type="hidden" id="dl_ddlAtParMax" name="d_lenMax[]" value="1"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtAtPar" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlAtPar" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtAtParLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlAtPar">&nbsp;</td>
											</tr>
											
											<tr>
												<td align="left" valign="top"><label>13)</label></td>	
												<td align="left" valign="top">
												<label>Joint Name 1</label>
												<input type="hidden" name="systemfieldname[]" value="Joint Name 1" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlJointName1" name="d_datatype[]" value="V"  rel="dl_ddlJointName1:ddlJointName1:txtJointName1Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlJointName1" name="d_len[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlJointName1Max" name="d_lenMax[]" value="35"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtJointName1" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlJointName1" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtJointName1Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlJointName1">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>14)</label></td>	
												<td align="left" valign="top">
												<label>Joint Name 2</label>
												<input type="hidden" name="systemfieldname[]" value="Joint Name 2" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlJointName2" name="d_datatype[]" value="V"  rel="dl_ddlJointName2:ddlJointName2:txtJointName2Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlJointName2" name="d_len[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlJointName2Max" name="d_lenMax[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtJointName2" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlJointName2" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtJointName2Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlJointName2">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>15)</label></td>	
												<td align="left" valign="top">
												<label>Signatory 1</label>
												<input type="hidden" name="systemfieldname[]" value="Signatory 1" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlSignatory1" name="d_datatype[]" value="V"  rel="dl_ddlSignatory1:ddlSignatory1:txtSignatory1Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlSignatory1" name="d_len[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlSignatory1Max" name="d_lenMax[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtSignatory1" style="width:220px;" /></td>
												
												<td align="left" valign="top">
													<select id="ddlSignatory1" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtSignatory1Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlSignatory1">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>16)</label></td>		
												<td align="left" valign="top">
												<label>Signatory 2</label>
												<input type="hidden" name="systemfieldname[]" value="Signatory 2" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlSignatory2" name="d_datatype[]" value="V"  rel="dl_ddlSignatory2:ddlSignatory2:txtSignatory2Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlSignatory2" name="d_len[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlSignatory2Max" name="d_lenMax[]" value="35"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtSignatory2" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlSignatory2" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtSignatory2Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlSignatory2">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>17)</label></td>		
												<td align="left" valign="top">
												<label>Signatory 3</label>
												<input type="hidden" name="systemfieldname[]" value="Signatory 3" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlSignatory3" name="d_datatype[]" value="V"  rel="dl_ddlSignatory3:ddlSignatory3:txtSignatory3Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlSignatory3" name="d_len[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>35</label>
													<input type="hidden" id="dl_ddlSignatory3Max" name="d_lenMax[]" value="35"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtSignatory3" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlSignatory3" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtSignatory3Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlSignatory3">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>18)</label></td>		
												<td align="left" valign="top">
												<label>Address 1</label>
												<input type="hidden" name="systemfieldname[]" value="Address 1" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlAddress1" name="d_datatype[]" value="V"  rel="dl_ddlAddress1:ddlAddress1:txtAddress1Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress1" name="d_len[]" value="50" />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress1Max" name="d_lenMax[]" value="50" />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtAddress1" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlAddress1" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtAddress1Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlAddress1">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>19)</label></td>
												<td align="left" valign="top">
												<label>Address 2</label>
												<input type="hidden" name="systemfieldname[]" value="Address 2" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlAddress2" name="d_datatype[]" value="V"  rel="dl_ddlAddress2:ddlAddress2:txtAddress2Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress2" name="d_len[]" value="50"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress2Max" name="d_lenMax[]" value="50"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtAddress2" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlAddress2" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtAddress2Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlAddress2">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>20)</label></td>	
												<td align="left" valign="top">
												<label>Address 3</label>
												<input type="hidden" name="systemfieldname[]" value="Address 3" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlAddress3" name="d_datatype[]" value="V"  rel="dl_ddlAddress3:ddlAddress3:txtAddress3Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress3" name="d_len[]" value="50"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress3Max" name="d_lenMax[]" value="50"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtAddress3" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlAddress3" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtAddress3Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlAddress3">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>21)</label></td>	
												<td align="left" valign="top">
												<label>Address 4</label>
												<input type="hidden" name="systemfieldname[]" value="Address 4" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlAddress4" name="d_datatype[]" value="V"  rel="dl_ddlAddress4:ddlAddress4:txtAddress4Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress4" name="d_len[]" value="50"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress4Max" name="d_lenMax[]" value="50"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtAddress4" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlAddress4" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtAddress4Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlAddress4">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>22)</label></td>	
												<td align="left" valign="top">
												<label>Address 5</label>
												<input type="hidden" name="systemfieldname[]" value="Address 5" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlAddress5" name="d_datatype[]" value="V"  rel="dl_ddlAddress5:ddlAddress5:txtAddress5Length" />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress5" name="d_len[]" value="50"  />
												</td>
												<td height="35" align="left" valign="top">
													<label>50</label>
													<input type="hidden" id="dl_ddlAddress5Max" name="d_lenMax[]" value="50"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtAddress5" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlAddress5" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtAddress5Length" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlAddress5">&nbsp;</td>
											</tr>
											
											<tr>
												<td align="left" valign="top"><label>23)</label></td>	
												<td align="left" valign="top">
												<label>City</label>
												<input type="hidden" name="systemfieldname[]" value="City" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlCity" name="d_datatype[]" value="V"  rel="dl_ddlCity:ddlCity:txtCityLength" />
												</td>
												<td height="35" align="left" valign="top">
													<label>30</label>
													<input type="hidden" id="dl_ddlCity" name="d_len[]" value="30"   />
												</td>
												<td height="35" align="left" valign="top">
													<label>30</label>
													<input type="hidden" id="dl_ddlCityMax" name="d_lenMax[]" value="30"   />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtCity" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlCity" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtCityLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlCity">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>24)</label></td>	
												<td align="left" valign="top">
												<label>State</label>
												<input type="hidden" name="systemfieldname[]" value="State" />
												</td>
												<td align="left" valign="top">
												<label>Varchar</label>
												<input type="hidden" id="dd_ddlState" name="d_datatype[]" value="V"  rel="dl_ddlState:ddlState:txtStateLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>30</label>
												<input type="hidden" id="dl_ddlState" name="d_len[]" value="30"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>30</label>
												<input type="hidden" id="dl_ddlStateMax" name="d_lenMax[]" value="30"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtState" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlState" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtStateLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlState">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>25)</label></td>	
												<td align="left" valign="top">
												<label>Country</label>
												<input type="hidden" name="systemfieldname[]" value="Country" />
												</td>
												<td align="left" valign="top">
												<label>Varchar</label>
													<input type="hidden" id="dd_ddlCountry" name="d_datatype[]" value="V"  rel="dl_ddlCountry:ddlCountry:txtCountryLength" />
													
												</td>
												<td height="35" align="left" valign="top">
												<label>30</label>
												<input type="hidden" id="dl_ddlCountry" name="d_len[]" value="30"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>30</label>
												<input type="hidden" id="dl_ddlCountryMax" name="d_lenMax[]" value="30"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtCountry" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlCountry" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtCountryLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlCountry">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>26)</label></td>
												<td align="left" valign="top">
												<label>Email Id</label>
												<input type="hidden" name="systemfieldname[]" value="Email Id" />
												</td>
												<td align="left" valign="top">
												<label>Varchar</label>
												<input type="hidden" id="dd_ddlEmailId" name="d_datatype[]" value="V"  rel="dl_ddlEmailId:ddlEmailId:txtEmailIdLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>50</label>
												<input type="hidden" id="dl_ddlEmailId" name="d_len[]" value="50"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>50</label>
												<input type="hidden" id="dl_ddlEmailIdMax" name="d_lenMax[]" value="50"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtEmailId" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlEmailId" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtEmailIdLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlEmailId">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>27)</label></td>		
												<td align="left" valign="top">
												<label>Pin</label>
												<input type="hidden" name="systemfieldname[]" value="Pin" />
												</td>
												<td align="left" valign="top">
													<label>Varchar</label>
													<input type="hidden" id="dd_ddlPin" name="d_datatype[]" value="V"  rel="dl_ddlPin:ddlPin:txtPinLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>30</label>
												<input type="hidden" id="dl_ddlPin" name="d_len[]" value="30"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>30</label>
												<input type="hidden" id="dl_ddlPinMax" name="d_lenMax[]" value="30"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtPin" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlPin" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtPinLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlPin">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>28)</label></td>	
												<td align="left" valign="top">
												<label>Telephone Res</label>
												<input type="hidden" name="systemfieldname[]" value="Telephone Res" />
												</td>
												<td align="left" valign="top">
												<label>Numeric</label>
												<input type="hidden" id="dd_ddlTelephoneRes" name="d_datatype[]" value="N"  rel="dl_ddlTelephoneRes:ddlTelephoneRes:txtTelephoneResLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>15</label>
												<input type="hidden" id="dl_ddlTelephoneRes" name="d_len[]" value="15"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>15</label>
												<input type="hidden" id="dl_ddlTelephoneResMax" name="d_lenMax[]" value="15"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtTelephoneRes" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlTelephoneRes" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtTelephoneResLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlTelephoneRes">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>29)</label></td>	
												<td align="left" valign="top">
												<label>Telephone Off</label>
												<input type="hidden" name="systemfieldname[]" value="Telephone Off" />
												</td>
												<td align="left" valign="top">
												<label>Numeric</label>
												<input type="hidden" id="dd_ddlTelephoneOff" name="d_datatype[]" value="N"  rel="dl_ddlTelephoneOff:ddlTelephoneOff:txtTelephoneOffLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>15</label>
												<input type="hidden" id="dl_ddlTelephoneOff" name="d_len[]" value="15"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>15</label>
												<input type="hidden" id="dl_ddlTelephoneOffMax" name="d_lenMax[]" value="15"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtTelephoneOff" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlTelephoneOff" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtTelephoneOffLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlTelephoneOff">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>30)</label></td>	
												<td align="left" valign="top">
												<label>Mobile</label>
												<input type="hidden" name="systemfieldname[]" value="Mobile" />
												</td>
												<td align="left" valign="top">
												<label>Numeric</label>
												<input type="hidden" id="dd_ddlMobile" name="d_datatype[]" value="N"  rel="dl_ddlMobile:ddlMobile:txtMobileLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>15</label>
												<input type="hidden" id="dl_ddlMobile" name="d_len[]" value="15"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>15</label>
												<input type="hidden" id="dl_ddlMobileMax" name="d_lenMax[]" value="15"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtMobile" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlMobile" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtMobileLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlMobile">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>30 a)</label></td>
												<td align="left" valign="top">
												<label>IFSC/NEFT/RTGS Code</label>
												<input type="hidden" name="systemfieldname[]" value="IFSC/NEFT/RTGS Code" />
												</td>
												<td align="left" valign="top">
												<label>Varchar</label>
												<input type="hidden" id="dd_ddlIFSCCode" name="d_datatype[]" value="V"  rel="dl_ddlIFSCCode:ddlIFSCCode:txtIFSCCodeLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>12</label>
												<input type="hidden" id="dl_ddlIFSCCode" name="d_len[]" value="12"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>12</label>
												<input type="hidden" id="dl_ddlIFSCCodeMax" name="d_lenMax[]" value="12"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtIFSCCode" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlIFSCCode" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtIFSCCodeLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlIFSCCode">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>31</label></td>
												<td align="left" valign="top">
												<label>Cheque To</label>
												<input type="hidden" name="systemfieldname[]" value="Cheque To" />
												</td>
												<td align="left" valign="top">
												<label>Numeric</label>
												<input type="hidden" id="dd_ddlChequeTo" name="d_datatype[]" value="N"  rel="dl_ddlChequeTo:ddlChequeTo:txtChequeToLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>6</label>
												<input type="hidden" id="dl_ddlChequeTo" name="d_len[]" value="6"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>6</label>
												<input type="hidden" id="dl_ddlChequeToMax" name="d_lenMax[]" value="6"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtChequeTo" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlChequeTo" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtChequeToLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlChequeTo">&nbsp;</td>
											</tr>
											<tr>
												<td align="left" valign="top"><label>32</label></td>
												<td align="left" valign="top">
												<label>Cheque Form</label>
												<input type="hidden" name="systemfieldname[]" value="Cheque Form" />
												</td>
												<td align="left" valign="top">
												<label>Numeric</label>
												<input type="hidden" id="dd_ddlChequeFrom" name="d_datatype[]" value="N"  rel="dl_ddlChequeFrom:ddlChequeFrom:txtChequeFromLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>6</label>
												<input type="hidden" id="dl_ddlChequeFrom" name="d_len[]" value="6"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>6</label>
												<input type="hidden" id="dl_ddlChequeFromMax" name="d_lenMax[]" value="6"  />
												</td>
												<td height="35" align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtChequeFrom" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlChequeFrom" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtChequeFromLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlChequeFrom">&nbsp;</td>
											</tr>
											 <tr>
												<td align="left" valign="top"><label>33</label></td>
												<td align="left" valign="top">
												<label>Issue Date</label>
												<input type="hidden" name="systemfieldname[]" value="Issue Date" />
												</td>
												<td align="left" valign="top">
												<label>Date</label>
												<input type="hidden" id="dd_ddlIssueDate" name="d_datatype[]" value="D"  rel="dl_ddlIssueDate:ddlIssueDate:txtIssueDateLength" />
												</td>
												<td height="35" align="left" valign="top">
												<label>10</label>
												<input type="hidden" id="dl_ddlIssueDate" name="d_len[]" value="10"  />
												</td>
												<td height="35" align="left" valign="top">
												<label>10</label>
												<input type="hidden" id="dl_ddlIssueDateMax" name="d_lenMax[]" value="10"  />
												</td>
												<td align="left" valign="top"><input type="text" name="txtFieldName[]" id="txtIssueDate" style="width:220px;" /></td>
												<td align="left" valign="top">
													<select id="ddlIssueDate" name="ddlDataType[]" style="width:100px;">
														<option value="V">Varchar</option>
														<option value="N">Numeric</option>
														<option value="D">Date</option>
													</select>
												</td>
												<td height="35" align="left" valign="top"><label><input type="text" name="txtLength[]" id="txtIssueDateLength" style="width:20px;" /></label></td>
												<td height="35" align="left" valign="top" id="status_dd_ddlIssueDate">&nbsp;</td>
											</tr>
										   
											<tr>
												<td align="left" valign="top" colspan="8">
													<input type="submit" id="submit" name="submit" value="Validate Fields" class="submitbutton" onclick="return submitform();" />
												</td>
											</tr>
											<tr>
												<td align="left" valign="top" colspan="8" height="50px">
													&nbsp;
												</td>
											</tr>
											<tr>
												<td align="left" valign="top" colspan="8">
													&nbsp;&nbsp;&nbsp;&nbsp;<a href="mapfields_pdf.php" target="_blank"><input type="button" id="button" class="submitbutton" value="Export to PDF" /></a>
												</td>
											</tr>
											<tr>
												<td align="left" valign="top" colspan="8" height="50px">
													&nbsp;
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
