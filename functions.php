<?php require_once('global.php');
ini_set("memory_limit","-1");
//only for marketin panel
error_reporting(E_ALL & ~E_NOTICE);

function authentication_AdminPanel() {
	if(!isset($_SESSION['adminpanel_id']) && empty($_SESSION['adminpanel_id']) && !isset($_SESSION['adminpanel_username']) && empty($_SESSION['adminpanel_username'])) { 		
		header("Location: ".SITE_ROOT."login.php");
	}
	else{
		global $db;	
		$passwordtype =  $db->get_row("select is_temp_password,adminid from tb_printadmin where userid = '".$_SESSION['adminpanel_userid']."'");
		if($passwordtype->is_temp_password != "0" ){
			// checking the time now when home page starts
			if(time() > $_SESSION['expire'])
			{
				header("Location: ".SITE_ROOT."userlock.php");
			}
			else
			{			
				$_SESSION['expire'] = time() + ($_SESSION['autolockminutes'] * 60);	
			}
		}else{
			if($_SERVER['PHP_SELF'] != SITE_ROOT_DOC."changepassword.php")
			{
				header("Location: ".SITE_ROOT."changepassword.php");
			}			
		}
	}
}

function authentication_print() {
	if(!isset($_SESSION['admin_id']) && empty($_SESSION['admin_id']) && !isset($_SESSION['admin_username']) && empty($_SESSION['admin_username'])) { 		
		header("Location: ".SITE_ROOT."login.php");
	}
	else
	{
		global $db;	
		$passwordtype =  $db->get_row("select is_temp_password,adminid from tb_printadmin where userid = '".$_SESSION['admin_userid']."'");
		if($passwordtype->is_temp_password != "0" ){
			// checking the time now when home page starts
			if(time() > $_SESSION['expire'])
			{
				header("Location: ".SITE_ROOT."userlock.php");
			}
			else
			{			
				$_SESSION['expire'] = time() + ($_SESSION['autolockminutes'] * 60);	
			}
		}else{
			if($_SERVER['PHP_SELF'] != SITE_ROOT_DOC."changepassword.php")
			{
				header("Location: ".SITE_ROOT."changepassword.php");
			}			
		}
	}
}

function authentication_groups_pemissions($pagename,$type="",$permissionread="",$permissionwrite="",$permissionedit="")
{
	return true;
	global $db;	
	if(!isset($_SESSION['admin_id']) && empty($_SESSION['admin_id']) && !isset($_SESSION['admin_username']) && empty($_SESSION['admin_username']) && !isset($_SESSION['group_id']) ) { 		
		header("Location: ".SITE_ROOT."login.php");
	}
	else
	{
		$searchquery="";
		if($permissionread!="")
		$searchquery.=" AND page_read = 'Y'";
		if($permissionwrite!="")
		$searchquery.=" AND page_write = 'Y'";
		if($permissionedit!="")
		$searchquery.=" AND page_edit = 'Y'";
		
		if($_SESSION['user_type']==2)
		{
			if($type!="")
			{
				return "onclick = 'return true;'";
			}
			else
			{
				return true;
			}
		}
		else
		{
			if($row = $db->get_row("SELECT * FROM tb_cps_grouppermissions WHERE group_id ='".$_SESSION['group_id']."' AND page_accessible='".$pagename."' ".$searchquery."" ) ) 
			{		
				if($type!="")
				{
					return "onclick = 'return true;'";
				}
				else
				{
					return true;
				}
			}
			else
			{
				if($type!="")
				{
					return "onclick = 'return false;'";
				}
				else
				{
					return false;
				}
			}
		}
	}
}

function checkExpiration()
{
	global $db;	

	$image = ROOT_IMAGES.'phplogo.jpg';
	$image = getimagesize($image, $info);

	//Check in it have info
	if(isset($info['APP13']))
	{
		//Parse the iptc data
		if($iptc = iptcparse( $info["APP13"] ) ) 
		{ 
			$salt = "!kQm*fF3pXeiIpl1Kbm%9";
			$encrypteddateandsalt = base64_decode($iptc["2#090"][0]);
			$encrypteddateandsaltarray = explode("----------",$encrypteddateandsalt); 
			$licenceenddate = $encrypteddateandsaltarray[0];
			$licencetype = $iptc["2#115"][0];
			$licenceperiod = $iptc["2#055"][0];
			$licenseusersleaves = $iptc["2#095"][0];
			$licensenoofusersleaves = $iptc["2#101"][0];
			
			
			$querysettings = "SELECT license_type,license_install_date,license_period,license_end_date,license_users_leaves,license_users_leaves_value FROM tb_cps_settings";
			$databasesettings = $db->get_row($querysettings);
			$todaydate = date("Y-m-d");
			if($databasesettings->license_type == "onetime")
			{
				$enddate= $databasesettings->license_end_date;
				
				if($licencetype != $databasesettings->license_type || $licenceperiod != $databasesettings->license_period || $licenseusersleaves != $databasesettings->license_users_leaves || $licensenoofusersleaves != $databasesettings->license_users_leaves_value || strtotime($licenceenddate) != strtotime($enddate) || strtotime($todaydate) > strtotime($licenceenddate))
				{
					if($_SERVER['PHP_SELF'] != SITE_ROOT_DOC."softwareexpired.php")
					{
						//header("Location: ".SITE_ROOT."softwareexpired.php");
					}
				}
			}
			elseif($databasesettings->license_type == "yearly")
			{
				$enddate= $databasesettings->license_end_date;
				if($licencetype != $databasesettings->license_type || $licenceperiod != $databasesettings->license_period || $licenseusersleaves != $databasesettings->license_users_leaves || $licensenoofusersleaves != $databasesettings->license_users_leaves_value || strtotime($licenceenddate) != strtotime($enddate) || strtotime($todaydate) > strtotime($licenceenddate) )
				{
					if($_SERVER['PHP_SELF'] != SITE_ROOT_DOC."softwareexpire.php" && $_SERVER['PHP_SELF'] != SITE_ROOT_DOC."post_softwareexpiry.php")
					{
						//header("Location: ".SITE_ROOT."softwareexpire.php");
					}
				}
			}
		}
		else
		{
			return false;
		}		
	}
	else
	{
		return false;
	}
}


