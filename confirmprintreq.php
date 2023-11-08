<?php
require_once('global.php');
$page_name = "confirm_print";
authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<?php include('includes.php'); ?>
</head>
<body>
<?php require_once('header.php'); ?>

<?php
if(isset($_REQUEST['file']) && ($_REQUEST['file'] == 'text'))
{
	if(isset($_REQUEST['bunch']) && $_REQUEST['bunch'] == 'yes')	
	 $action = "confirmprintreq_post.php?file=text&bunch=yes";
	else
		$action = "confirmprintreq_post.php?file=text";
}
else
	$action = "confirmprintreq_post.php";
?>
<div id="formdiv">
<div id="formheading">Confirm Print Request</div>
<div id="formfields">
<form id="frmuploadfile" name="frmuploadfile"
	enctype="multipart/form-data" action="<?php echo $action; ?>"
	method="POST">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="top"
			style="border: 1px solid; border-color: #cccccc;">
		<table width="969" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="left" valign="top">
				<div style="width:1000px; overflow-x:scroll;overflow-y:hidden; margin:0px; padding:0px;">
				<table cellpadding="0" cellspacing="0" border="0" width="3000">
					<tr>
						<th class="thwidthth">Unique Request No</th>
						<th class="thwidthth">Micr Code</th>						
						<th class="thwidthth">Account No</th>
						<th class="thwidthth">Customer Name</th>
						<th class="thwidthth">Book Size</th>
						<th class="thwidthth">No Of Books</th>
						<th class="thwidthth">Cheque From</th>
						<th class="thwidthth">Cheque To</th>
						<th class="thwidthth">Tr Code</th>
						<th class="thwidthth">At Par</th>						
						<th class="thwidthth">Address 1</th>
						<th class="thwidthth">Address 2</th>
						<th class="thwidthth">Address 3</th>
						<th class="thwidthth">Address 4</th>
						<th class="thwidthth">Address 5</th>
						<th class="thwidthth">City</th>												
						<th class="thwidthth">PIN</th>						
						<th class="thwidthth">Mobile</th>
					</tr>
					<?php 
					if($result = $db->get_results("select * from tb_pending_print_req where cps_isprint = 1 and cps_unique_req not in (0)")){
					foreach($result as $row) {
					?>
					<tr>
						<td class='thwidthtd'><?php echo $row->cps_unique_req; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_micr_code; ?></td>						
						<td class='thwidthtd'><?php echo $row->cps_account_no; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_act_name; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_book_size; ?></td>
						
						<td class='thwidthtd'><?php echo $row->cps_no_of_books; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_chq_no_from; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_chq_no_to; ?></td>
						
						<td class='thwidthtd'><?php echo $row->cps_tr_code; ?></td>
						<td class='thwidthtd'><?php if($row->cps_atpar == 0){ echo "N"; }else{ echo "";} ?></td>						
						<td class='thwidthtd'><?php echo $row->cps_act_address1; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_act_address2; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_act_address3; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_act_address4; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_act_address5; ?></td>
						<td class='thwidthtd'><?php echo $row->cps_act_city; ?></td>											
						<td class='thwidthtd'><?php echo $row->cps_act_pin; ?></td>						
						<td class='thwidthtd'><?php echo $row->cps_act_mobile; ?></td>
					</tr>
					<?php }}?>
					<tr>
						<td class="thwidthth" colspan="23" style="text-align:left; padding-left:10px; height:40px">
						<input type="submit" id="btnprint" name="btnprint" value="Print"></input>
						<!--<input type="button" id="btnprintpreview" name="btnprintpreview" value="Print Preview" onclick="window.open('printpreview.php','_blank')"></input>-->
						</td>
					</tr>
					<tr>
						<td style="height:30px;">&nbsp;</td>
					</tr>
				</table>
				</div>

				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>


		</table>
		</td>
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
