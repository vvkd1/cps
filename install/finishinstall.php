<?php  require_once('../global.php'); 
/*
destroy("install"); 
function destroy($dir) {
    $mydir = opendir($dir);
    while(false !== ($file = readdir($mydir))) {
        if($file != "." && $file != "..") {
            chmod($dir.$file, 0777);
            if(is_dir($dir.$file)) {
                chdir('.');
                destroy($dir.$file.'/');
                rmdir($dir.$file);
            }
            else{
				if($file!="finishinstall.php")
					unlink($dir.$file);
			}	
        }
    }
    closedir($mydir);
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Cheque Personalization System ::</title>
<?php include('../includes.php'); ?>
</head>
<body>
<div id="topdivlogo">
<div id="titlediv">Cheque Personalization System</div>
</div>
	<div id="innerpage-maindiv">
    	<div class="clear">&nbsp;</div>
    	<div class="middle-maindiv">
        	<div class="middlesubdiv">
        	  
        	    <div id="formdiv">
				<div id="formheading">Congrats, you have finished your installation</div>
                <div id="formfields">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid; border-color:#cccccc;">
                    <tr>
                      <td align="left" valign="top" style="padding-left:16px; padding-top:16px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="20%" align="left" valign="middle"><label>Click on button to continue </label></td>
                          <td width="35%" height="35" align="left" valign="top">
							<input type="button" name="btnContinue" id="btnContinue" class="submitbutton" value="Continue" onclick="window.location='<?php echo SITE_ROOT; ?>login.php'" /></td>
                          <td width="18%" align="left" valign="top">&nbsp;</td>
                          <td width="27%" align="left" valign="top">&nbsp;</td>
                        </tr>
                       
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                        </tr>
                        
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="right" valign="top" style="padding-right:16px;">&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
                </div>
               </div>
            </div>
        </div>
    </div>	 
</body>
</html>
