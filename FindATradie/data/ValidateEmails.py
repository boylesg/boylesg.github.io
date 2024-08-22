#!/usr/bin/env python
from common import *
from pathlib import Path




g_strPath = "C:/Users/" + g_strWindowsUserFolder + "/Documents/GitHub/boylesg.github.io/FindATradie/data/"
g_strTrade = "PLUMBERS"




if False:
    fileJSON = open(g_strPath + g_strTrade + ".json", "r")
    if (fileJSON):
        arrayBusinessDetails = json.load(fileJSON)
        fileEmail = open(g_strPath + g_strTrade + ".email", "w")
        if (fileEmail):
            for dictBusinessDetails in arrayBusinessDetails:
                if (len(dictBusinessDetails["email"]) > 0):
                    fileEmail.write(dictBusinessDetails["email"] + "\n")
            fileEmail.close()
        fileJSON.close()




g_strUpToEmailFilename = g_strPath + g_strTrade + ".email___"

def DoReadEmailPlace():
    strEmail = ""
    try:
        fileUpToEmail = open(g_strUpToEmailFilename, "r")
        if fileUpToEmail:
            strEmail = fileUpToEmail.read()
            strEmail = strEmail.replace("\n", "")
            fileUpToEmail.close()
    except Exception as error:
        fileUpToEmail = open(g_strUpToEmailFilename, "w")
        fileUpToEmail.close()

    return strEmail




def DoSaveEmailPlace(strEmail):
    fileUpToEmail = open(g_strUpToEmailFilename, "w")
    if fileUpToEmail:
        fileUpToEmail.write(strEmail + "\n")
        fileUpToEmail.close()




if True:
    global g_browserChrome
    dictEmails = {}
    nKeyNum = 0
    strUncheckedFilename = g_strPath + g_strTrade + ".email"
    strCheckedFilename = g_strPath + g_strTrade + ".email_"
    strBadFilename = g_strPath + g_strTrade + ".email__"
    try:
        fileEmails = open(strUncheckedFilename, "r")
        fileBadEmails = open(strBadFilename, "w")
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
        fileBadEmails = open(strBadFilename, "w")
        fileCheckedEmails = open(strCheckedFilename, "a")
        fileUncheckedEmails = open(strUncheckedFilename, "r")
        arrayEmailAddresses = fileUncheckedEmails.readlines()
        fileUncheckedEmails.close()
        nStartIndex = 0
        if (len(arrayEmailAddresses) > 0):
            nI = 0
            strEmailStartAt = DoReadEmailPlace()
            if (strEmailStartAt != ""):
                for strEmail in arrayEmailAddresses:
                    strEmail = strEmail.replace("\n", "")
                    arrayEmailAddresses[nI] = strEmail
                    if (strEmail == strEmailStartAt):
                        nStartIndex = nI
                    nI += 1
            print("Starting at email " + str(nStartIndex) + ". '" + arrayEmailAddresses[nStartIndex] + "'...")

        for nI in range(nStartIndex + 1, len(arrayEmailAddresses)):
            strEmail = arrayEmailAddresses[nI]
            DoSaveEmailPlace(strEmail)
            if (DoCheckValidEmailAddress(strEmail)):
                fileCheckedEmails.write(strEmail + "\n")
                fileCheckedEmails.flush()
            else:
                fileBadEmails.write(strEmail + "\n")
                fileBadEmails.flush()                                                                                                                                                                                                   
            wait(1)
        fileCheckedEmails.close()
        fileBadEmails.close()

    except Exception as error:
        Exception = Exception
