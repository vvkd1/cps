<?php  require_once('global.php');
$page_name = "change_password";
authentication_print();
if(!authentication_groups_pemissions($page_name,"Y","",""))
	header("Location: ".SITE_ROOT."home.php");		
if(isset($_REQUEST['adminid']) && !empty($_REQUEST['adminid'])){
$row = $db->get_row("select adminid,username,userid,password,lastlogintime,user_type,group_id from tb_printadmin where adminid=".$_REQUEST['adminid']."");	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		
		var vRules = { txtoldpassword: { required:true }, txtpassword: { required:true, minlength:6 }, txtconfirmpassword:{required:true, equalTo:"#txtpassword"}};
		var vMessages = { txtoldpassword: { required: "<br/>Please enter old password."}, txtpassword: { required: "<br/>Please enter password.", minlength: "<br/>Password length should be minimum 6 <br/>(combination of alpha, numeric and special character)"}, txtconfirmpassword:{required:"<br/>Please confirm password.", equalTo:"<br/>Please confirm password."}};
		$(document).ready(function() {
			$('#response,.loading').hide();
			$('#submit1').button();		
			$('#frmchpass').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frmchpass').ajaxSubmit({
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
</head>

<body>

<?php require_once('header.php');	?>
                <div id="formdiv">
                	<div id="formheading">Change password</div>
                    <div id="formfields">
                   <form id="frmchpass" name="frmchpass" enctype="multipart/form-data" action="change_password_post.php" method="POST" autocomplete="off">
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
                    				    	
					    		<table width="600px" border="0" cellspacing="0" cellpadding="0">
					    			<tr>
									    <td align="left" valign="top" colspan="2"><div id="response"></div></td>
									</tr>
								
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Old Password</label>
							    		</td>
							    		<td>	
							    			<input type="password" name="txtoldpassword" id="txtoldpassword" value="" />											
							    		</td>
						    		</tr>
									<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>New Password</label>
							    		</td>
							    		<td>	
							    			<input type="password" name="txtpassword" id="txtpassword" value="" />											
							    		</td>
						    		</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Confirm Password</label>
							    		</td>
							    		<td>
							    			<input type="password" name="txtconfirmpassword" id="txtconfirmpassword" value="" />											
							    		</td>
						    		</tr>
						    		<tr>
						    			<td>
						    			</td>
						    			<td style="height: 35px;">
											<input type="submit" name="submit1" id="submit1" value="Save"/>
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
</html>
