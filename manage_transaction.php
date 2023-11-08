<?php  
require_once('global.php');
require_once ('classes/paginator.class.php');
$page_name = "transaction_master";
authentication_print();
if(!authentication_groups_pemissions($page_name,"","Y"))
	header("Location: ".SITE_ROOT."home.php");

$sql = "SELECT transactioncode_id,transactioncode,transactioncodedescription,transactionstatus FROM tb_cps_transactioncodes ";//transactionstatus

$res_sql = $db->get_results($sql);
$pages = new Paginator;
$pages->items_total = count($res_sql);
$pages->mid_range = 7;
$pages->limit = 10;
$pages->default_ipp = 10;
$pages->paginate();
$sql_with_paging = $sql ." $pages->limit ";
$i = ($pages->current_page  - 1)  * $pages->items_per_page ;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('includes.php'); ?>
<script type="text/javascript">
var selected_ids_array = [];
$(document).ready(function(){		
		
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
						$.ajax({type: "POST", url: "post_transaction.php", dataType: 'json', data: "do=del&tid="+tdid,
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
		$( "#dialog-active" ).dialog({
				modal: true,
				buttons: {
					Cancel: function() {
						$( this ).dialog( "close" );
						return false;
					},
					Ok: function() {
						$.ajax({type: "POST", url: "post_transaction.php", dataType: 'json', data: "do=activate&tid="+tdid,
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
					$.ajax({type: "POST", url: "post_transaction.php", dataType: 'json', data: "do=del&tid="+selected_ids_array,
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
});
	
	</script>
</head>

<body>

<?php require_once('header.php');	?>
<div id="formdiv">
<div id="formheading">Transaction Code Master</div>
	<div id="formfields">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
			<tr>
				<td align="left" valign="top" style="padding-left:16px; padding-top:16px; padding-bottom:16px">												
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="100%" height="40px" align="left" valign="middle">
								<form id="frmsearch" name="frmsearch" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
									
									<div style="float:right">
										<?php if(authentication_groups_pemissions($page_name,"","Y","Y","")):?>															
										<a href="add_transaction.php" class="formtitlehead" style="text-decoration:underline">Add New Transaction Code</a>
										<?php endif;?>	
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
											<th width="10%" align="left">No.</th>
											<th width="20%" align="left">Code</th>          
											<th width="30%" align="left">Description</th>
											<th width="15%" align="left">Status</th>
											<th align="center">Edit / Delete</th>																
										</tr>
									</thead>
									<tbody>
										<?php 
										if($res_cat = $db->get_results($sql_with_paging)):?>
										<?php foreach($res_cat as $row): ?>
											<tr class="alternate" id="row_<?php echo $row->transactioncode_id; ?>" style="border-bottom:1px solid #ccc">
												<td style="border-bottom:1px solid #ccc; height:40px" align="left" valign="middle"></td> 
												<td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle"><?php echo ++$i; ?></td>
												<td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle"><?php echo stripslashes($row->transactioncode); ?></td>
												<td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle"><?php echo stripslashes($row->transactioncodedescription); ?></td> 
												<td style="border-bottom:1px solid #ccc" align="left" valign="middle" class="formtitle">
													<label>
														<?php if($row->transactionstatus ==  "1"): ?>
															<span class="deactivateD">D</span>&nbsp;&nbsp;
															<?php if(authentication_groups_pemissions($page_name,"","Y","","Y")):?>
																<span id="<?php echo $row->transactioncode_id; ?>" class="activate" ><label>Activate</label></span>
															<?php endif;?>
														<?php else: ?>
															<div class="activateA">A</div>
														<?php endif; ?>
													</label>
												</td>
												<td style="border-bottom:1px solid #ccc" align="center" valign="middle">   
													<?php if(stripslashes($row->transactioncodedescription) != 'PAY ORDER FOR RBI TESTING'):?>
													<a href="<?php echo ADMIN_ROOT; ?>edit_transaction.php?do=edit&tid=<?php echo $row->transactioncode_id; ?>"><img src="<?php echo ADMIN_IMAGES; ?>icon_edit.png" title="Edit" border="0" /></a>																		          
													<img id="<?php echo $row->transactioncode_id; ?>" src="<?php echo ADMIN_IMAGES; ?>icon_delete.png" width="20" height="19" border="0" class="remove pointer" title="Remove" />          
													<?php endif; ?>
												</td>
											</tr>

										<?php endforeach; ?>	
										<?php else: ?> 
											<tr>
												<td colspan="5" class="formtitle">No Transaction Code Found.</td>
											</tr>
										<?php endif; ?>

									</tbody>
								</table>
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
								<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will delete the Assignment(s).<br/>Are you sure?</p>
								</div>
								<div id="dialog" title="Warning">
								<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Please select atleast one record.</p>
								</div>
								<div id="dialog-remove" title="Remove Confirmation" style="display:none;">
									<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will deactivate the TR code.<br/>Are you sure?</p>
								</div>
								<div id="dialog-active" title="Remove Confirmation" style="display:none;">
									<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will activate the TR code.<br/>Are you sure?</p>
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
