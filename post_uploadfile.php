<?php
require_once 'Excel/reader.php';

require_once 'global.php';
error_reporting(E_ALL ^ E_NOTICE);
$row = $db->get_row("SELECT inputfolderpath,inputfileformat,inputfiledelimiter,typeofprinter,archivefolderpath,license_install_date,license_end_date FROM tb_cps_settings");
$bankmapfields = $db->get_results("SELECT * FROM tb_cps_mapbankfields");
$inputfolderpath = $row->inputfolderpath;
$archivefolderpath = $row->archivefolderpath;
$inputfileformat = $row->inputfileformat;
$inputfiledelimiter = $row->inputfiledelimiter;
$installdate = $row->license_install_date;
$licenceenddate = $row->license_end_date;

if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'print') && !empty($_REQUEST['pid']) && isset($_REQUEST['pid']) ) {
	$db->query("Insert Into tb_pending_print_req (cps_unique_req,cps_micr_code,cps_branchmicr_code,cps_account_no,cps_act_name,cps_no_of_books,cps_dly_bearer_order,cps_book_size,cps_tr_code,cps_atpar,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_state,cps_country,cps_emailid,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_ifsc_code,cps_chq_no_from,cps_chq_no_to,cps_micr_account_no,cps_date,cps_process_user_id,cps_bsr_code,cps_pr_code,cps_short_name) SELECT cps_unique_req,cps_micr_code,cps_branchmicr_code,cps_account_no,cps_act_name,cps_no_of_books,cps_dly_bearer_order,cps_book_size,cps_tr_code,cps_atpar,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_state,cps_country,cps_emailid,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_ifsc_code,cps_chq_no_from,cps_chq_no_to,cps_micr_account_no,cps_date,cps_process_user_id,cps_bsr_code,cps_pr_code,cps_short_name from tb_uploadingdata WHERE id IN (".$_REQUEST['pid'].")");
	$db->query("update tb_pending_print_req set cps_isprint = 1");
	$db->query("delete from tb_uploadingdata where id IN (".$_REQUEST['pid'].")");
	
	header('Location: confirmprintreq.php');	
}
else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delete') && !empty($_REQUEST['pid']) && isset($_REQUEST['pid']) ){
	$db->query("delete from tb_uploadingdata where id IN (".$_REQUEST['pid'].")");
	header('Location: uploadfile.php');	
}


//================== Code for uploading and inserting file data====================

if(@$_FILES['uploadedfile']['name']!='')
{
	if($_FILES["uploadedfile"]["size"] < 524288) 
	{
		$arrfile = explode(".",$_FILES['uploadedfile']['name']);
		$filetype = $arrfile[count($arrfile)-1];	
		
		if(($filetype == "xls" || $filetype == "xlsx") && $inputfileformat=="Excel")
		{
			processExcelFile();
		}
		else if($filetype == "asc" && $inputfileformat=="ASCII")
		{
			processASCIIFile();
		}
		else if($filetype == "csv" && $inputfileformat=="CSV")
		{
			processASCIIFile();
		}
		else
		{
			echo "0#<span class='red'>Please upload file in ".$inputfileformat." format1</span>";
			exit();
		}
	}
	else
	{
		 echo "0#<span class='red'>Please upload file which have size less then 500kb</span>";
		 exit();
	}
}
else
{
	FetchUploadedFiles();
}



