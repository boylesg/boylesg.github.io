<script src="SweetAlert.js" type="text/javascript">
</script>

<script type="text/javascript">

	//******************************************************************************
	//******************************************************************************
	//** 
	//** ENCRYPTION FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************
	
	let g_Key = "DG9qD3Upfmj8JMvRF6CZ4gwKmSqmMD3V",
		g_strIV = "wX9yWCcxyUjw3Xf6";
			
	function DoAESEncrypt(strPlainText)
	{
		//return CryptoJS.AES.encrypt(strPlainText, g_Key, g_strIV);
		return btoa(strPlainText);
	}
	
	function DoAESDecrypt(strEncryptedText)
	{
		//return CryptoJS.AES.decrypt(strEncryptedText, g_Key, g_strIV);
		atob(strEncryptedText);
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
		swal({
		 		title: "ERROR",
		  		text: strMsg,
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

	function OnClickCheckShowPassword(inputCheckShowPassword, inputPassword)
	{
		if (inputCheckShowPassword.checked)
			inputPassword.type = "text";
		else
			inputPassword.type = "password";
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

	function OpenAdvertEditor(strAdvertSpaceName)
	{
		document.location = "advert.php?location=" + strAdvertSpaceName;
	}
	
	
	
	
	//******************************************************************************
	//******************************************************************************
	//** 
	//** FEEDBACK
	//** 
	//******************************************************************************
	//******************************************************************************

	function OnClickEditFeedback(buttonEdit, strID, bPositive, strDescription)
	{
		//alert("strID = '" + strID + "', bPositive = '" + bPositive.toString() + "', strDescription = '" + strDescription + "'");
		let formFeedback = DoGetInput("feedback_form"),
			radioPositive = DoGetInput("radio_feedback_positive"),
			radioNegative = DoGetInput("radio_feedback_negative"),
			textareaComments = DoGetInput("textarea_comments"),
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




</script>

