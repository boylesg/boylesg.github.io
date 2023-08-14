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

function WriteAsHTMLCode(arrayLinesHTML)
{
	for (let nI = 0; nI < arrayLinesHTML.length; nI++)
	{
		let strLineHTML = arrayLinesHTML[nI];
		strLineHTML = Replace(strLineHTML, " ", "&nbsp;&nbsp;");
		strLineHTML = Replace(strLineHTML, "<", "&lt;");
		strLineHTML = Replace(strLineHTML, ">", "&gt;");
		if (strLineHTML.indexOf("</script_>"))
			strLineHTML = strLineHTML.replace("</script_>", "</script>")
		document.write(strLineHTML + "<br/>");
	}
}