//=======================Check Date=========================
function valid_date($date, $format = 'DD-MM-YYYY'){
    if(strlen($date) >= 8 && strlen($date) <= 10){
        $separator_only = str_replace(array('M','D','Y'),'', $format);
        $separator = $separator_only[0];
        if($separator){
            $regexp = str_replace($separator, "\\" . $separator, $format);
            $regexp = str_replace('MM', '(0[1-9]|1[0-2])', $regexp);
            $regexp = str_replace('M', '(0?[1-9]|1[0-2])', $regexp);
            $regexp = str_replace('DD', '(0[1-9]|[1-2][0-9]|3[0-1])', $regexp);
            $regexp = str_replace('D', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp);
            $regexp = str_replace('YYYY', '\d{4}', $regexp);
            $regexp = str_replace('YY', '\d{2}', $regexp);
            if($regexp != $date && preg_match('/'.$regexp.'$/', $date)){
                foreach (array_combine(explode($separator,$format), explode($separator,$date)) as $key=>$value) {
                    if ($key == 'YY') $year = '20'.$value;
                    if ($key == 'YYYY') $year = $value;
                    if ($key[0] == 'M') $month = $value;
                    if ($key[0] == 'D') $day = $value;
                }
                if (checkdate($month,$day,$year)) return true;
            }
        }
    }
    return false;
}

