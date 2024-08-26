import random
import smtplib
from datetime import datetime, timedelta
import os
import os.path
from email.message import EmailMessage
from email.headerregistry import Address
from email.utils import make_msgid
from email import message_from_bytes
from imaplib import IMAP4_SSL
import contextlib
from common import *

#g_strPath = "C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\"
g_strPath = ""


def MakeAddress(strDisplayName, strEmailAddress):
    arrayEmailParts = strEmailAddress.split("@")
    EmailAddress = Address(strDisplayName, arrayEmailParts[0], arrayEmailParts[1])
    return EmailAddress


def DoConnectEmailServer(dictEmailServer):
    SMTPObject = None

    try:
        # Send the email via our own SMTP server.
        print("\n\nConnecting to email server '" + dictEmailServer["url"] + "' on port " + str(
            dictEmailServer["port"]) + "...")
        SMTPObject = smtplib.SMTP(dictEmailServer["url"], dictEmailServer["port"])
        SMTPObject.connect(dictEmailServer["server"], dictEmailServer["port"])
        SMTPObject.ehlo()
        SMTPObject.starttls()
        print("Logging in with username '" + dictEmailServer["username"] + "' and password '" + dictEmailServer[
            "password"] + "'...\n")
        SMTPObject.login(dictEmailServer["username"], dictEmailServer["password"])
    except Exception as Error:
        print("EMAIL SERVER ERROR: ", Error)

    return SMTPObject


def IsEmailServerOpen(SMTPObject):
    nStatus = 0
    try:
        nStatus = SMTPObject.noop()[0]
    except:
        nStatus = -1  # smtplib.SMTPServerDisconnected
    bResult = nStatus == 250
    return bResult


def SaveEmails2Delete(arrayEmails2Delete, strEmailFilename):
    if (len(arrayEmails2Delete) > 0):
        fileEmails2Delete = open(g_strPath + strEmailFilename + "__", "a+")
        if fileEmails2Delete:
            for strEmail in arrayEmails2Delete:
                fileEmails2Delete.write(strEmail + "\n")
            fileEmails2Delete.close()
    arrayEmails2Delete


def DoOpenFile(strFilename):
    fileObject = None
    if (not os.path.isfile(strFilename)):
        fileObject = open(strFilename, "w+")
        fileObject.close()
    fileObject = open(strFilename, "r+")
    return fileObject


def UpdateEmailFile(strEmailFilename):
    arrayEmails2Delete = []
    fileEmails2Delete = DoOpenFile(g_strPath + strEmailFilename + "__")
    fileUpdatedEmails = open(g_strPath + strEmailFilename + "_", "w+")
    fileEmails = open(g_strPath + strEmailFilename, "r")
    dictEmails = {}
    if (fileEmails2Delete and fileUpdatedEmails and fileEmails):
        for strEmail in fileEmails:
            strEmail = strEmail.replace("\n", "")
            dictEmails[strEmail] = strEmail
        for strEmail in fileEmails2Delete:
            strEmail = strEmail.replace("\n", "")
            if (strEmail in dictEmails):
                dictEmails.pop(strEmail, None)
        for strKey, strEmail in dictEmails.items():
            fileUpdatedEmails.write(strEmail + "\n")
        fileEmails2Delete.close()
        fileUpdatedEmails.close()
        fileEmails.close()


