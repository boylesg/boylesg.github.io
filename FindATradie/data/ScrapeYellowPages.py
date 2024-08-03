#!/usr/bin/env python
import sys
from contextlib import closing

import lxml.html as html # pip install 'lxml>=2.3.1'
from selenium import webdriver # pip install selenium
from selenium.webdriver.common.by import By
import time
import json
import http.client
#from AustraliaPost import *

# Create a new Chrome WebDriver instance
g_browserChrome = webdriver.Chrome()
#g_browserChrome.minimize_window()

def DoGetCode(strURL):
    strCode = ""
    for nNumTries in range(5):
        try:
            # Navigate to a website
            g_browserChrome.get(strURL)
            #g_browserChrome.minimize_window()

            # Get the html page source of the current page
            strCode = g_browserChrome.page_source
            if (strCode is not None):
                break;

        except Exception as e:
            if (nNumTries == 4):
                print("ERROR WITH: " + strURL + " - RE-TRYING")
                strCode = ""
                break

    return strCode




def DoGetHREFsFor(nStartPos, strFind, arrayLinkURLs):
    while True:
        nPos1 = strCode.find(strFind, nStartPos)
        if (nPos1 > -1):
            nPos1 = strCode.find("href=", nPos1) + 6
            nPos2 = strCode.find("\"", nPos1)
            strHREF = strCode[nPos1:nPos2]
            if ("about-us" not in strHREF) and ("facebook" not in strHREF):
                print("     Adding '" + strHREF + "'")
                arrayLinkURLs.append(strHREF)
                nStartPos = nPos2
            else:
                break;
        else:
            break
    return arrayLinkURLs




def DoGetBusinessLinks(strCode):
    nStartPos = strCode.find("<p>Select a business name from the list below</p>")
    arrayLinkURLs = []
    arrayLinkURLTemp = []
    #<div class='cell first-cell'><a href="/vic/rowville/a1-commercial-cleaning-15172623-listing.html">
    if (nStartPos > -1):
        arrayLinkURLTemp = DoGetHREFsFor(nStartPos, "cell first-cell last-cell", arrayLinkURLs)
        if (len(arrayLinkURLTemp) == 0):
            arrayLinkURLTemp = DoGetHREFsFor(nStartPos, "cell first-cell", arrayLinkURLs)
            arrayLinkURLs += arrayLinkURLTemp
            arrayLinkURLTemp = DoGetHREFsFor(nStartPos, "cell middle-cell", arrayLinkURLs)
            arrayLinkURLs += arrayLinkURLTemp
            arrayLinkURLTemp = DoGetHREFsFor(nStartPos, "cell last-cell", arrayLinkURLs)
            arrayLinkURLs += arrayLinkURLTemp
        else:
            arrayLinkURLs += arrayLinkURLTemp

    return arrayLinkURLs




def DoGetNumPages(strURL):
    # <div class='button-pagination-container seo-pagination body outside-gap'>
    # <span class="pagination current" >1</span>
    # <a href="/vic/gardeners-14621-category-c2" class="pagination" >2</a></div>
    strCode = DoGetCode(strURL)
    nPages = 1
    nPos = strCode.find("<span class=\"pagination current\">1</span>")
    while (nPos > -1):
        nPos = strCode.find("class=\"pagination\">", nPos)
        if (nPos > -1):
            nPos += 20
            nPages += 1

    return nPages




def DoGetAlphabeticLinks(strBaseURL):
    arrayLinkURLs = []
    strTempURL = strBaseURL
    nPages = 1
    arrayStates = ["act", "nsw", "nt", "sa", "tas", "vic", "wa"]
    for strState in arrayStates:
        strTempURL = strBaseURL.replace("xxxx", strState)
        for nCh in range(ord('a'), ord('{')):
            nPages = DoGetNumPages(strTempURL + chr(nCh) + "1")
            for nI in range(nPages):
                strLink = strTempURL + chr(nCh) + str(nI + 1)
                arrayLinkURLs.append(strLink)
                print("Adding " + strLink + "...")

    arrayLinkURLs.append(strBaseURL + "01");

    return arrayLinkURLs