function processExcelFile()
{
	global $db,$bankmapfields,$archivefolderpath,$installdate,$licenceenddate;
	
	//$target_path = $archivefolderpath.basename( $_FILES['uploadedfile']['name']);
	$target_path = "uploads/".$_FILES['uploadedfile']['name'];
	$data = new Spreadsheet_Excel_Reader();
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
	{
		$data->read($target_path);
		error_reporting(E_ALL ^ E_NOTICE);	
		$arrayexcelcolumns = $data->sheets[0]['cells'][1];
		$uniquereqreqcollection = "";
		$uniquereqreqcollectionArr[] = ''; 
		$error = false;
		
		$chk_sys = '0';
		$row = $db->get_row("SELECT chk_taken_from FROM tb_cps_settings");
		if($row->chk_taken_from == "1"){
			$chk_sys = '1';
		}
		
		
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
		{
			if($uniquereqreqcollection!="")
			{
				$uniquereqreqcollection .= ",".$data->sheets[0]['cells'][$i][1];
			}
			else
			{
				$uniquereqreqcollection = $data->sheets[0]['cells'][$i][1];
			}
			
			
			if (in_array($data->sheets[0]['cells'][$i][1], $uniquereqreqcollectionArr)) {				
				echo "<span class='red'>This File Contain Duplicate Unique Request No.<br /></span>";	
				die();
			}else{
				$uniquereqreqcollectionArr[$i] = $data->sheets[0]['cells'][$i][1];
			}
			
			if($result = $db->get_results("SELECT branch_code FROM tb_branchdetails WHERE branch_code = '".$data->sheets[0]['cells'][$i][20]."'"))
			{
				if($chk_sys == '1'){
					if($result = $db->get_results("SELECT series_transationcode FROM tb_cps_chequeseries WHERE series_transationcode = '".$data->sheets[0]['cells'][$i][24]."' and serise_branchcode_branch = '".$data->sheets[0]['cells'][$i][20]."'"))
					{
						
					}
					else
					{
						echo "<span class='red'>This File Do Not Contain Cheque Serise For File Branch Code. Please Create Cheque Serise For Branch.<br /></span>";	
						die();
					}					
				}
			}
			else{
				echo "<span class='red'>This File Contain Branch Code That Doesen't Exists In Branch Master. <br /></span>";	
				die();
			}
		}
		
		if($data->sheets[0]['numCols']==33)
		{
			$db->query("DELETE FROM tb_printque");
			$db->query("UPDATE tb_pending_print_req SET cps_isprint = 0 WHERE cps_isprint = 1");
		
			if($result = $db->get_results("SELECT cps_unique_req FROM tb_print_req_collection WHERE cps_unique_req IN (".$uniquereqreqcollection.")"))
			{								
				echo "<span class='red'>This File Contain Sucessfully Printed Reports <br /></span>";					
			}		
			else if($result = $db->get_results("SELECT cps_unique_req FROM tb_pending_print_req WHERE cps_unique_req IN (".$uniquereqreqcollection.");"))
			{
				echo "<span class='red'>This File Contain Pending Request<br /></span>";				
			}
			else if($result = $db->get_results("SELECT cps_unique_req FROM tb_printque WHERE cps_unique_req IN (".$uniquereqreqcollection.")"))							
			{
				echo "<span class='red'>This File Contain Pending Request</span>";				
			}							
			else if($result = $db->get_results("SELECT cps_unique_req FROM tb_uploadingdata WHERE cps_unique_req IN (".$uniquereqreqcollection.")"))
			{										
				echo "<span class='red'>You Have Already Uploaded Request<br /></span>";
			}	
			else
			{
				for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
				{			
					$insertvalues = "";
					
					if($data->sheets[0]['cells'][$i][1] != "")
					{
						$branchCode = "";
						if(strlen($data->sheets[0]['cells'][$i][20]) == "5")
							$branchCode = substr($data->sheets[0]['cells'][$i][20], -3);
						else
							$branchCode = $data->sheets[0]['cells'][$i][20];
					
						
						$insertvalues =   '"'.$data->sheets[0]['cells'][$i][1].'","'.$data->sheets[0]['cells'][$i][2].'","'.$data->sheets[0]['cells'][$i][3].'","'.$data->sheets[0]['cells'][$i][4].'","'.$data->sheets[0]['cells'][$i][5].'","'.$data->sheets[0]['cells'][$i][6].'","'.$data->sheets[0]['cells'][$i][7].'","'.$data->sheets[0]['cells'][$i][8].'","'.$data->sheets[0]['cells'][$i][9].'","'.$data->sheets[0]['cells'][$i][10].'","'.$data->sheets[0]['cells'][$i][11].'","'.$data->sheets[0]['cells'][$i][12].'","'.$data->sheets[0]['cells'][$i][13].'","'.$data->sheets[0]['cells'][$i][14].'","'.$data->sheets[0]['cells'][$i][15].'","'.$data->sheets[0]['cells'][$i][16].'","'.$data->sheets[0]['cells'][$i][17].'","'.str_pad($data->sheets[0]['cells'][$i][18], 3, "0", STR_PAD_LEFT).str_pad($data->sheets[0]['cells'][$i][19], 3, "0", STR_PAD_LEFT).str_pad($branchCode, 3, "0", STR_PAD_LEFT).'","'.$data->sheets[0]['cells'][$i][21].'","'.substr(str_pad($data->sheets[0]['cells'][$i][23], 3, "0", STR_PAD_LEFT),-6).'","'.$data->sheets[0]['cells'][$i][23].'","'.$data->sheets[0]['cells'][$i][24].'","'.$data->sheets[0]['cells'][$i][25].'","'.$data->sheets[0]['cells'][$i][26].'","'.$data->sheets[0]['cells'][$i][27].'","'.$data->sheets[0]['cells'][$i][28].'","'.$data->sheets[0]['cells'][$i][29].'","'.$data->sheets[0]['cells'][$i][30].'","'.$data->sheets[0]['cells'][$i][31].'","'.date("Y-m-d").'","'.$_SESSION["admin_id"].'","'.$data->sheets[0]['cells'][$i][20].'","'.$data->sheets[0]['cells'][$i][33].'"';
						//$insertvalues = "'".$data->sheets[0]['cells'][$i][1]."','".$data->sheets[0]['cells'][$i][2]."','".$data->sheets[0]['cells'][$i][3]."','".$data->sheets[0]['cells'][$i][4]."','".$data->sheets[0]['cells'][$i][5]."','".$data->sheets[0]['cells'][$i][6]."','".$data->sheets[0]['cells'][$i][7]."','".$data->sheets[0]['cells'][$i][8]."','".$data->sheets[0]['cells'][$i][9]."','".$data->sheets[0]['cells'][$i][10]."','".$data->sheets[0]['cells'][$i][11]."','".$data->sheets[0]['cells'][$i][12]."','".$data->sheets[0]['cells'][$i][13]."','".$data->sheets[0]['cells'][$i][14]."','".$data->sheets[0]['cells'][$i][15]."','".$data->sheets[0]['cells'][$i][16]."','".$data->sheets[0]['cells'][$i][17]."','".str_pad($data->sheets[0]['cells'][$i][18], 3, "0", STR_PAD_LEFT).str_pad($data->sheets[0]['cells'][$i][19], 3, "0", STR_PAD_LEFT).str_pad($branchCode, 3, "0", STR_PAD_LEFT)."','".$data->sheets[0]['cells'][$i][21]."','".substr(str_pad($data->sheets[0]['cells'][$i][23], 3, "0", STR_PAD_LEFT),-6)."','".$data->sheets[0]['cells'][$i][23]."','".$data->sheets[0]['cells'][$i][24]."','".$data->sheets[0]['cells'][$i][25]."','".$data->sheets[0]['cells'][$i][26]."','".$data->sheets[0]['cells'][$i][27]."','".$data->sheets[0]['cells'][$i][28]."','".$data->sheets[0]['cells'][$i][29]."','".$data->sheets[0]['cells'][$i][30]."','".$data->sheets[0]['cells'][$i][31]."','".date("Y-m-d")."','".$_SESSION["admin_id"]."','".$data->sheets[0]['cells'][$i][20]."','".$data->sheets[0]['cells'][$i][33]."'";						
						$insertcolumns = "cps_unique_req,cps_act_name,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_micr_code,cps_bsr_code,cps_micr_account_no,cps_account_no,cps_tr_code,cps_no_of_books,cps_book_size,cps_chq_no_from,cps_chq_no_to,cps_dly_bearer_order,cps_atpar,cps_pr_code,cps_date,cps_process_user_id,cps_branchmicr_code,cps_short_name";
						
						$db->query("INSERT INTO tb_uploadingdata (".$insertcolumns.") VALUES (".$insertvalues.")");													
					}
				}
			}
			
			FetchUploadedFiles();
			$db->closeDb();
			exit();
		// }
			
		}
		else
		{
			echo "0#<span class='red'>1There was an error in file data, please check the file and try again!</span>";
			exit();
		}
		
	}
	else
	{
		echo "0#<span class='red'>There was an error uploading the file, please try again!</span>";
		exit();
	}
}



