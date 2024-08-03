#!/usr/bin/env python
from common import *




global g_browserChrome




dictEmails = {}
nKeyNum = 0
strTrade = "ELECTRICIANS"
strFilename = "C:\\Users\\" + g_strWindowsUserFolder + "\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\" + strTrade + ".email"
with open(strFilename, "r") as fileEmails:
    for strLine in fileEmails:
        if "@" in strLine:
            nPosAt = strLine.index("@")
            nPosEndComma = -1
            nPosStartComma = -1
            try:
                nPosEndComma = strLine.index(",", nPosAt)
                nPosStartComma = strLine.rindex(",", 0, nPosAt)
            except Exception:
                pass
            if ((nPosStartComma > -1) and (nPosEndComma) > -1):
                strLine = strLine[nPosStartComma + 1 : nPosEndComma] + "\n"
            strLine = strLine.replace("\n", "")
            dictEmails[strLine] = strLine
        elif "," not in strLine:
            strLine = strLine.remove("\n")
            dictEmails["line" + str(nKeyNum)] = strLine
            nKeyNum += 1
    else:
        fileEmails.close()

    arrayEmailAddresses = []
    arrayEmailAddresses = DoCheckEmailAddresses(dictEmails)

arrayEmails = DoCheckEmailAddresses(dictEmails)
fileEmails = open("C:\\Users\\" + g_strWindowsUserFolder + "\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\" + strTrade + ".email", "w")
for strEmail in arrayEmails:
    fileEmails.write(strEmail + "\n")
fileEmails.close()