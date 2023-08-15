//**********************************************************************************************************************
//**********************************************************************************************************************
//** GLOBAL VARIBALES
//**********************************************************************************************************************
//**********************************************************************************************************************

var g_arrayTOC = [];
var g_bCoursesPopupMenu = false;
var g_nStageNum = 1;




//**********************************************************************************************************************
//**********************************************************************************************************************
//** COMMON FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

function OnBodyLoad()
{
	if (sessionStorage["web_course"] && (sessionStorage["web_course"].length > 0))
	{
		DoLogin(sessionStorage["web_course"], "web_course");
	}
}

function GenerateTryItNow()
{
	var divTryItNowHTML = document.getElementById("TryItNowHTML"),
		strHTML = "";
	
	if (divTryItNowHTML)
	{
		strHTML = strHTML.innerHTML;
		document.write(strHTML);
	}
}

function GenerateGregsEmailAddress()
{
	var strEmailAddress = "gregplants" + "@" + "bigpond" + "." + "com";
	document.write("<a class=\"Email\" id=\"Email\" href=\"mailto: " + strEmailAddress + "\">" + strEmailAddress + "</a>");
}

function GenerateGregsMobile()
{
	var strMobile = "04" + "55" + "328" + "886";
	document.write(strMobile);
}

function SpaceGap(nNumberSpaces)
{
	for (var nI = 0; nI < nNumberSpaces; nI++)
		document.write("&nbsp;");
}

var g_nLevel = 0;
						
function BuildTOC(arrayTOC, g_nLevel)
{
	var strIndent = "", nI = 0;
	
	for (nI = 0; nI < g_nLevel; nI++)
		strIndent += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		
	for (nI = 0; nI < arrayTOC.length; nI++)
	{
		if (Array.isArray(arrayTOC[nI]))
		{
			BuildTOC(arrayTOC[nI], g_nLevel + 1);
		}
		else
		{
			document.write("<li class=\"TOCListItem\">&nbsp;&nbsp;" + strIndent + "<a class=\"TOCLink\" href=\"#" + arrayTOC[nI] + "\">" + arrayTOC[nI] + "</a></li>");
		}
	}
}

