<?php
require_once('global.php');
$page_name = "printed_report";
authentication_print();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$("#search, #button").button();
	$('#from_date, #to_date').datepicker({changeMonth: true, changeYear: true, showButtonPanel: false, yearRange:'-70:Y', maxDate: 'D', dateFormat: 'dd-mm-yy' });	
});

function recuired(){
	if(document.getElementById("to_date").value == "" || document.getElementById("from_date").value == ""){
		document.getElementById("divmsg").innerHTML = 'Please select to and from date';
		return false;
	}else{
		document.getElementById("divmsg").innerHTML = '';
	}
}

</script>
</head>
<body>
<?php require_once('header.php');	?>
      <div id="formdiv">
        <div id="formheading">Sucessfully Printed Reports</div>
        <div id="formfields">
          
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              
              <tr><td><div id="divmsg" class="red"><div></td></tr>
			  <tr><td>&nbsp;</td></tr>
              <tr>
                <td align="center" valign="top" style="border: 1px solid; border-color: #cccccc;">
				<table width="969" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">
					  <?php 
						$sql_trcodes = "select * from tb_cps_transactioncodes";
						if($result = $db->get_results($sql_trcodes)){							
					  ?>
                        <div style="width:1000px; overflow-x:scroll;overflow-y:hidden; margin:0px; padding:0px;" id="divshowdetails" name="divshowdetails">
                          
						  
						<?php
						
						
						$chkbk_rquest = array();

						$sql = 'SELECT transactioncode,transactioncodedescription FROM tb_cps_transactioncodes';
						$acc_type = array();
						if($results = $db->get_results($sql)){
							foreach($results as $row){
								
								$acc_type[$row->transactioncode] = $row->transactioncodedescription;
							}
						}

						$cps_book_size = array();
						$cps_book_size1 = array();
						$sql = 'SELECT cps_process_user_id,cps_book_size,transactioncode,transactioncodedescription,COUNT(*) as total_count
								FROM `db_singlebankcps`.`tb_pending_print_req`
								LEFT JOIN `db_singlebankcps`.`tb_cps_transactioncodes` 
								ON (`tb_pending_print_req`.`cps_tr_code` = `tb_cps_transactioncodes`.`transactioncode`)
								where cps_date = "'.date('Y-m-d').'"
								GROUP BY cps_process_user_id,cps_book_size
								ORDER BY cps_process_user_id,cps_book_size';
								
						if($results = $db->get_results($sql)){

							foreach($results as $result){
							
								$user_id = $result->cps_process_user_id;	
								$ac_type = $result->transactioncodedescription;
								
								$chkbk_rquest[$user_id][$ac_type][$result->cps_book_size] = $result->total_count;
								$rquest = array();
								if(!in_array($result->cps_book_size,$cps_book_size)){
									
									$cps_book_size[] = $result->cps_book_size;			
								}
								$cps_book_size2[$result->transactioncode.'_'.$result->transactioncodedescription][$result->cps_book_size][] = $result->total_count;
								if(@!in_array($result->cps_book_size,$cps_book_size1[$result->transactioncodedescription])){
									$cps_book_size1[$result->transactioncodedescription][] = $result->cps_book_size;
									sort($cps_book_size1[$result->transactioncodedescription]);
								}		
							}
						}

						//$firephp->log($acc_type,'Acc Types');
						//$firephp->log($chkbk_rquest,'Iterators');
						//$firephp->log($cps_book_size,'Total Book Sizes');
						//$firephp->log($cps_book_size1,'Acc1 wise Sizes');

						$tbody = '';
						//$header1 = '<td>User Name11</td>';
						$i = 1;

						/* For Body Only Starts*/
						foreach($chkbk_rquest as $key => $rqsts){
							
							$data = $key;
							
							$ac_table = '';
							foreach($acc_type as $key=>$val){
								
								if(array_key_exists($val,$rqsts)){
									
									$diff_book_request = '';
									for($i=0; $i<sizeof($cps_book_size1[$val]); $i++){
										$width = round(100 / sizeof($cps_book_size1[$val]),2);
										if(isset($rqsts[$val][$cps_book_size1[$val][$i]]) && $rqsts[$val][$cps_book_size1[$val][$i]]!=''){
											$diff_book_request .= '<td class="thwidthtd" width="'.$width.'%">'.$rqsts[$val][$cps_book_size1[$val][$i]].'</td>';
										}else{
											$diff_book_request .= '<td class="thwidthtd" width="'.$width.'%">0</td>';
										}
									}
									
									$ac_table .= '<td><table cellpadding="0" cellspacing="0" border="0" width="100%" style="text-align:center;"><tr>'.$diff_book_request.'</tr></table></td>';
								}else{
									$ac_table .= '<td><table cellpadding="0" cellspacing="0" border="0" width="100%" style="text-align:center;"><tr><td class="thwidthtd">&nbsp;</td></tr></table></td>';
								}
							}
							$i = 0;
							
							$tds = '<td class="thwidthtd">'.$data.'</td>';
							$tds .= $ac_table;
							$tbody .= '<tr>'.$tds.'</tr>';
							
						}
						/* For Body Only Ends*/
						$col_sizes = '';
						$header1 = '';
						foreach($acc_type as $key=>$val){
								
							if(array_key_exists($val,$cps_book_size1)){
								
								$columns = '';
								for($i=0; $i<sizeof($cps_book_size1[$val]); $i++){
									$width = round(100 / sizeof($cps_book_size1[$val]),2);
									$columns .= '<th class="thwidthth" style="'.$width.'%">'.$cps_book_size1[$val][$i].'</th>';
								}
								$columns = '<th><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>'.$columns.'</tr></table></th>';
								$header1 .= '<th><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><th class="thwidthth">'.$val.'</th></tr><tr>'.$columns.'</tr></table></th>';
							}else{
								$header1 .= '<th class="thwidthth">'.$val.'</th>';
							}
						}
						$ac_type1 = '<tr><th class="thwidthth">User Name</th>'.$header1.'</tr>';
						$table = '<table cellpadding="0" cellspacing="0" border="0" width="1500">'.$ac_type1.$tbody.'</table>';
						echo $table;
						
						
						?>  
                          <tr>
                          <td>&nbsp;</td>
                          </tr>
                          <tr>
                          <?php if(isset($_REQUEST['from_date']) && !empty($_REQUEST['from_date']) &&
									isset($_REQUEST['to_date']) && !empty($_REQUEST['to_date']) ) {
										$url = 'printedreport_pdf.php?type=search&frm='.$_REQUEST['from_date'].'&to='.$_REQUEST['to_date'];
								} else {
										$url = 'printedreport_pdf.php?type=all';
								}						  
						  ?>
                          <td >&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $url; ?>" target="_blank"><input type="button" id="button" value="Export to PDF" /></a></td>
                          </tr>
                        </div>
                       <?php } ?>
                       </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once('footer.php');	?>
</body>
</html>
