<?php
ob_start();

$url ="http://service.ygys.net/ResumeService.asmx";
$method = "POST";
$headers = array("SOAPAction:http://tempuri.org/TransResumeByJsonStringForFileBase64","Content-Type:text/xml; charset=utf-8");
$PSize = filesize('d:\20170509.doc');
$fileData = fread(fopen('d:\20170509.doc', "r"), $PSize);
$content = base64_encode($fileData); // 将字节数组进行base64编码，以便于网络传输的安全性；
$ext = '.doc'; // 读取时文件是什么格式，此处填写什么，比如本例读取的是doc文件，则此处写“.doc”

$bodys = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$bodys = $bodys . "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
$bodys = $bodys . "<soap:Body>";
$bodys = $bodys . "<TransResumeByJsonStringForFileBase64 xmlns=\"http://tempuri.org/\">";  
$bodys = $bodys . "<username>u100xxx</username>"; 
$bodys = $bodys . "<pwd>xxxxxx</pwd>";  
$bodys = $bodys . "<content>".$content."</content>"; 
$bodys = $bodys . "<ext>".$ext."</ext>"; 
$bodys = $bodys . "</TransResumeByJsonStringForFileBase64>";
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

