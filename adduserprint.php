<?php  require_once('global.php');

$page_name = "manageuser_account";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","","Y"))
	header("Location: ".SITE_ROOT."home.php");		
	
	$totrows = $db->get_row("select count(*) as totalusers from tb_printadmin where user_type in(0,1)");
	$totusers = $db->get_row("select license_users_leaves,license_users_leaves_value from tb_cps_settings");
	
	//echo $totrows->totalusers; 
	//echo $totusers->license_no_of_users;
	//die();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		
		var vRules = { txtusername: { required:true }, txtpassword: { required:true, minlength:6 }, txtconfirmpassword:{required:true, equalTo:"#txtpassword"}, txtuserid: { required:true }, ddlusergp: { required:true }};
		var vMessages = { txtusername: { required: "<br/>Please enter user name." }, txtpassword: { required: "<br/>Please enter password.", minlength: "<br/>Password length should be minimum 6 <br/>(combination of alpha, numeric and special character)"}, txtconfirmpassword:{required:"<br/>Please confirm password.", equalTo:"<br/>Please confirm password."}, txtuserid: { required: "<br/>Please enter user id ." }, ddlusergp: { required: "<br/>Please select user group ." }};
		//var vRules = { txtusername: { required:true }, txtuserid: { required:true }, ddlusergp: { required:true }, txtpassword: { required: true }};
		//var vMessages = { txtusername: { required: "<br/>Please enter user name." },  txtuserid: { required: "<br/>Please enter user id ." }, ddlusergp: { required: "<br/>Please select user group ." }, txtpassword: { required: "<br/>Please enter password." }};
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
							return validate();
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, 
						clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									//alert("User Added Sucessfully.");
									//window.location = "adduserprint.php";
									alert("User created successfully");
									window.location = resObj.loc;
							} else {	
								$('.loading').hide();
								$('#response').html('<div class="errormsg_boundary">'+resObj.htmlcontent+'<div>').show();
							}
						}
						
					});
				}
			});
		});
		
		
	function validate() {   
		var curVal = document.getElementById("txtpassword").value;
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
	<SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
			{
				alert("Only numbers allowed");
				return false;
			}
			else
			{
				return true;
			}	
      }
	  function isNumberKey1(evt)
      {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			return true;
		}
		else
		{
			alert("Only Characters allowed");
			return false;
		}
      }
      
		function createpassword(passwordstring)
		{
			
			if(passwordstring != ""){
				var chars = "0123456789"+passwordstring+"ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
				var string_length = 10;
				var randomstring = '';
				for (var i=0; i<string_length; i++) {
						var rnum = Math.floor(Math.random() * chars.length);
						randomstring += chars.substring(rnum,rnum+1);
				}
				document.getElementById("txtpassword").value = randomstring; 
				return true;
			}
			else{
				return false;
			}
			
		}
   </SCRIPT>
	
</head>

<body>

<?php require_once('header.php');	?>
                <div id="formdiv">
                	<div id="formheading">Add User</div>
                    <div id="formfields">
                   <form id="frmadduser" name="frmadduser" enctype="multipart/form-data" action="adduserprint_post.php?do=add" method="POST" autocomplete="off">
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
							    		<td style="height: 35px; text-align: left">
							    			<label>User Name</label><span class="red">*</span>
							    		</td>
							    		<td>
							    			<input type="text" name="txtusername" id="txtusername" value="" /><label>(User Name should be bank employee name)</label>
							    		</td>
						    		</tr>
									<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>User Id</label><span class="red">*</span>
							    		</td>
							    		<td>
							    			<input type="text" name="txtuserid" id="txtuserid" value="" /><label>(User ID should be bank employee code)</label>
							    		</td>
						    		</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Password</label><span class="red">*</span>
							    		</td>
							    		<td>
							    			<input type="password" name="txtpassword" id="txtpassword" value=""  /><div id="divalphanum" class="red"></div>											
							    		</td>
						    		</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Confirm Password</label><span class="red">*</span>
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
											<input type="submit" name="submit2" id="submit2" value="Save and Close" class="submitbutton" />
											<input type="button" name="submit3" id="submit3" value="Discard" class="submitbutton" onClick="window.location.href='home.php'" />
											<input type="button" name="submit4" id="submit4" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
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
