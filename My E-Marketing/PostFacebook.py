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


def DoChangeProfile(browserChrome, strProfile):
    svgYourProfile = ""
    divYourProfile = ""
    bResult = False
    try:
        '''
        <div aria-label="Switch to Greg's Native Landscapes" 
            class="x1i10hfl x1qjc9v5 xjbqb8w xjqpnuy xa49m3k xqeqjp1 x2hbi6w x13fuv20 xu3j5b3 x1q0q8m5 x26u7qi x972fbf 
            xcfux6l x1qhh985 xm0m39n x9f619 x1ypdohk xdl72j9 x2lah0s xe8uvvx xdj266r x11i5rnm xat24cr x1mh8g0r x2lwn1j 
            xeuugli xexx8yu x4uap5 x18d9i69 xkhd6sd x1n2onr6 x16tdsg8 x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1o1ewxj 
            x3x9cwd x1e5q0jg x13rtm0m x1q0g3np x87ps6o x1lku1pv x1a2a7pz x1lliihq" role="button" tabindex="0">
        '''
        divYourProfile = DoGetElement(browserChrome, By.CSS_SELECTOR, "[aria-label=\"Your profile\"]")
        divYourProfile.click()
        divSwitchFindATradie = DoGetElement(browserChrome, By.CSS_SELECTOR, "[aria-label=\"" + strProfile + "\"]")
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


def DoFindElement(browserChrome, Selector, arraySelectorStrings):
    Element = None
    nI = 0

    while (nI < len(arraySelectorStrings)):
        Element = DoGetElement(browserChrome, Selector, arraySelectorStrings[nI])
        if Element is not None:
            break
        nI += 1

    return Element

def DoPost(strPostText, strImageFilename, strGroupName, strGroupURL, browserChrome, bFindATradieHomePage):
    bSuccess = False
    arrayStartPostButtonXPaths = ["/html/body/div[1]/div/div/div[1]/div/div[3]/div/div/div[1]/div[1]/div/div[2]/div/div/div/div[2]/div/div[2]/div/div/div/div[1]/div",
                             "/html/body/div[1]/div/div[1]/div[1]/div/div[3]/div/div/div[1]/div[1]/div/div[2]/div/div/div/div[2]/div/div[2]/div/div/div/div[1]/div",
                             "/html/body/div[1]/div/div/div[1]/div/div[3]/div/div/div[1]/div[1]/div[4]/div/div[2]/div/div/div[1]/div[1]/div/div/div/div[1]/div",
                             "/html/body/div[1]/div/div/div[1]/div/div[3]/div/div/div[1]/div[1]/div[4]/div/div/div[2]/div/div/div[1]/div[1]/div/div/div/div[1]/div",
                             "/html/body/div[1]/div/div/div[1]/div/div[3]/div/div/div[1]/div[1]/div[4]/div/div[2]/div/div/div[1]/div[1]/div/div/div/div[1]/div",
                             "/html/body/div[1]/div/div/div[1]/div/div[3]/div/div/div[1]/div[1]/div[4]/div/div/div[2]/div/div/div[1]/div[1]/div/div/div/div[1]/div",
                             "",
                             "",
                             "",
                             "",
                             ""]
    arrayTextFieldXPaths = ["/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[2]/div[1]/div[1]/div[1]/div/div/div[1]",
                            "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/div/div[1]/form/div/div[1]/div/div/div[1]/div/div[2]/div[1]/div[1]/div[1]/div[1]/div/div/div/div/div[2]/div",
                            "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/div/div[1]/form/div/div[1]/div/div/div[1]/div/div[2]/div[1]/div[1]/div[1]/div[1]/div/div/div/div/div/div",
                            "//html/body/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/div/div[1]/form/div/div[1]/div/div/div[1]/div/div[2]/div[1]/div[1]/div[1]/div[1]/div/div/div/div/div/div",
                            "",
                            "",
                            ""]
    arrayPostButtonXPaths = ["/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[3]/div[4]/div/div",
                            "/html/body/div[1]/div/div/div[1]/div/div[4]/div/div/div[1]/div/div[2]/div/div/div/div/div[1]/form/div/div[1]/div/div/div[1]/div/div[3]/div[3]/div/div",
                            "",
                            "",
                            "",
                            ""]

    try:
        StartPostButton = DoFindElement(browserChrome, By.XPATH, arrayStartPostButtonXPaths)

        if StartPostButton:
            TextField = None
            PostButton = None
            while TextField is None:
                browserChrome.execute_script("arguments[0].click();", StartPostButton)
                #StartPostButton.click()
                TextField = DoFindElement(browserChrome, By.XPATH, arrayTextFieldXPaths)
                PostButton = DoFindElement(browserChrome, By.XPATH, arrayPostButtonXPaths)

            if (TextField is not None):
                TextField.clear()
                TextField.send_keys(strPostText)
                #DoUploadImage(strImageFilename, browserChrome, bFindATradieHomePage)
                if PostButton is not None:
                    browserChrome.execute_script("arguments[0].scrollIntoView();", PostButton)
                    browserChrome.execute_script("arguments[0].click();", PostButton)
                    #PostButton.click()
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


