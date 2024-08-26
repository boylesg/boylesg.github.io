import PySimpleGUI as SG
import json
import os.path
import os
from SendEmails import *


######################################################################################
######################################################################################
##
## GLOBAL VARIABLES FOR THE CONFIGURATION FILE
##
######################################################################################
######################################################################################
g_dictConfig = {"email_server":
                    {"url": "", "username": "", "password": ""},
                "email_files":
                    {"html": "email.html", "txt": "email.txt", "html_content": "", "txt_content": ""},
                "email_file_list": [], "selected_email_file_list": []
                }

g_dictFilenames = {"config_filename": "config.json"}


def DoLoadConfigFile():
    global g_dictFilenames
    global g_dictConfig

    if (not os.path.isfile(g_dictFilenames["config_filename"])):
        with open(g_dictFilenames["config_filename"], "w+") as fileConfig:
            json.dump(g_dictConfig, fileConfig)
            fileConfig.close()
    with open(g_dictFilenames["config_filename"], "r") as fileConfig:
        g_dictConfig = json.load(fileConfig)
        fileConfig.close()


def DoSaveConfigFile():
    global g_dictFilenames

    with open(g_dictFilenames["config_filename"], "w+") as fileConfig:
        json.dump(g_dictConfig, fileConfig)
        fileConfig.close()


def DoGetEmailFileList():
    arrayFilenames = []
    for strFilename in os.listdir("."):
        if strFilename.endswith(".email"):
            arrayFilenames.append(strFilename)
    arrayFilenames = sorted(arrayFilenames)
    return arrayFilenames


def DoRun():
    global g_dictConfig
    arrayEmailFiles = DoGetEmailFileList()

    DoLoadConfigFile()
    #######################################################################################
    # START LAYOUTS
    #######################################################################################
    layoutConfig = [[SG.Text("      ")], [SG.Text("Email Server")],
                    [SG.Push(), SG.Text("Server URL:"), SG.Input(g_dictConfig["email_server"]["url"], key="url")],
                    [SG.Push(), SG.Text("Server Port:"), SG.Input(g_dictConfig["email_server"]["port"], key="port", enable_events=True)],
                    [SG.Push(), SG.Text("Server Username:"), SG.Input(g_dictConfig["email_server"]["username"], key="username")],
                    [SG.Push(), SG.Text("Server Password:"), SG.Input(g_dictConfig["email_server"]["password"], key="password", password_char="*")],
                    [SG.Push(), SG.Checkbox("Show Password", default=False, key="email_server_show_password")],
                    [SG.Text("      ")],
                    [SG.Text("Email Messages To Send")],
                    [SG.Push(), SG.Text("HTML Email Filename:"), SG.Input(g_dictConfig["email_files"]["html"], key="html")],
                    [SG.Push(), SG.Text("Text Email Filename:"), SG.Input(g_dictConfig["email_files"]["txt"], key="txt")],
                    [SG.Text("      ")],
                    [SG.Push(), SG.Button("SAVE", key="save_email_server")],
                    [SG.Text("      ")]]

    layoutSendEmails = [[SG.Text("      ")],
                        [SG.Text("Email Lists (.email)              "), SG.Button("SEND", key="send_emails")],
                        [SG.Listbox(arrayEmailFiles, size=(30, 15), select_mode="extended", key="list_of_email_files")],
                        [SG.Text("Select the email files you want to process...")],
                        [SG.Text("      ")]]

    layout = [[SG.Exit("QUIT", key="quit")], [SG.Text("      ")],
              [SG.TabGroup([[SG.Tab("Configuration", layoutConfig), SG.Tab("Send Marketing Emails", layoutSendEmails)]])]]
    #######################################################################################
    # END LAYOUTS
    #######################################################################################
    g_dictConfig["email_list_files"] = arrayEmailFiles
    MainWindow = SG.Window(title="My E-Marketing", layout=layout, margins=(10, 10))
    bShowPassword = False

    while True:
        strEvent, dictValues = MainWindow.read(500)

        if (strEvent == "quit") or (strEvent is None):
            break
        elif strEvent == "save_email_server":
            g_dictConfig["url"] = MainWindow["url"].get()
            g_dictConfig["username"] = MainWindow["username"].get()
            g_dictConfig["password"] = MainWindow["password"].get()
            g_dictConfig["html"] = MainWindow["html"].get()
            g_dictConfig["txt"] = MainWindow["txt"].get()
            DoSaveConfigFile()
        elif strEvent == "send_emails":
            arraySelectedEmailFiles = MainWindow["list_of_email_files"].get()
            g_dictConfig["selected_email_file_list"] = arraySelectedEmailFiles
            DoStart(g_dictConfig)
        elif strEvent == "port":
            strText = dictValues["port"]
            if not strText.isdigit():
                MainWindow["port"].update(value=strText[:-1])

        if bShowPassword != dictValues["email_server_show_password"]:
            if dictValues["email_server_show_password"]:
                MainWindow["password"].update(password_char="")
            else:
                MainWindow["password"].update(password_char="*")
            bShowPassword = dictValues["email_server_show_password"]
    MainWindow.close()


DoRun()
