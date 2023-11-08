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
	$help_helplineno1 = $_REQUEST['txthelp_helplineno1'];
	$help_helplineno2 = $_REQUEST['txthelp_helplineno2'];
	$help_contactperson = $_REQUEST['txthelp_contactperson'];
	$help_emailid = $_REQUEST['txthelp_emailid'];
	$autolockminutes = $_REQUEST['txtautolockminutes'];	
	$licensetype = $_REQUEST['ddlLicensetype'];
	$licenseusersleaves = "";
	$licensenoofusersleaves = "";
	if($licensetype == "yearly"){
		
		$installdateyr = $_REQUEST['txtdateofinstallyearly'];
		$licensenoofusersleaves = $_REQUEST['txtlicense_users_leaves_value_yearly'];
		if($installdateyr != "" && $licensenoofusersleaves != ""){
			$licenseinstalldate = str_replace('/', '-', $installdateyr);
			$licenseinstalldate = date("Y-m-d",strtotime($licenseinstalldate));
			$licenseperiod = $_REQUEST['ddllicenseperiod'];			
			$licenseenddate = str_replace('/', '-', $_REQUEST['txtlicenseupto']);
			$licenseenddate = date("Y-m-d",strtotime($licenseenddate));
			$licenseusersleaves = $_REQUEST['radlicense_users_leaves_yearly'];
			$licensenoofusersleaves = $_REQUEST['txtlicense_users_leaves_value_yearly'];
		}else{
			echo '{"error":"true", "htmlcontent":"<span>Please fill the (Date Of Installation,No Of Users/Leaves)</span>"}';
			$db->closeDb();
			exit();
		}
	}
	else if($licensetype == "onetime"){
	
		$installdateone = $_REQUEST['txtdateofinstallonetime'];
		$licensenoofusersleaves = $_REQUEST['txtlicense_users_leaves_value_onetime'];
		
		if($installdateone != "" && $licensenoofusersleaves != ""){
			$licenseinstalldate = str_replace('/', '-', $installdateone);
			$licenseinstalldate = date("Y-m-d",strtotime($licenseinstalldate));
			$licenseperiod = "1";
			$licenseenddate = str_replace('/', '-', $_REQUEST['txtlicenseuptoonetime']);
			$licenseenddate = date("Y-m-d",strtotime($licenseenddate));
			$licenseusersleaves = $_REQUEST['radlicense_users_leaves_onetime'];			
		}else{
			echo '{"error":"true", "htmlcontent":"<span>Please fill the (Date Of Installation,No Of Users/Leaves)</span>"}';
			$db->closeDb();
			exit();
		}
	}
	else if($licensetype == "revenue"){
	
		$installdaterev = $_REQUEST['txtdateofinstallonetime'];
		$licensenoofusersleaves = $_REQUEST['txtlicense_users_leaves_value_revinue'];
		if($installdaterev != "" && $licensenoofusersleaves != ""){	
			$licenseinstalldate = str_replace('/', '-', $installdaterev);
			$licenseinstalldate = date("Y-m-d",strtotime($licenseinstalldate));
			$licenseperiod = "";
			$licenseenddate = "";
			$licenseusersleaves = $_REQUEST['radlicense_users_leaves_revinue'];
		}else{
			echo '{"error":"true", "htmlcontent":"<span>Please fill the (Date Of Installation,No Of Users/Leaves)</span>"}';
			$db->closeDb();
			exit();
		}
		
	}
	
	//Make sure if settings table is empty.
	$sqldelete = "DELETE FROM tb_cps_settings";
	$db->query($sqldelete);
	
	createLicence($licensetype,$licenseperiod,$licenseenddate,$licenseusersleaves,$licensenoofusersleaves);
		
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
	
	
	
	// end
	
	if($haslogoimage)
	{
		
			//Insert settings in tb_cps_settings table $passwordexpiry
			$sql = "INSERT INTO tb_cps_settings
					(inputfolderpath,inputfileformat,inputfiledelimiter,outputfolderpath,outputfileformat,outputfiledelimiter,archivefolderpath,typeofprinter,printermodel,chk_taken_from,chk_no_from,chk_no_to,nooffailedpasswordattempt,password_expiry,homescreen_text,poweredby,help_helplineno1,help_emailid,banklogo,autolockminutes,help_contactperson,help_helplineno2,country,license_type,license_install_date,license_period,license_end_date,license_users_leaves,license_users_leaves_value,chq_Image)
					VALUES
					 ('".mysql_real_escape_string($inputfolderpath)."' ,'".mysql_real_escape_string($inputfileformat)."' ,'".mysql_real_escape_string($inputfiledelimiter)."' ,'".mysql_real_escape_string($outputfolderpath)."' ,'".mysql_real_escape_string($outputfileformat)."' ,'".mysql_real_escape_string($outputfiledelimiter)."','".mysql_real_escape_string($archivefolder)."' ,'".mysql_real_escape_string($typeofprinter)."','".mysql_real_escape_string($printermodel)."','".$chktakenfrom."','".$chkfrom."','".$chkto."','".mysql_real_escape_string($nooffailedpasswordattempt)."' ,'".mysql_real_escape_string($password_expiry)."','".mysql_real_escape_string($homescreen_text)."','".mysql_real_escape_string($poweredby)."','".mysql_real_escape_string($help_helplineno1)."','".mysql_real_escape_string($help_emailid)."','".$logo."','".mysql_real_escape_string($autolockminutes)."','".mysql_real_escape_string($help_contactperson)."','".mysql_real_escape_string($help_helplineno2)."','".mysql_real_escape_string($country)."','".mysql_real_escape_string($licensetype)."','".mysql_real_escape_string($licenseinstalldate)."','".mysql_real_escape_string($licenseperiod)."','".mysql_real_escape_string($licenseenddate)."','".mysql_real_escape_string($licenseusersleaves)."','".mysql_real_escape_string($licensenoofusersleaves)."','".$chqimage."')";
					
					//echo $sql;
					//die();
					
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

function createLicence($licensetype,$licenseperiod,$licenseenddate,$licenseusersleaves,$licensenoofusersleaves)
{
	$path = '../images/phplogo.jpg';
	$image = getimagesize($path, $info);
	$expiredate = $licenseenddate;
	$salt = "!kQm*fF3pXeiIpl1Kbm%9";
	$encrypteddate = base64_encode($expiredate."----------".$salt);

	// Set the IPTC tags
	$iptc = array(
		'2#120' => $encrypteddate,
		'2#115'	=> $licensetype,
		'2#055'	=> $licenseperiod,
		'2#090' => $encrypteddate, 
		'2#095' => $licenseusersleaves,
		'2#101' => $licensenoofusersleaves
	);

	// Convert the IPTC tags into binary code
	$data = '';

	foreach($iptc as $tag => $string)
	{
		$tag = substr($tag, 2);
		//print_r($tag);
		$data .= iptc_make_tag(2, $tag, $string);
	}

	// Embed the IPTC data
	$content = iptcembed($data, $path);

	// Write the new image data out to the file.
	$fp = fopen($path, "wb");
	fwrite($fp, $content);
	fclose($fp);	
}

function iptc_make_tag($rec, $data, $value)
{
    $length = strlen($value);
    $retval = chr(0x1C) . chr($rec) . chr($data);

    if($length < 0x8000)
    {
        $retval .= chr($length >> 8) .  chr($length & 0xFF);
    }
    else
    {
        $retval .= chr(0x80) . 
                   chr(0x04) . 
                   chr(($length >> 24) & 0xFF) . 
                   chr(($length >> 16) & 0xFF) . 
                   chr(($length >> 8) & 0xFF) . 
                   chr($length & 0xFF);
    }

    return $retval . $value;
}
	
?>