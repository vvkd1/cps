<?php  
require_once('global.php');
require_once ('classes/paginator.class.php');
$page_name = "Suburb_master";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","Y"))
	header("Location: ".SITE_ROOT."home.php");

if(isset($_REQUEST['searchterm']) && !empty($_REQUEST['searchterm']) ) {
	$sql = "select suburb_id, suburb_name,suburb_postal_code,suburb_code,is_delete from tb_suburbmaster where suburb_name like '%".GetSQLValueString($_REQUEST['searchterm'],"text")."%' or suburb_postal_code like '%".GetSQLValueString($_REQUEST['searchterm'],"text")."%'";
	$sql .= " order by suburb_name";
} else {
	$sql = "select suburb_id, suburb_name,suburb_postal_code,suburb_code,is_delete from tb_suburbmaster";
	$sql .= " order by suburb_name";
}

$res_sql = $db->get_results($sql);
$pages = new Paginator;
$pages->items_total = count($res_sql);
$pages->mid_range = 7;
$pages->limit = 25;
$pages->default_ipp = 25;
$pages->paginate();
$sql_with_paging = $sql ." $pages->limit ";
$i = ($pages->current_page  - 1)  * $pages->items_per_page ;
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
var selected_ids_array = [];
var vRules = { searchterm: { required:true }};
var vMessages = { searchterm: {required: "<p>Please enter serarch criteria</p>" }};
$(document).ready(function(){		
		
	$('#frmsearch').validate({
		rules: vRules,
		messages: vMessages,				
	});	
		
	$("#search").button();
	var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
	$(".remove").click(function(){ 
		var tdid = $(this).attr("id");
		$( "#dialog-remove" ).dialog({
				modal: true,
				buttons: {
					Cancel: function() {
						$( this ).dialog( "close" );
						return false;
					},
					Ok: function() {
						$.ajax({type: "POST", url: "post_suburb.php", dataType: 'json', data: "do=delsub&suid="+tdid,
							success: function(resObj, statusText) {
								if(resObj.status) {							
									$( this ).dialog( "close" );
									window.location = '<?php echo $_SERVER['REQUEST_URI']; ?>';				
								} else {
									$( this ).dialog( "close" );
									return false;
								}
							}
						});		
					}
					
				}
		});		
	});
	
	$(".activate").click(function(){ 
		var tdid = $(this).attr("id");
		$( "#dialog-activate" ).dialog({
				modal: true,
				buttons: {
					Cancel: function() {
						$( this ).dialog( "close" );
						return false;
					},
					Ok: function() {
						$.ajax({type: "POST", url: "post_suburb.php", dataType: 'json', data: "do=activate&suid="+tdid,
							success: function(resObj, statusText) {
								if(resObj.status) {							
									$( this ).dialog( "close" );
									window.location = '<?php echo $_SERVER['REQUEST_URI']; ?>';				
								} else {
									$( this ).dialog( "close" );
									return false;
								}
							}
						});		
					}
					
				}
		});		
	});
	
	$( "#dialog-confirm" ).dialog({
	
			autoOpen: false,			
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
					return false;
				},
				Ok: function() {					
					$.ajax({type: "POST", url: "post_suburb.php", dataType: 'json', data: "do=delsub&suid="+selected_ids_array,
						success: function(resObj, statusText) {
							if(resObj.status) {							
								window.location = '<?php echo $_SERVER['REQUEST_URI']; ?>';					
							} else {
								$( this ).dialog( "close" );
								return false;
							}
						}
					});	
				}
			}
	});
	
	$( "#dialog" ).dialog({
			autoOpen: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
	});
	
	$('#mark_all').click(function () {
	  selected_ids_array.length = 0;
	  $('#categorytable').find(':checkbox').attr('checked', true);
	  $(':checkbox:checked').each(function(i){		  
		  selected_ids_array.push($(this).attr("id"));
	  });		
	});
	$('#unmark_all').click(function () {
	  $('#categorytable').find(':checkbox').attr('checked', false);	  
	  selected_ids_array.length = 0;	  
	});
	
	$("#remove_selected").click(function(){ 
		if(selected_ids_array.length <= 0 ) {
			//alert("Please select atleast one record.");
			$( "#dialog" ).dialog( "open" );
			return false;
		}
		$( "#dialog-confirm" ).dialog( "open" );		
	});
	
	$("#approve_selected").click(function(){ 
		if(selected_ids_array.length <= 0 ) {
			//alert("Please select atleast one record.");
			$( "#dialog" ).dialog( "open" );
			return false;
		}
		$( "#dialog-Inactive" ).dialog( "open" );		
	});
	$(":checkbox").click(function(){ 		  
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
	
	</script>
</head>

<body>

<?php require_once('header.php');	?>
                <div id="formdiv">
					<div id="formheading">Suburb Master</div>
					<div id="formfields">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
								<tr>
									<td align="left" valign="top" style="padding-left:16px; padding-top:16px; padding-bottom:16px">												
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="100%" height="60px" align="left" valign="middle">
													<form id="frmsearch" name="frmsearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
														<div class="searchdiv">
															<div style="float:left"><label>Search :</label>
																<input id="searchterm" name="searchterm" class="formelement" type="text" />
															</div>
															<div style="float:left">
																&nbsp;&nbsp;&nbsp;<input type="submit" name="search" id="search" value="Search" />
															</div>
															<div style="float:left">
																<a href="manage_suburb.php"><img src="images/refresh.png" alt="Refresh"></a>
															</div>
															<div style="float:right">	
																	<?php if(authentication_groups_pemissions($page_name,"","Y","Y","")):?>															
																		<a href="add_suburb.php" class="formtitlehead" style="text-decoration:underline">Add New Suburb</a>&nbsp;															
																	<?php endif;?>	
															</div>															
														</div>														
													</form>														
												</td>
											</tr>
																						
											<tr>
												<td  width="100%" align="left">
													<table width="100%" border="0" cellspacing="0" cellpadding="0" id="categorytable">
														<thead>
															<tr class="formtitlehead" style="background-color:#E6E6E6">
																<th width="2%" style="height:40px" align="left">&nbsp;</th>
																<th width="5%" align="left">No.</th>
																<th width="20%" align="left">Suburb</th>
																<th width="20%" align="left">Postal Code</th>
																<th width="15%" align="left">Suburb Code</th>
																<th width="10%" align="left">Status</th>
																<th width="5%" align="left">Edit/Delete</th>															
															</tr>
														</thead>
														<tbody>
															  <?php if($res_cat = $db->get_results($sql_with_paging)) {
																		foreach($res_cat as $row) {					
																			
																			//$total_names = $db->get_var("select count(city_id) tb_citymaster");
																			//$total_names = ($total_names <= 0 ) ? 0 : $total_names;
															  ?>
																<tr class="alternate" id="row_<?php echo $row->suburb_id; ?>" style="border-bottom:1px solid #ccc">
																    <td style="border-bottom:1px solid #ccc; height:40px" align="left" valign="middle"><!--<input type="checkbox" name="action[]" id="<?php echo $row->suburb_id; ?>" />--></td> 
																    <td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle"><?php echo ++$i; ?></td>
																    <td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle"><?php echo stripslashes($row->suburb_name); ?></td>
																    <td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle"><?php echo stripslashes($row->suburb_postal_code); ?></td>
																	<td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle"><?php echo stripslashes($row->suburb_code); ?></td>
																	<td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle">
																		<label>
																			<?php if($row->is_delete ==  "1"): ?>
																				<span class="deactivateD">D</span>&nbsp;&nbsp;
																				<?php if(authentication_groups_pemissions($page_name,"","Y","","Y")):?>
																				<span id="<?php echo $row->suburb_id; ?>" class="activate" ><label class="activatelink">Activate</label></span>
																				<?php endif;?>
																			<?php else: ?>
																				<div class="activateA">A</div>
																			<?php endif; ?>
																		</label>
																	</td>
																	<td style="border-bottom:1px solid #ccc" align="center" valign="middle">          
																	<?php if(authentication_groups_pemissions($page_name,"","Y","","Y")):?>
																		<a href="<?php echo ADMIN_ROOT; ?>edit_suburb.php?do=edit&suid=<?php echo $row->suburb_id; ?>"><img src="<?php echo ADMIN_IMAGES; ?>icon_edit.png" title="Edit" border="0" /></a>
																		<img id="<?php echo $row->suburb_id; ?>" src="<?php echo ADMIN_IMAGES; ?>icon_delete.png" width="20" height="19" border="0" class="remove pointer" title="Remove" />          
																	<?php endif;?>	
																	</td>
																</tr>
																
																<?php } } else {?> 
																	<tr>
																	  <td colspan="5" class="formtitle">Suburb not added.</td>
																	</tr>
																<?php } ?>
																<!--<tr>
																    <td colspan="5" valign="middle" style="height:50px">
																		<a id="mark_all" style="margin-right:20px;" class="formtitlehead">Select all</a>
																		<a id="unmark_all" style="margin-right:20px;" class="formtitlehead">Deselect all</a>
																		<a id="remove_selected" style="margin-right:20px;" class="formtitlehead">Delete Selected</a>
																    </td>
																    <td>&nbsp;</td>
																</tr>-->    
														</tbody></table>
												</td>
											</tr>
											
											<tr>
												<td width="100%" colspan="10">
													<div id="divpaging">
														<div id="pager1" class="paging">
														  <?php
																	echo $pages->display_pages(); 
																	echo $pages->display_jump_menu(); 
																	echo $pages->display_items_per_page(); 
														  ?>    
														</div>
													</div>
													<div class="clearboth"></div>
													<div id="dialog-confirm" title="Confirmation">
														<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will delete the suburbs.<br/>Are you sure?</p>
													</div>
													<div id="dialog" title="Warning">
														<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Please select atleast one record.</p>
													</div>
													<div id="dialog-remove" title="Remove Confirmation" style="display:none;">
														<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will deactivate the suburbs.<br/>Are you sure?</p>
													</div>
													<div id="dialog-activate" title="Remove Confirmation" style="display:none;">
														<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?<br/>Do you want to activate.</p>
													</div>
												</td>
											</tr>
											<tr>
												<td width="100%" colspan="10">
												<input type="button" name="submit3" id="submit3" value="Go to home" class="submitbutton" onClick="window.location.href='home.php'" />
												</td>
											</tr>

										</table>
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
