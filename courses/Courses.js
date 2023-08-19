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



