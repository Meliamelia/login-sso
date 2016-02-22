<?php
function getVerified($username, $password) {

$server = '192.168.1.244';
$port       = 389; 
$name = explode('@',$username);
$useracc = $name[0];
$domain = '@'.$name[1];

// membuat koneksi ke server active directory  
$ldapconn = ldap_connect($server,$port); // jika gagal akan mereturn value FALSE  

  
if ($ldapconn) {  
// menyatukan aplikasi dengan server LDAP  
$ldapbind = @ldap_bind($ldapconn,$useracc.$domain,$password);  
// verify binding  
if ($ldapbind) {  
	return $useracc.$domain;
	} else {  
	return "Gagal login ";
	}
}
}

require('lib/nusoap.php');
$server = new soap_server();
$server->configureWSDL('ssoad', 'urn:stockquote');
$server->register("getVerified",
array('username' => 'xsd:string', 'password' => 'xsd:string'),
array('return' => 'xsd:string', 'return' => 'xsd:string'),
'urn:stockquote',
'urn:stockquote#getVerified');
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)
? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