def DoGetEmailAddress(strCode):
    strEmail = ""
    nPos1 = strCode.find("Send Email")

    if (nPos1 > -1):
        nPos1 += + 11
        nPos2 = strCode.find("\" class=", nPos1)
        strEmail = strCode[nPos1: nPos2]

    return strEmail



def DoGetPhoneNumber(strCode):
    strPhone = ""

    #<div class ="contact-btn">
    #   <a class ="contact-btn-link contact-btn-call" data-number="(03) 7018 0728"
    #       href="tel:0370180728" rel="nofollow" title="Phone">
    #           <span class="wobble-call">
    #               <span class ='glyph icon-contact-phone fill contact-btn-icon colored-glyph black'>
    #               </span>
    #           </span>
    #           <span class ="contact-btn-text">Call</span>
    #   </a>
    #</div>
    nPos1 = strCode.find("data-number=")
    if (nPos1 > -1):
        nPos1 += 13
        nPos2 = strCode.find("\"", nPos1)
        strPhone = strCode[nPos1 : nPos2]

    return strPhone




def DoGetWebSite(strCode):
    strWebSite = ""

    #<a href = "http://a1endofleasecleaningmelbourne.com.au"
    #    title = "http://a1endofleasecleaningmelbourne.com.au/ (opens in a new window)"
    #    class ="contact contact-main contact-url" target="_blank" rel="nofollow">
    #   <div class ='text-and-image inside-gap inside-gap-medium grow wobble'>
    #       <span class ='image top'>
    #           <div class =" glyph border-dark-blue border">
    #               <span class ='glyph icon-contact-website'>
    #                  <span class ='alt' > http://a1endofleasecleaningmelbourne.com.au/(opens in a new window)</span>
    #                </span>
    #           </div>
    #       </span>
    #        <span class ='text middle'>
    #            <div class ="desktop-display-value">Website</div>
    #        </span>
    #    </div>
    #</a>
    nPos1 = strCode.find("Website")
    if (nPos1 > -1):
        nPos1 -= 720
        nPos1 = strCode.find("href") + 6
        nPos2 = strCode.find("\"", nPos1)
        strWebSite = strWebSite[nPos1 : nPos2]

    return strWebSite




def DoGetBusinessName(strCode):
    strBusinessName = ""

    #<h2 style="float:left">A1 End of Lease Cleaning Melbourne opening hours in North Melbourne</h2>
    nPos1 = strCode.find("<h2 style=\"float:left\">")
    if (nPos1 > -1):
        nPos1 += 23
        nPos2 = strCode.find(" opening hours", nPos1)
        strBusinessName = strCode[nPos1 : nPos2]

    return strBusinessName




def DoGetLocation(strCode):
    dictLocation = {"street":"", "suburb":"", "state": "", "postcode": ""}

    #<div class="listing-address mappable-address mappable-address-with-poi"
    #data-address-line="Tuggeranong Square Shop 3 Anketel St"
    #data-address-suburb="Greenway ACT"
    nPos1 = strCode.find("listing-address mappable-address")
    nPos1 = strCode.find("data-address-line", nPos1)
    if (nPos1 > -1):
        #data-address-line="
        nPos1 += 18
        strCharFind = strCode[nPos1]
        nPos1 += 1
        nPos2 = strCode.find(strCharFind, nPos1)
        strStreet = strCode[nPos1 : nPos2]
        nPos1 = strCode.find("data-address-suburb")
        nPos1 += 20
        strCharFind = strCode[nPos1]
        nPos1 += 1
        nPos2 = strCode.find(strCharFind, nPos1)
        strSuburbState = strCode[nPos1: nPos2]
        nPos1 = len(strSuburbState) - 3
        strSuburb = strSuburbState[0 : nPos1 - 1]
        strState = strSuburbState[nPos1 :]
        dictLocation["street"] = strStreet
        dictLocation["suburb"] = strSuburb
        dictLocation["state"] = strState
        #<title>Cool &amp; Clear Windows Pty Ltd - Glazier &amp; Glass Replacement Services Factory 9
        # 146 Northbourne Rd, Campbellfield VIC 3061 | Yellow Pages&reg;</title>
        nPos1 = strCode.find("<title>")
        nPos2 = strCode.find("|", nPos1) - 1
        nPos1 = nPos2 - 4
        dictLocation["postcode"] = strCode[nPos1 : nPos2]
    return dictLocation




