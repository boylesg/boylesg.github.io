#!/usr/bin/env python
import sys
import lxml.html as html # pip install 'lxml>=2.3.1'
import http.client
import lxml.html as html # pip install 'lxml>=2.3.1'
from selenium import webdriver # pip install selenium
from selenium.webdriver.common.by import By
import time

# Create a new Chrome WebDriver instance
g_browserChrome = webdriver.Chrome()




def DoCheckEmailAddresses(dictEmailAddress):
    arrayValidEmailAddresses = []
    for strKey, strEmail in dictEmailAddress.items():
        nTries = 0
        while nTries < 20:
            try:
                g_browserChrome.get("https://email-checker.net/check")
                EmailEditField = g_browserChrome.find_element(By.ID, "ltrInput")
                if EmailEditField:
                    EmailEditField.send_keys(strEmail)
                    arrayButton = g_browserChrome.find_elements(By.CSS_SELECTOR, ".button-primary")
                    if arrayButton:
                        arrayButton[0].click()
                        arrayOkaySpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".green")
                        if arrayOkaySpan and arrayOkaySpan[0].is_displayed():
                            arrayValidEmailAddresses.append(strEmail)
                            print("Good email address: " + strEmail)
                            break
                        else:
                            TitleElement = g_browserChrome.find_element(By.TAG_NAME, "title")
                            if TitleElement and (TitleElement.get_attribute("innerText") == "503 Service Temporarily Unavailable"):
                                nTries += 1
                                time.sleep(3600)
                                if nTries == 19:
                                    arrayValidEmailAddresses.append(strEmail)
                                    print("Could not verify email address: " + strEmail)
                                    break
                            else:
                                arrayBadSpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".red")
                                if arrayBadSpan and arrayBadSpan[0].is_displayed():
                                    print("Bad email address: " + strEmail)
                                    break
            except Exception:
                nTries += 1
                continue
        time.sleep(720)
        '''
        Connection = http.client.HTTPSConnection("email-checker.p.rapidapi.com")

        headers = {
            'x-rapidapi-key': "a43d37af33msh10d261c773e1134p1f249ejsn7b2897c4f657",
            'x-rapidapi-host': "email-checker.p.rapidapi.com"
        }
        strEmail = strEmail.replace("\n", "")
        strEmail = strEmail.replace("@", "%40")
        Connection.request("GET", "/verify/v1?email=" + strEmail, headers=headers)
        Response = Connection.getresponse()
        strResponse = Response.read()
        strResponse = strResponse.decode("utf-8")
        print(strResponse)
        arrayValidEmailAddresses.append(strEmail)
        sleep(12)
        '''
    return arrayValidEmailAddresses




dictEmails = {}
nKeyNum = 0
strTrade = "ELECTRICIANS"
with open("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\" + strTrade + ".email", "r") as fileEmails:
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

            dictEmails[strLine] = strLine
        elif "," not in strLine:
            dictEmails["line" + str(nKeyNum)] = strLine
            nKeyNum += 1
    else:
        fileEmails.close()

    arrayEmailAddresses = []
    arrayEmailAddresses = DoCheckEmailAddresses(dictEmails)

arrayEmails = DoCheckEmailAddresses(dictEmails)
fileEmails = open("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\" + strTrade + ".email", "w")
for strEmail in arrayEmails:
    fileEmails.write(strEmail + "\n")
fileEmails.close()