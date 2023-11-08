<?php  require_once('global.php');
$page_name = "manageuser_account";
authentication_print();
if(!authentication_groups_pemissions($page_name,"Y","",""))
	header("Location: ".SITE_ROOT."home.php");		
if(isset($_REQUEST['adminid']) && !empty($_REQUEST['adminid'])){
$row = $db->get_row("select adminid,username,userid,password,lastlogintime,user_type,group_id,user_status from tb_printadmin where adminid=".$_REQUEST['adminid']."");	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		
		var vRules = { txtusername: { required:true }, txtpassword: { minlength:6 }, txtconfirmpassword:{equalTo:"#txtpassword"}, txtnewpassword: { minlength:6 }, txtrenewpassword:{equalTo:"#txtnewpassword"}};
		var vMessages = { txtusername: { required: "<br/>Please select user name." }, txtpassword: { minlength: "<br/>Password length should be minimum 6 <br/>(combination of alpha, numeric and special character)"}, txtconfirmpassword:{equalTo:"<br/>Please confirm password."}, txtnewpassword: { minlength: "<br/>Password length should be minimum 6 <br/>(combination of alpha, numeric and special character)"}, txtrenewpassword:{equalTo:"<br/>Please enter same password."}};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#row_set_new,#row_renew').toggle();
			$('#submit5').click(function(){
				$('#row_old,#row_new,#row_confirm').toggle();
				$('#row_set_new,#row_renew').toggle();
			});
			$('#submit1').button();		
			$('#frmadduser').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frmadduser').ajaxSubmit({
						target: '#response', 
						beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, 
						clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									alert("User Edited Sucessfully.");
									//window.location = "adduserprint.php";
									window.location = resObj.loc;
							} else {	
								$('.loading').hide();
								$('#response').html('<span class="red">'+resObj.msg+'</span>').show();
							}
						}
						
					});
				}
			});
		});
		
	</script>
	<script type="text/javascript">
		function showGroup(str)
		{
			if(str == "1"){
				document.getElementById("ddlusergp").disabled=true;
			}
			else{
				document.getElementById("ddlusergp").disabled=false;
			}
		}
	</script>
	
</head>

<body>

<?php require_once('header.php'); ?>
                <div id="formdiv">
                	<div id="formheading">Edit User</div>
                    <div id="formfields">
                   <form id="frmadduser" name="frmadduser" enctype="multipart/form-data" action="adduserprint_post.php?do=edit&adminid=<?php echo $_REQUEST['adminid'] ?>" method="POST" autocomplete="off">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
                          <table width="800" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                          <td>&nbsp;</td>
                          </tr>
						  <tr>
						    <td align="left" valign="top">		
						    <div id="formfields">
                    				    	
					    		<table width="700px" border="0" cellspacing="0" cellpadding="0">
					    			<tr>
									    <td align="left" valign="top" colspan="2"><div id="response"></div></td>
									</tr>
									
									<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>User Name</label>
							    		</td>
							    		<td>
							    			<input type="text" name="txtusername" id="txtusername" readonly="true" value="<?php echo $row->username; ?>" /><label>(User Name should be bank employee code)</label>
							    		</td>
						    		</tr>
									<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>User Id</label>
							    		</td>
							    		<td>
							    			<input type="text" name="txtuserid" id="txtuserid" readonly="true" value="<?php echo $row->userid; ?>" /><label>(User ID should be bank employee code)</label>
							    		</td>
						    		</tr>
						    		<!-- <tr id="row_old">
							    		<td style="height: 35px; text-align: left">
							    			<label>Old Password</label>
							    		</td>
							    		<td>	
							    			<input type="password" name="txtoldpassword" id="txtoldpassword" value="" />											
							    		</td>
						    		</tr> -->
									<tr>
						    			<td colspan="2" style="height: 10px;">
											<hr style="border: 1px solid #cccccc;">
						    			</td>
						    		</tr>
						    			<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Group Type</label>
							    		</td>
							    		<td>
											<select name="ddlusergptype" id="ddlusergptype" style="width:169px; height:26px;">
												<option value="0">Normal User</option>
												<option value="1">Reprint User</option>	
												<option value="2">Super User</option>	
											</select>
							    		</td>
						    		</tr>
						    		<tr>
						    			<td colspan="2" style="height: 10px;">
											<hr style="border: 1px solid #cccccc;">
						    			</td>
						    		</tr>
									<tr id="row_new">
							    		<td style="height: 35px; text-align: left">
							    			<label>New Password</label>
							    		</td>
							    		<td>	
							    			<input type="password" name="txtpassword" id="txtpassword" value=""  autocomplete="off"/>											
							    		</td>
						    		</tr>
						    		<tr id="row_confirm">
							    		<td style="height: 35px; text-align: left">
							    			<label>Confirm Password</label>
							    		</td>
							    		<td>
							    			<input type="password" name="txtconfirmpassword" id="txtconfirmpassword" value=""  autocomplete="off"/>											
							    		</td>
						    		</tr>
						    		<tr id="row_set_new">
							    		<td style="height: 35px; text-align: left">
							    			<label>Set New Password</label>
							    		</td>
							    		<td>	
							    			<input type="password" name="txtnewpassword" id="txtnewpassword" value="" />											
							    		</td>
						    		</tr>
									<tr id="row_renew">
							    		<td style="height: 35px; text-align: left">
							    			<label>Re-enter New Password</label>
							    		</td>
							    		<td>	
							    			<input type="password" name="txtrenewpassword" id="txtrenewpassword" value="" />											
							    		</td>
						    		</tr>
						    		<tr>
						    			<td colspan="2" style="height: 10px;">
											<hr style="border: 1px solid #cccccc;">
						    			</td>
						    		</tr>
						    		<tr>
							    		<td style=" text-align: left;">
							    			<label>User Status</label>
							    		</td>
							    		<td>
											<select name="ddluserstatus" id="ddluserstatus" style="width:169px; height:26px;">
												<option value="0">Inactive</option>
												<option value="1">Active</option>	
											</select>
							    		</td>
						    		</tr>
						    		<tr>
						    			<td colspan="2" style="height: 15px;">
											
						    			</td>
						    		</tr>
						    		
						    		<tr>
						    			<td colspan="2" style="height: 35px;">
											<input type="submit" name="submit1" id="submit1" value="Save"/>
											<input type="submit" name="submit2" id="submit2" value="Update and Close" class="submitbutton" />
											<input type="button" name="submit3" id="submit3" value="Discard" class="submitbutton" onClick="window.location.href='home.php'" />
											<input type="button" name="submit4" id="submit4" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
											<!-- <input type="button" name="submit5" id="submit5" value="Reset password" class="submitbutton" /> -->
											<div class="loading"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
						    			</td>
						    		</tr>
					    		</table>
					    		
					    		</div>
						    </td>
						  </tr>
  							<tr>
                          <td>&nbsp;</td>
                          </tr>
      
     
						    </table></td>
						  </tr>
						  <tr>
						    <td align="left" valign="top">
								
								<div class="clearboth"></div>
   
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

<script type="text/javascript">
	$(document).ready(function() {
	$('#ddluserstatus').val('<?php echo $row->user_status;?>');
	$('#ddlusergptype').val('<?php echo $row->user_type;?>');
	});
</script>
</html>
