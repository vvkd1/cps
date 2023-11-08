<?php
 	$css = array('jquery-ui-1.8.2.custom');
	$js = array('jquery.form','jquery.validate','jquery.validate.extension');
 	
	include_once "header.php";
	include_once 'core/Utility.php';
	$utility = new Utility();
	
	$result_mail = $db->Fetch('smtp_setting', '*', 'smtp_id = 1');
	$row = mysql_fetch_array($result_mail);
?>

<script type="text/javascript">
$(document).attr('title', 'Mail Setting');
var vRules = {
	mailer:{ required:true},
	host:{required:true},
	username:{ required:true, email:true},
	password:{ required:true},
	port:{ required:true},
	from_name :{required:true}
};
var vMessages = {
	mailer:{ required:'Please select mailer.'},
	host:{ required:'Please enter your hostname.'},
	username:{ required:'Please enter user name', email: 'Please enter valid username.'},
	password:{ required:'Please enter password'},
	port:{ required: "Enter your password."},
	from_name :{required: "Enter from Name." }
};



function clearSearch(){

	$('#title_search').val("");
	$('#search_in').val("");
	$('#dg').datagrid('load',{}); 
	$('#dg-search').linkbutton({disabled:false});
	$('#dg-search-clear').linkbutton({disabled:true});
}



function ClearForm(from){
	
	ClearFormAndErrors(from);
}

$(document).ready(function() {	

	
	
	$('#user_form').validate({
		
		rules: vRules,
		messages: vMessages,
		submitHandler: function(form) {
			
			act = 'update' ;
			$(form).ajaxSubmit({
				url: 'control/smtp_setting.php?act='+act,
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
							msg: "Data Saved Successfully"
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
			<legend>Mail Setting</legend>
			<div class="form-column">
				<div class="form-row">
					<span> Mailer: &nbsp;</span>
					<select name="mailer" id="mailer" size="1">
						<option value="smail" selected >SMTP SMail</option>
					</select>
					<input type="hidden" name='smtp_id' id='smtp_id' value="<?php echo $row['smtp_id']; ?>">
					<label for="mailer" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				<div class="form-row">
					<span> SMTP Host: &nbsp;</span>
					<input type="text" name="host" id="host" maxlength="100"  value ="<?php echo stripslashes($row['host']); ?>" style="width:175px"/>
					<label for="host" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				<div class="form-row">
					<span> SMTP Username: &nbsp;</span>
					<input type="text" name="username" id="username" maxlength="100"  value ="<?php echo stripslashes($row['username']); ?>" style="width:175px"/>
					<label for="username" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				<div class="form-row">
					<span> SMTP Password: &nbsp;</span>
					<input type="password" name="password" id="password" maxlength="100"  value ="<?php echo stripslashes($row['password']); ?>" style="width:175px"/>
					<label for="password" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				<div class="form-row">
					<span> SMTP Port: &nbsp;</span>
					<input type="text" name="port" id="port" maxlength="4"  value ="<?php echo stripslashes($row['port']); ?>" />
					<label for="port" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
				<div class="form-row">
					<span> From Name: &nbsp;</span>
					<input type="text" name="from_name" id="from_name" maxlength="250"  value ="<?php echo stripslashes($row['from_name']); ?>" style="width:175px" />
					<label for="from_name" generated="false" class="error" style="padding-left:100px;">&nbsp;</label>
				</div>
			</div>
		</fieldset>
		<div class="clr"></div>
		<div class="form-row-last">
			<div id="content-header-buttons">
				<div class="fl">
					<input type="submit" class="buttonbar" value="Save"/>
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