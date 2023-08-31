//**********************************************************************************************************************
//**********************************************************************************************************************
//** INFO POPUPS 
//**********************************************************************************************************************
//**********************************************************************************************************************


let g_mapDialogs = new Map();

function DoOpenInfoPopup(strID, strWebPage)
{
	let strHTML = "<iframe id=\"info_popup_iframe_" + strID + "\" class=\"info_popup_iframe\" src=\"" + 
					strWebPage + "\"></iframe><br/><br/>" +
					"<input type=\"button\" id=\"CloseButton\" value=\"CLOSE\" style=\"width:80px;\" " + 
					"\" onclick=\"DoCloseInfoPopup(this.parentNode)\"/>";
	let nDelta = 20, nLeft = 0, nTop = 0;

	if (!g_mapDialogs.has(strID))
	{
		let dialog = document.createElement("dialog");
		dialog.id = "info_popup_" + strID;
		dialog.innerHTML = strHTML;
		dialog.className = "info_popup_container";
		document.body.appendChild(dialog);
		
		if (g_mapDialogs.size > 0)
		{
			let element = Array.from(g_mapDialogs.values()).pop();
			nLeft = element.clientLeft; 
			nTop = element.clientTop;
			dialog.style.left = (nLeft + nDelta).toString() + "px";
			dialog.style.top = (nTop + nDelta).toString() + "px";
		}
		g_mapDialogs.set(strID, dialog);			
		dialog.style.display = "block";
	}
}

function DoCloseInfoPopup(dialogPopupContainer)
{
	if (dialogPopupContainer)
	{
		let strID = dialogPopupContainer.id;
		strID = strID.replace("info_popup_", "");
		g_mapDialogs.delete(strID);
		dialogPopupContainer.remove();
	}
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

function GetTryItNowCode(nQuestionNum, strCode)
{
	let divTryItNow = document.getElementById("TryItNowHTML");
	let strTryItNowCode = "";
	
	if (divTryItNow)
	{
		strTryItNowCode = divTryItNow.innerHTML;
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowCode", "id=\"TryItNowCode" + nQuestionNum.toString());
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowResults", "id=\"TryItNowResults" + nQuestionNum.toString());
		strTryItNowCode = strTryItNowCode.replace("OnClickButtonRun()", "OnClickButtonRun(" + nQuestionNum.toString() + ")");
		if (strCode)
			strTryItNowCode = strTryItNowCode.replace("XXXX", strCode);
		else
			strTryItNowCode = strTryItNowCode.replace("XXXX", "");
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
		document.write("<li><b>" + GetAsHTMLCode([g_arrayQuestions[nI].strQuestion]) + "</b></li>");
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
					"<label for=\"Question" + nI.toString() + "_" + nJ.toString() + "\">" + GetAsHTMLCode([g_arrayQuestions[nI].arrayOptions[nJ]]) + 
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
		/*
			name=" id=""
			name=X" id="!"
			name=X" id="! 
			
			letters, digits, hyphens, underscores, colons and periods.
			- _ : .
		*/
		bValid  = structQuestion.strAnswer.indexOf("=\" ") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"~") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"`") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"!") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"@") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"#") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"$") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"%") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"^") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"&") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"*") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"(") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\")") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"=") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"+") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"{") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"[") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"}") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"]") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"|") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"\\") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\";") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"'") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"?") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"<") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\",") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\">") == -1;
		
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
		strAnswers += "<p><b style=\"color:red;\">YOUR SCORE: </b><b>" + g_nScore.toString() + " / " + 
			g_arrayQuestions.length.toString() + "</b> or <b>" + ((g_nScore * 100)/ g_arrayQuestions.length).toString() + 
			"%</b></p>";
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

