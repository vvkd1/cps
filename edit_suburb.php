<?php  require_once('global.php');
$page_name = "Suburb_master";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","","","Y"))
	header("Location: ".SITE_ROOT."home.php");		

if(isset($_REQUEST['suid']) && !empty($_REQUEST['suid'])){
$row = $db->get_row("Select * from tb_suburbmaster where suburb_id=".$_REQUEST['suid']."");	

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
		var vRules = { txtpostalcode: { required:true }, ddlcountry: { required:true }, ddlstate: { required:true },ddlcity: { required:true }, txtsuburb: { required:true }};
		var vMessages = { txtpostalcode: {required: "<br/>Please enter city place" },ddlcountry: {required: "<br/>Please select country" },ddlstate: {required: "<br/>Please select state" },ddlcity: {required: "<br/>Please select city" },txtsuburb: {required: "<br/>Please enter suburb" }};
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
								alert('Udated Sucessfully');
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
		function showStates(str)
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
					
					document.getElementById("divstatelist").innerHTML="";
					document.getElementById("divstatelist").innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","post_suburb.php?contid="+str,true);
			xmlhttp.send();
		}
		function showCity(str)
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
					
					document.getElementById("divcitylist").innerHTML="";
					document.getElementById("divcitylist").innerHTML=xmlhttp.responseText;
					
				}
			}
			xmlhttp.open("GET","post_suburb.php?stateid="+str,true);
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
					<div id="formheading">Edit Suburb</div>
					<div id="formfields">
						<form name="addcountry" id="addcountry" action="post_suburb.php?do=edit&suid=<?php echo $_REQUEST['suid'] ?>" method="post">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
								<tr>
									<td align="left" valign="top" style="padding-left:16px; padding-top:16px; padding-bottom:16px">												
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>Select Country</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<label>
														<select name="ddlcountry" id="ddlcountry" style="width:190px; height:26px;" onchange="showStates(this.value)">
														<option value=""> Select Country</option>
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
													<label>Select State</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<label>
														<div id="divstatelist">
															<select name="ddlstate" id="ddlstate" style="width:190px; height:26px;" onchange="showCity(this.value)">
															<option value=""> Select State</option>
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
													<label>Select City</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<label>
														<div id="divcitylist">
															<select name="ddlcity" id="ddlcity" style="width:190px; height:26px;">
															<option value=""> Select City </option>
															<?php 
																$rowgetcity =  $db->get_results("select * from tb_citymaster where state_id = ".$row->state_id."");
																foreach($rowgetcity as $eachcity){
															?>
															<option value="<?php echo $eachcity->city_id; ?>" <?php if(stripslashes($eachcity->city_id)== $row->city_id){echo "Selected";} ?>><?php echo $eachcity->city_place; ?></option>
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
													<label>Enter Suburb</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtsuburb" id="txtsuburb" value="<?php echo $row->suburb_name ?>" style="width:183px" onKeyPress = "return isNumberKey1(event);" onKeyUp="javascript:this.value=this.value.toUpperCase();">										
												</td>
											</tr>
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>Enter Postal Code</label><span class="red">*</span>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtpostalcode" id="txtpostalcode" value="<?php echo $row->suburb_postal_code ?>" onKeyPress = "return isNumberKey(event);" style="width:183px">										
												</td>
											</tr>		
											
											<tr>
												<td width="15%" height="35" align="left" valign="top">
													<label>suburb Code</label>
												</td>
												<td width="85%" align="left" valign="top">
													<input type="text" name="txtsuburbcode" id="txtsuburbcode" readonly="true" value="<?php echo $row->suburb_code ?>" style="width:183px">										
												</td>
											</tr>
											
											<tr>
												<td>
													
												</td>
												<td  colspan="2" align="left">
													<div class="loading"><img src="<?php echo ROOT_IMAGES; ?>ajax-loader.gif" /></div>
													<div id="response"></div>
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
