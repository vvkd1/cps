<?php  require_once('../global.php');
$jq = true;
$ui = true;
$form = true;
$valid = true;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Processing ::</title>
<?php include('../includes.php'); ?>	
<script type="text/javascript">
		var vRules = { user0: { required:true }};
		var vMessages = { user0: {required: "<br/>Please enter user group" }};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit').button();		
		
			$('#adduser').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#adduser').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
							$('#submitdiv').hide();
						}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									window.location = 'google.com';
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
	
	<script type="text/javascript">
	
		function selectMaster(mastergrid)
		{
			document.getElementById("Master_1_" + mastergrid).checked = true;
			document.getElementById("Master_2_" + mastergrid).checked = true;
		}
		
		function selectTranactions(transgrid)
		{
			document.getElementById("Tranactions_1_" + transgrid).checked = true;
		}
		
		function selectreport(reportgrid)
		{
			document.getElementById("Reports_1_" + reportgrid).checked = true;
			document.getElementById("Reports_2_" + reportgrid).checked = true;
			document.getElementById("Reports_3_" + reportgrid).checked = true;
			document.getElementById("Reports_4_" + reportgrid).checked = true;
		}
		
		function selectuser(usergrid)
		{
			document.getElementById("User_1_" + usergrid).checked = true;
			document.getElementById("User_2_" + usergrid).checked = true;
			document.getElementById("User_3_" + usergrid).checked = true;
		}
		
	</script>
</head>

<body>

<div id="topdivlogo">
<div id="titlediv">Cheque Processing System</div>
<div class="topright-menu">
</div>
</div>
	<div id="innerpage-maindiv">
    	<div class="clear">&nbsp;</div>
    	<div class="middle-maindiv">
        	<div class="middlesubdiv">
                <div id="formdiv">
					<div id="formfields">
						<form name="adduser" action="setpermissions_post.php" method="">
							<table cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td>
										<div style="width:900px;float:left;">
										<?php if($result = $db->get_results("select group_id,group_name from tb_cps_groups")){ ?>
											<?php foreach($result as $row) { ?>
											
												<div style="width:300px; float:left">
													<table cellspacing="0" cellpadding="0" border="0">
														<tr>
															<td class="chkheadtext" style="padding-bottom:5px">
																<?php echo $row->group_name;?>
															</td>															
														</tr>
														
														<tr>
															<td>
																<div id="divuser_<?php echo $row->group_id; ?>">
																	<div id="master_<?php echo $row->group_id; ?>">
																		<span class="chkhead"><input type="checkbox" id="Master_0_<?php echo $row->group_id; ?>" name="Master_0_<?php echo $row->group_id; ?>" value="<?php $row->group_id; ?>" onClick="selectMaster(<?php echo $row->group_id; ?>);" />Master</span><br />
																		<span class="chksub"><input type="checkbox" id="Master_1_<?php echo $row->group_id; ?>" name="Master_1_<?php echo $row->group_id; ?>" value="" />Bank Master</span><br />
																		<span class="chksub"><input type="checkbox" id="Master_2_<?php echo $row->group_id; ?>" name="Master_2_<?php echo $row->group_id; ?>" value="" />Branch Master</span> <br /><br />
																	</div>
																	
																	<div id="Tranactions_<?php echo $row->group_id; ?>">
																		<span class="chkhead"><input type="checkbox" id="Tranactions_0_<?php echo $row->group_id; ?>" name="Tranactions_0_<?php echo $row->group_id; ?>" value="" onClick="selectTranactions(<?php echo $row->group_id; ?>);" />Tranactions</span><br />
																		<span class="chksub"><input type="checkbox" id="Tranactions_1_<?php echo $row->group_id; ?>" name="Tranactions_1_<?php echo $row->group_id; ?>" value="" />Upload & Print</span><br /><br />	
																	</div>
																	
																	<div id="Reports_<?php echo $row->group_id; ?>">
																		<span class="chkhead"><input type="checkbox" id="Reports_0_<?php echo $row->group_id; ?>" name="Reports_0_<?php echo $row->group_id; ?>" value="" onClick="selectreport(<?php echo $row->group_id; ?>);" />Reports</span><br />
																		<span class="chksub"><input type="checkbox" id="Reports_1_<?php echo $row->group_id; ?>" name="Reports_1_<?php echo $row->group_id; ?>" value="" />Printed Reports</span><br />
																		<span class="chksub"><input type="checkbox" id="Reports_2_<?php echo $row->group_id; ?>" name="Reports_2_<?php echo $row->group_id; ?>" value="" />Pending Printed Reports</span><br />
																		<span class="chksub"><input type="checkbox" id="Reports_3_<?php echo $row->group_id; ?>" name="Reports_3_<?php echo $row->group_id; ?>" value="" />Account Wise Report</span><br />
																		<span class="chksub"><input type="checkbox" id="Reports_4_<?php echo $row->group_id; ?>" name="Reports_4_<?php echo $row->group_id; ?>" value="" />Output File</span> <br /><br />
																	</div>
																	
																	<div id="User_<?php echo $row->group_id; ?>">
																		<span class="chkhead"><input type="checkbox" id="User_0_<?php echo $row->group_id; ?>" name="User_0_<?php echo $row->group_id; ?>" value="" onClick="selectuser(<?php echo $row->group_id; ?>);" />User</span><br />
																		<span class="chksub"><input type="checkbox" id="User_1_<?php echo $row->group_id; ?>" name="User_1_<?php echo $row->group_id; ?>" value="" />Change Password</span><br />
																		<span class="chksub"><input type="checkbox" id="User_2_<?php echo $row->group_id; ?>" name="User_2_<?php echo $row->group_id; ?>" value="" />Add User Account</span><br />
																		<span class="chksub"><input type="checkbox" id="User_3_<?php echo $row->group_id; ?>" name="User_3_<?php echo $row->group_id; ?>" value="" />Add Reprinter User Account</span><br /><br />
																	</div>
																</div>
															</td>
														</tr>
														
													</table>
												</div>
												
											<?php }?>
											<?php }else{echo "";} ?>
										</div>
									</td>
								</tr>
								
								<tr>
									<td align="right" valign="top" style="padding-right:16px;">
										<div id="logindivbottombar" style="width:62px; float:right; cursor:pointer;">
											<input name="submit" type="submit" id="submit" value="" style="background-image:url('<?php echo ROOT_IMAGES; ?>nextbtn.jpg'); width:62px;height:25px" />
										</div>
									</td>
								</tr>
								
								<tr>
									<td colspan="2">
										<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
										<div id="response"></div>
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
