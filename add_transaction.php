<?php  require_once('global.php');
$page_name = "transaction_master";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","","Y"))
	header("Location: ".SITE_ROOT."home.php");		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('includes.php'); ?>
<script type="text/javascript">
		var vRules = { txttransactioncodedescription: { required:true }, txttransactioncode: { required:true }};
		var vMessages = { txttransactioncodedescription: {required: "<br/>Please enter transaction code description" }, txttransactioncode: {required: "<br/>Please enter transaction code" }};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit').button();		
		
			$('#addcountry').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#addcountry').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
								//window.location = 'manage_country.php';
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
</head>

<body>
<?php require_once('header.php');	?>
                <div id="formdiv">
					<div id="formheading">Add Transaction Code</div>
					<div id="formfields">
						<form name="addcountry" id="addcountry" action="post_transaction.php?do=add" method="post">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
								<tr>
									<td align="left" valign="top" style="padding-left:16px; padding-top:16px; padding-bottom:16px">												
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="17%" height="35" align="left" valign="top">
													<label>Enter Transaction Desc</label>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txttransactioncodedescription" id="txttransactioncodedescription" onKeyUp="javascript:this.value=this.value.toUpperCase();">										
												</td>
											</tr>
											
											<tr>
												<td  width="15%" height="35" align="left" valign="top">
													<label>Enter Transaction Code</label>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txttransactioncode" id="txttransactioncode" onKeyUp="javascript:this.value=this.value.toUpperCase();">										
												</td>
											</tr>
																						
											<tr>	
												<td></td>
												<td>
													<input type="submit" name="submit" id="submit" value="Update" />
													<input type="submit" name="submit1" id="submit1" value="Save and Close" class="submitbutton" />
													<input type="button" name="submit2" id="submit2" value="Discard" class="submitbutton" onClick="window.location.href='home.php'" />
													<input type="button" name="submit3" id="submit3" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
												</td>	
												<td></td>
											</tr>
											
											<tr>
												<td>&nbsp;</td>
											</tr>
											
											<tr>
												<td>
													
												</td>
												<td  colspan="2" align="left">
													<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
													<label><div id="response"></div></label>
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
