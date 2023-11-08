<?php
require_once('global.php');
authentication_print();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php require_once('HEADHeader.php'); ?>
	<?php include('includes.php'); ?>
	<link href="css/morris.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="js/raphael.js"></script>
	<script src="js/morris.js"></script>
</head>

<body> 
<?php require_once('header.php'); ?>  
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-bar-chart"></i> <b>Total printing of cheque (Transaction wise)</b><a href="dashboard.php" style="float: right;"><i class="fa fa-refresh"></i></a></div>

                <!--div id="progress" style="background: red;height:1px;width:700px;position:absolute;"></div-->

				<div class="panel-body">
					<form class="form-inline alert alert-info" method="get">
						<div class="form-group">
					    	<input type="text" class="form-control" id="from_date1" name="from_date1" placeholder="From date" value="<?php echo $from_date1; ?>" required>
					  	</div>
					  	<div class="form-group">
					    	<input type="text" class="form-control" id="to_date1" name="to_date1" placeholder="To date" value="<?php echo $to_date1; ?>" required>
					  	</div>
					  	<button type="submit" name="submit1" id="submit1" class="btn btn-primary">GO</button>
					</form>
					<div id="tr_graph" style="width: 600px;"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-pie-chart"></i> <b>Total printing of cheque (Branch wise)</b><a href="dashboard.php" style="float: right;"><i class="fa fa-refresh"></i></a></div>
				<div class="panel-body">
					<form class="form-inline alert alert-info" method="get">
						<div class="form-group">
					    	<input type="text" class="form-control" id="from_date2" name="from_date2" placeholder="From date" value="<?php echo $from_date2; ?>" required>
					  	</div>
					  	<div class="form-group">
					    	<input type="text" class="form-control" id="to_date2" name="to_date2" placeholder="To date" value="<?php echo $to_date2; ?>" required>
					  	</div>
					  	<button type="submit" name="submit2" id="submit2" class="btn btn-primary">GO</button>
					</form>
					<div id="br_graph" style="text-align: center;"></div>
				</div>
			</div>
		</div>
	</div>		
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-signal"></i> <b>Reprint ratio = (total reprints/total prints)*100</b></div>
				<div class="panel-body">
					<div id="ratio_graph" style="text-align: center;"></div>
				</div>
			</div>
		</div>
	</div>		
</div>
<?php 
$result_tr = $db->get_results("SELECT SUM(prc.cps_book_size) AS count_cheque, td.transactioncodedescription FROM `tb_print_req_collection` AS prc INNER JOIN tb_cps_transactioncodes AS td ON prc.cps_tr_code = td.transactioncode GROUP BY prc.cps_tr_code");

$tr_graph = '';
if(!empty($result_tr))
{
	foreach ($result_tr as $data)
	{
		$tr_graph .= "{a: '".$data->count_cheque."',y: '".$data->transactioncodedescription."',},";
	}
}

$result_br = $db->get_results("SELECT SUM(prc.cps_book_size) AS count_cheque, tb.branch_name FROM `tb_print_req_collection` AS prc INNER JOIN tb_branchdetails AS tb ON prc.cps_branchmicr_code = tb.branch_code GROUP BY prc.cps_branchmicr_code");

$br_graph = '';
if(!empty($result_br))
{
	foreach ($result_br as $data)
	{
		$br_graph .= "{label: '".$data->branch_name."',value: '".$data->count_cheque."',},";
	}
}

$result_print   = $db->get_row("SELECT SUM(cps_book_size) AS count_cheque FROM `tb_print_req_collection` ");
$result_reprint = $db->get_row("SELECT SUM(cps_book_size) AS count_cheque FROM `tb_reprint_req_collection` ");

if(!empty($result_print) && !empty($result_reprint))
{
	$ratio = round((($result_reprint->count_cheque/$result_print->count_cheque)*100), 1);
	$ratio_graph = "{label: 'Reprint (%)',value: '".$ratio."',},";
}

