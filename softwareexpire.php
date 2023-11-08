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
		var vRules = {};
		var vMessages = {};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit1').button();		
			$('#frmexpire').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frmexpire').ajaxSubmit({
						target: '#response', 
						beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, 
						clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									window.location = "login.php";
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
															Its seems that your software expiration date is about to end or is already over.
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
												<td colspan="3">
												<label>Please enter the key given by helpline here to activate your copy:</label>
												<input type="text" name="txtrenewcode" id="txtrenewcode" style="width:655px;" value="" />
												</td>
											</tr>
											<tr>
												<td align="left" valign="top" width="16%"></td>
												<td height="35" align="left" width="84%" valign="top"><label>
												&nbsp;&nbsp;
												</label></td>
											</tr>
											<tr>
												<td align="left" valign="top">&nbsp;</td>
												<td align="left" valign="top">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="100%" align="right" valign="top">
															<input name="submit1" type="submit" id="submit1" value="Click here to renew"/>
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
