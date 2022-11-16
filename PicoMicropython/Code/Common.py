

def ReplaceAll(strText, strToFind, strToReplace):
    while (True):
        nPos = strText.find(strToFind)
        if (nPos > -1):
            strBefore = strText[0 : nPos]
            strAfter = strText[nPos + len(strToFind) : len(strText)]
            strText = strBefore + strToReplace + strAfter
        else:
            break
    return strText;

def PrintLine():
    print("===============================================================================")
    
def GetToken(strData, strDelimiter):
    strToken = ""
    
    if (type(strData) != str):
        print("Parameter 'strData' of function 'GetToken(...) in file 'Common.py' is not a string!")
    elif (type(strDelimiter) != str):
        print("Parameter 'strDelimiter' of function 'GetToken(...) in file 'Common.py' is not a string!")
    else:
        nPos = strData.find(strDelimiter)
        strToken = strData[0 : nPos]
        
    return strToken

def GetIntToken(strData, strDelimiter):
    strToken = "0"
    
    if (type(strData) != str):
        print("Parameter 'strData' of function 'GetToken(...) in file 'Common.py' is not a string!")
    elif (type(strDelimiter) != str):
        print("Parameter 'strDelimiter' of function 'GetToken(...) in file 'Common.py' is not a string!")
    else:
        nPos = strData.find(strDelimiter)
        strToken = strData[0 : nPos]
 
    return int(strToken)

def RemoveToken(strData, strDelimiter):
    
    if (type(strData) != str):
        print("Parameter 'strData' of function 'GetToken(...) in file 'Common.py' is not a string!")
    elif (type(strDelimiter) != str):
        print("Parameter 'strDelimiter' of function 'GetToken(...) in file 'Common.py' is not a string!")
    else:
        nPos = strData.find(strDelimiter)
        strData = strData[nPos + 1 : len(strData)]
        
    return strData

            
