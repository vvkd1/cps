<?php
require_once('global.php');
authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
<?php require_once('HEADHeader.php');	?>

<style type="text/css">
	label{
		font-size: 15px !important;
	}
</style>
</head>
<body> 
<?php require_once('header.php');
$sql = "select help_emailid,help_helplineno1,help_employeeid,help_contactperson,help_helplineno2 from tb_cps_settings";
$row_settinghelp = $db->get_row($sql);	


?>
<div id="formdiv">
<div id="formheading">HELP-LINE</div>
	<div id="formfields" style="text-align:center;valign:left">
		<table style="width:100%;">
			<tr>
				<td style="width:100%;height:200px"  align="left" valign="top">
					<table style="width:500px" >
						<tr>
							<td colspan="2">
							&nbsp;
							</td>
						</tr>
						<!-- <tr>
							<td>
							<label>Contact Person</label>
							</td>
							<td>
								<label><?php //echo $row_settinghelp->help_contactperson; ?></label>
							</td>
						</tr> -->
						<tr>
							<td>
							<label>Email ID</label>
							</td>
							<td>
								<label><a href="mailto:scube.net.in">support@scube.net.in</a></label>
							</td>
						</tr>
						<tr>
							<td>
							<label>Website</label>
							</td>
							<td>
								<label><a href="http://scube.net.in" target="_blank">scube.net.in</a></label>
							</td>
						</tr>
						<!-- <tr>
							<td>
							<label>Help Line 2</label>
							</td>
							<td>
								<label><?php //echo $row_settinghelp->help_helplineno2; ?></label>
							</td>
						</tr> -->
					</table>
				</td>
			</tr>
		</table>
	</div>

<div id="formheading">User Manual</div>

<div id="formfields" style="text-align:center;valign:left">
		<table style="width:100%;">
			<tr>
				<td style="width:100%;height:200px"  align="left" valign="top">
					<table style="width:500px" >
						<tr>
							<td colspan="2">
							&nbsp;
							</td>
						</tr>
						
						<tr>
							<td colspan="2">
							<label><a href="https://scube.net.in/app/cps/usermanual/gpb-index.html" target="_blank">User Manual <i class="fa fa-external-link" aria-hidden="true"></i></a></label>
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