function checkLastPassword($password,$userid)
{	
	global $db;	
	$checkoldpassword = "SELECT * FROM (SELECT * FROM tb_cps_adminpasswords order by date desc limit 0,3) as adminpassword WHERE password = '".$password."' AND adminid = '".$userid."'";
	
	$result = $db->get_row($checkoldpassword);
	if(count($result)>0)
	{
		return false;
	}
	else
	{
		return true;
	}
}
function timeDiff($firstTime,$lastTime)
{
	// convert to unix timestamps
	$firstTime=strtotime($firstTime);
	$lastTime=strtotime($lastTime);	
	// perform subtraction to get the difference (in seconds) between times
	$timeDiff=$lastTime-$firstTime;	
	// return the difference
	return $timeDiff;
}
// generate random password
function createRandomPassword() { 
    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ;
    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 
    return $pass;
} 	
//$password = createRandomPassword(); 

function force_download($filepath) {
	$file = end(explode("/",$filepath));	
	if ((isset($file))&&(file_exists($filepath))) { 
		   header("Content-type: application/force-download"); 
		   header('Content-Disposition: inline; filename="' . $filepath . '"'); 
		   header("Content-Transfer-Encoding: Binary"); 
		   header("Content-length: ".filesize($filepath)); 
		   header('Content-Type: application/octet-stream'); 
		   header('Content-Disposition: attachment; filename="' . $file . '"'); 
		   readfile($filepath); 
		} else { 
		   echo "Sorry file not found. <br/> Please try after some time."; 
	} //end if
}

function upload_multipleImage($fieldname, $maxsize, $extensions, $uploadpath, $index, $ref_name=false) {
		$upload_name = $_FILES[$fieldname]['name'][$index];
		$max_file_size_in_bytes = $maxsize; //max size 
		$extension_whitelist = $extensions; //allows extensions list
		// checking extensions 
		$file_extension = trim(strtolower(end(explode(".",$upload_name))));
		$is_valid_extension = false;		
		if(in_array($file_extension,$extension_whitelist) ) { $is_valid_extension = true;  }
		if (!$is_valid_extension) {			
			echo '{"error":"true", "htmlcontent":"Uploaded file Extension is not valid."}';			
			exit(0);			
		}
		// file size check 
		$file_size = @filesize($_FILES[$fieldname]["tmp_name"][$index]);
		if ( $file_size > $max_file_size_in_bytes) {			
			echo '{"error":"true", "htmlcontent":"File Exceeds maximum limit"}';			
			exit(0);			
		}
		if(isset($upload_name)) {
			if ($_FILES[$fieldname]["error"][$index] > 0) {				
				echo '{"error":"true", "htmlcontent":"' . $_FILES[$fieldname]['error'][$index]. '"}';
				exit(0);							
			}
		}
		//$file_name = time().$upload_name;                               
		if($ref_name == false) {
			$file_name = time().$upload_name;
		} else {
			$file_name = $ref_name;
		}
		if(move_uploaded_file($_FILES[$fieldname]["tmp_name"][$index], $uploadpath.$file_name)) {
			return $file_name;			
		} else {
			echo '{"error":"true", "htmlcontent":"Sorry unable to upload your files"}';
			exit(0);			
		}
}

