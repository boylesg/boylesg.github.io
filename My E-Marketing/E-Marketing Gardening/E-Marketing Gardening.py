import PySimpleGUI as SG
import json
import os.path
import os
import pprint
import sys

sys.path.append("C:/Users/gregaryb/Documents/GitHub/boylesg.github.io/My E-Marketing")
from SendEmails import *
from PostFacebook import *

######################################################################################
######################################################################################
##
## GLOBAL VARIABLES FOR THE CONFIGURATION FILE
##
######################################################################################
######################################################################################
g_dictConfig = {"email_server":
                    {"email_url": "", "email_port": "", "email_username": "", "email_password": ""},
                "email_files":
                    {"html": "email.html", "txt": "email.txt", "html_content": "", "txt_content": ""},
                "email_lists":
                    {"email_files": [], "selected_email_files": []},
                "facebook":
                    {"facebook_username": "", "facebook_password": "", "facebook_groups": [{"name": "", "url": ""}],
                     "facebook_posts": [{"post_filename": "", "image_filename": ""}],
                     "facebook_posts": [{"post_filename": "", "image_filename": ""}],
                     "selected_tradie_facebook_posts": [{"post_filename": "", "image_filename": ""}],
                     "selected_facebook_posts": [{"post_filename": "", "image_filename": ""}]}
                }

g_dictFilenames = {"config_filename": "E-Marketing Gardening.json"}


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
        pprint.pprint(g_dictConfig)
        print("\n\n")


def DoSaveConfigFile():
    global g_dictFilenames

    with open(g_dictFilenames["config_filename"], "w+") as fileConfig:
        json.dump(g_dictConfig, fileConfig)
        fileConfig.close()


def DoGetFileList(strFileExtension):
    arrayFilenames = []
    for strFilename in os.listdir("."):
        if strFilename.endswith(strFileExtension):
            arrayFilenames.append(strFilename)
    arrayFilenames = sorted(arrayFilenames)
    return arrayFilenames


def DoGetNewFacebookGroupList(arrayFacebookGroups):
    arrayFacebookGroups4Listbox = []
    for dictGroup in arrayFacebookGroups:
        arrayFacebookGroups4Listbox.append(dictGroup["name"] + " (" + dictGroup["url"] + ")")
    return arrayFacebookGroups4Listbox


def DoSaveFacebookGroupList(arrayFacebookGroupsFromListbox):
    arrayFacebookGroups = []
    for strItem in arrayFacebookGroupsFromListbox:
        arrayParts = strItem.split(" (")
        strName = arrayParts[0]
        strURL = arrayParts[1]
        strName = strName.strip("( )")
        strURL = strURL.strip("( )")
        arrayFacebookGroups.append({"name": strName, "url": strURL})
    return arrayFacebookGroups


def DoSaveFacebookPost(strFilenamePost, strFilenameImage, strConfigPostListKey):
    g_dictConfig["facebook"][strConfigPostListKey].append(
        {"post_filename": strFilenamePost, "image_filename": strFilenameImage})


def DoGetFacebookPostList(arrayConfigFacebookPosts):
    arrayFacebookPosts4Listbox = []
    for dictPost in arrayConfigFacebookPosts:
        strFilename = dictPost["post_filename"]
        strListItem = strFilename[strFilename.rfind("/") + 1:]
        strFilename = dictPost["image_filename"]
        if strFilename != "":
            strListItem = strListItem + " (with image " + strFilename[strFilename.rfind("/") + 1:] + ")"
        arrayFacebookPosts4Listbox.append(strListItem)
    return arrayFacebookPosts4Listbox


def DoGetNewPost(MainWindow, arrayPosts, strListBoxKey, strConfigPostListKey):
    dictResults = Popup2xText(SG, "New Facebook Post", "File containing the post", "", True,
                              (("Facebook posts", "*.facebook"), ("All Files", "*.*")), "Image file", "", True,
                              (("JPEG Files", "*.jpg"), ("JPEG Files", "*.jpeg"), ("PNG Files", "*.png")))
    if dictResults["OK"]:
        DoSaveFacebookPost(dictResults["Text1"], dictResults["Text2"], strConfigPostListKey)
        arrayFacebookPostListbox = DoGetFacebookPostList(arrayPosts)
        MainWindow[strListBoxKey].update(values=arrayFacebookPostListbox)


