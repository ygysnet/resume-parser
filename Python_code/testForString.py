import suds
from suds.client import Client
username='u1xxxxx'
pwd = 'xxxxxx'
url = 'http://service.ygys.net/resumeservice.asmx?WSDL'
client = Client(url)
result = client.service.TransResume(username,pwd,'name:wangbing mobile:13890988878')

print result