//function to upload single image
function upload_files($fieldname, $maxsize, $extensions, $uploadpath, $ref_name=false) {
		$upload_name = $_FILES[$fieldname]['name'];
		$max_file_size_in_bytes = $maxsize; //max size 
		$extension_whitelist = $extensions; //allows extensions list
		// checking extensions 
		$file_extension = strtolower(end(explode(".",$upload_name)));		
		if(!in_array($file_extension,$extension_whitelist) ) { 		
			echo '{"error":"true", "htmlcontent":"Uploaded file Extension is not valid."}';			
			exit(0);
		}
		
		// file size check 
		$file_size = @filesize($_FILES[$fieldname]["tmp_name"]);
		if ($file_size > $max_file_size_in_bytes) {			
			echo '{"error":"true", "htmlcontent":"File Exceeds maximum limit"}';			
			exit(0);
		}		
		if(isset($upload_name)) {
			if ($_FILES[$fieldname]["error"] > 0) {				
				echo '{"error":"true", "htmlcontent":"' . $_FILES[$fieldname]['error']. '"}';
				exit(0);				
			}
		}		
		if($ref_name == false ) {
			$file_name = rand(1,99999).time().str_replace(" ","_",$upload_name);
		} else {
			$file_name = $ref_name;
		}
		if(move_uploaded_file($_FILES[$fieldname]["tmp_name"], $uploadpath.$file_name)) {
			return $file_name;
		} else {
			echo '{"error":"true", "htmlcontent":"Sorry unable to upload your file, Please try after some time."}';
			exit(0);
		}
}
//upload single file any extensions

function upload_file($fieldname, $uploadpath) {	
	$file_name = time().$_FILES[$fieldname]['name'];
	if(move_uploaded_file($_FILES[$fieldname]["tmp_name"], $uploadpath.$file_name)) {
		return $file_name;
	} else {
		echo '{"error":"true", "htmlcontent":"Sorry unable to upload your file, Please try after some time."}';
		exit(0);
	}
}

//upload multiple files with any extensions
function upload_multiplefile($fieldname, $uploadpath, $index) {	
	$file_name = time().$_FILES[$fieldname]['name'][$index];
	if(move_uploaded_file($_FILES[$fieldname]["tmp_name"][$index], $uploadpath.$file_name)) {
		return $file_name;
	} else {
		echo '{"error":"true", "htmlcontent":"Sorry unable to upload your pictures"}';
		exit(0);
	}
}

//FUNCTION TO RESIZE IMAGES
function imageResize($width, $height, $target) {

	if ($width <= $target && $height <= $target)
	{
		return "width=\"$width\" height=\"$height\"";
	}
	
	//takes the larger size of the width and height and applies the formula accordingly... dynamically with any size image
	
	if ($width > $height) {
		$percentage = ($target / $width);
	}
	else {
		$percentage = ($target / $height);
	}
	
	//gets the new value and applies the percentage, then rounds the value
	$width = round($width * $percentage);
	$height = round($height * $percentage);
	
	//returns the new sizes in html image tag format...this is so you can plug this function inside an image tag and just get the
	return "width=\"$width\" height=\"$height\"";
}
//function return only width and hieght separated by :
function imageResize_4_js($width, $height, $target) {

	if ($width <= $target && $height <= $target)
	{
		//return "width=\"$width\" height=\"$height\"";
		return $width.":".$height;
	}
	
	//takes the larger size of the width and height and applies the formula accordingly... dynamically with any size image
	
	if ($width > $height) {
		$percentage = ($target / $width);
	}
	else {
		$percentage = ($target / $height);
	}
	
	//gets the new value and applies the percentage, then rounds the value
	$width = round($width * $percentage);
	$height = round($height * $percentage);
	
	//returns the new sizes in html image tag format...this is so you can plug this function inside an image tag and just get the
	return $width.":".$height;
}


// CALL TO FUNCTION
//$myimg = getimagesize($row_res['image']);
//<img src="<?php echo $row_res['image'];/ <?php //echo imageResize($myimg[0], $myimg[1], 150); /

