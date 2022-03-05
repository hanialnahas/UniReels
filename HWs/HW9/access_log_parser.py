import re
from dateutil import parser
import datetime
import time
import matplotlib.pyplot as plt
import numpy as np

def reader(fileName):
    with open(fileName) as f, open("out.txt", "w") as w:
        log = f.readlines()
        lineNum = 1
        number = 0
        page = []
        for line in log:
            try:
                regex = map(''.join, re.findall(r'\"(.*?)\"|\[(.*?)\]|(\S+)', line))
                infoList = list(regex)
                infoList[3] = parser.parse(infoList[3].replace(':', ' ', 1))
                name = map(''.join, re.findall(r'\"(.*?)\"|\[(.*?)\]|(\S+)', infoList[4]))
                tmpList = list(name) 
                tt = re.findall(r'\~(.*?)\/', tmpList[1])[0]
                if(tt == 'halnahas'):
                    pageName = map(''.join, re.findall(r's\/(.*?).php', infoList[4]))
                    if(pageName):
                         infoList.insert(7, list(pageName)[0])
                    w.write(str(lineNum)+" - " + str(infoList)+"\n")
                    number += 1
                    page.append(infoList)
            except IndexError:
                pass
            lineNum += 1
        print("found halnahas " + str(number) + " times")
        f.close()
        w.close()  
        return page  

def error_reader(error_file):
    with open(error_file) as f, open('outErr.txt', 'w') as w:
        log = f.readlines()
        lineNum = 1
        number = 0
        page = []
        for line in log:
            try:
                regex = map(''.join, re.findall(r'\[(.*?)\]|(\S.*)', line))
                infoList = list(regex)
                infoList[0] = datetime.datetime.strptime(infoList[0], "%a %b %d %H:%M:%S.%f %Y")
                if(infoList[4].find('halnahas') != -1):
                    w.write(str(lineNum)+" - " + str(infoList)+"\n")
                    number += 1
                    page.append(infoList)
            except IndexError:
                pass
            lineNum += 1
        print("found errors in halnahas " + str(number) + " times")
        f.close()
        w.close()
        return page
        
def count_access(accesses) :
    count = dict()
    for x in accesses:
        count[x[7]] = count.get(x[7], 0) + 1
    return count

def createCountBar(countDict):
    fig = plt.figure(figsize=(10, 5), dpi=80)
    ax = fig.add_subplot(111)
    plt.xticks(rotation=90)
    ax.bar(countDict.keys(), countDict.values())
    plt.savefig('acc.png', bbox_inches='tight')

if __name__ == '__main__':
    accesses = reader('access_log')
    errors = error_reader('error_log')
    cnt = count_access(accesses)
    createCountBar(cnt)