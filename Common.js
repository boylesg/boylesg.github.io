//**********************************************************************************************************************
//**********************************************************************************************************************
//** GLOBAL VARIBALES
//**********************************************************************************************************************
//**********************************************************************************************************************

var g_arrayTOC = [];
var g_bCoursesPopupMenu = false;




//**********************************************************************************************************************
//**********************************************************************************************************************
//** COMMON FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

function OnBodyLoad()
{
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

function DoLogin(strTargetPassword, strCourseName)
{
	let inputPassword = document.getElementById("password");
	let divContent = document.getElementById("course_content");
	let divLogin = document.getElementById("login");

	if (inputPassword && divContent && divLogin)
	{
		if ((inputPassword.value === strTargetPassword) || ((sessionStorage[strCourseName]) && (sessionStorage[strCourseName].length > 0)))
		{
			divContent.style.display = "block";
			divLogin.style.display = "none";
			sessionStorage[strCourseName] = strTargetPassword;
		}
	}
}

function DoShowHide(strIDDiv2Hide, strIDDiv2Show)
{
	var div2Hide = document.getElementById(strIDDiv2Hide),
		div2Show = document.getElementById(strIDDiv2Show);
		
	if (div2Hide)
	{
		div2Hide.style.display = "none";
	}
	if (div2Show)
	{
		div2Show.style.display = "block";
		sessionStorage["current_stage"] = strIDDiv2Show;
		//alert(sessionStorage["current_stage"]);
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
