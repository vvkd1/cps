<?php
require_once 'global.php';
ob_start();

$today = date("Y-m-d H:i:s");
/*header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$today.".csv");
$output = fopen('php://output', 'w');
*/
 
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
		$sql .= " and cps_atpar = ".$_GET['cps_atpar'];
	}
	if(isset($_GET['cps_book_size']) && !empty($_GET['cps_book_size']))
	{
		$sql .= " and  cps_book_size = ".$_GET['cps_book_size'];
	}


 

 $result = $db->get_results($sql);
//$result = mysqli_query($conn,$sql)or die(mysqli_error($conn));
 
 $data = '';
//while ($row=mysqli_fetch_row($result)) {
foreach ($result as $key => $row) {
	  
	    //$micr ='0000'.$row[9].'0'.$row[9];
	    $micr ='0000'.$row->cps_tr_code.'0'.$row->cps_tr_code;
	    //$ac =str_replace("017010100000","",$row[4]).str_replace("-","",$row[33]);
	    $ac =str_replace("017010100000","",$row->cps_account_no).str_replace("-","",$row->cps_date);
		
		if($row->cps_tr_code==18)
		{
			$type=1;
			$t="SB";
			$num="10";
		}
		else
		{
			$type=2;
			$t="CA";
			$num="11";
		}
		
	        
   /*  fputcsv($output,
	         array(
			       $micr,
				   $ac,
				   '1',
				   $row[8],
				   $type,
				   $row[1],
				   $t,
				   $num.'00'.$ac.'0000'
			 
			       )
	 
	  
	         );*/
			 
	//echo $data.=$micr."\t".$ac."\t".'1'."\t".$row[8]."\t".$type."\t".$row[1]."\t".$t."\t".$num.'00'.$ac.'0000';		 
	echo $data.=$micr."\t".$ac."\t".'1'."\t".$row->cps_book_size."\t".$type."\t".$row->cps_unique_req."\t".$t."\t".$num.'00'.$ac.'0000';		 
   
}
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
header('Content-disposition: attachment; filename='.$today.'.txt');
echo $data;
				
?>