<?php  
require_once('global.php');
$rowhelpline = $db->get_row("SELECT help_contactperson,help_helplineno1,help_helplineno2,help_emailid FROM tb_cps_settings");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
<?php include('includes.php'); ?>
<script type="text/javascript">
		var vRules = { txtbankname: { required:true }, ddlcountry: { required:true },branchaddress1: { required:true },txtcontno1: { required:true },txtemailid: { required:true,email:true }, ddlstate: { required:true }, ddlcity: { required:true }, ddlsuburb: { required:true }, txtpin: { required:true }, txtcontno2: { required:true }, txtcontper1: { required:true } , txtcontper2: { required:true }};
		var vMessages = { txtbankname: { required: "<br/>Please enter bank name." }, ddlcountry: { required: "<br/>Please select country." },branchaddress1: { required:"Please enter address line 1." },txtcontno1: { required:"<br/>Please enter contact no 1." },txtemailid: {required:"<br/>Please enter emailid.", email:"<br>Please enter correct email id</br>"}, ddlstate: { required: "<br/>Please select state." }, ddlcity: { required: "<br/>Please select city." }, ddlsuburb: { required: "<br/>Please select suburb." }, txtpin: { required: "<br/>Please select zip/pin." }, txtcontno2: { required: "<br/>Please enter contact no. 2." }, txtcontper1: { required: "<br/>Please enter contact no 1." }, txtcontper1: { required: "<br/>Please enter contact no 2." } };
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
					<div id="formheading">Software Expire</div>
					<div id="formfields">
						<form id="frmexpire" name="frmexpire" method="post" action="post_softwareexpiry.php" autocomplete="off">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
										<table width="880" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="left" valign="top" style="height:35px"><div id="response"></div></td>
											</tr>
											<tr>
												<td align="left" valign="top" >
													<label>
														<p>
															Your copy of software is expired.<br/>
															please contact below helpline.	
														</p>
														
														<p>
															<table style="width:250px">
																<tr>
																	<td colspan="2" style="height:30px">
																	</td>
																</tr>
																<tr>
																	<td colspan="2">
																		<h3>Helpline Details</h3>
																	</td>
																</tr>
																<tr>
																	<td colspan="2" style="height:10px">
																	</td>
																</tr>
																<tr>
																	<td>
																		Contact Person
																	</td>
																	<td>
																		<?php echo $rowhelpline->help_contactperson; ?>
																	</td>
																</tr>
																<tr>
																	<td>
																		Helpline 1
																	</td>
																	<td>
																		<?php echo $rowhelpline->help_helplineno1; ?>
																	</td>
																</tr>
																<tr>
																	<td>
																		Helpline 2
																	</td>
																	<td>
																		<?php echo $rowhelpline->help_helplineno2; ?>
																	</td>
																</tr>
																<tr>
																	<td>
																		Email ID
																	</td>
																	<td>
																		<?php echo $rowhelpline->help_emailid; ?>
																	</td>
																</tr>
															<table>
														</p>
													</label>
												</td>
											</tr>
											<tr>
												<td align="left" valign="top" width="16%"></td>
												<td height="35" align="left" width="84%" valign="top"><label>
												&nbsp;&nbsp;
												</label></td>
											</tr>
											
											<tr>
												<td align="left" valign="top" width="16%"></td>
												<td height="35" align="left" width="84%" valign="top"><label>
												&nbsp;&nbsp;
												</label></td>
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
