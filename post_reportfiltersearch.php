<?php require_once('global.php');
		
	if(isset($_GET["searchby"]) && $_GET["searchby"] != ""){
		if($_GET["searchby"] == "cps_tr_code"){
			$querysearchresult = "SELECT * FROM tb_cps_transactioncodes";
			$resultsearchby = $db->get_results($querysearchresult);
			echo "<select name='ddlsearchtext' id='ddlsearchtext' style='width: 220px;'>";
			foreach($resultsearchby as $rowsearch):
				echo "<option value='". $rowsearch->transactioncode ."'>".$rowsearch->transactioncodedescription."</option>";
			endforeach;
			echo "</select>";
		}
		else if($_GET["searchby"] == "cps_process_user_id"){
			$querysearchresult = "SELECT * FROM tb_printadmin";
			$resultsearchby = $db->get_results($querysearchresult);
			echo "<select name='ddlsearchtext' id='ddlsearchtext' style='width: 220px;'>";
			foreach($resultsearchby as $rowsearch):
				echo "<option value='". $rowsearch->adminid ."'>".$rowsearch->username."</option>";
			endforeach;
			echo "</select>";
		}		
	}
	else{
		echo "<select name='ddlsearchtext' id='ddlsearchtext' style='width: 220px;'>";
		echo "<option value=''>== No Records ==</option>";
		echo "</select>";
	}	
?>