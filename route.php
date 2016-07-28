<?php
require_once('lib/nusoap.php');
$username = $_POST['username'];
$password = $_POST['password'];
$myServer = "192.168.1.11";

$connectInfo = array( "Database"=>"MobileIntelligence","UID"=>"sa","PWD"=>"admin%%123");
$conn = sqlsrv_connect( $myServer, $connectInfo);

$query = "select * from userDetail where routeName='$username'";
$result = sqlsrv_query($conn,$query); 
$row = sqlsrv_fetch_array($result);
$db =  $row['routes'];
echo $db;

 if(empty($db)){
header('Location: http://localhost:8080/WebServiceSOAP/login.php');
}else{
switch ($db) {
    case 1:
	
		$c = new nusoap_client('http://192.168.1.10/WebServiceSOAP/ssoad.php');
				
		$result = $c->call('getVerified',array('username' => $username, 'password' => $password));
		echo $resul; 
        break;
    case 2:
		$c = new nusoap_client('http://192.168.1.10/WebServiceSOAP/ssosqlserver.php');
		
		
		$result = $c->call('getVerified',array('username' => $username, 'password' => $password));
		$a = json_encode($result);
		echo $a;
		
        break;
    case 3:
		$c = new nusoap_client('http://192.168.1.10/WebServiceSOAP/ssomysqlserver.php');
		
		
		$result = $c->call('getVerified',array('symbol' => $username, 'password' => $password));
		echo $result;
        break;
   }}
?>