function MakeTOC(arrayTOC)
{
	if (arrayTOC.length > 0)
	{
		document.write("<ul id=\"TOCList\" class=\"TOCList\">");
		document.write("<hr class=\"TOCLine\"><h4 class=\"TOCHeading\">&nbsp;&nbsp;ON THIS PAGE</h4><hr class=\"TOCLine\">");
		BuildTOC(arrayTOC, g_nLevel);
		document.write("<hr class=\"TOCLine\"></ul>");
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** POPUP MENU FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

function DoToggleCoursesPopupMenu()
{
	var strPopupName = "Courses";

	if (document.getElementsByName(strPopupName) !== null)
	{
		if (g_bCoursesPopupMenu)
		{
			document.getElementsByName(strPopupName)[0].style.display = "none";
		}
		else
		{
			document.getElementsByName(strPopupName)[0].style.display = "block";
		}
		g_bCoursesPopupMenu = !g_bCoursesPopupMenu;
	}
	else
	{
		alert("No such object with name '" + strPopupName + "'!");
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** COURSE FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

var g_arrayStageBookmarks = [];
var g_nScore = 0;

function DoHighlightCurrentStageLink(strIDLink2Highlight, strIDLink2Unhighlight)
{
	let headingStage2Highlight = document.getElementById(strIDLink2Highlight);
	let headingStage2Unhighlight = document.getElementById(strIDLink2Unhighlight);
	
	if (headingStage2Highlight)
	{
		let strIDLink2Highlight = headingStage2Highlight.innerText;
		let link2Highlight = document.getElementById(strIDLink2Highlight);
		
		if (link2Highlight)
		{
			link2Highlight.style.backgroundColor = "#DDCC99";
			link2Highlight.style.color = "red";
		}
	}
	if (headingStage2Unhighlight)
	{
		let strIDLink2Unhighlight = headingStage2Unhighlight.innerText;
		let link2Unhighlight = document.getElementById(strIDLink2Unhighlight);
		
		if (link2Unhighlight)
		{
			link2Unhighlight.style.backgroundColor = "#CCBB88";
			link2Unhighlight.style.color = "navy";
		}
	}
}

function DoLogin(strTargetPassword, strCourseName)
{
	let inputPassword = document.getElementById("password");
	let divContent = document.getElementById("course_content");
	let divLogin = document.getElementById("login");
	let divContentHeader = document.getElementById("ContentHeader");
	
	if (inputPassword && divContent && divLogin)
	{
		if ((inputPassword.value === strTargetPassword) || ((sessionStorage[strCourseName]) && (sessionStorage[strCourseName].length > 0)))
		{
			divContent.style.display = "block";
			divLogin.style.display = "none";
			sessionStorage[strCourseName] = strTargetPassword;
			if (sessionStorage["current_stage"] && (sessionStorage["current_stage"].length > 0))
			{
				//console.log("sessionStorage['current_stage'] = " + sessionStorage["current_stage"]);
				document.getElementById(sessionStorage["current_stage"]).style.display = "block";
			}
			else if (document.getElementById('Stage1'))
			{
				//console.log("document.getElementById('Stage1') = " + document.getElementById("Stage1"));
				document.getElementById("Stage1").style.display = "block";
			}
			divContentHeader.style.display = "block";
			
			if (!sessionStorage["current_stage"] || (sessionStorage["current_stage"].length == 0))
				sessionStorage["current_stage"] = "Stage1";
								
			DoHighlightCurrentStageLink(sessionStorage["current_stage"] + "Heading", "");
		}
	}
}

function DoShowHide(strIDDiv2Show, strIDDiv2Hide)
{
	var div2Hide = document.getElementById(strIDDiv2Hide),
		div2Show = document.getElementById(strIDDiv2Show),
		strIDLink2Highlight = "", 
		strIDLink2Unhighlight = "";

	if (div2Hide)
	{
		div2Hide.style.display = "none";
		strIDLink2Unhighlight = strIDDiv2Hide + "Heading";
	}
	else
	{
		strIDLink2Unhighlight = "Stage1Heading";
	}
	if (div2Show)
	{
		div2Show.style.display = "block";
		sessionStorage["previous_stage"] = sessionStorage["current_stage"];
		sessionStorage["current_stage"] = strIDDiv2Show;
		strIDLink2Highlight = strIDDiv2Show + "Heading";
		//alert(sessionStorage["current_stage"]);
	}
	DoHighlightCurrentStageLink(strIDLink2Highlight, strIDLink2Unhighlight);
}

function DrawFirstStageButtons(strStartPage, nStageNum)
{
	g_nStageNum++;
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"document.location='" + strStartPage + "'\">&lt; PREVIOUS</button>&nbsp;");
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage2', 'Stage1')\">NEXT &gt;</button>");
	
	return nStageNum + 1;
}

function DrawLastStageButtons(nStageNum)
{	
	nStageNum--;
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage" + nStageNum.toString() + "', 'Stage" + (nStageNum - 1).toString() + "')\">&lt; PREVIOUS</button>");
	
	return nStageNum + 1;
}

function DrawMidStageButtons(nStageNum)
{
	let nNextStageNum = nStageNum + 1;
	let nPrevStageNum = nStageNum - 1;

	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage" + nPrevStageNum.toString() + "', 'Stage" + nStageNum.toString() + "')\">&lt; PREVIOUS</button>&nbsp;");
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage" + nNextStageNum.toString() + "', 'Stage" + nStageNum.toString() + "')\">NEXT &gt;</button>");
	
	return nStageNum + 1;
}

function OnClickStageLink(strIDStageDiv2Show)
{
	DoShowHide(strIDStageDiv2Show, sessionStorage["current_stage"]);
}

function GenerateStageMenu()
{
	let divContentHeader = document.getElementById("ContentHeader");
	let divCourseContent = document.getElementById("course_content");

	if (divContentHeader && divCourseContent)
	{
		console.log(g_arrayStageBookmarks);
		divContentHeader.style.display = divCourseContent.style.display;
		for (let nI = 0; nI < g_arrayStageBookmarks.length; nI++)
		{
			divContentHeader.innerHTML += g_arrayStageBookmarks[nI];
		}
	}
}

function SetStageDivIDs(strStageLinkID)
{
	const divCourseContent = document.getElementById("course_content");
	
	if (divCourseContent)
	{
		let strTagName = "";
		
		for (let nI = 0; nI < divCourseContent.children.length; nI++)
		{
			strTagName = divCourseContent.children[nI].tagName;
			if (strTagName == "DIV")
			{
				divCourseContent.children[nI].id = "Stage" + (nI + 1).toString();
				
				for (let nJ = 0; nJ < divCourseContent.children[nI].children.length; nJ++)
				{
					strTagName = divCourseContent.children[nI].children[nJ].tagName;
					if (strTagName == "H2")
					{
						divCourseContent.children[nI].children[nJ].id = "Stage" + (nI + 1).toString() + "Heading";
						g_arrayStageBookmarks.push("<a href=\"#\" class=\"StageLink\" id=\"" + 
																	divCourseContent.children[nI].children[nJ].innerText +
																	"\" onclick=\"OnClickStageLink('" +
																	divCourseContent.children[nI].id + "') \">" + 
																	divCourseContent.children[nI].children[nJ].innerText + "</a>");
						break;
					}
				}
			}
		}
		GenerateStageMenu();
	}
}

function WriteAsHTMLTags(arrayLinesHTML)
{
	for (let nI = 0; nI < arrayLinesHTML.length; nI++)
	{
		document.write(arrayLinesHTML[nI]);
	}
}

function Replace(strText, strReplaceWhat, strReplaceWith)
{
	let nI = strText.indexOf(strReplaceWhat);
	
	while (nI > -1)
	{
		strText = strText.replace(strReplaceWhat, strReplaceWith);
		nI = strText.indexOf(strReplaceWhat);
	}
	return strText;
}

function GetAsHTMLCode(arrayLinesHTML)
{
	let strHTMLCode = "", strLineHTML = "";
	
	for (let nI = 0; nI < arrayLinesHTML.length; nI++)
	{
		strLineHTML = arrayLinesHTML[nI];
		strLineHTML = Replace(strLineHTML, " ", "&nbsp;&nbsp;");
		strLineHTML = Replace(strLineHTML, "<", "&lt;");
		strLineHTML = Replace(strLineHTML, ">", "&gt;");
		if (strLineHTML.indexOf("</script_>"))
			strLineHTML = strLineHTML.replace("</script_>", "</script>")
		strHTMLCode += strLineHTML;
	}
	return strHTMLCode;
}

function WriteAsHTMLCode(arrayLinesHTML)
{
	document.write(GetAsHTMLCode(arrayLinesHTML) + "<br/>");
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** TEST YOURSELF FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

let g_arrayQuestions = [];

function OnClickSubmitAnswers(g_arrayQuestions)
{
	let divAnswers = document.getElementById("Answers");
	
	if (divAnswers)
	{
		GenerateAnswers(g_arrayQuestions);
		divAnswers.style.display = "block";
	}
}

function GetTryItNowCode(nQuestionNum)
{
	let divTryItNow = document.getElementById("TryItNowHTML");
	let strTryItNowCode = "";
	
	if (divTryItNow)
	{
		strTryItNowCode = divTryItNow.innerHTML;
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowCode", "id=\"TryItNowCode" + nQuestionNum.toString());
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowResults", "id=\"TryItNowResults" + nQuestionNum.toString());
		strTryItNowCode = strTryItNowCode.replace("OnClickButtonRun()", "OnClickButtonRun(" + nQuestionNum.toString() + ")");
		g_arrayQuestions[nQuestionNum].strID = "TryItNowCode" + nQuestionNum.toString();
	}
	return strTryItNowCode;
}

function GenerateQuestions(g_arrayQuestions)
{
	let strButton = "";
		
	document.write("<ol>");
	for (let nI = 0; nI < g_arrayQuestions.length; nI++)
	{
		document.write("<li><b>" + g_arrayQuestions[nI].strQuestion + "</b></li>");
		if (g_arrayQuestions[nI].strType == "code")
		{
			document.write(GetTryItNowCode(nI));
		}
		else if (g_arrayQuestions[nI].strType == "multiple")
		{
			document.write("<p>");
			let strChecked = " checked";
			for (let nJ = 0; nJ < g_arrayQuestions[nI].arrayOptions.length; nJ++)
			{
				let strText = "<input type=\"radio\" name=\"Option\" id=\"Question" + nI.toString() + "_" + nJ.toString() + 
					"\"" + strChecked + "\">" + 
					"<label for=\"Question" + nI.toString() + "_" + nJ.toString() + "\">" + g_arrayQuestions[nI].arrayOptions[nJ] + 
					"</label><br/>";
				document.write(strText);
				strChecked = "";
			}
			g_arrayQuestions[nI].strID = "Question" + nI.toString();
		}
		document.write("<br/>");
	}
	document.write("</ol><br/><input type=\"button\" value=\"SUBMIT ANSWERS\" onclick=\"OnClickSubmitAnswers(g_arrayQuestions)\">");
}

function GetYourAnswer(nQuestionNum, structQuestion)
{
	let strAnswer = "";
	let strID = "";
	let input = null;
	
	if (structQuestion.strType == "code")
	{
		input = document.getElementById(structQuestion.strID);
		if (input)
		{
			strAnswer = input.value;
		}
		else
		{
			strAnswer = "Input with ID '" + structQuestion.strID + "' not found!";
		}
	}
	else if (structQuestion.strType == "multiple")
	{
		for (let nI = 0; nI < structQuestion.arrayOptions.length; nI++)
		{
			strID = "Question" + nQuestionNum.toString() + "_" + nI.toString();
			input = document.getElementById(strID);
			if (input && input.checked)
			{
				strAnswer = structQuestion.arrayOptions[nI];
			}
		}
	}
	return strAnswer;
}

function GetTickOrCross(structQuestion)
{
	let strHTML = "<img src=\"images/Cross.png\" alt=\"images/Cross.png\" width=\"20\" style=\"position:relative;top:5px;padding-left:20px;\">";
	let strHTMLTick = "<img src=\"images/Tick.png\" alt=\"images/Tick.png\" width=\"20\" style=\"position:relative;top:5px;padding-left:20px;\">";
	
	if (structQuestion.strType == "code")
	{
		let nLastIndex = -1, nCurrentIndex = 0, nMaxIndex = 0, bValid = true;
		
		for (let nI = 0; nI < structQuestion.arrayCorrectParts.length; nI++)
		{
			if (Array.isArray(structQuestion.arrayCorrectParts[nI]))
			{
				for (let nJ = 0; nJ < structQuestion.arrayCorrectParts[nI].length; nJ++)
				{
					nCurrentIndex = structQuestion.strAnswer.indexOf(structQuestion.arrayCorrectParts[nI][nJ]);
					if (nCurrentIndex > nLastIndex)
					{
						if (nCurrentIndex > nMaxIndex)
							nMaxIndex = nCurrentIndex;
					}
					else
					{
						bValid = false;
						break;
					}
				}
				if (!bValid)
				{
					break;
				}
				else
				{
					nLastIndex = nMaxIndex;
				}
			}
			else
			{
				nCurrentIndex = structQuestion.strAnswer.indexOf(structQuestion.arrayCorrectParts[nI], nLastIndex);
				if (nCurrentIndex > nLastIndex)
				{
					nLastIndex = nCurrentIndex;
				}
				else
				{
					bValid = false;
					break;
				}
			}
		}
		if (bValid)
		{
			strHTML = strHTMLTick;
			g_nScore++;
		}
	}
	else if (structQuestion.strType == "multiple")
	{
		if (structQuestion.strAnswer == structQuestion.arrayOptions[structQuestion.nCorrectOption])
		{
			strHTML = strHTMLTick;
			g_nScore++;
		}
	}
	return strHTML;
}

function GenerateAnswers(g_arrayQuestions)
{
	let divAnswers = document.getElementById("Answers");
	let strAnswers = "<p><h3><u>CORRECT ANSWERS</u></h3>";
	
	if (divAnswers)
	{
		for (let nI = 0; nI < g_arrayQuestions.length; nI++)
		{
			strAnswers += "<b>" + (nI + 1).toString() + ". </b>";
			if (g_arrayQuestions[nI].strType == "code")
			{
				strAnswers += GetAsHTMLCode([g_arrayQuestions[nI].strCorrectAnswer]) + "<br/><br/>";
			}
			else if (g_arrayQuestions[nI].strType == "multiple")
			{
				strAnswers += g_arrayQuestions[nI].arrayOptions[g_arrayQuestions[nI].nCorrectOption] + "<br/><br/>";
			}
			g_arrayQuestions[nI].strAnswer = GetYourAnswer(nI, g_arrayQuestions[nI]);
			strAnswers += "<b style=\"color:red;\">YOUR ANSWER: </b>" + GetAsHTMLCode(g_arrayQuestions[nI].strAnswer) + 
						GetTickOrCross(g_arrayQuestions[nI]) + "<br/><br/><hr><br/>";
		}
		strAnswers += "<p><b style=\"color:red;\">YOUR SCORE: </b><b>" + g_nScore.toString() + " / " + g_arrayQuestions.length.toString() + "</b> or <b>" + ((g_nScore * 100)/ g_arrayQuestions.length).toString() + "%</b></p>";
		divAnswers.innerHTML = strAnswers + "</p>";
		g_nScore = 0;
	}
}

function OnClickButtonRun(nQuestionNum)
{
	let textareaTryItNowCode = document.getElementById("TryItNowCode" + nQuestionNum.toString());
	let iframeTryItNowResults = document.getElementById("TryItNowResults" + nQuestionNum.toString());
	
	if (textareaTryItNowCode && iframeTryItNowResults)
	{
		g_arrayQuestions[nQuestionNum].strAnswer = textareaTryItNowCode.value;
		iframeTryItNowResults.srcdoc = textareaTryItNowCode.value;
	}
}


