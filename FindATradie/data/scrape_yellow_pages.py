#!/usr/bin/env python
import sys
from contextlib import closing

import lxml.html as html # pip install 'lxml>=2.3.1'
from selenium.webdriver     import Firefox         # pip install selenium
from werkzeug.contrib.cache import FileSystemCache # pip install werkzeug
import time
import json

cache = FileSystemCache('.cachedir', threshold=100000)


def DoGetCode(strURL):
    # https://www.yellowpages.com.au/vic/home-cleaning-13986-category-b1
    strCode = cache.get(strURL)
    if strCode is None:
        # use firefox to get page with javascript generated content
        try:
            fireFoxOptions = webdriver.FirefoxOptions()
            fireFoxOptions.set_headless()
            with closing(Firefox(firefox_options=fireFoxOptions)) as browser:
                browser.get(strURL)
                strCode = browser.page_source
                if strCode is None:
                    strCode = ""
            cache.set(strURL, strCode, timeout=60*60*24*7) # week in seconds

        except Exception as e:
            print("ERROR WITH: " + strURL)
            strCode = "EXCEPTION"

    return strCode




def DoGetBusinessLinks(strCode, nCharPosMin, nCharPosMax):
    strFind = "cell first-cell"
    nPos1 = nCharPosMin
    nPos2 = nCharPosMax
    arrayLinkURLs = []
    #<div class='cell first-cell'><a href="/vic/rowville/a1-commercial-cleaning-15172623-listing.html">
    while (True):
        if ("Browse by business name" in strCode):
            nPos1 = strCode.find(strFind, nPos1)
            if (nPos1 == -1):
                if ("first-cell" in strFind):
                    strFind = "cell middle-cell"
                    nPos1 = nCharPosMin
                    nPos2 = nCharPosMax
                    nPos1 = strCode.find(strFind, nPos1)
                elif ("middle-cell" in strFind):
                    strFind = "cell last-cell"
                    nPos1 = nCharPosMin
                    nPos2 = nCharPosMax
                    nPos1 = strCode.find(strFind, nPos1)
                else:
                    break;

            if (nPos1 > nCharPosMax):
                break;
            elif (nPos1 != -1):
                nPos1 = strCode.find("href=", nPos1) + 6
                nPos2 = strCode.find("\"", nPos1)
                strHREF = strCode[nPos1:nPos2]
                if ("about-us" not in strHREF) and ("facebook" not in strHREF):
                    arrayLinkURLs.append(strHREF)
                else:
                    break
                nPos1 = nPos2
        else:
            break

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
        for nCh in range(ord('a'), ord('z')):
            nPages = DoGetNumPages(strTempURL + chr(nCh) + "1")
            for nI in range(nPages):
                strLink = strTempURL + chr(nCh) + str(nI + 1)
                arrayLinkURLs.append(strLink)

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
    strLocation = ""

    #<div id="business-profile-page"
    #   class="listing listing-data" itemscope itemtype="http://schema.org/LocalBusiness"
    #   data-listing-id="14925104" data-listing-name="hazel-cleaning" data-content-group-id="7a672937-41c1-4e82-a707-03e0b8f069e9" data-advertiser-id="959212661" data-product-version="4" data-product-id="491358624" data-product-code="YPD00" data-business-id="959212661" data-business-name="Hazel_Cleaning" data-full-name="Hazel Cleaning" data-result-type="B" data-heading-code="13986" data-heading-name="Home Cleaning" data-suburb="suppressed" data-state="suppressed" data-intent="unknown" data-context="unknown" data-about-id="38cd2ae7-1baf-444c-8bfa-99d4f96558fe" data-total-reviews="0" data-omniture-average-rating="0.0" data-url="/sup/hazel-cleaning-14925104-listing.html" data-is-free="true" data-is-top-of-list="false" data-content-score="4" data-score="0.0"
    #   data-preview-mode="null"
    #   data-raw-business-name="Hazel Cleaning"
    #   data-listing-url="/sup/hazel-cleaning-14925104-listing.html"
    #   data-is-free="true" >
    nPos1 = strCode.find("data-raw-business-name")
    if (nPos1 > -1):
        nPos1 += 24
        nPos2 = strCode.find("data-listing-url", nPos1) - 1
        strLocation = strCode[nPos1 : nPos2]

    return strLocation




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




def DoGetAllBusiness(arrayBusinessLinks, arrayAllBusinessDetails, arrayEmailAddresses):
    for nI in range(0, len(arrayBusinessLinks)):
        print(str(nI + 1) + " of " + str(len(arrayBusinessLinks)) + " (" + arrayBusinessLinks[nI] + ")")
        strCode = DoGetCode("https://www.yellowpages.com.au" + arrayBusinessLinks[nI])
        nTryNum = 1
        while ((strCode == "EXCEPTION") and (nTryNum <= 5)):
            strCode = DoGetCode("https://www.yellowpages.com.au" + arrayBusinessLinks[nI])
            nTryNum += 1
            print("Re-trying " + arrayBusinessLinks[nI])
        strEmail = DoGetEmailAddress(strCode)
        strPhone = DoGetPhoneNumber(strCode)
        strWebSite = DoGetWebSite(strCode)
        strBusinessName = DoGetBusinessName(strCode)
        strLocation = DoGetLocation(strCode)
        strGPS = DoGetGPS(strCode)
        dictBusiness = {}
        dictBusiness["business_name"] = strBusinessName
        dictBusiness["phone"] = strPhone
        dictBusiness["website"] = strWebSite
        dictBusiness["email"] = strEmail
        dictBusiness["location"] = strLocation
        dictBusiness["gps"] = strGPS
        arrayAllBusinessDetails.append(dictBusiness)
        if (len(strEmail) > 0):
            arrayEmailAddresses.append(strEmail)





#arrayAlphabeticLinkURLs = DoGetAlphabeticLinks("https://www.yellowpages.com.au/xxxx/gardeners-14621-category-")
#arrayAlphabeticLinkURLs = DoGetAlphabeticLinks("https://www.yellowpages.com.au/xxxx/home-cleaning-13986-category-")
#arrayAlphabeticLinkURLs = DoGetAlphabeticLinks("https://www.yellowpages.com.au/xxxx/painters-decorators-17302-category-")

#arrayAlphabeticLinkURLs = DoGetAlphabeticLinks("https://www.yellowpages.com.au/xxxx/concrete-contractors-34622-category-")
#arrayAlphabeticLinkURLs = DoGetAlphabeticLinks("https://www.yellowpages.com.au/xxxx/tree-stump-removal-services-28061-category-")
arrayAlphabeticLinkURLs = DoGetAlphabeticLinks("https://www.yellowpages.com.au/xxxx/pet-care-27995-category-")
arrayBusinessLinks = []

for nI in range(len(arrayAlphabeticLinkURLs)):
    print(str(nI) + " of " + str(len(arrayAlphabeticLinkURLs)) + " (" + arrayAlphabeticLinkURLs[nI] + ")")
    strCode = DoGetCode(arrayAlphabeticLinkURLs[nI])
    arrayBusinessLinks += DoGetBusinessLinks(strCode, 75728, 84059)
    time.sleep(0.5)

arrayEmailAddresses = []
arrayAllBusinessDetails = []

DoGetAllBusiness(arrayBusinessLinks, arrayAllBusinessDetails, arrayEmailAddresses)
jsonAllBusinessDetails = json.dumps(arrayAllBusinessDetails)

for nI in range(0, len(arrayEmailAddresses)):
    print(arrayEmailAddresses[nI] + ";")
print("\n")
print(jsonAllBusinessDetails)


