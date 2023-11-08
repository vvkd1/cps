<?php require_once('global.php');
		
	if(isset($_REQUEST['todo']) && $_REQUEST['todo']=='edit' && isset($_REQUEST['id']) && !empty($_REQUEST['id']))
	{
		$row_series = $db->get_row("SELECT series_transationcode FROM tb_cps_chequeseries WHERE series_transationcode = '".GetSQLValueString($_POST['ddlTransactioncode'],'int')."' and series_branchcode = '".GetSQLValueString($_POST['ddlBranch'],'int')."' && series_id != ".GetSQLValueString($_REQUEST['id'],'int')."");
		//print_r($row_series);
		if($row_series)
		{
			echo '{"error":"true", "htmlcontent":"Cheque series for this branch is already exists"}';
			$db->closeDb();
			exit();
		}
		else
		{
			$row_series_branch_code = $db->get_row("SELECT branch_code FROM tb_branchdetails WHERE branch_id = '".GetSQLValueString($_POST['ddlBranch'],'int')."' ");
			$sql = "UPDATE tb_cps_chequeseries SET series_transationcode = '".GetSQLValueString($_POST['ddlTransactioncode'],'int')."',series_from = '".GetSQLValueString($_POST['txtFROM'],'int')."',series_to = '".GetSQLValueString($_POST['txtTo'],'int')."',series_lastno = '".GetSQLValueString($_POST['txtlastno'],'int')."',series_branchcode = '".GetSQLValueString($_POST['ddlBranch'],'int')."',serise_Bank = '1', serise_branchcode_branch = '".$row_series_branch_code->branch_code."'  WHERE series_id = ".GetSQLValueString($_REQUEST['id'],'int')."";
			$db->query($sql);	
			echo '{"status":"true"}';
			exit();
		}
	}
	else if(isset($_POST['txtlastno']) && !empty($_POST['txtlastno']) && $_POST['txtlastno'] != "") 
	{
		if(strlen($_POST['txtlastno']) != 6){
			echo '{"error":"true", "htmlcontent":"<span> Last Cheque Series No should be 6 digit</span>"}';
			$db->closeDb();
			exit();
		}else{		
			$row_series = $db->get_row("SELECT series_transationcode FROM tb_cps_chequeseries WHERE series_transationcode = '".GetSQLValueString($_POST['ddlTransactioncode'],'int')."' and series_branchcode = '".GetSQLValueString($_POST['ddlBranch'],'int')."'");
			if($row_series)
			{
				echo '{"error":"true", "htmlcontent":"Cheque series for this branch is already exists"}';
				$db->closeDb();
				exit();
			}
			else
			{
				$row_series_branch_code = $db->get_row("SELECT branch_code FROM tb_branchdetails WHERE branch_id = '".GetSQLValueString($_POST['ddlBranch'],'int')."' ");
				$sql = "INSERT INTO tb_cps_chequeseries (series_transationcode,series_branchcode,series_from,series_to,series_lastno,serise_Bank,serise_branchcode_branch) VALUES ('".GetSQLValueString($_POST['ddlTransactioncode'],'int')."','".GetSQLValueString($_POST['ddlBranch'],'int')."','".GetSQLValueString($_POST['txtFROM'],'int')."','".GetSQLValueString($_POST['txtTo'],'int')."','".GetSQLValueString($_POST['txtlastno'],'int')."','1','".$row_series_branch_code->branch_code."')";
				$db->query($sql);	
				echo '{"status":"true"}';
				exit();
			}			
		}		
	}
	
	if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'del') && isset($_REQUEST['id']) && !empty($_REQUEST['id']) ) {
		$db->query("delete from tb_cps_chequeseries where series_id  = ".$_REQUEST['id']."");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
	}
	
?>

