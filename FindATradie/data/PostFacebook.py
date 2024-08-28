import sys
from contextlib import closing
import lxml.html as html  # pip install 'lxml>=2.3.1'
from selenium import webdriver  # pip install selenium
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.chrome.options import Options
from common import *


def DoLogin(strFacebookUsername, strFacebookPassword, browserChrome):
    bSuccess = False
    EmailEditField = browserChrome.find_element(By.ID, "email")
    if EmailEditField:
        EmailEditField.clear()
        EmailEditField.send_keys(strFacebookUsername)
        PasswordEditField = browserChrome.find_element(By.ID, "pass")
        if PasswordEditField:
            PasswordEditField.clear()
            PasswordEditField.send_keys(strFacebookPassword)
            arrayElements = browserChrome.find_elements(By.ID, "loginbutton")
            if len(arrayElements) > 0:
                wait(1)
                for element in arrayElements:
                    try:
                        element.click()
                    except Exception as Error:
                        continue

                strCode = browserChrome.page_source
                '''
                    "ACCOUNT_ID":"100001521276779","USER_ID":"100001521276779","NAME":"Greg Boyles","SHORT_NAME"
                '''
                if ("ACCOUNT_ID" in strCode) or("USER_ID" in strCode) or ("NAME" in strCode) or ("SHORT_NAME" in strCode):
                    bSuccess = True
    return bSuccess


def DoChangeProfile(browserChrome):
    svgYourProfile = ""
    divYourProfile = ""
    bResult = False
    try:
        divYourProfile = browserChrome.find_element(By.CSS_SELECTOR, "[aria-label='Your profile']")
        divYourProfile.click()
        wait(5)
        divSwitchFindATradie = browserChrome.find_element(By.CSS_SELECTOR, "[aria-label='Switch to Find-a-tradie']")
        divSwitchFindATradie.click()
        bResult = True
    except Exception as Error:
        pass

    return bResult


def DoPost(strPostText, strImageFilename, browserChrome):
    PostButton = browserChrome.find_element(By.XPATH, "//input[contains(@placeholder,'Write something...')]")
    if PostButton:
        PostButton.click()

        #PostField.clear()
        #PostField.send_keys(strPostText)

g_browserChrome = None

def DoGetBrowser():
    global g_browserChrome
    if g_browserChrome == None:
        options = webdriver.ChromeOptions()
        options.add_argument('--disable-notifications')
        g_browserChrome = webdriver.Chrome(options=options)
    return g_browserChrome


def DoPostFacebook(strFacebookUsername, strFacebookPassword, strPostText, strImageFilename, arrayFacebookGroups):
    browserChrome = DoGetBrowser()
    browserChrome.get("https://www.facebook.com/login")
    if DoLogin(strFacebookUsername, strFacebookPassword, browserChrome):
        wait(5)
        if DoChangeProfile(browserChrome):
            for dictFacebookGroup in arrayFacebookGroups:
                strURL = dictFacebookGroup["url"]
                browserChrome.get(strURL)
                DoPost(strPostText, strImageFilename, browserChrome)
    else:
        print("Login to facebook failed with username '" + strFacebookUsername + "' and password '" + strFacebookPassword + "'!")
        browserChrome.close()
