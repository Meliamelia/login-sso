<?php
function getVerified($username, $password) {
	//$symbol = "admin";
	 $myServer = "192.168.1.11";
	$connectInfo = array( "Database"=>"DatabaseName","UID"=>"user","PWD"=>"password");
	$conn = sqlsrv_connect( $myServer, $connectInfo);
	$passmd5 = md5($password);
	//declare the SQL statement that will query the database
		$query = "SELECT * FROM userDetail WHERE userName = '$username' AND password='$passmd5'";
		
	//execute the SQL query and return records
	$stmt = sqlsrv_query($conn,$query);
	if( $stmt === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	if($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){ 
		return $row['routeName'].$row[;
		
		//echo $row['username'];
	}else{
		return "Nihil";
		//echo "Nihil";
	} 
}

require('lib/nusoap.php');
$server = new soap_server();
$server->configureWSDL('ssosqlserver', 'urn:stockquote');
$server->register("getVerified",
array('username' => 'xsd:string', 'password' => 'xsd:string'),
array('return' => 'xsd:string', 'return' => 'xsd:string'),
'urn:stockquote',
'urn:stockquote#getVerified');
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
