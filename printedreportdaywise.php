<?php
require_once('global.php');
$page_name = "printed_report";
authentication_print();
//$allowedtoclick = authentication_groups($page_name);
if(isset($_REQUEST['ddlBranchName']) && !empty($_REQUEST['ddlBranchName'])) {
	//$sql_print = "select * from tb_print_req_collection where cps_branchmicr_code = '".$_REQUEST['ddlBranchName']."' and cps_date = '".date('y-m-d')."' and cps_is_reprint=0";
	$sql_print = "SELECT tb_print_req_collection.*, tb_printadmin.`userid` FROM tb_print_req_collection LEFT OUTER JOIN tb_printadmin ON cps_process_user_id = adminid where cps_branchmicr_code = '".$_REQUEST['ddlBranchName']."' and cps_date = '".date('y-m-d')."' and cps_is_reprint=0";
} else {
	//$sql_print = "select * from tb_print_req_collection where cps_date = '".date('y-m-d')."' and cps_is_reprint=0";
	$sql_print = "SELECT tb_print_req_collection.*, tb_printadmin.`userid` FROM tb_print_req_collection LEFT OUTER JOIN tb_printadmin ON cps_process_user_id = adminid where cps_date = '".date('y-m-d')."' and cps_is_reprint=0";
	//$sql_print = "SELECT tb_print_req_collection.*, tb_printadmin.`userid` FROM tb_print_req_collection LEFT OUTER JOIN tb_printadmin ON cps_process_user_id = adminid where cps_date = '2015-06-23' and cps_is_reprint=0";
}

