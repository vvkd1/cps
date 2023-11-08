<?php  require_once('../global.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
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
									window.location = 'installstep7.php';
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

	

	function addElement() {
		var maindiv = document.getElementById('myDiv');
		var count = maindiv.getElementsByTagName('input').length;
		var count = count + 1;
		if(count <= 5)
		{
			var ni = document.getElementById('myDiv');
			var numi = document.getElementById('theValue');
			var num = (document.getElementById('theValue').value -1)+2;
			numi.value = num;
			var newdiv = document.createElement('div');
			var divIdName = 'my'+num+'Div';
			newdiv.setAttribute('id',divIdName);
			newdiv.innerHTML = '<br><input type="text" onKeyUp="javascript:this.value=this.value.toUpperCase();" name="user'+count+'" id="user'+count+'">'; 
			document.getElementById("usercount").value = count;
			ni.appendChild(newdiv);
		}else{
			alert("You cannot add mor then 6 user.");
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
                <div id="formdiv">
				<div id="formheading">Create User Group</div>
					<div id="formfields">
						<form name="adduser" id="adduser" action="post_installstep6.php" method="post" autocomplete="off">
						 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
							<tr>
								<td align="left" valign="top" style="padding-left:16px; padding-top:16px; padding-bottom:16px">
									<table cellspacing="0" cellpadding="0" border="0" width="100%">
										<tr>
											
										</tr>
										
										<tr>
											<td></td>
											<td>
												<table cellspacing="0" cellpadding="0" border="0">
													<tr>
														<td style="padding-right:5px" valign="top">
															<label>Enter User Gr. Name</label>
															<input type="hidden" name="usercount" id="usercount" value="0">
															<input type="hidden" value="1" id="theValue" />
														</td>
														<td style="padding-right:5px">
															<?php
																if($result = $db->get_results("SELECT group_name FROM tb_cps_groups")){
																	$i = 1;
																	foreach($result as $row){																		
																		if($i == 1){
																		?>
																			<input type="text" name="user0" id="user0" value="<?php echo $row->group_name; ?>"><br />
																		<?php
																		
																	}$i = $i + 1;}
																}else{
																	?>
																			<input type="text" name="user0" id="user0" onKeyUp="javascript:this.value=this.value.toUpperCase();"><br />
																		<?php
																}
															?>							
														</td>
														<td>
															<img src="../images/add.png" alt="" onClick="addElement()" />
														</td>
													</tr>
													<tr>
														<td></td>
														<td colspan="2">
															<div id="myDiv">
															<?php
																if($result = $db->get_results("SELECT group_name FROM tb_cps_groups")){
																	$i = 0;
																	foreach($result as $row){																		
																		if($i != 0){
																		?>
																			<br /><input type="text" name="user<?php echo $i; ?>" id="user<?php echo $i; ?>" value="<?php echo $row->group_name; ?>"><br />
																		<?php
																		
																	}$i = $i + 1;}
																}else{
																
																}
															?>
															</div>
														</td>
													</tr>
												</table>
											
											
											
											
												
											</td>
											<td></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											
											<td align="right" valign="top" style="padding-right: 16px;" colspan="4">
												<input name="submit" type="button" id="submit" class="submitbutton" value="Back to previous page" onClick="window.location.href='installstep4.php'" />&nbsp;&nbsp;
												<input name="btnBack" type="button" id="btnBack" class="submitbutton" value="Click here to Edit" onclick="document.getElementById('user0').focus();"  />&nbsp;&nbsp; 
												<input type="submit" name="submit" id="submit" value="Go to next page" class="submitbutton" />
											</td>	
											
										</tr>
										<tr>
											<td colspan="3">
												<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
												<div id="response"></div>
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
	<script type="text/javascript">
		var maindiv = document.getElementById('myDiv');
		var count = maindiv.getElementsByTagName('input').length;
		if(count > 0){
			document.getElementById("usercount").value = count + 1;
		}
	</script>
</body>
</html>
