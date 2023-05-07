<?php
// Pull in the NuSOAP code
ob_start();
require_once('../nusoap.php');  // 第三方的支持webservic调用的库

$url ="http://service.ygys.net/ResumeService.asmx?wsdl";
$client = new nusoap_client($url, 'wsdl','','','','');
$client->soap_defencoding='utf-8';
$client->decode_utf8=false;
$client->xml_encoding='utf-8';
//参数转换为数组传递

$original = file_get_contents('t.txt');
$username = 'u1xxxx'; // xxxx 为分配的用户名，请向客服索取
$pwd = 'xxxxxx'; // xxxxxx 为分配的密码，请向客服索取


$ary = array('username' => $username,'pwd' => $pwd,'original' => $original);
//$ary = array('originial' => $original);
$result = $client->call('TransResume',array('parameters'=>$ary));
echo "<pre>".print_r($result,true)."</pre>";

//错误及debug信息
if ($client->fault) {
echo '<h2>Fault</h2><pre>';
print_r($result);
echo '</pre>';
} else {
// Check for errors
$err = $client->getError();
if ($err) {
// Display the error
echo '<h2>Error</h2><pre>' . $err . '</pre>';
} else {
// Display the result
echo '<h2>Result</h2><pre>';
print_r($result);
echo '</pre>';
}
}
// Display the debug messages
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
 
 
?>

