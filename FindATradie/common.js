<script src="SweetAlert.js" type="text/javascript"></script>
<script src="cryptojs-aes.min.js"></script>
<script src="cryptojs-aes-format.js"></script>




<script type="text/javascript">

	//******************************************************************************
	//******************************************************************************
	//** 
	//** ENCRYPTION FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
			
	function GetCookie(strName)
	{
		let mapCookie = new Map(),
			strAllCookies = decodeURIComponent(document.cookie),
			arrayCookies = strAllCookies.split(";");
		
		for (let nI = 0; nI < arrayCookies.length; nI++) 
		{
			while (arrayCookies[nI].charAt(0) == " ")
			{
				arrayCookies[nI] = arrayCookies[nI].substring(1);
			}
			if (arrayCookies[nI].includes(strName))
			{
				let strCookie = arrayCookies[nI], // find-a-tradie=encryption_key=dPRBqi32EH7LgfxuhWXm,SameSite=Strict
					arrayLeyValue = null,
					nPos = strCookie.indexOf("=");
				
				strCookie = strCookie.substring(nPos + 1); // encryption_key=dPRBqi32EH7LgfxuhWXm,SameSite=Strict
				arrayKeyValues = strCookie.split(",");

				for (let nJ = 0; nJ < arrayKeyValues.length; nJ++)
				{
					nPos = arrayKeyValues[nJ].indexOf("=");
					mapCookie.set(arrayKeyValues[nJ].substring(0, nPos), arrayKeyValues[nJ].substring(nPos + 1));
				}
			}
		}
		return mapCookie;
	}
	
	function GetEncryptionKey()
	{
		let mapCookie = GetCookie("find-a-tradie"),
			strKey = mapCookie.get("encryption_key");

		return strKey;
	}

	function DoEncrypt(strPlainText)
	{
		return CryptoJSAesJson.encrypt(strPlainText, GetEncryptionKey());
		//return btoa(strPlainText);
	}
	
	function DoDecrypt(strEncryptedText)
	{
		return CryptoJSAesJson.decrypt(strEncryptedText, GetEncryptionKey());
		//atob(strEncryptedText);
	}
	


	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** GENERAL PURPOSE FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************			

	function GetNumYearsSince(nYear, nMonth)
	{
		let dateNow = new Date();
		let nNum = (dateNow.getFullYear() - nYear);
		let strTime = " years";

		if ((nNum == 0) && (nMonth !== undefined))
		{
			nNum = nMonth;
			strTime = " months";
		}

		return nNum + strTime;
	}

	function GetCSSVariable(strVarName)
	{
		let Val = 0;

		let Root = document.querySelector(':root');
		if (Root)
		{
			let Styles = getComputedStyle(Root);
			if (Styles)
			{
				 Val = Styles.getPropertyValue(strVarName);
				 Val = Val;
			}
		}
		return Val;
	}

	function DoGetInput(strID, strDesc)
	{
		let input = document.getElementById(strID);
		if (!input)
		{
			AlertIDError(strID, strDesc);
		}
		return input;
	}

	function IsAllowedChar(nKeyCode, strAllowedChars)
	{
		let bValid = true;
			
		for (let nI = 0; nI < strAllowedChars.length; nI++)
		{
			bValid = nKeyCode == strAllowedChars[nI];
			if (bValid)
				break;
		}
		return bValid;
	}
	
	function DoGetStateSelectionIndex(strState)
	{
		let nI = 0;
		
		if (strState == "ACT")
		{
			nI = 0;
		}
		else if (strState == "NSW")
		{
			nI = 1;
		}
		else if (strState == "NT")
		{
			nI = 2;
		}
		else if (strState == "QLD")
		{
			nI = 3;
		}
		else if (strState == "SA")
		{
			nI = 4;
		}
		else if (strState == "TAS")
		{
			nI = 5;
		}
		else if (strState == "VIC")
		{
			nI = 6;
		}
		else if (strState == "WA")
		{
			nI = 7;
		}
		return nI;
	}
	
	function DoGetJobSizeSelectionIndex(strJobSize)
	{
		nI = -1;
		
		if (strJobSize == "Not applicable")
		{
			nI = 0;
		}
		else if (strJobSize == "Up to 50")
		{
			nI = 1;
		}
		else if (strJobSize == "50 - 100")
		{
			nI = 2;
		}
		else if (strJobSize == "100 - 250")
		{
			nI = 3;
		}
		else if (strJobSize == "250 - 500")
		{
			nI = 4;
		}
		else if (strJobSize == "More than 500")
		{
			nI = 5;
		}
		return nI;
	}
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** INPUT KEY VALIDATION FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************			

	function IsAllowedChar(nChar, strAllowedChars)
	{
		let bValid = true;
			
		for (let nI = 0; nI < strAllowedChars.length; nI++)
		{
			bValid = nChar == strAllowedChars[nI];
			if (bValid)
				break;
		}
		return bValid;
	}
	
	function IsEditKey(event)
	{
		let bIsValid = ((event.keyCode == 8) || (event.keyCode == 46) || (event.keyCode == 37) || (event.keyCode == 39));
	
		return bIsValid;
	}
	
	function IsDigit(event, strAllowedChars = "") 
	{
    	let bIsValid = IsEditKey(event) || ((event.key >= '0') && (event.key <= '9')) || IsAllowedChar(event.key, strAllowedChars);
    	
		return bIsValid;
	}

	function IsAlpha(event, strAllowedChars = "")
	{
		let bIsValid = ((event.key >= 'A') && (event.key <= 'Z')) || ((event.key >= 'a') && (event.key <= 'z')) || IsAllowedChar(event.key, strAllowedChars);
		
		return bIsValid;
	}
	
	function IsAlphaNumeric(event, strAllowedChars = "") 
	{
    	let bIsValid = IsEditKey(event) || IsDigit(event) || IsAlpha(event) || IsAllowedChar(event.key, strAllowedChars);

		return bIsValid;
	}

	//******************************************************************************
	//******************************************************************************
	//** 
	//** ALERT MESSAGES
	//** 
	//******************************************************************************
	//******************************************************************************			

	function AlertInformation(strTitle, strMsg)
	{
		swal({
		 		title: strTitle,
		  		text: strMsg,
		  		icon: "info",
		  		buttons: true,
		  		closeModal: true
			});	
	}
	
	function AlertSuccess(strMsg)
	{
		swal({
		 		title: "SUCCESS",
		  		text: strMsg,
		  		icon: "success",
		  		buttons: true,
		  		closeModal: true
			});	
	}

	function AlertWarning(strMsg)
	{
		swal({
		 		title: "WARNING",
		  		text: strMsg,
		  		icon: "warning",
		  		buttons: true,
		  		closeModal: true
		  	 });
	}

	function AlertError(strMsg)
	{
		let strEmailAddress = "find-a-tradie@outlook.com",
			strEmailAdmin = "Email admin at " + strEmailAddress + " with this error message...";
		
		swal({
		 		title: "ERROR",
		  		text: strMsg + "\n\n" + strEmailAdmin,
		  		icon: "error",
		  		buttons: true,
		  		closeModal: true
			});	
	}

	function AlertIDError(strID, strDescription)
	{
		swal({
		 		title: "ELEMENT ID ERROR",
		  		text: "The " + strDescription + " element with ID '" + strID + "' does not exist!",
		  		icon: "error",
		  		buttons: true,
		  		closeModal: true
			});	
	}


	//******************************************************************************
	//******************************************************************************
	//** 
	//** COMMON FORM FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************

	function OnKeyPressDigitsSpaceOnly(eventKey)
	{
		if (((eventKey.which < 48) || (eventKey.which > 57)) && (eventKey.which != 8) && (eventKey.which != 32))
		{
			eventKey.preventDefault();
		}
	}

	function OnKeyPressDigitsOnly(eventKey)
	{
		if (((eventKey.which < 48) || (eventKey.which > 57)) && (eventKey.which != 8))
		{
			eventKey.preventDefault();
		}
	}

	function PreloadForm(form)
	{
		let inputHidden = null;

		if (form)
		{
			for (let nI = 0; nI < form.length; nI++)
			{		
				inputHidden = document.getElementById("hidden_" + form[nI].id);

				if (sessionStorage[form[nI].id] || sessionStorage[form[nI].name])
				{
					if ((form[nI].type == "radio") || (form[nI].type == "checkbox"))
					{
						form[nI].checked = sessionStorage[form[nI].id] == "true";
						if (inputHidden)
							inputHidden.checked = sessionStorage[form[nI].id] == "true";
					}
					else if (form[nI].type.includes("select"))
					{
						form[nI].selectedIndex = Number(sessionStorage[form[nI].id]);
						if (inputHidden)
							inputHidden.selectedIndex = Number(sessionStorage[form[nI].id]);
					}
					else if ((form[nI].type == "text") || (form[nI].type == "password") || (form[nI].type == "textarea"))
					{
						form[nI].value = sessionStorage[form[nI].id];
						if (inputHidden)
							inputHidden.value = sessionStorage[form[nI].id];
					}
				}
			}
		}
	}

	function SetSelectionValue(strSelectID, strValue)
	{
		let select = DoGetInput(strSelectID, "selection");
		
		if (select)
		{
			select.selectedIndex = 0;
			for (let nI = 0; nI < select.options.length; nI++)
			{
				if (strValue == select.options[nI].value)
				{
					select.selectedIndex = nI;
					break;
				}
			}
		}
	}

	function SetSelection(strSelectID, strOptionText)
	{
		let select = DoGetInput(strSelectID, "selection");
		
		if (select)
		{
			select.selectedIndex = 0;
			for (let nI = 0; nI < select.options.length; nI++)
			{
				if (strOptionText == select.options[nI].text)
				{
					select.selectedIndex = nI;
					break;
				}
			}
		}
	}
	


	//******************************************************************************
	//******************************************************************************
	//** 
	//** ADVERTS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function DoOpenAdvertEditor(nAdvertIndex)
	{
		document.location = "advert.php?location=" + strAdvertSpaceName;
	}	
	

	
	
	
	function DoGetPageName()
	{
		let strURL = document.location.toString();
		nPos1 = strURL.lastIndexOf("/") + 1;
		nPos2 = strURL.lastIndexOf(".php");
		let strPageName = strURL.substring(nPos1, nPos2);
		
		return strPageName;
	}




	function DoClickAdvert(nAdvertIndex)
	{
		if (g_arrayAdverts[nAdvertIndex - 1].length > 0)
		{
			document.location = "https://www.find-a-tradie.com.au/view_member.php?member_id=" + 
								g_arrayAdverts[nAdvertIndex - 1];
		}
		else
		{ 
			if ((sessionStorage["member_id"] == undefined) || (sessionStorage["member_id"] == ""))
			{
				AlertWarning("You must be logged in to add an advert!");
			}
			else
			{
				document.location = "https://www.find-a-tradie.com.au/edit_advert.php?page_name=" + DoGetPageName() + "&" + 
																							  "advert_slot_index=" + nAdvertIndex.toString() + "&" + 
																							  "current_page=" + document.location + "&" + 
																							  "cost_per_year=" + g_arrayAdverts[nAdvertIndex].cost_per_year;
			}
		}
	}	




	//******************************************************************************
	//******************************************************************************
	//** 
	//** FEEDBACK
	//** 
	//******************************************************************************
	//******************************************************************************
	
	function OnClickEditFeedback(buttonEdit, strID, bPositive, strDescription, strFormID)
	{
		//alert("strID = '" + strID + "', bPositive = '" + bPositive.toString() + "', strDescription = '" + strDescription + "'");
		let formFeedback = DoGetInput("feedback_" + strFormID + "_form"),
			radioPositive = DoGetInput("radio_feedback_" + strFormID + "_positive"),
			radioNegative = DoGetInput("radio_feedback_" + strFormID + "_negative"),
			textareaComments = DoGetInput("textarea_feedback_" + strFormID),
			hiddenID = DoGetInput("hidden_feedback_id");
	
		if (formFeedback && buttonEdit && radioPositive && radioNegative && textareaComments && hiddenID)
		{
			let rectButton = buttonEdit.getBoundingClientRect();
			
			formFeedback.style.display = "block";

			if (bPositive == "1")
			{
				radioPositive.checked = true;
				radioNegative.checked = false;
			}
			else if (bPositive == "0")
			{
				radioPositive.checked = false;
				radioNegative.checked = true;
			}
			textareaComments.innerText = strDescription;
			textareaComments.innerHTML = strDescription;
			hiddenID.value = strID;
		}
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** TRADES
	//** 
	//******************************************************************************
	//******************************************************************************

	function OnChangeTrade(selectTrade, labelDesc)
	{
		if (selectTrade && labelDesc)
		{
			labelDesc.innerText = g_mapTrades[selectTrade.options[selectTrade.selectedIndex].text];
		}
	}




	//******************************************************************************
	//******************************************************************************
	//** 
	//** FILE SELECT FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************

	let g_nMaxFileSizeBytes = 500000;
	
	function DoImagePreview()
	{
		let imgPreview = document.getElementById("image_preview"),
			inputFile = document.getElementById("file_name");
		
		if (imgPreview)
		{
			imgPreview.src = URL.createObjectURL(inputFile.files[0]);
		}
	}
	
	function OnChangeFile(inputFile)
	{
		if (inputFile.files[0].size > g_nMaxFileSizeBytes)
		{
			AlertError("File size cannot exceed " + g_nMaxFileSizeBytes.toString() + " kilobytes!");
		}
		else
		{							
			DoImagePreview();
		}
	}
	
	function SetMaxFileSize(nMaxFileSize)
	{
		g_nMaxFileSizeBytes = nMaxFileSize;
	}

	function SetAccepts(strAccept)
	{
		DoGetInput("file_name").accept = strAccept;
	}




</script>

