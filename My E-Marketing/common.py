import sys
from contextlib import closing
import lxml.html as html  # pip install 'lxml>=2.3.1'
from selenium import webdriver  # pip install selenium
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time
import json
import http.client
import time
import io
from threading import Thread

g_strWindowsUserFolder = "gregaryb"
g_strPath = "C:/Users/" + g_strWindowsUserFolder + "/Documents/GitHub/boylesg.github.io/FindATradie/data/"
g_browserChrome = None


def DoGetElement(browserChrome, Selector, strSelectorString, nTimeoutSeconds=5):
    Element = None
    nWaitSeconds = 10
    try:
        Wait = WebDriverWait(browserChrome, nWaitSeconds)
        Element = Wait.until(EC.presence_of_element_located((Selector, strSelectorString)))
        Wait = WebDriverWait(browserChrome, nWaitSeconds)
        Element = Wait.until(EC.element_to_be_clickable((Selector, strSelectorString)))
        #Element. browserChrome.find_element(Selector, strSelectorString)
    except Exception as Error:
        #print(Error)
        pass
    return Element


def get_file_size(file):
    file.seek(0, io.SEEK_END)  # move the cursor to the end of the file
    nSize = file.tell()
    file.seek(0)
    return nSize


def wait(nSeconds):
    nSecondsSoFar = 0

    if nSeconds < 0.001:
        nSecondsSleep = 0.0001
    elif nSeconds < 0.01:
        nSecondsSleep = 0.001
    elif nSeconds < 0.1:
        nSecondsSleep = 0.01
    elif nSeconds < 1:
        nSecondsSleep = 0.1
    else:
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


def DoCheckValidEmailAddressAlt(strEmailAddress):
    bResult = False
    global g_browserChrome

    if g_browserChrome == None:
        g_browserChrome = webdriver.Chrome()
        g_browserChrome.maximize_window()

    while True:
        try:
            EmailEditField = g_browserChrome.find_element(By.NAME, "email")
            if EmailEditField:
                EmailEditField.clear()
                EmailEditField.send_keys(strEmailAddress)
                SubmitButton = g_browserChrome.find_element(By.XPATH, '//button[text()="Verify Email"]')
                if SubmitButton:
                    SubmitButton.click()
                    strCode = g_browserChrome.page_source
                    if ("503 Service Temporarily Unavailable" in strCode):
                        DoWait("https://www.verifyemailaddress.org/",
                               int(input_timeout("Number of seconds to wait: ").strip() or "3600"))
                    elif "seems to be valid" in strCode:
                        print("Good email address: " + strEmailAddress)
                        bResult = True
                        break;
                    elif ("seems not to be valid" in strCode) or ("failed" in strCode):
                        print("Bad email address: " + strEmailAddress)
                        bResult = False
                        break
                    else:
                        print("ERROR")
                        wait(300)
        except Exception:
            g_browserChrome.get("https://www.verifyemailaddress.org/")
            continue
        wait(random.randrange(3, 15, 1))
    return bResult


def DoCheckValidEmailAddress(strEmailAddress):
    bResult = False
    strURL = "https://email-checker.net/check"
    strPrompt = "Number seconds to wait: "
    global g_browserChrome

    if (not g_browserChrome):
        g_browserChrome = webdriver.Chrome()
        g_browserChrome.maximize_window()

    if (g_browserChrome.current_url != strURL):
        g_browserChrome.get(strURL)
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
                        DoWait(strURL, 10)
                    else:
                        arrayOkaySpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".green")
                        if arrayOkaySpan and arrayOkaySpan[0].is_displayed():
                            print("Good email address: " + strEmailAddress)
                            bResult = True
                            wait(5)
                            break
                        else:
                            arrayBadSpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".red")
                            if arrayBadSpan and arrayBadSpan[0].is_displayed():
                                strText = arrayBadSpan[0].get_attribute("innerText")
                                strText = strText.upper()
                                if ("EXCEEDED" in strText):
                                    wait(3600)
                                    print("Waking up...")
                                else:
                                    print("Bad email address: " + strEmailAddress)
                                    bResult = False
                                    wait(5)
                                    break
                        # DoWait(strURL, 10)
        except Exception:
            nTries += 1
            if nTries == 19:
                print("Could not verify email address: " + strEmail)
                break
            else:
                DoWait(strURL, 10)
                continue

    return bResult


