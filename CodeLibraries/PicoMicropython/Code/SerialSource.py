from UARTSerial import *
from WiFi import *

SRC_WIFI = "WIFI"
SRC_UART0 = "UART0"
SRC_UART1 = "UART1"

class CSerialSource:

    WiFi = 0
    UART0 = 0
    UART1 = 0
    strWhich = ""
    nMillisTimeout = 0
    strRequest = ""
    strDelimiter = "~"
    
    # Function overloading not allowed in Python so the constructor just sets the time out 
    def __init__(self, nMillisTimeout = 500):
        self.WiFi = 0
        self.UART0 = 0
        self.UART1 = 0
        self.nMillisTimeout = nMillisTimeout
        
    # Set the serial source up as a WiFi Access Point with HTTP
    def BeginHTTPAsAP(self, strSSID, strPassword):
        self.WiFi = CWiFi(self.nMillisTimeout)
        self.WiFi.BeginHTTPAsAP(strSSID, strPassword)

    # Set the serial source up on an existing WiFi network with HTTP
    def BeginHTTP(self, strSSID, strPassword):
        self.WiFi = CWiFi(self.nMillisTimeout)
        self.WiFi.BeginHTTP(strSSID, strPassword)

    # Set the serial source up as a WiFi Access Point with UDP
    def BeginUDPAsAP(self, strSSID, strPassword, nPort):
        self.WiFi = CWiFi(self.nMillisTimeout)
        self.WiFi.BeginUDPAsAP(strSSID, strPassword, nPort)

    # Set the serial source up on an existing WiFi network with UDP
    def BeginUDP(self, strSSID, strPassword, nPort):
        self.WiFi = CWiFi(self.nMillisTimeout)
        self.WiFi.BeginUDP(strSSID, strPassword, nPort)

    # Set the serial source up as one UART port
    def BeginUART1(self, nBaudRate, nRxPin, nTxPin):
        HWSerial = CUARTSerial(nBaudRate, nRxPin, nTxPin, self.nMillisTimeout)
        if (HWSerial.GetUARTPort() == 0):
            self.UART0 = HWSerial
        elif (HWSerial.GetUARTPort() == 1):
            self.UART1 = HWSerial
        
    def BeginUART2(self, nBaudRate1, nRxPin1, nTxPin1, nBaudRate2, nRxPin2, nTxPin2):
        HWSerial = CUARTSerial(nBaudRate1, nRxPin1, nTxPin1, self.nMillisTimeout)
        if (HWSerial.GetUARTPort() == 0):
            self.UART0 = HWSerial
        elif (HWSerial.GetUARTPort() == 1):
            self.UART1 = HWSerial
            
        HWSerial = CUARTSerial(nBaudRate2, nRxPin2, nTxPin2, self.nMillisTimeout)
        if (HWSerial.GetUARTPort() == 0):
            if (self.UART0 != 0):
                print("Both sets of Tx and Rx pins belong to UART port 0!")
            else:
                self.UART0 = HWSerial
        elif (HWSerial.GetUARTPort() == 1):
            if (self.UART0 != 1):
                print("Both sets of Tx and Rx pins belong to UART port 1!")
            else:
                self.UART1 = HWSerial
                
    def SetDelim(strDelimiter):
        self.strDelimiter = strDelimiter

    def WaitForRequest(self, nMillis = 500):
        if (self.UART0 != 0):
            self.strWhich = SRC_UART0
            self.strRequest = self.UART0.WaitForRequest()
        if (self.UART1 != 0):
            self.strWhich = SRC_UART1
            self.strRequest = self.UART1.WaitForRequest()
        if (self.WiFi != 0):
            self.strWhich = SRC_WIFI
            self.strRequest = self.WiFi.WaitForRequest()
        if ((self.UART0 == 0) and (self.UART1 == 0) and (self.WiFi == 0)):
            print("No serial source is configured!")
            
    def Available(self):
        return len(self.strRequest) > 0
            
    def GetToken(self):
        strToken = GetToken(self.strRequest, self.strDelimiter)
        self.strRequest = RemoveToken(self.strRequest, self.strDelimiter)

        return strToken
            
    def GetIntToken(self):
        nVal = 0
        
        strVal = self.GetToken()
        if ((strVal != None) and strVal.isdigit()):
            nVal = int(strVal)
        else:
            print("Token '" + strVal + "' is not an integer!")
            
        return nVal
        
    
    def IsFromWIFI(self):
        return self.strWhich == SRC_WIFI
    
    def IsFromUART0(self):
        return self.strWhich == SRC_UART0
    
    def IsFromUART1(self):
        return self.strWhich == SRC_UART1
    
    def SendResponse(self, strResponse, bClose = True):
        strResponse += self.strDelimiter

        if (self.IsFromUART0()):
            self.UART0.SendResponse(strResponse)
        elif (self.IsFromUART1()):
            self.UART1.SendResponse(strResponse)
        elif (self.IsFromWIFI()):
            self.WiFi.SendResponse(strResponse, bClose)
