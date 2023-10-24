//******************************************************************************
//******************************************************************************
//** 
//** GENERAL PURPOSE FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************
function DoCapitalise(strText)
{
	
	let strLetter = strText[0].toUpperCase();
	strText = strLetter + strText.substr(1);
	return strText;
}				  

//******************************************************************************
//******************************************************************************
//** 
//** PRICES
//** 
//******************************************************************************
//******************************************************************************

let g_fTradieMembershipCost = 100;
let g_fCustomerJobPostCost = 2;

//******************************************************************************
//******************************************************************************
//** 
//** SELECT PRIMARY TRADE RELATED FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************

let g_arrayTrades = [
						"air condioner installer",
						"antennas & commincations",
						"appliance repairer",
						"arborist",
						"architect",
						"blind installer",
						"brick layer",
						"builder",
						"buikding inspector",
						"carpenter",
						"carpeter",
						"cabinet maker",
						"cleaner (domestic)",
						"cleaner (commercial)",
						"computer technician",
						"concreter",
						"conservation & land management",
						"deck builder",
						"decorator",
						"drafter",
						"electrician",
						"EV charge station installer",
						"excavator",
						"farm manager",
						"fencing (domestic)",
						"fencing (commercial and/or rural)",
						"gardening & lawn mowing",
						"glazier",
						"handyman",
						"interior designer",
						"land management",
						"landscaping",
						"landscape construction",
						"locksmith",
						"mowing (domestic)",
						"mowing & slashing (commercial)",
						"painter",
						"paver",
						"pest controller",
						"pet grooming",
						"plasterer",
						"plumber",
						"pool builder",
						"removalist",
						"roofer",
						"shop fitter",
						"solar panel installer",
						"stone mason",
						"surveyer",
						"tiler",
						"underpinner",
						"upholsterer",
						"window cleaner"
				   ];
				  
function DoGenerateTradesRadioButtons()
{
	let	strChecked = "checked";
	const nNumCols = 2;
					  
	for (let nI = 0; nI < g_arrayTrades.length; nI++)
	{
		if ((nI % nNumCols) == 0)
			document.write("<tr>");
		document.write("<td style=\"text-align:right;width:16em;\"><label>" + DoCapitalise(g_arrayTrades[nI]) + "</label></td>");
		document.write("<td style=\"width:16em;\"><input type=\"radio\" name=\"trade\" id=\"" + g_arrayTrades[nI] + "\" " + strChecked + " onclick=\"OnClickTRadesRadio('" + g_arrayTrades[nI] + "')\" />");
		document.write("</td>");
			
		if (nI == 0)
			strChecked = "";
			
		if ((((nI + 1) % nNumCols) == 0) && (nI > 0))
			document.write("</tr>");		
	}
	document.write("<td style=\"text-align:right;width:16em;\"><label>Other</label></td>");
	document.write("<td style=\"width:16em;\"><input type=\"radio\" name=\"trade\" id=\"other\" onclick=\"OnClickTRadesRadio('other')\" />");
	document.write("&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" id=\"text_other\" name=\"other trade\" pattern=\"[A-Za-z]+\" disabled />");
}

function OnClickTRadesRadio(strRadioID)
{
	let textOther = document.getElementById("text_other");
	let hiddenTrade = document.getElementById("trade");
	
	if (textOther)
	{
		textOther.disabled = strRadioID != "other";
	}
	if (hiddenTrade)
	{
		hiddenTrade.value = strRadioID;
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

