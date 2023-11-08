<?php 
require_once('global.php');	
$rowrequestslip = $db->get_row("SELECT * FROM tb_cps_requestslip");
$page_name = "bank_master";
authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<link rel="stylesheet" href="css/stylecss.css" type="text/css" />
<style>
    #wrapper{
        margin:0px auto;
        width:816px;    
    }

    #wrapper_div{
        float:left;
        width:100%;
        background:url(images/requestslip_img.jpg) no-repeat;
        margin-top:20px;
        height:334px;
    }
    
    .input_div{
        width:784px;
        float:left;
        position:relative;
        height:303px;
    }

    .date_input textarea{
        width:400px;
        border:1px solid #999;
        font-size:9px;
        padding:2px 0px 0px 2px;
        overflow:hidden;
        float:right;
    }


    .text_input textarea{
        width:407px;
        font-size:9px;
        padding:2px 0px 0px 2px;
        overflow:hidden;
        position:absolute;
        right:63px;
        border:1px solid #999;
        top:102px;
    }
    
    .text_input2 textarea{
        width:411px;
        font-size:9px;
        padding:2px 0px 0px 2px;
        overflow:hidden;
        border:1px solid #999;
        position:absolute;
        top:158px;
        border-top:0px;
        right:58px;
    }
    .text_input3 textarea{
        width:778px;
        margin:0px 0px 0px 2px;
        font-size:9px;
        overflow:hidden;
        position:absolute;
        bottom:0px;
        border:1px solid #999;
    }
</style>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		
		var vRules = {};
		var vMessages = {};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit1').button();		
			$('#frmrequestslip').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frmrequestslip').ajaxSubmit({
						target: '#response', 
						beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, 
						clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									alert("Request slip details updated Sucessfully.");
									//window.location = "bankmaster.php";
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
		
	</script>
	
</head>

<body>

<?php require_once('header.php');	?>
                
                <div id="formdiv">
                	<div id="formheading">Request Slip Master</div>
                    
                    <form id="frmrequestslip" name="frmrequestslip" method="post" action="post_requestslipmaster.php" autocomplete="off">
                      <div id="wrapper">
							<div id="wrapper_div">
								<div class="input_div">
									<div class="date_input">
										<!--<textarea name="requestfield1" cols="" rows="2"><?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield1;?></textarea>-->
										<input type="textbox" name="txtrequestfield1" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield1;?>" />
										<br/>
										<input type="textbox" name="txtrequestfield2" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield2;?>" />
									</div>

									<div class="text_input">
										<!--<textarea name="requestfield2" cols="" rows="3"><?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield2;?></textarea>-->
										<input type="textbox" name="txtrequestfield3" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield3;?>" />
										<br/>
										<input type="textbox" name="txtrequestfield4" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield4;?>" />
										<br/>
										<input type="textbox" name="txtrequestfield5" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield5;?>" />
										<br/>
										<input type="textbox" name="txtrequestfield6" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield6;?>" />
									</div>

									<div class="text_input2">
									<!--<textarea name="requestfield3" cols="" rows="2"><?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield3;?></textarea>-->
										<input type="textbox" name="txtrequestfield7" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield7;?>" />
											<br/>
										<input type="textbox" name="txtrequestfield8" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield8;?>" />
										<br/>
										<input type="textbox" name="txtrequestfield9" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield9;?>" />
									</div>

									<div class="text_input3">
										<!--<textarea name="requestfield4" cols="" rows="2"><?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield4;?></textarea>-->
										<input type="textbox" name="txtrequestfield10" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield10;?>" />
										<br/>
										<input type="textbox" name="txtrequestfield11" value="<?php if(isset($rowrequestslip)) echo $rowrequestslip->requestfield11;?>" />
									</div>
								</div>
							</div>
						</div>
						<div>	
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="100%" align="left" valign="top">
										<?php if(authentication_groups_pemissions($page_name,"","Y","","Y")):?>
										<input name="submit" type="submit" id="submit" value="Update Details"  style="height:30px; width:150px" />
										<input type="submit" name="submit1" id="submit1" value="Save and Close" class="submitbutton" />
										<?php endif;?>
										<input type="button" name="submit2" id="submit2" value="Discard" class="submitbutton" onClick="window.location.href='home.php'" />
										<input type="button" name="submit3" id="submit3" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
										<div class="loading"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
									</td>
									<td width="35%" align="left" valign="top"></td>
								</tr>
							</table>
						</div>
                      </form>
                    
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php');	?> 	
</body>
</html>
