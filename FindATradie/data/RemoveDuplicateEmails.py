#!/usr/bin/env python
from common import *
from pathlib import Path




global g_browserChrome




dictEmails = {}
nKeyNum = 0
strTrade = "ELECTRICIANS"
strUncheckedFilename = "C:/Users/" + g_strWindowsUserFolder + "/Documents/GitHub/boylesg.github.io/FindATradie/data/" + strTrade + ".email"
strCheckedFilename = "C:/Users/" + g_strWindowsUserFolder + "/Documents/GitHub/boylesg.github.io/FindATradie/data/" + strTrade + ".email_"
try:
    with open(strUncheckedFilename, "r") as fileEmails:
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
                strLine = strLine.replace("\n", "")
                dictEmails["line" + str(nKeyNum)] = strLine
                nKeyNum += 1
        else:
            fileEmails.close()

    arrayEmailAddresses = []
    fileEmails = open(strUncheckedFilename, "w")
    for strKey, strEmail in dictEmails.items():
        fileEmails.write(strEmail + "\n")
    fileEmails.close()

    fileCheckedEmails = Path(strCheckedFilename)
    if not fileCheckedEmails.is_file():
        fileCheckedEmails = open(strCheckedFilename, "w")
        fileCheckedEmails.close()
    fileCheckedEmails = open(strCheckedFilename, "r")
    arrayEmailAddresses = fileCheckedEmails.readlines()
    if (len(arrayEmailAddresses) > 0):
        strLastCheckedEmail = arrayEmailAddresses[len(arrayEmailAddresses) - 1]
        print("Starting at email " + strLastCheckedEmail + "...")
    else:
        strLastCheckedEmail = ""
    fileCheckedEmails.close()

    fileUncheckEmails = open(strUncheckedFilename, "r")
    nFileSize = get_file_size(fileUncheckEmails)
    strEmail = ""
    if (len(strLastCheckedEmail) > 0):
        while (strEmail != strLastCheckedEmail):
            strEmail = fileUncheckEmails.readline()

    fileCheckedEmails = open(strCheckedFilename, "a")
    nFilePos = 0
    while (nFilePos < nFileSize):
        strEmail = fileUncheckEmails.readline()
        nFilePos = fileUncheckEmails.tell()
        strEmail = strEmail.replace("\n", "")
        if (DoCheckValidEmailAddress(strEmail)):
            fileCheckedEmails.write(strEmail + "\n")
            fileCheckedEmails.flush()
        wait(1)
    fileCheckedEmails.close()

    #arrayEmailAddresses = DoCheckEmailAddresses(dictEmails)
except Exception:
    Exception = Exception
