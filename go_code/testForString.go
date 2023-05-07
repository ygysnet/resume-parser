package main
import "fmt"
import "strings"
import "io/ioutil"
import "net/http"

func main() { 

    resumeContent :="姓名：王兵 年龄：23 手机号：13456789009"
    
    Data := "<?xml version=\"1.0\" encoding=\"utf-8\"?>"
    Data += "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">"
    Data += "<soap:Body>"
    Data += "<TransResumeByJsonResult xmlns=\"http://tempuri.org/\">"  // 接口名称
    Data += "<username>u100xxx</username>" // 用户名
    Data += "<pwd>xxx</pwd>"  // 密码
    Data += "<original>" + resumeContent + "</original>" // 简历原文内容
    Data += "</TransResumeByJsonResult>"
    Data += "</soap:Body>"
    Data += "</soap:Envelope>"

    client := &http.Client{}
    reqest, _ := http.NewRequest("POST", "http://service.ygys.net/ResumeService.asmx", strings.NewReader(Data))
    reqest.Header.Set("SOAPAction","http://tempuri.org/TransResumeByJsonStringForFileBase64")
    reqest.Header.Set("Content-Type","text/xml; charset=utf-8")
    response,_ := client.Do(reqest)
    if response.StatusCode == 200 {
      body, _ := ioutil.ReadAll(response.Body)
      bodystr := string(body);
      fmt.Println(bodystr)
    }
}