function resize_png_image($img,$newWidth,$newHeight,$target){
    $srcImage=imagecreatefrompng($img);
    if($srcImage==''){
        return FALSE;
    }
    $srcWidth=imagesx($srcImage);
    $srcHeight=imagesy($srcImage);
    $percentage=(double)$newWidth/$srcWidth;
    $destHeight=round($srcHeight*$percentage)+1;
    $destWidth=round($srcWidth*$percentage)+1;
    if($destHeight > $newHeight){
        // if the width produces a height bigger than we want, calculate based on height
        $percentage=(double)$newHeight/$srcHeight;
        $destHeight=round($srcHeight*$percentage)+1;
        $destWidth=round($srcWidth*$percentage)+1;
    }
    $destImage=imagecreatetruecolor($destWidth-1,$destHeight-1);
    if(!imagealphablending($destImage,FALSE)){
        return FALSE;
    }
    if(!imagesavealpha($destImage,TRUE)){
        return FALSE;
    }
    if(!imagecopyresampled($destImage,$srcImage,0,0,0,0,$destWidth,$destHeight,$srcWidth,$srcHeight)){
        return FALSE;
    }
    if(!imagepng($destImage,$target)){
        return FALSE;
    }
    imagedestroy($destImage);
    imagedestroy($srcImage);
    return TRUE;
}
function addwatermark($target_image, $destination, $h_pos='center', $v_pos='center') {
	// $wm_size should be larger, 1 ( 1 is perfect )
	$disp_width_max=150;                    // used when displaying watermark choices
    $disp_height_max=80;                    // used when displaying watermark choices
    $edgePadding=15;                        // used when placing the watermark near an edge
    $quality=100;                           // used when generating the final image
    $default_watermark='watermark.png';  // the default image to use if no watermark was chosen
	//$v_position = 'center';
	//$h_position = 'center';
	$h_position = $h_pos;
	$v_position = $v_pos;
	$wm_size = 1;
	
			// file upload success
            $size=getimagesize($target_image);
            if($size[2]==2 || $size[2]==3){
                // it was a JPEG or PNG image, so we're OK so far
                
                $original = $target_image;
                //$target_name= date('YmdHis').'_'.preg_replace('`[^a-z0-9-_.]`i','',$_FILES['watermarkee']['name']);
                    // if you change this regex, be sure to change it in generated-images.php:26
                $target_name = basename($target_name);
                //$target=dirname(__FILE__).'/results/'.$target_name;
				$target= $destination;
                $watermark= ROOT_IMAGES_FLDR.$default_watermark;
                //$wmTarget= $watermark.'.tmp';
				$wmTarget= TEMP_FOLDER.$default_watermark;

                $origInfo = getimagesize($original); 
                $origWidth = $origInfo[0]; 
                $origHeight = $origInfo[1]; 

                $waterMarkInfo = getimagesize($watermark);
                $waterMarkWidth = $waterMarkInfo[0];
                $waterMarkHeight = $waterMarkInfo[1];
        
                // watermark sizing info
                if($wm_size =='larger') {
                    $placementX=0;
                    $placementY=0;
                    $h_position='center';
                    $v_position='center';
                	$waterMarkDestWidth=$waterMarkWidth;
                	$waterMarkDestHeight=$waterMarkHeight;
                    
                    // both of the watermark dimensions need to be 5% more than the original image...
                    // adjust width first.
                    if($waterMarkWidth > $origWidth*1.05 && $waterMarkHeight > $origHeight*1.05){
                    	// both are already larger than the original by at least 5%...
                    	// we need to make the watermark *smaller* for this one.
                    	
                    	// where is the largest difference?
                    	$wdiff=$waterMarkDestWidth - $origWidth;
                    	$hdiff=$waterMarkDestHeight - $origHeight;
                    	if($wdiff > $hdiff){
                    		// the width has the largest difference - get percentage
                    		$sizer=($wdiff/$waterMarkDestWidth)-0.05;
                    	}else{
                    		$sizer=($hdiff/$waterMarkDestHeight)-0.05;
                    	}
                    	$waterMarkDestWidth-=$waterMarkDestWidth * $sizer;
                    	$waterMarkDestHeight-=$waterMarkDestHeight * $sizer;
                    }else{
                    	// the watermark will need to be enlarged for this one
                    	
                    	// where is the largest difference?
                    	$wdiff=$origWidth - $waterMarkDestWidth;
                    	$hdiff=$origHeight - $waterMarkDestHeight;
                    	if($wdiff > $hdiff){
                    		// the width has the largest difference - get percentage
                    		$sizer=($wdiff/$waterMarkDestWidth)+0.05;
                    	}else{
                    		$sizer=($hdiff/$waterMarkDestHeight)+0.05;
                    	}
                    	$waterMarkDestWidth+=$waterMarkDestWidth * $sizer;
                    	$waterMarkDestHeight+=$waterMarkDestHeight * $sizer;
                    }
                }else{
	                $waterMarkDestWidth=round($origWidth * floatval($wm_size));
	                $waterMarkDestHeight=round($origHeight * floatval($wm_size));
	                if($wm_size==1){
	                    $waterMarkDestWidth-=2*$edgePadding;
	                    $waterMarkDestHeight-=2*$edgePadding;
	                }
                }

                // OK, we have what size we want the watermark to be, time to scale the watermark image
                resize_png_image($watermark,$waterMarkDestWidth,$waterMarkDestHeight,$wmTarget);
                
                // get the size info for this watermark.
                $wmInfo=getimagesize($wmTarget);
                $waterMarkDestWidth=$wmInfo[0];
                $waterMarkDestHeight=$wmInfo[1];

                $differenceX = $origWidth - $waterMarkDestWidth;
                $differenceY = $origHeight - $waterMarkDestHeight;

                // where to place the watermark?
                switch($h_position){
                    // find the X coord for placement
                    case 'left':
                        $placementX = $edgePadding;
                        break;
                    case 'center':
                        $placementX =  round($differenceX / 2);
                        break;
                    case 'right':
                        $placementX = $origWidth - $waterMarkDestWidth - $edgePadding;
                        break;
                }

                switch($v_position){
                    // find the Y coord for placement
                    case 'top':
                        $placementY = $edgePadding;
                        break;
                    case 'center':
                        $placementY =  round($differenceY / 2);
                        break;
                    case 'bottom':
                        $placementY = $origHeight - $waterMarkDestHeight - $edgePadding;
                        break;
                }
       
                if($size[2]==3)
                    $resultImage = imagecreatefrompng($original);
                else
                    $resultImage = imagecreatefromjpeg($original);
                imagealphablending($resultImage, TRUE);
        
                $finalWaterMarkImage = imagecreatefrompng($wmTarget);
                $finalWaterMarkWidth = imagesx($finalWaterMarkImage);
                $finalWaterMarkHeight = imagesy($finalWaterMarkImage);
        
                imagecopy($resultImage,
                          $finalWaterMarkImage,
                          $placementX,
                          $placementY,
                          0,
                          0,
                          $finalWaterMarkWidth,
                          $finalWaterMarkHeight
                );
                
                if($size[2]==3){
                    imagealphablending($resultImage,FALSE);
                    imagesavealpha($resultImage,TRUE);
                    imagepng($resultImage,$target,$quality);
                }else{
                    imagejpeg($resultImage,$target,$quality); 
                }

                imagedestroy($resultImage);
                imagedestroy($finalWaterMarkImage);
			} // end of if $size == 2 or 3
} //end of function

