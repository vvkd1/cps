<?php session_start();	
	define('SITE_NAME','GPB ');	
	define("SITE_URL", "http://localhost");
	define('SITE_ROOT', SITE_URL.'/GPB/');	
	define('SITE_ROOT_DOC','/GPB/');
		
	define('ABSOLUTE_DOC_ROOT',$_SERVER['DOCUMENT_ROOT']);
	define('DOC_ROOT',ABSOLUTE_DOC_ROOT . SITE_ROOT_DOC);	
	//define path for admin panel
	define('ADMIN_DOC_ROOT',DOC_ROOT.'');
	define('ADMIN_ROOT',SITE_ROOT.'');		
	define('ADMIN_IMAGES',ADMIN_ROOT.'images/');
	define('ADMIN_STYLES',ADMIN_ROOT.'css/');	
	//Root path
	define('ROOT_INCLUDE',DOC_ROOT.'includes/');
	define('ROOT_SCRIPTS',SITE_ROOT.'scripts/');	
	define('ROOT_SCRIPTS_DOC',DOC_ROOT.'scripts/');
	define('ROOT_STYLES',SITE_ROOT.'css/');	
	define('ROOT_CLASSES',DOC_ROOT.'classes/');
	define('ROOT_IMAGES',SITE_ROOT.'images/');
	define('ROOT_IMAGES_FLDR',DOC_ROOT.'images/');
	
	
	define('CURRENCY_SYMBOL', '$');
	define('FROM_ADDRESS', '');
	define('MAX_UPLOAD_FILE_SIZE', 5242880); // 5MB	
	date_default_timezone_set("Asia/Calcutta");
	
	define('SEND_EMAIL', 0);
	if (!isset($nodb)) {
		require_once(ROOT_CLASSES.'mysql.class.php');
	}	
	require_once('functions.php');	
		
	// for localhost
	$host = 'localhost';	
	$user = 'root';
	$pass = '';	
	$name = 'db_gpb';
	
	
	
	
	if (!isset($nodb)) {
		$db = new db($user,$pass,$name,$host);			
	}	

	$charset = 'utf-8';
	
	checkExpiration();
	
?>