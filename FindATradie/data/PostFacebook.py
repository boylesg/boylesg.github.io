import sys
from contextlib import closing
import lxml.html as html  # pip install 'lxml>=2.3.1'
from selenium import webdriver  # pip install selenium
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.action_chains import ActionChains
from common import *


def DoLogin(strFacebookUsername, strFacebookPassword, browserChrome):
    bSuccess = False
    EmailEditField = DoGetElement(browserChrome, By.ID, "email")
    if EmailEditField:
        EmailEditField.clear()
        EmailEditField.send_keys(strFacebookUsername)
        PasswordEditField = DoGetElement(browserChrome, By.ID, "pass")
        if PasswordEditField:
            PasswordEditField.clear()
            PasswordEditField.send_keys(strFacebookPassword)
            LoginButton = DoGetElement(browserChrome, By.ID, "loginbutton")
            if LoginButton:
                wait(1)
                try:
                    LoginButton.click()
                except Exception as Error:
                    pass
                divOK = DoGetElement(browserChrome, By.CSS_SELECTOR, "[aria-label='OK']")
                if divOK != None:
                    divOK.click()
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
        divYourProfile = DoGetElement(browserChrome, By.CSS_SELECTOR, "[aria-label='Your profile']")
        divYourProfile.click()
        divSwitchFindATradie = DoGetElement(browserChrome, By.CSS_SELECTOR, "[aria-label='Switch to Find-a-tradie']")
        divSwitchFindATradie.click()
        bResult = True
    except Exception as Error:
        pass

    return bResult

def DoUploadImage(strImageFilename, browserChrome, bFindATradieHomePage):
    strImageUploadButton =          "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[3]/div[1]/div[2]/div/div[1]/div/span/div"
    strImageDragDropButton =        "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[2]/div[1]/div[2]/div/div[1]/div/div[1]/div"
    if not bFindATradieHomePage:
        strImageUploadButton =      ""
        strImageDragDropButton =    ""

    ImageUploadButton = DoGetElement(browserChrome, By.XPATH, strImageUploadButton)
    if ImageUploadButton is not None:
        ImageDragDropButton = None
        while ImageDragDropButton is None:
            ImageUploadButton.click()
            ImageDragDropButton = DoGetElement(browserChrome, By.XPATH, strImageDragDropButton)
        if ImageDragDropButton is not None:
            # ImageDragDropButton.click()
            strImageFilename = strImageFilename.replace("/", "\\")
            ImageDragDropButton.send_keys(strImageFilename)


def DoPost(strPostText, strImageFilename, strGroupName, strGroupURL, browserChrome, bFindATradieHomePage):
    bSuccess = False
    strStartPostButtonXPATH =       "/html/body/div[1]/div/div/div[1]/div/div[3]/div/div/div[1]/div[1]/div/div[2]/div/div/div/div[2]/div/div[2]/div/div/div/div[1]/div"
    strTextFieldXPATH =             "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[2]/div[1]/div[1]/div[1]/div/div/div[1]"
    strPostButtonXPATH =            "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[3]/div[4]/div/div"
    if not bFindATradieHomePage:
        strStartPostButtonXPATH =   "/html/body/div[1]/div/div/div[1]/div/div[3]/div/div/div[1]/div[1]/div[4]/div/div[2]/div/div/div[1]/div[1]/div/div/div/div[1]/div"
        strTextFieldXPATH =         "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/div/div[1]/form/div/div[1]/div/div/div[1]/div/div[2]/div[1]/div[1]/div[1]/div[1]/div/div/div/div/div[2]/div"
        strPostButtonXPATH =        "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/div/div[1]/form/div/div[1]/div/div/div[1]/div/div[3]/div[3]/div/div"

    if strGroupURL == "":
        strGroupURL = "https://www.facebook.com/FindATradiePage"

    try:
        StartPostButton = DoGetElement(browserChrome, By.XPATH, strStartPostButtonXPATH)
        if StartPostButton:
            TextField = None
            PostButton = None
            while TextField is None:
                StartPostButton.click()
                TextField = DoGetElement(browserChrome, By.XPATH, strTextFieldXPATH)
                PostButton = DoGetElement(browserChrome, By.XPATH, strPostButtonXPATH)

            if (TextField is not None):
                TextField.send_keys(strPostText)
                #DoUploadImage(strImageFilename, browserChrome, bFindATradieHomePage)
                if PostButton is not None:
                    PostButton.click()
                    bSuccess = True
                else:
                    print("Post button not found...")

                print("Post succeeded!")
            else:
                print("Text field not found...")
        else:
            print("Can't post to this group...")
    except Exception as Error:
        print("Post failed!")
        print(Error)
        pass
    print("==================================================")
    return bSuccess

def DoGetBrowser():
    global g_browserChrome

    if g_browserChrome == None:
        options = webdriver.ChromeOptions()
        options.add_argument('--disable-notifications')
        g_browserChrome = webdriver.Chrome(options=options)
    return g_browserChrome


def DoFacebookInit(strFacebookUsername, strFacebookPassword):
    bResult = False
    browserChrome = DoGetBrowser()
    browserChrome.get("https://www.facebook.com/login")
    if DoLogin(strFacebookUsername, strFacebookPassword, browserChrome):
        if DoChangeProfile(browserChrome):
            bResult = True
            wait(10)
        else:
            print("Could not change profile to Find-a-tradie!")
    else:
        print("Login to facebook failed with username '" + strFacebookUsername + "' and password '" + strFacebookPassword + "'!")
        browserChrome.close()

    return bResult


def DoPostFacebook(strPostText, strImageFilename, strGroupName, strGroupURL, bFindATradieHomePage):
    bSuccess = True

    if strGroupURL != "":
        try:
            g_browserChrome.get(strGroupURL)
            if (g_browserChrome.page_source.find("<title>Facebook</title>") > -1):
                print("URL '" + strGroupURL + " cannot be reached at this time!")
                bSuccess = False
            else:
                bSuccess = DoPost(strPostText, strImageFilename, strGroupName, strGroupURL, g_browserChrome, bFindATradieHomePage)
        except Exception as Error:
            print("Invalid URL: " + strGroupURL + "!")
            bSuccess = false

    return bSuccess