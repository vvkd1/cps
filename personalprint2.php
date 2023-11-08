<?php 
require_once('global.php');
error_reporting(E_ALL ^ E_NOTICE);
$page_name = "upload_file";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","Y"))
	header("Location: ".SITE_ROOT."home.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/jquery.tablesorter.js"></script>
	<script type="text/javascript">
		var vRules = { uploadedfile: { required:true }};
		var vMessages = { uploadedfile: { required: "<br/>Please select file to upload." }};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading').hide();
			$('#submit1').button();		
			$('#frmuploadfile').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frmuploadfile').ajaxSubmit({
						target: '#response', 
						beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
							if(document.getElementById("hiddtotaluploaddata").value != "0"){
								$('.loading').hide();
								return confirm('There are pending cheques to be printed. Are you sure you want to continue?');
							}
						}, 
						clearForm: false,
						success: function (resObj) {
						var	response = resObj.split('#');
							if (response[0]=='0') {
								$('.loading').hide();					
								$('#response').html('<div class="errormsg_boundary">'+response[1]+'<div>').show();
							} else {	
								$('#response').html('');
								$('#uploaded_files').html(resObj);
								$('.loading').hide();
								//window.location = '<?php echo $_SERVER['PHP_SELF']; ?>';								
							}
						}
					});
				}
			});
		});
		
		//function totaldatatoupload(){
			//if(document.getElementById("hiddtotaluploaddata").value != "0"){
				//return confirm('There are pending cheques to be printed. Are you sure you want to continue?');
			//}
		//}
		
	</script>
	
<script type="text/javascript">
var selected_ids_array = [];
$(document).ready(function(){		

	$( "#dialog-confirm" ).dialog({
			autoOpen: false,			
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
					return false;
				},
				Ok: function() {
					//window.location = 'confirmprintreq.php?do=print&pid='+selected_ids_array;
					window.location = 'personalprint2_post.php?do=print&pid='+selected_ids_array;		
				}
				
			}
	});
	
	$( "#confirm-delete" ).dialog({
			autoOpen: false,			
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
					return false;
				},
				Ok: function() {
					window.location = 'personalprint2_post.php?do=delete&pid='+selected_ids_array;		
				}
			}
	});
		
	MarkAll = function(){
		selected_ids_array.length = 0;
	  $('#categorytable').find(':checkbox').attr('checked', true);
	  $(':checkbox:checked').each(function(i){		  
		  selected_ids_array.push($(this).attr("id"));
	  });
	};
	
	
	Unmark_all = function(){
		$('#categorytable').find(':checkbox').attr('checked', false);	  
	  selected_ids_array.length = 0;	  
	};
	
	Print_selected = function(){
		if(selected_ids_array.length <= 0 ) {
			$( "#dialog" ).dialog( "open" );
			return false;
		}
		$( "#dialog-confirm" ).dialog( "open" );		
	};
	
	Delete_selected = function(){
		if(selected_ids_array.length <= 0 ) {
			$( "#dialog" ).dialog( "open" );
			return false;
		}
		$( "#confirm-delete" ).dialog( "open" );		
	};
	
	$(".class_chkbox").live("click", function(){
		if($(this).attr('checked')) {
			selected_ids_array.push($(this).attr("id"));					
		  } else {			 
			  removeByValue(selected_ids_array, $(this).attr("id"));
		  }
	});
	
});
	
	

function removeByValue(arr, val) {
	for(var i=0; i<arr.length; i++) {
		if(arr[i] == val) {
			arr.splice(i, 1);
			break;
		}
	}	
}


function showAccType(str)
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
				document.getElementById("divAccTypeList").innerHTML="";
				document.getElementById("divAccTypeList").innerHTML=xmlhttp.responseText;
				document.getElementById("divloadingdivAccTypeList").style.display="none";
			}
			else
			{
				document.getElementById("divloadingdivAccTypeList").style.display="block";
			}
		}
		xmlhttp.open("GET","personalprint2_post.php?branchid="+str,true);
		xmlhttp.send();
	}
	
	function showBookSize(str)
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
				document.getElementById("divBookSize").innerHTML="";				
				document.getElementById("divBookSize").innerHTML=xmlhttp.responseText;				
				document.getElementById("divloadingdivBookSize").style.display="none";
			}
			else
			{
				document.getElementById("divloadingdivBookSize").style.display="block";
			}
		}
		var branchid = document.getElementById("ddlBranchName").value;
		xmlhttp.open("GET","personalprint2_post.php?branchBookSize="+branchid+"&accType="+str,true);
		xmlhttp.send();
	}