function clean_string($string)
{
	// Replace other special chars
	$specialCharacters = array('#' => '','$' => '','%' => '','&' => '','@' => '','.' => '','Ä' => '','+' => '','=' => '','ß' => '','/' => '', ' '=>' ' );
	 
	while (list($character, $replacement) = each($specialCharacters)) {
		$string = str_replace($character, $replacement, $string);
	}
	 
	$string = strtr($string,
	"¿¡¬√ƒ≈? ·‚„‰Â“”‘’÷ÿÚÛÙıˆ¯»… ÀËÈÍÎ«ÁÃÕŒœÏÌÓÔŸ⁄€‹˘˙˚¸ˇ—Ò",
	"AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"
	);
	 
	// Remove all remaining other unknown characters
	$string = preg_replace('/[^a-zA-Z0-9-]/', '', $string);
	$string = preg_replace('/^[-]+/', '', $string);
	$string = preg_replace('/[-]+$/', '', $string);
	$string = preg_replace('/[-]{2,}/', '', $string);
	 
	return $string;
}

//prevent sql injection method
if (!function_exists("GetSQLValueString")) {
       function GetSQLValueString($theValue, $theType, $theDefinedValue =
"", $theNotDefinedValue = "") {
         if (PHP_VERSION < 6) {
               $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
         }
         $theValue = function_exists("mysql_real_escape_string") ?
mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
		
         switch ($theType) {
               case "text":
                 //$theValue = ($theValue != "") ? utf8_encode($theValue) : "NULL";				 
				 $theValue = ($theValue != "") ? $theValue : "NULL";				 
                 break;
               case "long":
               case "int":
                 $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                 break;
               case "double":
                 $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                 break;
               case "date":
                 $theValue = ($theValue != "") ? $theValue : "NULL";
                 break;
               case "defined":
                 $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                 break;
         }
         return trim($theValue);
       }
}
function render_menu($catid) {	
	global $db;	
	$sub_cat = mysql_query("select * from menu_master where parent_id='".$catid."' and active='1' and show_in_menu='1' order by display_order ");
	if(mysql_num_rows($sub_cat) > 0 ) {		
		$output .='<ul id="menu" >'."\n";
			while($row_res = mysql_fetch_array($sub_cat)) {
				$res_count_sub = mysql_query("select count(menu_id) as count_rows from menu_master where active='1' and  parent_id='".$row_res['menu_id']."' and show_in_menu='1' ");				
				$row_count = mysql_fetch_array($res_count_sub);	
				
				if($row_res['menu_type'] == 'PAGE') {
					if($page_row = $db->get_row("select * from page_master where menu_id='".$row_res['menu_id']."' ") ) {
						if(strtolower($row_res['menu_title']) == 'home' || strtolower($row_res['menu_title']) == 'index' || count($page_row) <= 0 ) {
							$page_link = SITE_ROOT;
						} else {
							$page_link = SITE_ROOT."pages.php?mid=".$row_res['menu_id'] ;					
						}	
					} else  {
						$page_link = SITE_ROOT;
					}
				} else if($row_res['menu_type'] == 'NEWS') {
					if($row_res['parent_id'] == 0 ) {
						$page_link = SITE_ROOT."news.php?show=default&mid=".$row_res['menu_id'] ;
					} else {
						$page_link = SITE_ROOT."news.php?mid=".$row_res['menu_id'] ;
					}
				} else if($row_res['menu_type'] == 'CEO JOURNAL') {
					if($row_res['parent_id'] == 0 ) {
						$page_link = SITE_ROOT."ceo-journal.php?show=default&mid=".$row_res['menu_id'] ;
					} else {
						$page_link = SITE_ROOT."ceo-journal.php?mid=".$row_res['menu_id'] ;
					}
				} else if($row_res['menu_type'] == 'DOCUMENT') {
					if($row_res['parent_id'] == 0 ) {
						$page_link = SITE_ROOT."documents.php?show=default&mid=".$row_res['menu_id'] ;
						//$page_link = SITE_ROOT;
					} else {
						$page_link = SITE_ROOT."documents.php?mid=".$row_res['menu_id'] ;
						//$page_link = SITE_ROOT;
					}
				} else {
					$page_link = SITE_ROOT;
				}
				$dash = ($row_res['parent_id'] != 0 ) ? '- ' : '';
				$current_class = ($row_res['menu_id'] == $_REQUEST['mid']) ? 'class="selected"' : '';
				$current_class_parent = ($row_res['menu_id'] == $_REQUEST['pt_id']) ? 'class="selected"' : '';
				$output .= '<li>'."\n"; 
				$output .= '<a href="'.$page_link.'" '.$current_class.' '.$current_class_parent.' >'.$dash . stripslashes($row_res['menu_title']).'</a>';
				$output .= render_menu($row_res['menu_id']);
				$output .= '</li>'."\n";				
			}
		$output .='</ul>';
	}
	return $output;
}
function render_footer_menu($catid) {	
	global $db;	
	$sub_cat = mysql_query("select * from menu_master where parent_id='".$catid."' and active='1' and show_in_footer='1' order by display_order ");
	if(mysql_num_rows($sub_cat) > 0 ) {		
		$output .='<ul>'."\n";
			while($row_res = mysql_fetch_array($sub_cat)) {
				$res_count_sub = mysql_query("select count(menu_id) as count_rows from menu_master where active='1' and  parent_id='".$row_res['menu_id']."' and show_in_footer='1' ");				
				$row_count = mysql_fetch_array($res_count_sub);	
				
				if($row_res['menu_type'] == 'PAGE') {
					if($page_row = $db->get_row("select * from page_master where menu_id='".$row_res['menu_id']."' ") ) {
						if(strtolower($row_res['menu_title']) == 'home' || strtolower($row_res['menu_title']) == 'index' || count($page_row) <= 0 ) {
							$page_link = SITE_ROOT;
						} else {
							$page_link = SITE_ROOT."pages.php?pid=".$row_res['menu_id'] ;					
						}	
					} else  {
						$page_link = SITE_ROOT;
					}
				} else if($row_res['menu_type'] == 'NEWS') {
					if($row_res['parent_id'] == 0 ) {
						$page_link = SITE_ROOT."news.php?show=default&mid=".$row_res['menu_id'] ;
					} else {
						$page_link = SITE_ROOT."news.php?mid=".$row_res['menu_id'] ;
					}
				} else {
					$page_link = SITE_ROOT;
				}
				$dash = ($row_res['parent_id'] != 0 ) ? '- ' : '';
				if($row_res['parent_id'] == 0) {
					$li_class = 'class="category"';
					$a_class = 'class="heading"';
					$dash = '';
				} else {
					$li_class = '';
					$a_class = '';
					$dash = '- ';
				}
							
				$output .= '<li '.$li_class.' >'."\n"; 
				$output .= '<a href="'.$page_link.'" '.$a_class.' >'.$dash . stripslashes($row_res['menu_title']).'</a>';
				$output .= render_menu($row_res['menu_id']);
				$output .= '</li>'."\n";				
			}
		$output .='</ul>';
	}
	return $output;
}
function render_menu_category($catid, $count=0, $sel_id=0, $menu_type=false) {	
	if($menu_type != false) {
		$clause = " and menu_type='".$menu_type."' ";
	}	
	$sub_cat = mysql_query("select * from menu_master where parent_id='".$catid."' ".$clause." order by display_order ");
	$flag = '';
	
	if(mysql_num_rows($sub_cat) > 0 ) {				
			while($row_res = mysql_fetch_array($sub_cat)) {
				$res_count_sub = mysql_query("select count(menu_id) as count_rows from menu_master where parent_id='".$row_res['menu_id']."' ".$clause." order by display_order ");				
				$row_count = mysql_fetch_array($res_count_sub);	
				if($row_res['parent_id'] != 0 ) {					
					//$count = $count+1;
					$flag = '';
					$count = find_level_menu($row_res['parent_id']);
					for($i=0; $i<= $count; $i++) {
						$flag .= '-';
					}
				}
				$sel_menu = ($sel_id == $row_res['menu_id']) ? 'selected="selected"' : '';				
				$output .= '<option value='.$row_res['menu_id'].' '.$sel_menu.' >'; 
				$output .= $flag.stripslashes($row_res['menu_title'])."<br/>";
				$output .= '</option>';
				$output .= render_menu_category($row_res['menu_id'], $count, $sel_id, $menu_type);				
			}		
	}
	return $output;
}
function render_site_category($catid, $count=0, $sel_id=0, $category_type=false, $display_cat_name=false) {	
	if($category_type != false) {
		$clause = " and category_type='".$category_type."' ";
	}	
	$sub_cat = mysql_query("select * from category_master where parent_id='".$catid."' ".$clause." order by display_order ");	
	$flag = '';
	//$count = $count+1;
	if(mysql_num_rows($sub_cat) > 0 ) {				
			while($row_res = mysql_fetch_array($sub_cat)) {
				$res_count_sub = mysql_query("select count(category_id) as count_rows from category_master where parent_id='".$row_res['category_id']."' ".$clause." order by display_order ");				
				$row_count = mysql_fetch_array($res_count_sub);	
				if($row_res['parent_id'] != 0 ) {
					$flag = '';
					$count = find_level_category($row_res['parent_id']);
					for($i=0; $i<= $count; $i++) {
						$flag .= '-';
					}
				}
				if($display_cat_name == true) {
					$cat_type = " (".ucfirst(strtolower($row_res['category_type'])).")";
				} else {
					$cat_type = '';
				}
				$sel_menu = ($sel_id == $row_res['category_id']) ? 'selected="selected"' : '';				
				$output .= '<option value='.$row_res['category_id'].' '.$sel_menu.'  >'; 
				$output .= $flag.stripslashes($row_res['category_name']).$cat_type;
				$output .= '</option>';
				$output .= render_site_category($row_res['category_id'], $count, $sel_id, $category_type, $display_cat_name);				
			}		
	}
	return $output;
}
function find_level_menu($parent_id) {	
	global $db;	
	if($row = $db->get_row("select * from menu_master where menu_id='".$parent_id."'")) {		
		$counter++;
		$counter += find_level_menu($row->parent_id);
	}
	return $counter;
}
function find_level_category($parent_id) {	
	global $db;	
	if($row = $db->get_row("select * from category_master where category_id='".$parent_id."'")) {		
		$counter++;
		$counter += find_level_category($row->parent_id);
	}
	return $counter;
}