//=======================Process file type ASCII=========================

function processASCIIFile()
{
	global $db,$bankmapfields,$archivefolderpath,$inputfiledelimiter,$inputfolderpath,$installdate,$licenceenddate;
	if($inputfiledelimiter == "Colon" )
		$inputfiledelimiter=":";
	else if($inputfiledelimiter == "SemiColon" )
		$inputfiledelimiter=";";
	else if($inputfiledelimiter == "Tild" )
		$inputfiledelimiter="~";
	else if($inputfiledelimiter == "Pipe" )
		$inputfiledelimiter="|";
	
	$target_path = $archivefolderpath.basename( $_FILES['uploadedfile']['name']);
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
	{
		$uniquereqreqcollection = "";
		if (($handle = fopen($target_path, "r")) !== FALSE) 
		{	
			$arraycolumns = "";
			$counter=1;
			$error = false;
			while (($data = fgetcsv($handle, 0, $inputfiledelimiter)) !== FALSE) 
			{
				//echo count($data);
				//die();
				if(count($data)==32)
				{			
					//Get collection of unique request
						
					if($uniquereqreqcollection!="")
					{
						$uniquereqreqcollection .= ",".$data[0];
					}
					else
					{
						$uniquereqreqcollection = $data[0];
					}
					
					if($error)
					{
						break;
					}					
				}
				else
				{
					$error = true;
					break;
				}
				$counter++;
			}
		}
		if($error==false)
		{
			if (($handle = fopen($target_path, "r")) !== FALSE) 
			{	
				$db->query("DELETE FROM tb_printque");
				$db->query("UPDATE tb_pending_print_req SET cps_isprint = 0 WHERE cps_isprint = 1");
				$arraycolumns = "";
				$counter=1;
				while (($data = fgetcsv($handle, 0, $inputfiledelimiter)) !== FALSE) 
				{
					
					$arrayvalue = $data;
					$insertcolumns = "";
					$insertvalues = "";
												
					if($result = $db->get_results("SELECT cps_unique_req FROM tb_print_req_collection WHERE cps_unique_req IN (".$arrayvalue[0].")"))
					{								
						echo "<span class='red'>This File Contain Sucessfully Printed Reports With Unique No ".$arrayvalue[0]."<br /></span>";						
					}		
					else if($result = $db->get_results("SELECT cps_unique_req FROM tb_pending_print_req WHERE cps_unique_req IN (".$arrayvalue[0].");"))
					{
						echo "<span class='red'>This File Contain Pending Request With Unique No ".$arrayvalue[0]."<br /></span>";
					}
					else if($result = $db->get_results("SELECT cps_unique_req FROM tb_printque WHERE cps_unique_req IN (".$arrayvalue[0].")"))							
					{
						echo "<span class='red'>This File Contain Pending Request With Unique No ".$arrayvalue[0]."<br /></span>";
					}							
					else if($result = $db->get_results("SELECT cps_unique_req FROM tb_uploadingdata WHERE cps_unique_req IN (".$arrayvalue[0].")"))
					{										
						echo "<span class='red'>You Have Already Uploaded Request With Unique No ".$arrayvalue[0]."<br /></span>";
					}
					else
					{
						$atpar; 							
						if($arrayvalue[29] == "N")
							$atpar = 0;
						else
							$atpar = 1;
							
						$bearOrder;
						if($arrayvalue[28] == "B")
							$bearOrder = 1;
						else
							$bearOrder = 0;
												
						$insertcolumns = "cps_unique_req,cps_act_name,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_micr_code,cps_bsr_code,cps_micr_account_no,cps_account_no,cps_tr_code,cps_no_of_books,cps_book_size,cps_chq_no_from,cps_chq_no_to,cps_dly_bearer_order,cps_atpar,cps_pr_code,cps_date,cps_process_user_id,cps_branchmicr_code";
						$insertvalues = "'".$arrayvalue[0]."','".$arrayvalue[1]."','".$arrayvalue[2]."','".$arrayvalue[3]."','".$arrayvalue[4]."','".$arrayvalue[5]."','".$arrayvalue[6]."','".$arrayvalue[7]."','".$arrayvalue[8]."','".$arrayvalue[9]."','".$arrayvalue[10]."','".$arrayvalue[11]."','".$arrayvalue[12]."','".$arrayvalue[13]."','".$arrayvalue[14]."','".$arrayvalue[15]."','".$arrayvalue[16]."','".$arrayvalue[17].$arrayvalue[18].$arrayvalue[19]."','".$arrayvalue[21]."','".$arrayvalue[22]."','".$arrayvalue[23]."','".$arrayvalue[24]."','".$arrayvalue[25]."','".$arrayvalue[26]."','".$arrayvalue[27]."','".$arrayvalue[28]."','".$arrayvalue[29]."','".$arrayvalue[30]."','".date("Y-m-d")."','".$_SESSION["admin_id"]."','".$arrayvalue[19]."'";						
						$db->query("INSERT INTO tb_uploadingdata (".$insertcolumns.") VALUES (".$insertvalues.")");
					}						
					$counter++;
				}
				
				fclose($handle);
				FetchUploadedFiles();
				$db->closeDb();			
				exit();
			}
			
		}
		else
		{
			echo "0#<span class='red'>2There was an error in file data, please check the file and try again!3</span>";
			exit();
		}
	 
	}
}
//============================== Process File Type EXCEL =======================================



