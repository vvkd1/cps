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
	header('Location: personalprint3.php');	
}
else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delete') && !empty($_REQUEST['pid']) && isset($_REQUEST['pid']) ){
	$db->query("delete from tb_uploadingdata where id IN (".$_REQUEST['pid'].")");
	header('Location: personalprint2.php');	
}
else if($_POST){
	$db->query("delete from tb_uploadingdata");
}

//================== Code for uploading and inserting file data====================

	//FetchUploadedFiles();
	if(isset($_GET["branchid"]) && $_GET["branchid"] != ""){	
				
	}
	else if(isset($_GET["accType"]) && $_GET["accType"] != "" && isset($_GET["branchBookSize"]) && $_GET["branchBookSize"] != ""){
	
	}
	else{
		FetchUploadedFiles();
	}

//=============================Process file type Excel==============================

function FetchUploadedFiles(){

	global $db;
	$id = 0;
	if($result = $db->get_results("SELECT * FROM tb_uploadingdata where cps_unique_req = 0 and cps_unique_req = 0") ){
		$tableinner = '';
		$tableheader = '<tr>
							<th style="background-color: #EDEDED; width:15px"></th>							
							<th class="thwidthth">Micr Code</th>
							<th class="thwidthth">Branch Code</th>
							<th class="thwidthth">Account No</th>
							<th class="thwidthth">Customer Name</th>
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
	else{
		//echo 'No uploaded files found';
	}
}

function DivPattern($pattern = 1,$id,$objprintdata){
	$class = ($id%2) ? 'alt-row' : 'even-row';
	switch($pattern){
		case 1:
			$tableinner = "<tr class='$class'>
								<td><input type='checkbox' name='action[]' id='".$objprintdata->id."' class='class_chkbox'  /></td>								
								<td class='thwidthtd'>".$objprintdata->cps_micr_code."</td>
								<td class='thwidthtd'>".$objprintdata->cps_branchmicr_code."</td>
								<td class='thwidthtd'>".$objprintdata->cps_account_no."</td>
								<td class='thwidthtd'>".$objprintdata->cps_act_name."</td>
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

if(isset($_GET["branchid"])){
	if($_GET["branchid"] != ""){
	$rowgetAccType =  $db->get_results("SELECT distinct(t.transactioncode),t.transactioncode_id, t.transactioncodedescription FROM tb_cps_transactioncodes t INNER JOIN tb_uploadingdata u ON t.transactioncode = u.cps_tr_code where u.cps_branchmicr_code = '".$_GET["branchid"]."' and cps_unique_req in (0)");
	echo "<div style='float:left'><label>&nbsp;&nbsp;&nbsp; Account Type -</label>";	
	echo "<select name='ddlAccountType' id='ddlAccountType' style='width:130px; height:26px;' onchange='showBookSize(this.value)'>
	<option value=''>== Select ==</option>";
	foreach($rowgetAccType as $eachAccType){
		echo "<option value='". $eachAccType->transactioncode ."'>".$eachAccType->transactioncodedescription."</option>";
	}
	echo "</select>";
	}
	else{
	echo "<select name='ddlAccountType' id='ddlAccountType' style='width:130px; height:26px;'>
	<option value=''>== Select ==</option>";
	echo "</select>";
}
}

if(isset($_GET["accType"]) && isset($_GET["branchBookSize"])){
	if($_GET["accType"] != "" && $_GET["branchBookSize"] != ""){
	
		//echo "select distinct(cps_book_size)as booksize from tb_uploadingdata where cps_branchmicr_code = '".$_GET["branchBookSize"]."' and cps_tr_code = '".$_GET["accType"]."' and cps_unique_req not (0)";
		//die();
		
		$rowgetBookSize = $db->get_results("select distinct(cps_book_size)as booksize from tb_uploadingdata where cps_branchmicr_code = '".$_GET["branchBookSize"]."' and cps_tr_code = '".$_GET["accType"]."' and cps_unique_req in (0)");
		echo "<div style='float:left; padding-right:15px'><label>&nbsp;&nbsp;&nbsp; Book Size -</label>";	
		echo "<select name='ddlbooksize' id='ddlbooksize' style='width:130px; height:26px;'>
		<option value=''>== Select ==</option>";
		foreach($rowgetBookSize as $eachBookSize){
			echo "<option value='". $eachBookSize->booksize ."'>".$eachBookSize->booksize."</option>";
		}
		echo "</select>";
	}
	else{
	echo "<select name='ddlbooksize' id='ddlbooksize' style='width:130px; height:26px;'>
	<option value=''>== Select ==</option>";
	echo "</select>";
}
}
//============================================ END =================================================
?>