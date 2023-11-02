<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Account</title>
		<!-- #EndEditable -->
		<?php include "common.php"; ?>
		<link href="styles/style2.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<script src="common.js"></script>
		<script src="AustraliaPost.js"></script>
		<!-- #BeginEditable "page_styles" -->
			<style>

			
				 :root 
				{
					--strWidth: 96%;
					--strBorderRadius: 10px;
					--strBorderWidth: thin;
					--strBorderStyle: solid;
					--strBorderColor: var(--strColorInactiveBG);
					--strColorInactiveBG: #B0C0D0;
					--strColorHoverBG: var(--strColorMastheadBG);
					--strColorActiveBG: var(--strColorMastheadBG);
				}
				
				
				/* Style the buttons that are used to open the tab content */
				.tab_button 
				{
					display: inline-block;
					height: 40px;
					float: left;

					background-color: var(--strColorInactiveBG);
					border-color: var(--strBorderColor);
					border-top-left-radius: var(--strBorderRadius);
					border-top-right-radius:  var(--strBorderRadius);
					border-left-style: var(--strBorderStyle);
					border-top-style: var(--strBorderStyle);
					border-right-style: var(--strBorderStyle);
					border-bottom-style: none;
					border-left-width: var(--strBorderWidth);
					border-top-width: var(--strBorderWidth);
					border-right-width: var(--strBorderWidth);
					
					cursor: pointer;
					padding: 14px 16px;
					transition: 0.3s;
				}
				
				/* Change background color of buttons on hover */
				.tab_button:hover 
				{
				 	background-color: var(--strColorHoverBG);
				}
				
				.tab_button:active
				{
					background-color: var(--strColorActiveBG);
				}
				
				/* Style the tab content */
				.tab_content 
				{
					display: block;
					padding: 6px 12px;
					border-top: none;
					width: var(--strWidth);
					border-style: var(--strBorderStyle);
					border-width: var(--strBorderWidth);
					border-color: var(--strBorderColor);
					background-color: var(--strColorActiveBG);
					border-bottom-left-radius: var(--strBorderRadius);
					border-bottom-right-radius: var(--strBorderRadius);
					border-top-right-radius:  var(--strBorderRadius);
					
					overflow: hidden;
					height: 200px;
				}
										
			</style>
			
			<script type="text/javascript">
			
				function OnClickButtonLogout()
				{	
					sessionStorage["account_type"] = "";
					sessionStorage["account_username"] = "";
					sessionStorage["account_password"] = "";
					document.location = "login.php";
				}
				
				let g_buttonTabLastActive = null;
				
				function  DoOpenTab(strTabButtonID, strTab2ShowID) 
				{
					let divPageContent = document.getElementById("page_content");
					
					if (divPageContent)
					{
						for (let nI = 0; nI < divPageContent.children.length; nI++)
						{
							if (divPageContent.children[nI].className == "tab_content")
							{
								divPageContent.children[nI].style.display = "none";
							}
						}
						let divTab2Show = document.getElementById(strTab2ShowID);
						if (divTab2Show)
						{
							divTab2Show.style.display = "block";
						}
						let divTabButton = document.getElementById(strTabButtonID);
						if (divTabButton)
						{
							if (g_buttonTabLastActive)
								g_buttonTabLastActive.style.backgroundColor = GetCSSVariable("--strColorBG");
							divTabButton.style.backgroundColor = GetCSSVariable("--strColorActiveBG");
							g_buttonTabLastActive = divTabButton;
						}
					}
				}
								
			</script>

		<!-- #EndEditable -->
	</head>
	
	<body>
	
		<!-- Begin Container -->
		<div class="container" id="container">
			<!-- Begin Masthead -->
			<div class="masthead" id="masthead">
				<img class="logo" alt="" src="images/Tradie.png" width="90" />
				<div class="web_title_container" id="web_title_container">
					<div class="web_name" id="web_name">
						Find a Tradie<br/>
					</div>
					<div class="web_tag_line">
						Gardener, landscaper, electrician, plumber, builder, carpenter, plasterer, painter &amp; more
					</div>
				</div>
				<img class="trades_image" src="images/Tools.png" alt="images/Tools.png"/>
			</div>
			<!-- End Masthead -->
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<ul>
					<li><a href="home.html">Home</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="new_tradie.php">New Tradie</a></li>
					<li><a href="new_customer.html">New Customer</a></li>
					<script type="text/javascript">
						if (localStorage['account_username'] !== "")
							document.write("<li><a href=\"account.php\">Account</a></li>");
						else
							document.write("<li><a href=\"login.php\">Login</a></li>");
					</script>
					<li><a href="compare.html">Compare</a></li>
					<li><a href="contact.html">FAQ</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</nav>
			<!-- End Navigation -->
			<!-- Begin Page Content -->
			<div class="page_content" id="page_content">
				<h1><u><script type="text/javascript">document.write(document.title);</script></u></h1>				
					<!-- #BeginEditable "content" -->
						
						<br/><br/><br/>
						<button class="tab_button" id="tab_button1" onclick="DoOpenTab('tab_button1', 'tab_contents1')">London</button>
						<button class="tab_button" id="tab_button2" onclick="DoOpenTab('tab_button2', 'tab_contents2')">Paris</button>
						<button class="tab_button" id="tab_button3" onclick="DoOpenTab('tab_button3', 'tab_contents3')">Tokyo</button>
						<!-- Tab content -->
						<div id="tab_contents1" class="tab_content">
							<h3>London</h3>
							<p>London is the capital city of England.</p>
						</div>
						
						<div id="tab_contents2" class="tab_content" style="display:none;">
							<h3>Paris</h3>
							<p>Paris is the capital of France.</p>
						</div>
						
						<div id="tab_contents3" class="tab_content" style="display:none;">
							<h3>Tokyo</h3>
							<p>Tokyo is the capital of Japan.</p>
						</div>


					
						<br/>
						<input type="button" class="next_button" value="LOG OUT" onclick="OnClickButtonLogout()" />



						<script type="text/javascript">DoOpenTab("tab_button1", "tab_contents1");</script>

					<!-- #EndEditable -->
			<!-- End Page Content -->
			</div>
			<!-- Begin Footer -->
			<div class="footer">
				<p>
					<a href="home.html">Home</a> | 
					<a href="new_tradie.php">New Tradie</a> | 
					<a href="new_customer.html">New Customer</a> | 
					<a href="login.php">Log In</a> | 
					<a href="about.html">About</a> | 
					<a href="compare.html">Compare</a> | 
					<a href="faq.html">FAQ</a> | 
					<a href="contact.html">Contact</a>
					<span style="float:right;">Copyright &copy; 2023 <i>Find a Tradie</i>. All Rights Reserved.</span>
				</p>
			</div>
			<!-- End Footer --></div>
		<!-- End Container -->
	
	</body>
	
<!-- #EndTemplate -->
	
</html>
