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

//******************************************************************************
//******************************************************************************
//** 
//** PRICES
//** 
//******************************************************************************
//******************************************************************************

let g_fYearCost = 240;
let g_fCustomerJobPostCost = 2;


//******************************************************************************
//******************************************************************************
//** 
//** COMMON BUSINESS DETAILS FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************

function DoSetHiddenFieldValue(input)
{
	let inputHidden = null;
	
	if (input)
	{
		if (input.type == "radio")
			inputHidden = document.getElementById("hidden_" + input.name);
		else
			inputHidden = document.getElementById("hidden_" + input.id);
		
		if (inputHidden)
		{
			if ((input.type == "text") || (input.type == "password") || (input.type == "textarea"))
			{
				inputHidden.value = input.value;
				sessionStorage[input.id] = input.value;
			}
			else if (input.type == "radio")
			{
				if (input.checked)
				{
					inputHidden.value = input.id;
					sessionStorage[input.name] = input.id;
				}
			}
			else if (input.type.includes("select"))
			{
				inputHidden.value = input.options[input.selectedIndex].text;
				sessionStorage[input.id] = input.selectedIndex;
			}
			else if (input.type == "checkbox")
			{
				
				if (input.checked)
				{
					if (!inputHidden.value.includes(input.name))
					{
						let strDelim = "";
						if (inputHidden.value != "")
							strDelim = ",";
						inputHidden.value += strDelim + input.name;
					}
				}
				else
				{
					if (inputHidden.value.includes(input.name))
					{
						inputHidden.value = inputHidden.value.replace(input.name, ",");
						inputHidden.value = inputHidden.value.replace(",,", ",");
						if (inputHidden.value[0] == ",")
							inputHidden.value = inputHidden.value.substring(1);
						else if (inputHidden.value[inputHidden.value.length - 1] == ",")
							inputHidden.value = inputHidden.value.substring(0, inputHidden.value.length - 2);
					}
				}
				let strID = inputHidden.id.substring(7);
				sessionStorage[strID] = inputHidden.value;
			}
		}
	}
}

function VaildateExclude(strText, strExclude)
{
	let bValid = true;
	
	for (let nI = 0; nI < strExclude.length; nI++)
	{
		if (strText.includes(strExclude[nI]))
		{
			bValid = false;
			break;
		}
	}
	return bValid;
}

function ValidateField(input)
{
	let bValid = true;
	
	if (input && input.pattern && (input.pattern.length > 0))
	{
		if ((input.pattern.search("!blank") > -1) && (input.value.length == 0))
			bValid = false;
		else if (input.pattern.search("digits") > -1)
		{
			if (VaildateExclude(input.value, "!@#$%^&*()-_=+[{]}\\|;:'\",<.>/?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"))
			{
				let nPos = input.pattern.indexOf("digits") + 6,
					strNum = input.pattern.substring(nPos),
					nNum = Number(strNum),
					nDigitCount = 0;
					
				if ((nNum != NaN) && (nNum > 0))
				{
					for (let nI = 0; nI < input.value.length; nI++)
					{
						if ("0123456789".includes(input.value[nI]))
							nDigitCount++;
					}
					bValid = nDigitCount == nNum;
				}
			}
		}
		else if (input.pattern.search("email") > -1)
		{
			const iteratorMatches = input.value.matchAll("@"),
				arrayMatches = Array.from(iteratorMatches),
				strMatches = arrayMatches.toString();
				
			bValid &= strMatches == "@";
			
			let nPosAt = input.value.indexOf("@");
			nPosDot = input.value.indexOf(".", nPosAt);

			bValid &= nPosDot > nPosAt;
		}

	}
	return bValid;
}

function DoValidateForm(form)
{
	let bFormValid = true;
	
	if (form) 
	{
		for (let nI = 0; nI < form.length; nI++)
		{
			if ((form[nI].pattern != undefined) && (form[nI].pattern.length > 0))
			{
				if (!form[nI].disabled)
				{
					if ((form[nI].type == "text") || (form[nI].type == "password") || (form[nI].type == "textarea"))
					{
						if (!ValidateField(form[nI]))
						{
							if (form[nI].value.length == 0)
								alert("The " + form[nI].name + " cannot be blank!");
							else
								alert("'" + form[nI].value + "' is not a valid " + form[nI].name + "!");
							form[nI].focus();
							bFormValid = false;
							break;
						}
					}
				}
			}
			DoSetHiddenFieldValue(form[nI]);
		}
	}
	return bFormValid;
}

function OnKeyPressNumberInput(eventKey)
{
	if (((eventKey.which < 48) || (eventKey.which > 57)) && (eventKey.which != 8))
    {
    	eventKey.preventDefault();
    }
}

function DoNext(strIDDiv2Hide, strIDDiv2Show, strFormId)
{
	let div2Hide = document.getElementById(strIDDiv2Hide),
		div2Show = document.getElementById(strIDDiv2Show),
		form = document.getElementById(strFormId);
	
	if (DoValidateForm(form))
	{
		if (div2Hide && div2Show)
		{
			div2Hide.style.display = "none";
			div2Show.style.display = "block";
			sessionStorage["new_tradie_stage"] = strIDDiv2Show;
		}
		else if (!div2Show)
		{
			form.submit();
		}
	}
}

function PreloadForm(form)
{
	let strName = "",
		strID = "";
	
	if (form)
	{
		for (let nI = 0; nI < form.length; nI++)
		{		
			if (sessionStorage[form[nI].id] || sessionStorage[form[nI].name])
			{
				if (form[nI].type == "radio")
				{
					strName = form[nI].name;
					strID = sessionStorage[strName];
					
					do
					{
						form[nI].checked = false;
						nI++;
					}
					while (strName == form[nI].name);
					nI--;
					
					document.getElementById(strID).checked = true;
				}
				else if (form[nI].type.includes("select"))
				{
					form[nI].selectedIndex = Number(sessionStorage[form[nI].id]);
				}
				else if ((form[nI].type == "text") || (form[nI].type == "password") || (form[nI].type == "textarea"))
				{
					form[nI].value = sessionStorage[form[nI].id];
				}
				else if (form[nI].type == "checkbox")
				{
					if (sessionStorage[form[nI].id].includes(form[nI].name))
					{
						form[nI].checked = true;
					}
				}
			}
		}
	}
}




//******************************************************************************
//******************************************************************************
//** 
//** SELECT PRIMARY TRADE RELATED FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************

function OnClickTradesRadio(inputRadio)
{
	let hiddenTrade = document.getElementById("hidden_trade");
			
	if (hiddenTrade)
	{
		hiddenTrade.value = inputRadio.id;
	}
}

