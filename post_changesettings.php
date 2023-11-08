<?php require_once('global.php');
	
if(isset($_GET["pid"]) && $_GET["pid"] != ""){
	$queryprintermodels = "SELECT * FROM tb_cps_printermodels WHERE brand_id='".$_GET["pid"]."'";
	$resultprintermodels = $db->get_results($queryprintermodels);
	echo "<select name='ddlTypeOfPrinterModel' id='ddlTypeOfPrinterModel' style='width: 220px;'>";
	foreach($resultprintermodels as $rowmodel):
		echo "<option value='". $rowmodel->model_id ."'>".$rowmodel->model_name."</option>";
	endforeach;
	echo "</select>";
}	

	//Store all post data in variables.
	
	if( isset($_REQUEST['txtArchiveFolder']) && $_REQUEST['txtArchiveFolder'] != ""){
	
	$inputfolderpath = "";//$inputfolderpath = $_REQUEST['txtInputFolder'];
	$inputfileformat = $_REQUEST['ddlFileFormat'];
	if($inputfileformat == "ASCII")
		$inputfiledelimiter = $_REQUEST['ddlInputDelimiter'];
	else
	$inputfiledelimiter = "";
	
	$outputfolderpath = "";//$outputfolderpath = $_REQUEST['txtOutputFolder'];
	$outputfileformat = $_REQUEST['ddlOutputFileFormat'];
	if($outputfileformat == "ASCII")
		$outputfiledelimiter = $_REQUEST['ddlOutputDelimiter'];
	else
		$outputfiledelimiter = "";
		
	$archivefolder = $_REQUEST['txtArchiveFolder'];
	
	$typeofprinter = $_REQUEST['ddlTypeOfPrinter'];
	$printermodel  = $_REQUEST['ddlTypeOfPrinterModel'];
	
	$chk_taken_from = $_REQUEST['chk1'];
	//if($chktakenfrom == "0"){
	//$chkfrom = $_REQUEST['txtchqnofrom'];$chkto = $_REQUEST['txtchqnoto'];
	//}
	//else{
	//$chkfrom = "";$chkto = "";
	//}
	
	//if($chk_taken_from == "0"){
		//$chkfrom = $_REQUEST['txtchqnofrom'];
		//$chkto = $_REQUEST['txtchqnoto'];
		//if($chkfrom != "" || $chkto != ""){
			//if($chkfrom >= $chkto){
				//echo '{"error":"true", "htmlcontent":"<span> cheque no to should be greater then cheque no from.</span>"}';
				//$db->closeDb();
				//exit();
			//}
		//}else{
			//echo '{"error":"true", "htmlcontent":"<span>Please fill the (Cheque No. From,Cheque No. To)</span>"}';
			//$db->closeDb();
			//exit();
		//}
	//}
	//else{
		//$chkfrom = "";
		//$chkto = "";
	//}
	
	$nooffailedpasswordattempt = $_REQUEST['txtnooffailedpasswordattempt'];
	$password_expiry = $_REQUEST['txtpasswordexpiry'];
	$homescreen_text = $_REQUEST['txthomescreen_text'];
	$poweredby = $_REQUEST['txtpoweredby'];
	$country = "";//$_REQUEST['ddlcountry'];
	$help_helplineno1 = $_REQUEST['txthelp_helplineno1'];
	$help_helplineno2 = $_REQUEST['txthelp_helplineno2'];
	$help_contactperson = $_REQUEST['txthelp_contactperson'];
	$help_emailid = $_REQUEST['txthelp_emailid'];
	$autolockminutes = $_REQUEST['txtautolockminutes'];
	$createdate = date("Y-m-d");
		
	//Bank Logo
	//$hasimage = false;
	//if(isset($_FILES["banklogo"]["name"]))
	//{
		//move_uploaded_file($_FILES["banklogo"]["tmp_name"],"images/" . $_FILES["banklogo"]["name"]);
		//$hasimage = true;
	//}
	
	$logo = "";
	$chqimage = "";
	$haslogoimage = false;
	$hasdesktopimage = false;
	$haschkimage = false;
	include('SimpleImage.php');
	if(isset($_FILES["banklogo"]["name"]) && $_FILES["banklogo"]["name"] != "")
	{
		//move_uploaded_file($_FILES["banklogo"]["tmp_name"],"../images/" . $_FILES["banklogo"]["name"]);
		$logo = $_FILES["banklogo"]["name"];
		$haslogoimage = true;				
		$image = new SimpleImage();
		$image->load($_FILES['banklogo']['tmp_name']);
		$image->resize(45,45);
		$image->save("images/".$_FILES["banklogo"]["name"]);
	}
	else{
		$logo = "noimage.jpg";
	}
	if(isset($_FILES["desk_img"]["name"]) && $_FILES["desk_img"]["name"] != "")
	{
		$desk_img = $_FILES["desk_img"]["name"];
		$hasdesktopimage = true;				
		$image = new SimpleImage();
		$image->load($_FILES['desk_img']['tmp_name']);
		$image->resize(1000,500);
		$image->save("images/".$_FILES["desk_img"]["name"]);
	}
	//if(isset($_FILES["chequeimage"]["name"]) && $_FILES["chequeimage"]["name"] != "")
	//{
		//$chqimage = $_FILES["chequeimage"]["name"];
		//$haschkimage = true;		
		//$image = new SimpleImage();
		//$image->load($_FILES['chequeimage']['tmp_name']);
		//$image->resize(809,295);
		//$image->save("images/".$_FILES["chequeimage"]["name"]);
	//}
	//else{
		//$chqimage = "noimage.jpg";
	//}
	
	
	if($haslogoimage)
	{		
		$sql = "UPDATE tb_cps_settings set 
				 inputfolderpath = '".mysql_real_escape_string($inputfolderpath)."',
				 inputfileformat = '".mysql_real_escape_string($inputfileformat)."',
				 inputfiledelimiter = '".mysql_real_escape_string($inputfiledelimiter)."',
				 outputfileformat = '".mysql_real_escape_string($outputfileformat)."',
				 outputfolderpath = '".mysql_real_escape_string($outputfolderpath)."',
				 outputfiledelimiter = '".mysql_real_escape_string($outputfiledelimiter)."',
				 typeofprinter = '".mysql_real_escape_string($typeofprinter)."',
				 printermodel = '".mysql_real_escape_string($printermodel)."',
				 nooffailedpasswordattempt = '".mysql_real_escape_string($nooffailedpasswordattempt)."',
				 password_expiry = '".mysql_real_escape_string($password_expiry)."',
				 homescreen_text = '".mysql_real_escape_string($homescreen_text)."',
				 poweredby = '".mysql_real_escape_string($poweredby)."',
				 help_helplineno1 = '".mysql_real_escape_string($help_helplineno1)."',
				 help_emailid = '".mysql_real_escape_string($help_emailid)."',
				 banklogo = '".$logo."',
				 autolockminutes = '".mysql_real_escape_string($autolockminutes)."',
				 help_contactperson = '".mysql_real_escape_string($help_contactperson)."',
				 help_helplineno2 = '".mysql_real_escape_string($help_helplineno2)."',
				 country = '".mysql_real_escape_string($country)."',
				 chk_taken_from = '".mysql_real_escape_string($chk_taken_from)."',
				 chk_no_from = '".mysql_real_escape_string($chkfrom)."',
				 chk_no_to = '".mysql_real_escape_string($chkto)."',
				 archivefolderpath = '".mysql_real_escape_string($archivefolder)."'";					 
			    $db->query($sql);
				
				if($haschkimage)
				{
					$db->query("UPDATE tb_cps_settings set chq_Image = '".$chqimage."'");
				}
				
	}
	else if($hasdesktopimage)
	{		
		$sql = "UPDATE tb_cps_settings set 
				 inputfolderpath = '".mysql_real_escape_string($inputfolderpath)."',
				 inputfileformat = '".mysql_real_escape_string($inputfileformat)."',
				 inputfiledelimiter = '".mysql_real_escape_string($inputfiledelimiter)."',
				 outputfileformat = '".mysql_real_escape_string($outputfileformat)."',
				 outputfolderpath = '".mysql_real_escape_string($outputfolderpath)."',
				 outputfiledelimiter = '".mysql_real_escape_string($outputfiledelimiter)."',
				 typeofprinter = '".mysql_real_escape_string($typeofprinter)."',
				 printermodel = '".mysql_real_escape_string($printermodel)."',
				 nooffailedpasswordattempt = '".mysql_real_escape_string($nooffailedpasswordattempt)."',
				 password_expiry = '".mysql_real_escape_string($password_expiry)."',
				 homescreen_text = '".mysql_real_escape_string($homescreen_text)."',
				 poweredby = '".mysql_real_escape_string($poweredby)."',
				 help_helplineno1 = '".mysql_real_escape_string($help_helplineno1)."',
				 help_emailid = '".mysql_real_escape_string($help_emailid)."',
				 desktop_image = '".$desk_img."',
				 autolockminutes = '".mysql_real_escape_string($autolockminutes)."',
				 help_contactperson = '".mysql_real_escape_string($help_contactperson)."',
				 help_helplineno2 = '".mysql_real_escape_string($help_helplineno2)."',
				 country = '".mysql_real_escape_string($country)."',
				 chk_taken_from = '".mysql_real_escape_string($chk_taken_from)."',
				 chk_no_from = '".mysql_real_escape_string($chkfrom)."',
				 chk_no_to = '".mysql_real_escape_string($chkto)."',
				 archivefolderpath = '".mysql_real_escape_string($archivefolder)."'";					 
			    $db->query($sql);
				
				/*if($haschkimage)
				{
					$db->query("UPDATE tb_cps_settings set chq_Image = '".$chqimage."'");
				}*/
				
	}
	else if($haschkimage)
	{		
		$sql = "UPDATE tb_cps_settings set 
				 inputfolderpath = '".mysql_real_escape_string($inputfolderpath)."',
				 inputfileformat = '".mysql_real_escape_string($inputfileformat)."',
				 inputfiledelimiter = '".mysql_real_escape_string($inputfiledelimiter)."',
				 outputfileformat = '".mysql_real_escape_string($outputfileformat)."',
				 outputfolderpath = '".mysql_real_escape_string($outputfolderpath)."',
				 outputfiledelimiter = '".mysql_real_escape_string($outputfiledelimiter)."',
				 typeofprinter = '".mysql_real_escape_string($typeofprinter)."',
				 printermodel = '".mysql_real_escape_string($printermodel)."',
				 nooffailedpasswordattempt = '".mysql_real_escape_string($nooffailedpasswordattempt)."',
				 password_expiry = '".mysql_real_escape_string($password_expiry)."',
				 homescreen_text = '".mysql_real_escape_string($homescreen_text)."',
				 poweredby = '".mysql_real_escape_string($poweredby)."',
				 help_helplineno1 = '".mysql_real_escape_string($help_helplineno1)."',
				 help_emailid = '".mysql_real_escape_string($help_emailid)."',
				 chq_Image = '".$chqimage."',
				 autolockminutes = '".mysql_real_escape_string($autolockminutes)."',
				 help_contactperson = '".mysql_real_escape_string($help_contactperson)."',
				 help_helplineno2 = '".mysql_real_escape_string($help_helplineno2)."',
				 country = '".mysql_real_escape_string($country)."',
				 chk_taken_from = '".mysql_real_escape_string($chk_taken_from)."',
				 chk_no_from = '".mysql_real_escape_string($chkfrom)."',
				 chk_no_to = '".mysql_real_escape_string($chkto)."',
				 chq_Image = '".$chqimage."',
				 archivefolderpath = '".mysql_real_escape_string($archivefolder)."'";	
				 
			    $db->query($sql);
	}
	else
	{
		$sql = "UPDATE tb_cps_settings set 
				 inputfolderpath = '".mysql_real_escape_string($inputfolderpath)."',
				 inputfileformat = '".mysql_real_escape_string($inputfileformat)."',
				 inputfiledelimiter = '".mysql_real_escape_string($inputfiledelimiter)."',
				 outputfileformat = '".mysql_real_escape_string($outputfileformat)."',
				 outputfolderpath = '".mysql_real_escape_string($outputfolderpath)."',
				 outputfiledelimiter = '".mysql_real_escape_string($outputfiledelimiter)."',
				 typeofprinter = '".mysql_real_escape_string($typeofprinter)."',
				 printermodel = '".mysql_real_escape_string($printermodel)."',
				 nooffailedpasswordattempt = '".mysql_real_escape_string($nooffailedpasswordattempt)."',
				 password_expiry = '".mysql_real_escape_string($password_expiry)."',
				 homescreen_text = '".mysql_real_escape_string($homescreen_text)."',
				 poweredby = '".mysql_real_escape_string($poweredby)."',
				 help_helplineno1 = '".mysql_real_escape_string($help_helplineno1)."',
				 help_emailid = '".mysql_real_escape_string($help_emailid)."',				 
				 autolockminutes = '".mysql_real_escape_string($autolockminutes)."',
				 help_contactperson = '".mysql_real_escape_string($help_contactperson)."',
				 help_helplineno2 = '".mysql_real_escape_string($help_helplineno2)."',
				 country = '".mysql_real_escape_string($country)."',
				 chk_taken_from = '".mysql_real_escape_string($chk_taken_from)."',
				 chk_no_from = '".mysql_real_escape_string($chkfrom)."',
				 chk_no_to = '".mysql_real_escape_string($chkto)."',				 
				 archivefolderpath = '".mysql_real_escape_string($archivefolder)."'";	
				
				//echo $sql;
			    $db->query($sql);
	}
		
	if($_REQUEST['submit_type'] == "1") 
	{
		$location = 'changesettings.php';
	} 
	else 
	{
		$location = 'home.php';
	}
	
	echo '{"status":"true", "loc":"'.$location.'"}';
	$db->closeDb();
	exit();
	}

	
?>