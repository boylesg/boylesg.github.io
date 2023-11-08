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
					--Width: 96%;
					--BorderRadius: 10px;
					--BorderWidth: thin;
					--BorderStyle: solid;
					--BorderColor: var(--ColorH4T);
					--TextColor: var(--ColorH4T);
					--ColorInactiveBG: #B0C0D0;
					--ColorHoverBG: var(--ColorMastheadBG);
					--ColorActiveBG: var(--ColorMastheadBG);
				}
				
				
				/* Style the buttons that are used to open the tab content */
				.tab_button 
				{
					display: inline-block;
					height: 40px;
					float: left;

					background-color: var(--ColorInactiveBG);
					border-color: var(--ColorH4T);
					border-top-left-radius: var(--BorderRadius);
					border-top-right-radius:  var(--BorderRadius);
					border-left-style: var(--BorderStyle);
					border-top-style: var(--BorderStyle);
					border-right-style: var(--BorderStyle);
					border-bottom-style: none;
					border-left-width: var(--BorderWidth);
					border-top-width: var(--BorderWidth);
					border-right-width: var(--BorderWidth);
					color: var(--TextColor);
					font-weight: bold;
					
					cursor: pointer;
					padding: 14px 16px;
					transition: 0.3s;
				}
				
				/* Change background color of buttons on hover */
				.tab_button:hover 
				{
				 	background-color: var(--ColorHoverBG);
				}
				
				.tab_button:active
				{
					background-color: var(--ColorActiveBG);
				}
				
				/* Style the tab content */
				.tab_content 
				{
					display: none;
					padding: 6px 12px;
					border-top: none;
					width: var(--Width);
					border-style: var(--BorderStyle);
					border-width: var(--BorderWidth);
					border-color: var(--BorderColor);
					background-color: var(--ColorActiveBG);
					border-bottom-left-radius: var(--BorderRadius);
					border-bottom-right-radius: var(--BorderRadius);
					border-top-right-radius:  var(--BorderRadius);
					
					overflow: hidden;
					height: 200px;
				}
				
				.paypal_table
				{
					font-size: x-large;
					border-collapse: collapse;
					/*font-weight: bold;*/
				}
				
				.paypal_cell
				{
					border-bottom-style: solid;
					border-bottom-width: thin;
					border-bottom-color: black;
					padding: 30px;
				}
														
				.paypal_first_cell
				{
					border-top-style: solid;
					border-top-width: thin;
					border-top-color: black;
				}
				
			</style>
			
			<script type="text/javascript">
			
				let g_buttonTabLastActive = null;
				
				function  DoOpenTab(strTabButtonID, strTab2ShowID) 
				{
					let divPageContent = document.getElementById("account");
					
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
								g_buttonTabLastActive.style.backgroundColor = GetCSSVariable("--ColorBG");
							divTabButton.style.backgroundColor = GetCSSVariable("--ColorActiveBG");
							g_buttonTabLastActive = divTabButton;
						}
					}
				}
								
			</script>

