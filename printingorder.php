<?php
require_once('global.php');
require('cellpdf.php');
require('pdf.php');
$print_datetime = date("d-m-Y H:i:s");
$selected_requisition = false;
$requisitiononly = false;
$page_name = "print_preview";
authentication_print();
ini_set("max_execution_time",300000);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('includes.php'); ?>
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/jquery.tablesorter.js"></script>
<style type="text/css">
		table.npage {
 		   border-collapse: collapse;
		}
		table.npage, .npage th, .npage td {
    		border: 1px solid black;
		}
		.npage th, .npage td {
 		   padding: 5px;
 		   text-align: center;
		}
		.L1, .L2, .L3 {
			display: inline-block;
			height: 14px;
			width: 14px;
			border: 1px solid black;
			border-radius: 3px;
		}
		.L1 { background-color: darkgray}
		.L3 { background-color: #90cbe6}
		.legends {
			text-align: center;
		}
		.legends td {
			padding: 10px;
		}
</style>
</head>
<body>
<?php require_once('header.php');	?>
<div id="formdiv">
	<div id="formheading">Printing Order</div>
	<div id="formfields">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center" valign="top" style="border:1px solid; border-color:#cccccc;">						 
				 <table width="800" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					  <td>&nbsp;</td>
					  </tr>
					  <tr>
						<td align="left" valign="top">	
							<form id="frmprn" name="frmprn">
								<table width="100%">
									<tr>
										<td align="left" valign="top"><div id="response"></div></td>
									</tr>
									<tr>
										<td width="23%">
											<label>No of Accounts</label><span class="red">*</span> 
										</td>
										<td valign="top">													
											<select name="noofacc" id="noofacc">
												<option value="1"> Single Account (A)              </option>
												<option value="2"> Two Accounts   (A, B)           </option>
												<option value="3"> Three Accounts (A, B, C)        </option>
												<option value="4"> Four Accounts  (A, B, C, D)     </option>
												<option value="5"> Five Accounts  (A, B, C, D, E)  </option>
											</select>
										</td>
									</tr>
									<tr>
										<td colspan="2" id="dynacc" ></td>
									</tr>
									<tr>
									  <td>&nbsp;</td>
									</tr>
									<tr>
										<td><label>Select coloring</label><span class="red">*</span></td>
										<td>
											<select name="coloring_type" id="coloring_type">
												<option value="1">Leaf wise</option>
												<option value="2">Account wise</option>
											</select>
										</td>
									</tr>
									<tr>
									  <td>&nbsp;</td>
									</tr>
									<tr>
										<td> </td>
										<td> <input id="calcbutton" name="submit" class="submitbutton" type="submit" id="submit" value="Show" /> 
										<span class="loading" style="display:none">Loading ... <img src="<?php echo ADMIN_IMAGES; ?>ajax-loader.gif" /></span>	</td>																																						
									</tr>
								</table>
							</form>	
						</td>
					  </tr>
						<tr>
					  <td>&nbsp;</td>
					  </tr>
				</table>
				</td>
			</tr>
		</table>
		
		<div id="dyndisplay" style="10px"></div>
	</div>
</div>
<script type="text/javascript">
	function addAccounts()
	{
		$('#dynacc').html('');
		var n = $('#noofacc').val();
		var htmlcont = '<table width="100%" >';
		for(i = 0; i < n; i++)
		{
			var charcode =  String.fromCharCode(65+i);
			htmlcont += '<tr>';
			htmlcont += '<td width="23%"><label>No of Leaves for '+ charcode +'</label> <span class="red">*</span></td>';
			htmlcont += '<td><select class="leafopt" id="acn'+i+'"><option value="10">10</option>';
			htmlcont += '<option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30">30</option><option value="50">50</option>';
			htmlcont += '</select></td></tr>';
		}
		htmlcont += '</table>';
		$('#dynacc').html(htmlcont);
		$('.leafopt').change(function () {
			$('#dyndisplay').html('<div style="margin-top:15px">Please click on show to view current changes.</div>');
		});
	}
	function showCheques()
	{
		$('#dyndisplay').html('');
		// Get all vars
		var n = $('#noofacc').val();
		var leaves = [];
		var colors = [];
		var totalleaves = 0;
		var arr_colors = ['#ffbc78', '#90cbe6', '#edffb4', 'cyan', 'darkgray'];
		for(i = 0; i < n; i++)
		{
			r = $('#acn'+i).val();
			for(j = 1; j <= r; j++)
			{
				leaves[totalleaves + j-1] = String.fromCharCode(65 + i) + ' ' + j;
				colors[totalleaves + j-1] = arr_colors[i];
			}
			totalleaves += eval(r);
		}
		var noofpages = Math.ceil(totalleaves / 3);
		var htmlcont = '';
		
		if($('#coloring_type').val() == 1)
			htmlcont = '<table width="100%" class="legends"><tr><td><span class="L1"></span> 1<sup>st</sup> Leaf</td><td><span class="L2"></span> 2<sup>nd</sup> Leaf</td><td><span class="L3"></span> 3<sup>rd</sup> Leaf</td></tr></table><table class="npage1" width="100%" >';
		else
		{
			htmlcont = '<table width="100%" class="legends"><tr>';
			for(i = 0; i < n; i++)
			{
				htmlcont += '<td><span class="L1" style="background-color:'+arr_colors[i]+'"></span> Account '+ String.fromCharCode(65 + i) +'</td>';
			}
			htmlcont += '</tr></table><table class="npage1" width="100%">';
		}
		var lcount = 0;
		for(i = 1; i <= noofpages; i++)
		{
			if(i % 3 == 1)
				htmlcont += '<tr>';
			lf1 = leaves[lcount];
			lfcolor1 = colors[lcount];
			
			n = lcount + noofpages;
			if(n < totalleaves)
			{
				lf2 = leaves[n];
				lfcolor2 = colors[n];
			}
			else
			{
				lf2 = 'Blank';
				lfcolor2 = 'white';
			}

			n = lcount + noofpages * 2;
			if(n < totalleaves)
			{
				lf3 = leaves[n];
				lfcolor3 = colors[n];
			}
			else
			{
				lf3 = 'Blank';
				lfcolor3 = 'white';
			}

			if($('#coloring_type').val() == 1)
				htmlcont += '<td style="padding: 10px; text-align: center;"> Page '+ i +'<table class="npage" width="100%"><tr><td style="background-color:darkgray" title="1st Leaf">' + lf1 + '</td></tr><tr><td title="2nd Leaf">' + lf2 + '</td></tr><tr><td style="background-color:#90cbe6" title="3rd Leaf">' + lf3 + '</td></tr></table></td>';
			else
				htmlcont += '<td style="padding: 10px; text-align: center;"> Page '+ i +'<table class="npage" width="100%"><tr><td style="background-color:'+ lfcolor1 +'" title="1st Leaf">' + lf1 + '</td></tr><tr><td style="background-color:'+ lfcolor2 +'" title="2nd Leaf">' + lf2 + '</td></tr><tr><td style="background-color:' + lfcolor3 + '" title="3rd Leaf">' + lf3 + '</td></tr></table></td>';
			if(i % 3 == 0)
				htmlcont += '</tr>';
			lcount++;
		}
		if(noofpages % 3 != 0)
			htmlcont += '</tr>';
		htmlcont += '</table>';

		$('#dyndisplay').html(htmlcont);
	}
	$(document).ready(function () {
		addAccounts();
		$('#calcbutton').click(function (event) {
			event.preventDefault();
			$('.loading').show();
			showCheques();
			$('.loading').hide();
		});
		$('#noofacc').change(function (event) {
			addAccounts();
			$('#dyndisplay').html('<div style="margin-top:15px">Please click on show to view current changes.</div>');
		});
		$('#coloring_type').change(function (event) {
			var s = $('#dyndisplay').html();
			if(s && s.search('Please') == -1)
				showCheques();
		});
	});
</script>
</body>
</html>