def DoGetGPS(strCode):
    strGPS = ""

    #<div class='listing-address mappable-address' data-address-suburb="Melton VIC"
    #   data-geo-granularity="SUBURB" data-geo-latitude="-37.6826808"
    #   data-geo-longitude="144.5804378" data-listing-id="15158462">
    #       <span class='glyph icon-pin-location'></span>
    #       Melton VIC 3337
    #</div>
    nPos1 = strCode.find("data-geo-latitude=")
    if (nPos1 > -1):
        nPos1 +=  + 19
        nPos2 = strCode.find("data-geo-longitude=") - 2
        strGPS = strCode[nPos1 : nPos2] + ", "
        nPos1 = nPos2 + 22
        nPos2 = strCode.find("data-listing-id=", nPos1) - 2
        strGPS += strCode[nPos1 : nPos2]

    return strGPS




def DoGetAllBusiness(arrayBusinessLinks, arrayAllBusinessDetails, dictEmailAddresses):
    nLength = len(arrayBusinessLinks)
    #nLength = 1
    for nI in range(0, nLength):
        print(str(nI + 1) + " of " + str(len(arrayBusinessLinks)) + " (" + arrayBusinessLinks[nI] + ")")
        strCode = DoGetCode("https://www.yellowpages.com.au" + arrayBusinessLinks[nI])
        strEmail = DoGetEmailAddress(strCode)
        if (len(strEmail) > 0):
            dictEmailAddresses[strEmail] = strEmail
        strPhone = DoGetPhoneNumber(strCode)
        strWebSite = DoGetWebSite(strCode)
        strBusinessName = DoGetBusinessName(strCode)
        dictLocation = DoGetLocation(strCode)
        strGPS = DoGetGPS(strCode)
        dictBusiness = {}
        dictBusiness["business_name"] = strBusinessName
        dictBusiness["phone"] = strPhone
        dictBusiness["website"] = strWebSite
        dictBusiness["email"] = strEmail
        dictBusiness["street"] = dictLocation["street"]
        dictBusiness["state"] = dictLocation["state"]
        dictBusiness["suburb"] = dictLocation["suburb"]
        dictBusiness["postcode"] = dictLocation["postcode"]
        dictBusiness["gps"] = strGPS
        arrayAllBusinessDetails.append(dictBusiness)




def Wait(nSeconds):
    nSecondsSoFar = 0
    nSecondsSleep = 5
    print("Sleeping for " + str(nSeconds) + "seconds...")
    while (nSecondsSoFar < nSeconds):
        nSecondsSoFar += nSecondsSleep
        print(str(nSeconds - nSecondsSoFar) + " remaining...")
        time.sleep(nSecondsSleep)




def DoCheckEmailAddresses(dictEmailAddress):
    arrayValidEmailAddresses = []
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
                        element = WebDriverWait(g_browserChrome, 10).until(EC.presence_of_element_located((By.ID, "result-box")))
                        arrayOkaySpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".green")
                        if arrayOkaySpan and arrayOkaySpan[0].is_displayed():
                            arrayValidEmailAddresses.append(strEmail)
                            print("Good email address: " + strEmail)
                            wait(1)
                            break
                        else:
                            arrayBadSpan = g_browserChrome.find_elements(By.CSS_SELECTOR, ".red")
                            strText = arrayBadSpan[0].get_attribute("innerText")
                            if arrayBadSpan and arrayBadSpan[0].is_displayed():
                                if ("exceeded" in strText) or ("Exceeded" in strText):
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
                    continue
                else:
                    break
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
    return arrayValidEmailAddresses





