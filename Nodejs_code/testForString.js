var soap = require('soap');
var url = 'http://service.ygys.net/resumeservice.asmx?WSDL';
var args = { username: 'u100xxx', pwd: 'xxx', original: '姓名：张三 性别：男 手机：13890009900 学历：本科 毕业院校：清华大学 工作经验：3年' };

soap.createClient(url,function(err,client) {
  if (err) {
    console.log(err);
  }

  client.ResumeService.ResumeServiceSoap12.TransResume(args, function(err, result){
    console.log(result);
  }); 

});
