import os
import os.path,subprocess	
from subprocess import STDOUT,PIPE
import time


#link = https://stackoverflow.com/questions/474528/what-is-the-best-way-to-repeatedly-execute-a-function-every-x-seconds
def print_every_n_seconds(n=2):
    while True:
        print(time.ctime())
        time.sleep(n)
    

	

def download_exp():
    subprocess.call('cd Expansions && java Download_xml_exp', shell=True)
    #subprocess.call('cd Expansions', shell=True)
    #subprocess.call('cd Expansions && javac Download_xml_exp.java', shell=True)
    #subprocess.call('ls', shell=True)
    #subprocess.call(' cd Expansions && javac Download_xml_exp.java', shell=True)
    #subprocess.call('javac Expansions/Download_xml_exp.java', shell=True)

def main():
	print_every_n_seconds()
    #download_exp()

if __name__ == '__main__':
	main()




    
    #subprocess.Popen('javac download_xml_exp.java')
    #subprocess.Popen('')


"""
subprocess.call('cd Expansions', shell=True)
subprocess.check_output("javac download_xml_exp.java", stderr=subprocess.PIPE)
#output = subprocess.check_output("java download_xml_exp", stderr=subprocess.PIPE)
try:
    subprocess.check_output("java download_xml_exp", shell=True, stderr=subprocess.STDOUT)
except subprocess.CalledProcessError as e:
    raise RuntimeError("command '{}' return with error (code {}): {}".format(e.cmd, e.returncode, e.output))
    """
#print(output)