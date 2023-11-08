<?php
require_once('global.php');
authentication_print();
if(isset($_REQUEST['from_date']) && !empty($_REQUEST['from_date']) &&
	isset($_REQUEST['to_date']) && !empty($_REQUEST['to_date']) ) {
	$sql_print = "select * from tb_pending_print_req where cps_date between '".date('Y-m-d',strtotime($_REQUEST['from_date']))."' and '".date('Y-m-d', strtotime($_REQUEST['to_date']))."' ";
} else {
	$sql_print = "select * from tb_pending_print_req";
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
        <div id="formheading">Pending Print Reports</div>
        <div id="formfields">
          
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td>
					  <form id="frmuploadfile" name="frmuploadfile" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
							<label>Select Date :</label> <input type="text" id="from_date" name="from_date" />&nbsp;&nbsp;<label> To </label>&nbsp;&nbsp;
							<input type="text" id="to_date" name="to_date" /> 
							<input type="submit" name="search" id="search" value="Search" onClick="return recuired();" />
					  </form>
                  </td>
              </tr>
			  <tr><td><div id="divmsg" class="red"><div></td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr>
                <td align="center" valign="top"
			style="border: 1px solid; border-color: #cccccc;"><table width="969" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><?php 
						if($result = $db->get_results($sql_print)){
				?>
                        <div style="width:1000px; overflow-x:scroll;overflow-y:hidden; margin:0px; padding:0px;">
                          <table cellpadding="0" cellspacing="0" border="0" width="2000">
                            <tr>
                             
                              <th class="thwidthth"> Branch Code</th>
                              <th class="thwidthth">Acc. No</th>
                              <th class="thwidthth">Name</th>
                             
                              <th class="thwidthth">No Of Books</th>
                              <th class="thwidthth">Book Size</th>
                              <th class="thwidthth">Chq From</th>
                              <th class="thwidthth">Chq To</th>
                              <th class="thwidthth">Date Of Issue</th>
                            </tr>
                            <?php 
						//if($result = $db->get_results("select * from tb_pending_print_req where cps_isprint = 0")){
						foreach($result as $row) {
					?>
                            <tr>
                              
                              <td class='thwidthtd'><?php echo $row->cps_branch_code; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_account_no; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_act_name; ?></td>
                              
                              <td class='thwidthtd'><?php echo $row->cps_no_of_books; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_book_size; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_chq_no_from; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_chq_no_to; ?></td>
                              <td class='thwidthtd'><?php echo date('d-m-Y', strtotime($row->cps_date)); ?></td>
                            </tr>
                            <?php }?>
                            <tr>
                              <td class="thwidthth" colspan="43" style="text-align:left; padding-left:10px; height:40px"></td>
                            </tr>
                            <tr>
                              <td style="height:30px;">&nbsp</td>
                            </tr>
                            
                          </table>
                          <tr>
                          <td>&nbsp;</td>
                          </tr>
                          <tr>
                          <?php if(isset($_REQUEST['from_date']) && !empty($_REQUEST['from_date']) &&
									isset($_REQUEST['to_date']) && !empty($_REQUEST['to_date']) ) {
										$url = 'printpendingrequest_pdf.php?type=search&frm='.$_REQUEST['from_date'].'&to='.$_REQUEST['to_date'];
								} else {
										$url = 'printpendingrequest_pdf.php?type=all';
								}
										
						  
						  ?>
                          <td >&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $url; ?>" target="_blank"><input type="button" id="button" value="Export to PDF" /></a></td>
                          </tr>
                        </div>
                        <?php 
						}else{ echo "<label>There are no pending reports</label>";} 
				?></td>
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
