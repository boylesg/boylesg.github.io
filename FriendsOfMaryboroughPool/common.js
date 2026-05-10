//******************************************************************************
//******************************************************************************
//** 
//** MISCELLANEOUS FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************

function DoWriteEmailAddress()
{
	document.write("\u0067\u0072\u0065\u0067\u0070\u006c\u0061\u006e\u0074\u0073\u0040\u0062\u0069\u0067\u0070\u006f\u006e\u0064\u002e\u0063\u006f\u006d");
}

function DoResizeIframe(iframe)
{
	const nContentHeight = iframe.contentWindow.document.body.scrollHeight;
	iframe.style.height = nContentHeight + "px";
}
function OnClickTOCLink(strID)
{
	let divHTML = document.getElementById("div_html");
	let divCSS = document.getElementById("div_css");
	let divJavascript = document.getElementById("div_javascript");
	let divExpression = document.getElementById("div_expression");
	let divCurrent = document.getElementById("div_" + strID);
	let irframe = document.getElementById("iframe_" + strID);
		
	if (divHTML !== null)
		divHTML.style.display = "none";
	if (divCSS !== null)
		divCSS.style.display = "none";
	if (divJavascript !== null)
		divJavascript.style.display = "none";
	if (divExpression !== null)
		divExpression.style.display = "none";
	if (divCurrent !== null)
		divCurrent.style.display = "block";
	
	if (irframe !== null)	
		DoResizeIframe(irframe);
		
}
function OnBodyLoad()
{
	let linkNav = null;
	
	if (window.location.href.includes("index.html") || !window.location.href.includes("html"))
		linkNav = document.getElementById("home");
	else if (window.location.href.includes("about.html"))
		linkNav = document.getElementById("about");
	else if (window.location.href.includes("news.html"))
		linkNav = document.getElementById("news");
	else if (window.location.href.includes("support.html"))
		linkNav = document.getElementById("support");
	else if (window.location.href.includes("options.html"))
		linkNav = document.getElementById("options");
	else if (window.location.href.includes("help.html"))
		linkNav = document.getElementById("help");
	else if (window.location.href.includes("contact.html"))
		linkNav = document.getElementById("contact");
	else if (window.location.href.includes("admin.html"))
		linkNav = document.getElementById("admin");
	
	if (linkNav !== null)
	{
		linkNav.style.borderColor = "DarkBlue";
		linkNav.style.color = "DarkBlue";
		linkNav.style.textShadow = "-1px -1px 0 LightBlue, 1px -1px 0 LightBlue, -1px 1px 0 LightBlue, 1px 1px 0 LightBlue";
	}
}

//******************************************************************************
//******************************************************************************
//** 
//** TEXT KEY RESTRICTION FUNCTIONS
//** 
//******************************************************************************
//******************************************************************************

function OnKeyPressDigitsSpaceOnly(eventKey)
{
	if (((eventKey.key < '0') || (eventKey.key > '9')) && (eventKey.key.charCodeAt(0) != 8) && (eventKey.key != ' '))
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressDigitsOnly(eventKey)
{
	if (((eventKey.key < '0') || (eventKey.key > '9')) && (eventKey.key.charCodeAt(0) != 8))
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressAlphaNumericSpaceOnly(eventKey)
{
	if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
		((eventKey.key >= 'a') && (eventKey.key <= 'z')) || (eventKey.key.charCodeAt(0) == 8) || 
		(eventKey.key == ' '))
	{
	}
	else
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressAlphaSpaceOnly(eventKey)
{
	if (((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || ((eventKey.key >= 'a') && (eventKey.key <= 'z')) || 
		(eventKey.key.charCodeAt(0) == 8) || (eventKey.key == ' '))
	{
	}
	else
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressUsername(eventKey)
{
	if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
		((eventKey.key >= 'a') && (eventKey.key <= 'z')) || (eventKey.key.charCodeAt(0) == 8) || (eventKey.key == '_'))
	{
	}
	else
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressPassword(eventKey)
{
	if ((eventKey.key == '\'') || (eventKey.key == '\"'))
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressEmailAddress(eventKey)
{
	if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
		((eventKey.key >= 'a') && (eventKey.key <= 'z')) ||(eventKey.key.charCodeAt(0) == 8) || (eventKey.key == ' ') ||
		(eventKey.key == 64) || (eventKey.key == 45) || (eventKey.key == 46) || (eventKey.key == '_'))
	{
	}
	else
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressName(eventKey)
{
	if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
		((eventKey.key >= 'a') && (eventKey.key <= 'z')) ||(eventKey.key.charCodeAt(0) == 8) || (eventKey.key == ' ') ||
		(eventKey.key == 45) || (eventKey.key == 39))
	{
	}
	else
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressPhone(eventKey)
{
	if (((eventKey.key < '0') || (eventKey.key > '9')) && (eventKey.key.charCodeAt(0) != 8) && (eventKey.key != ' ') && (eventKey.key != ')') && (eventKey.key != '('))
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressComment(eventKey)
{
	if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
		((eventKey.key >= 'a') && (eventKey.key <= 'z')) ||(eventKey.key.charCodeAt(0) == 8) || 
		((eventKey.key >= ' ') && (eventKey.key <= '/')) || (eventKey.key.charCodeAt(0) == '?') || 
		(eventKey.key.charCodeAt(0) == '='))
	{
	}
	else
	{
		eventKey.preventDefault();
	}
}

function OnKeyPressURL(eventKey)
{
	if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
		((eventKey.key >= 'a') && (eventKey.key <= 'z')) ||(eventKey.key.charCodeAt(0) == 8) || (eventKey.key == ' ') ||
		(eventKey.key == '/') || (eventKey.key == ':') || (eventKey.key == '.') || (eventKey.key == '_'))
	{
	}
	else
	{
		eventKey.preventDefault();
	}
}




