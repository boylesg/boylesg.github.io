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
//** TRY IT NOW 
//**********************************************************************************************************************
//**********************************************************************************************************************

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



