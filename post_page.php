<?php
require_once('../global.php');
authentication_admin();	
if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'active_all') && !empty($_REQUEST['aids']) && isset($_REQUEST['aids']) ) {
	if($result = $db->get_results("select * from page_master where page_id in (".GetSQLValueString($_REQUEST['aids'], "text").") ")) {	
		$db->query("update page_master set active='1' where page_id in (".GetSQLValueString($_REQUEST['aids'], "text").") "); 
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
	} else {
		echo '{"error":"true", "htmlcontent":"Page details not found, please refresh your page."}';
		$db->closeDb();
		exit();
	}
	
}else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'inactive_all') && !empty($_REQUEST['aids']) && isset($_REQUEST['aids']) ) {
	if($result = $db->get_results("select * from page_master where page_id in (".GetSQLValueString($_REQUEST['aids'], "text").") ")) {	
		$db->query("update page_master set active='0' where page_id in (".GetSQLValueString($_REQUEST['aids'], "text").") "); 
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
	} else {
		echo '{"error":"true", "htmlcontent":"Page details not found, please refresh your page."}';
		$db->closeDb();
		exit();
	}
	
} else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'reject_all') && !empty($_REQUEST['aids']) && isset($_REQUEST['aids']) ) {
	//code for delete records goes here
	if($result = $db->get_results("select page_id from page_master where page_id in (".GetSQLValueString($_REQUEST['aids'], "text").") ")) {	
		foreach($result as $row) {			
			//delete all users related data from every table			
			$db->query("delete from page_master where page_id='".GetSQLValueString($row->page_id, "int")."'");
		}
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
	} else {
		echo '{"error":"true", "htmlcontent":"Page details not found please refresh your page."}';
		$db->closeDb();
		exit();
	}
} else if(isset($_REQUEST['do']) && ($_REQUEST['do'] == 'delpage') && !empty($_REQUEST['pid']) && isset($_REQUEST['pid']) ) {
	//code for delete records goes here
	if($row = $db->get_row("select * from page_master where page_id='".GetSQLValueString($_REQUEST['pid'], "int")."'")) {	
		
		//Delete all data related with this id 
		$db->query("delete from page_master where page_id='".GetSQLValueString($_REQUEST['pid'], "int")."'");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();
	} else {
		echo '{"error":"true", "htmlcontent":"Page details not found please refresh your page."}';
		$db->closeDb();
		exit();
	}
} else if(!empty($_REQUEST['page_id']) && !empty($_REQUEST['page_id']) ) { 
	if( isset($_REQUEST['page_title']) && !empty($_REQUEST['page_title']) && 
		isset($_REQUEST['description']) && !empty($_REQUEST['description'])  ) {		
		$status = ($_REQUEST['status'] == 1 ) ? 1 : 0;
		$db->query("update page_master set page_title='".GetSQLValueString($_REQUEST['page_title'], "text")."', description='".GetSQLValueString($_REQUEST['description'], "text")."', meta_tags='".GetSQLValueString($_REQUEST['meta_tags'], "text")."', meta_description='".GetSQLValueString($_REQUEST['meta_description'], "text")."', active='".$status."' where page_id='".GetSQLValueString($_REQUEST['page_id'], "text")."' ");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();		
	} else {
		echo '{"error":"true", "htmlcontent":"Please filled the required fields."}';
		$db->closeDb();
		exit();
	}
} else { 
		if( isset($_REQUEST['page_title']) && !empty($_REQUEST['page_title']) && 
			isset($_REQUEST['description']) && !empty($_REQUEST['description'])  ) {		
		
		$status = ($_REQUEST['status'] == 1 ) ? 1 : 0;
		$db->query("insert into page_master (page_title, description, meta_tags, meta_description, date_time, active) values ('".GetSQLValueString($_REQUEST['page_title'], "text")."', '".GetSQLValueString(htmlentities($_REQUEST['description']), "text")."', '".GetSQLValueString($_REQUEST['meta_tags'], "text")."', '".GetSQLValueString($_REQUEST['meta_description'], "text")."', '".date('Y-m-d H:i:s')."', '".$status."' )");
		echo '{"status":"true"}';
		$db->closeDb();
		exit();		
	} else {
		echo '{"error":"true", "htmlcontent":"Please filled the required fields."}';
		$db->closeDb();
		exit();
	}
}

?>