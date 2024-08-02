import smtplib
import email
import os




def CreateEmailImage(strImageFilename, strImageID):
    fileImage = open(strImageFilename, 'rb')
    MsgImage = MIMEImage(fileImage.read())
    fileImage.close()

    # Define the image's ID as referenced above
    MsgImage.add_header("Content-ID", "<" + strImageID + ">")
    return MsgImage




def DoSendEmail(strToEmail, strEmail):
    RootEmailMsg = MIMEMultipart('related')
    RootEmailMsg["Subject"] = "NEW SERVICE for tradies: find-a-tradie.com.au"
    RootEmailMsg['From'] = "find-a-tradie@outlook.com"
    RootEmailMsg['To'] = strEmail
    RootEmailMsg.preamble = 'This is a multi-part message in MIME format.'

    EmailMsgAlternative = MIMEMultipart('alternative')
    RootEmailMsg.attach(EmailMsgAlternative)

    strText = "This is the alternative plain text message."
    TextEmailMsg = MIMEText(strText)
    EmailMsgAlternative.attach(TextEmailMsg)

    strText = "<!DOCTYPE html>\n"
    "    <html>\n"
    "        <head>\n"
    "            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n"
    "            <title>https://www.find-a-tradie.com.au</title>\n"
    "        </head>\n"
    "        <body>\n"
    "        <p><a href=\"https://www.find-a-tradie.com.au\" class=\"moz-txt-link-freetext\">https://www.find-a-tradie.com.au</a></p>\n"
    "        <p><img src=\"cid:home_page\" alt="" width=\"455\" height=\"183\"></p>\n"
    "        <p>Find-a-Tradie is a new advertising web service form Australian small tradie businesses. It has been created by an Australian small business tradie FOR Australian tradies.<br></p>\n"
    "        <p>It is ideal for small businesses that are just starting out and don't have a large advertising budget.</p>\n"
    "        <p>Or for small businesses in trades that typically involve many small low value jobs such as gardening, lawn mowing, pet care and domestic cleaning.<br></p>\n"
    "        <p>Unlike HiPages, ServiceSeeking and OneFlare we do not charge you to obtain customer contact details - you can obtain them for free.</p>\n"
    "        <p>We only charge you a flat annual membership fee of $10 per month or $120 per year.</p>\n"
    "        <p>For that you can try for as many jobs as you want - there is no limit.</p>\n"
    "        <p>However every new tradie gets their first 6 months of membership for free, and this offer is permanent.</p>\n"
    "        <p>So tradie can 'try before they buy'.<br></p>\n"
    "        <p>Customers can join for FREE at all times.<br></p>\n"
    "        <p>------------------------------------------------------------------------------------------------------------------------------------<br></p>\n"
    "        <p> The service uses a feedback based mutual trust system similar to eBay.&nbsp; </p>\n"
    "        <p><img src=\"cid:feedback\" width=\"1077\" height=\"386\"></p>\n"
    "        <p>So tradies can ALSO check the feedback history of clients before deciding to do any jobs for them.</p>\n"
    "        <p><img src=\"cid:feedback_history\" width=\"1081\" height=\"414\"></p>\n"
    "        <p>As well as clients being able to check the feedback history of tradies.<br>\n"
    "        <img src=\"cid:feedback_as\" width=\"1079\" height=\"414\"><br>\n"
    "        <p>So give it a try - remember your first 6 months is free. Get started today! Register now!</p><br>\n"
    "        <p><br></p>\n"
    "    </body>\n"
    "</html>\n"
    TextEmailMsg = MIMEText(strText)
    EmailMsgAlternative.attach(strText)


    RootEmailMsg.attach(CreateEmailImage("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\home_page.jpg", "home_page"))
    RootEmailMsg.attach(CreateEmailImage("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\feedback.jpg", "feedback"))
    RootEmailMsg.attach(CreateEmailImage("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\feedback_history.jpg", "feedback_history"))
    RootEmailMsg.attach(CreateEmailImage("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\feedback_as.jpg", "feedback_as"))

    # Send the email via our own SMTP server.
    SMTPObject = smtplib.SMTP("smtp.telstra.com")
    SMTP.login("gregplants@bigpond.com", "Pi3.14159#")
    SMTPObject.sendmail(strFromEmail, strToEmail, strEmailMsg.as_string())
    SMTPObject.quit()





strMsg = ""
arrayEmailFiles = ["ARBORISTS.email",
                   "CLEANERS.email",
                   "CONCRETERS.email",
                   "ELECTRICIANS.email",
                   "GARDENERS.email",
                   "PAINTERS.email",
                   "PET CARERS.email",
                   "CPLUMBERS.email"]

for strEmailFile in arrayEmailFiles:
    nFileSize = os.path.getsize(strEmailFile)
    if (nFileSize > 0):
        nFilePos = 0
        arrayEmailAddresses = []
        while (nFilePos < nFileSize):
            fileEmail = open("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\" + strEmailFile, "r")
            fileEmail.seek(nFilePos)
            nLine = 0
            while (True):
                strEmail = file.readLine()
                nLine += 1
                if (len(strEmail) > 0):
                    arrayEmailAddresses.append(strEmail)
                    if (nLine == 400):
                        nFilePos = file.tell()
                        break
                else:
                    break;
            file.close()

            for strEmail in arrayEmailAddresses:
                DoSendEmail(strToEmail, strEmail)
                sleep(30)

