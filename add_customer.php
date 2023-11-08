<?php  require_once('global.php');
$page_name = "Suburb_master";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","","Y"))
	header("Location: ".SITE_ROOT."home.php");		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Processing ::</title>
<link rel="stylesheet" href="css/stylecss.css" type="text/css" />
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<?php include('includes.php'); ?>
	<script type="text/javascript">
		var vRules = { txtcustname: { required:true }, txtcustshortname: { required:true }, txtaccno: { required:true }};
		var vMessages = { txtcustname: {required: "<br/>Please enter name" },txtcustshortname: {required: "<br/>Please enter short name" },txtaccno: {required: "<br/>Please enter account no" }};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit').button();		
		
			$('#addcustomer').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#addcustomer').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
								//window.location = 'manage_cityplace.php';
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
					<div id="formheading">Add Customer</div>
					<div id="formfields">
						<form name="addcustomer" id="addcustomer" action="post_customer.php?do=add" method="post">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
								<tr>
									<td align="left" valign="top" style="padding-left:16px; padding-top:16px; padding-bottom:16px">												
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>Enter Name</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtcustname" id="txtcustname" value="" style="width:183px">										
												</td>
											</tr>
											
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>Enter Short Name</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtcustshortname" id="txtcustshortname" value="" style="width:183px" >										
												</td>
											</tr>
											
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>Enter Account NO</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtaccno" id="txtaccno" value="" style="width:183px">										
												</td>
											</tr>
											
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>Enter Address</label>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtadd" id="txtadd" value="" style="width:183px">										
												</td>
											</tr>											
											<tr>
												<td>
													&nbsp;
												</td>
												<td colspan="2" align="left"> 
													<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
													<label><div id="response"></div></label>
												</td>
											</tr>											
											<tr>
												<td></td>
												<td>
													<input type="submit" name="submit" id="submit" value="Save" />
													<input type="submit" name="submit1" id="submit1" value="Save and Close" class="submitbutton" />
													<input type="button" name="submit2" id="submit2" value="Discard" class="submitbutton" onClick="window.location.href='home.php'" />
													<input type="button" name="submit3" id="submit3" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
												</td>	
												<td></td>
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
