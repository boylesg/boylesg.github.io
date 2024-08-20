import random
import smtplib
import datetime
import os
import os.path
from email.message import EmailMessage
from email.headerregistry import Address
from email.utils import make_msgid
from common import *



g_strPath = "C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\"




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




def DoWaitTillNewDay():
    timeNow = datetime.datetime.now()
    nNumHours = 24 - timeNow.hour
    wait((nNumHours * 60 * 60) + (30 * 60))




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
                DoWaitTillNewDay()
                bReconnect = True
            else:
                bReconnect = True
            if (bReconnect):
                if (g_nEmailServer >= len(g_arrayEmailServers)):
                    g_nEmailServer = 0
                    DoWaitTillNewDay()
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
    fileLastEmail.close()




print("\n\n")
nEmailCount = nFileCount = 0;
bEmailSendError = False
strLastEmailFile = g_arrayEmailFiles[0]
strLastEmail = ""
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
                    if (strEmailFile != strLastEmailFile):
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
                                        DoWaitTillNewDay()
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