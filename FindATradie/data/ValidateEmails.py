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
        fileCheckedEmails = open(strCheckedFilename, "r")
        fileBadEmails = open(strBadFilename, "w")
        arrayEmailAddresses = fileCheckedEmails.readlines()
        if (len(arrayEmailAddresses) > 0):
            strLastCheckedEmail = arrayEmailAddresses[len(arrayEmailAddresses) - 1]
            print("Starting at email " + strLastCheckedEmail + "...")
            strLastCheckedEmail = strLastCheckedEmail.replace("\n", "")
        else:
            strLastCheckedEmail = ""
        fileCheckedEmails.close()

        fileUncheckEmails = open(strUncheckedFilename, "r")
        nFileSize = get_file_size(fileUncheckEmails)
        strEmail = ""
        if (len(strLastCheckedEmail) > 0):
            while (strEmail != strLastCheckedEmail):
                strEmail = fileUncheckEmails.readline()
                strEmail = strEmail.replace("\n", "")
                if (strEmail == ""):
                    fileUncheckEmails.seek(0)
                    break
        fileCheckedEmails = open(strCheckedFilename, "a")
        nFilePos = 0
        while (nFilePos < nFileSize):
            strEmail = fileUncheckEmails.readline()
            nFilePos = fileUncheckEmails.tell()
            strEmail = strEmail.replace("\n", "")
            if (DoCheckValidEmailAddress(strEmail)):
            #if (validate_email(strEmail, True, True, True, 10)):
                fileCheckedEmails.write(strEmail + "\n")
                fileCheckedEmails.flush()
            else:
                fileBadEmails.write(strEmail + "\n")
                fileBadEmails.flush()                                                                                                                                                                                                   
            wait(1)
        fileCheckedEmails.close()
    
        #arrayEmailAddresses = DoCheckEmailAddresses(dictEmails)

    except Exception:
        Exception = Exception
