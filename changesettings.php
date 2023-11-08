<?php  require_once('global.php');
$page_name = "Admin";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","Y"))
	header("Location: ".SITE_ROOT."home.php");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php include('includes.php'); ?>
<script type="text/javascript">
	
	var vRules = {txthelp_emailid: { email:true }};
	var vMessages = {txthelp_emailid:{email:"<br>Please enter correct email id</br>"}};
	$(document).ready(function() {
		$('#response,#ajax_loading,.loading').hide();
		$('#submit1').button();			
		
		$("#submit1").click(function(){
			$("#submit_type").val('1');
			submit_form();
		});
		$("#submitSavenClose").click(function(){
			$("#submit_type").val('0');
			submit_form();
		});
	});
	
	function submit_form() {
		$('#frmSettings').validate({
			
			rules: vRules,
			messages: vMessages,			
			submitHandler: function(form) {
				$('#frmSettings').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
						formData.push({ "name": "type", "value": "json" });
						$('.loading').show();						
					}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
						if (resObj.status) {
								alert('Settings Saved Successfully');
								window.location = resObj.loc;
								$('.loading').hide();						
						} else {	
							$('.loading').hide();
							$('#response').html('<div class="errormsg_boundary">'+resObj.htmlcontent+'<div>').show();
						}
					}
				});
			}
		});
	}
	
	function getprintermodels(str)
	{
		
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				
				document.getElementById("divprintermodels").innerHTML="";
				document.getElementById("divprintermodels").innerHTML=xmlhttp.responseText;
				document.getElementById("divloadingprintmodel").style.display="none";
			}
			else
			{
				document.getElementById("divloadingprintmodel").style.display="block";
			}
		}
		xmlhttp.open("GET","post_changesettings.php?pid="+str,true);
		xmlhttp.send();
	}
	
	function setdelimitersetting(delvalue,divid){
		if(delvalue == "ASCII"){
			document.getElementById(divid).style.display = "block";
		}
		else{
			document.getElementById(divid).style.display = "none";
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
  //-->
</SCRIPT>
</head>

<body>
<?php require_once('header.php');	?>
<div id="formdiv">
<div id="formheading">CPS Parameters</div>
<div id="formfields">
<?php
$row_settings = $db->get_row("select * from `tb_cps_settings");
?>
<form id="frmSettings" name="frmSettings" action="post_changesettings.php" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0"
	style="border: 1px solid; border-color: #cccccc;">
	<tr>
		<td align="left" valign="top"
			style="padding-left: 16px; padding-top: 16px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			<tr>
				<td width="15%" height="35" align="left" valign="top"><label>Input File Format</label></td>
				<td width="85%" align="left" valign="top">
					<select name="ddlFileFormat" id="ddlFileFormat" style="width: 220px;" onChange="setdelimitersetting(this.value,'divddlInputDelimiter');" >
						<option value = "Excel" <?php if($row_settings->inputfileformat=="Excel") echo "selected=selected"; ?>>Excel</option>
						<!--
						<option value = "CSV" <?php if($row_settings->inputfileformat=="CSV") echo "selected=selected"; ?>>CSV</option>
						<option value = "ASCII" <?php if($row_settings->inputfileformat=="ASCII") echo "selected=selected"; ?>>ASCII</option>
						 -->
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="divddlInputDelimiter" <?php if($row_settings->inputfileformat=="ASCII") {echo "style='display:block'";}else{echo "style='display:none'";} ?>>
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td height="35" align="left" valign="top" width="16%"><label>Input File Delimiter</label></td>
							<td align="left" valign="top" width="64%">
								<select name="ddlInputDelimiter" id="ddlInputDelimiter" style="width: 220px;" >
									<option value="Colon" <?php if($row_settings->inputfiledelimiter=="Colon") echo "selected=selected"; ?>>, (Colon)</option>
									<option value="SemiColon" <?php if($row_settings->inputfiledelimiter=="SemiColon") echo "selected=selected"; ?> >; (SemiColon)</option>
									<option value="Tild" <?php if($row_settings->inputfiledelimiter=="Tild") echo "selected=selected"; ?>>~ (Tild)</option>
									<option value="Pipe" <?php if($row_settings->inputfiledelimiter=="Pipe") echo "selected=selected"; ?>>| (Pipe)</option>									
								</select>
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
			
			<tr>
				<td height="35" align="left" valign="top"><label>Output File Format</label></td>
				<td align="left" valign="top">
					<select name="ddlOutputFileFormat" id="ddlOutputFileFormat" style="width: 220px;" onChange="setdelimitersetting(this.value,'divddlOutputDelimiter');" >
						<option value = "Excel" <?php if($row_settings->outputfileformat=="Excel") echo "selected=selected"; ?>>Excel</option>
						<!--<option value = "XML" <?php //if($row_settings->outputfileformat=="XML") echo "selected=selected"; ?>>XML</option>
						<option value = "ASCII" <?php if($row_settings->outputfileformat=="ASCII") echo "selected=selected"; ?>>ASCII</option>-->
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<div id="divddlOutputDelimiter" <?php if($row_settings->outputfileformat=="ASCII"){ echo "style='display:block'";} else{echo "style='display:none'";} ?>>
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td height="35" align="left" valign="top" width="16%"><label>Out File Delimiter</label></td>
							<td align="left" valign="top" width="64%">
								<select name="ddlOutputDelimiter" id="ddlOutputDelimiter" style="width: 220px;" >
									<option value="Colon" <?php if($row_settings->outputfiledelimiter=="Colon") echo "selected=selected"; ?>>, (Colon)</option>
									<option value="SemiColon" <?php if($row_settings->outputfiledelimiter=="SemiColon") echo "selected=selected"; ?> >; (SemiColon)</option>
									<option value="Tild" <?php if($row_settings->outputfiledelimiter=="Tild") echo "selected=selected"; ?>>~ (Tild)</option>
									<option value="Pipe" <?php if($row_settings->outputfiledelimiter=="Pipe") echo "selected=selected"; ?>>| (Pipe)</option>
								</select>
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
			
			<tr style="display:none">
				<td height="35" align="left" valign="top"><label>Archive Folder Path</label></td>
				<td align="left" valign="top">
					<input type="text" name="txtArchiveFolder" id="txtArchiveFolder" style="width: 220px;" value="<?php echo $row_settings->archivefolderpath; ?>" />&nbsp;<label>(Ex. D:\Folder Name\)</label>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top" height="35px" width="20%">
					<label>Cheque Serial No Generation</label>
				</td>
				<td class="name"  valign="top" height="35px">
					<input type="radio" name="chk1" <?php if($row_settings->chk_taken_from == "0" ){echo "checked=checked";} ?>  value="0" >Bank generated
					<input type="radio" name="chk1"  <?php if($row_settings->chk_taken_from == "1" ){echo "checked=checked";} ?> value="1" >System generated					
				</td>
			</tr>
			
			<tr>
				<td height="35" align="left" valign="top"><label>No of failed password attempt</label></td>
				<td align="left" valign="top">
					<input type="text" name="txtnooffailedpasswordattempt" id="txtnooffailedpasswordattempt" style="width: 220px;" value = "<?php echo $row_settings->nooffailedpasswordattempt; ?>" maxlength="2" onkeypress="return isNumberKey(event)" />&nbsp;<label>(Password will automatically expire after it.)</label>
				</td>
			</tr>
			
			<tr>
				<td height="35" align="left" valign="top"><label>Password Expire</label></td>
				<td align="left" valign="top">
					<input type="text" name="txtpasswordexpiry" id="txtpasswordexpiry" style="width: 25px;" value="<?php echo $row_settings->password_expiry; ?>" maxlength="3" onkeypress="return isNumberKey(event)"  />&nbsp;<label>(In days)</label>
				</td>
			</tr>
			<tr>
				<td height="35" align="left" valign="top"><label>Home Screen Text</label></td>
				<td align="left" valign="top">
					<input type="text" name="txthomescreen_text" id="txthomescreen_text" style="width: 220px;" value = "<?php echo $row_settings->homescreen_text; ?>" />&nbsp;<label> (Text to show on home page)</label>
				</td>
			</tr>
			<tr>
				<td height="35" align="left" valign="top"><label>Auto Lock</label></td>
				<td align="left" valign="top">
					<input type="text" name="txtautolockminutes" id="txtautolockminutes" style="width: 220px;" value = "<?php echo $row_settings->autolockminutes; ?>" maxlength="5" onkeypress="return isNumberKey(event)" />&nbsp;<label> (Minutes after login user will be logged out.)</label>
				</td>
			</tr>
			<tr>
				<td height="35" align="left" valign="top"><label>Powered by</label></td>
				<td align="left" valign="top">
					<input type="text" name="txtpoweredby" id="txtpoweredby" style="width: 220px;" value = "<?php echo $row_settings->poweredby; ?>" maxlength="50" />&nbsp;<label> </label>
				</td>
			</tr>
			<tr>
				<td height="35" align="left" valign="top"><label>Image Logo</label><span class="red">*</span></td>
				<td align="left" valign="top">
					<input type="file" name="banklogo" id="banklogo" /> <input type="hidden" id="hiddlogo" name="hiddlogo" value="<?php echo $row_settings->banklogo; ?>" />
				</td>
			</tr>
			<tr>
				<td height="35" align="left" valign="top"><label>Desktop Image</label><span class="red">*</span></td>
				<td align="left" valign="top">
					<input type="file" name="desk_img" id="desk_img" /> <input type="hidden" id="hiddimg" name="hiddimg" value="<?php echo $row_settings->desktop_image; ?>" />
				</td>
			</tr>
			<!--<tr>
				<td height="35" align="left" valign="top"><label>Cheque Image</label><span class="red">*</span></td>
				<td align="left" valign="top">
					<input type="file" name="chequeimage" id="chequeimage" /> <input type="hidden" id="hiddhchq" name="hiddhchq" value="<?php echo $row_settings->chq_Image; ?>" />
				</td>
			</tr>-->
			<!--<tr>
				<td height="35" align="left" valign="top"><label>Select Country</label></td>
				<td align="left" valign="top">
					<select name="ddlcountry" id="ddlcountry" style="width:190px; height:26px;" >
						<option value="0"> Select Country</option>
						<?php //$rowgetcountry =  $db->get_results("select * from tb_countrymaster");?>
						<?php //foreach($rowgetcountry as $eachcountry):?>
						<option value="<?php //echo $eachcountry->country_id; ?>" <?php //if(stripslashes($eachcountry->country_id)== $row_settings->country){echo "Selected";} ?>><?php //echo $eachcountry->country_name; ?></option>
						<?php //endforeach;?>
					</select>
				</td>
			</tr>-->
			<tr>
				<td>
				&nbsp;
				</td>
			</tr>
			
			<tr>
            	<td colspan="2">
            		<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
            		<div id="response" class="red"></div>
            	</td>
            </tr>
			<tr>
				<td align="left" valign="top">&nbsp;</td>
				<td align="right" valign="top" style="padding-right: 16px;">&nbsp;</td>
			</tr>
			<tr>
				<td>
				</td>
				<td align="left" valign="top">
					<?php if(authentication_groups_pemissions($page_name,"","Y","","Y")):?>
					<input type="submit" name="submit1" id="submit1" value="Save"  />&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="hidden" name="submit_type" id="submit_type" value="1" />
					<input type="submit" name="submitSavenClose" id="submitSavenClose" value="Save and Close" class="submitbutton" />&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif;?>
					<input type="button" name="submitDiscard" id="submitDiscard" value="Discard" class="submitbutton" onclick="window.location='home.php'" />&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" name="submitGotoHome" id="submitGotoHome" value="Go to Home" class="submitbutton" onclick="window.location='home.php'"  />
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">&nbsp;</td>
				<td align="right" valign="top" style="padding-right: 16px;">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" valign="top">&nbsp;</td>
				<td align="right" valign="top" style="padding-right: 16px;">&nbsp;</td>
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
</body>
</html>
