<?php  require_once('../global.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
<?php include('../includes.php'); ?>
<script type="text/javascript">
	var vRules = {};
	var vMessages = {};
	$(document).ready(function() {
		$('#response,#ajax_loading,.loading').hide();
		$('#submit').button();		
	
		$('#frmMapFields').validate({
			rules: vRules,
			messages: vMessages,
			submitHandler: function(form) {
				$('#frmMapFields').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
						formData.push({ "name": "type", "value": "json" });
						$('.loading').show();
					}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
						if (resObj.status) {
								window.location = 'installstep6.php';
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
</head>

<body>
<?php require_once('adminheader.php');	?>       

	<div id="innerpage-maindiv">
 
    	<div class="middle-maindiv">
        	
        	  <form id="frmMapFields" name="frmMapFields" action="post_installstep5.php" method="post">
        	    <div id="formdiv">
                <div id="formheading">Map Fields</div>
                <div id="formfields">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
                    <tr>
                      <td align="left" valign="top" style="padding-left:16px; padding-top:16px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="15%" align="left" valign="top"><label>City Code</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtCityCode" id="txtCityCode" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Bank Code</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtBankCode" id="txtBankCode" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Branch Code</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtBranchCode" id="txtBranchCode" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Branch Sole Id</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtBranchSoleID" id="txtBranchSoleID" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>MICR Acc No</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtMicrAccNo" id="txtMicrAccNo" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Account No</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtaccountno" id="txtaccountno" style="width:220px;" /></td>
                        </tr>
						<tr>
                          <td width="18%" align="left" valign="top"><label>Tr Code</label></td>
                          <td width="32%" align="left" valign="top" height="35"><input type="text" name="txtTrCode" id="txtTrCode" style="width:220px;" /></td>
                          <td width="15%" align="left" valign="top"><label>Email Id</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtEmailId" id="txtEmailId" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Customer Name</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtCustName" id="txtCustName" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Joint Name 1</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtJointName1" id="txtJointName1" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Joint Name 2</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtJointName2" id="txtJointName2" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Unique Request No</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtUniqueRequestNo" id="txtUniqueRequestNo" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Signatory 1</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtSignatory1" id="txtSignatory1" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Signatory 2</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtSignatory2" id="txtSignatory2" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Signatory 3</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtSignatory3" id="txtSignatory3" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Address 1</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtAddress1" id="txtAddress1" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Address 2</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtAddress2" id="txtAddress2" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Address 3</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtAddress3" id="txtAddress3" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Address 4</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtAddress4" id="txtAddress4" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Address 5</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtAddress5" id="txtAddress5" style="width:220px;" /></td>
                        </tr>
                        
                        <tr>
                          <td width="15%" align="left" valign="top"><label>City</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtCity" id="txtCity" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Pin</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtPin" id="txtPin" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Telephone Res</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtTelephoneRes" id="txtTelephoneRes" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Telephone Off</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtTelephoneOff" id="txtTelephoneOff" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Mobile</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtMobile" id="txtMobile" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>No of Books</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtNoofBooks" id="txtNoofBooks" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Book Size</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtBookSize" id="txtBookSize" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Bearer/Order</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtBearerOrder" id="txtBearerOrder" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>At Par</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtAtPar" id="txtAtPar" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>PR Code</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtPRCode" id="txtPRCode" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Cheque Form</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtChequeFrom" id="txtChequeFrom" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Cheque To</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtChequeTo" id="txtChequeTo" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Effective Date</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtEffectiveDate" id="txtEffectiveDate" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Issue Date</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtIssueDate" id="txtIssueDate" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Sr No Infra</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtSrNoInfra" id="txtSrNoInfra" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>Alpha Code</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtAlphaCode" id="txtAlphaCode" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>Spectial Series</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtSpectialSeries" id="txtSpectialSeries" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>IFSC Code</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtIFSCCode" id="txtIFSCCode" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td width="15%" align="left" valign="top"><label>RTGS Code</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtRTGSCode" id="txtRTGSCode" style="width:220px;" /></td>
                          <td width="18%" align="left" valign="top"><label>NEFT Code</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtNEFTCode" id="txtNEFTCode" style="width:220px;" /></td>
                        </tr>
						<tr>
                          <td width="18%" align="left" valign="top"><label>Country</label></td>
                          <td width="32%" align="left" valign="top"><input type="text" name="txtCountry" id="txtCountry" style="width:220px;" /></td>
						  <td width="15%" align="left" valign="top"><label>State</label></td>
                          <td width="35%" height="35" align="left" valign="top"><input type="text" name="txtState" id="txtState" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                        </tr>
                       <tr>
			            	<td>
			            		<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
			            		<div id="response"></div>
			            	</td>
			            </tr>
						<tr>
							<td align="left" valign="top" style="padding-right: 16px;" colspan="4">
								<input name="submit" type="submit" id="submit" class="button1" value="Save"  />
							</td>
						</tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="right" valign="top" style="padding-right:16px;">&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
                </div>
               </div>
               </form>
           
		   
        </div>
    </div>	 
</body>
</html>
