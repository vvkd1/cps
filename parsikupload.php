<?php
require_once('global.php');
$page_name = "upload_file";
authentication_print();
if (!authentication_groups_pemissions($page_name, "", "Y"))
	header("Location: " . SITE_ROOT . "home.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php include('includes.php'); ?>
	<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
	<script type="text/javascript">
		var vRules = { uploadedfile: { required: true } };
		var vMessages = { uploadedfile: { required: "<br/>Please select file to upload."}};
		function loadSelect() {
			$('.brn').remove();
			$('.trn').remove();
			data = { getfunc: "getBranches" };
			$.get('post_parsik.php', data, function (resObj) {
				$('#ddlBranchName').append(resObj);
			})
			data = { getfunc: "getTransactions" };
			$.get('post_parsik.php', data, function (resObj) {
				$('#ddlTranType').append(resObj);
			})
		}
		$(document).ready(function () {
			if ($.trim($('#uploaded_files').html()).length > 0)
				$('#SearchBox').show();
			else
				$('#SearchBox').hide();
			$('#response,#ajax_loading,.loading').hide();
			$('#search').click(function (event) {
				event.preventDefault();
				data = { ddlBranchName: $('#ddlBranchName').val(), ddlTranType: $('#ddlTranType').val() };
				$.get('post_parsik.php', data, function (resObj) {
					$('#uploaded_files').html(resObj);
				});
			});
			$('#submit1').button();
			$('#frmuploadfile').validate({
				rules: vRules,
				messages: vMessages,
				submitHandler: function (form) {
					$('#frmuploadfile').ajaxSubmit({
						target: '#response',
						beforeSubmit: function (formData, jqForm, options) {
							formData.push({ "name": "type", "value": "json" });
							$('.loading').show();
							if (document.getElementById("hiddtotaluploaddata").value != "0") {
								$('.loading').hide();
								return confirm('There are pending cheques to be printed. Are you sure you want to continue?');
							}
						},
						clearForm: false,
						success: function (resObj) {
							var response = resObj.split('#');
							if (response[0] == '0') {
								$('.loading').hide();
								$('#response').html('<div class="errormsg_boundary">' + response[1] + '<div>').show();
							} else {
								$('#response').html('');
								$('#uploaded_files').html(resObj);
								$('.loading').hide();
								loadSelect();
								if ($.trim($('#uploaded_files').html()).length > 0)
									$('#SearchBox').show();
								else
									$('#SearchBox').hide();
							}
						}
					});
				}
			});
		});

	</script>

	<script type="text/javascript">
		var selected_ids_array = [];
		$(document).ready(function () {

			$("#dialog-confirm").dialog({
				autoOpen: false,
				modal: true,
				buttons: {
					Cancel: function () {
						$(this).dialog("close");
						return false;
					},
					Ok: function () {
						//window.location = 'confirmprintreq.php?do=print&pid='+selected_ids_array;
						//alert(selected_ids_array);
						if ($('#bunch').val() == '1')
							window.location = 'post_parsik.php?do=print&pid=' + selected_ids_array + '&bunch=yes';
						else
							window.location = 'post_parsik.php?do=print&pid=' + selected_ids_array;
					}

				}
			});

			$("#dialog").dialog({
				autoOpen: false,
				modal: true,
				buttons: {
					Ok: function () {
						$(this).dialog("close");
					}
				}
			});

			MarkAll = function () {
				selected_ids_array.length = 0;
				$('#categorytable').find(':checkbox').attr('checked', true);
				$(':checkbox:checked').each(function (i) {
					selected_ids_array.push($(this).attr("id"));
				});
			};


			Unmark_all = function () {
				$('#categorytable').find(':checkbox').attr('checked', false);
				selected_ids_array.length = 0;
			};

			Print_selected = function () {
				$('#bunch').val('0');
				if (selected_ids_array.length <= 0) {
					$("#dialog").dialog("open");
					return false;
				}
				$("#dialog-confirm").dialog("open");
			};

			Print_selected3 = function () {
				$('#bunch').val('1');
				if (selected_ids_array.length <= 0) {
					$("#dialog").dialog("open");
					return false;
				}
				$("#dialog-confirm").dialog("open");
			};

			Delete_selected = function () {

				if (selected_ids_array.length <= 0) {
					$("#dialog").dialog("open");
					return false;
				}
				$("#confirm-delete").dialog("open");
			};

			$(".class_chkbox").live("click", function () {
				if ($(this).attr('checked')) {
					selected_ids_array.push($(this).attr("id"));
				} else {
					removeByValue(selected_ids_array, $(this).attr("id"));
				}
			});

			$("#confirm-delete").dialog({
				autoOpen: false,
				modal: true,
				buttons: {
					Cancel: function () {
						$(this).dialog("close");
						return false;
					},
					Ok: function () {
						window.location = 'post_parsik.php?do=delete&pid=' + selected_ids_array;
					}
				}
			});

		});


		function removeByValue(arr, val) {
			for (var i = 0; i < arr.length; i++) {
				if (arr[i] == val) {
					arr.splice(i, 1);
					break;
				}
			}
		}

	</script>
</head>

<body>

	<?php require_once('header.php');
	$countnumber = 0;
	if ($totaldatainupload = $db->get_row("SELECT count(*) as total FROM tb_uploadingdata")) {
		$countnumber = $totaldatainupload->total;
	}

	?>
	<div id="formdiv">
		<div id="formheading">Upload File
			<?php

			$rowToner = checkTonerCapacity();
			if ($rowToner) {
				if (!$rowToner['status']) {
					echo '<label style="color:red;float: right;font-size: 14px;background-color: yellow;">Toner can print <b>' . $rowToner['count'] . '<b> leaves. Please replace your toner.</label>';
				} else {
					echo '<label style="float: right;font-size: 14px; color:blue;">Toner can print <b>' . $rowToner['count'] . '<b> leaves.</label>';
				}
			}

			?>

		</div>
		<div id="formfields">
			<form id="frmuploadfile" name="frmuploadfile" enctype="multipart/form-data" action="post_parsik.php"
				method="POST">
				<input type="hidden" id="bunch" name="bunch" value='0' />
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">
							<table width="800" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="left" valign="top">
										<table>
											<tr>
												<td align="left" valign="top">
													<div id="response"></div>
												</td>
											</tr>
											<tr>
												<td>
													<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
													<label>Choose a file to upload:</label><span class="red">*</span>
													<input id="uploadedfile" name="uploadedfile" type="file" />
												</td>
												<td valign="top">
													<input name="submit1" type="submit" id="submit1"
														value="Upload File" />
													<div class="loading"><img
															src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>

							</table>
						</td>
					</tr>
					<tr>
						<td>
							<div style="margin-top: 10px" id="SearchBox">
								<div style="float:left">&nbsp;&nbsp;<label>Select Branch </label>
									<select name="ddlBranchName" id="ddlBranchName" style="width:198px; height:26px;">
										<option value=""> All Branches </option>
										<?php
										$rowgetbranch = $db->get_results("SELECT distinct(b.branch_code),b.branch_id, b.branch_name FROM tb_branchdetails b INNER JOIN tb_uploadingdata prc ON b.branch_code = prc.cps_branchmicr_code");
										foreach ($rowgetbranch as $eachbranch) {
											
											if (isset($_GET['ddlBranchName']) && $_GET['ddlBranchName'] == $eachbranch->branch_code) {
												?>
												<option class="brn" value="<?php echo $eachbranch->branch_code; ?>"
													selected="selected">
													<?php echo $eachbranch->branch_name; ?>
												</option>
												<?php
											} else {
												?>
												<option class="brn" value="<?php echo $eachbranch->branch_code; ?>">
													<?php echo $eachbranch->branch_name; ?>
												</option>
												<?php
											}
										}
										?>
									</select>
								</div>
								<div style="float:left">&nbsp;&nbsp;<label>Transaction Type </label>
									<select name="ddlTranType" id="ddlTranType" style="width:198px; height:26px;">
										<option value=""> All Transactions </option>
										<?php
										$rowgetbranch = $db->get_results("SELECT distinct(transactioncode),b.transactioncode, b.transactioncodedescription FROM tb_cps_transactioncodes b INNER JOIN  tb_uploadingdata prc ON b.transactioncode = prc.cps_tr_code");
										foreach ($rowgetbranch as $eachbranch) {
											if (isset($_GET['ddlTranType']) && $_GET['ddlTranType'] == $eachbranch->transactioncode) {
												?>
												<option class="trn" value="<?php echo $eachbranch->transactioncode; ?>"
													selected="selected">
													<?php echo $eachbranch->transactioncodedescription; ?>
												</option>
												<?php
											} else {
												?>
												<option class="trn" value="<?php echo $eachbranch->transactioncode; ?>">
													<?php echo $eachbranch->transactioncodedescription; ?>
												</option>
												<?php
											}
										}
										?>
									</select>
									&nbsp;&nbsp;
									<div style="float:right">
										<a href="parsikupload.php"><img src="images/refresh.png" alt="Refresh"></a>
									</div>
									<div style="float:right">
										<input type="submit" name="search" id="search" value=" Search "
											style="height:25px; width: 90px; border-radius: 5px" />
									</div>
								</div>
							</div>
						</td>	
					</tr>
					<tr>
						<td align="left" valign="top">
							<div id='uploaded_files'
							
								style="width:1000px; overflow-x:scroll;overflow-y:hidden ;margin:0px; padding:0px;">
								<?php include_once 'post_parsik.php'; ?>
							</div>
							<div class="clearboth"></div>
							<div id="dialog" title="Error">
								<p style="float:left;"><span class="ui-icon ui-icon-alert"
										style="float:left; margin:0 7px 20px 0;"></span>Please select rows!</p>
							</div>
							<div id="dialog-confirm" title="Confirmation">
								<p style="float:left;"><span class="ui-icon ui-icon-alert"
										style="float:left; margin:0 7px 20px 0;"></span>The selected records will
									proceed for print.<br />Are you sure?</p>
							</div>
							<input type="hidden" value="<?php echo $countnumber; ?>" id="hiddtotaluploaddata" />
						</td>
					</tr>
				</table>
			</form>
			<div id="confirm-delete" title="Confirmation">
				<p style="float:left;"><span class="ui-icon ui-icon-alert"
						style="float:left; margin:0 7px 20px 0;"></span>Are you sure? you want to delete selected
					records.</p>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	<?php require_once('footer.php'); ?>

</body>

</html>