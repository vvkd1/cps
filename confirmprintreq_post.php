<?php 
	require_once 'global.php';
	global $db;
 ?>
<?php
	
	$rowchkserise = $db->get_row("SELECT series_lastno from tb_cps_chequeseries");
	$row = $db->get_row("SELECT chk_taken_from FROM tb_cps_settings");
	
	if($row->chk_taken_from == "0")
	{
		$db->query("Insert Into tb_printque (cps_unique_req,cps_micr_code,cps_branchmicr_code,cps_account_no,cps_act_name,cps_no_of_books,cps_dly_bearer_order,cps_book_size,cps_tr_code,cps_atpar,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_state,cps_country,cps_emailid,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_ifsc_code,cps_chq_no_from,cps_chq_no_to,cps_micr_account_no,cps_date,cps_process_user_id,cps_bsr_code,cps_pr_code,cps_short_name,cps_product_code) SELECT cps_unique_req,cps_micr_code,cps_branchmicr_code,cps_account_no,cps_act_name,cps_no_of_books,cps_dly_bearer_order,cps_book_size,cps_tr_code,cps_atpar,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_state,cps_country,cps_emailid,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_ifsc_code,cps_chq_no_from,cps_chq_no_to,cps_micr_account_no,cps_date,cps_process_user_id,cps_bsr_code,cps_pr_code,cps_short_name,cps_product_code FROM tb_pending_print_req where cps_isprint = 1 and cps_unique_req not in (0)");
		$db->query("DELETE FROM tb_pending_print_req WHERE cps_isprint = 1");
	}
	else
	{	
		if($rowresults = $db->get_results("SELECT * FROM tb_pending_print_req where cps_isprint = 1"))
		
		{
			foreach($rowresults as $results)
			{
				$rowchkserise = $db->get_row("SELECT series_lastno FROM tb_cps_chequeseries WHERE series_transationcode = $results->cps_tr_code AND serise_branchcode_branch = $results->cps_branchmicr_code");				
				$chequefrom = $rowchkserise->series_lastno;
				$chequeto = $chequefrom + ($results->cps_book_size * $results->cps_no_of_books) - 1;
				$sqlinsertquery = 'INSERT INTO tb_printque 
									(cps_unique_req,cps_micr_code,cps_branchmicr_code,cps_account_no,cps_act_name,cps_no_of_books,cps_dly_bearer_order,cps_book_size,cps_tr_code,cps_atpar,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_state,cps_country,cps_emailid,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_ifsc_code,cps_chq_no_from,cps_chq_no_to,cps_micr_account_no,cps_date,cps_process_user_id,cps_bsr_code,cps_pr_code,cps_short_name,cps_product_code)
									VALUES
									("'.$results->cps_unique_req.'","'.$results->cps_micr_code .'","'.$results->cps_branchmicr_code .'","'.$results->cps_account_no .'","'.$results->cps_act_name .'","'.$results->cps_no_of_books .'","'.$results->cps_dly_bearer_order .'","'.$results->cps_book_size .'","'.$results->cps_tr_code .'","'.$results->cps_atpar .'","'.$results->cps_act_jointname1 .'","'.$results->cps_act_jointname2 .'","'.$results->cps_auth_sign1 .'","'.$results->cps_auth_sign2 .'","'.$results->cps_auth_sign3 .'","'.$results->cps_act_address1 .'","'.$results->cps_act_address2 .'","'.$results->cps_act_address3 .'","'.$results->cps_act_address4 .'","'.$results->cps_act_address5 .'","'.$results->cps_act_city .'","'.$results->cps_state .'","'.$results->cps_country .'","'.$results->cps_emailid .'","'.$results->cps_act_pin .'","'.$results->cps_act_telephone_res .'","'.$results->cps_act_telephone_off .'","'.$results->cps_act_mobile .'","'.$results->cps_ifsc_code .'","'.$chequefrom .'","'.$chequeto .'","'.$results->cps_micr_account_no .'","'.$results->cps_date .'","'.$results->cps_process_user_id .'","'.$results->cps_bsr_code .'","'.$results->cps_pr_code .'","'.$results->cps_short_name.'","'.$results->cps_product_code.'")';
				if(isset($_REQUEST['file']) && ($_REQUEST['file'] == 'text'))
				{
					$sqlinsertquery = 'INSERT INTO tb_printque 
									(cps_unique_req,cps_micr_code,cps_branchmicr_code,cps_account_no,cps_act_name,cps_no_of_books,cps_dly_bearer_order,cps_book_size,cps_tr_code,cps_atpar,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_state,cps_country,cps_emailid,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_ifsc_code,cps_chq_no_from,cps_chq_no_to,cps_micr_account_no,cps_date,cps_process_user_id,cps_bsr_code,cps_pr_code,cps_short_name,cps_product_code)
									VALUES
									("'.$results->cps_unique_req.'","'.$results->cps_micr_code .'","'.$results->cps_branchmicr_code .'","'.$results->cps_account_no .'","'.$results->cps_act_name .'","'.$results->cps_no_of_books .'","'.$results->cps_dly_bearer_order .'","'.$results->cps_book_size .'","'.$results->cps_tr_code .'","'.$results->cps_atpar .'","'.$results->cps_act_jointname1 .'","'.$results->cps_act_jointname2 .'","'.$results->cps_auth_sign1 .'","'.$results->cps_auth_sign2 .'","'.$results->cps_auth_sign3 .'","'.$results->cps_act_address1 .'","'.$results->cps_act_address2 .'","'.$results->cps_act_address3 .'","'.$results->cps_act_address4 .'","'.$results->cps_act_address5 .'","'.$results->cps_act_city .'","'.$results->cps_state .'","'.$results->cps_country .'","'.$results->cps_emailid .'","'.$results->cps_act_pin .'","'.$results->cps_act_telephone_res .'","'.$results->cps_act_telephone_off .'","'.$results->cps_act_mobile .'","'.$results->cps_ifsc_code .'","'.$results->cps_chq_no_from .'","'.$results->cps_chq_no_to .'","'.$results->cps_micr_account_no .'","'.$results->cps_date .'","'.$results->cps_process_user_id .'","'.$results->cps_bsr_code .'","'.$results->cps_pr_code .'","'.$results->cps_short_name.'","'.$results->cps_product_code.'")';
				}
				//echo $sqlinsertquery;
				
				$db->query($sqlinsertquery);	
				$lastchequeno = $chequeto + 1;
				$db->query("UPDATE tb_cps_chequeseries SET series_lastno = ".$lastchequeno." WHERE series_transationcode = $results->cps_tr_code AND serise_branchcode_branch = $results->cps_branchmicr_code");
			}
			
			//Update last cheque number
			$db->query("DELETE FROM tb_pending_print_req WHERE cps_isprint = 1");
		}
	}
	
	$db->closeDb();
	if(isset($_REQUEST['bunch']) && $_REQUEST['bunch'] == 'yes')
		header('Location: print.php?bunch=yes');
	else
		header('Location: print.php');
	
?>
