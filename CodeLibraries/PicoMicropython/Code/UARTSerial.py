from machine import UART, Pin
import time
from Common import *

class CUARTSerial:
    
    uart = 0
    nUARTPort = -1
    
    def __init__(self, nBaudRate, nRxPin, nTxPin, nTimeoutMillis = 500):
        if ((nRxPin == 5) and (nTxPin == 4)) or ((nRxPin == 9) and (nTxPin == 8)):
            self.nUARTPort = 1
        elif ((nRxPin == 13) and (nTxPin == 12)) or ((nRxPin == 17) and (nTxPin == 16)):
            self.nUARTPort = 0
        
        if (self.nUARTPort == -1):
            print("Tx = " + str(nTxPin) + " and Rx = " + str(nRxPin) + " are not a valid UART port!")
            print("UART 0")
            print("  Tx = 12, Rx = 13 or Tx = 16, Rx = 17")
            print("UART 1")
            print("  Tx = 4, Rx = 5 or Tx = 8, Rx = 9")
            self.uart = UART(self.nUARTPort, baudrate = nBaudRate, tx = Pin(nTxPin), rx = Pin(nRxPin), timeout = nTimeoutMillis)
        else:
            self.uart = UART(self.nUARTPort, baudrate = nBaudRate, tx = Pin(nTxPin), rx = Pin(nRxPin), timeout = nTimeoutMillis)
            PrintLine()
            print("UART port " + str(self.nUARTPort) + " open, Tx = " + str(nTxPin) + " and Rx = " + str(nRxPin))
            PrintLine()
            
    def GetUARTPort(self):
        return self.nUARTPort
            
    def WaitForRequest(self):
        strToken = ""
        PrintLine()
        print("Waiting for token via UART port " + str(self.nUARTPort) + "...")
        print("\n")
        
        ReturnValue = self.uart.read()
        if (ReturnValue != None):
            strToken = ReturnValue.decode()
            if (strToken != ""):
                print("@Token recieved: '" + strToken + "'")
            else:
                print("No token received before timeout!")
        else:
            print("No token received before timeout!")
        PrintLine()
        return strToken
    
    def SendResponse(self, strResponse):
        self.uart.write(strResponse)
        
            
