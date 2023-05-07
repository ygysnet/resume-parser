package com.webservice;

import java.io.File;

public class TestWebservice {

	private static String NAMESPACE = "http://tempuri.org/";
	private static String URL = "http://service.ygys.net/ResumeService.asmx?WSDL"; // ���Խӿڵ�ַ

	public static void main(String args[]) throws Exception {
		// �������ڵ�����jar��������ksoap����ֱ��http post���ݷ���
		String content = "";
		String interfaceName = "TransResumeByJsonStringForFileBase64";
		File file = new File("D:/7777777/111.pdf"); // ��ȡ�����ļ�
		if (file.exists()) {
			byte[] b = Utils.getBytesFromFile(file); // ���ļ�ת�����ֽ����飻
			content = Utils.getBase64String(b); // ���ֽ�����ת����base64�ַ�����
		} else {
			System.out.println("�Ҳ���ָ�����ļ���");
		}
		String Data = "";
		Data = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		Data += "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
		Data += "<soap:Body>";
		Data += "<" + interfaceName + " xmlns=\"http://tempuri.org/\">"; // �ӿ�����
		Data += "<username>u100xxx</username>"; // �û���
		Data += "<pwd>xxxxx</pwd>"; // ����
		Data += "<content>" + content + "</content>"; // �ļ�base64��
		Data += "<ext>.PDF</ext>"; // ��չ��������ʵ������޸�
		Data += "</" + interfaceName + ">";
		Data += "</soap:Body>";
		Data += "</soap:Envelope>";
		String result = Utils.httpPost(URL, Data, interfaceName); // ���صĽ����xml��ʽ�������Ҫ�޳�xml��ǣ��±�2�仰ʵ�֣�
		result = result.substring(result.indexOf("{")); // ��ͷ
		result = result.substring(0, result.indexOf("</TransResume")); // ȥβ
		System.out.println(result); // ������� json��ʽ��ʾ
	}
}
