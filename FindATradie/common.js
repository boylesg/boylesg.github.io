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
//** SELECT PRIMARY TRADE RELATED FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************

function OnClickTradesCheck(inputCheckbox)
{
	let hiddenAdditionalTrades = document.getElementById("hidden_additional_trades");
	
	if (hiddenAdditionalTrades)
	{
		if (inputCheckbox.checked)
		{
			let nPos = hiddenAdditionalTrades.value.search(inputCheckbox.name);
			if (nPos == -1)
				hiddenAdditionalTrades.value += inputCheckbox.name;
		}
		else
		{
			hiddenAdditionalTrades.value.replace(inputCheckbox.name, "");
		}
	}
}

function OnClickTradesRadio(inputRadio)
{
	let hiddenTrade = document.getElementById("hidden_trade"),
		textOtherTradeName = document.getElementById("text_other_trade_name"),
		textOtherTradeDescription = document.getElementById("text_other_trade_description");
			
	if (textOtherTradeName && textOtherTradeDescription)
	{
		textOtherTradeName.disabled = inputRadio.id != "other";
		textOtherTradeDescription.disabled = inputRadio.id != "other";
	}
	if (hiddenTrade)
	{
		hiddenTrade.value = inputRadio.id;
	}
}

function OnChangeOtherText(inputOtherText)
{
	let strID = inputOtherText.id.replace("text", "hidden"),
		inputHiddenOther = document.getElementById(strID);
		
	if (inputHiddenOther)
	{
		inputHiddenOther.value = inputOtherText.value;
	}
}

function DoSetHiddenFieldValue(input)
{
	let inputHidden = null;
	
	if (input.type == "radio")
		inputHidden = document.getElementById("hidden_" + input.name);
	else
		inputHidden = document.getElementById("hidden_" + input.id);
	
	if (inputHidden)
	{
		if ((input.type == "text") || (input.type == "password") || (input.type == "textarea"))
		{
			inputHidden.value = input.value;
		}
		else if (input.type == "radio")
		{
			inputHidden.value = document.querySelector('input[name="trade"]:checked').value;
		}
		else if (input.type == "select")
		{
			inputHidden.value = input.options[input.selectedIndex].text;
		}
	}
}

function DoValidateForm(form)
{
	let bFormValid = true;
	
	if (form) 
	{
		for (let nI = 0; nI < form.length; nI++)
		{
			if (form[nI].pattern.length > 0)
			{
				if ((form[nI].type == "text") || (form[nI].type == "password"))
				{
					RegularExpression = new RegExp(form[nI].pattern, "i");
					if (!RegularExpression.test(form[nI].value))
					{
						if (!form[nI].disabled)
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

function DoNext(strIDDiv2Hide, strIDDiv2Show, strFormId)
{
	let div2Hide = document.getElementById(strIDDiv2Hide),
		div2Show = document.getElementById(strIDDiv2Show),
		form = document.getElementById(strFormId),
		RegularExpression = null;
	
	if (DoValidateForm(form) && div2Hide && div2Show)
	{
		if (strIDDiv2Hide == "trade") 
		{
			let radioOther = document.getElementById("other"),
				textOther = document.getElementById("text_other"),
				hiddenOther = document.getElementById("hidden_other");
			
			if (radioOther && textOther  && hiddenOther)
			{
				if (radioOther.checked)
					hiddenOther.value = textOther.value;
				else
					hiddenOther.value = "";
			}
		}
		div2Hide.style.display = "none";
		div2Show.style.display = "block";
		sessionStorage["new_tradie_stage"] = strIDDiv2Show;
	}
}




//******************************************************************************
//******************************************************************************
//** 
//** DETAILS ABOUT YOUR BUSINESS FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************

