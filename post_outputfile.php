<?php
require_once('global.php');
$result = $db->get_row("SELECT outputfileformat,outputfolderpath from tb_cps_settings");

function ASCIIFileOutput($fromdate, $todate, $branch)
{
	header("Content-Type: plain/text");
	header("Content-Disposition: Attachment; filename=Output-".$fromdate."to".$todate.".txt");
	header("Pragma: no-cache");
	
	global $db;
	//echo "frm-".$fromdate;		
	//echo "to-".$todate;
	//echo "br-".$branch;
	$SearchString = "";
	$count = 1;
	if($fromdate != "" && $todate != "")
	{
		if($count == 1){
			$SearchString .= " where cps_date between '".date('Y-m-d',strtotime($fromdate))."' and '".date('Y-m-d', strtotime($todate))."' ";
		}else{
			$SearchString .= " and cps_date between '".date('Y-m-d',strtotime($fromdate))."' and '".date('Y-m-d', strtotime($todate))."' ";			
		}
		$count++;
	}
	if($branch != "")
	{
		if($count == 1){
			$SearchString .= " where cps_branchmicr_code = '".$branch."' ";
		}else{
			$SearchString .= " and cps_branchmicr_code = '".$branch."' ";
		}
		$count++;
	}
	$sql = "select * from tb_print_req_collection  ".$SearchString." AND cps_tr_code not in(12)";
	if(isset($_GET['cps_atpar']) && !empty($_GET['cps_atpar']))
	{
		$sql .= " && cps_atpar = ".$_GET['cps_atpar'];
	}
	if(isset($_GET['cps_book_size']) && !empty($_GET['cps_book_size']))
	{
		$sql .= " && cps_book_size = ".$_GET['cps_book_size'];
	}
	if($result = $db->get_results($sql)) {
		$outString = "";
		foreach($result as $row) {									
			$id = stripslashes($row->id);	
			$uniqueReq = stripslashes($row->cps_unique_req);
			$branchcode = stripslashes($row->cps_branchmicr_code );
			//$trCode = stripslashes($row->cps_tr_code );
			$accountno = stripslashes($row->cps_account_no);
			$chknofrom = stripslashes($row->cps_chq_no_from);
			$chknoto = stripslashes($row->cps_chq_no_to);
			$noofbooks = stripslashes($row->cps_no_of_books);
			$booksize = stripslashes($row->cps_book_size);
			//$bearOrder = stripslashes($row->cps_dly_bearer_order);
			//$atpar = stripslashes($row->cps_atpar);
			if($atpar == "1")
				$atpar = "Y";
			else
				$atpar = "N";
				
			$outString .=  $uniqueReq."~".$branchcode."~".$accountno."~".$chknofrom."~".$chknoto."~".$noofbooks."~".$booksize."\r\n";
		}
	}
	echo $outString;
}
	
function ExcelOutput($fromdate, $todate, $branch){

	include_once "classes/PHPExcel.php";
	
	//Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
			
	//Set properties
	$objPHPExcel->getProperties()->setCreator("iThink Infotech")
								 ->setLastModifiedBy("iThink Infotech")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
						 		 ->setKeywords("office 2007 openxml php")
						 		 ->setCategory("OutPut-File File");

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	
	//$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
	
	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('OutPut-File');
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	        		    		
	//qry
	global $db;
	
	$SearchString = "";
		$count = 1;
		if($fromdate != "" && $todate != "")
		{
			if($count == 1){
				$SearchString .= " where cps_date between '".date('Y-m-d',strtotime($fromdate))."' and '".date('Y-m-d', strtotime($todate))."' ";
			}else{
				$SearchString .= " and cps_date between '".date('Y-m-d',strtotime($fromdate))."' and '".date('Y-m-d', strtotime($todate))."' ";			
			}
			$count++;
		}
		if($branch != "")
		{
			if($count == 1){
				$SearchString .= " where cps_branchmicr_code = '".$branch."' ";
			}else{
				$SearchString .= " and cps_branchmicr_code = '".$branch."' ";
			}
			$count++;
		}
	
	$sql = "select * from tb_print_req_collection  ".$SearchString." AND cps_tr_code not in(12)";
	if(isset($_GET['cps_atpar']) && !empty($_GET['cps_atpar']))
	{
		$sql .= " && cps_atpar = ".$_GET['cps_atpar'];
	}
	if(isset($_GET['cps_book_size']) && !empty($_GET['cps_book_size']))
	{
		$sql .= " && cps_book_size = ".$_GET['cps_book_size'];
	}
//	echo $sql;exit;
	if($result = $db->get_results($sql)) {
	
		$objPHPExcel->getActiveSheet()->setCellValueExplicit("A1", 'Customer short name', PHPExcel_Cell_DataType::TYPE_STRING);	
		$objPHPExcel->getActiveSheet()->setCellValueExplicit("B1", 'a/c. No.', PHPExcel_Cell_DataType::TYPE_STRING);	
		$objPHPExcel->getActiveSheet()->setCellValueExplicit("C1", 'Cheque Series', PHPExcel_Cell_DataType::TYPE_STRING);
		
		$j = 2;
		foreach($result as $row) {	
			
			$objPHPExcel->getActiveSheet()->setCellValueExplicit("A$j", $row->cps_short_name, PHPExcel_Cell_DataType::TYPE_STRING);	
			$objPHPExcel->getActiveSheet()->setCellValueExplicit("B$j", $row->cps_account_no, PHPExcel_Cell_DataType::TYPE_STRING);	
			$objPHPExcel->getActiveSheet()->setCellValueExplicit("C$j", $row->cps_chq_no_from.'-'.$row->cps_chq_no_to, PHPExcel_Cell_DataType::TYPE_STRING);			
			$j++;
		}
	}
	else{
		echo "ELSE";exit;	
		}
	
	
	//while($row = mysql_fetch_object($rs))
	//{	
		//$j++;
	//}
	
	// Redirect output to a client's web browser (Excel5)
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="OutPut-File('.date('d-m-Y h:i:s A').').xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

}

if((isset($_REQUEST['frm']) && isset($_REQUEST['to'])) || (isset($_REQUEST['ddlBranchName']))){
	
	if(isset($_REQUEST['frm']) != "" && $_REQUEST['to'] != ""){
		$fromdate = $_REQUEST['frm'];
		$todate = $_REQUEST['to'];
	}
	else{
		$fromdate = "";
		$todate = "";
	}
	
	if($_REQUEST['ddlBranchName'] != ""){
		$branch = $_REQUEST['ddlBranchName'];
	}
	else
	{
		$branch = "";
	}
	
	if($result->outputfileformat == "ASCII"){
		ASCIIFileOutput($fromdate, $todate, $branch);
	}
	else if($result->outputfileformat == "Excel"){
		ExcelOutput($fromdate, $todate, $branch);
	}
}
				
?>