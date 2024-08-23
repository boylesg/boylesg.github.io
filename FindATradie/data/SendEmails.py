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



g_strPath = "C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\"
g_strLastEmailFile = ""




def MakeAddress(strDisplayName, strEmailAddress):
    arrayEmailParts = strEmailAddress.split("@")
    EmailAddress = Address(strDisplayName, arrayEmailParts[0], arrayEmailParts[1])
    return EmailAddress




g_arrayEmailServers = [{"server": "smtp.gmail.com", "port": 587, "username": "gregaryjboyles37@gmail.com", "password": "hkxb fxwc fwog gxrd "},
                        {"server": "smtp-mail.outlook.com", "port": 587, "username": "find-a-tradie@outlook.com", "password": "Pulsar112358#"}]
g_nEmailServer = 0
g_SMTPObject = ""
g_strHTMLEmailContent = ""
g_strTextEmailContent = ""

def DoConnectEmailServer():
    global g_arrayEmailServers
    global g_nEmailServer
    global g_SMTPObject
    bResult = False;
    dictEmailServer = {}

    while (g_nEmailServer < len(g_arrayEmailServers)):
        dictEmailServer = g_arrayEmailServers[g_nEmailServer]
        try:
            # Send the email via our own SMTP server.
            print("\n\nConnecting to email server '" + dictEmailServer["server"] + "' on port " + str(dictEmailServer["port"]) + "...")
            if (IsEmailServerOpen(g_SMTPObject)):
                g_SMTPObject.quit()
            g_SMTPObject = smtplib.SMTP(dictEmailServer["server"], dictEmailServer["port"])
            g_SMTPObject.connect(dictEmailServer["server"], dictEmailServer["port"])
            g_SMTPObject.ehlo()
            g_SMTPObject.starttls()
            print("Logging in with username '" + dictEmailServer["username"] + "' and password '" + dictEmailServer["password"] + "'...\n")
            g_SMTPObject.login(dictEmailServer["username"], dictEmailServer["password"])
            bResult = True
            break
        except Exception as error:
            g_nEmailServer += 1
            print("EMAIL SERVER ERROR: ", error)

    return bResult


def IsEmailServerOpen(SMTPObject):
    nStatus = 0
    try:
        nStatus = SMTPObject.noop()[0]
    except:
        nStatus = -1 # smtplib.SMTPServerDisconnected
    bResult = nStatus == 250
    return bResult




def SaveEmails2Delete(arrayEmails2Delete):
    if (len(arrayEmails2Delete) > 0):
        fileEmails2Delete = open(g_strPath + g_strLastEmailFile + "__", "a+")
        if fileEmails2Delete:
            for strEmail in arrayEmails2Delete:
                fileEmails2Delete.write(strEmail + "\n")
            fileEmails2Delete.close()




def UpdateEmailFile():
    arrayEmails2Delete = []
    fileEmails2Delete = open(g_strPath + g_strLastEmailFile + "__", "r+")
    fileUpdatedEmails = open(g_strPath + g_strLastEmailFile + "_", "w+")
    fileEmails = open(g_strPath + g_strLastEmailFile, "r")
    dictEmails = {}
    if (fileEmails2Delete and fileUpdatedEmails and fileEmails):
        for strEmail in fileEmails:
            dictEmails[strEmail] = strEmail
        for strEmail in fileEmails2Delete:
            if (strEmail in dictEmails):
                dictEmails.pop(strEmail, None)
        for strKey, strEmail in dictEmails.items():
            fileUpdatedEmails.write(strEmail)
        fileEmails2Delete.close()
        fileUpdatedEmails.close()
        fileEmails.close()
        fileEmails2Delete = open(g_strPath + g_strLastEmailFile + "__", "w")




def DoRemoveInvalidEmails():
    strSuccessCode = "OK"
    arrayEmails2Delete = []
    dictEmailServer = g_arrayEmailServers[g_nEmailServer]
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
                                if ("Delivery incomplete" in strMessage) or ("Message not delivered" in strMessage) or ("Address not found" in strMessage):
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

    SaveEmails2Delete(arrayEmails2Delete)
    UpdateEmailFile()






g_timeRestart = datetime.now()
g_timeRestart = g_timeRestart.replace(hour=1, minute=0)

def DoWait():
    '''
    global g_timeRestart
    timeNow = datetime.now()
    timeDiff = g_timeRestart - timeNow
    nSeconds = int(timeDiff.total_seconds())
    if (nSeconds < 0):
        timeDiff = timeNow - g_timeRestart
        nSeconds = int(timeDiff.total_seconds())
    '''
    DoRemoveInvalidEmails()
    nSeconds = 2 * 60 * 60
    wait(nSeconds)




