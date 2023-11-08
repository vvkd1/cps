<?php require_once('../global.php');
	
	//Store all post data in variables.
	$cps_city_code = $_REQUEST['txtCityCode'];
	$cps_bank_code = $_REQUEST['txtBankCode'];
	$cps_branch_code = $_REQUEST['txtBranchCode'];
	$cps_branch_soleID = $_REQUEST['txtBranchSoleID'];
	$cps_micr_account_no = $_REQUEST['txtMicrAccNo'];
	$cps_account_no = $_REQUEST['txtaccountno'];
	$cps_tr_code = $_REQUEST['txtTrCode'];
	$cps_act_name = $_REQUEST['txtCustName'];
	$cps_act_jointname1 = $_REQUEST['txtJointName1'];
	$cps_act_jointname2 = $_REQUEST['txtJointName2'];
	$cps_auth_sign1 = $_REQUEST['txtSignatory1'];
	$cps_auth_sign2 = $_REQUEST['txtSignatory2'];
	$cps_auth_sign3 = $_REQUEST['txtSignatory3'];
	$cps_act_address1 = $_REQUEST['txtAddress1'];
	$cps_act_address2 = $_REQUEST['txtAddress2'];
	$cps_act_address3 = $_REQUEST['txtAddress3'];
	$cps_act_address4 = $_REQUEST['txtAddress4'];
	$cps_act_address5 = $_REQUEST['txtAddress5'];
	$cps_act_city = $_REQUEST['txtCity'];
	$cps_act_pin = $_REQUEST['txtPin'];
	$cps_act_telephone_res = $_REQUEST['txtTelephoneRes'];
	$cps_act_telephone_off = $_REQUEST['txtTelephoneOff'];
	$cps_act_mobile = $_REQUEST['txtMobile'];
	$cps_no_of_books = $_REQUEST['txtNoofBooks'];
	$cps_book_size = $_REQUEST['txtBookSize'];
	$cps_dly_bearer_order = $_REQUEST['txtBearerOrder'];
	$cps_atpar = $_REQUEST['txtAtPar'];
	$cps_pr_code = $_REQUEST['txtPRCode'];
	$cps_chq_no_from = $_REQUEST['txtChequeFrom'];
	$cps_chq_no_to = $_REQUEST['txtChequeTo'];
	$cps_effective_date = $_REQUEST['txtEffectiveDate'];
	$cps_issue_date = $_REQUEST['txtIssueDate'];
	$cps_sr_no_infra = $_REQUEST['txtSrNoInfra'];
	$cps_alpha_code = $_REQUEST['txtAlphaCode'];
	$cps_spectial_series = $_REQUEST['txtSpectialSeries'];
	$cps_ifsc_code = $_REQUEST['txtIFSCCode'];
	$cps_rtgs_code = $_REQUEST['txtRTGSCode'];
	$cps_neft_code = $_REQUEST['txtNEFTCode'];
	$cps_unique_req = $_REQUEST['txtUniqueRequestNo'];
	$cps_country = $_REQUEST['txtCountry'];
	$cps_state = $_REQUEST['txtState'];
	$cps_emailid = $_REQUEST['txtEmailId'];


	//Make sure if bank table is empty.
	//$sqldelete = "DELETE FROM tb_cps_mapfields";
	//$db->query($sqldelete);
	
	
	//Insert bank details in tb_branchdetails table
	$sql = "INSERT INTO tb_cps_mapfields
			(cps_city_code,cps_bank_code,cps_branch_code,cps_branch_soleID,cps_micr_account_no,cps_tr_code,cps_act_name,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_no_of_books,cps_book_size,cps_dly_bearer_order,cps_atpar,cps_pr_code,cps_chq_no_from,cps_chq_no_to,cps_effective_date,cps_issue_date,cps_sr_no_infra,cps_alpha_code,cps_spectial_series,cps_ifsc_code,cps_rtgs_code,cps_neft_code,cps_unique_req,cps_state,cps_country,cps_emailid,cps_account_no)
			VALUES
			('".($cps_city_code)."' ,'".mysql_real_escape_string($cps_bank_code)."' ,'".mysql_real_escape_string($cps_branch_code)."' ,'".mysql_real_escape_string($cps_branch_soleID)."' ,'".mysql_real_escape_string($cps_micr_account_no)."' ,'".mysql_real_escape_string($cps_tr_code)."' ,'".mysql_real_escape_string($cps_act_name)."' ,'".mysql_real_escape_string($cps_act_jointname1)."' ,'".mysql_real_escape_string($cps_act_jointname2)."' ,'".mysql_real_escape_string($cps_auth_sign1)."' ,'".mysql_real_escape_string($cps_auth_sign2)."' ,'".mysql_real_escape_string($cps_auth_sign3)."' ,'".mysql_real_escape_string($cps_act_address1)."' ,'".mysql_real_escape_string($cps_act_address2)."' ,'".mysql_real_escape_string($cps_act_address3)."' ,'".mysql_real_escape_string($cps_act_address4)."' ,'".mysql_real_escape_string($cps_act_address5)."' ,'".mysql_real_escape_string($cps_act_city)."' ,'".mysql_real_escape_string($cps_act_pin)."' ,'".mysql_real_escape_string($cps_act_telephone_res)."' ,'".mysql_real_escape_string($cps_act_telephone_off)."' ,'".mysql_real_escape_string($cps_act_mobile)."' ,'".mysql_real_escape_string($cps_no_of_books)."' ,'".mysql_real_escape_string($cps_book_size)."' ,'".mysql_real_escape_string($cps_dly_bearer_order)."' ,'".mysql_real_escape_string($cps_atpar)."' ,'".mysql_real_escape_string($cps_pr_code)."' ,'".mysql_real_escape_string($cps_chq_no_from)."' ,'".mysql_real_escape_string($cps_chq_no_to)."' ,'".mysql_real_escape_string($cps_effective_date)."' ,'".mysql_real_escape_string($cps_issue_date)."' ,'".mysql_real_escape_string($cps_sr_no_infra)."' ,'".mysql_real_escape_string($cps_alpha_code)."' ,'".mysql_real_escape_string($cps_spectial_series)."' ,'".mysql_real_escape_string($cps_ifsc_code)."' ,'".mysql_real_escape_string($cps_rtgs_code)."' ,'".mysql_real_escape_string($cps_neft_code)."' ,'".mysql_real_escape_string($cps_unique_req)."','".mysql_real_escape_string($cps_state )."','".mysql_real_escape_string($cps_country)."','".mysql_real_escape_string($cps_emailid)."','".mysql_real_escape_string($cps_account_no)."')";
	//echo $sql;
	$db->query($sql);
	echo '{"status":"true"}';
	exit;
	
	
	
?>