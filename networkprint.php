<?php
require_once('global.php');
require_once('fpdf.php');
$page_name = "print_preview";
//authentication_print();
ini_set("max_execution_time",30000);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('includes.php'); ?>
</head>
<body>
<?php require_once('header.php');	?>
<div id="formdiv">
	<div id="formheading">Print Cheques</div>
	<div id="formfields">

		<?php 
		
		// Vinod Sharma Coding Starts
		if($resultnoofchequeleavestype = $db->get_results("SELECT DISTINCT cps_book_size FROM tb_printque"))
		{
			$branchDetails = $db->get_row("SELECT branch.branch_address1,branch.branch_address2,suburb_name,city_place,suburb_postal_code,branch.branch_neftifsccode FROM tb_branchdetails branch LEFT JOIN tb_suburbmaster suburb ON branch.branch_suburb_id = suburb.suburb_id LEFT JOIN tb_citymaster city ON branch.branch_city_id = city.city_id");
			$countnoofchequetype = count($resultnoofchequeleavestype);
			/* 
			 * Data Sequence in ChequeData
			 * 1)Cheque Number 2)Center Code 3)Bank Code 4)Branch Code 5)MICR Account No 6)Account No 7)Transaction Code 8)Account Name 9)Address 10)City 11)Pin
			*/
			$firstchequerow = array();
			$secondchequerow = array();
			$thirdchequerow = array();
			
			$firstrequestsliprow = array();
			$secondrequestsliprow = array();
			$thirdrequestsliprow = array();
			
			
			$singlefirstchequerow = array();
			$singlesecondchequerow = array();
			$singlethirdchequerow = array();
			foreach($resultnoofchequeleavestype as $rownoofcheque)
			{
				$result = $db->get_results("SELECT * FROM tb_printque WHERE cps_book_size = ".$rownoofcheque->cps_book_size);
				$totalnoofsamechequesize = count($result);
				//$matchingsets = round(($totalnoofsamechequesize/3), 0, PHP_ROUND_HALF_DOWN);
				$matchingsets = floor($totalnoofsamechequesize/3);
				$counterset = 1;
				
				foreach($result as $rowresults)
				{
					$chequeno = $rowresults->cps_chq_no_from; 
					$citycode = $rowresults->cps_city_code;
					if(trim($rowresults->cps_act_jointname1)!="")
					{
						$name1 = $rowresults->cps_act_jointname1;
						$name2 = $rowresults->cps_act_jointname2;
						$name3 = "";
					}
					else
					{
						$name1 = $rowresults->cps_auth_sign1;
						$name2 = $rowresults->cps_auth_sign2;
						$name3 = $rowresults->cps_auth_sign3;
					}
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
								$firstchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin,$name1,$name2,$name3,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
								$firstrequestsliprow[] = array($rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_address2,$rowresults->cps_act_address3,$rowresults->cps_act_city,$rowresults->cps_act_pin,$rowresults->cps_state,$rowresults->cps_country,$rowresults->cps_act_telephone_res,$rowresults->cps_act_telephone_off,$rowresults->cps_act_mobile,$rowresults->cps_account_no,$rowresults->cps_emailid,$rowresults->cps_book_size,$rowresults->cps_chq_no_from,$rowresults->cps_chq_no_to,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
							}
							elseif($counterset % 3 == 2 )
							{
								$secondchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin,$name1,$name2,$name3,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
								$secondrequestsliprow[] = array($rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_address2,$rowresults->cps_act_address3,$rowresults->cps_act_city,$rowresults->cps_act_pin,$rowresults->cps_state,$rowresults->cps_country,$rowresults->cps_act_telephone_res,$rowresults->cps_act_telephone_off,$rowresults->cps_act_mobile,$rowresults->cps_account_no,$rowresults->cps_emailid,$rowresults->cps_book_size,$rowresults->cps_chq_no_from,$rowresults->cps_chq_no_to,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
							}
							elseif($counterset % 3 == 0) {
								$thirdchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin,$name1,$name2,$name3,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
								$thirdrequestsliprow[] = array($rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_address2,$rowresults->cps_act_address3,$rowresults->cps_act_city,$rowresults->cps_act_pin,$rowresults->cps_state,$rowresults->cps_country,$rowresults->cps_act_telephone_res,$rowresults->cps_act_telephone_off,$rowresults->cps_act_mobile,$rowresults->cps_account_no,$rowresults->cps_emailid,$rowresults->cps_book_size,$rowresults->cps_chq_no_from,$rowresults->cps_chq_no_to,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
								
								
								// Start Printing First Lot
								if($i == ($rownoofcheque->cps_book_size - 1))
								{
									for($j = 0;$j<count($firstchequerow);$j++)
									{
										$firstchequedata = implode("~",$firstchequerow[$j]);
										$secondchequedata = implode("~",$secondchequerow[$j]);
										$thirdchequedata = implode("~",$thirdchequerow[$j]);
										
										$firstrequestslipdata = implode("~",$firstrequestsliprow[$j]);
										$secondrequestslipdata = implode("~",$secondrequestsliprow[$j]);
										$thirdrequestslipdata = implode("~",$thirdrequestsliprow[$j]);
										
										
										
										if($j==0)
										{
											//printRequestSlip(2,$firstrequestslipdata,$secondrequestslipdata,$thirdrequestslipdata,3);
											//break;
										}
										
										printCheques(3,$firstchequedata,$secondchequedata,$thirdchequedata,3);
										//break;
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
								$singlefirstchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin,$name1,$name2,$name3,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
								$firstrequestsliprow[0] = array($rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_address2,$rowresults->cps_act_address3,$rowresults->cps_act_city,$rowresults->cps_act_pin,$rowresults->cps_state,$rowresults->cps_country,$rowresults->cps_act_telephone_res,$rowresults->cps_act_telephone_off,$rowresults->cps_act_mobile,$rowresults->cps_account_no,$rowresults->cps_emailid,$rowresults->cps_book_size,$rowresults->cps_chq_no_from,$rowresults->cps_chq_no_to,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
								
							}
							elseif($i % 3 == 1) 
							{
								$singlesecondchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin,$name1,$name2,$name3,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
							}
							elseif($i % 3 == 2) 
							{
								$singlethirdchequerow[] = array($chequeno,$citycode,$rowresults->cps_bank_code,$rowresults->cps_branch_code,$rowresults->cps_micr_account_no,$rowresults->cps_account_no,$rowresults->cps_tr_code,$rowresults->cps_act_name,$rowresults->cps_act_address1,$rowresults->cps_act_city,$rowresults->cps_act_pin,$name1,$name2,$name3,$branchDetails->branch_address1,$branchDetails->branch_address2,$branchDetails->suburb_name,$branchDetails->city_place,$branchDetails->suburb_postal_code,$branchDetails->branch_neftifsccode);
							}
							
							if($i == ($rownoofcheque->cps_book_size - 1))
							{
								$firstchequerow = $singlefirstchequerow;
								$secondchequerow = $singlesecondchequerow;
								$thirdchequerow = $singlethirdchequerow;
								$noofCheque = 0;
								for($j = 0;$j<count($firstchequerow);$j++)
								{
									$firstchequedata = implode("~",$singlefirstchequerow[$j]);
									if($singlesecondchequerow[$j]!="" && $singlethirdchequerow[$j]!="" )
									{
										$secondchequedata = implode("~",$singlesecondchequerow[$j]);
										$thirdchequedata = implode("~",$singlethirdchequerow[$j]);
										$noofCheque = 3;
									}
									elseif($singlesecondchequerow[$j]!="")
									{
										$secondchequedata = implode("~",$singlesecondchequerow[$j]);
										$noofCheque = 2;
									}
									elseif($singlethirdchequerow[$j]!="")
									{
										$secondchequedata = implode("~",$singlesecondchequerow[$j]);
										$thirdchequedata = implode("~",$singlethirdchequerow[$j]);
										$thirdchequedata = "";
										$noofCheque = 3;
									}
									else
									{
										$secondchequedata = "";
										$thirdchequedata = "";
										$noofCheque = 1;
									}
									$firstrequestslipdata = implode("~",$firstrequestsliprow[0]);
									$secondrequestslipdata = "";
									$thirdrequestslipdata = "";
									
									if($j==0)
									{
										//printRequestSlip(2,$firstrequestslipdata,$secondrequestslipdata,$thirdrequestslipdata,1);
									}
									printCheques(3,$firstchequedata,$secondchequedata,$thirdchequedata,$noofCheque);
									//break;
									
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
			
			?>
				<!--<table width="100%" height="100%">
					<tr>
						<td align="center" width="100%" height="100%">
							<img src="<?php echo ROOT_IMAGES?>printing.gif"/>
						</td>
					</tr>
				</table>-->
			<?php
		}
		else
		{
			echo "No Records Left For Printing";
		}
		
		function insertIntoPrintCollection($results)
		{
			global $db;
			
			//Insert data into print collection (Successfully printed records)
			
			$sqlinsertquery = "INSERT INTO tb_print_req_collection 
								(cps_unique_req,cps_effective_date,cps_bank_code,cps_branch_code,cps_city_code,cps_account_no,cps_branch_id,cps_micr_account_no,cps_act_name,cps_no_of_books,cps_dly_bearer_order,cps_book_size,cps_tr_code,cps_atpar,cps_act_jointname1,cps_act_jointname2,cps_auth_sign1,cps_auth_sign2,cps_auth_sign3,cps_act_address2,cps_act_address3,cps_act_address4,cps_act_address5,cps_act_city,cps_state,cps_country,cps_emailid,cps_act_telephone_res,cps_act_telephone_off,cps_act_mobile,cps_ifsc_code,cps_chq_no_from,cps_chq_no_to,cps_issue_date,cps_date,cps_process_user_id)
								VALUES
								('".$results->cps_unique_req ."','".$results->cps_effective_date ."','".$results->cps_bank_code ."','".$results->cps_branch_code ."','".$results->cps_city_code ."','".$results->cps_account_no ."','".$results->cps_branch_id ."','".$results->cps_micr_account_no ."','".$results->cps_act_name ."','".$results->cps_no_of_books ."','".$results->cps_dly_bearer_order ."','".$results->cps_book_size ."','".$results->cps_tr_code ."','".$results->cps_atpar ."','".$results->cps_act_jointname1 ."','".$results->cps_act_jointname2 ."','".$results->cps_auth_sign1 ."','".$results->cps_auth_sign2 ."','".$results->cps_auth_sign3 ."','".$results->cps_act_address2 ."','".$results->cps_act_address3 ."','".$results->cps_act_address4 ."','".$results->cps_act_address5 ."','".$results->cps_act_city ."','".$results->cps_state ."','".$results->cps_country ."','".$results->cps_emailid ."','".$results->cps_act_telephone_res ."','".$results->cps_act_telephone_off ."','".$results->cps_act_mobile ."','".$results->cps_ifsc_code ."','".$results->cps_chq_no_from ."','".$results->cps_chq_no_to ."','".$results->cps_issue_date ."','".$results->cps_date ."','".$results->cps_process_user_id ."')";
			//$db->query($sqlinsertquery);		
			
			//$deletefromprintque = "DELETE FROM tb_printque WHERE id=".$results->id ."";
			//$db->query($deletefromprintque);	
		}
					
		function printRequestSlip($type,$firstchequedata,$secondchequedata,$thirdchequedata,$noOfRequestSlip)
		{
			global $db;
			/*
			if($noOfRequestSlip>1)
			{
				$imagePath = dirname(__FILE__)."\images\chequeimages\\request_imgmultiple.jpg";
			}
			else
			{
				$imagePath = dirname(__FILE__)."\images\chequeimages\\request_imgsingle.jpg";
			}
			
			$rowrequestslip = $db->get_row("SELECT * FROM tb_cps_requestslip");
			
			$requestslipbankdata = $rowrequestslip->requestfield1 ."~".$rowrequestslip->requestfield2 ."~".$rowrequestslip->requestfield3 ."~".$rowrequestslip->requestfield4;
			$printObj = new COM('PrintChequeTesing.Print');
			echo $printObj->PrintRequestSlip($imagePath,$type,$firstchequedata,$secondchequedata,$thirdchequedata,$noOfRequestSlip,$requestslipbankdata);
			
			
			*/
			$rowrequestslip = $db->get_row("SELECT * FROM tb_cps_requestslip");
			$bankDetails = $db->get_row("SELECT bank_name FROM tb_bankdetails");
			$arrFirstRequestSlip = explode("~",$firstchequedata);
			$arrSecondRequestSlip = explode("~",$secondchequedata);
			$arrThirdRequestSlip = explode("~",$thirdchequedata);
			//$arrrequestSlipBankData = explode("~",$requestSlipBankData);

			
			
			//First request slip
			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','',8);
			$pdf->Text(15,20,$arrFirstRequestSlip[0]);
			$pdf->Text(15,23,$arrFirstRequestSlip[1]);
			$pdf->Text(15,26,$arrFirstRequestSlip[2]);
			$pdf->Text(15,29,$arrFirstRequestSlip[3]);
			$pdf->Text(15,32,$arrFirstRequestSlip[4]."  ".$arrFirstRequestSlip[5]);
			$pdf->Text(15,35,$arrFirstRequestSlip[6]." ".$arrFirstRequestSlip[7]);
			$pdf->Text(15,38,'(R)');
			$pdf->Text(15,41,'(O)');
			$pdf->Text(15,44,'(W)');
			$pdf->Text(21,38,$arrFirstRequestSlip[8]);
			$pdf->Text(21,41,$arrFirstRequestSlip[9]);
			$pdf->Text(21,44,$arrFirstRequestSlip[10]);
			$pdf->SetFont('Arial','',6);
			$pdf->Text(17,50,"If undelivered return to $bankDetails->bank_name");
			$pdf->Text(17,53,$arrFirstRequestSlip[16]);
			$pdf->Text(17,56,$arrFirstRequestSlip[17]);
			$pdf->Text(17,59,"".$arrFirstRequestSlip[19]." ".$arrFirstRequestSlip[20]."");
			
			
			$pdf->SetFont('Arial','',7);
			$pdf->Text(91,20,'Please supply _ _ _ _ _ _ _ _ book(s)');
			$pdf->Image(dirname(__FILE__)."\images\checkbox.png",155,18);
			$pdf->Text(158,20,'25 Leaves');
			$pdf->Image(dirname(__FILE__)."\images\checkbox.png",175,18);
			$pdf->Text(178,20,'50 Leaves');
			$pdf->Text(91,23,'I/We agree and acknowledge that the cheque book(s) ');
			$pdf->Image(dirname(__FILE__)."\images\checkbox.png",91,24);
			$pdf->Text(94,26,'Will be collected at the Branch by the undersigned or ');
			$pdf->Image(dirname(__FILE__)."\images\checkbox.png",91,27);
			$pdf->Text(94,29,'Will be dispatched by courier');
			$pdf->Text(91,32,$rowrequestslip->requestfield3);
			$pdf->Text(91,35,$rowrequestslip->requestfield4);
			$pdf->Text(91,38,$rowrequestslip->requestfield5);
			$pdf->Text(91,41,$rowrequestslip->requestfield6);
			$pdf->Text(91,44,$rowrequestslip->requestfield7);
			$pdf->Text(91,47,$rowrequestslip->requestfield8);
			$pdf->Text(91,50,$rowrequestslip->requestfield9);
			$pdf->Text(91,53,'RESI_ _ _ _ _ _ _ _/');
			$pdf->Text(117,53,'OFF_ _ _ _ _ _ _ _ /');
			$pdf->Text(143,53,'MOBILE_ _ _ _ _ _ _ _ /');
			$pdf->Text(95,60,'A/c no :');
			$pdf->Text(106,60,$arrFirstRequestSlip[11]);
			$pdf->Text(105,63,'Mail-ID :');
			$pdf->Text(117,63,$arrFirstRequestSlip[12]);
			$pdf->Text(165,63,'Res Tel :');
			$pdf->Text(179,63,$arrFirstRequestSlip[8]);
			$pdf->Text(105,66,'Off Tel :');
			$pdf->Text(117,66,$arrFirstRequestSlip[9]);
			$pdf->Text(165,66,'Mobile No :');
			$pdf->Text(179,66,$arrFirstRequestSlip[10]);
			$pdf->Text(131,69,'Cheque leaves enclosed :');
			$pdf->Text(160,69,$arrFirstRequestSlip[13]);
			$pdf->Text(131,72,'Cheque series From :');
			$pdf->Text(155,72,$arrFirstRequestSlip[14]);
			$pdf->Text(166,72,'To :');
			$pdf->Text(171,72,$arrFirstRequestSlip[15]);
			$pdf->Text(18,76,$rowrequestslip->requestfield10);
			$pdf->Text(18,79,$rowrequestslip->requestfield11);
			$pdf->Text(165,82,'Signature(s) of Account Holder');
			
			
			
			
			
			
			
			
			
			if($noOfRequestSlip>1)
			{
				//Second request slip
				$pdf->SetFont('Arial','',8);
				$pdf->Text(15,115,$arrSecondRequestSlip[0]);
				$pdf->Text(15,118,$arrSecondRequestSlip[1]);
				$pdf->Text(15,121,$arrSecondRequestSlip[2]);
				$pdf->Text(15,124,$arrSecondRequestSlip[3]);
				$pdf->Text(15,127,$arrSecondRequestSlip[4]."  ".$arrSecondRequestSlip[5]);
				$pdf->Text(15,130,$arrSecondRequestSlip[6]." ".$arrSecondRequestSlip[7]);
				$pdf->Text(15,133,'(R)');
				$pdf->Text(15,136,'(O)');
				$pdf->Text(15,139,'(W)');
				$pdf->Text(21,133,$arrSecondRequestSlip[8]);
				$pdf->Text(21,136,$arrSecondRequestSlip[9]);
				$pdf->Text(21,139,$arrSecondRequestSlip[10]);
				$pdf->SetFont('Arial','',6);
				$pdf->Text(17,148,"If undelivered return to $bankDetails->bank_name");
				$pdf->Text(17,151,$arrSecondRequestSlip[16]);
				$pdf->Text(17,154,$arrSecondRequestSlip[17]);
				$pdf->Text(17,157,"".$arrSecondRequestSlip[19]." ".$arrSecondRequestSlip[20]."");
				
				
				$pdf->SetFont('Arial','',7);
				$pdf->Text(91,115,'Please supply _ _ _ _ _ _ _ _ book(s) ');
				$pdf->Image(dirname(__FILE__)."\images\checkbox.png",155,113);
				$pdf->Text(158,115,'25 Leaves');
				$pdf->Image(dirname(__FILE__)."\images\checkbox.png",175,113);
				$pdf->Text(178,115,'50 Leaves');
				$pdf->Text(91,118,'I/We agree and acknowledge that the cheque book(s) ');
				$pdf->Image(dirname(__FILE__)."\images\checkbox.png",91,119);
				$pdf->Text(94,121,'Will be collected at the Branch by the undersigned or ');
				$pdf->Image(dirname(__FILE__)."\images\checkbox.png",91,122);
				$pdf->Text(94,124,'Will be dispatched by courier');
				$pdf->Text(91,127,$rowrequestslip->requestfield3);
				$pdf->Text(91,130,$rowrequestslip->requestfield4);
				$pdf->Text(91,133,$rowrequestslip->requestfield5);
				$pdf->Text(91,136,$rowrequestslip->requestfield6);
				$pdf->Text(91,139,$rowrequestslip->requestfield7);
				$pdf->Text(91,142,$rowrequestslip->requestfield8);
				$pdf->Text(91,145,$rowrequestslip->requestfield9);
				$pdf->Text(91,148,'RESI_ _ _ _ _ _ _ _/');
				$pdf->Text(117,148,'OFF_ _ _ _ _ _ _ _ /');
				$pdf->Text(143,148,'MOBILE_ _ _ _ _ _ _ _ /');
				$pdf->Text(95,155,'A/c no :');
				$pdf->Text(106,155,$arrSecondRequestSlip[11]);
				$pdf->Text(105,158,'Mail-ID :');
				$pdf->Text(117,158,$arrSecondRequestSlip[12]);
				$pdf->Text(165,158,'Res Tel :');
				$pdf->Text(179,158,$arrSecondRequestSlip[8]);
				$pdf->Text(105,161,'Off Tel :');
				$pdf->Text(117,164,$arrSecondRequestSlip[9]);
				$pdf->Text(165,161,'Mobile No :');
				$pdf->Text(179,161,$arrSecondRequestSlip[10]);
				$pdf->Text(131,164,'Cheque leaves enclosed :');
				$pdf->Text(160,164,$arrSecondRequestSlip[13]);
				$pdf->Text(131,167,'Cheque series From :');
				$pdf->Text(155,167,$arrSecondRequestSlip[14]);
				$pdf->Text(166,167,'To :');
				$pdf->Text(171,167,$arrSecondRequestSlip[15]);
				$pdf->Text(18,171,$rowrequestslip->requestfield10);
				$pdf->Text(18,174,$rowrequestslip->requestfield11);
				$pdf->Text(165,177,'Signature(s) of Account Holder');
				
				
				$pdf->SetFont('Arial','',8);
				$pdf->Text(15,215,$arrThirdRequestSlip[0]);
				$pdf->Text(15,218,$arrThirdRequestSlip[1]);
				$pdf->Text(15,221,$arrThirdRequestSlip[2]);
				$pdf->Text(15,224,$arrThirdRequestSlip[3]);
				$pdf->Text(15,227,$arrThirdRequestSlip[4]."  ".$arrThirdRequestSlip[5]);
				$pdf->Text(15,230,$arrThirdRequestSlip[6]." ".$arrThirdRequestSlip[7]);
				$pdf->Text(15,233,'(R)');
				$pdf->Text(15,236,'(O)');
				$pdf->Text(15,239,'(W)');
				$pdf->Text(21,233,$arrThirdRequestSlip[8]);
				$pdf->Text(21,236,$arrThirdRequestSlip[9]);
				$pdf->Text(21,239,$arrThirdRequestSlip[10]);
				$pdf->SetFont('Arial','',6);
				$pdf->Text(17,245,"If undelivered return to $bankDetails->bank_name");
				$pdf->Text(17,248,$arrThirdRequestSlip[16]);
				$pdf->Text(17,251,$arrThirdRequestSlip[17]);
				$pdf->Text(17,254,"".$arrThirdRequestSlip[19]." ".$arrThirdRequestSlip[20]."");
				
				
				$pdf->SetFont('Arial','',7);
				$pdf->Text(91,215,'Please supply _ _ _ _ _ _ _ _ book(s) ');
				$pdf->Image(dirname(__FILE__)."\images\checkbox.png",155,213);
				$pdf->Text(158,215,'25 Leaves');
				$pdf->Image(dirname(__FILE__)."\images\checkbox.png",175,213);
				$pdf->Text(178,215,'50 Leaves');
				$pdf->Text(91,218,'I/We agree and acknowledge that the cheque book(s) ');
				$pdf->Image(dirname(__FILE__)."\images\checkbox.png",91,219);
				$pdf->Text(94,221,'Will be collected at the Branch by the undersigned or ');
				$pdf->Image(dirname(__FILE__)."\images\checkbox.png",91,222);
				$pdf->Text(94,224,'Will be dispatched by courier');
				$pdf->Text(91,227,$rowrequestslip->requestfield3);
				$pdf->Text(91,230,$rowrequestslip->requestfield4);
				$pdf->Text(91,233,$rowrequestslip->requestfield5);
				$pdf->Text(91,236,$rowrequestslip->requestfield6);
				$pdf->Text(91,239,$rowrequestslip->requestfield7);
				$pdf->Text(91,241,$rowrequestslip->requestfield8);
				$pdf->Text(91,244,$rowrequestslip->requestfield9);
				$pdf->Text(91,247,'RESI_ _ _ _ _ _ _ _/');
				$pdf->Text(117,247,'OFF_ _ _ _ _ _ _ _ /');
				$pdf->Text(143,247,'MOBILE_ _ _ _ _ _ _ _ /');
				$pdf->Text(95,250,'A/c no :');
				$pdf->Text(106,250,$arrThirdRequestSlip[11]);
				$pdf->Text(105,253,'Mail-ID :');
				$pdf->Text(117,253,$arrThirdRequestSlip[12]);
				$pdf->Text(165,253,'Res Tel :');
				$pdf->Text(179,253,$arrThirdRequestSlip[8]);
				$pdf->Text(105,256,'Off Tel :');
				$pdf->Text(117,256,$arrThirdRequestSlip[9]);
				$pdf->Text(165,256,'Mobile No :');
				$pdf->Text(179,256,$arrThirdRequestSlip[10]);
				$pdf->Text(131,259,'Cheque leaves enclosed :');
				$pdf->Text(160,259,$arrThirdRequestSlip[13]);
				$pdf->Text(131,262,'Cheque series From :');
				$pdf->Text(155,262,$arrThirdRequestSlip[14]);
				$pdf->Text(166,262,'To :');
				$pdf->Text(171,262,$arrThirdRequestSlip[15]);
				$pdf->Text(18,266,$rowrequestslip->requestfield10);
				$pdf->Text(18,269,$rowrequestslip->requestfield11);
				$pdf->Text(165,272,'Signature(s) of Account Holder');
			}
			
			$pdf->Output("Slip.pdf",'F');
			$imagePath = dirname(__FILE__)."\Slip.pdf";
			//$printObj = new COM('PrintChequeTesing.Print');
			//echo $printObj->PrintPdfs($imagePath,'Tray 1');
			//echo $printObj->PrintPDF("Lexmark E260dn",$imagePath,'1');
			//echo $printObj->PrintPDF("HP LaserJet P4014/P4015 PCL6",$imagePath,"Tray 3");

		}
		
		function printCheques($type,$firstchequedata,$secondchequedata,$thirdchequedata,$noofCheque)
		{
			echo "gfgfd";
			global $db;
			$imagePath = dirname(__FILE__)."\images\chequeimages\jpg.jpg";
			$sqlPrinterSettings = "SELECT printermodels.* FROM tb_cps_settings settings JOIN tb_cps_printermodels printermodels ON printermodels.model_id = settings.printermodel";
			$rowPrinterSettings = $db->get_row($sqlPrinterSettings);
			
			$firstChequeCordinates = "".$rowPrinterSettings->cheque1_branchaddressline1X .":".$rowPrinterSettings->cheque1_branchaddressline1Y .":".$rowPrinterSettings->cheque1_branchaddressline2X .":".$rowPrinterSettings->cheque1_branchaddressline2Y .":".$rowPrinterSettings->cheque1_branchaddressline3X .":".$rowPrinterSettings->cheque1_branchaddressline3Y .":".$rowPrinterSettings->cheque1_accountnoX .":".$rowPrinterSettings->cheque1_accountnoY .":".$rowPrinterSettings->cheque1_accountholdernameX .":".$rowPrinterSettings->cheque1_accountholdernameY .":".$rowPrinterSettings->cheque1_authorizedsignatoryX .":".$rowPrinterSettings->cheque1_authorizedsignatoryY .":".$rowPrinterSettings->cheques_trancodeX.":".$rowPrinterSettings->cheques_micraccnoX.":".$rowPrinterSettings->cheques_sortcodeX.":".$rowPrinterSettings->cheques_chequenoX.":".$rowPrinterSettings->cheque1_micrbandY."";
			$secondChequeCordinates = "".$rowPrinterSettings->cheque2_branchaddressline1X .":".$rowPrinterSettings->cheque2_branchaddressline1Y .":".$rowPrinterSettings->cheque2_branchaddressline2X .":".$rowPrinterSettings->cheque2_branchaddressline2Y .":".$rowPrinterSettings->cheque2_branchaddressline3X .":".$rowPrinterSettings->cheque2_branchaddressline3Y .":".$rowPrinterSettings->cheque2_accountnoX .":".$rowPrinterSettings->cheque2_accountnoY .":".$rowPrinterSettings->cheque2_accountholdernameX .":".$rowPrinterSettings->cheque2_accountholdernameY .":".$rowPrinterSettings->cheque2_authorizedsignatoryX .":".$rowPrinterSettings->cheque2_authorizedsignatoryY .":".$rowPrinterSettings->cheques_trancodeX.":".$rowPrinterSettings->cheques_micraccnoX.":".$rowPrinterSettings->cheques_sortcodeX.":".$rowPrinterSettings->cheques_chequenoX.":".$rowPrinterSettings->cheque2_micrbandY."";
			$thirdChequeCordinates = "".$rowPrinterSettings->cheque3_branchaddressline1X .":".$rowPrinterSettings->cheque3_branchaddressline1Y .":".$rowPrinterSettings->cheque3_branchaddressline2X .":".$rowPrinterSettings->cheque3_branchaddressline2Y .":".$rowPrinterSettings->cheque3_branchaddressline3X .":".$rowPrinterSettings->cheque3_branchaddressline3Y .":".$rowPrinterSettings->cheque3_accountnoX .":".$rowPrinterSettings->cheque3_accountnoY .":".$rowPrinterSettings->cheque3_accountholdernameX .":".$rowPrinterSettings->cheque3_accountholdernameY .":".$rowPrinterSettings->cheque3_authorizedsignatoryX .":".$rowPrinterSettings->cheque3_authorizedsignatoryY .":".$rowPrinterSettings->cheques_trancodeX.":".$rowPrinterSettings->cheques_micraccnoX.":".$rowPrinterSettings->cheques_sortcodeX.":".$rowPrinterSettings->cheques_chequenoX.":".$rowPrinterSettings->cheque3_micrbandY."";
			$font = $rowPrinterSettings->font;
			//sleep(4);
			//$printObj = new COM('PrintChequeTesing.Print');
			//echo $printObj->PrintCheque($imagePath,$type,$firstchequedata,$secondchequedata,$thirdchequedata,$firstChequeCordinates,$secondChequeCordinates,$thirdChequeCordinates,$font,$noofCheque);
			$arrFirstChequeData = explode("~",$firstchequedata);
			$arrSecondChequeData = explode("~",$secondchequedata);
			$arrThirdChequeData = explode("~",$thirdchequedata);
			$micrcode = "C" . $arrFirstChequeData[0] . "C " . $arrFirstChequeData[1] ."". $arrFirstChequeData[2] . "" . $arrFirstChequeData[3]. "A ". $arrFirstChequeData[4] ."C ".$arrFirstChequeData[6];
			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','',7);
			$pdf->Text(43,12,$arrFirstChequeData[14]);
			$pdf->Text(43,15,"".$arrFirstChequeData[15].", ".$arrFirstChequeData[17]." - ".$arrFirstChequeData[18]."");
			$pdf->Text(43,18,"RTGS/IFSC CODE : ".$arrFirstChequeData[19]."");
			$pdf->SetFont('Arial','',9);
			$pdf->Text(51,50,$arrFirstChequeData[5]);
			$pdf->Text(151,50,$arrFirstChequeData[7]);
			$pdf->AddFont('E-13B_0','','E-13B_0.php');
			$pdf->SetFont('E-13B_0','',12);
			$pdf->Text(57,86,$micrcode);
	
			if ($noofCheque > 1)
			{
				$micrcode = "C" . $arrSecondChequeData[0] . "C " . $arrSecondChequeData[1] ."". $arrSecondChequeData[2] . "" . $arrSecondChequeData[3]. "A ". $arrSecondChequeData[4] ."C ".$arrSecondChequeData[6];
				$pdf->SetFont('Arial','',7);
				$pdf->Text(43,105,$arrSecondChequeData[14]);
				$pdf->Text(43,108,"".$arrSecondChequeData[15].", ".$arrSecondChequeData[17]." - ".$arrSecondChequeData[18]."");
				$pdf->Text(43,111,"RTGS/IFSC CODE : ".$arrSecondChequeData[19]."");
				$pdf->SetFont('Arial','',9);
				$pdf->Text(51,143,$arrSecondChequeData[5]);
				$pdf->Text(151,143,$arrSecondChequeData[7]);
				
				$pdf->AddFont('E-13B_0','','E-13B_0.php');
				$pdf->SetFont('E-13B_0','',12);
				$pdf->Text(57,180,$micrcode);
			}
			
			if ($noofCheque > 2)
			{
				$micrcode = "C" . $arrThirdChequeData[0] . "C " . $arrThirdChequeData[1] ."". $arrThirdChequeData[2] . "" . $arrThirdChequeData[3]. "A ". $arrThirdChequeData[4] ."C ".$arrThirdChequeData[6];
				$pdf->SetFont('Arial','',7);
				$pdf->Text(43,198,$arrThirdChequeData[14]);
				$pdf->Text(43,201,"".$arrThirdChequeData[15].", ".$arrThirdChequeData[17]." - ".$arrThirdChequeData[18]."");
				$pdf->Text(43,204,"RTGS/IFSC CODE : ".$arrThirdChequeData[19]."");
				$pdf->SetFont('Arial','',9);
				$pdf->Text(51,237,$arrThirdChequeData[5]);
				$pdf->Text(151,237,$arrThirdChequeData[7]);
				$pdf->AddFont('E-13B_0','','E-13B_0.php');
				$pdf->SetFont('E-13B_0','',12);
				$pdf->Text(57,273,$micrcode);
			}
			$pdf->Output("Cheque.pdf",'F');
			$imagePath = dirname(__FILE__)."\Cheque.pdf";
			$printObj = new COM('PrintChequeTesing.Print');
			
			//echo $printObj->PrintPdfs($imagePath,'Tray 2');
			echo $printObj->PrintPDF("Lexmark E260dn",$imagePath,'Tray 2');
			//echo $printObj->PrintPDF("Canon LBP3300",$imagePath,'Cassette 2');
			//echo $printObj->PrintPDF("HP LaserJet P4014/P4015 PCL6",$imagePath,'Tray 2');
			
		}
		
		
		
	//Close Database		
	$db->closeDb();
	?>
	
	</div>
</div>
</body>
</html>