def DoRemoveInvalidEmails(strEmailFilename, dictEmailServer):
    strSuccessCode = "OK"
    arrayEmails2Delete = []
    with IMAP4_SSL(dictEmailServer["server"]) as mail_server:
        mail_server.login(dictEmailServer["username"], dictEmailServer["password"])
        mail_server.list()
        mail_server.select('INBOX')
        (strReturnCode, messages) = mail_server.search(None, "(OR (ALL) (FROM " + dictEmailServer["username"] + "))")
        if (strReturnCode == strSuccessCode) and messages[0]:
            for nI, nJ in enumerate(messages[0].split()):
                strReturnCode, byteData = mail_server.fetch(nJ, '(RFC822)')
                if (strReturnCode == strSuccessCode) and byteData:
                    objectMsg = message_from_bytes(byteData[0][1])
                    for objectMsgPart in objectMsg.walk():
                        # each part is a either non-multipart, or another multipart message
                        # that contains further parts... Message is organized like a tree
                        if objectMsgPart.get_content_type() == 'text/plain':
                            strMessage = objectMsgPart.get_payload()
                            strEmail = ""
                            with contextlib.suppress(Exception):
                                if ("Delivery has failed to these recipients or groups" in strMessage):
                                    '''
                                    Delivery has failed to these recipients or groups:
                                    
                                    Fellow Tradie (macsplumbing@hotmail.com)
                                    The recipient's mailbox is full and can't accept messages now. Please try resending your message later, or contact the recipient directly.
                                    
                                    '''
                                    nPos1 = strMessage.index("@")
                                    nPos1 = strMessage.rfind("(", 0, nPos1) + 1
                                    nPos2 = strMessage.find(")", nPos1)
                                    strEmail = strMessage[nPos1:nPos2]
                                elif ("Delivery incomplete" in strMessage) or (
                                        "Message not delivered" in strMessage) or (
                                        "Address not found" in strMessage) or (
                                        "Recipient inbox full" in strMessage) or ("Message blocked" in strMessage):
                                    '''
                                    EXAMPLE EMAILS
                                    ===============
    
                                    ** Address not found **
                                    
                                    Your message wasn't delivered to admin@pjconcreting.com.au because the domain pjconcreting.com.au couldn't be found. Check for typos or unnecessary spaces and try again.
                                    
                                    
                                    
                                    The response was:
                                    
                                    DNS Error: DNS type 'mx' lookup of pjconcreting.com.au responded with code SERVFAIL
                                    
                                    
                                    * Recipient inbox full **
    
                                    Your message couldn't be delivered to mb.concreteconstruction@gmail.com. Their inbox is full, or it's getting too much mail right now.
    
                                    Learn more here: https://support.google.com/mail/?p=OverQuotaTemp
    
                                    The response was:
    
                                    452 4.2.2 The recipient's inbox is out of storage space. Please direct the recipient to https://support.google.com/mail/?p=OverQuotaTemp 586e51a60fabf-273cea1b9c9sor1506374fac.11 - gsmtp 
                                    '''
                                    nPos1 = strMessage.index("@")
                                    nPos1 = strMessage.rfind(" ", 0, nPos1) + 1
                                    nPos2 = strMessage.find(" ", nPos1)
                                    strEmail = strMessage[nPos1:nPos2]
                                    strEmail = strEmail.strip(". ")

                            if (strEmail != ""):
                                arrayEmails2Delete.append(strEmail)
                                (strReturnCode, data) = mail_server.store(nJ, "+FLAGS", "\\Deleted")

    SaveEmails2Delete(arrayEmails2Delete, strEmailFilename)
    UpdateEmailFile(strEmailFilename)


g_timeRestart = datetime.now()
g_timeRestart = g_timeRestart.replace(hour=1, minute=0)


def DoWait(strEmailFilename):
    '''
    global g_timeRestart
    timeNow = datetime.now()
    timeDiff = g_timeRestart - timeNow
    nSeconds = int(timeDiff.total_seconds())
    if (nSeconds < 0):
        timeDiff = timeNow - g_timeRestart
        nSeconds = int(timeDiff.total_seconds())
    '''
    wait(600)
    DoRemoveInvalidEmails(strEmailFilename)
    nSeconds = 2 * 60 * 60
    wait(nSeconds)


