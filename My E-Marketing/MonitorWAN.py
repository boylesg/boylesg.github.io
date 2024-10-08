import json
import os.path
import os
import pprint
import sys
import time
import requests
from selenium import webdriver
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.common.action_chains import ActionChains

sys.path.append("C:/Users/gregaryb/Documents/GitHub/boylesg.github.io/My E-Marketing")
from common import *


g_strConfigFilename = "MonitorWAN.json"
g_dictConfig = {}
g_browserChrome


def DoGetWANIPAddress():
    Page = requests.request('GET', 'http://myip.dnsomatic.com')
    return Page.text



def DoSaveConfigFile():
    global g_dictFilenames

    with open(g_strConfigFilename, "w+") as fileConfig:
        json.dump(g_dictConfig, fileConfig)
        fileConfig.close()


def DoLoadConfigFile():
    global g_strConfigFilename
    global g_dictConfig

    if (not os.path.isfile(g_strConfigFilename)):
        g_dictConfig["wan_ip_address"] = DoGetWANIPAddress()
        DoSaveConfigFile()
    else:
        with open(g_strConfigFilename, "r") as fileConfig:
            g_dictConfig = json.load(fileConfig)
            fileConfig.close()
            pprint.pprint(g_dictConfig)
            print("\n\n")


def DoClickParent(browserChrome, ParentElement, SelectionMethod, strSelectionString, strDesc):
    bResult = False
    Element = DoGetElement(ParentElement, SelectionMethod, strSelectionString)
    if Element:
        browserChrome.execute_script("arguments[0].click();", Element)
        Wait = WebDriverWait(browserChrome, 5)
        Element = Wait.until(EC.presence_of_element_located((By.ID, "woot-widget--expanded__text")))
        bResult = True
    else:
        print("Element '" + strDesc + "' does not exist!")

    return bResult


def DoClick(browserChrome, SelectionMethod, strSelectionString, strDesc):
    bResult = False
    Element = DoGetElement(browserChrome, SelectionMethod, strSelectionString)
    if Element:
        browserChrome.execute_script("arguments[0].click();", Element)
        Wait = WebDriverWait(browserChrome, 5)
        Element = Wait.until(EC.presence_of_element_located((By.ID, "woot-widget--expanded__text")))
        bResult = True
    else:
        print("Element '" + strDesc + "' does not exist!")

    return bResult


def DoInsertTextParent(browserChrome, ParentElement, SelectionMethod, strSelectionString, strDesc, strText):
    Element = DoGetElement(ParentElement, SelectionMethod, strSelectionString)
    bResult = False
    if Element:
        browserChrome.implicitly_wait(5)
        ActionChains(browserChrome).move_to_element(Element).click(Element).perform()
        #browserChrome.execute_script("arguments[0].click();", Element)
        #Wait = WebDriverWait(browserChrome, 5)
        #Element = Wait.until(EC.presence_of_element_located((SelectionMethod, strSelectionString)))
        Element.clear()
        Element.send_keys(strText)
        bResult = True
    else:
        print("Link '" + strDesc + "' does not exist!")

    return bResult


def DoInsertText(browserChrome, SelectionMethod, strSelectionString, strDesc, strText):
    Element = DoGetElement(browserChrome, SelectionMethod, strSelectionString)
    bResult = False
    if Element:
        browserChrome.implicitly_wait(5)
        ActionChains(browserChrome).move_to_element(Element).click(Element).perform()
        #browserChrome.execute_script("arguments[0].click();", Element)
        #Wait = WebDriverWait(browserChrome, 5)
        #Element = Wait.until(EC.presence_of_element_located((SelectionMethod, strSelectionString)))
        Element.send_keys(strText)
        bResult = True
    else:
        print("Link '" + strDesc + "' does not exist!")

    return bResult


