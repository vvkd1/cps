<?php
require_once('global.php');
if(isset($_POST["txtFieldName"]) && count($_POST["txtFieldName"])>0 )
{
	$sqldelete = "TRUNCATE TABLE tb_cps_mapfieldstest";
	$db->query($sqldelete);
	
	for($i=0;$i<count($_POST["txtFieldName"]);$i++)
	{
		if($_POST["txtFieldName"][$i]!=null)
		{
			$systemdatatype = getDataType($_POST["d_datatype"][$i]);
			$bankdatatype = getDataType($_POST["ddlDataType"][$i]);
			
			$sqlinsert = "INSERT INTO tb_cps_mapfieldstest
						(fieldname,fielddatatype,fieldlength,bankfieldname,bankfielddatatype,bankfieldlength)
						VALUES
						('".$_POST["systemfieldname"][$i]."','".$systemdatatype."','".$_POST["d_lenMax"][$i]."','".$_POST["txtFieldName"][$i]."','".$bankdatatype."','".$_POST["txtLength"][$i]."')	
							";
			$db->query($sqlinsert);				
		}
	}
}

function getDataType($datatype)
{
	if($datatype=="D")
	{
		$datatype = "Date";
	}
	else if($datatype=="N")
	{
		$datatype = "Numeric";
	}
	else if($datatype=="V")
	{
		$datatype = "Varchar";
	}
	
	return $datatype;
}
?>