<?php  require_once('global.php');

authentication_print();
//if(!authentication_groups_pemissions($page_name,"","","Y"))
//	header("Location: ".SITE_ROOT."home.php");		
//$allowedtoclick = authentication_groups($page_name);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		var vRules = { 
				txtlastno: { required:true, maxlength:6, minlength: 6, number:true },
				txtFROM: { required:true, maxlength:6, minlength: 6, number:true },
				txtTo: { required:true, maxlength:6, minlength: 6, number:true }, 
				ddlBranch: { required:true }, 
				ddlBank: { required:true }, 
				ddlTransactioncode: { required:true }
		};
		
		var vMessages = { 
				txtlastno: { required: "<br/>Please enter last cheque series no.", 
				maxlength:"<br/>Cheque series no must not exceed then {6} characters ."},
				txtFROM: { required: "<br/>Please enter cheque series starting no.",maxlength:"<br/>Cheque series no must not exceed then {6} characters ."},
				txtTo: { required: "<br/>Please enter cheque series ending no.", maxlength:"<br/>Cheque series no must not exceed then {6} characters ."},
				ddlBranch: {required: "<br/>Please select branch" },
				ddlBank: {required: "<br/>Please select bank" },
				ddlTransactioncode: {required: "<br/>Please select transaction code" } };
		
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit1').button();		
			$('#frmchequeseries').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frmchequeseries').ajaxSubmit({
						target: '#response', 
						beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, 
						clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
									alert("Series added Sucessfully.");
									window.location = "manage_chequeseries.php";
							} else {	
								$('.loading').hide();
								$('#response').html('<div class="red">'+resObj.htmlcontent+'<div>').show();
							}
						}
						
					});
				}
			});
		});
	</script>
	<SCRIPT language=Javascript>

      function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			if(charCode != 08)
			{
				alert("Only numbers allowed");
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	  
	  function isNumberKey1(evt)
      {
        var charCode = (evt.which) ? evt.which : event.keyCode
		//alert(charCode);
        if (charCode > 31 && (charCode < 48 || charCode > 57) || charCode == 08)
		{
			return true;
		}
		else
		{
			alert("Only Characters allowed");
			return false;
		}
      }
     
   </SCRIPT>
	
</head>

<body>

<?php require_once('header.php');?>
                <div id="formdiv">
                	<div id="formheading">Cheque Series</div>
                    <div id="formfields">
                   <form id="frmchequeseries" name="frmchequeseries" enctype="multipart/form-data" action="post_chequeseries.php" method="POST" autocomplete="off">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
                          <table width="800" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                          <td>&nbsp;</td>
                          </tr>
						  <tr>
						    <td align="left" valign="top">		
							<?php
								if($row_setting->chk_taken_from == 1):
								$sqlseries = "SELECT * FROM tb_cps_chequeseries";
								$row_series = $db->get_row($sqlseries);
							?>
						    <div id="formfields">
                    				    	
					    		<table width="100%" border="0" cellspacing="0" cellpadding="0">
					    			<tr>
									    <td align="left" valign="top" colspan="2"><div id="response"></div></td>
									</tr>
									<tr>
							    		<td style="height: 35px; text-align: left" width="15%" align="left">
							    			<label>Bank</label><span class="red">*</span>
							    		</td>
							    		<td width="50%" align="left">
							    			<select name="ddlBank" id="ddlBank" style="width:190px; height:26px;">
												<option value=""> Select Bank</option><span class="red">*</span>
												<?php 
													$arrayBanks =  $db->get_results("SELECT * FROM tb_bankdetails");
													foreach($arrayBanks as $banks):
												?>
													<option value="<?php echo $banks->bank_id; ?>" ><?php echo $banks->bank_name; ?></option>
												<?php ENDFOREACH; ?>
											</select>
							    		</td>
						    		</tr>
									<tr>
							    		<td style="height: 35px; text-align: left" width="15%" align="left">
							    			<label>Branch</label><span class="red">*</span>
							    		</td>
							    		<td width="50%" align="left">
							    			<select name="ddlBranch" id="ddlBranch" style="width:190px; height:26px;">
												<option value=""> Select Branch</option><span class="red">*</span>
												<?php 
													$arrayBranch =  $db->get_results("SELECT * FROM tb_branchdetails ");
													foreach($arrayBranch as $branch):
												?>
													<option value="<?php echo $branch->branch_id; ?>" ><?php echo $branch->branch_name; ?></option>
												<?php ENDFOREACH; ?>
											</select>
							    		</td>
						    		</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left" width="15%" align="left">
							    			<label>Transaction Code</label><span class="red">*</span>
							    		</td>
							    		<td width="50%" align="left">
							    			<select name="ddlTransactioncode" id="ddlTransactioncode" style="width:190px; height:26px;">
												<option value=""> Select Code</option><span class="red">*</span>
												<?php 
													$arraytransactioncodes =  $db->get_results("SELECT * FROM tb_cps_transactioncodes");
													foreach($arraytransactioncodes as $transactioncode):
												?>
													<option value="<?php echo $transactioncode->transactioncode; ?>" ><?php echo $transactioncode->transactioncode; ?></option>
												<?php ENDFOREACH; ?>
											</select>
							    		</td>
						    		</tr>
									<tr>
							    		<td style="height: 35px; text-align: left" width="15%" align="left">
							    			<label>Cheque Series From</label><span class="red">*</span>
							    		</td>
							    		<td width="50%" align="left">
							    			<input type="text" name="txtFROM" id="txtFROM" value="<?php if($row_setting->chk_no_from > 0)echo $row_setting->chk_no_from;?>" onKeyPress = "return isNumberKey(event);" />
							    		</td>
						    		</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Cheque Series To</label><span class="red">*</span>
							    		</td>
							    		<td>
							    			<input type="text" name="txtTo" id="txtTo" value="<?php if($row_setting->chk_no_to > 0)echo $row_setting->chk_no_to;?>" onKeyPress = "return isNumberKey(event);" />											
							    		</td>
						    		</tr>
						    		<tr>
							    		<td style="height: 35px; text-align: left">
							    			<label>Cheque Series Starts From</label><span class="red">*</span>
							    		</td>
							    		<td>
							    			<input type="text" name="txtlastno" id="txtlastno" value="<?php if($row_setting->series_lastno > 0) echo $row_series->series_lastno; ?>" onKeyPress = "return isNumberKey(event);" />											
							    		</td>
						    		</tr>
						    		<tr>
						    			<td>
						    			</td>
						    			<td style="height: 35px;">
											<input name="submit1" type="submit" id="submit1" value="Save"/>
											<input type="submit" name="submit1" id="submit1" value="Save and Close" class="submitbutton" />
											<input type="button" name="submit3" id="submit3" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
											<div class="loading"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
						    			</td>
						    		</tr>
					    		</table>
					    		
					    		</div>
								<?php else:?>
								<div id="formfields">
                    				<table width="600px" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td style="height: 35px; text-align: left">
												<label>Cheque Series given by bank</label>
											</td>
										</tr>
									</table>
					    		</div>
								<?php endif;?>
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
