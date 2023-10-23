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
						"antenna",
						"brickie",
						"builder",
						"carpenter",
						"carpenter",
						"decorator",
						"electrician",
						"fencer",
						"fencer",
						"gardener",
						"glazier",
						"handyman",
						"landscaper",
						"locksmith",
						"painter",
						"Plasterer",
						"plumber",
						"roofer",
						"plumber",
						"mason",
						"other"
				   ];
				  
function DoGenerateTradesRadioButtons()
{
	let	strChecked = "checked";
					  
	for (let nI = 0; nI < g_arrayTrades.length; nI++)
	{
		document.write("<tr>");
		document.write("<td style=\"text-align:right;\"><label>" + DoCapitalise(g_arrayTrades[nI]) + "</label></td>");
		document.write("<td><input type=\"radio\" name=\"trade\" id=\"" + g_arrayTrades[nI] + "\" " + strChecked + " onclick=\"OnClickTRadesRadio('" + g_arrayTrades[nI] + "')\" />");
		if (g_arrayTrades[nI] == "other")
			document.write("&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" id=\"text_other\" pattern=\"[A-Za-z]+\" disabled />");
		document.write("</td>");
			
		if (nI == 0)
			strChecked = "";
		document.write("</tr>");
	}
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

function DoNext(strIDDiv2Hide, strIDDiv2Show)
{
	let Div2Hide = document.getElementById(strIDDiv2Hide),
		Div2Show = document.getElementById(strIDDiv2Show);
		
	if (Div2Hide && Div2Show)
	{
		Div2Hide.style.display = "none";
		Div2Show.style.display = "block";
		sessionStorage["new_tradie_stage"] = strIDDiv2Show;
	}
}