if(isset($_GET['ddlTranType']) && !empty($_GET['ddlTranType']))
{
	$sql_print .= " && cps_tr_code = ".$_GET['ddlTranType'];
}
if(isset($_GET['ddlBookSize']) && !empty($_GET['ddlBookSize']))
{
	$sql_print .= " && cps_book_size = ".$_GET['ddlBookSize'];
}

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
				<tr>
					<td>
						<form id="frmuploadfile" name="frmuploadfile" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
							<div style="float:left">&nbsp;&nbsp;<label>Select Branch </label>
								<select name="ddlBranchName" id="ddlBranchName" style="width:198px; height:26px;">
									<option value=""> Select Branch </option>
									<?php 
										$rowgetbranch =  $db->get_results("SELECT distinct(b.branch_code),b.branch_id, b.branch_name FROM tb_branchdetails b INNER JOIN tb_print_req_collection prc ON b.branch_code = prc.cps_branchmicr_code where prc.cps_date = '".date('y-m-d')."'");
										if($rowgetbranch){
										foreach($rowgetbranch as $eachbranch){
											if(isset($_GET['ddlBranchName']) && $_GET['ddlBranchName'] == $eachbranch->branch_code)
											{
												?><option value="<?php echo $eachbranch->branch_code; ?>" selected="selected"><?php echo $eachbranch->branch_name; ?></option><?php
											}
											else
											{
												?><option value="<?php echo $eachbranch->branch_code; ?>"><?php echo $eachbranch->branch_name; ?></option><?php
											} 
										}
										} 
									?>
								</select>
							</div>
							<div style="float:left">&nbsp;&nbsp;<label>Transaction Type </label>
								<select name="ddlTranType" id="ddlTranType" style="width:198px; height:26px;">
									<option value=""> Select Transaction </option>
									<?php
										
										$rowgetbranch =  $db->get_results("SELECT distinct(transactioncode),b.transactioncode, b.transactioncodedescription FROM tb_cps_transactioncodes b INNER JOIN tb_print_req_collection prc ON b.transactioncode = prc.cps_tr_code where prc.cps_date = '".date('y-m-d')."'");
										if($rowgetbranch){
										foreach($rowgetbranch as $eachbranch){
											if(isset($_GET['ddlTranType']) && $_GET['ddlTranType'] == $eachbranch->transactioncode)
											{
												?><option value="<?php echo $eachbranch->transactioncode; ?>" selected="selected"><?php echo $eachbranch->transactioncodedescription; ?></option><?php
											}
											else
											{
												?><option value="<?php echo $eachbranch->transactioncode; ?>"><?php echo $eachbranch->transactioncodedescription; ?></option><?php
											} 
										} 
									}
									?>
								</select>
							</div>
							
							<div style="float:left">
								<input type="submit" name="search" id="search" value="Search" onClick="return recuired();" />
							</div>
							
							<div style="float:left">
								<a href="printedreportdaywise.php"><img src="images/refresh.png" alt="Refresh"></a>
							</div>
						</form>
					</td>
				</tr>
              <tr>
                <td align="center" valign="top" style="border: 1px solid; border-color: #cccccc;"><table width="969" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">
					  <?php if($result = $db->get_results($sql_print)){  ?>
                        <div style="width:1000px; overflow-x:scroll;overflow-y:hidden; margin:0px; padding:0px;" id="divshowdetails" name="divshowdetails">
                          <table cellpadding="0" cellspacing="0" border="0" width="2000">
                            <tr>
                              <th class="thwidthth">Sr. No.</th>
                              <th class="thwidthth">Operator</th>                                                          
                              <th class="thwidthth"> Branch Code</th>
                              <th class="thwidthth">Acc. No</th>
                              <th class="thwidthth">Name</th>         
                              <th class="thwidthth">Transaction Type</th>                             
                              <th class="thwidthth">No Of Books</th>
                              <th class="thwidthth">Book Size</th>
                              <th class="thwidthth">Chq From</th>
                              <th class="thwidthth">Chq To</th>
                              <th class="thwidthth">Date Of Issue</th>
                            </tr>
                            
                            <?php $i = 1; foreach($result as $row) {?>
                            <tr>
                              <td class='thwidthtd'><?php echo $i++; ?></td>
                              <td class='thwidthtd'><?php echo $row->userid; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_branchmicr_code; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_account_no; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_act_name; ?></td>
                              <?php 
                              		$tran_type =  $db->get_results("select transactioncodedescription from tb_cps_transactioncodes where transactioncode = ".$row->cps_tr_code);
                              ?>
                              <?php foreach($tran_type as $tran_type_row) {?>
                              	<td class='thwidthtd'><?php echo $tran_type_row->transactioncodedescription; ?></td>
                              <?php }?>
                              <td class='thwidthtd'><?php echo $row->cps_no_of_books; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_book_size; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_chq_no_from; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_chq_no_to; ?></td>
                              <td class='thwidthtd'><?php echo date('d-m-Y', strtotime($row->cps_date)); ?></td>
                            </tr>
                            <?php }//$db->closeDb();?>
                            <tr>
                              <td class="thwidthth" colspan="11" style="text-align:left; padding-left:10px; height:40px"></td>
                            </tr>
                            <tr>
                              <td style="height:30px;">&nbsp; </td>
                            </tr>
                            <?php //}?>
                          </table>
                          <tr>
                          	<td>&nbsp;</td>
                          </tr>
                          <tr>
                          <?php 
						  
								if(isset($_REQUEST['ddlBranchName']) && !empty($_REQUEST['ddlBranchName'])  ) {
										$url = "printedreportdaywise_pdf.php?type=search&branchcode=".$_REQUEST['ddlBranchName']."&Tdate='.date('Y-m-d')";
								} else {
										$url = 'printedreportdaywise_pdf.php?type=all&Tdate='.date('Y-m-d');
								}
							  	if(isset($_GET['ddlTranType']) && !empty($_GET['ddlTranType']))
								{
									$url .= "&cps_atpar=".$_GET['ddlTranType'];
								}
						  ?>
                          <td >&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $url; ?>" target="_blank"><input type="button" id="button" value="Export to PDF" /></a></td>
                          </tr>
                        </div>
                        <?php }else{ echo "<label>There are no sucessfully printed reports</label>";} ?>
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
