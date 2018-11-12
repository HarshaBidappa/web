<?php	

session_start();
		error_reporting(E_ALL ^ E_NOTICE);
		ini_set('session.gc_maxlifetime', 60*60*24);
		
		
	function connect_database(){
		date_default_timezone_set('Asia/Kolkata');
		$con = mysql_connect("localhost","root","");

		$db = "carwash";
		mysql_select_db($db);
		return $con;
	}
	connect_database();
	Function ESQ($strtext) {
		$strtext = mysql_real_escape_string($strtext,connect_database());
		return $strtext;
	}
?>