def DoGetFacebookGroup(MainWindow, strGroupListKey, strConfigListKey, strSelectedGroup):
    strGroupName = ""
    strGroupURL = "https://www.facebook.com/groups/"
    if (strSelectedGroup != ""):
        strGroupName = strSelectedGroup[0:strSelectedGroup.index("(")]
        strGroupURL = strSelectedGroup[strSelectedGroup.index("(") + 1:len(strSelectedGroup) - 1]
    dictResults = Popup2xText(SG, "Enter new Facebook group", "Group Name", strGroupName, False, "", "URL",
                              strGroupURL, False, "")
    if dictResults["OK"]:
        arrayListboxValues = MainWindow[strGroupListKey].Values
        g_dictConfig["facebook"][strConfigListKey].append(
            {"name": dictResults["Text1"], "url": dictResults["Text2"]})
        arrayListboxValues.append(dictResults["Text1"] + " (" + dictResults["Text2"] + ")")
        MainWindow[strGroupListKey].update(values=arrayListboxValues)


def DoDeleteListItem(MainWindow, strPostListKey, strDeleteKey, strEditKey):
    arrayFacebookPostList = MainWindow[strPostListKey].Values
    arraySelectedIndexes = MainWindow[strPostListKey].get_indexes()
    for nI in range(0, len(arraySelectedIndexes)):
        arrayFacebookPostList.pop(arraySelectedIndexes[nI])
    MainWindow[strPostListKey].update(values=arrayFacebookPostList)
    MainWindow[strDeleteKey].update(disabled=True)
    if strEditKey != "":
        MainWindow[strEditKey].update(disabled=True)


def DoSaveFacebookGroups(MainWindow, strGroupListKey, strConfigGroupListKey):
    FacebookGroupListbox = MainWindow[strGroupListKey]
    arrayFacebookGroups = FacebookGroupListbox.Values
    g_dictConfig["facebook"][strConfigGroupListKey] = DoSaveFacebookGroupList(arrayFacebookGroups)
    DoSaveConfigFile()


