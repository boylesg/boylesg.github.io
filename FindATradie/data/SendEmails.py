import random
import smtplib
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




g_arrayEmailServers = [{"server": "smtp-mail.outlook.com", "port": 587, "username": "find-a-tradie@outlook.com", "password": "Pulsar112358#"},
                       {"server": "smtp-mail.outlook.com", "port": 587, "username": "gregary_boyles@outlook.com", "password": "Pulsar112358#"}]
g_nEmailServer = 0
g_SMTPObject = ""

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
            g_SMTPObject.ehlo()
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
            msg.set_content("""\
                    Find-a-tradie.com.au is a new advertising web service form Australian small tradie businesses. It has 
                    been created by an Australian small business tradie FOR Australian tradies.\n\n
                    It is ideal for small businesses that are just starting out and don't have a large advertising budget.\n\n
                    Or for small businesses in trades that typically involve many small low value jobs such as gardening, 
                    lawn mowing, pet care and domestic cleaning.\n\n
                    Unlike HiPages, ServiceSeeking and OneFlare we do not charge you to obtain customer contact details - 
                    you can obtain them for free.\n\n
                    We only charge you a flat annual membership fee of $10 per month or $120 per year.\n\n
                    For that you can try for as many jobs as you want - there is no limit.\n\n
                    However every new tradie gets their first 6 months of membership for free, and this offer is permanent.\n\n
                    So tradie can 'try before they buy'.\n\n
                    Customers can join for FREE at all times.\n\n
                    The service uses a feedback based mutual trust system similar to eBay.\n\n
                    So tradies can ALSO check the feedback history of clients before deciding to do any jobs for them, in 
                    addition to clients being able to check the feedback history of tradies.\n\n
                    So give it a try - remember your first 6 months is free. Get started today! Register now!
                    """, "plain")

            # Add the html version.  This converts the message into a multipart/alternative
            # container, with the original text message as the first part and the new html
            # message as the second part.
            strCIDHomePage = make_msgid("home", "page")
            strCIDFeedback = make_msgid("feedback", "trust")
            strCIDCustomerFeedback = make_msgid("customer", "feedback")
            strCIDTradieFeedback = make_msgid("tradie", "feedback")

            msg.add_alternative("""\
            <!DOCTYPE html>\n
            <html>\n
                <head>\n
                    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n
                    <title>https://www.find-a-tradie.com.au</title>\n
                </head>\n
                <body>\n
                    <p><a href=\"https://www.find-a-tradie.com.au\" class=\"moz-txt-link-freetext\">https://www.find-a-tradie.com.au</a></p>\n
                    <p><img src=\"cid:{strCIDHomePage}\" alt="" width=\"455\" height=\"183\"></p>\n
                    <p>Find-a-tradie.com.au is a new advertising web service form Australian small tradie businesses. It has been created by an Australian small business tradie FOR Australian tradies.<br></p>\n
                    <p>It is ideal for small businesses that are just starting out and don't have a large advertising budget.</p>\n
                    <p>Or for small businesses in trades that typically involve many small low value jobs such as gardening, lawn mowing, pet care and domestic cleaning.<br></p>\n
                    <p>Unlike HiPages, ServiceSeeking and OneFlare we do not charge you to obtain customer contact details - you can obtain them for free.</p>\n
                    <p>We only charge you a flat annual membership fee of $10 per month or $120 per year.</p>\n
                    <p>For that you can try for as many jobs as you want - there is no limit.</p>\n
                    <p>However every new tradie gets their first 6 months of membership for free, and this offer is permanent.</p>\n
                    <p>So tradie can 'try before they buy'.<br></p>\n
                    <p>Customers can join for FREE at all times.<br></p>\n
                    <p>------------------------------------------------------------------------------------------------------------------------------------<br></p>\n
                    <p> The service uses a feedback based mutual trust system similar to eBay.&nbsp; </p>\n
                    <p><img src=\"cid:{strCIDFeedback}\" width=\"1077\" height=\"386\"></p>\n
                    <p>So tradies can ALSO check the feedback history of clients before deciding to do any jobs for them.</p>\n
                    <p><img src=\"cid:{strCIDCustomerFeedback}\" width=\"1081\" height=\"414\"></p>\n
                    <p>As well as clients being able to check the feedback history of tradies.<br>\n
                    <img src=\"cid:{strCIDTradieFeedback}\" width=\"1079\" height=\"414\"><br>\n
                    <p>So give it a try - remember your first 6 months is free. Get started today! Register now!</p><br>\n
                    <p><br></p>\n
                </body>\n
            </html>\n
            """.format(strCIDHomePage=strCIDHomePage[1:-1], strCIDFeedback=strCIDFeedback[1:-1],
                    strCIDCustomerFeedback=strCIDCustomerFeedback[1:-1], strCIDTradieFeedback=strCIDTradieFeedback[1:-1]),
                    subtype='html')
            # NOTE: we needed to peel the <> off the msgid for use in the html.

            # Now add the related image to the html part.
            with open(g_strPath + "home_page.jpg", 'rb') as img:
                msg.get_payload()[1].add_related(img.read(), 'image', 'jpeg',
                                                 cid=strCIDHomePage)
            with open(g_strPath + "feedback.jpg", 'rb') as img:
                msg.get_payload()[1].add_related(img.read(), 'image', 'jpeg',
                                                 cid=strCIDFeedback)
            with open(g_strPath + "customer_feedback.jpg", 'rb') as img:
                msg.get_payload()[1].add_related(img.read(), 'image', 'jpeg',
                                                 cid=strCIDCustomerFeedback)
            with open(g_strPath + "tradie_feedback.jpg", 'rb') as img:
                msg.get_payload()[1].add_related(img.read(), 'image', 'jpeg',
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
            elif ("OutboundSpamException" in strErrorMsg):
                print("\nEMAIL SERVER ERROR: outbound spam email blocked...\n", error)
                g_nEmailServer += 1
                bReconnect = True
            else:
                error
            if (bReconnect):
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
DoConnectEmailServer()

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
                            wait(43200)
                            break;
                        else:
                            wait(random.randrange(3, 15, 1))
                    strEmail = fileEmail.readline()
                    if (strEmail != ""):
                        strEmail = strEmail.replace("\n", "")
                        nEmailCount += 1

                fileLastEmail.close()
                print("\n---------------------------------\n")

if (IsEmailServerOpen(g_SMTPObject)):
    g_SMTPObject.quit()
print("FINISHED!")