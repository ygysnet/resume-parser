<?php
ob_start();

$url ="http://service.ygys.net/ResumeService.asmx";
$method = "POST";
$headers = array("SOAPAction:http://tempuri.org/TransResume","Content-Type:text/xml; charset=utf-8");
$content = file_get_contents('t.txt');

$bodys = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$bodys = $bodys . "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
$bodys = $bodys . "<soap:Body>";
$bodys = $bodys . "<TransResumeByJsonString xmlns=\"http://tempuri.org/\">";  
$bodys = $bodys . "<username>u100xxx</username>"; 
$bodys = $bodys . "<pwd>xxxxxx</pwd>";  
$bodys = $bodys . "<original>".$content."</original>";
$bodys = $bodys . "</TransResumeByJsonString>";
$bodys = $bodys . "</soap:Body>";
$bodys = $bodys . "</soap:Envelope>";

//$bodys = urlencode($bodys);

$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_FAILONERROR, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
$data = curl_exec($curl);
print_r( $data );die();
 
 
?>

