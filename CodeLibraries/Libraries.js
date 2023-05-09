var fPriceLevel1 = 1.0;
var fPriceLevel2 = 2.0;
var fPriceLevel3 = 5.0;
var fPriceLevel4 = 10.0;

function OnClickLibrary(strDivID)
{
	var Div = document.getElementById(strDivID);
	if (Div)
	{
		if (Div.clientHeight < 250)
		{
			Div.setAttribute("style", "height: auto;");
		}
		else
		{
			Div.setAttribute("style", "height: 30%;");
		}
	}
	else
		alert("Unkown DIV '" + strDivID + "'!");
}
