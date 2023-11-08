<?php
 	$css = array('jquery-ui-1.8.2.custom','jquery.multiselect','jquery.multiselect.filter');
	$js = array('jquery.form','jquery.validate','jquery.validate.extension', 'jquery.multiselect','jquery.multiselect.filter');
 	
	include_once "header.php";
	include_once 'core/Utility.php';
	$utility = new Utility();
	
	$editor_group = $db->CreateOptions('html', 'editorgroup', array('editorgroup_id','editorgroup_name'), null, array('editorgroup_name'=>'asc'));
	$editor_list = $db->CreateOptions('html', 'editor', array('editor_id','editor_email'), null, array('editor_email'=>'asc'));
?>

<script type="text/javascript">
$(document).attr('title', 'Mass Mail');
var vRules = {
	subject:{ required:true},
	message:{required:true}
};
var vMessages = {
	subject:{ required:'Please enter subject.'},
	message:{ required:'Please enter message.'}
};







function ClearForm(from){
	
	ClearFormAndErrors(from);
}

$(document).ready(function() {	

	$("#group").multiselect({
	      //noneSelectedText: 'Select car/boat manufacturers'
		
	    checkAll: function(){
	    	var str = "";
	  		$("#group option:selected").each(function () {
	  			str += $(this).val() + ",";
	  		});
	  		if(str) {
	  			//alert(str);
	  			$("#editors").load('control/mass_mailing.php', {'act': 'getuser', 'i_id':str}, function(){				
	  				$("#editors").multiselect('enable');
	  				$("#editors").multiselect('refresh');
	  			});
	  		} else {
	  			$("#editors").multiselect('disable');
	  		}
	    },
	    uncheckAll: function(){
	    	$("#editors").multiselect('disable');
	    }  
			
	}).multiselectfilter();

	$("#group").change(function () {
		var str = "";
		$("#group option:selected").each(function () {
			str += $(this).val() + ",";
		});
		if(str) {
			//alert(str);
			$("#editors").load('control/mass_mailing.php', {'act': 'getuser', 'i_id':str}, function(){				
				$("#editors").multiselect('enable');
				$("#editors").multiselect('refresh');
			});
		} else {
			$("#editors").multiselect('disable');
		}
		
	}).trigger('change');

	$("#editors").multiselect({}).multiselectfilter();


	//$('#group').multiselect({ selected: function(event, ui) { alert($(ui.option).val() + " has been selected"); } });

	//$('.selector').multiselect({ deselected: function(event, ui) { alert($(ui.option).val() + " has been deselected"); } });
	
	$('#user_form').validate({
		
		rules: vRules,
		messages: vMessages,
		submitHandler: function(form) {
			
			act = 'mail' ;
			$(form).ajaxSubmit({
				url: 'control/mass_mailing.php?act='+act,
				beforeSubmit: function (formData, jqForm, options) {						
					$('#user_form [type="submit"]').hide();
					$('#msg_wait').show();
				},
				dataType: 'json',
				clearForm: false,
				success: function (resObj, statusText) {
					$('#user_id').val('');
					$('#msg_wait').hide();
					if (resObj.success) {
						
						$.messager.show({
							title: 'Success',
							msg: "Email sent Successfully"
						});
						setTimeout(function(){location.reload();},2000);						
					} else {							
						$.messager.show({	// show error message
							title: 'Error',
							msg: resObj.msg
						});
					}
					$('#user_form [type="submit"]').show();
				},
				error: function(){
					$('#msg_wait').hide();
					$.messager.show({	// show error message
						title: 'Error',
						msg: "Some error occured"
					});
					
					$('#user_form [type="submit"]').show();
				}
			});
		}
	});

	
});

</script>
<div class="content-wrapper">
	<?php if(isset($_REQUEST["msg"])) { echo Core::DisplayMessage($_REQUEST["msg"],$_REQUEST["msg_status"]); } ?>
	<div class="content-header"><!--begin header-->
		<div class="content-header-logo fl"></div>
		<div class="content-header-title fl" id='section_head'></div>
		<div class="content-header-title fr" id='section_opt' ></div>
	</div>
	<div class="content-middle"><!--begin content-->
		<form method="post" id="user_form">
		<fieldset>
			<legend>Mass Mail</legend>
			
			
			<div class="form-column" style="width:400px;">
				<div class="form-row">
					<span> Select Group: &nbsp;</span>
					<select name="group[]" id="group" size="2" multiple style="width:275px;">
						<?php echo $editor_group; ?>
					</select>
					
					<label for="group" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				<div class="form-row">
					<span> Select Editors: &nbsp;</span>
					<select name="editors[]" id="editors" size="5" multiple style="width:275px;">
						<?php  echo $editor_list; ?>
					</select>
					<label for="editors" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				
			</div>
			
			<div class="form-column" style="width:540px;">
				<div class="form-row">
					<span> Subject: &nbsp;</span>
					<input type="text" name="subject" id="subject" maxlength="255"  value ="" style="width:400px"/>
					
					<label for="subject" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				<div class="form-row">
					<span> Message: &nbsp;</span>
					<textarea name="message" id="message" cols="60" rows="10" style="width:400px" ></textarea>
					<label for="message" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				
			</div>
		</fieldset>
		<div class="clr"></div>
		<div class="form-row-last">
			<div id="content-header-buttons">
				<div class="fl">
					<input type="submit" class="buttonbar" value="Send"/>
				</div>
				<div class="fl">
					<input type="button" title="Cancel" onClick="ClearForm('user_form')" class="buttonbar" value="Cancel">		
				</div>
				<div class="clr"></div>
			</div>
		</div>
	</form>
	</div>
</div>
<?php
include_once "footer.php";
?>