<?php
function getVerified($username, $password) {
$conn=mysqli_connect('192.168.1.5','username','password','databaseName');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$query = "SELECT * from users where userName='$username' AND  password='$password'";
$result = mysqli_query($conn,$query);
if($row = mysqli_fetch_array($result)){
return $row['userName'];  
}else{
return "Bukan user";
}
}

require('lib/nusoap.php');
$server = new soap_server();
$server->configureWSDL('ssomysqlserver', 'urn:stockquote');
$server->register("getVerified",
array('username' => 'xsd:string', 'password' => 'xsd:string'),
array('return' => 'xsd:string', 'return' => 'xsd:string'),
'urn:stockquote',
'urn:stockquote#getVerified');
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