require_once('footer.php'); 
?> 
<script>
	$(document).ready(function(){
		//$("#progress").hide();
		
		$('#from_date1, #to_date1, #from_date2, #to_date2').datepicker({changeMonth: true, changeYear: true, showButtonPanel: false, yearRange:'-70:Y', maxDate: 'D', dateFormat: 'dd-mm-yy' });

		$("#submit1").click(function(e){
			e.preventDefault();
			//$("#progress").show();
			//$("#progress").animate({left: '700px'});
			var $from_date1 = $("#from_date1").val();
			var $to_date1 = $("#to_date1").val();
			 $.ajax({    
		    		url: 'get_tr_data.php',
		    		type:'GET',
		    		dataType: 'json',
		    		data: {
			    		from_date1: $from_date1,
			    		to_date1: $to_date1
		    		},
		    		success: function(response) {
						if(response)
						{
							$("#tr_graph").html("");
							Morris.Bar({
						        element: 'tr_graph',
						        data: response,
						        xkey: 'y',
						        ykeys: ['a'],
						        labels: ['Total'],
						        hideHover: 'auto',
						        resize: true,
						        padding: 50,
						        xLabelAngle: 10,
						        barColors: function (row, series, type) 
						        {
								    /*if (type === 'bar') {
								      var red = Math.ceil(255 * row.y / this.ymax);
								      return 'rgb(' + red + ',50,100)';
								    }
								    else {
								      return '#000';
								    }*/
								    if(row.label == "SAVINGS ACCOUNT") return "#52EDC7";
									else if(row.label == "CURRENT") return "#FF2A68";
									else if(row.label == "PAY ORDER") return "#1AD6FD";
									else if(row.label == "CASH CREDIT") return "#5BCAFF";
									else if(row.label == "DIVIDEND") return "#C644FC";
							   }
						    });	
						    //$("#progress").hide();
						}
					}
			 });	
		});

		$("#submit2").click(function(e){
			e.preventDefault();
			var $from_date2 = $("#from_date2").val();
			var $to_date2 = $("#to_date2").val();
			 $.ajax({    
		    		url: 'get_br_data.php',
		    		type:'GET',
		    		dataType: 'json',
		    		data: {
			    		from_date2: $from_date2,
			    		to_date2: $to_date2
		    		},
		    		success: function(response) {
						if(response.length != 0)
						{
							$("#br_graph").html("");
							Morris.Donut({
							  element: 'br_graph',
							  hideHover: 'auto',
							  resize: true,
							  data: response,
							  backgroundColor: '#ccc',
							  labelColor: '#060',
							  colors: [
							    '#0BA462',
							    '#39B580',
							    '#67C69D',
							    '#95D7BB'
							  ]
							});
						}
						else
						{
							$("#br_graph").html("<div class='alert alert-danger'><b>No data found</b></div>");
						}
					}
			 });	
		});

	});

	Morris.Bar({
        element: 'tr_graph',
        data: [<?php echo $tr_graph; ?>],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total'],
        hideHover: 'auto',
        resize: true,
        padding: 50,
		xLabelAngle: 10,
        barColors: function (row, series, type) 
        {
		    /*if (type === 'bar') {
		      var red = Math.ceil(255 * row.y / this.ymax);
		      return 'rgb(' + red + ',50,100)';
		    }
		    else {
		      return '#000';
		    }*/
		    if(row.label == "SAVINGS ACCOUNT") return "#52EDC7";
			else if(row.label == "CURRENT") return "#FF2A68";
			else if(row.label == "PAY ORDER") return "#1AD6FD";
			else if(row.label == "CASH CREDIT") return "#5BCAFF";
			else if(row.label == "DIVIDEND") return "#C644FC";
	   }
    });

	Morris.Donut({
	  element: 'br_graph',
	  hideHover: 'auto',
	  resize: true,
	  data: [<?php echo $br_graph; ?>],
	  backgroundColor: '#ccc',
	  labelColor: '#060',
	  colors: [
	    '#0BA462',
	    '#39B580',
	    '#67C69D',
	    '#95D7BB'
	  ]
	});

	Morris.Donut({
	  element: 'ratio_graph',
	  hideHover: 'auto',
	  resize: true,
	  data: [<?php echo $ratio_graph; ?>]
	});
</script>
<style>
hr {
  clear: both;
  color: red;
  background-color: red;
  height: 1px;
  border-width: 0;
  margin: 0;
}
.middle-maindiv {
	width: auto;
}
</style>
</body>
</html>
