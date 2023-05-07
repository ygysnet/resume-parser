package com.webservice;

import java.io.File;

public class TestWebservice {

	private static String NAMESPACE = "http://tempuri.org/";
	private static String URL = "http://service.ygys.net/ResumeService.asmx?WSDL"; // 测试接口地址

	public static void main(String args[]) throws Exception {
		// 不依赖于第三方jar包（例如ksoap），直接http post数据方法
		String content = "";
		String interfaceName = "TransResumeByJsonStringForFileBase64";
		File file = new File("D:/7777777/111.pdf"); // 读取本地文件
		if (file.exists()) {
			byte[] b = Utils.getBytesFromFile(file); // 将文件转换成字节数组；
			content = Utils.getBase64String(b); // 将字节数组转换成base64字符串；
		} else {
			System.out.println("找不到指定的文件！");
		}
		String Data = "";
		Data = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		Data += "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
		Data += "<soap:Body>";
		Data += "<" + interfaceName + " xmlns=\"http://tempuri.org/\">"; // 接口名称
		Data += "<username>u100xxx</username>"; // 用户名
		Data += "<pwd>xxxxx</pwd>"; // 密码
		Data += "<content>" + content + "</content>"; // 文件base64串
		Data += "<ext>.PDF</ext>"; // 扩展名，根据实际情况修改
		Data += "</" + interfaceName + ">";
		Data += "</soap:Body>";
		Data += "</soap:Envelope>";
		String result = Utils.httpPost(URL, Data, interfaceName); // 返回的结果是xml格式，因此需要剔除xml标记，下边2句话实现；
		result = result.substring(result.indexOf("{")); // 掐头
		result = result.substring(0, result.indexOf("</TransResume")); // 去尾
		System.out.println(result); // 解析结果 json格式表示
	}
}
