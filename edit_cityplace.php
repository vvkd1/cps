<?php  require_once('global.php');
$page_name = "city_master";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","","","Y"))
	header("Location: ".SITE_ROOT."home.php");
if(isset($_REQUEST['cid']) && !empty($_REQUEST['cid'])){
$row = $db->get_row("Select * from tb_citymaster where city_id=".$_REQUEST['cid']."");	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Processing ::</title>
<link rel="stylesheet" href="css/stylecss.css" type="text/css" />
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<?php include('includes.php'); ?>
<script type="text/javascript">
		var vRules = { city_place: { required:true }, ddlcountry: { required:true }, ddlstate: { required:true }};
		var vMessages = { city_place: {required: "<br/>Please enter city place" },ddlcountry: {required: "<br/>Please select country" },ddlstate: {required: "<br/>Please select state" }};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit').button();		
		
			$('#addcountry').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#addcountry').ajaxSubmit({target: '#response', beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, clearForm: false, dataType: 'json', success: function (resObj, statusText) {
							if (resObj.status) {
								//window.location = 'manage_cityplace.php';
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
	<script type="text/javascript">
		function showUser(str)
		{
			//if (str=="")
			//{
				//document.getElementById("divstatelist").innerHTML="";
				//return;
			//}
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("divstatelist").innerHTML="";
					document.getElementById("divstatelist").innerHTML=xmlhttp.responseText;
					//alert(xmlhttp.responseText);
				}
			}
			xmlhttp.open("GET","post_cityplace.php?contid="+str,true);
			xmlhttp.send();
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
      //-->
   </SCRIPT>
</head>

<body>

<?php require_once('header.php');	?>
                <div id="formdiv">
					<div id="formheading">Add City</div>
					<div id="formfields">
						<form name="addcountry" id="addcountry" action="post_cityplace.php?do=edit&cid=<?php echo $_REQUEST['cid'] ?>" method="post">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
								<tr>
									<td align="left" valign="top" style="padding-left:16px; padding-top:16px; padding-bottom:16px">												
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>Country</label>
												</td>
												<td width="85%" align="left" valign="top">
													<label>
														<select name="ddlcountry" id="ddlcountry" style="width:190px; height:26px;" onchange="showUser(this.value)">
														<option value=""> Select Country</option><span class="red">*</span>
															<?php 
																$rowgetcountry =  $db->get_results("select * from tb_countrymaster");
																foreach($rowgetcountry as $eachcountry){
															?>
																<option value="<?php echo $eachcountry->country_id; ?>" <?php if(stripslashes($eachcountry->country_id)== $row->country_id){echo "Selected";} ?>><?php echo $eachcountry->country_name; ?></option>
															<?php 
																} 
															?>
														</select>
													</label>
												</td>
											</tr>
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>State</label>
												</td>
												<td width="85%" align="left" valign="top">
													<label>
														<div id="divstatelist">
															<select name="ddlstate" id="ddlstate" style="width:190px; height:26px;">
															<option value=""> Select State</option><span class="red">*</span>
															<?php 
																$rowgetstate =  $db->get_results("select * from tb_statemaster where country_id = ".$row->country_id."");
																foreach($rowgetstate as $eachstate){
															?>
															<option value="<?php echo $eachstate->state_id; ?>" <?php if(stripslashes($eachstate->state_id)== $row->state_id){echo "Selected";} ?>><?php echo $eachstate->state_name; ?></option>
															<?php 
																} 
															?>
														</select>
														</div>
													</label>
												</td>
											</tr>
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>Enter City Place</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtcityplace" id="txtcityplace" value="<?php echo $row->city_place; ?>" style="width:183px" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();">										
												</td>
											</tr>
											
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>City Code</label>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtcityplacecode" id="txtcityplacecode" readonly="true" value="<?php echo $row->city_code; ?>" style="width:183px" onKeyUp="javascript:this.value=this.value.toUpperCase();">										
												</td>
											</tr>
											
											<tr>
												<td>
													&nbsp;
												</td>
												<td colspan="2" align="left">
													<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
													<label><div id="response"></div></label>
												</td>
											</tr>
																						
											<tr>
												<td></td>
												<td>
													<input type="submit" name="submit" id="submit" value="Update" />
													<input type="submit" name="submit1" id="submit1" value="Update and Close" class="submitbutton" />
													<input type="button" name="submit2" id="submit2" value="Discard" class="submitbutton" onClick="window.location.href='home.php'" />
													<input type="button" name="submit3" id="submit3" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
												</td>	
												<td></td>
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
<?php require_once('footer.php');	?>		
</body>
</html>
