<?php
$con = mysql_connect('localhost','root','');
if(!$con)
{
	echo 'Some erroes occured during installation.Please reload the page.if problem persists than contact helpline.';
	die();
}

$dbcreate = mysql_query('CREATE DATABASE IF NOT EXISTS db_cps',$con);
if(!$dbcreate)
{
	echo mysql_error();
}
mysql_select_db('db_cps',$con);

$file_content = file('db_cps.sql');
$one = '';
$count = 0;
foreach($file_content as $sql_line)
{
    if(trim($sql_line) != "" && strpos($sql_line, "--") === false)
	{
	 	$one .= $sql_line;
     	if(strpos($sql_line,';'))
	 	{
		 	mysql_query($one);
	 		$one = '';
		}
	}
}
?>
<?php  require_once('../global.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include('../includes.php'); ?>	
	
	<script type="text/javascript">
		function chkagree()
		{
			if(document.getElementById("agree").checked == true)
			{
				return true;
			}
			else
			{
				document.getElementById("divmsg").style.display = "block";
				return false;
			}
		}
	</script>
	
</head>
<body>
<div id="topdivlogo">
	<div id="titlediv">Cheque Processing System</div>
	<div class="topright-menu">
	</div>
</div>
	<div id="innerpage-maindiv">
    	<div class="clear">&nbsp;</div>
    	<div class="middle-maindiv">
        	<div class="middlesubdiv">
                <form id="loginform" name="loginform" method="post" action="installstep1.php" autocomplete="off">
					<div id="formdiv">
						<div id="formheading">Welcome</div>
						<div id="formfields">
						  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
							<tr>
							  <td align="left" valign="top" style="padding-left:16px; padding-top:16px; padding-bottom:16px">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
									    <td width="15%" height="35" align="left" valign="top">
											<label><b>Terms & Conditions</b></label></br>
											<label>1.Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text;</label></br>
											<label>2.Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text;</label></br>
											<label>3.Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text;</label></br>
											<label>4.Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text;</label></br>
											<label>5.Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text;</label></br>
											<label>6.Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text; Dummt Text;</label></br>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;
										</td>
									</tr>
									<tr>
										<td>
											<input type="checkbox" name="agree" id="agree" value=""  /><label>&nbsp;<b>I agree to the terms.</b></label>
											<div style="float:right; padding-right:16px;">
												<input type="submit" name="submit" class="submitbutton" value="Next" onClick="return chkagree();" />
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div id="divmsg" style="display:none; color:#F68771"><label><b style="color:#F68771">*Please agree to the terms.</b></label></div>
										</td>
									</tr>
								</table>
							  </td>
							</tr>
							
						  </table>
						</div>
					</div>
               </form> 
            </div>
        </div>
    </div>	 
</body>
</html>
