<?php 
require_once 'global.php';
authentication_print();
require_once(ROOT_CLASSES.'tcpdf/config/lang/eng.php');
require_once(ROOT_CLASSES.'tcpdf/tcpdf.php');
//print_r($_REQUEST);
if(isset($_REQUEST['type']) && !empty($_REQUEST['type']) && $_REQUEST['type'] == 'search'  && 
	 isset($_REQUEST['cust']) && !empty($_REQUEST['cust']) ) {
		$sql = "SELECT tb_print_req_collection.*, tb_printadmin.`userid` FROM tb_print_req_collection LEFT OUTER JOIN tb_printadmin ON cps_process_user_id = adminid where cps_act_name LIKE '%".$_REQUEST['cust']."%' ";
}else{
	echo "Invalid Location!!!!!";
	die();
} 

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CPS');
$pdf->SetTitle('Customer Report');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');	

// set default header data
$pdf->SetHeaderData('', '', 'Customer Report', '');

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

						$data = '<table cellpadding="3" cellspacing="0" border="1" width="93%">
                            <tr style="font-weight:bold; border:1px #cccccc">								
								<td width="17%" class="thwidthth" align="center">Operator</td>								
								<td width="17%" height="35px" class="thwidthth" align="center">Acc. No</td>
								<td width="20%" class="thwidthth" align="center">Name</td>								
								<td width="17%" class="thwidthth" align="center">Chq From</td>
								<td width="17%" class="thwidthth" align="center">Chq To</td>						
								<td width="17%" class="thwidthth" align="center">Date Of Issue</td>
                            </tr>';
	    foreach($result as $row) {

							$data .= '<tr>
								<td class="thwidthtd" align="center">'.$row->userid.'</td>								
								<td style="padding-top:5px;" height="25px" align="center">'.$row->cps_account_no.'</td>
								<td class="thwidthtd" align="center">'.$row->cps_act_name.'</td>								
								<td class="thwidthtd" align="center">'.$row->cps_chq_no_from.'</td>
								<td class="thwidthtd" align="center">'.$row->cps_chq_no_to.'</td>
								<td class="thwidthtd" align="center">'.date('d-m-Y', strtotime($row->cps_date)).'</td>													
                            </tr>' ;

	}
	$data .= '</table>';$pdf->writeHTML($data, true, false, false, false, '');
$pdf->Output('report-'.time().'.pdf', 'I');
}
?>