import sys
from contextlib import closing
import lxml.html as html  # pip install 'lxml>=2.3.1'
from selenium import webdriver  # pip install selenium
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException


def DoLogin(dictFacebook, browserChrome):
    bSuccess = False
    EmailEditField = browserChrome.find_element(By.ID, "email")
    if EmailEditField:
        EmailEditField.clear()
        EmailEditField.send_keys(dictFacebook["username"])
        PasswordEditField = browserChrome.find_element(By.ID, "pass")
        if PasswordEditField:
            PasswordEditField.clear()
            PasswordEditField.send_keys(dictFacebook["password"])
            LoginButton = browserChrome.find_elements(By.ID, "loginbutton")
            if LoginButton:
                LoginButton.click()
                strCode = browserChrome.page_source
                '''
                    "ACCOUNT_ID":"100001521276779","USER_ID":"100001521276779","NAME":"Greg Boyles","SHORT_NAME"
                '''
                if ("ACCOUNT_ID" in strCode) or("USER_ID" in strCode) or ("NAME" in strCode) or ("SHORT_NAME" in strCode):
                    bSuccess = True
    return bSuccess


def DoStartFacebookPosts(dictFacebook):
    browserChrome = webdriver.Chrome()
    browserChrome.get("https://www.facebook.com/login")
    if DoLogin(dictFacebook, browserChrome):
        DoMakePosts(dictFacebook, browserChrome)
    else:
        print("Login to facebook failed with username '" + dictFacebook["username"] + "' and password '" + dictFacebook["password"] + "'!")
