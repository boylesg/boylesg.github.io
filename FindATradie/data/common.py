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




g_strWindowsUserFolder = "gregaryb"
g_browserChrome = webdriver.Chrome()




def wait(nSeconds):
    nSecondsSoFar = 0
    nSecondsSleep = 5
    strMsg = "Sleeping for " + str(nSeconds) + " "
    if (nSecondsSleep > 1):
        strMsg += "second..."
    else:
        strMsg += "seconds..."

    while (nSecondsSoFar < nSeconds):
        nSecondsSoFar += nSecondsSleep
        nSecondsRemaining = nSeconds - nSecondsSoFar
        strSeconds = ""
        if nSecondsRemaining > 1:
            strSeconds = "seconds"
        else:
            strSeconds = "second"
        print(str(nSecondsRemaining) + strSeconds + " remaining...")
        time.sleep(nSecondsSleep)




def DoCheckEmailAddresses(dictEmailAddress):
    arrayValidEmailAddresses = []
    if (g_browserChrome):
        g_browserChrome.get("https://email-checker.net/check")

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
                            arrayOkaySpan = WebDriverWait(g_browserChrome, 10).until(EC.presence_of_element_located((By.ID, "result-box")))
                            arrayOkaySpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".green")
                            if arrayOkaySpan and arrayOkaySpan[0].is_displayed():
                                arrayValidEmailAddresses.append(strEmail)
                                print("Good email address: " + strEmail)
                                wait(1)
                                break
                            else:
                                arrayBadSpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".red")
                                strText = arrayBadSpan[0].get_attribute("innerText")
                                strText = strText.upper()
                                if arrayBadSpan and arrayBadSpan[0].is_displayed():
                                    if ("EXCEEDED" in strText) :
                                        wait(3600)
                                    else:
                                        print("Bad email address: " + strEmail)
                                        wait(1)
                                        break
                except Exception:
                    g_browserChrome.get("https://email-checker.net/check")
                    nTries += 1
                    if nTries == 19:
                        arrayValidEmailAddresses.append(strEmail)
                        print("Could not verify email address: " + strEmail)
                        break
                    else:
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
