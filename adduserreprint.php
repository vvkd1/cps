<?php  require_once('global.php');
$jq = true;
$ui = true;
$form = true;
$valid = true;	
$page_name = "adduser_reprint";
authentication_print();
$allowedtoclick = authentication_groups($page_name);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Processing ::</title>
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		var vRules = { txtusername: { required:true }, txtpassword: { required:true }, txtconfirmpassword:{required:true, equalTo:"#txtpassword"}};
		var vMessages = { txtusername: { required: "<br/>Please select user name." }, txtpassword: { required: "<br/>Please select password." }, txtconfirmpassword:{required:"<br/>Please confirm password.", equalTo:"<br/>Please confirm password."}};
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
						clearForm: false,
						success: function (resObj) 
						{
							$('.loading').hide();					
							$('#response').html('<div class="errormsg_boundary">User Added Sucessfully<div>').show();								
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
                	<div id="formheading">Add Reprinter User</div>
                    <div id="formfields">
                   <form id="frmadduser" name="frmadduser" enctype="multipart/form-data" action="adduserprint_post.php" method="POST">
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
                    				    	
					    		<table width="300px" border="0" cellspacing="0" cellpadding="0">
					    			<tr>
									    <td align="left" valign="top" colspan="2"><div id="response"></div></td>
									</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>User Name </label>
							    		</td>
							    		<td>
							    			<input type="text" name="txtusername" id="txtusername" value="" />											
							    		</td>
						    		</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Password</label>
							    		</td>
							    		<td>
							    			<input type="text" name="txtpassword" id="txtpassword" value="" />											
							    		</td>
						    		</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Confirm Password</label>
							    		</td>
							    		<td>
							    			<input type="text" name="txtconfirmpassword" id="txtconfirmpassword" value="" />											
							    		</td>
						    		</tr>
						    		<tr>
						    			<td>
						    			</td>
						    			<td style="height: 35px;">
											<input name="submit1" type="submit" id="submit1" value="Save" />
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
</body>
</html>