//=======================Function for show uploaded data=========================
function FetchUploadedFiles(){

	global $db;
	$id = 0;
	if($result = $db->get_results("SELECT * FROM tb_uploadingdata where cps_unique_req not in (0)") ){
		$tableinner = '';
		$tableheader = '<tr>
							<th style="background-color: #EDEDED; width:15px"></th>
							<th class="thwidthth">Unique Request No</th>
							<th class="thwidthth">Micr Code</th>							
							<th class="thwidthth">Account No</th>
							<th class="thwidthth">Customer Name</th>
							<th class="thwidthth">No Of Books</th>
							<th class="thwidthth">Book Size</th>
							<th class="thwidthth">Tr Code</th>
							<th class="thwidthth">At Par</th>								
							<th class="thwidthth">Chk No. From</th>
							<th class="thwidthth">Chk No. To</th>							
							<th class="thwidthth">Address 1</th>
							<th class="thwidthth">Address 2</th>
							<th class="thwidthth">Address 3</th>
							<th class="thwidthth">Address 4</th>
							<th class="thwidthth">Address 5</th>
							<th class="thwidthth">City</th>														
							<th class="thwidthth">PIN</th>							
							<th class="thwidthth">Mobile</th></tr>';
		$tablefooter = '<tr><td colspan="24" valign="middle" class="thwidthth" style="text-align:left; padding-left:10px">
          <a id="mark_all" style="margin-right:20px;" class="pointer"  onclick="MarkAll();" >Select all</a>
          <a id="unmark_all" style="margin-right:20px;" class="pointer"  onclick="Unmark_all();">Deselect all</a>
          <a id="print_selected" style="margin-right:20px;" class="pointer" onclick="Print_selected();">Print Selected</a>
		  <a id="delete_selected" style="margin-right:20px;" class="pointer" onclick="Delete_selected();">Delete Selected</a>
          </td></tr><tr><td style="height:30px;">&nbsp;</td></tr>';
		
		foreach($result as $row) {
			$tableinner .= DivPattern(1,$id++,$row);
		}
		
		echo "<table cellpadding='0' cellspacing='0' border='0' width='3000' id='categorytable'>".$tableheader.$tableinner.$tablefooter."</table>";
	}
}

