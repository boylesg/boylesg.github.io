import PySimpleGUI as SG
import json
import os.path
import os
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
                    {"facebook_username": "", "facebook_password": "", "facebook_groups": [{"name": "", "url": ""}], "facebook_posts": [{"post_filename": "", "image_filename": ""}], "selected_facebook_posts": [{"post_filename": "", "image_filename": ""}]}
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


def DoGetFileList(strFileExtension):
    arrayFilenames = []
    for strFilename in os.listdir("."):
        if strFilename.endswith(strFileExtension):
            arrayFilenames.append(strFilename)
    arrayFilenames = sorted(arrayFilenames)
    return arrayFilenames


def DoGetFacebookGroupList(arrayFacebookGroups):
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


def DoGetFileContentsTxt(strFilename):
    strContents = ""
    with open(strFilename, "r") as file:
        arrayLines = file.readlines()
    strContents = format("\n".join(arrayLines[0:]))
    return strContents


def DoStartFacebookPosts(arrayPosts, nMillisDelay, nRepeat):
    global g_dictConfig

    if g_dictConfig["facebook"]["last_group"] is None:
        g_dictConfig["facebook"]["last_group"] = -1

    if g_dictConfig["facebook"]["last_post"] is None:
        g_dictConfig["facebook"]["last_post"] = 0

    if DoFacebookInit(g_dictConfig["facebook"]["facebook_username"], g_dictConfig["facebook"]["facebook_password"]):
        for nI in range(0, nRepeat):
            for nJ in range(0, len(arrayPosts)):
                dictPost = arrayPosts[nJ]

                if nJ <= g_dictConfig["facebook"]["last_post"]:
                    continue
                else:
                    strPostContents = DoGetFileContentsTxt(dictPost["post_filename"])
                    if g_dictConfig["facebook"]["last_group"] == -1:
                        DoPostFacebook(strPostContents, dictPost["image_filename"], "Find-A-Tradie", "", True)

                    for nK in range(0, len(g_dictConfig["facebook"]["facebook_groups"])):
                        if nK <= g_dictConfig["facebook"]["last_group"]:
                            continue
                        else:
                            dictGroup = g_dictConfig["facebook"]["facebook_groups"][nK]
                            DoPostFacebook(strPostContents, dictPost["image_filename"], dictGroup["name"], dictGroup["url"], False)
                            g_dictConfig["facebook"]["last_group"] = nK
                            DoSaveConfigFile()

                    g_dictConfig["facebook"]["last_group"] = -1
                    g_dictConfig["facebook"]["last_post"] = nJ
                    DoSaveConfigFile()
                    wait(nMillisDelay)

            g_dictConfig["facebook"]["last_post"] = 0
            DoSaveConfigFile()
    else:
        print("DoFacebookInit() failed!")


def DoSaveFacebookPost(strFilenamePost, strFilenameImage):
    g_dictConfig["facebook"]["facebook_posts"].append({"post_filename": strFilenamePost, "image_filename": strFilenameImage})


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


