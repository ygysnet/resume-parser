import suds
import base64
from suds.client import Client
fileContent = open('d:\\2.pdf', 'rb').read()
base64Str = base64.b64encode(fileContent)
username='u1xxxxx'
pwd = 'xxxxxx'

url = 'http://service.ygys.net/resumeservice.asmx?WSDL'
client = Client(url)
result = client.service.TransResumeByJsonStringForFileBase64(username,pwd,base64Str,'.pdf')

print result
