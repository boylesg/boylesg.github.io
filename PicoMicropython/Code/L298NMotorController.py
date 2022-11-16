from machine import Pin, PWM

class CL298NHBridge:
    
    nFrequency = 1000
    nMinDuty = 750
    nMaxDuty = 65535
    nSpeed = 0
    strName = ""
    
    def __init__(self, nPin1, nPin2, nEnablePin, strName):
        self.Pin1 = Pin(nPin1, Pin.OUT)
        self.Pin2 = Pin(nPin2, Pin.OUT)
        self.EnablePin = PWM(Pin(nEnablePin))
        self.EnablePin.freq(self.nFrequency)
        self.strName = strName
        print(strName, ", pin 1 = ", nPin1, ", pin 2 = ", nPin2, "enable pin = ", nEnablePin)

    def MoveForward(self, nSpeed):
        self.nSpeed = self.LimitSpeed(nSpeed)
        print(self.strName, ", DIRECTION = FORWARD, SPEED = ", self.nSpeed, ", DUTY CYCLE = ", self.GetDutyCycle(nSpeed));
        self.EnablePin.duty_u16(self.GetDutyCycle(nSpeed))
        self.Pin1.value(1)
        self.Pin2.value(0)
    
    def MoveBackward(self, nSpeed):
        self.nSpeed = self.LimitSpeed(-nSpeed)
        print(self.strName, ", DIRECTION = FORWARD, SPEED = ", self.nSpeed, ", DUTY CYCLE = ", self.GetDutyCycle(nSpeed));
        self.EnablePin.duty_u16(self.GetDutyCycle(nSpeed))
        self.Pin1.value(0)
        self.Pin2.value(1)

    def Stop(self):
        self.EnablePin.duty_u16(0)
        self.Pin1.value(0)
        self.Pin2.value(0)

    def GetDutyCycle(self, nSpeed):
        if nSpeed < 0:
            nSpeed *= -1
        nRange = self.nMaxDuty - self.nMinDuty
        nDutyCycle = int(self.nMinDuty + (nRange * (nSpeed / 100)))
        return nDutyCycle
    
    def LimitSpeed(self, nSpeed):
        if nSpeed > 100:
            nSpeed = 100
        elif nSpeed < -100:
            nSpeed = -100
        return nSpeed
    
    def GetSpeed(self):
        return self.nSpeed




class CL298NMotorController:
    
    def __init__(self, nChannelAPin1, nChannelAPin2, nChannelAEnablePin, nChannelBPin1, nChannelBPin2, nChannelBEnablePin):
        self.LeftMotor = CL298NHBridge(nChannelAPin1, nChannelAPin2, nChannelAEnablePin, "LEFT")
        self.RightMotor = CL298NHBridge(nChannelBPin1, nChannelBPin2, nChannelBEnablePin, "RIGHT")
        self.LeftMotor.Stop()
        self.RightMotor.Stop()
        
    def MoveForward(self, nSpeed):
        print("FORWARD ", nSpeed)
        self.LeftMotor.MoveForward(nSpeed)
        self.RightMotor.MoveForward(nSpeed)
        
    def MoveBackward(self, nSpeed):
        self.LeftMotor.MoveBackward(nSpeed)
        self.RightMotor.MoveBackward(nSpeed)
        print("BACKWARD")
        
    def TurnLeft(self, nSpeed):
        self.RightMotor.MoveForward(nSpeed)
        self.LeftMotor.Stop()
        print("LEFT")
        
    def TurnRight(self, nSpeed):
        self.LeftMotor.MoveForward(nSpeed)
        self.RightMotor.Stop()
        print("RIGHT")
        
    def TurnHardLeft(self, nSpeed):
        self.LeftMotor.MoveBackward(nSpeed)
        self.RightMotor.MoveForward(nSpeed)
        print("HARD LEFT")
        
    def TurnHardRight(self, nSpeed):
        self.LeftMotor.MoveForward(nSpeed)
        self.RightMotor.MoveBackward(nSpeed)
        print("HARD RIGHT")
        
    def Stop(self):
        self.LeftMotor.Stop()
        self.RightMotor.Stop()
    
        
    def GetSpeed(self):
        return (self.LeftMotor.GetSpeed() + self.RightMotor.GetSpeed()) / 2
    
    def IsForward(self):
        return self.LeftMotor.GetSpeed() > 0 and self.RightMotor.GetSpeed() > 0
 
    def IsBackward(self):
        return self.LeftMotor.GetSpeed() < 0 and self.RightMotor.GetSpeed() < 0
    
    def IsRight(self):
        return self.LeftMotor.GetSpeed() > 0 and self.RightMotor.GetSpeed() <= 0

    def IsLeft(self):
        return self.LeftMotor.GetSpeed() <= 0 and self.RightMotor.GetSpeed() > 0