function SetPaymentLevel()
{
	let strCountry = GetUserCountry();
	
	if ((strCountry == "United States") || (strCountry == "Canada") || (strCountry == "Antarctica") || (strCountry == "Australia") || 
		(strCountry == "Switzerland") || (strCountry == "Germany") || (strCountry == "Christmas Island") || (strCountry == "Denmark") || 
		(strCountry == "Spain") || (strCountry == "Finland") || (strCountry == "Falkland Islands") || (strCountry == "France") || 
		(strCountry == "Britain (UK)") || (strCountry == "Gibraltar") || (strCountry == "Greenland") || (strCountry == "Ireland") || 
		(strCountry == "Israel") || (strCountry == "Iceland") || (strCountry == "Italy") || (strCountry == "Japan") || 
		(strCountry == "Korea (South)") || (strCountry == "Luxembourg") || (strCountry == "Norfolk Island") || 
		(strCountry == "Netherlands") || (strCountry == "Norway") || (strCountry == "New Zealand") || (strCountry == "Poland") || 
		(strCountry == "Portugal") || (strCountry == "Sweden") || (strCountry == "`") || (strCountry == "Vatican City") || 
		(strCountry == "Saudi Arabia") || (strCountry == "Taiwan") || (strCountry == "Belgium") || (strCountry == "Bulgaria") || 
		(strCountry == "Bermuda") || (strCountry == "Cyprus") || (strCountry == "Czech Republic") || (strCountry == "Estonia") || 
		(strCountry == "Micronesia") || (strCountry == "Greece") || (strCountry == "Guam") || (strCountry == "Kiribati") || 
		(strCountry == "Lithuania") || (strCountry == "Latvia") || (strCountry == "Monaco") || (strCountry == "Marshall Islands") || 
		(strCountry == "Malta") || (strCountry == "Panama") || (strCountry == "Pitcairn") || (strCountry == "Puerto Rico") || 
		(strCountry == "Palau") || (strCountry == "Paraguay") || (strCountry == "Réunion") || (strCountry == "Turkey") || 
		(strCountry == "US minor outlying islands") || (strCountry == "osnia & Herzegovina") || (strCountry == "Bahrain") || 
		(strCountry == "Benin") || (strCountry == "St Barthelemy") || (strCountry == "Bahamas") || (strCountry == "Guernsey") || 
		(strCountry == "Croatia") || (strCountry == "Guadeloupe") || (strCountry == "Isle of Man") || (strCountry == "Kuwait") || 
		(strCountry == "Cayman Islands") || (strCountry == "Liechtenstein") || (strCountry == "Montenegro") || 
		(strCountry == "St Martin (French)") || (strCountry == "Northern Mariana Islands") || (strCountry == "Oman") || 
		(strCountry == "St Helena") || (strCountry == "Slovenia") || (strCountry == "Svalbard & Jan Mayen") || 
		(strCountry == "Slovakia") || (strCountry == "San Marino") || (strCountry == "St Maarten (Dutch)") ||
		(strCountry.indexOf("Virgin Islands") > -1) || (strCountry == "Mayotte"))
	{
		document.getElementById("TenDollarCountry").style.display = "block";
	}
	else if ((strCountry == "Brazil") || (strCountry == "China") || (strCountry == "Fiji") || (strCountry == "Georgia") || 
			(strCountry == "Hong Kong") || (strCountry == "Malaysia") || (strCountry == "Peru") || (strCountry == "St Pierre & Miquelon") || 
			(strCountry == "Qatar") || (strCountry == "Solomon Islands") || (strCountry == "Seychelles") || (strCountry == "Tuvalu") || 
			(strCountry == "Dominica") || (strCountry == "Grenada") || (strCountry == "St Lucia") || (strCountry == "Montserrat"))
	{
		document.getElementById("FiveDollarCountry").style.display = "block";
	}
	else if ((strCountry == "Egypt") || (strCountry == "Cuba") || (strCountry == "Moldova") || (strCountry == "Mauritius") || 
				(strCountry == "Maldives") || (strCountry == "Mexico") || (strCountry == "Thailand") || (strCountry == "Ukraine") || 
				(strCountry == "Uruguay") || (strCountry == "Venezuela") || (strCountry == "South Africa") || 
				(strCountry == "Botswana") || (strCountry == "North Macedonia") || (strCountry == "Mauritania"))
	{
		document.getElementById("OneDollarCountry").style.display = "block";
	}
	else
	{
		document.getElementById("FiftyCentCountry").style.display = "block";
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
				let divStage = document.getElementById(sessionStorage["current_stage"]);
				if (!divStage)
				{
					sessionStorage["current_stage"] = "Stage1";
					divStage = document.getElementById(sessionStorage["current_stage"]);
				}
				divStage.style.display = "block";
					
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

function DrawLastStageButtons(strNextPage, nStageNum)
{	
	nStageNum--;
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage" + nStageNum.toString() + "', 'Stage" + (nStageNum - 1).toString() + "')\">&lt; PREVIOUS</button>");
	if (strNextPage.length > 0)
		document.write("&nbsp;<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"document.location='" + strNextPage+ "'\">NEXT &gt;</button>&nbsp;");
	
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
		//g_arrayStageBookmarks = [];
		
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

function GetAsHTMLTags(arrayLinesHTML)
{
	let strHTML = "";
	
	for (let nI = 0; nI < arrayLinesHTML.length; nI++)
	{
		strHTML += arrayLinesHTML[nI];
	}
	return strHTML;
}

function WriteAsHTMLTags(arrayLinesHTML)
{
	document.write(GetAsHTMLTags(arrayLinesHTML));
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
		strLineHTML = Replace(strLineHTML, "\n", "<br/>");
		if (strLineHTML.indexOf("</script_>") > -1)
			strLineHTML = strLineHTML.replace("</script_>", "</script>")
		strHTMLCode += strLineHTML + "<br/>";
	}
	return strHTMLCode;
}

function WriteAsHTMLCode(arrayLinesHTML)
{
	document.write(GetAsHTMLCode(arrayLinesHTML) + "<br/>");
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** TRY IT NOW 
//**********************************************************************************************************************
//**********************************************************************************************************************

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

function OnClickButtonRunIDs(strIDTextArea, strIDFrame)
{
	let textareaTryItNowCode = document.getElementById(strIDTextArea);
	let iframeTryItNowResults = document.getElementById(strIDFrame);
	
	if (textareaTryItNowCode && iframeTryItNowResults)
	{
		iframeTryItNowResults.srcdoc = textareaTryItNowCode.value;
	}
}

function GetTryItNowCode_(nI, strRunCode, strAddOnCode)
{
	let divTryItNow = document.getElementById("TryItNowHTML");
	let strTryItNowCode = "";
	
	if (divTryItNow)
	{
		strTryItNowCode = divTryItNow.innerHTML;
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowCode", "id=\"TryItNowCode" + nI.toString());
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowResults", "id=\"TryItNowResults" + nI.toString());
		strTryItNowCode = strTryItNowCode.replace("OnClickButtonRun()", "OnClickButtonRunIDs('TryItNowCode" + nI.toString() + "', 'TryItNowResults" + nI.toString() + "')");
		if (strRunCode)
			strTryItNowCode = strTryItNowCode.replace("XXXX", strRunCode);
		else
			strTryItNowCode = strTryItNowCode.replace("XXXX", "");
			
		if (strAddOnCode)
			strTryItNowCode = strTryItNowCode.replace("ADD_ON_CODE", strAddOnCode);
		else
			strTryItNowCode = strTryItNowCode.replace("ADD_ON_CODE", "");
	}
	return strTryItNowCode;
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** BACKGROUND COLOR TRY IT NOW 
//**********************************************************************************************************************
//**********************************************************************************************************************

let g_bTargetIsBG = true;

function OnClickRadioTarget(radioTarget)
{
	if (radioTarget)
	{
		g_bTargetIsBG = radioTarget.id == "color_target_background";
	}
}

function OnClickRadioColor(inputRadio, textareaCode, iframeResults)
{
	if (inputRadio && textareaCode && iframeResults)
	{
		let strCode = textareaCode.value,
			nPos1 = -1,
			nPos2 = -1,
			nPos3 = -1;
			
		if (g_bTargetIsBG)
		{
			nPos1 = strCode.indexOf("background-color");
			
			if (nPos1 > -1)
			{
				nPos2 = strCode.indexOf(";", nPos1);
				if (nPos2 > -1)
				{
					strCode = strCode.slice(0, nPos1) + inputRadio.value + strCode.slice(nPos2, strCode.length);
					textareaCode.value = strCode;
					iframeResults.srcdoc = strCode;
				}
			}
		}
		else
		{
			nPos1 = strCode.indexOf("\"color");
			if (nPos1 == -1)
				nPos1 = strCode.indexOf(";color");
			
			if (nPos1 > -1)
			{
				nPos2 = strCode.indexOf(";", nPos1 + 1);
				if (nPos2 > -1)
				{
					nPos3 = inputRadio.value.indexOf("-");
					strCode = strCode.slice(0, nPos1 + 1) + inputRadio.value.slice(nPos3 + 1) + strCode.slice(nPos2, strCode.length);
					textareaCode.value = strCode;
					iframeResults.srcdoc = strCode;
				}
			}
		}
	}
}

function OnClickRadioColorRGB_HSL_HEX(inputRadio, textareaCode, iframeResults)
{
	// Enable and disable number fields
	let numberRGBRed = document.getElementById("text-color-RGB-red"),
		numberRGBGreen = document.getElementById("text-color-RGB-green"),
		numberRGBBlue = document.getElementById("text-color-RGB-blue"),
		numberRGBOpacity = document.getElementById("text-color-RGB-opacity"),
		numberHSLHue = document.getElementById("text-color-HSL-hue"),
		numberHSLSaturation = document.getElementById("text-color-HSL-saturation"),
		numberHSLLightness = document.getElementById("text-color-HSL-lightness"),
		numberHSLOpacity = document.getElementById("text-color-HSL-opacity"),
		numberHEXRed = document.getElementById("text-color-HEX-red"),
		numberHEXGreen = document.getElementById("text-color-HEX-green"),
		numberHEXBlue = document.getElementById("text-color-HEX-blue");
		
	if (numberRGBRed && numberRGBGreen && numberRGBBlue && numberRGBOpacity && 
		numberHSLHue && numberHSLSaturation && numberHSLLightness && numberHSLOpacity &&
		numberHEXRed && numberHEXGreen && numberHEXBlue && inputRadio && textareaCode && iframeResults)
	{
		numberRGBRed.disabled = inputRadio.id.indexOf("radio-color-rgb") == -1;
		numberRGBGreen.disabled = inputRadio.id.indexOf("radio-color-rgb") == -1;
		numberRGBBlue.disabled = inputRadio.id.indexOf("radio-color-rgb") == -1;
		numberRGBOpacity.disabled = inputRadio.id != "radio-color-rgba";

		numberHSLHue.disabled = inputRadio.id.indexOf("radio-color-hsl") == -1;
		numberHSLSaturation.disabled = inputRadio.id.indexOf("radio-color-hsl") == -1;
		numberHSLLightness.disabled = inputRadio.id.indexOf("radio-color-hsl") == -1;
		numberHSLOpacity.disabled = inputRadio.id != "radio-color-hsla";

		numberHEXRed.disabled = inputRadio.id.indexOf("radio-color-hex") == -1;
		numberHEXGreen.disabled = inputRadio.id.indexOf("radio-color-hex") == -1;
		numberHEXBlue.disabled = inputRadio.id.indexOf("radio-color-hex") == -1;
	}
	OnClickRadioColor(inputRadio, textareaCode, iframeResults);
}

function ReplaceInt(nIntNum, strCode, nNewIntVal, bIsHex, strAddOn)
{
	let nPos1 = -1, nPos2 = -1,
		strPadding = "";
	
	if (bIsHex)
	{
		if (nNewIntVal <= 15)
			strPadding = "0";
			
		nPos1 = strCode.indexOf("#") + (nIntNum * 2);
		nPos2 = nPos1 + 2;
		strCode = strCode.slice(0, nPos1 + 1) + strPadding + nNewIntVal.toString(16) + strCode.slice(nPos2 + 1, strCode.length);
	}
	else
	{
		nPos1 = strCode.indexOf("(");
		nPos2 = strCode.indexOf(",", nPos1);

		for (let nI = 0; nI < nIntNum; nI++)
		{
			nPos1 = nPos2;
			nPos2 = strCode.indexOf(",", nPos1 + 1);
		}
		if (nPos2 < -1)
			nPos2 = strCode.indexOf(")");
		
		if (nIntNum == 3)
			nNewIntVal /= 10;
		strCode = strCode.slice(0, nPos1 + 1) + nNewIntVal.toString() + strAddOn + strCode.slice(nPos2, strCode.length)
	}
	return strCode;
}

function OnChangeRGBRed(inputNumber, inputRadioRGB, inputRadioRGBA, textareaCode, iframeResults)
{
	if (inputRadioRGB && inputRadioRGBA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioRGB.checked)
		{
			strCode = inputRadioRGB.value;
			inputRadio = inputRadioRGB;
		}
		else if (inputRadioRGBA.checked)
		{
			strCode = inputRadioRGBA.value;
			inputRadio = inputRadioRGBA;
		}
		strCode = ReplaceInt(0, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeRGBGreen(inputNumber, inputRadioRGB, inputRadioRGBA, textareaCode, iframeResults)
{
	if (inputRadioRGB && inputRadioRGBA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioRGB.checked)
		{
			strCode = inputRadioRGB.value;
			inputRadio = inputRadioRGB;
		}
		else if (inputRadioRGBA.checked)
		{
			strCode = inputRadioRGBA.value;
			inputRadio = inputRadioRGBA;
		}
		strCode = ReplaceInt(1, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeRGBBlue(inputNumber, inputRadioRGB, inputRadioRGBA, textareaCode, iframeResults)
{
	if (inputRadioRGB && inputRadioRGBA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioRGB.checked)
		{
			strCode = inputRadioRGB.value;
			inputRadio = inputRadioRGB;
		}
		else if (inputRadioRGBA.checked)
		{
			strCode = inputRadioRGBA.value;
			inputRadio = inputRadioRGBA;
		}
		strCode = ReplaceInt(2, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeRGBOpacity(inputNumber, inputRadioRGB, inputRadioRGBA, textareaCode, iframeResults)
{
	if (inputRadioRGB && inputRadioRGBA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioRGB.checked)
		{
			strCode = inputRadioRGB.value;
			inputRadio = inputRadioRGB;
		}
		else if (inputRadioRGBA.checked)
		{
			strCode = inputRadioRGBA.value;
			inputRadio = inputRadioRGBA;
		}
		strCode = ReplaceInt(3, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHSLHue(inputNumber, inputRadioHSL, inputRadioHSLA, textareaCode, iframeResults)
{
	if (inputRadioHSL && inputRadioHSLA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioHSL.checked)
		{
			strCode = inputRadioHSL.value;
			inputRadio = inputRadioHSL;
		}
		else if (inputRadioHSLA.checked)
		{
			strCode = inputRadioHSLA.value;
			inputRadio = inputRadioHSLA;
		}
		strCode = ReplaceInt(0, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHSLSaturation(inputNumber, inputRadioHSL, inputRadioHSLA, textareaCode, iframeResults)
{
	if (inputRadioHSL && inputRadioHSLA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioHSL.checked)
		{
			strCode = inputRadioHSL.value;
			inputRadio = inputRadioHSL;
		}
		else if (inputRadioHSLA.checked)
		{
			strCode = inputRadioHSLA.value;
			inputRadio = inputRadioHSLA;
		}
		strCode = ReplaceInt(1, strCode, Number(inputNumber.value), false, "%");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHSLLightness(inputNumber, inputRadioHSL, inputRadioHSLA, textareaCode, iframeResults)
{
	if (inputRadioHSL && inputRadioHSLA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioHSL.checked)
		{
			strCode = inputRadioHSL.value;
			inputRadio = inputRadioHSL;
		}
		else if (inputRadioHSLA.checked)
		{
			strCode = inputRadioHSLA.value;
			inputRadio = inputRadioHSLA;
		}
		strCode = ReplaceInt(2, strCode, Number(inputNumber.value), false, "%");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHSLOpacity(inputNumber, inputRadioHSL, inputRadioHSLA, textareaCode, iframeResults)
{
	if (inputRadioHSL && inputRadioHSLA && textareaCode && iframeResults)
	{
		let strCode = "",
			inputRadio = null;
		
		if (inputRadioHSL.checked)
		{
			strCode = inputRadioHSL.value;
			inputRadio = inputRadioHSL;
		}
		else if (inputRadioHSLA.checked)
		{
			strCode = inputRadioHSLA.value;
			inputRadio = inputRadioHSLA;
		}
		strCode = ReplaceInt(3, strCode, Number(inputNumber.value), false, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHEXRed(inputNumber, inputRadio, textareaCode, iframeResults)
{
	if (inputNumber && inputRadio && textareaCode && iframeResults)
	{
		let strCode = inputRadio.value;
		strCode = ReplaceInt(0, strCode, Number(inputNumber.value), true, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHEXGreen(inputNumber, inputRadio, textareaCode, iframeResults)
{
	if (inputNumber && inputRadio && textareaCode && iframeResults)
	{
		let strCode = inputRadio.value;
		strCode = ReplaceInt(1, strCode, Number(inputNumber.value), true, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeHEXBlue(inputNumber, inputRadio, textareaCode, iframeResults)
{
	if (inputNumber && inputRadio && textareaCode && iframeResults)
	{
		let strCode = inputRadio.value;
		strCode = ReplaceInt(2, strCode, Number(inputNumber.value), true, "");
		inputRadio.value = strCode;
		OnClickRadioColor(inputRadio, textareaCode, iframeResults);
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** BACKGROUND IMAGE TRY IT NOW
//**********************************************************************************************************************
//**********************************************************************************************************************

function OnClickRadioBackgroundImg(inputRadioButton, textareaCode, iframeResults)
{
	if (textareaCode)
	{
		let strValue = inputRadioButton.value,
			strCode = textareaCode.value,
			nPos1 = -1, nPos2 = -1,
			strLeft = "", strRight = "";
		
		// Update the code in the text area.
		if (strValue.search("background-repeat") > -1)
		{
			nPos1 = strCode.indexOf("background-repeat");
		}
		else if (strValue.search("background-repeat") > -1)
		{
			nPos1 = strCode.indexOf("background-repeat");
		}
		else if (strValue.search("background-position") > -1)
		{
			nPos1 = strCode.indexOf("background-position");
		}
		else if (strValue.search("background-size") > -1)
		{
			nPos1 = strCode.indexOf("background-size");
		}
		else if (strValue.search("background-origin") > -1)
		{
			nPos1 = strCode.indexOf("background-origin");
		}
		nPos2 = strCode.indexOf(";", nPos1);
		strLeft = strCode.slice(0, nPos1);
		strRight = strCode.slice(nPos2 + 1, strCode.length);
		strCode = strLeft + strValue + strRight;
		textareaCode.value = strCode;
		OnClickButtonRunIDs(textareaCode.id, iframeResults.id);

		// Enable and disable number fields according to which radio button is checked.
		if (inputRadioButton.id == "radio-background-position-xy-percentage")
		{
			document.getElementById("text-background-position-xy-percentage-x").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-xy-percentage-y").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-xy-pixel-x").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-xy-pixel-y").disabled = inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-xy-pixels")
		{
			document.getElementById("text-background-position-xy-percentage-x").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-xy-percentage-y").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-xy-pixel-x").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-xy-pixel-y").disabled = !inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-xy")
		{
			document.getElementById("text-background-position-xy-percentage-x").disabled = true;
			document.getElementById("text-background-position-xy-percentage-y").disabled = true;
			document.getElementById("text-background-position-xy-pixel-x").disabled = true;
			document.getElementById("text-background-position-xy-pixel-y").disabled = true;
		}
		else if (inputRadioButton.id == "radio-background-size-percentage")
		{
			document.getElementById("text-background-size-percentage-x").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-size-percentage-y").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-size-length-x").disabled = inputRadioButton.checked;
			document.getElementById("text-background-size-length-y").disabled = inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-size-length")
		{
			document.getElementById("text-background-size-percentage-x").disabled = inputRadioButton.checked;
			document.getElementById("text-background-size-percentage-y").disabled = inputRadioButton.checked;
			document.getElementById("text-background-size-length-x").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-size-length-y").disabled = !inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-size")
		{
			document.getElementById("text-background-size-percentage-x").disabled = true;
			document.getElementById("text-background-size-percentage-y").disabled = true;
			document.getElementById("text-background-size-length-x").disabled = true;
			document.getElementById("text-background-size-length-y").disabled = true;
		}
		else if (inputRadioButton.id == "radio-background-position-x-percentage")
		{
			document.getElementById("text-background-position-x-percentage").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-x-pixel").disabled = inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-x-pixels")
		{
			document.getElementById("text-background-position-x-percentage").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-x-pixel").disabled = !inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-x")
		{
			document.getElementById("text-background-position-x-percentage").disabled = true;
			document.getElementById("text-background-position-x-pixel").disabled = true;
		}
		else if (inputRadioButton.id == "radio-background-position-y-percentage")
		{
			document.getElementById("text-background-position-y-percentage").disabled = !inputRadioButton.checked;
			document.getElementById("text-background-position-y-pixel").disabled = inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-y-pixels")
		{
			document.getElementById("text-background-position-y-percentage").disabled = inputRadioButton.checked;
			document.getElementById("text-background-position-y-pixel").disabled = !inputRadioButton.checked;
		}
		else if (inputRadioButton.id == "radio-background-position-y")
		{
			document.getElementById("text-background-position-y-percentage").disabled = true;
			document.getElementById("text-background-position-y-pixel").disabled = true;
		}
	}
}

function OnChangeX(inputNum, inputRadio, textareaCode, iframeResults)
{
	if (inputRadio)
	{
		let strValue = inputRadio.value,
			nPos1 = -1, nPos2 = -1;
		
		/*
			:0px 0px
			:0% 0%
			:0px
			:0%
		*/
		nPos1 = strValue.indexOf(":");
		nPos2 = strValue.indexOf("px", nPos1);
		if (nPos2 == -1)
			nPos2 = strValue.indexOf("%", nPos1);
		
		strValue = strValue.slice(0, nPos1 + 1) + inputNum.value + strValue.slice(nPos2, strValue.length);
		inputRadio.value = strValue;
		OnClickRadioBackgroundImg(inputRadio, textareaCode, iframeResults);
	}
}

function OnChangeY(inputNum, inputRadio, textareaCode, iframeResults)
{
	if (inputRadio)
	{
		let strValue = inputRadio.value,
			nPos1 = -1, nPos2 = -1;
		
		/*
			:0px 0px
			:0% 0%
			:0px
			:0%
		*/
		nPos1 = strValue.lastIndexOf(" ");
		if (nPos1 == -1)
			nPos1 = strValue.lastIndexOf(":");
		nPos2 = strValue.lastIndexOf("px");
		if (nPos2 == -1)
			nPos2 = strValue.lastIndexOf("%");
		strValue = strValue.slice(0, nPos1 + 1) + inputNum.value + strValue.slice(nPos2, strValue.length);
		inputRadio.value = strValue;
		OnClickRadioBackgroundImg(inputRadio, textareaCode, iframeResults);
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** MARGIN TRY IT NOW
//**********************************************************************************************************************
//**********************************************************************************************************************

function OnClickRadioMargin(inputRadio, textareaTryItNowCode, iframeTryItNowResults)
{
	if (inputRadio && textareaTryItNowCode && iframeTryItNowResults)
	{
		let strAttr = inputRadio.value,
			strCode = textareaTryItNowCode.value,
			nPos1 = strCode.indexOf("margin"),
			nPos2 = strCode.indexOf(";", nPos1);
		
		strCode = strCode.substr(0, nPos1) + strAttr + strCode.substr(nPos2 + 1, strCode.length - 1);
		textareaTryItNowCode.value = strCode;
		OnClickButtonRunIDs(textareaTryItNowCode.id, iframeTryItNowResults.id);
	}
}

function OnClickRadioPadding(inputRadio, textareaTryItNowCode, iframeTryItNowResults)
{
	if (inputRadio && textareaTryItNowCode && iframeTryItNowResults)
	{
		let strAttr = inputRadio.value,
			strCode = textareaTryItNowCode.value,
			nPos1 = strCode.indexOf("padding"),
			nPos2 = strCode.indexOf(";", nPos1);
		
		strCode = strCode.substr(0, nPos1) + strAttr + strCode.substr(nPos2 + 1, strCode.length - 1);
		textareaTryItNowCode.value = strCode;
		OnClickButtonRunIDs(textareaTryItNowCode.id, iframeTryItNowResults.id);
	}
}

function OnClickRadioOverflow(inputRadio, textareaTryItNowCode, iframeTryItNowResults)
{
	if (inputRadio && textareaTryItNowCode && iframeTryItNowResults)
	{
		let radioOverflow = document.getElementById("radio-overflow"),
			radioOverflowXOnly = document.getElementById("radio-overflow-x-only"),
			radioOverflowYOnly = document.getElementById("radio-overflow-y-only"),
			radioOverflowXY = document.getElementById("radio-overflow-xy"),
			selectOverflow = document.getElementById("select-overflow"),
			selectOverflowXOnly = document.getElementById("select-overflow-x-only"),
			selectOverflowYOnly = document.getElementById("select-overflow-y-only"),
			selectOverflowX = document.getElementById("select-overflow-x"),
			selectOverflowY = document.getElementById("select-overflow-y"),
			strAttr = "",
			strCode = textareaTryItNowCode.value,
			nPos1 = -1,
			nPos2 = -1;
		
		if (radioOverflow && selectOverflow)
		{
			selectOverflow.disabled = !radioOverflow.checked;
			if (radioOverflow.checked)
				strAttr = radioOverflow.value + selectOverflow.options[selectOverflow.selectedIndex].text;
		}
		if (radioOverflowXOnly && selectOverflowXOnly)
		{
			selectOverflowXOnly.disabled = !radioOverflowXOnly.checked;
			if (radioOverflowXOnly.checked)
				strAttr = radioOverflowXOnly.value + selectOverflowXOnly.options[selectOverflowXOnly.selectedIndex].text;
		}
		if (radioOverflowYOnly && selectOverflowYOnly)
		{
			selectOverflowYOnly.disabled = !radioOverflowYOnly.checked;
			if (radioOverflowYOnly.checked)
				strAttr = radioOverflowYOnly.value + selectOverflowYOnly.options[selectOverflowYOnly.selectedIndex].text;
		}
		if (radioOverflowXY && selectOverflowX && selectOverflowY)
		{
			selectOverflowX.disabled = !radioOverflowXY.checked;
			selectOverflowY.disabled = !radioOverflowXY.checked;
			if (radioOverflowXY.checked)
			{
				strAttr = radioOverflowXY.value;
				strAttr = strAttr.replace("XXXX", selectOverflowX.options[selectOverflowX.selectedIndex].text);
				strAttr = strAttr.replace("YYYY", selectOverflowY.options[selectOverflowY.selectedIndex].text);
			}
		}
		nPos1 = strCode.indexOf("overflow");
		nPos2 = strCode.indexOf("overflow", nPos1 + 8);
		if (nPos2 == -1)
			nPos2 = nPos1 + 8;
		nPos2 = strCode.indexOf(";", nPos2);
		strCode = strCode.substr(0, nPos1) + strAttr + strCode.substr(nPos2, strCode.length - 1);
		textareaTryItNowCode.value = strCode;
		OnClickButtonRunIDs(textareaTryItNowCode.id, iframeTryItNowResults.id);
	}
}

function OnClickRadioPosition(inputRadio, divPosDemo)
{
	if (inputRadio && divPosDemo)
	{
		let	radioRelative = document.getElementById("radio-relative"),
			numberPosX = document.getElementById("position-x"),
			numberPosY = document.getElementById("position-y");
			
		if (numberPosX && numberPosY && radioRelative)
		{
			numberPosX.disabled = !radioRelative.checked;
			numberPosY.disabled = !radioRelative.checked;
		}
		divPosDemo.style.position = inputRadio.value;
	}
}

function OnChangePositionX(inputNumberPositionX, divPosDemo)
{
	if (inputNumberPositionX && divPosDemo)
	{
		divPosDemo.style.left = inputNumberPositionX.value + "px";
	}
}

function OnChangePositionY(inputNumberPositionY, divPosDemo)
{
	if (inputNumberPositionY && divPosDemo)
	{
		divPosDemo.style.top = inputNumberPositionY.value + "px";
	}
}

