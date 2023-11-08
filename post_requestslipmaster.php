<?php require_once('global.php');
// assign posted variable value to variables
$requestfield1 = $_REQUEST['requestfield1'];
$requestfield2 = $_REQUEST['requestfield2'];
$requestfield3 = $_REQUEST['requestfield3'];
$requestfield4 = $_REQUEST['requestfield4'];
$requestfield5 = $_REQUEST['requestfield5'];
$requestfield6 = $_REQUEST['requestfield6'];
$requestfield7 = $_REQUEST['requestfield7'];
$requestfield8 = $_REQUEST['requestfield8'];
$requestfield9 = $_REQUEST['requestfield9'];
$requestfield10 = $_REQUEST['requestfield10'];
$requestfield11 = $_REQUEST['requestfield11'];



// update query 
$namer_id = $db->query("UPDATE tb_cps_requestslip SET 
requestfield1 = '".$requestfield1."', 
requestfield2='".$requestfield2."', 
requestfield3='".$requestfield3."',
requestfield4='".$requestfield4."'
requestfield5='".$requestfield5."', 
requestfield6='".$requestfield6."', 
requestfield7='".$requestfield7."',
requestfield8='".$requestfield8."',
requestfield9='".$requestfield9."', 
requestfield10='".$requestfield10."', 
requestfield11='".$requestfield11."'
 ");	
	

if($_REQUEST['submit1'] == 'Save and Close') 
{
	$location = 'home.php';
} else 
{
	$location = 'requestslipmaster.php';
}

echo '{"status":"true", "loc":"'.$location.'"}';
exit();	


?>