def DoFacebookInit(strFacebookUsername, strFacebookPassword, strProfile):
    bResult = False
    browserChrome = DoGetBrowser()
    browserChrome.get("https://www.facebook.com/login")
    if DoLogin(strFacebookUsername, strFacebookPassword, browserChrome):
        if DoChangeProfile(browserChrome, strProfile):
            bResult = True
            wait(10)
        else:
            print("Could not change profile to '" + strProfile + "'!")
    else:
        print("Login to facebook failed with username '" + strFacebookUsername + "' and password '" + strFacebookPassword + "'!")
        browserChrome.close()

    return bResult


def DoPostFacebook(strPostText, strImageFilename, strGroupName, strGroupURL, bHomePage):
    bSuccess = True

    if strGroupURL != "":
        try:
            #g_browserChrome.get(strGroupURL)
            WebDriverWait(g_browserChrome, 30).until(EC.presence_of_element_located((By.ID, "has-finished-comet-page")))
            if (g_browserChrome.page_source.find("<title>Facebook</title>") > -1):
                print("URL '" + strGroupURL + " cannot be reached at this time!")
                bSuccess = False
            else:
                bSuccess = DoPost(strPostText, strImageFilename, strGroupName, strGroupURL, g_browserChrome, bHomePage)
        except Exception as Error:
            print("Invalid URL: " + strGroupURL + "!")
            bSuccess = false

    return bSuccess


def DoGetFileContentsTxt(strFilename):
    strContents = ""
    with open(strFilename, "r") as file:
        arrayLines = file.readlines()
    strContents = format("\n".join(arrayLines[0:]))
    return strContents


def DoSaveConfigFile(dictConfig, strConfigFilename):

    with open(strConfigFilename, "w+") as fileConfig:
        json.dump(dictConfig, fileConfig)
        fileConfig.close()

def DoStartFacebookPosts(strConfigFilename, dictConfig, strFacebookBusinessName, strFacebookBusinessURL,
                         nPostDelay, strDelayPostDelayType, nPostRepeat, arraySelectedPosts, strKeyConfigGroups,
                         strKeyConfigPosts, strKeyConfigSelectedPosts, strKeyLastPost, strKeyLastGroup):
    nLastGroup = 0
    nLastPost = -1

    if dictConfig["facebook"][strKeyLastGroup] is None:
        dictConfig["facebook"][strKeyLastGroup] = -1

    if dictConfig["facebook"][strKeyLastPost] is None:
        dictConfig["facebook"][strKeyLastPost] = 0

    if "hour" in strDelayPostDelayType:
        nPostDelay *= 60
    elif "day" in strDelayPostDelayType:
        nPostDelay *= 60 * 24

    if len(arraySelectedPosts) > 0:
        nLastPost = arraySelectedPosts[0]
    else:
        nLastPost = dictConfig["facebook"][strKeyLastPost]

    if DoFacebookInit(dictConfig["facebook"]["facebook_username"], dictConfig["facebook"]["facebook_password"], strFacebookBusinessName):
        for nI in range(0, nPostRepeat):
            for nJ in range(0, len(dictConfig["facebook"][strKeyConfigPosts])):
                dictPost = dictConfig["facebook"][strKeyConfigPosts][nJ]

                if nJ <= nLastPost:
                    continue
                else:
                    strPostContents = DoGetFileContentsTxt(dictPost["post_filename"])
                    print("Post Contents\n--------------")
                    strPostContents = strPostContents.replace("\n\n", "\n")
                    print(strPostContents + "\n\n")

                    if dictConfig["facebook"][strKeyLastGroup] == -1:
                        DoPostFacebook(strPostContents, dictPost["image_filename"], strFacebookBusinessName,
                                       strFacebookBusinessURL, True)

                    arrayDeletedGroups = []
                    nK = 0
                    nLastGroup = dictConfig["facebook"][strKeyLastGroup]
                    while nK < len(dictConfig["facebook"][strKeyConfigGroups]):
                        if nK <= nLastGroup:
                            nK += 1
                        else:
                            dictGroup = dictConfig["facebook"][strKeyConfigGroups][nK]
                            print("Posting to Group " + str(nK + 1) + " of " + str(
                                len(dictConfig["facebook"][strKeyConfigGroups])) + ": " + dictGroup[
                                      "name"] + " (" +
                                  dictGroup["url"] + ")")
                            if not DoPostFacebook(strPostContents, dictPost["image_filename"], dictGroup["name"],
                                                  dictGroup["url"], False):
                                strResponse = DoPromptWhat2Do()
                                if strResponse == "D":
                                    arrayDeletedGroups.append(nK)
                                    nK += 1
                                elif strResponse == "R":
                                    nK = nK
                            else:
                                dictConfig["facebook"][strKeyLastGroup] = nK
                                DoSaveConfigFile(dictConfig, strConfigFilename)
                                nK += 1

                    if (len(arrayDeletedGroups) > 0):
                        for nK in range(0, len(arrayDeletedGroups)):
                            dictConfig["facebook"][strKeyConfigGroups].pop(arrayDeletedGroups[nK])
                        DoSaveConfigFile(dictConfig, strConfigFilename)

                    dictConfig["facebook"][strKeyLastGroup] = -1
                    dictConfig["facebook"][strKeyLastPost] = nJ
                    DoSaveConfigFile(dictConfig, strConfigFilename)
                    wait(nMillisDelay)

            dictConfig["facebook"][strKeyLastPost] = -1
            DoSaveConfigFile(dictConfig, strConfigFilename)
    else:
        print("DoFacebookInit() failed!")
