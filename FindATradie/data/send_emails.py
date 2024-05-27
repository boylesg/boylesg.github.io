import smtplib
import email




def DoSendEmail(strToEmail, arrayEmailList, strMsg):
    strFromEmail = "find-a-tradie@outlook.com"
    msg = MIMEText(html, "html")
    msg["Subject"] = "NEW SERVICE for tradies: find-a-tradie.com.au"
    msg["From"] = strFromEmail
    msg["To"] = strEmail
    msg["Bcc"] = join(arrayEmailList)
    msg.preamble = "find-a-tradie"
    msg.set_content(strMsg);

    # Send the email via our own SMTP server.
    SMTPObject = smtplib.SMTP("smtp.telstra.com")
    SMTP.login("gregplants@bigpond.com", "Pi3.14159#")
    SMTPObject.sendmail(strFromEmail, strToEmail, msg.as_string())
    SMTPObject.quit()





strMsg = ""
file = open("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\email_addresses.txt", "r")
if (file):
    strToEmail = file.readLine()
    arrayEmailList = []
    while (True):
        strEmail = file.readLine()
        if (len(strEmail) == 0):
            DoSendEmail(strToEmail, arrayEmailList, strMsg)
            break
        elif (len(arrayEmailList) == 50):
            DoSendEmail(strToEmail, arrayEmailList, strMsg)
            arrayEmailListarrayEmailList = []
            strToEmail = file.readLine()
        else:
            arrayEmailList.append(strEmail)
