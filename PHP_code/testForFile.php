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

$PSize = filesize('d:\2.pdf');
$fileData = fread(fopen('d:\2.pdf', "r"), $PSize);
$content = base64_encode($fileData); // 将字节数组进行base64编码，以便于网络传输的安全性；
$username = 'u1xxxx'; // xxxx 为分配的用户名，请向客服索取
$pwd = 'xxxxxx'; // xxxxxx 为分配的密码，请向客服索取
$ext = '.pdf'; // 读取时文件是什么格式，此处填写什么，比如本例读取的是pdf文件，则此处写“.pdf”

$ary = array('username' => $username,'pwd' => $pwd,'content' => $content,'ext'=> $ext);
$result = $client->call('TransResumeByJsonStringForFileBase64',array('parameters'=>$ary));  // 返回Json结构结果字符串
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

