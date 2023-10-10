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

function DoLogin()
{
	let inputPassword = document.getElementById("text_password"),
		divLogin = document.getElementById("login"),
		divContent = document.getElementById("page_content"),
		strCorrectPassword = "password";
	
	// Check if the id were valid and that we have a valid objects
	if (inputPassword && divLogin && divContent)
	{
		/*
			All text and password input objects have the property 'value' which contains the text typed by the user.
		*/
		if ((inputPassword.value == strCorrectPassword) || // If the password typed by the user is correct or
			(sessionStorage["password"] && (sessionStorage["password"] == strCorrectPassword))) // If the stored password is correct

		{
			// Hide the div containing the login form
			divLogin.style.display = "none";// The javascript 'display' property corresponds to the CSS attribute 'display' 
			// Show the div containing the page contents
			divContent.style.display = "inline-block";
			
			// Store the password
			sessionStorage["password"] = inputPassword.value;
		}
	}
}

