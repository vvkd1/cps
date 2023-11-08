<?php
require_once('global.php');
authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once('HEADHeader.php');	?>
</head>
<body> 
<?php require_once('header.php');
$row_settings = $db->get_row("select license_type,DATE_FORMAT(license_install_date, '%d/%m/%Y' ) as license_install_date,license_period,DATE_FORMAT(license_end_date, '%d/%m/%Y' ) as license_end_date,license_no_of_users,license_cheque_leaves,license_users_leaves,license_users_leaves_value from tb_cps_settings");
?>
<div id="formdiv">
<div id="formheading">License Detalis</div>
	<div id="formfields" style="text-align:center;valign:left">
		<table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td style="width:100%;height:600px"  align="left" valign="top">
					<table style="width:500px" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td colspan="2">
							&nbsp;
							</td>
						</tr>
						<tr>
							<td style="width:200px">
								<label>License Installation Date</label>
							</td>
							<td style="width:300px">
								<label><?php echo $row_settings->license_install_date; ?></label>
							</td>
						</tr>
						<tr>						
							<td colspan="2">
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td>                                                                
											<div id="divshoeyear" <?php if($row_settings->license_type != "revenue"){echo "style=display:block";}else{ echo "style=display:none";} ?>>											
												<table cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td style="width:200px">
															<label>License End Date</label>
														</td>
														<td>
															<label><?php echo $row_settings->license_end_date; ?></label>																																							
														</td>
													</tr>
												</table>	
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
							<label>Select License Type</label>
							</td>
							<td>
								<label><?php echo $row_settings->license_type; ?></label>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td>                                                                
											<div id="divshoeyear" <?php if($row_settings->license_type == "yearly"){echo "style=display:block";}else{ echo "style=display:none";} ?>>											
												<table cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td style="width:200px">
															<label>License For Year</label>
														</td>
														<td>
															<label><?php echo $row_settings->license_period; ?></label>																																							
														</td>
													</tr>
												</table>	
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
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
