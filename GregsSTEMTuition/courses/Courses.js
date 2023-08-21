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

function OnClickRadioBackground(inputRadioButton, textareaCode, iframeResults)
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
		OnClickRadioBackground(inputRadio, textareaCode, iframeResults);
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
		OnClickRadioBackground(inputRadio, textareaCode, iframeResults);
	}
}



