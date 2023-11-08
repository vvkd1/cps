<?php
$micrband = "00015591040399100013001007412405";
$arraymicrband = str_split($micrband);
$arrayDOUBLEval;
for($i = 0;$i < count($arraymicrband); $i++){
	if($i % 2 == 0){
		$arrayDOUBLEval[$i] = $arraymicrband[$i];
	}else{
		$arrayDOUBLEval[$i] = $arraymicrband[$i]*2;
	}
}

$sumString = implode("", $arrayDOUBLEval);
$finalArray = str_split($sumString);
$Digitsum = array_sum($finalArray);
$MOD = $Digitsum % 100;
$chkSum = 100 - $MOD;

?>