<?php require_once('../global.php');
		
if(isset($_REQUEST['txtArchiveFolder']) && $_REQUEST['txtArchiveFolder'] != "")
{	
	//Store all post data in variables.
	
	$inputfolderpath = "";//$inputfolderpath = $_REQUEST['txtInputFolder'];
	$inputfileformat = $_REQUEST['ddlFileFormat'];	
	$archivefolder = $_REQUEST['txtArchiveFolder'];	
	$chktakenfrom = $_REQUEST['chk1'];	
	$nooffailedpasswordattempt = $_REQUEST['txtnooffailedpasswordattempt'];
	$password_expiry = $_REQUEST['txtpasswordexpiry'];
	$homescreen_text = $_REQUEST['txthomescreen_text'];
	$poweredby = $_REQUEST['txtpoweredby'];
	$country = $_REQUEST['ddlcountry'];
	$autolockminutes = $_REQUEST['txtautolockminutes'];	
		
	//Make sure if settings table is empty.
	$sqldelete = "DELETE FROM tb_cps_settings";
	$db->query($sqldelete);
	
	//Bank Logo start
	
	$logo = "";
	$chqimage = "";
	$haslogoimage = false;
	$haschkimage = false;
	include('SimpleImage.php');
	if(isset($_FILES["banklogo"]["name"]) && $_FILES["banklogo"]["name"] != "")
	{
		//move_uploaded_file($_FILES["banklogo"]["tmp_name"],"../images/" . $_FILES["banklogo"]["name"]);
		$logo = $_FILES["banklogo"]["name"];
		$haslogoimage = true;				
		$image = new SimpleImage();
		$image->load($_FILES['banklogo']['tmp_name']);
		$image->resize(245,45);
		$image->save("../images/".$_FILES["banklogo"]["name"]);
	}
	else{
		$logo = "noimage.jpg";
	}

	if($haslogoimage)
	{
		//Insert settings in tb_cps_settings table $passwordexpiry
		$sql = "INSERT INTO tb_cps_settings
				(inputfolderpath,inputfileformat,inputfiledelimiter,outputfolderpath,outputfileformat,outputfiledelimiter,archivefolderpath,typeofprinter,printermodel,chk_taken_from,chk_no_from,chk_no_to,nooffailedpasswordattempt,password_expiry,homescreen_text,poweredby,banklogo,autolockminutes,country)
				VALUES
				 ('".mysql_real_escape_string($inputfolderpath)."' ,'".mysql_real_escape_string($inputfileformat)."' ,'".mysql_real_escape_string($inputfiledelimiter)."' ,'".mysql_real_escape_string($outputfolderpath)."' ,'".mysql_real_escape_string($outputfileformat)."' ,'".mysql_real_escape_string($outputfiledelimiter)."','".mysql_real_escape_string($archivefolder)."' ,'".mysql_real_escape_string($typeofprinter)."','".mysql_real_escape_string($printermodel)."','".$chktakenfrom."','".$chkfrom."','".$chkto."','".mysql_real_escape_string($nooffailedpasswordattempt)."' ,'".mysql_real_escape_string($password_expiry)."','".mysql_real_escape_string($homescreen_text)."','".mysql_real_escape_string($poweredby)."','".$logo."','".mysql_real_escape_string($autolockminutes)."','".mysql_real_escape_string($country)."')";
				
				
				$db->query($sql);
				echo '{"status":"true"}';
				exit;		
	}
	else
	{
		echo '{"error":"true", "htmlcontent":"<span>Please Upload Both(Image Logo & Cheque Image) Images</span>"}';
		$db->closeDb();
		exit();
	}	
}
	
?>