def DoRun():
    global g_dictConfig

    DoLoadConfigFile()
    arrayFacebookGroups = DoGetNewFacebookGroupList(g_dictConfig["facebook"]["facebook_groups"])
    arrayEmailFiles = []
    arrayEmailFiles = DoGetFileList(".email")
    g_dictConfig["email_lists"]["email_files"] = arrayEmailFiles

    #######################################################################################
    # START LAYOUTS
    #######################################################################################
    strSpaces = "                                                                                                                       "

    layoutConfig = [[SG.Text("Email Server")],
                    [SG.Push(), SG.Text("Server URL:"),
                     SG.InputText(g_dictConfig["email_server"]["email_url"], key="email_url"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Text("Server Port:"),
                     SG.InputText(g_dictConfig["email_server"]["email_port"], key="email_port", enable_events=True,
                                  size=(5, 1)), SG.Text(strSpaces),
                     SG.Text("                                                                   ")],
                    [SG.Push(), SG.Text("Server Username:"),
                     SG.InputText(g_dictConfig["email_server"]["email_username"], key="email_username"),
                     SG.Text(strSpaces)],
                    [SG.Push(), SG.Text("Server Password:"),
                     SG.InputText(g_dictConfig["email_server"]["email_password"], key="email_password",
                                  password_char="*"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Checkbox("Show Password", default=False, key="email_server_show_password"),
                     SG.Text(strSpaces)],
                    [SG.HorizontalSeparator(color='black')],
                    [SG.Text("Email Messages To Send")],
                    [SG.Push(), SG.Text("HTML Email Filename:"),
                     SG.InputText(g_dictConfig["email_files"]["html"], key="html"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Text("Text Email Filename:"),
                     SG.InputText(g_dictConfig["email_files"]["txt"], key="txt"), SG.Text(strSpaces)],
                    [SG.HorizontalSeparator(color='black')],
                    [SG.Text("Facebook")],
                    [SG.Push(), SG.Text("Username:"),
                     SG.InputText(g_dictConfig["facebook"]["facebook_username"], key="facebook_username"),
                     SG.Text(strSpaces)],
                    [SG.Push(), SG.Text("Password:"),
                     SG.InputText(g_dictConfig["facebook"]["facebook_password"], password_char="*",
                                  key="facebook_password"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Checkbox("Show Password", default=False, key="facebook_show_password"),
                     SG.Text(strSpaces)],
                    [SG.Push(), SG.Button(image_filename="../save.png", key="save_config"), SG.Text(strSpaces)]]

    layoutSendEmails = [[SG.Button(key="help_email", image_filename="../help.png")],
                        [SG.HorizontalSeparator(color='black')],
                        [SG.Text("Email Lists (.email)")],
                        [SG.Listbox(arrayEmailFiles, size=(35, 14), select_mode="extended", key="list_of_email_files")],
                        [SG.Button(image_filename="../refresh.png", key="refresh_email_lists"),
                         SG.Button(image_filename="../email.png", key="send_emails")],
                        [SG.Text("Select the email files you want to process...")]]

    layoutFacebookColumn1 = [[SG.Text("Facebook Group List")],
                             [SG.Listbox(DoGetNewFacebookGroupList(g_dictConfig["facebook"]["facebook_groups"]),
                                         size=(80, 16), select_mode="single", key="list_of_facebook_groups",
                                         enable_events=True)],
                             [SG.Button(image_filename="../refresh.png", key="refresh_facebook_groups"),
                              SG.Button(image_filename="../add.png", key="add_facebook_group", size=(10, 1)),
                              SG.Button(image_filename="../edit.png", key="edit_facebook_group", size=(10, 1)),
                              SG.Button(image_filename="../subtract.png", key="delete_facebook_group", size=(10, 1),
                                        disabled=True),
                              SG.Button(image_filename="../save.png", key="save_facebook_groups", size=(10, 1)),
                              SG.VPush()]]

    layoutFacebookColumn2 = [[SG.Text("List of Posts")],
                             [SG.Listbox(DoGetFacebookPostList(g_dictConfig["facebook"]["facebook_posts"]),
                                         size=(44, 14), select_mode="single", key="list_of_facebook_posts",
                                         enable_events=True)],
                             [SG.Button(image_filename="../add.png", key="add_facebook_post", size=(2, 1)),
                              SG.Button(image_filename="../subtract.png", key="delete_facebook_posts", disabled=True,
                                        size=(2, 1)),
                              SG.Button(image_filename="../Facebook.png", key="start_facebook_posts", size=(10, 1)),
                              SG.Push(),
                              SG.Text("Post Delay:"),
                              SG.InputText(key="facebook_post_delay", size=(5, 1), default_text="1",
                                           enable_events=True)],
                             [SG.Push(), SG.Text("Post repeat"),
                              SG.InputText(key="facebook_post_repeat", size=(5, 1), default_text="1",
                                           enable_events=True),
                              SG.Combo(values=["minute(s)", "hour(s)", "day(s)"], default_value="hour(s)",
                                       key="facebook_post_delay_type")]]

    layoutFacebook = [[SG.Button(key="help_facebook", image_filename="../help.png")],
                      [SG.HorizontalSeparator(color='black')],
                      [SG.Column(layoutFacebookColumn1, element_justification="left"),
                       SG.Column(layoutFacebookColumn2, element_justification="left")]]

    layoutOutput = [[SG.VPush(), SG.Text(key="output", size=(132, 25)), SG.VPush()]]

    layout = [[SG.Button(key="quit", image_filename="../quit.png")],
              [SG.TabGroup(
                  [[SG.Tab("Configuration", layoutConfig),
                    SG.Tab("Marketing Emails", layoutSendEmails),
                    SG.Tab("Facebook Marketing", layoutFacebook),
                    SG.Tab("Output", layoutOutput)]])]]

    #######################################################################################
    # END LAYOUTS
    #######################################################################################
    g_dictConfig["email_lists"]["email_files"] = arrayEmailFiles
    MainWindow = SG.Window(title="E-Marketing Greg's Native Landscapes", layout=layout, margins=(10, 10),
                           size=(1000, 500))
    bShowEmailServerPassword = False
    bShowFacebookPassword = False

    while True:
        strEvent, dictValues = MainWindow.read(500)

        if (strEvent == "quit") or (strEvent is None):
            break
        elif strEvent == "save_config":
            g_dictConfig["email_server"]["email_url"] = MainWindow["email_url"].get()
            g_dictConfig["email_server"]["email_username"] = MainWindow["email_username"].get()
            g_dictConfig["email_server"]["email_password"] = MainWindow["email_password"].get()
            g_dictConfig["email_files"]["html"] = MainWindow["html"].get()
            g_dictConfig["email_files"]["txt"] = MainWindow["txt"].get()
            g_dictConfig["facebook"]["facebook_username"] = MainWindow["facebook_username"].get()
            g_dictConfig["facebook"]["facebook_password"] = MainWindow["facebook_password"].get()
            DoSaveConfigFile()
        elif strEvent == "add_facebook_post":
            DoGetNewPost(MainWindow, g_dictConfig["facebook"]["facebook_posts"], "list_of_facebook_posts",
                         "facebook_posts")
        elif strEvent == "delete_facebook_posts":
            DoDeleteListItem(MainWindow, "list_of_facebook_posts", "delete_facebook_posts", "")
        elif strEvent == "list_of_facebook_posts":
            MainWindow["delete_facebook_posts"].update(disabled=False)
        elif strEvent == "refresh_facebook_groups":
            MainWindow["list_of_facebook_groups"].update(
                values=DoGetNewFacebookGroupList(g_dictConfig["facebook"]["facebook_groups"]))
        elif strEvent == "list_of_facebook_groups":
            MainWindow["delete_facebook_group"].update(disabled=False)
            MainWindow["edit_facebook_group"].update(disabled=False)
        elif strEvent == "save_facebook_groups":
            DoSaveFacebookGroups(MainWindow, "list_of_facebook_groups", "facebook_groups")
        elif strEvent == "delete_facebook_group":
            DoDeleteListItem(MainWindow, "list_of_facebook_groups", "delete_facebook_group", "edit_facebook_group")
        elif strEvent == "add_facebook_group":
            DoGetFacebookGroup(MainWindow, "list_of_facebook_groups", "facebook_groups", "")
        elif strEvent == "edit_facebook_group":
            DoGetFacebookGroup(MainWindow, "list_of_facebook_groups", "facebook_groups",
                               MainWindow["list_of_facebook_groups"].get()[0])
        elif strEvent == "send_emails":
            arraySelectedEmailFiles = MainWindow["list_of_email_files"].get()
            g_dictConfig["email_lists"]["selected_email_files"] = arraySelectedEmailFiles
            DoStartSendingEmails(g_dictConfig)
        elif strEvent == "refresh_facebook_posts":
            MainWindow["list_of_facebook_posts"].update(values=g_dictConfig["facebook"]["facebook_posts"])
        elif strEvent == "save_facebook_posts":
            FacebookPostListbox = MainWindow["list_of_facebook_posts"]
            arrayFacebookPosts = FacebookPostListbox.Values
            g_dictConfig["facebook"]["facebook_posts"] = arrayFacebookPosts
            DoSaveConfigFile()
        elif strEvent == "start_facebook_posts":
            DoStartFacebookPosts(g_dictFilenames["config_filename"], g_dictConfig,
                "Switch to Greg's Native Landscapes",
                "https://www.facebook.com/GregsNativeLandscapes",
                int(MainWindow["facebook_post_delay"].get()),
                MainWindow["facebook_post_delay_type"].get(),
                int(MainWindow["facebook_post_repeat"].get()),
                MainWindow["list_of_facebook_posts"].get_indexes(),
                "facebook_groups",
                "facebook_posts", "selected_facebook_posts",
                "last_facebook_post",
                "last_facebook_group")

        elif strEvent == "help_facebook":
            strText = "YYYY"
            SG.popup(strText, title="HELP - With Facebook Customer Posts")
        elif strEvent == "help_email":
            strText = ("Files containing email address lists must be:\n" +
                       "1) Plain text format\n" +
                       "2) Have the extension .email\n" +
                       "3) Be located in the same folder as 'MyEMarketing.py\n\n" +
                       "The .email files are automatically detected and listed here.\n\n" +
                       "You should select at least one of the .email files from the list and then click the 'SEND' button\n\n" +
                       "Each email file will then be processed with an email being sent to each email address in that file.\n\n" +
                       "You must have specified the email server details, as well as files containing a html and a text version of the email you want to send, in the 'Configuration' tab.\n\n" +
                       "The progress, and any errors, will be displayed in the 'Output' window.\n\n" +
                       "If the daily sent email limit for your web server is reached then the process will bookmark the current email file and the current email address in that file, and then sleep for 2 hours at a time until emails can be successfully sent again. ")
            SG.popup(strText, title="HELP - Sending Marketing Emails")
        elif strEvent == "email_port":
            strText = dictValues["email_port"]
            if (not strText.isdigit()) or (len(strText) > 3):
                MainWindow["email_port"].update(value=strText[:-1])
        elif strEvent == "facebook_post_delay":
            strText = dictValues["facebook_post_delay"]
            if (not strText.isdigit()) or (len(strText) > 3):
                MainWindow["facebook_post_delay"].update(value=strText[:-1])
        elif strEvent == "facebook_post_repeat":
            strText = dictValues["facebook_post_repeat"]
            if (not strText.isdigit()) or (len(strText) > 3):
                MainWindow["facebook_post_repeat"].update(value=strText[:-1])
        if bShowEmailServerPassword != dictValues["email_server_show_password"]:
            if dictValues["email_server_show_password"]:
                MainWindow["email_password"].update(password_char="")
            else:
                MainWindow["email_password"].update(password_char="*")
            bShowEmailServerPassword = dictValues["email_server_show_password"]
        if bShowFacebookPassword != dictValues["facebook_show_password"]:
            if dictValues["facebook_show_password"]:
                MainWindow["facebook_password"].update(password_char="")
            else:
                MainWindow["facebook_password"].update(password_char="*")
            bShowFacebookPassword = dictValues["facebook_show_password"]

    MainWindow.close()


DoRun()
