#!/usr/bin/env python
import sys
import json
from common import *



strFilename = "ARBORISTS"
fileJSON = open(g_strPath + strFilename + ".json", "r")
arrayBusinesses = json.load(fileJSON)
dictBusinesses = {}

for dictBusinessDetails in arrayBusinesses:
    strBusinessName = dictBusinessDetails["business_name"]
    dictBusinesses[strBusinessName] = dictBusinessDetails

arrayBusinesses = []
for strKey, dictBusinessDetails in dictBusinesses.items():
    arrayBusinesses.append(dictBusinessDetails)

fileBusinessDetails = open(g_strPath + strFilename + ".json", "w")
strJSON = json.dumps(arrayBusinesses)
fileBusinessDetails.write(strJSON)
fileBusinessDetails.close()

fileEmails = open(g_strPath + strFilename + ".email", "w")
for dictBusinessDetails in arrayBusinesses:
    strEmail = dictBusinessDetails["email"]
    if len(strEmail) > 0:
        fileEmails.write(strEmail + "\n")
fileEmails.close()

fileCSV = open(g_strPath + strFilename + ".csv", "w")
try:
    for dictBusinessDetails in arrayBusinesses:
        fileCSV.write(dictBusinessDetails["business_name"] + ",")
        fileCSV.write(dictBusinessDetails["street"] + ",")
        fileCSV.write(dictBusinessDetails["suburb"] + ",")
        fileCSV.write(dictBusinessDetails["state"] + ",")
        fileCSV.write(dictBusinessDetails["postcode"] + ",")
        fileCSV.write(dictBusinessDetails["phone"] + ",")
        fileCSV.write(dictBusinessDetails["website"] + ",")
        fileCSV.write(dictBusinessDetails["email"] + ",")
        fileCSV.write(dictBusinessDetails["gps"] + "\n")
except Exception:
    continiue
fileCSV.close()
print("COMPLETE!")
