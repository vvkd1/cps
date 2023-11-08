<?php  require_once('global.php');
$page_name = "change_password";
authentication_print();
if(!authentication_groups_pemissions($page_name,"Y","",""))
	header("Location: ".SITE_ROOT."home.php");		

$rowToner=checkTonerCapacity();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		
		var vRules = { toner_leaves_capacity: { required:true }};
		var vMessages = { toner_leaves_capacity: { required: "<br/>Please enter leaves capacity."}};
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
									alert("Setting updated Sucessfully.");
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
                	<div id="formheading">Update Toner Leaves/Pages Capacity</div>
                    <div id="formfields">
                   <form id="frmchpass" name="frmchpass" enctype="multipart/form-data" action="toner_post.php" method="POST" autocomplete="off">
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
							    			<label>Toner Capacity</label>
							    		</td>
							    		<td>	
							    			<input type="text" name="toner_leaves_capacity" id="toner_leaves_capacity" value="<?php echo $rowToner['count'];?>" /><label>	Maximum Pages toner can print. (Ink left in toner)</label>
							    	
							    		</td>
						    		</tr>
										<tr>
									    <td align="left" valign="top" colspan="2">
							    				<?php if(!$rowToner['status']){
							    					?>
							    					<label style="color:red;"> Please replace your toner.</label>
							    				<?php	
							    				}?></td>
									</tr>
						    		<tr>
						    			<td>
						    			</td>
						    			<td style="height: 35px;">
											<input type="submit" name="submit1" id="submit1" value="Update"/>
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
