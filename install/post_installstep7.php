<?php require_once('../global.php');
	if(isset($_REQUEST['allselectdata']) && !empty($_REQUEST['allselectdata'])) {
	
		$alldata = $_REQUEST['allselectdata'];
		$allsplitdata = explode(",",$alldata);
		$query = "SELECT group_id FROM tb_cps_groups";
		$result = $db->get_results($query);
		
		$ids = "";		
		for($i = 0; $i < count($allsplitdata); $i++)
		{
			$allsplitdataarray = explode("-",$allsplitdata[$i]);	
			for($j = 0; $j < count($allsplitdataarray) - 4 ; $j++)
			{
				if($ids=="")
				$ids = $allsplitdataarray[$j];
				else
				$ids .= ",".$allsplitdataarray[$j];
			}
		}
		$arrid = explode(",",$ids);
		$NoPermissiontogroup = false;
		foreach($result as $row)
		{
			if(!in_array($row->group_id,$arrid))
			{
				$NoPermissiontogroup = true;
				break;
			}
		} 
		
		if($NoPermissiontogroup)
		{
			echo '{"error":"true", "htmlcontent":"Please select one permission for each group."}';
			exit();
		}
		else
		{
			//echo "All have permission";
			for($i = 0; $i < count($allsplitdata); $i++)
			{
				$allsplitdataarray = explode("-",$allsplitdata[$i]);	
				for($j = 0; $j < count($allsplitdataarray) - 4 ; $j++)
				{
					$sql = "INSERT INTO tb_cps_grouppermissions (group_id,page_accessible,page_read,page_write,page_edit) VALUES ('".$allsplitdataarray[$j]."','".$allsplitdataarray[$j+1]."','".$allsplitdataarray[$j+2]."','".$allsplitdataarray[$j+3]."','".$allsplitdataarray[$j+4]."')";
					if($db->query($sql))
					{
						
					}
					$j++;
				}
			}
		}
		
		echo '{"status":"true"}';
		exit;
	}
	else{
		echo '{"error":"true", "htmlcontent":"Please select one permission for each group."}';
		exit();
	}
?>