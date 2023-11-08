<?php 
require_once 'global.php';
require_once(ROOT_CLASSES.'tcpdf/config/lang/eng.php');
require_once(ROOT_CLASSES.'tcpdf/tcpdf.php');
$sql = "select * from tb_cps_mapfieldstest";

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CPS');
$pdf->SetTitle('Map Fields');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');	

// set default header data
$pdf->SetHeaderData('', '', 'Mapped Fields Report', '');

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

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

if($result = $db->get_results($sql)){

						$data = '<table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr style="font-weight:bold; border:1px #cccccc">
                              <td width="4%" class="thwidthth" align="center">Sr no</td>
                              <td width="24%" class="thwidthth" align="center">Field Name</td>
                              <td width="12%" class="thwidthth" align="center">Field Data Type</td>
                              <td width="12%" class="thwidthth" align="center">Field Length</td>                              
                              <td width="12%" class="thwidthth" align="center">Bank Field Name</td>
                              <td width="10%" class="thwidthth" align="center">Bank Data Type</td>
                              <td width="8%" class="thwidthth" align="center">Bank Field Length</td>
                            </tr>' ;
	foreach($result as $row) {

							$data .= '<tr>
                              <td class="thwidthtd" align="center">'.$row->fieldid.'</td>
                              <td class="thwidthtd" align="center">'.$row->fieldname.'</td>
							  <td class="thwidthtd" align="center">'.$row->fielddatatype.'</td>
                              <td class="thwidthtd" align="center">'.$row->fieldlength.'</td>
                              <td class="thwidthtd" align="center">'.$row->bankfieldname.'</td>
                              <td class="thwidthtd" align="center">'.$row->bankfielddatatype.'</td>
                              <td class="thwidthtd" align="center">'.$row->bankfieldlength.'</td>
                            </tr>' ;

	}
	$data .= '</table>';
	//echo $data;
$pdf->writeHTML($data, true, false, false, false, '');
$pdf->Output('MapField-'.time().'.pdf', 'I');
}
?>