def DoUpdateWANIPAddress(browserChrome, strXPath, strDomain, strNewIPAddress):
    if DoClick(browserChrome, By.XPATH, strXPath, "Domain Link"):
        if DoClick(browserChrome, By.ID, "zonemanager-tab-link", "Zone Manager link"):
            ZoneRecordTable = DoGetElement(browserChrome, By.ID, "zone-record-list-table")
            if ZoneRecordTable:
                TBody = DoGetElement(ZoneRecordTable, By.TAG_NAME, "tbody")
                if TBody:
                    arrayTableRows = DoGetChildElements(TBody, By.TAG_NAME, "tr")
                    if arrayTableRows and (len(arrayTableRows) >= 7):
                        for nI in range(6, 7):
                            Row = arrayTableRows[nI]
                            arrayColumns = DoGetChildElements(Row, By.TAG_NAME, "td")
                            if arrayColumns and (len(arrayColumns) >= 5):
                                Column = arrayColumns[5]
                                arrayLinks = DoGetChildElements(Column, By.TAG_NAME, "a")
                                if arrayLinks and (len(arrayLinks) == 2):
                                    browserChrome.execute_script("arguments[0].click();", arrayLinks[1])
                                    formARecord = DoGetElement(browserChrome,By.ID, "a-record-form")
                                    if formARecord:
                                        DoInsertTextParent(browserChrome, formARecord, By.ID, "zone-host", "HOST", strNewIPAddress)
                                        DoClickParent(browserChrome, formARecord, By.NAME, "updateZoneRecord","EDIT RECORD")



def DoUpdateWebCentral(browserChrome, strNewIPAddress):
    browserChrome.get("https://theconsole.webcentral.au/execute/logonDispatch#zoneAnchor")
    WebDriverWait(browserChrome, 30).until(
        EC.presence_of_element_located((By.XPATH, "/html/body/div[2]/div/p")))

    if DoInsertText(browserChrome, By.ID, "login", "HOST", "FIN-1406") and DoInsertText(browserChrome, By.ID, "password", "HOST", "Pulsar112358#"):
        if DoClick(browserChrome, By.NAME, "submit", "Login"):
            DoUpdateWANIPAddress(browserChrome, "/html/body/div[2]/div[2]/div[2]/div[2]/div/div[1]/div[2]/div[2]/div[1]/div[2]/div[1]/table/tbody/tr[1]/td[4]/a", "find-a-tradie.com.au", strNewIPAddress)
            DoUpdateWANIPAddress(browserChrome, "/html/body/div[2]/div[2]/div[2]/div[2]/div/div[1]/div[2]/div[2]/div[1]/div[2]/div[1]/table/tbody/tr[2]/td[4]/a", "find-a-tradie.au", strNewIPAddress)
            DoUpdateWANIPAddress(browserChrome, "/html/body/div[2]/div[2]/div[2]/div[2]/div/div[1]/div[2]/div[2]/div[1]/div[2]/div[1]/table/tbody/tr[3]/td[4]/a", "katescastle.com.au", strNewIPAddress)
            DoUpdateWANIPAddress(browserChrome, "/html/body/div[2]/div[2]/div[2]/div[2]/div/div[1]/div[2]/div[2]/div[1]/div[2]/div[1]/table/tbody/tr[4]/td[4]/a", "gregsnativelandscapes.com.au", strNewIPAddress)



DoLoadConfigFile()
while True:
    strNewWANIPAddress = DoGetWANIPAddress()
    if strNewWANIPAddress != g_dictConfig["wan_ip_address"]:
        strSubject = "New WAN IP address detected..."
        print(strSubject)
        strContent = "New IP Address: " + strNewWANIPAddress + "\nOLD IP Address: " + g_dictConfig["wan_ip_address"] + "\nUpdating IP address at Web Central domains..."
        print(strContent)
        g_dictConfig["wan_ip_address"] = strNewWANIPAddress
        DoSaveConfigFile()
        g_browserChrome = DoGetBrowser()
        DoUpdateWebCentral(g_browserChrome, strNewWANIPAddress)
        SMTPObject = DoConnectEmailServer(strEmailServerURL, strEmailServerPort, strUsername, strPassword)
        if SMTPObject is not None:
            DoSendAnEmail("gregplants@bigpond.com", "gregplants@bigpond.com", SMTPObject, strSubject, strContent, strContent)
    else:
        print("No change to WAN IP Address detected...")

    print("Going to sleep for 4 hours...")
    print("-------------------------------\n")
    time.sleep(60 * 60 * 4)