</script>
</head>

<body>
 
<?php require_once('header.php');
$countnumber = 0;
if($totaldatainupload = $db->get_row("SELECT count(*) as total FROM tb_uploadingdata where cps_unique_req = 0") ){
$countnumber = $totaldatainupload->total;
}
//$countpendingrequest = 0;
//if($totaldatainupload = $db->get_row("SELECT count(*) as total FROM tb_pending_print_req where ") ){
//$countpendingrequest = $totaldatainupload->total;
//}
?>
                <div id="formdiv">
                	<div id="formheading">Upload File</div>
                    <div id="formfields">                  
						<table width="100%" border="0" cellspacing="0" cellpadding="0">					  
							<tr>
								<td>
									&nbsp;
								</td>
							</tr>
							
							<tr>
								<td width="100%" height="60px" align="left" valign="middle">
									<form id="frmsearch" name="frmsearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
										<div class="searchdiv" style="width:100%">
											<div style="float:left"><label>Select Branch - </label>
												<select name="ddlBranchName" id="ddlBranchName" style="width:130px; height:26px;" onchange="showAccType(this.value)">
													<option value="">== Select ==</option>
													<?php 
														$rowgetbranch =  $db->get_results("SELECT distinct(b.branch_code),b.branch_id, b.branch_name FROM tb_branchdetails b INNER JOIN tb_uploadingdata u ON b.branch_code = u.cps_branchmicr_code where u.cps_unique_req in (0)");
														foreach($rowgetbranch as $eachbranch){
													?>
														<option value="<?php echo $eachbranch->branch_code; ?>"><?php echo $eachbranch->branch_name; ?></option>
													<?php 
														} 
													?>
												</select>								
											</div>
											
											<div id ="divloadingdivAccTypeList" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>							
											
											<div id="divAccTypeList" style="float:left">
												<div style="float:left"><label>&nbsp;&nbsp;&nbsp; Account Type -</label>
													<select name="ddlAccountType" id="ddlAccountType" style="width:130px; height:26px;" onchange="showBookSize(this.value)">
														<option value="">== Select ==</option>
														
													</select>								
												</div>
											</div>
											
											<div id ="divloadingdivBookSize" style="display:none;float:left"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" />&nbsp;</div>							
											
											<div id="divBookSize" style="float:left">
												<div style="float:left; padding-right:15px"><label>&nbsp;&nbsp;&nbsp; Book Size -</label>
													<select name="ddlbooksize" id="ddlbooksize" style="width:130px; height:26px;">
														<option value="">== Select ==</option>
														
													</select>	
												</div>
												
											</div>
											<div style="float:left; padding-left:15px">
												<input type="submit" name="search" id="search" value="Search" />
												
											</div>
											<div style="float:left; padding-left:15px">
												
												<a href="uploadfile.php"><img src="images/refresh.png" alt="Refresh"></a>
											</div>
																								
										</div>														
									</form>															
								</td>
							</tr>
							
							<tr>
								<td align="left" valign="top">
									<div id='uploaded_files' style="width:1000px; overflow-x:scroll;overflow-y:hidden ;margin:0px; padding:0px;">
										<?php 
											if(isset($_REQUEST['ddlbooksize']) && isset($_REQUEST['ddlAccountType']) && isset($_REQUEST['ddlBranchName'])){
							
							$i = 0;
							$searchString = "";
							
							if(!empty($_REQUEST['ddlbooksize']))
							{
								if($i == 0){
									$searchString .= " and cps_book_size = '".$_REQUEST['ddlbooksize']."' ";
									}
								else{
									$searchString .= " and cps_book_size = '".$_REQUEST['ddlbooksize']."' ";
								}
							}
							if(!empty($_REQUEST['ddlAccountType']))
							{
								if($i == 0){
									$searchString .= " and cps_tr_code = '".$_REQUEST['ddlAccountType']."' ";
									}
								else{
									$searchString .= " and cps_tr_code = '".$_REQUEST['ddlAccountType']."' ";
									} 
							}
							if(!empty($_REQUEST['ddlBranchName']))
							{
								if($i == 0){
									$searchString .= " and cps_branchmicr_code = '".$_REQUEST['ddlBranchName']."' ";
									}
								else{
									$searchString .= " and cps_branchmicr_code = '".$_REQUEST['ddlBranchName']."' ";
									}
							}
											
										?>
										<?php 												
											if($result = $db->get_results("SELECT * FROM tb_uploadingdata where cps_unique_req = 0 $searchString")){
													
										?>
											<table cellpadding="0" cellspacing="0" border="0" width="3000" id="categorytable">
												<tr>
													<th style="background-color: #EDEDED; width:15px"></th>
													<th class="thwidthth">Unique Request No1</th>
													<th class="thwidthth">Micr Code</th>
													<th class="thwidthth">Branch Code</th>
													<th class="thwidthth">Account No</th>
													<th class="thwidthth">Customer Name</th>
													<th class="thwidthth">Book Size</th>
													<th class="thwidthth">Tr Code</th>
													<th class="thwidthth">At Par</th>
													<th class="thwidthth">Chk No. From</th>		
													<th class="thwidthth">Chk No. To</th>		
													<th class="thwidthth">Address 1</th>
													<th class="thwidthth">Address 2</th>
													<th class="thwidthth">Address 3</th>
													<th class="thwidthth">Address 4</th>
													<th class="thwidthth">Address 5</th>
													<th class="thwidthth">City</th>																			
													<th class="thwidthth">PIN</th>						
													<th class="thwidthth">Mobile</th>
												</tr>
												<?php foreach($result as $row) {?>
												<tr>
													<td><input type='checkbox' name='action[]' id="<?php echo $row->id; ?>" class='class_chkbox'  /></td>
													<td class='thwidthtd'><?php echo $row->cps_unique_req; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_micr_code; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_branchmicr_code; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_account_no; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_act_name; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_book_size; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_tr_code; ?></td>
													<td class='thwidthtd'><?php if($row->cps_atpar == 0){ echo "N"; }else{ echo "";} ?></td>
													<td class='thwidthtd'><?php echo $row->cps_chq_no_from; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_chq_no_to; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_act_address1; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_act_address2; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_act_address3; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_act_address4; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_act_address5; ?></td>
													<td class='thwidthtd'><?php echo $row->cps_act_city; ?></td>																			
													<td class='thwidthtd'><?php echo $row->cps_act_pin; ?></td>						
													<td class='thwidthtd'><?php echo $row->cps_act_mobile; ?></td>
												</tr>
												<?php }?>
												<tr>
													<td colspan="24" valign="middle" class="thwidthth" style="text-align:left; padding-left:10px">
														<a id="mark_all" style="margin-right:20px;" class="pointer"  onclick="MarkAll();" >Select all</a>
														<a id="unmark_all" style="margin-right:20px;" class="pointer"  onclick="Unmark_all();">Deselect all</a>
														<a id="print_selected" style="margin-right:20px;" class="pointer" onclick="Print_selected();">Print Selected</a>
														<a id="delete_selected" style="margin-right:20px;" class="pointer" onclick="Delete_selected();">Delete Selected</a>
													</td>
												</tr>
												<tr>
													<td style="height:30px;">&nbsp;</td>
												</tr>
											</table>
										<?php 
											}
											}
											else
											{
												include_once 'personalprint2_post.php';
											}
																
										?>
									</div>
									<div class="clearboth"></div>
									<div id="dialog-confirm" title="Confirmation">
										<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>The selected records will proceed for print.<br/>Are you sure?</p>
									</div>
									<div id="confirm-delete" title="Confirmation">
										<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure? you want to delete selected records.</p>
									</div>
									
									<input type="hidden" value="<?php echo $countnumber; ?>" id="hiddtotaluploaddata" />
								</td>
							</tr>
						</table>                     
                    </div>
                </div>
				</div>
				</div>
				</div>
				<?php require_once('footer.php');	?> 
            
</body>
</html>