//for site map
function render_menu1($catid, $atrib='') {	

	global $db;
	global $htaccess;
	
	$sub_cat = mysql_query("select * from menu_master where parent_id='".$catid."' and active='1' and show_in_menu='1' order by display_order ");
	if(mysql_num_rows($sub_cat) > 0 ) {		
		$output .='<ul>'."\n";
			while($row_res = mysql_fetch_array($sub_cat)) {
				$res_count_sub = mysql_query("select count(menu_id) as count_rows from menu_master where active='1' and  parent_id='".$row_res['menu_id']."' and show_in_menu='1' ");				
				$row_count = mysql_fetch_array($res_count_sub);	
				//$li_separtor = ($row_res['parent_id'] == 0 ) ? '<li class="last1"><img src="'.SITE_URL.ROOT_IMAGES.'slider_01.gif" width="2" height="37" /></li>' : '';				
				if($row_res['menu_type'] == 'PAGE') {
					$page_row = $db->get_row("select * from page_master where menu_id='".$row_res['menu_id']."' ");
					if(strtolower($row_res['menu_title']) == 'home' || strtolower($row_res['menu_title']) == 'index' || count($page_row) <= 0 ) {
						$page_link = '#';
					} else {
						$page_link = ($htaccess == true) ? stripslashes(SITE_ROOT.$page_row->page_url) : SITE_ROOT."pages.php?pid=".$row_res['menu_id'] ;					
					}		
				} else if($row_res['menu_type'] == 'NEWS') {
					$page_link = ($htaccess == true) ? SITE_ROOT.strtolower($row_res['menu_type'])."/" : SITE_ROOT."news1.php" ;
				}
				else if($row_res['menu_type'] == 'FORM') {
					$page_link = ($htaccess == true) ? SITE_ROOT.strtolower($row_res['menu_type'])."/" : SITE_ROOT."get_a_quotes.php" ;
				}
				else if($row_res['menu_type'] == 'CONTACTFORM') {
					$page_link = ($htaccess == true) ? SITE_ROOT.strtolower($row_res['menu_type'])."/" : SITE_ROOT."contacts.php" ;
				}
				
				//$current_class = ($row_res['menu_id'] == $_REQUEST['pid']) ? 'class="current"' : '';
				$parent_id = $db->get_var("select parent_id from menu_master where menu_id='".$row_res['menu_id']."' ");
				
					//$current_class = ($row_res['menu_id'] == $_REQUEST['pt_id']) ? 'class="current"' : '';					
				
				
				//$current_class =  'class="current"';
				$output .= '<li>'."\n"; 
				$output .= '<a href="'.$page_link.'" >'.stripslashes($row_res['menu_title']).'</a>';
				$output .= render_menu1($row_res['menu_id']);
				$output .= '</li>'."\n";
				$output .= $li_separtor."\n";
			}
		$output .='</ul>';
	}
	return $output;
}