<?php 

	$strPayPalDisplay = "none";
	$strAccountDisplay = "block";
	
	if (isset($_GET["paypal"]))
	{
		$nNumMonths = (int)$_GET["paypal"];
		$dateExpiry = new DateTime($_SESSION["account_expiry_date"]);
		$interval = DateInterval::createFromDateString($nNumMonths . " month");
		$dateExpiry = $dateExpiry->add($interval);
		$_SESSION["account_expiry_date"] = $dateExpiry->format("Y-m-d");
		$result = DoUpdateQuery1($g_dbFindATradie, "members", "expiry_date", $_SESSION["account_expiry_date"], "id", $_SESSION["account_id"]);
		if ($result->num_rows == 1)
		{
			PrintJavascriptLine("alert(\"SUCCESS: your new renewal date has been updated to " . $dateExpiry->format("d/m/Y") . "\");", 4);
		}
	}
	else if (isset($_POST["submit_login"]))
	{
		$_SESSION["username"] = $_POST["text_username"];
		$_SESSION["password"] = $_POST["text_password"];
		
		$strQuery = "SELECT * FROM members WHERE username='" . $_POST["text_username"] . "' OR email='" . $_POST["text_username"] . "' AND password='" . $_POST["text_password"] . "'";
		$result = DoQuery($g_dbFindATradie, $strQuery);
		if ($result->num_rows == 1)
		{
			$row = $result->fetch_assoc();
			$_SESSION["account_id"] = $row["id"];
			$_SESSION["account_trade"] = $row["trade"];
			$_SESSION["account_business_name"] = $row["business_name"];
			$_SESSION["account_first_name"] = $row["first_name"];
			$_SESSION["account_surname"] = $row["surname"];
			$_SESSION["account_abn"] = $row["abn"];
			$_SESSION["account_structure"] = $row["structure"];
			$_SESSION["account_license"] = $row["license"];
			$_SESSION["account_description"] = $row["description"];
			$_SESSION["account_minimum_charge"] = $row["minimum_charge"];
			$_SESSION["account_minimum_budget"] = $row["minimum_budget"];
			$_SESSION["account_maximum_size"] = $row["maximum_size"];
			$_SESSION["account_maximum_distance"] = $row["maximum_distance"];
			$_SESSION["account_unit"] = $row["unit"];
			$_SESSION["account_street"] = $row["street"];
			$_SESSION["account_suburb"] = $row["suburb"];
			$_SESSION["account_state"] = $row["state"];
			$_SESSION["account_postcode"] = $row["postcode"];
			$_SESSION["account_phone"] = $row["phone"];
			$_SESSION["account_mobile"] = $row["mobile"];				
			$_SESSION["account_email"] = $row["email"];
			$_SESSION["account_expiry_date"] = $row["expiry_date"];
			$_SESSION["account_username"] = $row["username"];
			$_SESSION["account_password"] = $row["password"];

			if ($_SESSION["account_trade"] != "customer")
			{
				$dateNow = new DateTime();
				$dateExpiry = new DateTime($_SESSION["account_expiry_date"]);
				$dateExpiry = getDate(strtotime($_SESSION["account_expiry_date"]));
				if ($dateNow > $dateExpiry)
				{
					$strPayPalDisplay = "block";
					$strAccountDisplay = "none";
				}
			}
		}
		else
		{
			PrintJavascriptLines(
				array(
						"document.location = \"login.php\";", 
						"alert('ERROR: incorrect password!');"
					 ), 
				5);
		}
	}

	$nCostPerMonth = 10;
	$strLive = "none";
	$strDebug = "block";
