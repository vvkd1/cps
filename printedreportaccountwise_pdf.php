<?php 
require_once 'global.php';
authentication_print();
require_once(ROOT_CLASSES.'tcpdf/config/lang/eng.php');
require_once(ROOT_CLASSES.'tcpdf/tcpdf.php');
//print_r($_REQUEST);
if(isset($_REQUEST['type']) && !empty($_REQUEST['type']) && $_REQUEST['type'] == 'search'  && 
	 isset($_REQUEST['acno']) && !empty($_REQUEST['acno']) ) {
		$sql = "select * from tb_print_req_collection where cps_micr_account_no = '".$_REQUEST['acno']."' ";
} 

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Check Printing');
$pdf->SetTitle('Account Wise Report');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');	

// set default header data
$pdf->SetHeaderData('', '', 'Account Wise Report', '');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------


// add a page
$pdf->AddPage();

//$pdf->Write(0, 'Sucessfully Printed Reports', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 10);

// -----------------------------------------------------------------------------

if($result = $db->get_results($sql)){

						$data = '<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr style="font-weight:bold;">
                              <td width="4%" class="thwidthth">ID</td>
                              <td width="12%" class="thwidthth">Branch Code</td>
                              <td width="13%" class="thwidthth">MIRC Acc. No</td>
                              <td width="24%" class="thwidthth">Joint Name1</td>                              
                              <td width="12%" class="thwidthth">No Of Books</td>
                              <td width="10%" class="thwidthth">Book Size</td>
                              <td width="8%" class="thwidthth">Chq From</td>
                              <td width="8%" class="thwidthth">Chq To</td>
                              <td width="10%" class="thwidthth">Date</td>
                            </tr>' ;
	foreach($result as $row) {

							$data .= '<tr>
                              <td class="thwidthtd">'.$row->id.'</td>
                              <td class="thwidthtd">'.$row->cps_branch_code.'</td>
                              <td class="thwidthtd">'.$row->cps_micr_account_no.'</td>
                              <td class="thwidthtd">'.$row->cps_act_jointname1.'</td>
                             
                              <td class="thwidthtd">'.$row->cps_no_of_books.'</td>
                              <td class="thwidthtd">'.$row->cps_book_size.'</td>
                              <td class="thwidthtd">'.$row->cps_chq_no_from.'</td>
                              <td class="thwidthtd">'.$row->cps_chq_no_to.'</td>
                              <td class="thwidthtd">'.date('d-m-Y', strtotime($row->cps_date)).'</td>
                            </tr>' ;

	}
	$data .= '</table>';
	//echo $data;
$pdf->writeHTML($data, true, false, false, false, '');
$pdf->Output('report-'.time().'.pdf', 'I');
}
?>