//for department
function render_department($catid, $count=0, $sel_id=0, $is_array=false) {	
	global $db;
	$sub_cat = mysql_query("select * from departments where parent_id='".$catid."' order by display_order ");
	$flag = '';
	
	if(mysql_num_rows($sub_cat) > 0 ) {				
			while($row_res = mysql_fetch_array($sub_cat)) {
				$res_count_sub = mysql_query("select count(dept_id) as count_rows from departments where parent_id='".$row_res['dept_id']."'  order by display_order ");				
				$row_count = mysql_fetch_array($res_count_sub);	
				if($row_res['parent_id'] != 0 ) {					
					//$count = $count+1;
					$flag = '';
					$count = find_level_department($row_res['parent_id']);
					for($i=0; $i<= $count; $i++) {
						$flag .= '-';
					}
				}
				if($is_array != true) {
					$sel_menu = ($sel_id == $row_res['dept_id']) ? 'selected="selected"' : '';
				} else {
					$sel_menu = (in_array($row_res['dept_id'], $sel_id))  ? 'selected="selected"' : '';
				}
				$output .= '<option value='.$row_res['dept_id'].' '.$sel_menu.' >'; 
				$output .= $flag.stripslashes($row_res['department_name'])."<br/>";
				$output .= '</option>';
				$output .= render_department($row_res['dept_id'], $count, $sel_id, $is_array);				
			}		
	}
	return $output;
}
function find_level_department($parent_id) {	
	global $db;	
	if($row = $db->get_row("select * from departments where dept_id='".$parent_id."'")) {		
		$counter++;
		$counter += find_level_department($row->parent_id);
	}
	return $counter;
}
//for roles
function render_role($catid, $count=0, $sel_id=0) {	
	global $db;
	$sub_cat = mysql_query("select * from roles where parent_id='".$catid."' order by display_order ");
	$flag = '';
	
	if(mysql_num_rows($sub_cat) > 0 ) {				
			while($row_res = mysql_fetch_array($sub_cat)) {
				$res_count_sub = mysql_query("select count(role_id) as count_rows from roles where parent_id='".$row_res['role_id']."'  order by display_order ");				
				$row_count = mysql_fetch_array($res_count_sub);	
				if($row_res['parent_id'] != 0 ) {					
					//$count = $count+1;
					$flag = '';
					$count = find_level_role($row_res['parent_id']);
					for($i=0; $i<= $count; $i++) {
						$flag .= '-';
					}
				}
				$sel_menu = ($sel_id == $row_res['role_id']) ? 'selected="selected"' : '';				
				$output .= '<option value='.$row_res['role_id'].' '.$sel_menu.' >'; 
				$output .= $flag.stripslashes($row_res['role_name'])."<br/>";
				$output .= '</option>';
				$output .= render_role($row_res['role_id'], $count, $sel_id);				
			}		
	}
	return $output;
}
function find_level_role($parent_id) {	
	global $db;	
	if($row = $db->get_row("select * from roles where role_id='".$parent_id."'")) {		
		$counter++;
		$counter += find_level_role($row->parent_id);
	}
	return $counter;
}

