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
	let hiddenTrade = document.getElementById("hidden_trade");
			
	if (hiddenTrade)
	{
		hiddenTrade.value = inputRadio.id;
	}
}

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

function OnclickButtonNewTrade()
{
	let textName = document.getElementById("text_trade_name"),
		textDesc = document.getElementById("text_trade_description"),
		aEmail = document.getElementById("email_new_trade");
	
	if (textName && textDesc && aEmail)
	{
		if (textName.value.length < 6)
			alert("You must enter a descriptive name for the new trade!");
		else if (textDesc.value.length < 24)
			alert("You must enter a reasonable description for the new trade!");
		else
		{
			aEmail.href = "mailto:gregplants" + "@" + "bigpond" + 
			"com?subject=Request for new trade in FindATradie&body=Trade name: " + 
			textName.value + "%0A%0DTrade description%0A%0D-----------------------%0A%0D" + 
			textDesc.value;
			aEmail.style.visibility = "visible";
		}
	}
}

function DoNext(strIDDiv2Hide, strIDDiv2Show, strFormId)
{
	let div2Hide = document.getElementById(strIDDiv2Hide),
		div2Show = document.getElementById(strIDDiv2Show),
		form = document.getElementById(strFormId);
	
	if (DoValidateForm(form) && div2Hide && div2Show)
	{
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

