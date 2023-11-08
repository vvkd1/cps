<?php  require_once('global.php');
$page_name = "manageuser_account";
authentication_print();
if(!authentication_groups_pemissions($page_name,"Y","",""))
	header("Location: ".SITE_ROOT."home.php");		

$row = $db->get_row("select adminid,username,userid,password,lastlogintime,user_type,group_id from tb_printadmin where adminid=".$_SESSION['admin_id']."");	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		
		var vRules = { txtusername: { required:true }, txtoldpassword: { required:true }, txtpassword: { required:true }, txtconfirmpassword:{equalTo:"#txtpassword"}};
		var vMessages = { txtusername: { required: "<br/>Please enter user name." }, txtoldpassword: { required: "<br/>Please enter old password." }, txtpassword: { required: "<br/>Please enter password." }, txtconfirmpassword:{equalTo:"<br/>Please confirm password."}};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
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
									alert("Password Updated Sucessfully.");
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

<?php require_once('header.php');	?>
                <div id="formdiv">
                	<div id="formheading">Change Password</div>
                    <div id="formfields">
                   <form id="frmadduser" name="frmadduser" enctype="multipart/form-data" action="changepassword_post.php?do=edit&adminid=<?php echo $_REQUEST['adminid'] ?>" method="POST" autocomplete="off">
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
									    <td align="left" valign="top" colspan="2">
											<SPAN style="color:red;font-size:bold">CHANGE PASSWORD TO ACCESS TO THE SYSTEM </SPAN>
										</td>
									</tr>
									<tr>
									    <td align="left" valign="top" colspan="2">
											&nbsp;&nbsp;&nbsp;&nbsp;
										</td>
									</tr>
									<tr>
									    <td align="left" valign="top" colspan="2"><div id="response"></div></td>
									</tr>									
									<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>User Name</label>
							    		</td>
							    		<td>
							    			<input type="text" name="txtusername" id="txtusername" readonly="true" value="<?php echo $row->username; ?>" /><label>(User Name should be bank employee name)</label>
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
											<input type="submit" name="submit2" id="submit2" value="Update and Close" class="submitbutton" />
											
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
