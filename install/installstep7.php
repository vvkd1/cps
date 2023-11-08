<?php  require_once('../global.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
<?php include('../includes.php'); ?>
<script type="text/javascript" src="../scripts/grpermissions.js"></script>
<script type="text/javascript">
	var vRules = {};
	var vMessages = {};
	$(document).ready(function() {
		$('#response,#ajax_loading,.loading').hide();
		$('#submit').button();		
	
		$('#frmsetpermission').validate({
			rules: vRules,
			messages: vMessages,
			submitHandler: function(form) {
				$('#frmsetpermission').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
						formData.push({ "name": "type", "value": "json" });
						$('.loading').show();
					}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
						if (resObj.status) {
								window.location = 'finishinstall.php';
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

<div id="topdivlogo">
<div id="titlediv">Cheque Personalization System</div>

</div>
	<div id="innerpage-maindiv">
    	<div class="clear">&nbsp;</div>
    	<div class="middle-maindiv">
        	<div class="middlesubdiv">
        	  <form id="frmsetpermission" name="frmsetpermission" action="post_installstep7.php" method="post">
        	    <div id="formdiv">
                <div id="formheading">Map Fields</div>
                <div id="formfields">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
                    <tr>
						<td align="left" valign="top" style="padding-left:16px; padding-top:16px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">        
								<tr>
									<td>
										<div style="width:900px;float:left;">
										<?php if($result = $db->get_results("select group_id,group_name from tb_cps_groups")){ ?>
											<?php $allgrpid =""; $i = 1; foreach($result as $row) { ?>
											
											<?php
												$allgrpid = $allgrpid.$row->group_id.",";
												$allgrpcount = $i;
												$i++;
											?>
												
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
																		<span class="chkhead"><input type="checkbox" id="Master_0_<?php echo $row->group_id; ?>" name="Master_0_<?php echo $row->group_id; ?>" value="<?php $row->group_id; ?>" onClick="selectMaster(<?php echo $row->group_id; ?>,'mastersub');" />Master</span><br />
																		<div id="mastersub1_<?php echo $row->group_id; ?>" style="display:none">
																			<span class="chksub"><input type="checkbox" id="Master_1_<?php echo $row->group_id; ?>" name="Master_1_<?php echo $row->group_id; ?>" value="" onClick="selectMaster(<?php echo $row->group_id; ?>,'mastersuball');" />Full</span></br>
																			<span class="chksub"><input type="checkbox" id="Master_2_<?php echo $row->group_id; ?>" name="Master_2_<?php echo $row->group_id; ?>" value="" onClick="selectMaster(<?php echo $row->group_id; ?>,'mastersubpart');" />Part</span>
																		</div>
																		<div id="mastersub2_<?php echo $row->group_id; ?>" style="display:none">
																			<span class="chksub2"><input type="checkbox" id="Master_3_<?php echo $row->group_id; ?>" name="Master_3_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'3',33,'selectchild');" />Bank Master</span><br />
																				<div id="mastersub9_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_33_<?php echo $row->group_id; ?>" name="Master_33_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'3',33,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_43_<?php echo $row->group_id; ?>" name="Master_43_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'3',33,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_53_<?php echo $row->group_id; ?>" name="Master_53_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'3',33,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="Master_4_<?php echo $row->group_id; ?>" name="Master_4_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'4',34,'selectchild');" />Branch Master</span> <br />
																				<div id="mastersub9_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_34_<?php echo $row->group_id; ?>" name="Master_34_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'4',34,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_44_<?php echo $row->group_id; ?>" name="Master_44_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'4',34,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_54_<?php echo $row->group_id; ?>" name="Master_54_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'4',34,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="Master_5_<?php echo $row->group_id; ?>" name="Master_5_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'5',35,'selectchild');" />Country Master</span> <br />
																				<div id="mastersubcountrymaster_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_35_<?php echo $row->group_id; ?>" name="Master_35_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'5',35,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_45_<?php echo $row->group_id; ?>" name="Master_45_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'5',35,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_55_<?php echo $row->group_id; ?>" name="Master_55_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'5',35,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="Master_6_<?php echo $row->group_id; ?>" name="Master_6_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'6',36,'selectchild');" />State Master</span> <br />
																				<div id="mastersubstatemaster_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_36_<?php echo $row->group_id; ?>" name="Master_36_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'6',36,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_46_<?php echo $row->group_id; ?>" name="Master_46_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'6',36,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_56_<?php echo $row->group_id; ?>" name="Master_56_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'6',36,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="Master_7_<?php echo $row->group_id; ?>" name="Master_7_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'7',37,'selectchild');" />City Master</span> <br />
																				<div id="mastersucitymaster_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_37_<?php echo $row->group_id; ?>" name="Master_37_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'7',37,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_47_<?php echo $row->group_id; ?>" name="Master_47_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'7',37,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_57_<?php echo $row->group_id; ?>" name="Master_57_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'7',37,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="Master_8_<?php echo $row->group_id; ?>" name="Master_8_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'8',38,'selectchild');" />Suburb Master</span> <br />
																				<div id="mastersubsuburbmaster_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_38_<?php echo $row->group_id; ?>" name="Master_38_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'8',38,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_48_<?php echo $row->group_id; ?>" name="Master_48_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'8',38,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_58_<?php echo $row->group_id; ?>" name="Master_58_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'8',38,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="Master_9_<?php echo $row->group_id; ?>" name="Master_9_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'9',39,'selectchild');" />Tranaction Code</span> <br />
																				<div id="mastersubtrancode_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_39_<?php echo $row->group_id; ?>" name="Master_39_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'9',39,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_49_<?php echo $row->group_id; ?>" name="Master_49_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'9',39,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_59_<?php echo $row->group_id; ?>" name="Master_59_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'9',39,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="Master_10_<?php echo $row->group_id; ?>" name="Master_10_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'10',40,'selectchild');" />cheque Serise Setting</span> <br />
																				<div id="mastersubtrancode_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_40_<?php echo $row->group_id; ?>" name="Master_40_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'10',40,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_50_<?php echo $row->group_id; ?>" name="Master_50_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'10',40,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_60_<?php echo $row->group_id; ?>" name="Master_60_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'10',40,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="Master_11_<?php echo $row->group_id; ?>" name="Master_11_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'11',41,'selectchild');" />Map Fields</span> <br />
																				<div id="mastersubtrancode_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="Master_41_<?php echo $row->group_id; ?>" name="Master_41_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'11',41,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="Master_51_<?php echo $row->group_id; ?>" name="Master_51_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'11',41,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="Master_61_<?php echo $row->group_id; ?>" name="Master_61_<?php echo $row->group_id; ?>" value="" onClick="mastersubselect(<?php echo $row->group_id; ?>,'11',41,'selectparent');" />Edit</span> <br />
																				</div>
																		</div>								
																	</div>
																	
																	<div id="Tranactions_<?php echo $row->group_id; ?>">
																		<span class="chkhead"><input type="checkbox" id="Tranactions_0_<?php echo $row->group_id; ?>" name="Tranactions_0_<?php echo $row->group_id; ?>" value="" onClick="selectTranactions(<?php echo $row->group_id; ?>,'tranactionsub');" />Tranactions</span><br />
																		<div id="Tranactionssub1_<?php echo $row->group_id; ?>" style="display:none">
																			<span class="chksub"><input type="checkbox" id="Tranactions_1_<?php echo $row->group_id; ?>" name="Tranactions_1_<?php echo $row->group_id; ?>" value="" onClick="selectTranactions(<?php echo $row->group_id; ?>,'tranactionsuball');" />Full</span></br>
																			<span class="chksub"><input type="checkbox" id="Tranactions_2_<?php echo $row->group_id; ?>" name="Tranactions_2_<?php echo $row->group_id; ?>" value="" onClick="selectTranactions(<?php echo $row->group_id; ?>,'tranactionsubpart');" />Part</span>
																		</div>
																		<div id="Tranactionssub2_<?php echo $row->group_id; ?>" style="display:none">
																			<span class="chksub2"><input type="checkbox" id="Tranactions_3_<?php echo $row->group_id; ?>" name="Tranactions_3_<?php echo $row->group_id; ?>" value="" />Upload & Print File</span><br />
																			<span class="chksub2"><input type="checkbox" id="Tranactions_4_<?php echo $row->group_id; ?>" name="Tranactions_4_<?php echo $row->group_id; ?>" value="" />Reprint Request</span><br />			
																		</div>																			
																	</div>
																	
																	<div id="Reports_<?php echo $row->group_id; ?>">
																		<span class="chkhead"><input type="checkbox" id="Reports_0_<?php echo $row->group_id; ?>" name="Reports_0_<?php echo $row->group_id; ?>" value="" onClick="selectreport(<?php echo $row->group_id; ?>,'reportsub');" />Reports</span><br />
																		<div id="reportssub1_<?php echo $row->group_id; ?>" style="display:none">
																			<span class="chksub"><input type="checkbox" id="Reports_1_<?php echo $row->group_id; ?>" name="Reports_1_<?php echo $row->group_id; ?>" value="" onClick="selectreport(<?php echo $row->group_id; ?>,'reportsuball');" />Full</span></br>
																			<span class="chksub"><input type="checkbox" id="Reports_2_<?php echo $row->group_id; ?>" name="Reports_2_<?php echo $row->group_id; ?>" value="" onClick="selectreport(<?php echo $row->group_id; ?>,'reportsubpart');" />Part</span>
																		</div>
																		<div id="reportssub2_<?php echo $row->group_id; ?>" style="display:none">
																			<span class="chksub2"><input type="checkbox" id="Reports_3_<?php echo $row->group_id; ?>" name="Reports_3_<?php echo $row->group_id; ?>" value="" />Printed Reports</span><br />
																			<span class="chksub2"><input type="checkbox" id="Reports_4_<?php echo $row->group_id; ?>" name="Reports_4_<?php echo $row->group_id; ?>" value="" />Pending Printed Reports</span><br />
																			<span class="chksub2"><input type="checkbox" id="Reports_5_<?php echo $row->group_id; ?>" name="Reports_5_<?php echo $row->group_id; ?>" value="" />Account Wise Report</span><br />
																			<span class="chksub2"><input type="checkbox" id="Reports_6_<?php echo $row->group_id; ?>" name="Reports_6_<?php echo $row->group_id; ?>" value="" />Output File</span> <br /><br />
																		</div>									
																	</div>
																	
																	<div id="User_<?php echo $row->group_id; ?>">
																		<span class="chkhead"><input type="checkbox" id="User_0_<?php echo $row->group_id; ?>" name="User_0_<?php echo $row->group_id; ?>" value="" onClick="selectuser(<?php echo $row->group_id; ?>,'usersub');" />Profile Management</span><br />
																		<div id="usersub1_<?php echo $row->group_id; ?>" style="display:none">
																			<span class="chksub"><input type="checkbox" id="User_1_<?php echo $row->group_id; ?>" name="User_1_<?php echo $row->group_id; ?>" value="" onClick="selectuser(<?php echo $row->group_id; ?>,'usersuball');" />Full</span></br>
																			<span class="chksub"><input type="checkbox" id="User_2_<?php echo $row->group_id; ?>" name="User_2_<?php echo $row->group_id; ?>" value="" onClick="selectuser(<?php echo $row->group_id; ?>,'usersubpart');" />Part</span>
																		</div>
																		<div id="usersub2_<?php echo $row->group_id; ?>" style="display:none">
																			<span class="chksub2"><input type="checkbox" id="User_3_<?php echo $row->group_id; ?>" name="User_3_<?php echo $row->group_id; ?>" value="" onClick="profilesubselect(<?php echo $row->group_id; ?>,'3',33,'selectchild');" />Change Password</span><br />
																				<div id="userchangepass_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="User_33_<?php echo $row->group_id; ?>" name="User_33_<?php echo $row->group_id; ?>" value="" onClick="profilesubselect(<?php echo $row->group_id; ?>,'3',33,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="User_43_<?php echo $row->group_id; ?>" name="User_43_<?php echo $row->group_id; ?>" value="" onClick="profilesubselect(<?php echo $row->group_id; ?>,'3',33,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="User_53_<?php echo $row->group_id; ?>" name="User_53_<?php echo $row->group_id; ?>" value="" onClick="profilesubselect(<?php echo $row->group_id; ?>,'3',33,'selectparent');" />Edit</span> <br />
																				</div>
																			<span class="chksub2"><input type="checkbox" id="User_4_<?php echo $row->group_id; ?>" name="User_4_<?php echo $row->group_id; ?>" value="" onClick="profilesubselect(<?php echo $row->group_id; ?>,'4',34,'selectchild');" />Manage User Account</span><br />
																				<div id="useraddaccount_<?php echo $row->group_id; ?>">
																					<span class="chksub3"><input type="checkbox" id="User_34_<?php echo $row->group_id; ?>" name="User_34_<?php echo $row->group_id; ?>" value="" onClick="profilesubselect(<?php echo $row->group_id; ?>,'4',34,'selectparent');" />Read</span><br />
																					<span class="chksub3"><input type="checkbox" id="User_44_<?php echo $row->group_id; ?>" name="User_44_<?php echo $row->group_id; ?>" value="" onClick="profilesubselect(<?php echo $row->group_id; ?>,'4',34,'selectparent');" />Writer</span> <br />
																					<span class="chksub3"><input type="checkbox" id="User_54_<?php echo $row->group_id; ?>" name="User_54_<?php echo $row->group_id; ?>" value="" onClick="profilesubselect(<?php echo $row->group_id; ?>,'4',34,'selectparent');" />Edit</span> <br />
																				</div>																			
																		</div>
																	</div>
																	
																	<div id="Admin_<?php echo $row->group_id; ?>">
																		<span class="chkhead"><input type="checkbox" id="Admin_0_<?php echo $row->group_id; ?>" name="Admin_0_<?php echo $row->group_id; ?>" value="" onClick="selectAdmin(<?php echo $row->group_id; ?>);" />Admin</span><br />
																		<div id="Admin1_<?php echo $row->group_id; ?>" style="display:none">																																					
																			<div id="useraddaccount_<?php echo $row->group_id; ?>">
																				<span class="chksub"><input type="checkbox" id="Admin_22_<?php echo $row->group_id; ?>" name="Admin_22_<?php echo $row->group_id; ?>" value="" />Read</span><br />
																				<span class="chksub"><input type="checkbox" id="Admin_32_<?php echo $row->group_id; ?>" name="Admin_32_<?php echo $row->group_id; ?>" value="" />Writer</span> <br />
																				<span class="chksub"><input type="checkbox" id="Admin_42_<?php echo $row->group_id; ?>" name="Admin_42_<?php echo $row->group_id; ?>" value="" />Edit</span> <br />
																			</div>
																		</div>																			
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
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>
										<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
										<label><div id="response" class="red"></div></label>
									</td>
								</tr>
								<tr>
									<td align="right" valign="top" style="padding-right: 16px;" colspan="4">
										<input name="submit" type="button" id="submit" class="submitbutton" value="Back to previous page" onClick="window.location.href='installstep6.php'" />&nbsp;&nbsp;
										<input name="submit" type="submit" id="submit" class="submitbutton" value="Go to next page" onClick="setall();" />
									</td>
								</tr>
								<tr>
									<td>
										<input type="hidden" name="grcount" id="grcount" value="<?php echo $allgrpcount; ?>" />
										<input type="hidden" name="grid" id="grid" value="<?php echo substr($allgrpid, 0, -1); ?>" />
										<input type="hidden" name="allselectdata" id="allselectdata" />
									</td>
								</tr>
							</table>
						</td>
                    </tr>
                  </table>
                </div>
               </div>
               </form>
            </div>
        </div>
    </div>	 
</body>
</html>
