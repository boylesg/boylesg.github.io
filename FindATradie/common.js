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

function AlertSuccess(strMsg)
{
	alert("SUCCESS: " + strMsg + ".");
}

function AlertError(strMsg)
{
	alert("ERROR: " + strMsg + ".");
}

function AlertIDError(strID, strDescription)
{
	alert("ERROR: " + strDescription + " with ID '" + strID + "' does not exist!");
}


//******************************************************************************
//******************************************************************************
//** 
//** PRICES
//** 
//******************************************************************************
//******************************************************************************

let g_fYearCost = 100;
let g_fCustomerJobPostCost = 2;


//******************************************************************************
//******************************************************************************
//** 
//** COMMON FORM FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************

function DoSetHiddenFieldValue(input)
{
	let inputHidden = null;
	
	if (input)
	{
		inputHidden = document.getElementById("hidden_" + input.id);
		
		if (inputHidden)
		{
			if ((input.type == "text") || (input.type == "password") || (input.type == "textarea"))
			{
				inputHidden.value = input.value;
				sessionStorage[input.id] = input.value;
			}
			else if ((input.type == "radio") || (input.type == "checkbox"))
			{
				inputHidden.checked = input.checked;
				sessionStorage[input.id] = input.checked;
			}
			else if (input.type.includes("select"))
			{
				inputHidden.value = input.options[input.selectedIndex].text;
				sessionStorage[input.id] = input.selectedIndex;
			}
		}
	}
}

function OnKeyPressDigitsOnly(eventKey)
{
	if (((eventKey.which < 48) || (eventKey.which > 57)) && (eventKey.which != 8))
    {
    	eventKey.preventDefault();
    }
}

function DoNext(strIDDiv2Hide, strIDDiv2Show, strFormID)
{
	let div2Hide = document.getElementById(strIDDiv2Hide),
		div2Show = document.getElementById(strIDDiv2Show),
		form = document.getElementById(strFormID);
	
	if (DoValidateForm(form))
	{
		if (div2Hide && div2Show)
		{
			div2Hide.style.display = "none";
			div2Show.style.display = "block";
			sessionStorage["new_tradie_stage"] = strIDDiv2Show;
		}
	}
}

function DoSubmit(strFormToValidateID, strFormToSubmitID)
{
	let formToValidate = document.getElementById(strFormToValidateID),
		formToSubmit = document.getElementById(strFormToSubmitID);
	
	if (formToValidate && DoValidateForm(formToValidate))
	{
		formToSubmit.submit();
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