def DoRun():
    global g_dictConfig
    arrayEmailFiles = DoGetFileList(".email")
    g_dictConfig["email_lists"]["email_files"] = arrayEmailFiles
    arrayFacebookGroups = DoGetFacebookGroupList(g_dictConfig["facebook"]["facebook_groups"])

    DoLoadConfigFile()
    #######################################################################################
    # START LAYOUTS
    #######################################################################################
    strSpaces = "                                                                                                                       "
    layoutConfig = [[SG.Text("Email Server")],
                    [SG.Push(), SG.Text("Server URL:"),
                     SG.InputText(g_dictConfig["email_server"]["email_url"], key="email_url"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Text("Server Port:"),
                     SG.InputText(g_dictConfig["email_server"]["email_port"], key="email_port", enable_events=True, size=(5, 1)), SG.Text(strSpaces), SG.Text("                                                                   ")],
                    [SG.Push(), SG.Text("Server Username:"),
                     SG.InputText(g_dictConfig["email_server"]["email_username"], key="email_username"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Text("Server Password:"),
                     SG.InputText(g_dictConfig["email_server"]["email_password"], key="email_password", password_char="*"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Checkbox("Show Password", default=False, key="email_server_show_password"), SG.Text(strSpaces)],
                    [SG.HorizontalSeparator(color='black')],
                    [SG.Text("Email Messages To Send")],
                    [SG.Push(), SG.Text("HTML Email Filename:"),
                     SG.InputText(g_dictConfig["email_files"]["html"], key="html"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Text("Text Email Filename:"),
                     SG.InputText(g_dictConfig["email_files"]["txt"], key="txt"), SG.Text(strSpaces)],
                    [SG.HorizontalSeparator(color='black')],
                    [SG.Text("Facebook")],
                    [SG.Push(), SG.Text("Username:"), SG.InputText(g_dictConfig["facebook"]["facebook_username"], key="facebook_username"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Text("Password:"), SG.InputText(g_dictConfig["facebook"]["facebook_password"], password_char="*", key="facebook_password"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Checkbox("Show Password", default=False, key="facebook_show_password"), SG.Text(strSpaces)],
                    [SG.Push(), SG.Button(image_filename="save.png", key="save_config"), SG.Text(strSpaces)]]

    layoutSendEmails = [[SG.Button("HELP", key="help_email")],
                        [SG.HorizontalSeparator(color='black')],
                        [SG.Text("Email Lists (.email)")],
                        [SG.Listbox(arrayEmailFiles, size=(35, 17), select_mode="extended", key="list_of_email_files")],
                        [SG.Button(image_filename="refresh.png", key="refresh_email_lists"), SG.Button(image_filename="email.png", key="send_emails")],
                        [SG.Text("Select the email files you want to process...")]]

    layoutFacebookColumn1 = [[SG.Text("Facebook Group List")],
                             [SG.Listbox(DoGetFacebookGroupList(g_dictConfig["facebook"]["facebook_groups"]), size=(80, 17), select_mode="extended", key="list_of_facebook_groups", enable_events=True)],
                             [SG.Button(image_filename="add.png", key="add_facebook_group", size=(10, 1)), SG.Text(" "),
                              SG.Button(image_filename="subtract.png", key="delete_facebook_group", size=(10, 1), disabled=True), SG.Text(" "),
                              SG.Button(image_filename="save.png", key="save_facebook_groups", size=(10, 1)), SG.VPush()]]

    layoutFacebookColumn2 = [[SG.Text("List of Posts")],
                             [SG.Listbox(DoGetFacebookPostList(g_dictConfig["facebook"]["facebook_posts"]), size=(44, 15), select_mode="extended", key="list_of_facebook_posts", enable_events=True)],
                             [SG.Button(image_filename="add.png", key="add_facebook_post", size=(2, 1)),
                              SG.Button(image_filename="subtract.png", key="delete_facebook_posts", disabled=True, size=(2, 1)),
                              SG.Button(image_filename="Facebook.png", key="start_facebook_posts", size=(10, 1)), SG.Push(),
                              SG.Text("Post Delay:"), SG.InputText(key="facebook_post_delay", size=(5, 1), default_text="1", enable_events=True)],
                             [SG.Push(), SG.Text("Post repeat"), SG.InputText(key="facebook_post_repeat", size=(5, 1), default_text="1", enable_events=True),
                             SG.Combo(values=["minute(s)", "hour(s)", "day(s)"], default_value="hour(s)", key="facebook_post_delay_type")]]

    layoutFacebook = [[SG.Button("HELP", key="help_facebook")],
                      [SG.HorizontalSeparator(color='black')],
                      [SG.Column(layoutFacebookColumn1, element_justification="left"),
                       SG.Column(layoutFacebookColumn2, element_justification="left")]]

    layoutTwitter = [[]]

    layout = [[SG.Exit("QUIT", key="quit")],
              [SG.TabGroup(
                  [[SG.Tab("Configuration", layoutConfig),
                    SG.Tab("Marketing Emails", layoutSendEmails),
                    SG.Tab("Facebook Marketing", layoutFacebook),
                    SG.Tab("Twitter Marketing", layoutTwitter)]])],
              [[SG.Text("Output")], [SG.Text(key="output", size=(132, 8))]]]
    #######################################################################################
    # END LAYOUTS
    #######################################################################################
    g_dictConfig["email_lists"]["email_files"] = arrayEmailFiles
    MainWindow = SG.Window(title="My E-Marketing", layout=layout, margins=(10, 10), size=(1000, 640))
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
            dictResults = Popup2xText(SG, "New Facebook Post", "File containing the post", "", True, (("Text Files", "*.txt"),("All Files", "*.*")), "Image file", "", True, (("JPEG Files", "*.jpg"), ("JPEG Files", "*.jpeg"), ("PNG Files", "*.png")))
            if dictResults["OK"]:
                DoSaveFacebookPost(dictResults["Text1"], dictResults["Text2"])
                arrayFacebookPostListbox = DoGetFacebookPostList(g_dictConfig["facebook"]["facebook_posts"])
                MainWindow["list_of_facebook_posts"].update(values=arrayFacebookPostListbox)
        elif strEvent == "delete_facebook_posts":
            arrayFacebookPostList = MainWindow["list_of_facebook_posts"].Values
            arraySelectedIndexes = MainWindow["list_of_facebook_posts"].get_indexes()
            for nI in range(0, len(arraySelectedIndexes)):
                arrayFacebookPostList.pop(arraySelectedIndexes[nI])
            MainWindow["list_of_facebook_posts"].update(values=arrayFacebookPostList)
            MainWindow["delete_facebook_posts"].update(disabled=True)
        elif strEvent == "list_of_facebook_posts":
            MainWindow["delete_facebook_posts"].update(disabled=False)
        elif strEvent == "save_facebook_groups":
            FacebookGroupListbox = MainWindow["list_of_facebook_groups"]
            arrayFacebookGroups = FacebookGroupListbox.Values
            g_dictConfig["facebook"]["facebook_groups"] = DoSaveFacebookGroupList(arrayFacebookGroups)
            DoSaveConfigFile()
        elif strEvent == "delete_facebook_group":
            arraySelectedIndexes = MainWindow["list_of_facebook_groups"].get_indexes()
            arrayListboxValues = MainWindow["list_of_facebook_groups"].Values
            for nI in range(0, len(arraySelectedIndexes)):
                arrayListboxValues.pop(arraySelectedIndexes[nI])
            MainWindow["list_of_facebook_groups"].update(values=arrayListboxValues)
            MainWindow["delete_facebook_group"].update(disabled=True)
        elif strEvent == "add_facebook_group":
            dictResults = Popup2xText(SG, "Enter new Facebook group", "Group Name", "", False, "", "URL", "https://www.facebook.com/groups/", False, "")
            if dictResults["OK"]:
                arrayListboxValues = MainWindow["list_of_facebook_groups"].Values
                g_dictConfig["facebook"]["facebook_groups"].append({"name": dictResults["Text1"], "url": dictResults["Text2"]})
                arrayListboxValues.append(dictResults["Text1"] + " (" + dictResults["Text2"] + ")")
                MainWindow["list_of_facebook_groups"].update(values=arrayListboxValues)
        elif strEvent == "list_of_facebook_groups":
            MainWindow["delete_facebook_group"].update(disabled=False)
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
            nMillisDelay = int(MainWindow["facebook_post_delay"].get())
            nSelectedIndex = MainWindow["facebook_post_delay_type"].Values.index(MainWindow["facebook_post_delay_type"].get())
            if nSelectedIndex == 0:
                nMillisDelay *= 60 * 1000
            elif nSelectedIndex == 1:
                nMillisDelay *= 60 * 60 * 1000
            elif nSelectedIndex == 2:
                nMillisDelay *= 24 * 60 * 60 * 1000
            nRepeat = int(MainWindow["facebook_post_repeat"].get())

            FacebookPostListbox = MainWindow["list_of_facebook_posts"]
            arraySelectedIndexes = FacebookPostListbox.get_indexes()
            arrayPosts = []
            if len(arraySelectedIndexes) > 0:
                for nI in arraySelectedIndexes:
                    arrayPosts.append(g_dictConfig["facebook"]["facebook_posts"][nI])
            else:
                arrayPosts = g_dictConfig["facebook"]["facebook_posts"]
            g_dictConfig["facebook"]["selected_facebook_posts"] = arrayPosts
            DoStartFacebookPosts(arrayPosts, nMillisDelay, nRepeat)
        elif strEvent == "help_facebook":
            strText = "XXXX"
            SG.popup(strText, title="HELP - With Facebook Posts")
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