//to check user permission for admin panel
function checkuserpermission($userid, $section_name, $page_name=false, $perm_lbl=false) {
	global $db;	
	if($page_name) {
		$pg_sql = " and page_name='".$page_name."' ";
	} 
	if($perm_lbl) {
		$pm_sql = " and permission_label='".$perm_lbl."' ";
	}
	if($result = $db->get_results("select * from user_panel_permission where usermaster_id='".$userid."' and perm_id in (select perm_id from user_perm_master where section_name='".$section_name."' ".$pg_sql.$pm_sql." ) ")) {
		return true;
	} else {
		return false;
	}
}

//function to display award price without entry fee, logo fee
function calculate_award_price($assign_id) {
	global $db;
	$row = $db->get_row("select * from assignment where assign_id='".$assign_id."' ");
	$listing_fee = $db->get_var("select p_values from general_setting where id='8' ");
	if($row->is_logo == 1) {
		$logo_price = $db->get_var("select p_values from general_setting where id='7' ");	
	} else {
		$logo_price = 0;
	}
	$award = $row->total_award - ($listing_fee + $logo_price);
	return $award;
}

function placecodemaker($tablename,$tablefield,$place){
	global $db;
	$placecode_cid = array();
	//$cplace = strtoupper(substr($_REQUEST['txtcityplace'], 0, 3)); 
	$placecode = strtoupper(substr($place, 0, 3));
	$placecode_cid['placecode'] = $placecode;
	//$row = $db->get_row("SELECT count( * ) as countcity FROM tb_citymaster WHERE city_name_al = '".$cplace."'");
	  $row = $db->get_row("SELECT count( * ) as countfield FROM ".$tablename." WHERE ".$tablefield." = '".$placecode."'");
	  $rowcount = $row->countfield + 1;
	
	if($rowcount < 100 ){
		$cid = str_pad($rowcount, 3, '0', STR_PAD_LEFT);
	}
	else{
		$cid = $rowcount;
	}
	
	$placecode_cid['cid'] = $cid;
	return $placecode_cid;
}

function checkTonerCapacity(){
	global $db;
	$rowToner = $db->get_row("select toner_leaves_capacity from tb_cps_settings");
	if($rowToner->toner_leaves_capacity <= 100 ){
		$respT=array("status"=>false,"count"=>$rowToner->toner_leaves_capacity);
	}
	else{
		$respT=array("status"=>true,"count"=>$rowToner->toner_leaves_capacity);
	}
	return $respT;
}
?>
