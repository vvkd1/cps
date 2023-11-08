<?php 
require_once('global.php');
error_reporting(E_ALL ^ E_NOTICE);
$page_name = "Database Backup";
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
function backup(){
$.ajax({type: "POST", url: "post_backup.php", dataType: 'json', data: "do=backup",
							success: function(resObj, statusText) {
								if(resObj.status) {       								
									$('#msgbox').html('<div class="errormsg_boundary">Backup of database successful. Visit backup folder of the installation. <div>').show();																
								} else {
									$('#msgbox').html('<div class="errormsg_boundary">Backup of database failed.<div>').show();
									return false;
								}
							}
						});  
}
</script>
</head>
<body>

<?php require_once('header.php');?>
	<div id="formdiv">
		<div id="formheading">Database Backup</div>
		<div id="formfields">
	   
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">						 
				 <table width="800" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					  <td>&nbsp;</td>
					  </tr>
					  <tr>
						<td align="left" valign="top">	
							<form>
							<input type="button" value="Backup Now" onclick="backup();">
							</form>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td><span id="msgbox"></span></td>
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
