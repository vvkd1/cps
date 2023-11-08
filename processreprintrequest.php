<?php 
require_once('global.php');
authentication_print();
if($_SESSION["user_type"]!=1)
	header("Location: ".SITE_ROOT."login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php include('includes.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#search, #button").button();
	$('#from_date, #to_date').datepicker({changeMonth: true, changeYear: true, showButtonPanel: false, yearRange:'-70:Y', maxDate: 'D', dateFormat: 'dd-mm-yy' });	
});
</script>
	<script type="text/javascript">
		
		var vRules = { uploadedfile: { required:true }};
		var vMessages = { uploadedfile: { required: "<br/>Please select file to upload." }};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading,#successful').hide();
			$('#submit1').button();		
			$('#frmreprint').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function(form) {
					$('#frmreprint').ajaxSubmit({
						target: '#response', 
						beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
						}, 
						clearForm: false,
						success: function (resObj) {
							response = resObj.split('#');
							if (response[0]=='0') {
								$('.loading').hide();					
								$('#response').html('<div class="errormsg_boundary">'+response[1]+'<div>').show();
							} else {	
								$('#response').html('');
								$('#uploaded_files').html(resObj);
								$('.loading').hide();
								
							}
						}
					});
				}
			});
		});
		
	</script>
	
<script type="text/javascript">
var selected_ids_array = [];
$(document).ready(function(){		
	
 	
	/********************/
	
	$( "#dialog-confirm" ).dialog({
            autoOpen: false,            
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                    return false;
                },
                Ok: function() {   
					$.ajax({type: "POST", url: "post_processreprintrequest.php", dataType: 'json', data: "do=reprint&ids="+selected_ids_array,
                        success: function(resObj, statusText) {
							if(resObj.status) {                            
								window.location = 'reprintcheque.php'
								$( this ).dialog( "close" );								
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
	
	
	MarkAll = function(){
		selected_ids_array.length = 0;
	  //$('#categorytable').find(':checkbox').attr('checked', true);
	  $('#categorytable :checkbox.tabrow').attr('checked', true);
	  $(':checkbox.tabrow:checked').each(function(i){		  
		  selected_ids_array.push($(this).attr("id"));
	  });
	};
	
	
	Unmark_all = function(){
		//$('#categorytable').find(':checkbox').attr('checked', false);	  
		 $('#categorytable :checkbox.tabrow').attr('checked', false);	  
	  selected_ids_array.length = 0;	  
	};
	
	Print_selected = function(){
		if(selected_ids_array.length <= 0 ) {
			$( "#dialog" ).dialog( "open" );
			return false;
		}
		$( "#dialog-confirm" ).dialog( "open" );		
	};

	Print_requisition = function(){
		if(selected_ids_array.length <= 0 ) {
			$( "#dialog" ).dialog( "open" );
			return false;
		}
		$( "#dialog-confirm-requisition" ).dialog( "open" );		
	};


//bhavin start
var selective_pages_no = [];
var page_nos = "";
var flag = true;
	Print_selective_pages = function(){
		if(selected_ids_array.length <= 0 ) {
			$( "#dialog" ).dialog( "open" );
			return false;
		}
		page_nos = prompt("Please enter page number comma separated", "e.g. 1,3,4");
		if (page_nos != null) {
			
			splitString = page_nos.split(',');
			for(i=0; i<splitString.length; i++){
				var selective_value = $.trim(splitString[i]);		
				selective_pages_no.push(selective_value);
			}
				$( "#dialog-confirm-selective").dialog( "open");
		}	
	};
	$( "#dialog-confirm-requisition").dialog({
            autoOpen: false,            
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                    return false;
                },
                Ok: function() {   
					$.ajax({type: "POST", url: "post_processreprintrequest.php", dataType: 'json', data: "do=reprint&ids="+selected_ids_array,
                        success: function(resObj, statusText) {
							if(resObj.status) {
									window.location = 'reprintcheque.php?requisitiononly=1'
								$( this ).dialog( "close" );								
                            } else {
                                $( this ).dialog( "close" );
                                return false;
                            }
                        }
                    });    
                }         
            }
    });
	
	$( "#dialog-confirm-selective").dialog({
            autoOpen: false,            
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                    return false;
                },
                Ok: function() {
					$.ajax({type: "POST", url: "post_processreprintrequest.php", dataType: 'json', data: "do=reprint&ids="+selected_ids_array,
                        success: function(resObj, statusText) {
							if(resObj.status) {
								if($('#print_requisition').attr('checked'))
									window.location = 'reprintcheque.php?selective_pages_no='+selective_pages_no+'&requisition=1';
								else
									window.location = 'reprintcheque.php?selective_pages_no='+selective_pages_no;
								$( this ).dialog( "close" );								
                            } else {
                                $( this ).dialog( "close" );
                                return false;
                            }
                        }
                    });    
                }         
            }
    });

	//pravin start 19/2/2015
	$( "#confirm-delete" ).dialog({
			autoOpen: false,			
			modal: true,
			buttons: {
				Cancel: function() {
					$( this ).dialog( "close" );
					return false;
				},
				Ok: function() {
					$.ajax({type: "POST", url: "post_processreprintrequest.php", dataType: 'json', data: "do=delete&ids="+selected_ids_array,
                        success: function(resObj, statusText) {
							if(resObj.status) {                            
								window.location = 'processreprintrequest.php';
								$( this ).dialog( "close" );								
                            } else {
                                $( this ).dialog( "close" );
                                return false;
                            }
                        }
                    });		
				}
			}
	});
	
	Delete_selected = function(){
		if(selected_ids_array.length <= 0 ) {
			$( "#dialog" ).dialog( "open" );
			return false;
		}
		$( "#confirm-delete" ).dialog( "open" );		
	};
	//pravin end
		
//bhavin end	
	 
	//$(":checkbox").click(function(){
	$('#categorytable :checkbox.tabrow').click(function(){
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

<?php require_once('header.php'); ?>

<div id="formdiv">
	<div id="formheading">Process Reprint Request
		<?php
                				$rowToner=checkTonerCapacity();
                			if($rowToner){
                				 if(!$rowToner['status']){
                				 	echo '<label style="color:red;float: right;font-size: 14px;background-color: yellow;">Toner can print <b>'.$rowToner['count'].'<b> leaves. Please replace your toner.</label>';
                				 }else{
                				 	echo '<label style="float: right;font-size: 14px; color:blue;">Toner can print <b>'.$rowToner['count'].'<b> leaves.</label>';
                				 }
                			}

                			?>
	</div>
	<div id="formfields">
		<form id="frmreprint" name="frmreprint" enctype="multipart/form-data" action="post_processreprintrequest.php" method="POST">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<?php if($result = $db->get_results("select * from tb_cps_reprintque WHERE cps_reprint_approved = 0")): ?>
			<tr>
			<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
				
				<div id='uploaded_files' style="width:1000px; overflow-x:scroll;overflow-y:hidden ;margin:0px; padding:0px;">
				<table cellpadding="0" cellspacing="0" border="0" width="6000" id="categorytable">
					<tr>
							<th style="background-color: #EDEDED; width:15px"></th>
							<th class="thwidthth">Unique Request No</th>
							<th class="thwidthth">Micr Code</th>							
							<th class="thwidthth">Account No</th>
							<th class="thwidthth">Customer Name</th>
							<th class="thwidthth">No Of Books</th>
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
							<th class="thwidthth">Mobile</th></tr>
					</tr>
					<?php foreach($result as $row) :?>
					<tr>
						<td><input type="checkbox" name='action[]' id="<?php echo $row->id;?>" class="tabrow"></td>
						<td class='thwidthtd'><?php echo $row->cps_unique_req; ?></td>
								<td class='thwidthtd'><?php echo $row->cps_micr_code; ?></td>								
								<td class='thwidthtd'><?php echo $row->cps_account_no; ?></td>
								<td class='thwidthtd'><?php echo $row->cps_act_name; ?></td>
								<td class='thwidthtd'><?php echo $row->cps_no_of_books; ?></td>
								<td class='thwidthtd'><?php echo $row->cps_book_size; ?></td>
								<td class='thwidthtd'><?php echo $row->cps_tr_code; ?></td>
								
								<?php if($row->cps_atpar == 0): ?>
										<td class='thwidthtd'>N</td>
								<?php else:?>
										<td class='thwidthtd'></td>
								<?php endif;?>
								
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
					<?php endforeach;?>
					<tr>
					<td colspan="44" valign="middle" class="thwidthth" style="text-align:left; padding-left:10px">
						<a id="mark_all" style="margin-right:20px;" class="pointer"  onclick="javascript:MarkAll();" >Select all</a>
						<a id="unmark_all" style="margin-right:20px;" class="pointer"  onclick="Unmark_all();">Deselect all</a>
						<a id="print_selected" style="margin-right:20px;" class="pointer" onclick="Print_selected();">Print Selected</a>
						<!-- bhavin -->
						<a id="print_selected" style="margin-right:20px;" class="pointer" onclick="Print_selective_pages();">Print Selective pages</a>
						<!-- Pravin-->
						<a id="delete_selected" style="margin-right:20px;" class="pointer" onclick="Delete_selected();">Delete Selected</a>
						<label for="print_requisition" style="margin-right:20px;" class="pointer"><input type="checkbox" id="print_requisition" style="margin-right:10px;" class="pointer" />Print Requisition Slip</label>
						<a id="print_requisitiononly" style="margin-right:20px;" class="pointer" onclick="Print_requisition();">Print Requisition Only</a>
					  </td>
					</tr>
					<tr>
					  <td style="height:30px;">&nbsp;</td>
					</tr>
					
					<tr>
						<td style="height:30px;">&nbsp;</td>
					</tr>
				</table>
				</div>
				
			</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<div id='uploaded_files' style="width:1000px; overflow-x:scroll;overflow-y:hidden ;margin:0px; padding:0px;">
					</div>
					<div class="clearboth"></div>
					<div id="dialog" title="Error">
					<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Please select rows!</p>
					</div>
					<div id="dialog-confirm" title="Confirmation">
					<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will put selected records in reprint request queue.<br/>Are you sure?</p>
					</div>
					<div id="dialog-confirm-requisition" title="Confirmation">
					<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will print only requisition slips of selected records.<br/>Are you sure?</p>
					</div>
					<!-- bhavin start -->
					<div id="dialog-confirm-selective" title="Confirmation">
					<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will put selected pages of the selected records in reprint request queue.<br/>Are you sure?</p>
					</div>
					<div id="confirm-delete" title="Confirmation">
						<p style="float:left;"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure? you want to delete selected records.</p>
					</div>
					<!-- bhavin end -->
					<div id="successful"></div>
				</td>
			</tr> 
			<?php else:?>
			<tr>
				<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
					<label>No Reprint Request Submitted.</label>
				</td>
			</tr>	
			<?php endif;?>
		</table>
	</form>

	</div>
</div>
</div>
</div>
</div>
<?php require_once('footer.php');?>       
</body>
</html>
