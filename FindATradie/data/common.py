import sys
from contextlib import closing
import lxml.html as html # pip install 'lxml>=2.3.1'
from selenium import webdriver # pip install selenium
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time
import json
import http.client
import time
import io




g_strWindowsUserFolder = "gregaryb"
g_strPath = "C:/Users/" + g_strWindowsUserFolder + "/Documents/GitHub/boylesg.github.io/FindATradie/data/"
g_browserChrome = webdriver.Chrome()


def get_file_size(file):
    file.seek(0, io.SEEK_END)  # move the cursor to the end of the file
    nSize = file.tell()
    file.seek(0)
    return nSize




def wait(nSeconds):
    nSecondsSoFar = 0
    nSecondsSleep = 1
    strMsg = "Sleeping for " + str(nSeconds) + " "
    if (nSecondsSleep > 1):
        strMsg += "seconds..."
    else:
        strMsg += "second..."
    print(strMsg)

    while (nSecondsSoFar < nSeconds):
        nSecondsSoFar += nSecondsSleep
        nSecondsRemaining = nSeconds - nSecondsSoFar
        strSeconds = ""
        if nSecondsRemaining > 1:
            strSeconds = "seconds"
        else:
            strSeconds = "second"
        print(str(nSecondsRemaining) + " " + strSeconds + " remaining...")
        time.sleep(nSecondsSleep)




def DoWait(strURL, nTimeout):
    wait(nTimeout)
    g_browserChrome.get(strURL)




def DoCheckValidEmailAddresses(dictEmailAddress):
    arrayValidEmailAddresses = []
    if (g_browserChrome):
        g_browserChrome.get("https://email-checker.net/check")
        nI = 0
        for strKey, strEmail in dictEmailAddress.items():
            nTries = 0
            while nTries < 20:
                try:
                    EmailEditField = g_browserChrome.find_element(By.ID, "ltrInput")
                    if EmailEditField:
                        EmailEditField.clear()
                        EmailEditField.send_keys(strEmail)
                        arrayButton = g_browserChrome.find_elements(By.TAG_NAME, "button")
                        if arrayButton and (len(arrayButton) == 1):
                            arrayButton[0].click()
                            strCode = g_browserChrome.page_source
                            if ("503 Service Temporarily Unavailable" in strCode):
                                DoWait("https://email-checker.net/check", 5)
                            else:
                                #arrayOkaySpan = WebDriverWait(g_browserChrome, 10).until(EC.presence_of_element_located((By.ID, "result-box")))
                                arrayOkaySpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".green")
                                if arrayOkaySpan and arrayOkaySpan[0].is_displayed():
                                    arrayValidEmailAddresses.append(strEmail)
                                    nI += 1
                                    print("Good email address: " + strEmail + " , " + str(nI) + " emails processed...")
                                    wait(5)
                                    break
                                else:
                                    arrayBadSpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".red")
                                    strText = arrayBadSpan[0].get_attribute("innerText")
                                    strText = strText.upper()
                                    if arrayBadSpan and arrayBadSpan[0].is_displayed():
                                        if ("EXCEEDED" in strText) :
                                            DoWait("https://email-checker.net/check", 3600)
                                        else:
                                            nI += 1
                                            print("Bad email address: " + strEmail + " , " + str(nI) + " emails processed...")
                                            wait(5)
                                            break
                except Exception:
                    nTries += 1
                    if nTries == 19:
                        arrayValidEmailAddresses.append(strEmail)
                        print("Could not verify email address: " + strEmail)
                        break
                    else:
                        DoWait("https://email-checker.net/check", 5)
                        continue
            #time.sleep(720)
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
    else:
        print("g_browserChrome is null!")

    return arrayValidEmailAddresses


def DoCheckValidEmailAddressAlt(strEmailAddress):
    bResult = False
    if (g_browserChrome):
        try:
            g_browserChrome.get("https://www.verifyemailaddress.org/")
            EmailEditField = g_browserChrome.find_element(By.NAME, "email")
            if EmailEditField:
                EmailEditField.clear()
                EmailEditField.send_keys(strEmailAddress)
                SubmitButton = g_browserChrome.find_element(By.XPATH, '//button[text()="Verify Email"]')
                if SubmitButton:
                    SubmitButton.click()
                    strCode = g_browserChrome.page_source
                    if ("503 Service Temporarily Unavailable" in strCode):
                        DoWait("https://www.verifyemailaddress.org/", 300)
                    else:
                        Results = g_browserChrome.find_element(By.XPATH, "li[@data-text='" + strEmailAddress + " seems to be valid']")
                        if Results:
                            print("Good email address: " + strEmailAddress)
                            bResult = True
                        else:
                            Results = g_browserChrome.find_element(By.XPATH,
                                                            "li[@data-text='" + strEmailAddress + " seems not to be valid']")
                            if Results:
                                print("Bad email address: " + strEmailAddress)
                                bResult = False
                        DoWait("https://www.verifyemailaddress.org/", 5)
        except Exception:
            DoWait("https://www.verifyemailaddress.org/", 5)



def DoCheckValidEmailAddress(strEmailAddress):
    bResult = False
    if (g_browserChrome):
        g_browserChrome.get("https://email-checker.net/check")
        nTries = 0
        while nTries < 20:
            try:
                EmailEditField = g_browserChrome.find_element(By.ID, "ltrInput")
                if EmailEditField:
                    EmailEditField.clear()
                    EmailEditField.send_keys(strEmailAddress)
                    arrayButton = g_browserChrome.find_elements(By.TAG_NAME, "button")
                    if arrayButton and (len(arrayButton) == 1):
                        arrayButton[0].click()
                        strCode = g_browserChrome.page_source
                        if ("503 Service Temporarily Unavailable" in strCode):
                            DoWait("https://www.verifyemailaddress.org/", 3600)
                        else:
                            arrayOkaySpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".green")
                            if arrayOkaySpan and arrayOkaySpan[0].is_displayed():
                                print("Good email address: " + strEmailAddress)
                                bResult = True
                                break
                            else:
                                arrayBadSpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".red")
                                strText = arrayBadSpan[0].get_attribute("innerText")
                                strText = strText.upper()
                                if arrayBadSpan and arrayBadSpan[0].is_displayed():
                                    if ("EXCEEDED" in strText):
                                        DoWait("https://www.verifyemailaddress.org/", 3600)
                                    else:
                                        print("Bad email address: " + strEmailAddress)
                                        bResult = False
                                        break
                            DoWait("https://www.verifyemailaddress.org/", 5)
            except Exception:
                nTries += 1
                if nTries == 19:
                    print("Could not verify email address: " + strEmail)
                    break
                else:
                    DoWait("https://www.verifyemailaddress.org/", 5)
                    continue

    else:
        print("g_browserChrome is null!")

    return bResult