def DoSendEmail(strToEmail, strEmailFilename, SMTPObject, dictEmailServer):
    bResult = False

    while True:
        try:
            # Create the base text message.
            msg = EmailMessage()
            msg["Subject"] = "NEW SERVICE for tradies: find-a-tradie.com.au"
            msg["From"] = MakeAddress("Find a Tradie", dictEmailServer["username"])
            msg["Reply-To"] = MakeAddress("Find a Tradie", "find-a-tradie@outlook.com")

            msg["To"] = MakeAddress("Fellow Tradie", strToEmail)
            msg.set_content(dictEmailServer["txt_content"])

            # Add the html version.  This converts the message into a multipart/alternative
            # container, with the original text message as the first part and the new html
            # message as the second part.
            # strCIDHomePage = make_msgid("home", "page")
            # strCIDFeedback = make_msgid("feedback", "trust")
            # strCIDCustomerFeedback = make_msgid("customer", "feedback")
            # strCIDTradieFeedback = make_msgid("tradie", "feedback")
            strCIDHomePage = "home@page"
            strCIDFeedback = "feedback@trust"
            strCIDCustomerFeedback = "customer@feedback"
            strCIDTradieFeedback = "tradie@feedback"

            msg.add_alternative(
                dictEmailServer["html_content"].format(strCIDHomePage=strCIDHomePage[1:-1], strCIDFeedback=strCIDFeedback[1:-1],
                                             strCIDCustomerFeedback=strCIDCustomerFeedback[1:-1],
                                             strCIDTradieFeedback=strCIDTradieFeedback[1:-1]),
                subtype='html')
            # NOTE: we needed to peel the <> off the msgid for use in the html.

            # Now add the related image to the html part.
            with open(g_strPath + "home_page.jpg", "rb") as img:
                msg.get_payload()[1].add_related(img.read(), "image", "jpeg",
                                                 cid=strCIDHomePage)
            with open(g_strPath + "feedback.jpg", "rb") as img:
                msg.get_payload()[1].add_related(img.read(), "image", "jpeg",
                                                 cid=strCIDFeedback)
            with open(g_strPath + "customer_feedback.jpg", "rb") as img:
                msg.get_payload()[1].add_related(img.read(), "image", "jpeg",
                                                 cid=strCIDCustomerFeedback)
            with open(g_strPath + "tradie_feedback.jpg", "rb") as img:
                msg.get_payload()[1].add_related(img.read(), "image", "jpeg",
                                                 cid=strCIDTradieFeedback)

            SMTPObject.send_message(msg)
            bResult = True
            break

        except Exception as error:
            if (isinstance(error.args[0], int)):
                strErrorMsg = error.args[1].decode("utf-8")
            else:
                strErrorMsg = error.args[0][strToEmail][1].decode("utf-8")

            if ("Server not connected" in strErrorMsg):
                print("\nEMAIL SERVER ERROR: server disconnected unexpectedly...\n", error)
            elif ("Connection timed out" in strErrorMsg):
                print("\nEMAIL SERVER ERROR: time out...", error)
            elif ("Connection expired" in strErrorMsg):
                print("\nEMAIL SERVER ERROR: connection expired...", error)
            elif ("OutboundSpamException" in strErrorMsg):
                print("\nEMAIL SERVER ERROR: outbound spam email blocked...\n", error)
            elif ("Daily user sending limit exceeded"):
                print("\nEMAIL SERVER ERROR: sending limit reached...\n", error)
                DoWait(strEmailFilename)

    return bResult


g_strSavedEmailFile = "last_email.txt"


def SaveEmailPlace(strEmail, strEmailFile):
    fileLastEmail = open(g_strPath + g_strSavedEmailFile, "w")
    fileLastEmail.write(strEmailFile + "\n")
    fileLastEmail.write(strEmail + "\n")
    fileLastEmail.flush()
    fileLastEmail.close()


def GetLastEmail(arrayEmailFiles):
    strLastEmail = ""
    strLastEmailFile = ""

    if (os.path.isfile(g_strPath + g_strSavedEmailFile)):
        fileLastEmail = open(g_strPath + g_strSavedEmailFile, "r")
        if (fileLastEmail):
            strLastEmailFile = fileLastEmail.readline()
            strLastEmailFile = strLastEmailFile.replace("\n", "")
            strLastEmail = fileLastEmail.readline()
            strLastEmail = strLastEmail.replace("\n", "")
        else:
            fileLastEmail = open(g_strPath + g_strSavedEmailFile, "w")
            fileLastEmail.write("\n")
            fileLastEmail.write("\n")
            strLastEmailFile = arrayEmailFiles[0]
            strLastEmail = ""
    return {"last_email_filename": strLastEmailFile, "last_email": strLastEmail}