def DoCheckValidEmailAddresses(dictEmailAddress):
    arrayValidEmailAddresses = []
    global g_browserChrome

    if (not g_browserChrome):
        g_browserChrome = webdriver.Chrome()
        g_browserChrome.maximize_window()

    g_browserChrome.get("https://email-checker.net/check")
    nI = 0
    for strKey, strEmail in dictEmailAddress.items():
        if (DoCheckValidEmailAddress(strEmail)):
            arrayValidEmailAddresses.append(strEmail)

    return arrayValidEmailAddresses


def DoPingEmailAddress(strEmailAddress):
    bValid = False
    nPos = strEmailAddress.find("@")
    strServer = strEmailAddress[nPos + 1:]

    try:
        # Get the MX record for the domain
        records = dns.resolver.query(domain_name, 'MX')
        mxRecord = records[0].exchange
        mxRecord = str(mxRecord)

        # Step 3: ping email server
        # check if the email address exists

        # Get local server hostname
        host = socket.gethostname()

        # SMTP lib setup (use debug level for full output)
        server = smtplib.SMTP()
        server.set_debuglevel(0)

        # SMTP Conversation
        server.connect(mxRecord)
        server.helo(host)
        server.mail(strEmailAddress)
        nCode, strMessage = server.rcpt(strEmailAddress)
        server.quit()

        # Assume 250 as Success
        if nCode == 250:
            print("Good email address: ")
            bValid = True
        else:
            print("Bad email address: ")
        print(strEmailAddress)
    except Exception as e:
        print(e)

    return bValid


def DoPromptWhat2Do():
    strResponse = ""
    while (strResponse != "D") and (strResponse != "d") and (strResponse != "R") and (strResponse != "r") and (strResponse != "I") and (strResponse != "i"):
        strResponse = input("Retry, ignore or delete group (R/r/I/i/D/d)?: ")
        if (strResponse != "D") and (strResponse != "d") and (strResponse != "R") and (strResponse != "r") and (strResponse != "I") and (strResponse != "i"):
            print("Invalid response...")

    if strResponse == "d":
        strResponse = "D"
    elif strResponse == "r":
        strResponse = "R"
    elif strResponse == "i":
        strResponse = "I"

    return strResponse


def Popup2xText(SG, strTitle, strLabel1, strValue1, bFileBrowseButton1, tuppleFileTypes1, strLabel2, strValue2, bFileBrowseButton2, tuppleFileTypes2):
    try:
        layoutBrowseButton1 = []
        layoutBrowseButton2 = []

        if bFileBrowseButton1:
            layoutBrowseButton1 = SG.FileBrowse(key="FileBrowse1", file_types = tuppleFileTypes1)

        if bFileBrowseButton2:
            layoutBrowseButton2 = SG.FileBrowse(key="FileBrowse2", file_types = tuppleFileTypes2)

        popup = SG.Window(strTitle,
                          [[SG.Text(strLabel1)],
                           [SG.InputText(strValue1, key="text_1"), layoutBrowseButton1],
                           [SG.Text(strLabel2)],
                           [SG.InputText(strValue2, key="text_2"), layoutBrowseButton2],
                           [SG.OK(), SG.Cancel()]],
                          )
    except Exception as Error:
        pass

    while True:
        strEvent, dictValues = popup.read(500)

        if (strEvent == "OK") or (strEvent == "Cancel") or (strEvent is None):
            break

    popup.close()
    return {"OK": strEvent == "OK", "Text1": popup["text_1"].get(), "Text2": popup["text_2"].get()}
