#!/usr/bin/env python
import sys
import lxml.html as html # pip install 'lxml>=2.3.1'
from selenium import webdriver # pip install selenium




# Create a new Chrome WebDriver instance
g_browserChrome = webdriver.Chrome()
g_browserChrome.minimize_window()
dictEmails = {}
nKeyNum = 0
with open("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\email_addresses.txt", "r") as fileEmails:
    for strLine in fileEmails:
        if "@" in strLine:
            nPosAt = strLine.index("@")
            nPosEndComma = -1
            nPosStartComma = -1
            try:
                nPosEndComma = strLine.index(",", nPosAt)
                nPosStartComma = strLine.rindex(",", 0, nPosAt)
            except Exception:
                pass
            if ((nPosStartComma > -1) and (nPosEndComma) > -1):
                strLine = strLine[nPosStartComma + 1 : nPosEndComma] + "\n"

            g_browserChrome.get("https://email-checker.net/check")
            g_browserChrome.find_element_by_id("ltrInput").send_keys(strLine)
            g_browserChrome.find_element_by_css_selector(".button-primary").click()
            if (g_browserChrome.find_element_by_css_selector(".green").is_displayed()):
                dictEmails[strLine] = strLine
        elif "," not in strLine:
            dictEmails["line" + str(nKeyNum)] = strLine
            nKeyNum += 1
    else:
        fileEmails.close()

fileEmails = open("C:\\Users\\gregaryb\\Documents\\GitHub\\boylesg.github.io\\FindATradie\\data\\email_addresses.txt", "w")
for strKey, strLine in dictEmails.items():
    fileEmails.write(strLine)
fileEmails.close()