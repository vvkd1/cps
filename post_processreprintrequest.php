<?php
require_once 'global.php';
if(isset($_POST["do"]) && $_POST["do"]=="reprint" && isset($_POST["ids"]) && $_POST["ids"]!="")
{
	$sqlquery ="UPDATE tb_cps_reprintque SET cps_reprint_approved = 1 WHERE id IN (".$_POST["ids"].") ";
	$db->query($sqlquery);
	//$sqlquerydelete ="DELETE FROM tb_cps_reprintque WHERE cps_reprint_approved = 0";
	//$db->query($sqlquerydelete);
	echo '{"status":"true"}';
	$db->closeDb();
	exit();
}
//pravin start 19/2/2015
if(isset($_POST["do"]) && $_POST["do"]=="delete" && isset($_POST["ids"]) && $_POST["ids"]!="")
{
	$sqlquery ="delete from tb_cps_reprintque WHERE id IN (".$_POST["ids"].") ";
	$db->query($sqlquery);
	echo '{"status":"true"}';
	$db->closeDb();
	exit();
}
//pravin end
?>