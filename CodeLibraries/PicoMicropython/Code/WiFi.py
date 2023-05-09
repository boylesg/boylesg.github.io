import socket
import network
import time
from Common import *

class CWiFi:

    strSSID = ""
    strPassword = ""
    WiFi = 0
    nPort = 0
    Socket = 0
    strIPAddr = ""
    strIPAddrRequest = ""
    nPortRequest = 0
    nReceiveDataSize = 2048
    Socket = 0
    Client = 0
    nMillisTimeout = 0
    AddressPortSend = 0
    
    # Function overloading not allowed in Python so the constructor only sets the timeout
    def __init__(self, nMillisTimeout = 500):
        self.nMillisTimeout = nMillisTimeout
        strSSID = ""
        
    # Common setup tasks
    def Begin(self, bIsAccessPoint, strSSID, strPassword):
        self.strSSID = strSSID
        self.strPassword = strPassword
        
        # Start Access Point
        if (bIsAccessPoint):
            self.WiFi = network.WLAN(network.AP_IF)
            if (strPassword == ""):
                self.WiFi.config(essid = strSSID)
            else:
                self.WiFi.config(essid = strSSID, password = strPassword)
            self.WiFi.active(True)

            while (self.WiFi.active == False):
                pass

            self.strIPAddr = str(self.WiFi.ifconfig()[0])
            if (self.nPort == 80):
                print("Access point '" + strSSID + "' started with IP address '" + self.strIPAddr + "' for HTTP")
            else:
                print("Access point '" + strSSID + "' started with IP address '" + self.strIPAddr + "' for UDP")
        # Connect to existing network
        else:
            self.WiFi = network.WLAN(network.STA_IF)
            self.WiFi.active(True)
            self.WiFi.connect(strSSID, strPassword)
            
            nNumAttempts = 0
            while (nNumAttempts < 10):
                if (self.WiFi.status() < 0) or (self.WiFi.status() >= 3):
                    break
                nNumAttempts += 1
                print("Waiting for connection to '" + strSSID + "'...attempt " + str(nNumAttempts))
                time.sleep(1)

            if (self.WiFi.status() != 3):
                raise RuntimeError("Failed to connect to network '" + strSSID + "'")
            else:
                self.strIPAddr = self.WiFi.ifconfig()[0]
                if (self.nPort == 80):
                    print("Connected to SSID: '" + strSSID + ", with IP address: '" + self.strIPAddr + "' for HTTP")
                else:
                    print("Connected to SSID: '" + strSSID + ", with IP address: '" + self.strIPAddr + "' for UDP")

    # Setup as WiFi for HTTP
    def BeginHTTP(self, strSSID, strPassword):
        PrintLine()
        self.Begin(False, strSSID, strPassword)
        self.nPort = 80
        self.Socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)   #creating socket object
        self.Socket.settimeout(self.nMillisTimeout)
        self.Socket.bind((self.strIPAddr, self.nPort))
        self.Socket.listen(1)
        PrintLine()
        
    # Setup as WiFi access point for HTTP
    def BeginHTTPAsAP(self, strSSID, strPassword):
        PrintLine()
        self.Begin(True, strSSID, strPassword)
        self.nPort = 80
        self.Socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)   #creating socket object
        self.Socket.settimeout(self.nMillisTimeout)
        self.Socket.bind((self.strIPAddr, self.nPort))
        self.Socket.listen(1)
        PrintLine()
        
    # Set up as a WiFi for UDP
    def BeginUDP(self, strSSID, strPassword, nPort):
        PrintLine()
        self.Begin(False, strSSID, strPassword)
        self.nPort = nPort
        self.Socket = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)   #creating socket object
        self.Socket.settimeout(self.nMillisTimeout)
        self.Socket.bind((self.strIPAddr, nPort))
        PrintLine()

    # Set up as a WiFi Access Point
    def BeginUDPAsAP(self, strSSID, strPassword, nPort):
        PrintLine()
        self.Begin(True, strSSID, strPassword)
        self.nPort = nPort
        self.Socket = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)   #creating socket object
        self.Socket.settimeout(self.nMillisTimeout)
        self.Socket.bind((self.strIPAddr, nPort))
        PrintLine()

    def HexCodes2ASCII(self, strRequest):
        ReplaceAll(strRequest, "20", " ")
        ReplaceAll(strRequest, "21", "!")
        ReplaceAll(strRequest, "22", "\"")
        ReplaceAll(strRequest, "23", "#")
        ReplaceAll(strRequest, "24", "$")
        ReplaceAll(strRequest, "25", "%")
        ReplaceAll(strRequest, "26", "&")
        ReplaceAll(strRequest, "27", "\'")
        ReplaceAll(strRequest, "28", "(")
        ReplaceAll(strRequest, "29", ")")
        ReplaceAll(strRequest, "2A", "*")
        ReplaceAll(strRequest, "2B", "+")
        ReplaceAll(strRequest, "2C", ",")
        ReplaceAll(strRequest, "2D", "-")
        ReplaceAll(strRequest, "2E", ".")
        ReplaceAll(strRequest, "2F", "/")
        ReplaceAll(strRequest, "3A", ":")
        ReplaceAll(strRequest, "3B", ";")
        ReplaceAll(strRequest, "3C", "<")
        ReplaceAll(strRequest, "3D", "=")
        ReplaceAll(strRequest, "3E", ">")
        ReplaceAll(strRequest, "3F", "?")
        ReplaceAll(strRequest, "40", "@")
        ReplaceAll(strRequest, "5B", "[")
        ReplaceAll(strRequest, "5C", "\\")
        ReplaceAll(strRequest, "5D", "]")
        ReplaceAll(strRequest, "5E", "^")
        ReplaceAll(strRequest, "5F", "_")
        ReplaceAll(strRequest, "60", "`")
        ReplaceAll(strRequest, "7B", "{")
        ReplaceAll(strRequest, "7C", "|")
        ReplaceAll(strRequest, "7D", "}")
        ReplaceAll(strRequest, "7E", "~")
        return strRequest

    def WaitForRequest(self):
        strRequest = ""
        ReturnValue = 0

        if (self.nPort == 80):
            PrintLine()
            print("Waiting for HTTP request on port '" + str(self.nPort) + "'...\n")
            try:
                ReturnValue = self.Socket.accept()
            except OSError:
                strRequest = ""
                
            if (ReturnValue != 0):
                ReturnValue = 0
                self.Client = ReturnValue[0]
                self.Client.settimeout(self.nMillisTimeout / 1000)
                self.strIPAddrRequest = ReturnValue[1][0]
                try:
                    ReturnValue = self.Client.recvfrom(self.nReceiveDataSize)
                except OSError:
                    strRequest = ""
                    
                if (ReturnValue != 0):
                    strRequest = ReturnValue[0].decode()
                    ReturnValue = ReturnValue[1]
                    self.strIPAddressRequest = ReturnValue[0]
                    self.nPortRequest = ReturnValue[1]
                    nPos1 = strRequest.find("GET")
                    nPos2 = strRequest.find("HTTP/1.1")
                    strRequest = strRequest[nPos1:nPos2]
                    strRequest = self.HexCodes2ASCII(strRequest)
                    strRequest = ReplaceAll(strRequest, "+", " ")            
        else:
            PrintLine()
            print("Waiting for UDP request on port '" + str(self.nPort) + "'...\n")
            try:
                ReturnValue = self.Socket.recvfrom(self.nReceiveDataSize)
            except OSError:
                  strRequest = ""
            
            if (ReturnValue != 0):
                strRequest = ReturnValue[0].decode()
                self.AddressPortSend = ReturnValue[1]
                self.strIPAddrRequest = ReturnValue[1][0]
                self.nPortRequest = ReturnValue[1][1]
            
        if (strRequest != ""):
            print("Request received: " + str(strRequest))
            print("\n")
            print ("From '" + self.strIPAddrRequest + "', on port '" + str(self.nPort) + "'")
        else:
            print ("No request recieved before time out!")
        PrintLine()
        
        return strRequest
    
    def SendResponse(self, strResponse, bCloseSocket):
        print("Sending response '" + strResponse + "' to '" + self.strIPAddrRequest + "' on port '" + str(self.nPort) + "'")
        if (self.nPort == 80):
            self.Client.send(strResponse)
            if (bCloseSocket):
                self.Client.close()
                self.Client = 0
                self.strIPAddrRequest = ""
                self.nPortRequest = 0
        else:
            self.Socket.sendto(strResponse, self.AddressPortSend)
                
