<?php
require_once('global.php');
$page_name = "print_preview";
authentication_print();
ini_set("max_execution_time",3000);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
/*<![CDATA[*/

        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }

	#maindiv{
		width:816px;
		margin:0px auto;
		
	}
	
	.firstdiv{
		width:816px;
		height:282px;
		
	}
	
	.firstdiv .innermain{
		width:768px;
		float:right;
		height:282px;
	}

	.firstdiv .address{
		font-size:12px;
		float:left;
		margin:32px 0px 0px 148px;
		width:250px;
	}

	


/*seconddiv start*/

	.seconddiv{
		width:816px;
		height:64.32px;
	}
	
	.seconddiv .innermain{
		width:442px;
		margin:0px auto;
	}
	
	.seconddiv .innermain .number{
		width:12.2px;
		float:left;
		font-size:13px;
		font-family:E-13B;
	}
    @media print
	{
	h1 {page-break-after:always}
	}
  /*]]>*/
</style>
<?php include('includes.php'); ?>
</head>
<body>
<?php require_once('header.php');	?>

<div id="formdiv">
	<div id="formheading">Re Print Preview</div>
	<div id="formfields">

		<?php 
		
		// Vinod Sharma Coding Starts
		if($resultnoofchequeleavestype = $db->get_results("SELECT DISTINCT cps_book_size FROM tb_cps_reprintque WHERE cps_reprint_approved = 1"))
		{
			$countnoofchequetype = count($resultnoofchequeleavestype);
			/* 
			 * Data Sequence in ChequeData
			 * 1)Cheque Number 2)Center Code 3)Bank Code 4)Branch Code 5)MICR Account No 6)Account No 7)Transaction Code 8)Account Name 9)Address 10)City 11)Pin
			*/
			$firstchequerow = array();
			$secondchequerow = array();
			$thirdchequerow = array();
			$singlefirstchequerow = array();
			$singlesecondchequerow = array();
			$singlethirdchequerow = array();
			foreach($resultnoofchequeleavestype as $rownoofcheque)
			{
				$result = $db->get_results("SELECT * FROM tb_cps_reprintque WHERE cps_book_size = ".$rownoofcheque->cps_book_size ." AND cps_reprint_approved = 1");
				$totalnoofsamechequesize = count($result);
				//$matchingsets = round(($totalnoofsamechequesize/3), 0, PHP_ROUND_HALF_DOWN);
				$matchingsets = floor($totalnoofsamechequesize/3);
				$counterset = 1;
				
				foreach($result as $rowresults)
				{
					$chequeno = $rowresults->cps_chq_no_from; 
					$citycode = $rowresults->cps_city_code;
					if($rowresults->cps_atpar == 1)
					{
						$citycode = "000";
					}
					if($counterset <= $matchingsets * 3)
					{
						for($i=0;$i<$rownoofcheque->cps_book_size ; $i++)
						{
							if($i!=0)
								$chequeno = $chequeno + 1;
								
							$chequeno = str_pad($chequeno, 6, "0", STR_PAD_LEFT);	
							
							if($counterset % 3 == 1) 
							{
								$firstchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin);
							}
							elseif($counterset % 3 == 2 )
							{
								$secondchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin);
							}
							elseif($counterset % 3 == 0) {
								$thirdchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin);
								
								
								// Start Printing First Lot
								if($i == ($rownoofcheque->cps_book_size - 1))
								{
									for($j = 0;$j<count($firstchequerow);$j++)
									{
										$firstchequedata = implode("~",$firstchequerow[$j]);
										$secondchequedata = implode("~",$secondchequerow[$j]);
										$thirdchequedata = implode("~",$thirdchequerow[$j]);
										
										if($j==0)
										{
											//printCheques(2,$firstchequedata,$secondchequedata,$thirdchequedata);
											
											printRequestSlipHTML($firstchequerow,$j);
											printRequestSlipHTML($secondchequerow,$j);
											printRequestSlipHTML($thirdchequerow,$j);
										}
										
										printCheques(3,$firstchequedata,$secondchequedata,$thirdchequedata);
										break;
										
										printChequeLeafHTML($firstchequerow[$j]);
										printChequeLeafHTML($secondchequerow[$j]);
										printChequeLeafHTML($thirdchequerow[$j]);
									}
									$firstchequerow = array();
									$secondchequerow = array();
									$thirdchequerow = array();
								}
							}
						}
						
					}
					else
					{

						for($i=0;$i<$rownoofcheque->cps_book_size ; $i++)
						{
							if($i!=0)
								$chequeno = $chequeno + 1;
							
							$chequeno = str_pad($chequeno, 6, "0", STR_PAD_LEFT);
							if($i % 3 == 0) 
							{
								$singlefirstchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin);
							}
							elseif($i % 3 == 1) 
							{
								$singlesecondchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin);
							}
							elseif($i % 3 == 2) 
							{
								$singlethirdchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin);
							}
							
							if($i == ($rownoofcheque->cps_book_size - 1))
							{
								$firstchequerow = $singlefirstchequerow;
								$secondchequerow = $singlesecondchequerow;
								$thirdchequerow = $singlethirdchequerow;
								
								for($j = 0;$j<count($firstchequerow);$j++)
								{
									$firstchequedata = implode("~",$singlefirstchequerow[$j]);
									$secondchequedata = implode("~",$singlesecondchequerow[$j]);
									$thirdchequedata = implode("~",$singlethirdchequerow[$j]);
									
									if($j==0)
									{
										
										//printCheques(2,$firstchequedata,$secondchequedata,$thirdchequedata);
										printRequestSlipHTML($firstchequerow,$j);
										?>
										
										<div>
											<table>
												<tr>
													<td style="height:684px">
													&nbsp;
													</td>
												</tr>
											</table>
										</div>
										<?php
									}
									
									//printCheques(3,$firstchequedata,$secondchequedata,$thirdchequedata);
									printChequeLeafHTML($firstchequerow[$j]);
									printChequeLeafHTML($secondchequerow[$j]);
									printChequeLeafHTML($thirdchequerow[$j]);
								}
								$firstchequerow = array();
								$secondchequerow = array();
								$thirdchequerow = array();
								$singlefirstchequerow = array();
								$singlesecondchequerow = array();
								$singlethirdchequerow = array();
							}
						}
					}
					
					$counterset++;
					
					insertIntoPrintCollection($rowresults);
				}
			}
		}
		else
		{
			echo "No Records Left For Printing";
		}
		
		function insertIntoPrintCollection($results)
		{
			global $db;
			$sqlinsertquery = "INSERT INTO tb_print_req_collection 
								(cps_city_code,cps_bank_code,cps_branch_code,cps_branch_soleID,cps_micr_account_no,cps_account_no,cps_tr_code,cps_act_name,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address1,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_act_pin,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_no_of_books,cps_book_size,cps_dly_bearer_order,cps_atpar,cps_pr_code,cps_chq_no_from,cps_chq_no_to,cps_effective_date,cps_issue_date,cps_sr_no_infra,cps_alpha_code,cps_spectial_series,cps_ifsc_code,cps_rtgs_code,cps_neft_code,cps_unique_req,cps_state,cps_country,cps_emailid,cps_date,cps_is_reprint)
								VALUES
								('".$results->cps_city_code ."','".$results->cps_bank_code ."','".$results->cps_branch_code ."','".$results->cps_branch_soleID ."','".$results->cps_micr_account_no ."','".$results->cps_account_no ."','".$results->cps_tr_code ."','".$results->cps_act_name ."','".$results->cps_act_jointname1 ."','".$results->cps_act_jointname2 ."','".$results->cps_auth_sign1 ."','".$results->cps_auth_sign2 ."','".$results->cps_auth_sign3 ."','".$results->cps_act_address1 ."','".$results->cps_act_address2 ."','".$results->cps_act_address3 ."','".$results->cps_act_address4 ."','".$results->cps_act_address5 ."','".$results->cps_act_city ."','".$results->cps_act_pin ."','".$results->cps_act_telephone_res ."','".$results->cps_act_telephone_off ."','".$results->cps_act_mobile ."','".$results->cps_no_of_books ."','".$results->cps_book_size ."','".$results->cps_dly_bearer_order ."','".$results->cps_atpar ."','".$results->cps_pr_code ."','".$chequefrom."','".$chequeto."','".$results->cps_effective_date ."','".$results->cps_issue_date ."','".$results->cps_sr_no_infra ."','".$results->cps_alpha_code ."','".$results->cps_spectial_series ."','".$results->cps_ifsc_code ."','".$results->cps_rtgs_code ."','".$results->cps_neft_code ."','".$results->cps_unique_req ."','".$results->cps_state ."','".$results->cps_country ."','".$results->cps_emailid ."','".$results->cps_date ."',1)";
			$db->query($sqlinsertquery);	
			
			$deletefromreprintque = "DELETE FROM tb_cps_reprintque WHERE id=".$results->id ." AND cps_reprint_approved = 1";
			$db->query($deletefromreprintque);
			
		}
					
		function printCheques($type,$firstchequedata,$secondchequedata,$thirdchequedata)
		{
			global $db;
			$imagePath="";
			if($type==2)
			{
				$imagePath = dirname(__FILE__)."\images\chequeimages\\request_img.gif";
			}
			else
			{
				$imagePath = dirname(__FILE__)."\images\chequeimages\jpg.jpg";
			}
			
			$sqlPrinterSettings = "SELECT printermodels.* FROM tb_cps_settings settings JOIN tb_cps_printermodels printermodels ON printermodels.model_id = settings.printermodel";
			$rowPrinterSettings = $db->get_row($sqlPrinterSettings);
			
			$firstChequeCordinates = "".$rowPrinterSettings->cheque1_branchaddressline1X .":".$rowPrinterSettings->cheque1_branchaddressline1Y .":".$rowPrinterSettings->cheque1_branchaddressline2X .":".$rowPrinterSettings->cheque1_branchaddressline2Y .":".$rowPrinterSettings->cheque1_branchaddressline3X .":".$rowPrinterSettings->cheque1_branchaddressline3Y .":".$rowPrinterSettings->cheque1_accountnoX .":".$rowPrinterSettings->cheque1_accountnoY .":".$rowPrinterSettings->cheque1_accountholdernameX .":".$rowPrinterSettings->cheque1_accountholdernameY .":".$rowPrinterSettings->cheque1_authorizedsignatoryX .":".$rowPrinterSettings->cheque1_authorizedsignatoryY .":".$rowPrinterSettings->cheques_trancodeX.":".$rowPrinterSettings->cheques_micraccnoX.":".$rowPrinterSettings->cheques_sortcodeX.":".$rowPrinterSettings->cheques_chequenoX.":".$rowPrinterSettings->cheque1_micrbandY."";
			$secondChequeCordinates = "".$rowPrinterSettings->cheque2_branchaddressline1X .":".$rowPrinterSettings->cheque2_branchaddressline1Y .":".$rowPrinterSettings->cheque2_branchaddressline2X .":".$rowPrinterSettings->cheque2_branchaddressline2Y .":".$rowPrinterSettings->cheque2_branchaddressline3X .":".$rowPrinterSettings->cheque2_branchaddressline3Y .":".$rowPrinterSettings->cheque2_accountnoX .":".$rowPrinterSettings->cheque2_accountnoY .":".$rowPrinterSettings->cheque2_accountholdernameX .":".$rowPrinterSettings->cheque2_accountholdernameY .":".$rowPrinterSettings->cheque2_authorizedsignatoryX .":".$rowPrinterSettings->cheque2_authorizedsignatoryY .":".$rowPrinterSettings->cheques_trancodeX.":".$rowPrinterSettings->cheques_micraccnoX.":".$rowPrinterSettings->cheques_sortcodeX.":".$rowPrinterSettings->cheques_chequenoX.":".$rowPrinterSettings->cheque2_micrbandY."";
			$thirdChequeCordinates = "".$rowPrinterSettings->cheque3_branchaddressline1X .":".$rowPrinterSettings->cheque3_branchaddressline1Y .":".$rowPrinterSettings->cheque3_branchaddressline2X .":".$rowPrinterSettings->cheque3_branchaddressline2Y .":".$rowPrinterSettings->cheque3_branchaddressline3X .":".$rowPrinterSettings->cheque3_branchaddressline3Y .":".$rowPrinterSettings->cheque3_accountnoX .":".$rowPrinterSettings->cheque3_accountnoY .":".$rowPrinterSettings->cheque3_accountholdernameX .":".$rowPrinterSettings->cheque3_accountholdernameY .":".$rowPrinterSettings->cheque3_authorizedsignatoryX .":".$rowPrinterSettings->cheque3_authorizedsignatoryY .":".$rowPrinterSettings->cheques_trancodeX.":".$rowPrinterSettings->cheques_micraccnoX.":".$rowPrinterSettings->cheques_sortcodeX.":".$rowPrinterSettings->cheques_chequenoX.":".$rowPrinterSettings->cheque3_micrbandY."";
			$font = $rowPrinterSettings->font;
			sleep(4);
			
			//print_r($thirdChequeCordinates);
			$printObj = new COM('PrintChequeTesing.Print');
			echo $printObj->PrintCheque($imagePath,$type,$firstchequedata,$secondchequedata,$thirdchequedata,$firstChequeCordinates,$secondChequeCordinates,$thirdChequeCordinates,$font);
		}
		
		
		function printRequestSlipHTML($requestslipdata,$pos)
		{
			$stringRequestSlipHTML = '<div id="maindiv">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="center" valign="top">
					  <form id="form1" name="form1" method="post" action="">
						<table width="809" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td align="left" valign="top">
							  <table width="809" border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td width="27" align="left" valign="top" bgcolor="#FFFFFF">
								  &nbsp;</td>

								  <td align="left" valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td width="13" align="left" valign="top" bgcolor="#FCF3F4">
										&nbsp;</td>

										<td align="left" valign="top">
										  <table width="100%" border="0" cellspacing="0" cellpadding=
										  "0">
											<tr>
											  <td height="5" bgcolor="#FCF3F4"></td>
											</tr>

											<tr>
											  <td>
												<table width="100%" border="0" cellspacing="0"
												cellpadding="0">
												  <tr>
													<td width="362" align="left" valign="top"
													bgcolor="#FCF3F4"><img src="images/logo.jpg"
													width="225" height="37" /></td>

													<td align="left" valign="top" bgcolor="#FCF3F4"
													style="font-size:8px;">PAYABLE AT PAR THROUGH
													CLEARING/TRANSFER AT ALL BRANCHES OF HDFC BANK
													LTD REQUEST FOR NEW CHEQUE BOOK</td>
												  </tr>
												</table>
											  </td>
											</tr>

											<tr>
											  <td align="right" valign="top" bgcolor="#FCF3F4" style=
											  "font-weight:bold; font-size:8px;">
											  Date:.................................</td>
											</tr>

											<tr>
											  <td align="left" valign="top" bgcolor="#FCF3F4">
											  &nbsp;</td>
											</tr>

											<tr>
											  <td align="right" valign="top" bgcolor="#FCF3F4">
												<table width="96%" border="0" cellspacing="0"
												cellpadding="0">
												  <tr>
													<td width="257" align="left" valign="top">
													  <table width="100%" border="0" cellspacing="0"
													  cellpadding="0">
														<tr>
														  <td align="left" valign="top">&nbsp;</td>
														</tr>

														<tr>
														  <td align="left" valign="top" style=
														  "font-size:8px;">'.strtoupper($requestslipdata[$pos][7]).'<br />
														  '.strtoupper($requestslipdata[$pos][8]).'<br/>
														  '.strtoupper($requestslipdata[$pos][9]).'-'.strtoupper($requestslipdata[$pos][10]).'<br />
														  </td>
														</tr>

														
														<tr>
														  <td align="left" valign="top" style=
														  "border:1px solid; border-color:#000000; font-size:8px; padding-left:5px; padding-right:5px;">
														  <span style="font-size:8px;">If undelivered
														  return to</span> <strong>THE VYANKATESHWARA
														  SAHAKARI BANK LTD. (0163)</strong><br />
														  <br />
														  RUPAM CENTRE<br />
														  CINE PLANET, SION CIRCLE, SION(EAST)<br />
														  MUMBAI-400022,MAHARASHTRA</td>
														</tr>
													  </table>
													</td>

													<td align="left" valign="top">
													  <table width="100%" border="0" cellspacing="0"
													  cellpadding="0">
														<tr>
														  <td align="right" valign="top">
															<table width="98%" border="0"
															cellspacing="0" cellpadding="0">
															  <tr>
																<td align="left" valign="top">
																  <table width="100%" border="0"
																  cellspacing="0" cellpadding="0">
																	<tr>
																	  <td width="45%" align="left"
																	  valign="top" style=
																	  "font-size:8px;">Please
																	  supply------------------------------
																	  book(s) of</td>

																	  <td width="5%" align="left"
																	  valign="top">
																	  <label><input type="checkbox"
																	  name="checkbox" id=
																	  "checkbox" /></label></td>

																	  <td width="12%" align="left"
																	  valign="middle" style=
																	  "font-size:8px;">25 leaves</td>

																	  <td width="5%" align="left"
																	  valign="top">
																	  <label><input type="checkbox"
																	  name="checkbox" id=
																	  "checkbox" /></label></td>

																	  <td width="33%" align="left"
																	  valign="middle" style=
																	  "font-size:8px;">50 leaves</td>
																	</tr>
																  </table>
																</td>
															  </tr>

															  <tr>
																<td align="left" valign="top" style=
																"font-size:8px;">I/we agree and
																acknowledge that the cheque
																book(s)</td>
															  </tr>

															  <tr>
																<td align="left" valign="top">
																  <table width="100%" border="0"
																  cellspacing="0" cellpadding="0">
																	<tr>
																	  <td width="5%" align="left"
																	  valign="top">
																	  <label><input type="checkbox"
																	  name="checkbox" id=
																	  "checkbox" /></label></td>

																	  <td width="95%" align="left"
																	  valign="middle" style=
																	  "font-size:8px;">Will be
																	  collected at the Branch by the
																	  undersigned Or</td>
																	</tr>
																  </table>
																</td>
															  </tr>

															  <tr>
																<td align="left" valign="top">
																  <table width="100%" border="0"
																  cellspacing="0" cellpadding="0">
																	<tr>
																	  <td width="5%" align="left"
																	  valign="top">
																	  <label><input type="checkbox"
																	  name="checkbox2" id=
																	  "checkbox2" /></label></td>

																	  <td width="95%" align="left"
																	  valign="middle" style=
																	  "font-size:8px;">Will be
																	  despatched by courier</td>
																	</tr>
																  </table>
																</td>
															  </tr>

															  <tr>
																<td align="left" valign="top" style=
																"font-size:8px; text-align:justify; padding-left:5px; padding-right:5px;">
																I/We confirm that I/We have read or
																will read "Conditions for Issue and
																Use of Cheque Books" on the cover and
																agree to abide by such conditions or
																such other conditions applicable for
																time to time. I/We hereby acknowledge
																the need to exercise care when
																drawing cheques and agree that I/We
																will not draw cheques by any means
																which may enable a cheque to be
																altered in a manner which is not
																readily detectable.</td>
															  </tr>

															  <tr>
																<td align="left" valign="top" style=
																"border:1px solid; border-color:#000000;">
																<table width="100%" border="0"
																cellspacing="0" cellpadding="0">
																	<tr>
																	  <td align="left" valign="top"
																	  style=
																	  "font-size:8px; text-align:justify; padding-left:5px; padding-right:5px;">
																	  Your Tel/Mobile No is required
																	  to enable timely delivery of
																	  your cheque book and to
																	  facilitate identification for
																	  security reasons. We may not be
																	  able to deliver the cheque book
																	  if we do not have the required
																	  identification. Please update
																	  your Tel/Mobile No below</td>
																	</tr>

																	<tr>
																	  <td align="left" valign="top">
																		<table width="100%" border=
																		"0" cellspacing="0"
																		cellpadding="0">
																		  <tr>
																			<td width="161" align=
																			"left" valign="top"
																			style="font-size:8px; font-weight:bold; padding-left:5px;">
																			RESI.................................../</td>

																			<td width="161" align=
																			"left" valign="top"
																			style="font-size:8px; font-weight:bold; padding-left:5px;">
																			OFF.................................../</td>

																			<td width="161" align=
																			"left" valign="top"
																			style="font-size:8px; font-weight:bold; padding-left:5px;">
																			MOBILE...................................</td>
																		  </tr>
																		</table>
																	  </td>
																	</tr>
																  </table>
																</td>
															  </tr>

															  <tr>
																<td height="7" align="left" valign=
																"top"></td>
															  </tr>

															  <tr>
																<td align="left" valign="top" style=
																"padding-left:20px; font-size:9px;">
																<strong>A/c No
																:'.strtoupper($requestslipdata[$pos][5]).'</strong></td>
															  </tr>

															  <tr>
																<td align="right" valign="top">
																  <table width="78%" border="0"
																  cellspacing="0" cellpadding="0">
																	<tr>
																	  <td align="left" valign="top"
																	  style="font-size:8px;">Mail -
																	  ID :
																	  </td>

																	  <td align="left" valign="top"
																	  style="font-size:8px;">Res. Tel
																	  : </td>
																	</tr>

																	<tr>
																	  <td align="left" valign="top"
																	  style="font-size:8px;">Off. Tel
																	  :</td>

																	  <td align="left" valign="top"
																	  style="font-size:8px;">Mobile
																	  No : </td>
																	</tr>
																  </table>
																</td>
															  </tr>

															   <tr>
																<td align="right" valign="top">
																  <table width="50%" border="0"
																  cellspacing="0" cellpadding="0">
																	<tr>
																	  <td align="left" valign="top"
																	  style="font-size:8px;">Cheque
																	  Leaves enclosed : '.$j.'</td>
																	</tr>

																	<tr>
																	  <td align="left" valign="top"
																	  style="font-size:8px;">Cheque
																	  Series From : '.($requestslipdata[$pos][0] - $pos) .' To '.$requestslipdata[$pos][0].' </td>
																	</tr>
																  </table>
																</td>
															  </tr>
															</table>
														  </td>
														</tr>
													  </table>
													</td>
												  </tr>
												</table>
											  </td>
											</tr>

											<tr>
											  <td align="left" valign="top" bgcolor="#FCF3F4" style=
											  "border:1px solid; border-color:#000000; font-size:8px; padding:0px 5px 0px 5px;">
											  PAP cheque books can be requested only at the branch.
											  As the cheque is payable at par through
											  clearing/transfer at all branches of THE VYANKATESHWARA
											  SAHAKARI BANK LTD. across India, it is advisable to
											  draw the cheque in English. We appreciate your
											  cooperation.</td>
											</tr>

											<tr>
											  <td align="right" valign="top" bgcolor="#FCF3F4" style=
											  "font-size:8px; padding-right:50px; font-weight:bold;">
											  For THE VYANKATESHWARA SAHAKARI BANK LTD.</td>
											</tr>
										  </table>
										</td>

										<td width="13" align="left" valign="top" bgcolor="#FCF3F4">
										&nbsp;</td>
									  </tr>
									</table>
								  </td>
								</tr>
							  </table>
							</td>
						  </tr>

						  <tr>
							<td height="40" align="right" valign="middle" bgcolor="#FFFFFF" style=
							"font-size:8px; font-weight:bold; padding-right:70px; padding-top:10px;">
							Signature(s) of Account Holder(s)</td>
						  </tr>
						</table>
					  </form>
					</td>
				  </tr>
				</table>
			  </div>';
			echo $stringRequestSlipHTML; 

		}
		
		function printChequeLeafHTML($chequeleafdata)
		{
			$arrChequeSeries = str_split($chequeleafdata[0]);
			$arrCenterCode = str_split($chequeleafdata[1]);
			$arrBankCode = str_split($chequeleafdata[2]);
			$arrBranchCode = str_split($chequeleafdata[3]);
			$arrMicrAccNo = str_split($chequeleafdata[4]);
			$arrTRCode = str_split($chequeleafdata[6]);
			$stringChequeLeaf = '
								<div id="maindiv">
									<div class="firstdiv" style="background:url(images/cheque.jpg) no-repeat;">
										<div class="innermain">
											<div style="float:left; width:768px;">
											<div class="address">Rupam Centre, Cine Planet, Sion Circle Sion (East), Mumbai-400022,Maharashtra <br /> IFSC MHCB 0000532</div>
											</div>
											<div style="clear:both;">&nbsp;</div>
											<div style="clear:both;">&nbsp;</div>
											<div style="clear:both;">&nbsp;</div>
											<div style="clear:both;">&nbsp;</div>
											<div style="clear:both;">&nbsp;</div>
											<div style="float:left; margin-left:140px; font-size:16px;  width:435px;">&nbsp;'.strtoupper($chequeleafdata[5]).'</div>
											<div style="float:left;  width:150px; font-size:16px;">&nbsp;'.strtoupper($chequeleafdata[7]).'</div>
											<div style="float:right; margin-top:55px;  width:185px; font-size:12px;">Authorised Signatories</div>
									   </div>
									</div>
									
									<div class="seconddiv" style="margin-top:20px;">
										<div class="innermain">
											<div class="number">C</div>
											<div class="number">'.$arrChequeSeries[0].'</div>
											<div class="number">'.$arrChequeSeries[1].'</div>
											<div class="number">'.$arrChequeSeries[2].'</div>
											<div class="number">'.$arrChequeSeries[3].'</div>
											<div class="number">'.$arrChequeSeries[4].'</div>
											<div class="number">'.$arrChequeSeries[5].'</div>
											<div class="number">C</div>
											<div class="number" style="width:10px;">&nbsp;</div>
											<div class="number">'.$arrCenterCode[0].'</div>
											<div class="number">'.$arrCenterCode[1].'</div>
											<div class="number">'.$arrCenterCode[2].'</div>
											<div class="number">'.$arrBankCode[0].'</div>
											<div class="number">'.$arrBankCode[1].'</div>
											<div class="number">'.$arrBankCode[2].'</div>
											<div class="number">'.$arrBranchCode[0].'</div>
											<div class="number">'.$arrBranchCode[1].'</div>
											<div class="number">'.$arrBranchCode[2].'</div>
											<div class="number">A</div>
											<div class="number" style="width:10px;">&nbsp;</div>
											<div class="number">'.$arrMicrAccNo[0].'</div>
											<div class="number">'.$arrMicrAccNo[1].'</div>
											<div class="number">'.$arrMicrAccNo[2].'</div>
											<div class="number">'.$arrMicrAccNo[3].'</div>
											<div class="number">'.$arrMicrAccNo[4].'</div>
											<div class="number">'.$arrMicrAccNo[5].'</div>
											<div class="number">C</div>
											<div class="number" style="width:10px;">&nbsp;</div>
											<div class="number">'.$arrTRCode[0].'</div>
											<div class="number">'.$arrTRCode[1].'</div>
										</div>
									</div>
								</div>';
			echo $stringChequeLeaf;					
		}
		
		
	//Close Database		
	$db->closeDb();
	?>
	</div>
</div>
</body>
</html>