def DoSendEmail(strToEmail):
    global g_arrayEmailServers
    global g_nEmailServer
    global g_SMTPObject
    bResult = False

    while True:
        try:
            # Create the base text message.
            msg = EmailMessage()
            msg["Subject"] = "NEW SERVICE for tradies: find-a-tradie.com.au"
            msg["From"] = MakeAddress("Find a Tradie", g_arrayEmailServers[g_nEmailServer]["username"])
            msg["Reply-To"] = MakeAddress("Find a Tradie", "find-a-tradie@outlook.com")

            msg["To"] = MakeAddress("Fellow Tradie", strToEmail)
            msg.set_content(g_strTextEmailContent)

            # Add the html version.  This converts the message into a multipart/alternative
            # container, with the original text message as the first part and the new html
            # message as the second part.
            #strCIDHomePage = make_msgid("home", "page")
            #strCIDFeedback = make_msgid("feedback", "trust")
            #strCIDCustomerFeedback = make_msgid("customer", "feedback")
            #strCIDTradieFeedback = make_msgid("tradie", "feedback")
            strCIDHomePage = "home@page"
            strCIDFeedback = "feedback@trust"
            strCIDCustomerFeedback = "customer@feedback"
            strCIDTradieFeedback = "tradie@feedback"

            msg.add_alternative(g_strHTMLEmailContent.format(strCIDHomePage=strCIDHomePage[1:-1], strCIDFeedback=strCIDFeedback[1:-1],
                    strCIDCustomerFeedback=strCIDCustomerFeedback[1:-1], strCIDTradieFeedback=strCIDTradieFeedback[1:-1]),
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

            g_SMTPObject.send_message(msg)
            bResult = True
            break;
        except Exception as error:
            bReconnect = False
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
                bReconnect = True
            elif ("OutboundSpamException" in strErrorMsg):
                print("\nEMAIL SERVER ERROR: outbound spam email blocked...\n", error)
                g_nEmailServer += 1
                bReconnect = True
            elif ("Daily user sending limit exceeded"):
                print("\nEMAIL SERVER ERROR: sending limit reached...\n", error)
                DoWait()
                bReconnect = True
            else:
                bReconnect = True
            if (bReconnect):
                if (g_nEmailServer >= len(g_arrayEmailServers)):
                    g_nEmailServer = 0
                    DoWait()
                if not DoConnectEmailServer():
                    break

    return bResult





strMsg = ""
g_arrayEmailFiles = ["ARBORISTS.email",
                        "CLEANERS.email",
                        "CONCRETERS.email",
                        "ELECTRICIANS.email",
                        "GARDENERS.email",
                        "PAINTERS.email",
                        "PET CARERS.email",
                        "PLUMBERS.email"]



g_strSavedEmailFile = "last_email.txt"
def SaveEmailPlace(strEmail, strEmailFile):
    fileLastEmail = open(g_strPath + g_strSavedEmailFile, "w")
    fileLastEmail.write(strEmailFile + "\n")
    fileLastEmail.write(strEmail + "\n")
    fileLastEmail.flush()
    fileLastEmail.close()




print("\n\n")
nEmailCount = nFileCount = 0;
bEmailSendError = False
g_strLastEmailFile = g_arrayEmailFiles[0]
strLastEmail = ""
if (os.path.isfile(g_strPath + g_strSavedEmailFile)):
    fileLastEmail = open(g_strPath + g_strSavedEmailFile, "r")
    if (fileLastEmail):
        g_strLastEmailFile = fileLastEmail.readline()
        g_strLastEmailFile = g_strLastEmailFile.replace("\n", "")
        strLastEmail = fileLastEmail.readline()
        strLastEmail = strLastEmail.replace("\n", "")
    else:
        fileLastEmail = open(g_strPath + g_strSavedEmailFile, "w")
        fileLastEmail.write("\n")
        fileLastEmail.write("\n")

    if (os.path.isfile(g_strPath + "email.html")) and (os.path.isfile(g_strPath + "email.html")):
        fileEmailContents = open(g_strPath + "email.html", "r", encoding="utf-8")
        strLine = ""
        while (True):
            strLine = fileEmailContents.readline()
            if (len(strLine) > 0):
                g_strHTMLEmailContent += strLine
            else:
                break
        fileEmailContents.close()
        fileEmailContents = open(g_strPath + "email.txt", "r", encoding="utf-8")
        strLine = ""
        while (True):
            strLine = fileEmailContents.readline()
            if (len(strLine) > 0):
                g_strTextEmailContent += strLine
            else:
                break
        fileEmailContents.close()

        if len(g_strHTMLEmailContent) > 0:
            DoConnectEmailServer()
            #DoSendEmail("cathschwag@ozemail.com.au")
            while (nFileCount < len(g_arrayEmailFiles)):
                for strEmailFile in g_arrayEmailFiles:
                    nFileCount += 1
                    if (strEmailFile != g_strLastEmailFile):
                        continue

                    nFileSize = os.path.getsize(g_strPath + strEmailFile)
                    if (nFileSize > 0):
                        fileEmail = open(g_strPath + strEmailFile, "r")
                        if (fileEmail):
                            print("Processing email file " + strEmailFile + "...")

                            if (strLastEmail != ""):
                                strEmail = "xxxx"
                                while (strEmail != strLastEmail):
                                    strEmail = fileEmail.readline()
                                    strEmail = strEmail.replace("\n", "")
                                    nEmailCount += 1
                            else:
                                strEmail = fileEmail.readline()
                                strEmail = strEmail.replace("\n", "")

                            while (strEmail != ""):
                                if (len(strEmail) > 0):
                                    print("(" + str(nEmailCount) + ") Sending email to " + strEmail + "...")
                                    SaveEmailPlace(strEmail, strEmailFile)
                                    if (not DoSendEmail(strEmail)):
                                        DoWait()
                                    else:
                                        #wait(random.randrange(3, 15, 1))
                                        wait(1)
                                strEmail = fileEmail.readline()
                                if (strEmail != ""):
                                    strEmail = strEmail.replace("\n", "")
                                    nEmailCount += 1

                            fileLastEmail.close()
                            print("\n---------------------------------\n")

            if (IsEmailServerOpen(g_SMTPObject)):
                g_SMTPObject.quit()
            print("FINISHED!")
    else:
        print("ERROR: Email content file is empty!")