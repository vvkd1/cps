<?php
require_once 'global.php';

if(isset($_POST['txtrenewcode']) && $_POST['txtrenewcode']!=null)
{
	$encrypteddateandsalt = base64_decode($_POST['txtrenewcode']);
	$encrypteddateandsaltarray = explode("----------",$encrypteddateandsalt);
	$querysettings = "SELECT license_type,license_install_date,license_period,license_end_date,license_users_leaves,license_users_leaves_value FROM tb_cps_settings";
	$databasesettings = $db->get_row($querysettings);

	$image = ROOT_IMAGES.'phplogo.jpg';
	$image = getimagesize($image, $info);

	//Check in it have info
	if(isset($info['APP13']))
	{
		//Parse the iptc data
		if($iptc = iptcparse( $info["APP13"] ) ) 
		{ 
			$salt = "!kQm*fF3pXeiIpl1Kbm%9";
			$fileencrypteddateandsalt = base64_decode($iptc["2#090"][0]);
			$fileencrypteddateandsaltarray = explode("----------",$fileencrypteddateandsalt); 
			$licenceenddate = $fileencrypteddateandsaltarray[0];
			$querysettings = "SELECT license_type,license_install_date,license_period,license_end_date,license_users_leaves,license_users_leaves_value FROM tb_cps_settings";
			$databasesettings = $db->get_row($querysettings);
			
			if($databasesettings->license_type == "yearly" || $databasesettings->license_type == "onetime")
			{
				$enddate= $databasesettings->license_end_date;
				
				if(count($encrypteddateandsaltarray) == 3 && strtotime($licenceenddate) == strtotime($enddate) && strtotime($encrypteddateandsaltarray[0])==strtotime($enddate) && checkIsValidDate($encrypteddateandsaltarray[0]) && checkIsValidDate($encrypteddateandsaltarray[2]) && $encrypteddateandsaltarray[1]=="!kQm*fF3pXeiIpl1Kbm%9")
				{
					createNewLicence($encrypteddateandsaltarray[2],$databasesettings);
					$sqlupdate = "UPDATE tb_cps_settings SET license_end_date = '".$encrypteddateandsaltarray[2]."'";
					$db->query($sqlupdate);
					echo '{"status":"true"}';
					exit;
				}
				else
				{
					echo '{"error":"true", "htmlcontent":"<span>Invalid licence key.</span>"}';
					exit;
				}
			}
		}
		else
		{
			echo '{"error":"true", "htmlcontent":"<span>Invalid licence key.</span>"}';
			exit;
		}
	}
	else
	{
		echo '{"error":"true", "htmlcontent":"<span>Invalid licence key.</span>"}';
		exit;
	}
}


function checkIsValidDate($date)
{
  //match the format of the date
  if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts))
  {
    //check weather the date is valid of not
        if(checkdate($parts[2],$parts[3],$parts[1]))
          return true;
        else
         return false;
  }
  else
    return false;
}


function createNewLicence($licenseenddate,$databasesettings)
{
	$path = 'images/phplogo.jpg';
	$image = getimagesize($path, $info);
	$expiredate = $licenseenddate;
	$salt = "!kQm*fF3pXeiIpl1Kbm%9";
	$encrypteddate = base64_encode($expiredate."----------".$salt);

	if(isset($info['APP13']))
	{
		$iptc = iptcparse($info['APP13']);
		//var_dump($iptc);
	}

	// Set the IPTC tags
	
	$iptc = array(
		'2#120' => $encrypteddate,
		'2#115'	=> $databasesettings->license_type,
		'2#055'	=> $databasesettings->license_period,
		'2#090' => $encrypteddate, 
		'2#095' => $databasesettings->license_users_leaves,
		'2#101' => $databasesettings->license_users_leaves_value
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