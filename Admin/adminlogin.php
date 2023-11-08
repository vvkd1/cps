<?php  require_once('../global.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>IIPL COMMERCE CMS</title>
	<?php include('../includes.php'); ?>
	<script type="text/javascript">
		var vRules = { username: { required:true }, password: { required:true} };
		var vMessages = { username: {required: "<br/>Please enter username" }, password: { required: "<br/>Please enter password."} };
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit').button();		
		
			$('#loginform').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#loginform').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
							$('#submitdiv').hide();
						}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									window.location = 'Adminhome.php';
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
</head>
<body>
<div id="topdivlogo">
	<div id="titlediv">Cheque Personalization System</div>
</div>
<div id="maintitlediv">
	<form id="loginform" name="loginform" method="post" action="post_adminlogin.php" autocomplete="off">
		<div id="logindivtopbar"><img src="../images/logintopbar.jpg" width="331" height="10" /></div>
		<div id="logindivmiddle">
			<div id="loginelementdiv">
				<div style="width:100%; margin-bottom:14px;" class="formtitle">User Id</div>
				<div style="width:100%; margin-bottom:20px;" class="formtitle">
					<input name="userid" type="text" class="formfield" id="userid" tabindex="1" />
				</div>
				<div style="width:100%; margin-bottom:14px;" class="formtitle">Password</div>
				<div style="width:100%; margin-bottom:17px;" class="formtitle">
					<input name="password" type="password" class="formfield" id="password" tabindex="2" />
				</div>
				<div style="width:100%;">
					<div id="logindivbottombar" style="width:62px; float:right; cursor:pointer;">
					<input name="submit" type="submit" id="submit" value="Login" tabindex="3" /></div>
                    <div class="loading"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
                    <div id="response"></div>
				</div>
				<div style="width:100%; clear:both; height:10px;"></div>
				
			</div>
		</div>
		<div id="logindivbottombar"><img src="../images/logindivbottombar.jpg" width="331" height="21" />
		
		
	</form>
</div>
<script language="JavaScript">
		document.loginform.username.focus();
	</script>
</body>
</html>