def LoadEmailMessages(dictEmailFiles):
    strHTMLEmailContent = ""
    strTextEmailContent = ""

    if (os.path.isfile(g_strPath + "email.html")) and (os.path.isfile(g_strPath + "email.txt")):
        fileEmailContents = open(g_strPath + "email.html", "r", encoding="utf-8")
        strLine = ""
        while (True):
            strLine = fileEmailContents.readline()
            if (len(strLine) > 0):
                strHTMLEmailContent += strLine
            else:
                break
        fileEmailContents.close()
        fileEmailContents = open(g_strPath + "email.txt", "r", encoding="utf-8")
        strLine = ""
        while (True):
            strLine = fileEmailContents.readline()
            if (len(strLine) > 0):
                strTextEmailContent += strLine
            else:
                break
        fileEmailContents.close()
        dictEmailFiles["html_content"] = strHTMLEmailContent
        dictEmailFiles["txt_content"] = strTextEmailContent
    else:
        if (not os.path.isfile(g_strPath + "email.html")):
            print("File email.html not found!")
        elif (not os.path.isfile(g_strPath + "email.txt")):
            print("File email.txt not found!")

    return dictEmailFiles


def DoStart(dictConfig):
    nEmailCount = nFileNumber = 0
    SMTPObject = DoConnectEmailServer(dictConfig["email_server"])

    print("\n\n")
    DoRemoveInvalidEmails(dictLast["last_email_filename"], dictConfig["email_server"])

    dictConfig["email_file_list"] = LoadEmailMessages(dictConfig["email_file_list"])
    if (len(dictConfig["email_files"]["html_content"]) > 0) and (len(dictConfig["email_files"]["txt_content"]) > 0) and SMTPObject is not None:
        DoConnectEmailServer(dictConfig["email_server"])
        dictLast = GetLastEmail(dictConfig["selected_email_file_list"])
        if (dictLast["last_email_filename"] != ""):
            while (nFileNumber < len(dictConfig["email_file_list"])):
                strEmailFile = dictConfig["email_file_list"][nFileNumber]
                if (strEmailFile == dictLast["last_email_filename"]):
                    break
                else:
                    nFileNumber += 1

        for nI in range(nFileNumber, len(dictConfig["selected_email_file_list"])):
            strEmailFile = dictConfig["selected_email_file_list"][nI]
            fileEmail = open(g_strPath + strEmailFile, "r")
            if (fileEmail):
                print("Processing email file " + strEmailFile + "...")
                nEmailCount = 0
                if (dictLast["last_email"] != ""):
                    strEmail = "xxxx"
                    while (strEmail != dictLast["last_email"]):
                        strEmail = fileEmail.readline()
                        strEmail = strEmail.replace("\n", "")
                        nEmailCount += 1
                else:
                    strEmail = fileEmail.readline()
                    strEmail = strEmail.replace("\n", "")

                while (strEmail != ""):
                    if (strEmail != ""):
                        print("(" + str(nEmailCount) + ") Sending email to " + strEmail + "...")
                        SaveEmailPlace(strEmail, strEmailFile)
                        if (not DoSendEmail(strEmail, dictLast["last_email_filename"], SMTPObject)):
                            DoWait()
                        else:
                            # wait(random.randrange(3, 15, 1))
                            wait(1)
                    strEmail = fileEmail.readline()
                    if (strEmail != ""):
                        strEmail = strEmail.replace("\n", "")
                        nEmailCount += 1

                DoRemoveInvalidEmails(strEmailFile, dictEmailServer)
                try:
                    os.remove(g_strPath + strEmailFile)
                    os.rename(g_strPath + strEmailFile + "_", g_strPath + strEmailFile)
                    os.remove(g_strPath + strEmailFile + "__")
                    os.remove(g_strPath + strEmailFile + "___")
                except Exception as error:
                    print(error)
                    pass
                print("\n---------------------------------\n")

        fileLastEmail = open(g_strPath + g_strSavedEmailFile, "w")
        if (IsEmailServerOpen(SMTPObject)):
            SMTPObject.quit()
        print("FINISHED!")