arrayLinksByTrade = [{"strDesc": "GARDENERS", "strURLTemplate": "https://www.yellowpages.com.au/xxxx/gardeners-14621-category-"},
                     {"strDesc": "CLEANERS", "strURLTemplate": "https://www.yellowpages.com.au/xxxx/home-cleaning-13986-category-"},
                     {"strDesc": "CONCRETERS", "strURLTemplate": "https://www.yellowpages.com.au/xxxx/concrete-contractors-34622-category-"},
                     {"strDesc": "PAINTERS", "strURLTemplate": "https://www.yellowpages.com.au/xxxx/painters-decorators-17302-category-"},
                     {"strDesc": "ARBORISTS", "strURLTemplate": "https://www.yellowpages.com.au/xxxx/tree-stump-removal-services-28061-category-"},
                     {"strDesc": "PET CARERS", "strURLTemplate": "https://www.yellowpages.com.au/xxxx/pet-care-27995-category-"},
                     {"strDesc": "GLAZIERS", "strURLTemplate": "https://www.yellowpages.com.au/xxxx/glazier-glass-replacement-services-27049-category-"},
                     {"strDesc": "ELECTRICIANS", "strURLTemplate": "https://www.yellowpages.com.au/xxxx/electricians-electrical-contractors-22683-category-"},
                     {"strDesc": "PLUMBERS", "strURLTemplate": "https://www.yellowpages.com.au//xxxx//plumbers-gas-fitters-12157-category-"}]

arrayBusinessLinks = []

for nJ in range(8, 9):
    arrayAlphabeticLinkURLs = DoGetAlphabeticLinks(arrayLinksByTrade[nJ].get("strURLTemplate"))
    strTradeDesc = arrayLinksByTrade[nJ].get("strDesc")
    if (arrayAlphabeticLinkURLs == None) or (strTradeDesc == None):
        print("ERROR at nJ == " + str(nJ))
    else:
        try:
            for nI in range(len(arrayAlphabeticLinkURLs)):
                print(str(nI) + " of " + str(len(arrayAlphabeticLinkURLs)) + " (" + arrayAlphabeticLinkURLs[nI] + ")")
                strCode = DoGetCode(arrayAlphabeticLinkURLs[nI])
                arrayBusinessLinks += DoGetBusinessLinks(strCode)
                #time.sleep(0.5)

            dictEmailAddresses = {}
            arrayAllBusinessDetails = []

            DoGetAllBusiness(arrayBusinessLinks, arrayAllBusinessDetails, dictEmailAddresses)
            jsonAllBusinessDetails = json.dumps(arrayAllBusinessDetails)

            if True:
                fileBusinessJSON = open("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\BusinessJSON.txt", "a")
                fileBusinessJSON.write("\n" + strTradeDesc + "\n")
                for nI in range(0, len(strTradeDesc)):
                    fileBusinessJSON.write("-")
                fileBusinessJSON.write("\n")
                jsonAllBusinessDetails = jsonAllBusinessDetails.replace("\\", "~")
                fileBusinessJSON.write(jsonAllBusinessDetails)
                fileBusinessJSON.write("\n\n")
                fileBusinessJSON.close()

            if True:
                strFilename = "C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\" + strTradeDesc + ".csv"
                fileBusinessCSV = open(strFilename, "w")
                fileBusinessCSV.write("BUSINESS NAME, PHONE, WEB, EMAIL, STREET, SUBURB, STATE, POSTCODE, GPS LATITUDE, GPS LONGITUDE\n")
                for nI in range(0, len(arrayAllBusinessDetails)):
                    nColCount = 0
                    dictBusiness = arrayAllBusinessDetails[nI]
                    for strKey, Value in dictBusiness.items():
                        Value = Value.replace("\\", "~")
                        fileBusinessCSV.write(Value)
                        if (nColCount < len(dictBusiness) - 1):
                            fileBusinessCSV.write(",")
                        nColCount += 1
                    fileBusinessCSV.write("\n")
                fileBusinessCSV.write("\n")
                fileBusinessCSV.close()

            if True:
                fileEmails = open("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\" + strTradeDesc + ".email", "w")
                arrayEmailAddresses = []
                arrayEmailAddresses = DoCheckEmailAddresses(dictEmailAddresses)
                for strEmail in arrayEmailAddresses:
                    fileEmails.write(strEmail + "\n")
                fileEmails.close()

        except Exception:
            pass


print("FINISHED!")