function DivPattern($pattern = 1,$id,$objprintdata){
	$class = ($id%2) ? 'alt-row' : 'even-row';
	switch($pattern){
		case 1:
			$tableinner = "<tr class='$class'>
								<td><input type='checkbox' name='action[]' id='".$objprintdata->id."' class='class_chkbox'  /></td>
								<td class='thwidthtd'>".$objprintdata->cps_unique_req."</td>
								<td class='thwidthtd'>".$objprintdata->cps_micr_code."</td>								
								<td class='thwidthtd'>".$objprintdata->cps_account_no."</td>
								<td class='thwidthtd'>".$objprintdata->cps_act_name."</td>
								<td class='thwidthtd'>".$objprintdata->cps_no_of_books."</td>
								<td class='thwidthtd'>".$objprintdata->cps_book_size."</td>
								<td class='thwidthtd'>".$objprintdata->cps_tr_code."</td>";
								
								if($objprintdata->cps_atpar == 0){
										$tableinner .="<td class='thwidthtd'>N</td>";
								}else{
										$tableinner .="<td class='thwidthtd'></td>";
								}
								
							$tableinner .="<td class='thwidthtd'>".$objprintdata->cps_chq_no_from."</td>
								<td class='thwidthtd'>".$objprintdata->cps_chq_no_to."</td>
								<td class='thwidthtd'>".$objprintdata->cps_act_address1."</td>
								<td class='thwidthtd'>".$objprintdata->cps_act_address2."</td>
								<td class='thwidthtd'>".$objprintdata->cps_act_address3."</td>
								<td class='thwidthtd'>".$objprintdata->cps_act_address4."</td>
								<td class='thwidthtd'>".$objprintdata->cps_act_address5."</td>
								<td class='thwidthtd'>".$objprintdata->cps_act_city."</td>															
								<td class='thwidthtd'>".$objprintdata->cps_act_pin."</td>							
								<td class='thwidthtd'>".$objprintdata->cps_act_mobile."</td>
							</tr>"; 
			break;
		case 2: 
			break;
	}
	return $tableinner;
}
//============================================ END =================================================
?>