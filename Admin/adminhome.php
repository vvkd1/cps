<?php
require_once('../global.php');
authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once('../HEADHeader.php');	?>
<?php include('../includes.php'); ?>
</head>

<body> 
<?php require_once('adminheader.php');	?>           
<div id="formdiv">
<div id="formheading">Welcome</div>
	<div id="formfields" style="text-align:center;valign:center">
		<table style="width:100%;">
			<tr>
				<td style="width:100%;height:600px" valign="center" align="center">
				<?php
					$sql = "select homescreen_text from tb_cps_settings";
					$row_setting = $db->get_row($sql);	
					if($row_setting>0 && !empty($row_setting->homescreen_text))
					{
						echo "<h1>".$row_setting->homescreen_text."</h1>";	
					}
				?>
				</td>
			</tr>
		</table>
	</div>
</div>
</div>
</div>
</div>

<?php require_once('../footer.php');	?> 
</body>
</html>
