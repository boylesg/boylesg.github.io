#!/usr/bin/env python
from common import *



global g_browserChrome




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




def DoGetAllBusiness(arrayBusinessLinks, dictAllBusinessDetails):
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
        dictAllBusinessDetails[strBusinessName] = dictBusiness




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
            arrayBusinessLinks = []
            for nI in range(len(arrayAlphabeticLinkURLs)):
                print(str(nI) + " of " + str(len(arrayAlphabeticLinkURLs)) + " (" + arrayAlphabeticLinkURLs[nI] + ")")
                strCode = DoGetCode(arrayAlphabeticLinkURLs[nI])
                arrayBusinessLinks += DoGetBusinessLinks(strCode)
                #time.sleep(0.5)

            dictEmailAddresses = {}
            dictAllBusinessDetails = {}

            DoGetAllBusiness(arrayBusinessLinks, dictAllBusinessDetails)
            arrayAllBusinessDetails = []
            for strKeyBusinessName, dictBusinessDetails in dictAllBusinessDetails.items():
                arrayAllBusinessDetails.append(dictBusinessDetails)
            jsonAllBusinessDetails = json.dumps(arrayAllBusinessDetails)

            if True:
                fileBusinessJSON = open(g_strPath + strTradeDesc + ".json", "w")
                fileBusinessJSON.write(jsonAllBusinessDetails)
                fileBusinessJSON.write("\n\n")
                fileBusinessJSON.close()

            if True:
                fileBusinessCSV = open(g_strPath + strTradeDesc + ".csv", "w")
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
                fileEmails = open(g_strPath + strTradeDesc + ".email", "w")
                arrayEmailAddresses = []
                arrayEmailAddresses = DoCheckValidEmailAddresses(dictEmailAddresses)
                for dictBusinessDetails in dictAllBusinessDetails.items():
                    if (len(dictBusinessDetails["email"]) > 0):
                        fileEmails.write(dictBusinessDetails["email"] + "\n")
                fileEmails.close()

        except Exception:
            print(Exception)
            pass


print("FINISHED!")

