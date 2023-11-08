<?php  require_once('../global.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
<?php include('../includes.php'); ?>
<script type="text/javascript">
		var vRules = { username: { required:true }, password: { required:true, minlength:8 },confirmpassword: { equalTo:"#password"} };
		var vMessages = { username: {required: "<br/>Please enter username" }, password: { required: "<br/>Please enter password." , minlength:"Password must be at least {6} characters in length."}, confirmpassword:{ equalTo: "<br/>Password does not match." } };
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit').button();		
		
			$('#loginform').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#loginform').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
							return validate();
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
							$('#submitdiv').hide();
						}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									window.location = 'installstep2.php';
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
		
		function validate() {   
		var curVal = document.getElementById("password").value;
		var mystring=new String(curVal)

		if(mystring.search(/[0-9]+/)==-1 && mystring.search(/[A-Z]+/)==-1 || mystring.search(/[a-z]+/)==-1) {
			document.getElementById("divalphanum").innerHTML = "Password should be alpha numeric";
			return false;
		}else{
			document.getElementById("divalphanum").innerHTML = "";
			return true;
		}
	}
		
		
		
	</script>
	
</head>

<body>

<div id="topdivlogo">
<div id="titlediv">Cheque Personalization System</div>
<div class="topright-menu">
</div>
</div>
	<div id="innerpage-maindiv">
    	<div class="clear">&nbsp;</div>
    	<div class="middle-maindiv">
        	<div class="middlesubdiv">
                <form id="loginform" name="loginform" method="post" action="post_installstep1.php" autocomplete="off">
                <div id="formdiv">
               <div id="formheading">Create Administrator</div>
				<div id="formfields">
                <div id="formfields">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
                    <tr>
                      <td align="left" valign="top" style="padding-left:16px; padding-top:16px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="15%" height="35" align="left" valign="top"><label>Username</label></td>
                          <td width="85%" align="left" valign="top"><input type="text" name="username" id="username" style="width:226px;" /></td>
                        </tr>
                        <tr>
                          <td height="35" align="left" valign="top"><label>Password</label></td>
                          <td align="left" valign="top"><input type="password" name="password" id="password" style="width:220px;" /><div id="divalphanum" class="red"></div></td>
                        </tr>
                        <tr>
                          <td height="35" align="left" valign="top"><label>Confirm Password</label></td>
                          <td align="left" valign="top"><input type="password" name="confirmpassword" id="confirmpassword" style="width:220px;" /></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="right" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                        	<td colspan="2">
                        		<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
                    			<div id="response"></div>
                        	</td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="right" valign="top" style="padding-right:16px;">
                          	<div id="logindivbottombar" style="width:500px; float:right; cursor:pointer;">
                          		<input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Back to previous page" onclick="window.location='welcome.php'"  />&nbsp;&nbsp;
								<input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Click here to Edit" onclick="document.getElementById('username').focus();"  />&nbsp;&nbsp;
								<input name="submit" type="submit" id="submit" class="submitbutton" value="Go to next page"  />
                          	</div>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="right" valign="top" style="padding-right:16px;">&nbsp;</td>
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
