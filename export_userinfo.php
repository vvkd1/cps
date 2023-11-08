<?php	session_start();
require_once('global.php');

ini_set("memory_limit","-1");
ini_set('post_max_size', "200M");
ini_set('max_execution_time', 200000);

function xlsBOF() { 
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);  
    return; 
} 

function xlsEOF() { 
    echo pack("ss", 0x0A, 0x00); 
    return; 
} 

function xlsWriteNumber($Row, $Col, $Value) { 
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
    echo pack("d", $Value); 
    return; 
} 

function xlsWriteLabel($Row, $Col, $Value ) { 
    $L = strlen($Value); 
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
    echo $Value; 
return; 
}

// Send Header
    header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");;
	header("Content-Disposition: attachment;filename=users_information.xls "); 
	header("Content-Transfer-Encoding: binary ");
    // XLS Data Cell
		xlsBOF(); 
               	
				xlsWriteLabel(0,0,"Id");
                xlsWriteLabel(0,1,"Branch Code");	
				xlsWriteLabel(0,2,"Account No.");
				xlsWriteLabel(0,3,"Cudtomer name");
                xlsWriteLabel(0,4,"NO. Of Books");	
				xlsWriteLabel(0,5,"Book Size");	
				xlsWriteLabel(0,6,"Cheque From");
                xlsWriteLabel(0,7,"Cheque To");	
				xlsWriteLabel(0,8,"Issue Date");
				$xlsRow = 1;
											   
				$sql = "select cps_city_code,cps_branch_soleID,cps_act_name,id,cps_branch_code,cps_account_no,cps_act_name,cps_no_of_books,cps_book_size,cps_chq_no_from,cps_chq_no_to,cps_date from tb_print_req_collection";
				if($result = $db->get_results($sql)) {
					foreach($result as $row) {
						
						
						$id = stripslashes($row->id);						
						$branchcode = stripslashes($row->cps_branch_code);
						$accountno = stripslashes($row->cps_account_no);
						$accountname = stripslashes($row->cps_act_name);
						$noofbooks = stripslashes($row->cps_no_of_books);
						$booksize = stripslashes($row->cps_book_size);
						$chknofrom = stripslashes($row->cps_chq_no_from);
						$chknoto = stripslashes($row->cps_chq_no_to);
						$issuedate = stripslashes($row->cps_date);
						
						
						xlsWriteLabel($xlsRow, 0, $id);	
						xlsWriteLabel($xlsRow, 1, $branchcode);	
						xlsWriteLabel($xlsRow, 2, $accountno);
						xlsWriteLabel($xlsRow, 3, $accountname);	
						xlsWriteLabel($xlsRow, 4, $noofbooks);	
						xlsWriteLabel($xlsRow, 5, $booksize);	
						xlsWriteLabel($xlsRow, 6, $chknofrom);	
						xlsWriteLabel($xlsRow, 7, $chknoto);	
						xlsWriteLabel($xlsRow, 8, $issuedate);
						
                    	$xlsRow++;
					}
				}
				xlsEOF();
	exit();				
?>