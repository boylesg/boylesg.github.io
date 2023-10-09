function CreateNavigationStructure()
{	
	document.write("<nav id=\"nav\" class=\"nav\">");
	document.write("<a class=\"nav_link\" href=\"index.html\">Home</a>");
	document.write("<br/>");
	document.write("<a class=\"nav_link\" onclick=\"DoShowHidePopupMenu('products_popup')\">Products</a>");
	document.write("<div id=\"products_popup\" class=\"popup\" style=\"display:none\">");
	document.write("<a class=\"popup_link\" href=\"televisions.html\">Televisions</a><br/>");
	document.write("<a class=\"popup_link\" href=\"DVDplayers.html\">DVD Players</a><br/>");
	document.write("<a class=\"popup_link\" href=\"surround.html\">Surround sound</a><br/>");
	document.write("<a class=\"popup_link\" href=\"games.html\">Game consoles</a>");
	document.write("</div><br/>");
	document.write("<a class=\"nav_link\" href=\"services.html\">Services</a>");
	document.write("<br/>");
	document.write("<a class=\"nav_link\" href=\"contact.html\">Contact</a>");
	document.write("</nav>");
}

function DoShowHidePopupMenu(strID)
{
	let divPopup = document.getElementById(strID);
	
	// Make sure we have a valid ID and that we have a valid popup object
	if (divPopup)
	{
		// If the popup is visible
		if (divPopup.style.display == "block")
			// The hide it
			divPopup.style.display = "none";
		// Else if the popup is hidden
		else if (divPopup.style.display == "none")
			// The show it
			divPopup.style.display = "block";
	}
}

function DoOpenFooter()
{
	let divFooter = document.getElementById("footer"),
		divActivator = document.getElementById("activator");
	
	if (divFooter && divActivator)
	{
		if (divFooter.clientHeight == 400)
		{
			divFooter.style.height = "80px";
			divFooter.style.top = "0px";
			divActivator.innerText = "▲";
		}
		else
		{
			divFooter.style.height = "400px";
			divFooter.style.top = "-320px";
			divActivator.innerText = "▼";
		}
	}
}

function GenerateFooterContent()
{
	document.write("Great company with great products - Fred Smith<br/><br/>");
	document.write("Terrific customer service - Joe Bloggs<br/><br/>");
}
