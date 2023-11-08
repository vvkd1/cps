<?php
require_once('global.php');
authentication_print();
if(isset($_REQUEST['txtaccno']) && !empty($_REQUEST['txtaccno'])  ) {
	$sql_print = "select * from tb_print_req_collection where cps_micr_account_no = '".$_REQUEST['txtaccno']."'";
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<script type="text/javascript">
function validation()
{
	if (document.getElementById("txtaccno").value == "") {
        document.getElementById("divmsg").innerHTML = "Please Enter account no.";
        return false;
    }
	else{
		document.getElementById("divmsg").innerHTML = "";
        return true;
	}
}
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#button").button();	
});
</script>
</head>
<body>
<?php require_once('header.php');	?>
      <div id="formdiv">
        <div id="formheading">Account Wise Report</div>
        <div id="formfields">
          <form id="frmuploadfile" name="frmuploadfile"
	enctype="multipart/form-data" action="printedreportaccountwise.php"
	method="get">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top"
			style="border: 1px solid; border-color: #cccccc;"><table width="969" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><div id="divmsg"></div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;
                        <label>Enter Account No - </label>
                        <input type="text" name="txtaccno" id="txtaccno" >
                        &nbsp; &nbsp;
                        <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" OnClick="return validation();" style="border-radius:4px 4px 4px 4px; border: 1px solid #D3D3D3;font-family: Verdana,Arial,sans-serif;font-size: 12px; height:28px; width:74px" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><?php
				if(isset($_REQUEST['txtaccno']) && !empty($_REQUEST['txtaccno']))
					{
						if($result = $db->get_results($sql_print)){
				?>
                        <div style="width:1000px; overflow-x:scroll;overflow-y:hidden; margin:0px; padding:0px;">
                          <table cellpadding="0" cellspacing="0" border="0" width="2000">
                            <tr>
                              <th class="thwidthth">ID</th>
                              <th class="thwidthth">Branch Code</th>
                              <th class="thwidthth">MIRC Acc. No</th>
                              <th class="thwidthth">Joint Name1</th>
                              <th class="thwidthth">Cust Address1</th>
                              <th class="thwidthth">Cust Address2</th>
                              <th class="thwidthth">Cust Mobile</th>
                              <th class="thwidthth">No Of Books</th>
                              <th class="thwidthth">Book Size</th>
                              <th class="thwidthth">Chq From</th>
                              <th class="thwidthth">Chq To</th>
                              <th class="thwidthth">Date</th>
                            </tr>
                            <?php

					
					foreach($result as $row) {
					
					?>
                            <tr>
                              <td class='thwidthtd'><?php echo $row->id; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_branch_code; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_micr_account_no; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_act_jointname1; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_act_address1; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_act_address2; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_act_mobile; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_no_of_books; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_book_size; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_chq_no_from; ?></td>
                              <td class='thwidthtd'><?php echo $row->cps_chq_no_to; ?></td>
                              <td class='thwidthtd'><?php echo date('d-m-Y', strtotime($row->cps_date)); ?></td>
                            </tr>
                            <?php }$db->closeDb();?>
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
                          <?php if(isset($_REQUEST['txtaccno']) && !empty($_REQUEST['txtaccno'])  ) {
										$url = 'printedreportaccountwise_pdf.php?type=search&acno='.$_REQUEST['txtaccno'];
								} 
										
						  
						  ?>
                          <td >&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $url; ?>" target="_blank"><input type="button" id="button" value="Export to PDF" /></a></td>
                          </tr>
                        </div>
                        <?php
				}else { echo "No record found related to this search"; }
				}
				?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once('footer.php');	?>
</body>
</html>
