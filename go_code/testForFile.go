package main
import "fmt"
import "strings"
import "io/ioutil"
import "encoding/base64"
import "net/http"

func main() { 
    fdata,err := ioutil.ReadFile("d:/test.doc") // 自己的文件
    if err!=nil {
      fmt.Println("read file error")
    }

    base64String := base64.StdEncoding.EncodeToString(fdata)
    
    Data := "<?xml version=\"1.0\" encoding=\"utf-8\"?>"
    Data += "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">"
    Data += "<soap:Body>"
    Data += "<TransResumeByJsonStringForFileBase64 xmlns=\"http://tempuri.org/\">"  // 接口名称
    Data += "<username>u100xxx</username>" // 用户名
    Data += "<pwd>xxx</pwd>"  // 密码
    Data += "<content>" + base64String + "</content>" // 文件base64串
    Data += "<ext>.DOC</ext>" // 扩展名
    Data += "</TransResumeByJsonStringForFileBase64>"
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
