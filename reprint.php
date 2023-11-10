<?php 
require_once('global.php');
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
<script type="text/javascript">
	$(document).ready(function(){
		$("#search, #button").button();
		$('#from_date, #to_date').datepicker({changeMonth: true, changeYear: true, showButtonPanel: false, yearRange:'-70:Y', maxDate: 'D', dateFormat: 'dd-mm-yy' });	
	});

	function recuired(){
		if(document.getElementById("to_date").value == "" || document.getElementById("from_date").value == ""){
			document.getElementById("divmsg").innerHTML = 'Please select to and from date';
			return false;
		}else{
			document.getElementById("divmsg").innerHTML = '';
		}
	}
</script>
	<script type="text/javascript">
		
		var vRules; //= { from_date: { required:true }, to_date: { required:true } };
		var vMessages;// = { from_date: { required: "<br/>Please select from date." }, to_date: { required: "<br/>Please select to date." }};
		$(document).ready(function() {
			$('#response,#ajax_loading,.loading,#successful').hide();
			$('#submit1').button();		
			$('#frmreprint').validate({
				rules: vRules,
				messages: vMessages,
				//errorLabelContainer : $("#error_div"),
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
						$( this ).dialog( "close" );
						
						$.ajax({
							type: "POST",
							 url: "post_reprint.php",
							 dataType: 'json',
							data: "do=reprint&ids="+selected_ids_array,

							success: function(resObj, statusText) {
								if(resObj.status) {                            
									$('#successful').html('<div class="errormsg_boundary">You request is placed to admin.<div>').show();
									$( this ).dialog( "close" );								
								} else {
									$('#successful').html('<div class="errormsg_boundary">Duplicate record in reprint request.<div>').show();
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

	$(".class_chkbox").live("click", function(){
		
		if($(this).attr('checked')) {
			selected_ids_array.push($(this).attr("id"));					
		  } else {			 

			  removeByValue(selected_ids_array, $(this).attr("id"));
		  }
	});

	});
	
	/*checkbox_click = function(){ 		 
		  if($(this).attr('checked')) {
			selected_ids_array.push($(this).attr("id"));					
		  } else {			 
			  removeByValue(selected_ids_array, $(this).attr("id"));
		  }	 	
	};*/
	

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
	<div id="formheading">Reprint Cheques</div>
	<div id="formfields">
		<form id="frmreprint" name="frmreprint" enctype="multipart/form-data" action="post_reprint.php" method="POST">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
				<table width="800" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td align="left" valign="top">						    	
							<table>
								<tr>
									<td align="left" valign="top"><div id="response"></div></td>
								</tr>
								<tr>
								<td>
									<label>Select Date : </label><input type="text" id="from_date" name="from_date" />&nbsp;&nbsp; <label>To</label> &nbsp;&nbsp;
									<input type="text" id="to_date" name="to_date" /> 
								</td>
								<td>
									<input name="submit1" type="submit" id="submit1" value="Select Records" onClick="return recuired();" />
									<div class="loading"><img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
								</td>
								</tr>
								 <tr><td><div id="divmsg" class="red"><div></td></tr>
								<tr><td colspan="2" id="error_div"></td></tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
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
					<div id="successful"></div>
				</td>
			</tr> 
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