?>

		<!-- #EndEditable -->
	</head>
	
	<body onresize="SetPageContetHeight()">
	
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
					<li><a href="index.php">Home</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="new_tradie.php">New Tradie</a></li>
					<li><a href="new_customer.html">New Customer</a></li>
					<?php

						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<li><a href=\"account.php\">Account</a></li>\n";
						else
							echo "<li><a href=\"login.php\">Login</a></li>\n";
							
					?>
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








					<div id="paypal" style="display:<?php echo 	$strPayPalDisplay; ?>;">
						<form method="post" id="form_logout" action="login.php">
							<input type="submit" class="next_button" id="submit_logout" name="submit_logout" value="LOG OUT" />
						</form>
						
						<h2>It is time to renew your membership...</h2><br/>
						<table class="paypal_table">
							<tr>
								<td class="paypal_cell paypal_first_cell">1 month</td>
								<td class="paypal_cell paypal_first_cell">$<?php printf("%0.2f", $nCostPerMonth); ?></td>
								<td class="paypal_cell paypal_first_cell">
									<div id="live" style="display: <?php echo $strLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="UYVQLYZVXKVHN" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>									</div>
									<div id="debug" style="display: <?php echo $strDebug; ?>;">
										<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="PVESVMVV6SGR4" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>								
									</div>
								</td>
							</tr>
							<tr>
								<td class="paypal_cell">6 month</td>
								<td class="paypal_cell">$<?php printf("%0.2f", $nCostPerMonth * 6); ?></td>
								<td class="paypal_cell">
									<div id="live0" style="display: <?php echo $strLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="3HA4WCZAD3DZE" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>					
									</div>
									<div id="debug0" style="display: <?php echo $strDebug; ?>;">
										<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="4EZXNLPSZ7T4W" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>				
									</div>
								</td>
							</tr>
							<tr>
								<td class="paypal_cell">12 month</td>
								<td class="paypal_cell">$<?php printf("%0.2f", $nCostPerMonth * 12); ?></td>
								<td class="paypal_cell">
									<div id="live1" style="display: <?php echo $strLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="LVG5EVU9Y9SM4" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>
									</div>
									<div id="debug1" style="display: <?php echo $strDebug; ?>;">
										<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="CSLBRUZVYDNFW" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>								
									</div>
								</td>
							</tr>
							<tr>
								<td class="paypal_cell">18 month</td>
								<td class="paypal_cell">$<?php printf("%0.2f", $nCostPerMonth * 18); ?></td>
								<td class="paypal_cell">
									<div id="live2" style="display: <?php echo $strLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="V6JERUCM52TGN" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>	
									</div>
									<div id="debug2" style="display: <?php echo $strDebug; ?>;">
										<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="CSLBRUZVYDNFW" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>									
									</div>
								</td>
							</tr>
							<tr>
								<td class="paypal_cell">24 month</td>
								<td class="paypal_cell">$<?php printf("%0.2f", $nCostPerMonth * 24); ?></td>
								<td class="paypal_cell">
									<div id="live3" style="display: <?php echo $strLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="KS2BA9S5L8TMG" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>										
									</div>
									<div id="debug3" style="display: <?php echo $strDebug; ?>;">
										<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="5MEDPTLFQF3JU" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>									
									</div>
								</td>
							</tr>
						
						</table>						
					</div>
					
					<div id="account" style="display:<?php echo $strAccountDisplay; ?>;">
					
						<br/><br/>
						<button class="tab_button" id="tab_button1" onclick="DoOpenTab('tab_button1', 'tab_contents1')">Trade details</button>
						<button class="tab_button" id="tab_button2" onclick="DoOpenTab('tab_button2', 'tab_contents2')">Account details</button>
						<button class="tab_button" id="tab_button3" onclick="DoOpenTab('tab_button3', 'tab_contents3')">Browse matching jobs</button>
						<button class="tab_button" id="tab_button4" onclick="DoOpenTab('tab_button4', 'tab_contents4')">Create your own job</button>

						<div id="tab_contents1" class="tab_content">
							<h2><script type="text/javascript">document.write(document.getElementById("tab_button1").innerText);</script></h2>
							<p>London is the capital city of England.</p>
						</div>
						
						<div id="tab_contents2" class="tab_content">
							<h2><script type="text/javascript">document.write(document.getElementById("tab_button2").innerText);</script></h2>
							<p>London is the capital city of England.</p>
						</div>
						
						<div id="tab_contents3" class="tab_content">
							<h2><script type="text/javascript">document.write(document.getElementById("tab_button3").innerText);</script></h2>
							<p>Paris is the capital of France.</p>
						</div>
						
						<div id="tab_contents4" class="tab_content">
							<h2><script type="text/javascript">document.write(document.getElementById("tab_button4").innerText);</script></h2>
							<p>Tokyo is the capital of Japan.</p>
						</div>

						<script type="text/javascript">DoOpenTab("tab_button1", "tab_contents1");</script>
					</div>








					<!-- #EndEditable -->
			<!-- End Page Content -->
			</div>
			<!-- Begin Footer -->
			<div class="footer" id="footer">
				<span class="footer_links" id="footer_links">
					<a href="index.php">Home</a> | 
					<a href="new_tradie.php">New Tradie</a> | 
					<a href="new_customer.html">New Customer</a> | 
					<?php
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a href=\"account.php\">Account</a>";
						else
							echo "<a href=\"login.php\">Login</a>";
					?> | 
					<a href="about.html">About</a> | 
					<a href="compare.html">Compare</a> | 
					<a href="faq.html">FAQ</a> | 
					<a href="contact.html">Contact</a>
				</span>
				<span class="footer_copyright" id="footer_copyright" style="float:right;">Copyright &copy; 2023 <i>Find a Tradie</i>. All Rights Reserved.</span>
			</div>
			<!-- End Footer -->
		</div>
		<!-- End Container -->
	
	</body>
	
	<footer>
		
		<script type="text/javascript">
		
			function SetPageContetHeight()
			{
				let divMasthead = document.getElementById("masthead"),
					navNavigation = document.getElementById("navigation"),
					divFooter = document.getElementById("footer"),
					divPageContent = document.getElementById("page_content"),
					nTotalOccupiedHeight = 0, nAvailableHeight = 680;
					
				if (divMasthead && divFooter && navNavigation && divPageContent)
				{
					nTotalOccupiedHeight = divMasthead.offsetHeight + divFooter.offsetHeight + navNavigation.offsetHeight;
					nAvailableHeight = document.documentElement.offsetHeight - nTotalOccupiedHeight;
					divPageContent.style.height = nAvailableHeight + "px";
				}
			}
			SetPageContetHeight();
			
		</script>
	
	</footer>
	
<!-- #EndTemplate -->
	
</html>
