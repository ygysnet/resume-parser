var fs = require('fs'); 
var soap = require('soap');
var url = 'http://service.ygys.net/resumeservice.asmx?WSDL';

var data = fs.readFileSync('d:\\xxx.pdf');  // 同步读取本地文件
var base64str = new Buffer(data).toString('base64');  // 转成base64字符串
var args = { username: 'u100xxx', pwd: 'xxx', content: base64str, ext: '.pdf' };  // 构建参数

soap.createClient(url,function(err,client) {
  if (err) {
    console.log(err);
  }

  client.ResumeService.ResumeServiceSoap12.TransResumeForFileBase64(args, function(err, result){
    console.log(result);
  });

});
