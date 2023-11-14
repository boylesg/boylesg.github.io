<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Account</title>
		<!-- #EndEditable -->
		<?php include "common.php"; ?>
		<?php include "common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
			<style>

			
				body 
				{
					color: #000;
					font-family: Arial, Helvetica, sans-serif;
					font-size: small;
					font-style: normal;
					background-image: url('images/background.jpg');
					background-position: center;
					background-repeat: no-repeat;
					background-size: 100%;
				}
				
			</style>
			
		<!-- #BeginEditable "page_styles" -->
						
			<style>

				:root 
				{
					--Width: 98%;
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
					
					overflow: auto;
					/*height: 1000px;*/
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
				
				.form
				{
					background-color: white;
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

	$strPaypalDisplay = "none";
	$strAccountDisplay = "block";
/*	
	DEBUG PAYPAAL RESPONSE
	
	$_GET["paypal"] = 12;
	DebugPrint("_SESSION[\"username\"]", $_SESSION["username"], 2);
	DebugPrint("_SESSION[\"password\"]", $_SESSION["password"], 2);
	DebugPrint("_SESSION[\"accountid\"]", $_SESSION["account_id"], 2);
	echo "<br><br>";
*/	
	if (isset($_GET["paypal"]))
	{
		$nNumMonths = (int)$_GET["paypal"];
		$dateExpiry = new DateTime($_SESSION["account_expiry_date"]);
		$interval = DateInterval::createFromDateString($nNumMonths . " month");
		$dateExpiry = $dateExpiry->add($interval);
		$_SESSION["account_expiry_date"] = $dateExpiry->format("Y-m-d");
		if (DoUpdateQuery1($g_dbFindATradie, "members", "expiry_date", $_SESSION["account_expiry_date"], "id", $_SESSION["account_id"]))
		{
			PrintJSAlertError("your new renewal date has been updated to " . $dateExpiry->format("d/m/Y"), 5, true);
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
			$_SESSION["account_trade"] = $row["trade_id"];
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
			
			// Next we need to get the listb of additional trades.
			$_SESSION["account_additional_trades"] = [];
			
			$result = DoFindQuery1($g_dbFindATradie, "additional_trades", "member_id", $_SESSION["account_id"]);
			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_assoc())
				{
					$_SESSION["account_additional_trades"][] = $row["trade_id"];
				}
			}
		}
		else
		{
			PrintJavascriptLines(["AlertError('username and/or password is incorrect!')", "document.location = \"login.php\";"], 5, true);
		}
	}
	else if (isset($_POST["submit_trade_details"]))
	{
		/*
			print_r($_POST);
			Array ( 
					[select_trade] => 1 
					[select_additional_trades] => Array ( [0] => 2 [1] => 3 [2] => 4 [3] => 5 [4] => 6 ) 
					[submit_trade_details] => UPDATE 
				  ) 		
		*/
		$bSuccess = true;
		
		$result = DoUpdateQuery1($g_dbFindATradie, "members", "trade", $_POST["select_trade"], "id", $_SESSION["account_id"]);
		if ($result)
		{
			$result = DoDeleteQuery($g_dbFindATradie, "additional_trades", "member_id", $_SESSION["account_id"]);
			if ($result)
			{
				$_SESSION["account_additional_trades"] = [];
				for ($nI = 0; $nI < count($_POST["select_additional_trades"]); $nI++)
				{
					$result = DoInsertQuery2($g_dbFindATradie, "additional_trades", "member_id", $_SESSION["account_id"], "trade_id", $_POST["select_additional_trades"][$nI]);
					$_SESSION["account_additional_trades"][] = $_POST["select_additional_trades"][$nI];
					if (!$result)
						break;
				}
				if ($result)
					PrintJavascriptLine("AlertSuccess(\"trade details were updated!\");");
			}
		}
	}
	else if (isset($_POST["text_business_name"]))
	{
		$bError = false;

		// Business name has changed
		if ($_SESSION["account_business_name"] != $_POST["text_business_name"])
		{
			// Check that the new business name is not being used by some one else.
			$result = DoFindQuery1($g_dbFindATradie, "members", "business_name", $_POST["text_business_name"]);
			if ($result->num_rows > 0)
			{
				PrintJavascriptLines(
					["AlertError(\"business name '" . $_POST["text_business_name"] . "' is already in use!\");\n",
					 "document.getElementById(\"text_business_name\").focus();\n"], 2, true);
				$bError = true;
			}
		}
		if (!$bError)
		{
			$strQuery = "UPDATE members SET " .
						AppendSQLUpdateValues("business_name", $_POST["text_business_name"],
												"abn", $_POST["text_abn"],
												"structure", $_POST["select_structure"],
												"license", $_POST["text_license"],
												"description", $_POST["text_description"],
												"minimum_charge", $_POST["text_minimum_charge"],
												"minimum_budget", $_POST["text_minimum_budget"],
												"maximum_size", $_POST["select_maximum_size"],
												"maximum_distance", $_POST["text_maximum_distance"]) . 
						" WHERE id='" . $_SESSION["account_id"] . "'";
			$result = DoQuery($g_dbFindATradie, $strQuery);
			if ($result)
			{
				PrintJavascriptLine("AlertSuccess(\"business details updated!\");\n", 2, true);
				$_SESSION["account_business_name"] = $_POST["text_business_name"];
				$_SESSION["account_abn"] = $_POST["text_abn"];
				$_SESSION["account_structure"] = $_POST["select_structure"];
				$_SESSION["account_icense"] = $_POST["text_license"];
				$_SESSION["account_description"] = $_POST["text_description"];
				$_SESSION["account_minimum_charge"] = $_POST["text_minimum_charge"];
				$_SESSION["account_minimum_budget"] = $_POST["text_minimum_budget"];
				$_SESSION["account_maximum_size"] = $_POST["select_maximum_size"];
				$_SESSION["account_maximum_distance"] = $_POST["text_maximum_distance"];
			}
			else
			{
				PrintJavascriptLine("AlertError(\"business details could not be updated!\");\n", 2, true);
			}
		}
	}
	else if (isset($_POST["text_first_name"]))
	{
		$strQuery = "UPDATE members SET " . 
					AppendSQLUpdateValues("first_name", $_POST["text_first_name"], 
										"surname", $_POST["text_surname"], 
										"unit", $_POST["text_unit"], 
										"street", $_POST["text_street"], 
										"suburb", $_POST["text_suburb"], 
										"state", $_POST["select_state"], 
										"postcode", $_POST["text_postcode"], 
										"phone", $_POST["text_phone"], 
										"mobile", $_POST["text_mobile"], 
										"email", $_POST["text_email"]) .
					" WHERE id='" . $_SESSION["account_id"] . "'";
		$result = DoQuery($g_dbFindATradie, $strQuery);
		if ($result)
		{
			PrintJavascriptLine("AlertSuccess(\"contact details updated!\");\n", 2, true);
			$_SESSION["account_first_name"] = $_POST["text_first_name"];
			$_SESSION["account_surname"] = $_POST["text_surname"];
			$_SESSION["account_unit"] = $_POST["text_unit"];
			$_SESSION["account_street"] = $_POST["text_street"];
			$_SESSION["account_suburb"] = $_POST["text_suburb"];
			$_SESSION["account_state"] = $_POST["select_state"];
			$_SESSION["account_postcode"] = $_POST["text_postcode"];
			$_SESSION["account_phone"] = $_POST["text_phone"];			
			$_SESSION["account_mobile"] = $_POST["text_mobile"];
			$_SESSION["account_email"] = $_POST["text_email"];
		}
		else
		{
			PrintJavascriptLine("AlertError(\"contact details could not be updated!\");\n", 2, true);
		}
	}
	else if (isset($_POST["text_username"]))
	{
		$bError = false;
	
		// Business name has changed
		if ($_SESSION["account_username"] != $_POST["text_username"])
		{
			// Check that the new business name is not being used by some one else.
			$result = DoFindQuery1($g_dbFindATradie, "members", "username", $_POST["text_username"]);
			if ($result->num_rows > 0)
			{
				PrintJavascriptLines(
					["AlertError(\"username '" . $_POST["text_username"] . "' is already in use!\");\n",
					 "document.getElementById(\"text_username\").focus();\n"], 2, true);
				$bError = true;
			}
		}
		if (!$bError)
		{
			$strQuery = "UPDATE members SET " .
						AppendSQLUpdateValues("username", $_POST["text_username"], 
												"password", $_POST["text_password"]) .
						" WHERE id='" . $_SESSION["account_id"] . "'";
			
			$result = DoQuery($g_dbFindATradie, $strQuery);
			if ($result)
			{
				PrintJavascriptLine("AlertSuccess(\"user details updated!\");\n", 2, true);
				$_SESSION["account_username"] = $_POST["text_username"];
				$_SESSION["account_password"] = $_POST["text_password"];
			}
			else
			{
				PrintJavascriptLine("AlertError(\"user details could not be updated!\");\n", 2, true);
			}
		}
	}
	// If the session has expired
	if (!isset($_SESSION["account_id"]))
	{
		PrintJavascriptLine("document.location = \"login.php\";", 1, true);
	}
	else
	{
		// If a tradie account then...
		if ($_SESSION["account_trade"] != "customer")
		{
			// We need to check the expity date of their account agiants the current date...
			$dateNow = new DateTime();
			$dateExpiry = new DateTime($_SESSION["account_expiry_date"]);
	
			// If the account has expired...
			if ($dateNow > $dateExpiry)
			{
				// Display the Paypal div
				$strPaypalDisplay= "block";
				$strAccountDisplay = "none";
			}
			else
			{
				// Display the account div
				$strPaypalDisplay= "none";
				$strAccountDisplay = "block";
			}
		}
	}

	$strPaypalLive = "none";
	$strPaypalTest = "block";

?>

		<!-- #EndEditable -->
	</head>
	
	<body onresize="SetPageContetHeight()">
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tradie.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie for Australians</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">Home</a>
				<a class="navigation_link" href="benefits.php">Benefits</a>
				<a class="navigation_link" href="about.html">About</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">Account</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">Login</a>\n";
							
					?>
					<a class="navigation_link" href="contact.html">FAQ</a>
					<a class="navigation_link" href="contact.html">Contact</a>
			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
		<!-- End PageHeading -->
		<!-- End Masthead -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
				<!-- #BeginEditable "content" -->

				<div class="note">

					<form method="post" id="form_logout" class="form" action="login.php">
						<input type="submit" class="next_button" id="submit_logout" name="submit_logout" value="LOG OUT" />
					</form>

					<div id="paypal" style="display:<?php echo 	$strPaypalDisplay; ?>;">						
						<h2>It is time to renew your membership...</h2><br/>
						<table class="paypal_table">
							<tr>
								<td class="paypal_cell paypal_first_cell">1 month</td>
								<td class="paypal_cell paypal_first_cell">$<?php printf("%0.2f", $g_nCostPerMonth); ?></td>
								<td class="paypal_cell paypal_first_cell">
									<div id="live" style="display: <?php echo $strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="UYVQLYZVXKVHN" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>									</div>
									<div id="debug" style="display: <?php echo $strPaypalTest; ?>;">
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
								<td class="paypal_cell">$<?php printf("%0.2f", $g_nCostPerMonth * 6); ?></td>
								<td class="paypal_cell">
									<div id="live0" style="display: <?php echo $strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="3HA4WCZAD3DZE" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>					
									</div>
									<div id="debug0" style="display: <?php echo $strPaypalTest; ?>;">
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
								<td class="paypal_cell">$<?php printf("%0.2f", $g_nCostPerMonth * 12); ?></td>
								<td class="paypal_cell">
									<div id="live1" style="display: <?php echo $strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="LVG5EVU9Y9SM4" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>
									</div>
									<div id="debug1" style="display: <?php echo $strPaypalTest; ?>;">
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
								<td class="paypal_cell">$<?php printf("%0.2f", $g_nCostPerMonth * 18); ?></td>
								<td class="paypal_cell">
									<div id="live2" style="display: <?php echo $strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="V6JERUCM52TGN" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>	
									</div>
									<div id="debug2" style="display: <?php echo $strPaypalTest; ?>;">
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
								<td class="paypal_cell">$<?php printf("%0.2f", $g_nCostPerMonth * 24); ?></td>
								<td class="paypal_cell">
									<div id="live3" style="display: <?php echo $strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="KS2BA9S5L8TMG" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>										
									</div>
									<div id="debug3" style="display: <?php echo $strPaypalTest; ?>;">
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
						<button class="tab_button" id="tab_button1" onclick="DoOpenTab('tab_button1', 'tab_contents1')">Browse your jobs</button>
						<button class="tab_button" id="tab_button2" onclick="DoOpenTab('tab_button2', 'tab_contents2')">Post your own job</button>
						<button class="tab_button" id="tab_button3" onclick="DoOpenTab('tab_button3', 'tab_contents3')">Account details</button>
						<button class="tab_button" id="tab_button4" onclick="DoOpenTab('tab_button4', 'tab_contents4')">Feedback you've received</button>
						<button class="tab_button" id="tab_button5" onclick="DoOpenTab('tab_button5', 'tab_contents5')">Feedback you've left</button>

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
							
<?php 
	$g_strButtonText = "UPDATE";
	$g_bIsStaged = false;
	include "member_details_forms.html"; 
?>

						</div>
						
						<div id="tab_contents4" class="tab_content">
							<h2><script type="text/javascript">document.write(document.getElementById("tab_button4").innerText);</script></h2>
							<p>Tokyo is the capital of Japan.</p>
						</div>

						<script type="text/javascript">DoOpenTab("tab_button1", "tab_contents1");</script>
						
					</div>
					
				</div>

<script type="text/javascript">

	function DoNextForm(strForm2HideID, strForm2ShowID)
	{
		let form2Hide = DoGetInput(strForm2HideID),
			form2Show = DoGetInput(strForm2ShowID);
		
		if (form2Hide && form2Show)
		{
			form2Hide.style.display = "none";
			form2Show.style.display = "block";
		}
	}


	function OnClickButtonUserDetails()
	{
		if (DoFormValidate("form_user_details"))
		{
			let textPassword = DoGetInput("text_password"),
				textPasswordAgain = DoGetInput("text_password_again");

			if (!textPassword)
			{
				AlertIDError("text_password", "password input");
			}
			else if (!textPasswordAgain)
			{
				AlertIDError("text_password_again", "password input");
			}
			else if (textPassword.value != textPasswordAgain.value)
			{
				AlertError("the two passwords do not match!");
				textPassword.focus();
			}
			else
			{
				DoNextForm("form_user_details", "form_trade_details");
			}
		}

	}
				
	DoChangeButtonUserDetailsFunction(OnClickButtonUserDetails);
	
	
	
	
	function OnClickButtonTradeDetails()
	{
		if (DoFormValidate("form_trade_details"))
		{
			DoNextForm("form_trade_details", "form_business_details");
		}
	}

	DoChangeButtonTradeDetailsFunction(OnClickButtonTradeDetails);



	

	function OnClickButtonBusinessDetails()
	{
		if (DoFormValidate("form_business_details"))
		{
			DoNextForm("form_business_details", "form_contact_details");
		}
	}

	DoChangeButtonBusinessDetailsFunction(OnClickButtonBusinessDetails);



	

	function OnClickButtonContactDetails()
	{
		if (DoFormValidate("form_contact_details"))
		{
			DoNextForm("form_contact_details", "form_user_details");
		}
	}

	DoChangeButtonContactDetailsFunction(OnClickButtonContactDetails);

	
	
	
	function OnClickButtonSave()
	{
		let formHidden = DoGetInput("form_hidden_tradie_details");
		
		if (formHidden)
		{
			DoGetInput("htext_username").value = DoGetInput("text_username").value;
			DoGetInput("htext_password").value = DoGetInput("text_password").value;
			DoGetInput("hselect_trade").selectedIndex = DoGetInput("select_trade").selectedIndex;

			let selectAdditionalTrades = DoGetInput("select_additional_trades"),
				hselectAdditionalTrades = DoGetInput("hselect_additional_trades");

			if (selectAdditionalTrades && hselectAdditionalTrades)
			{
				for (let nI = 0; nI < selectAdditionalTrades.options.length; nI++)
				{
					hselectAdditionalTrades.options[nI].selected = selectAdditionalTrades.options[nI].selected;
				}
			}
			DoGetInput("htext_business_name").value = DoGetInput("text_business_name").value;
			DoGetInput("hselect_structure").selectedIndex = DoGetInput("select_structure").selectedIndex;
			DoGetInput("htext_license").value = DoGetInput("text_license").value;
			DoGetInput("htext_description").value = DoGetInput("text_description").value;
			DoGetInput("htext_minimum_charge").value = DoGetInput("text_minimum_charge").value;
			DoGetInput("htext_minimum_budget").value = DoGetInput("text_minimum_budget").value;
			DoGetInput("hselect_maximum_size").selectedIndex = DoGetInput("select_maximum_size").selectedIndex;
			DoGetInput("htext_maximum_distance").value = DoGetInput("text_maximum_distance").value;
			DoGetInput("htext_first_name").value = DoGetInput("text_first_name").value;
			DoGetInput("htext_surname").value = DoGetInput("text_surname").value;
			DoGetInput("htext_unit").value = DoGetInput("text_unit").value;
			DoGetInput("htext_street").value = DoGetInput("text_street").value;
			DoGetInput("htext_suburb").value = DoGetInput("text_suburb").value;
			DoGetInput("htext_postcode").value = DoGetInput("text_postcode").value;
			DoGetInput("hselect_state").selectedIndex = DoGetInput("select_state").selectedIndex;
			DoGetInput("htext_phone").value = DoGetInput("text_phone").value;
			DoGetInput("htext_mobile").value = DoGetInput("text_mobile").value;
			DoGetInput("htext_email").value = DoGetInput("text_email").value;

			formHidden.submit();
		}
	}
	
	DoChangeButtonSaveFunction(OnClickButtonSave);
	SetSelection("select_structure", "<?php echo $_SESSION["account_structure"]; ?>");
	SetSelection("select_maximum_size", "<?php echo $_SESSION["account_maximum_size"]; ?>");
	SetSelection("select_state", "<?php echo $_SESSION["account_state"]; ?>");
			
</script>








				<!-- #EndEditable -->
		<!-- End Page Content -->
		</div>
		<!-- Begin Footer -->
		<div class="footer" id="footer">
			<!--
			<span class="footer_copyright" id="footer_copyright" style="float:right;">Copyright &copy; 2023 <i>Find a Tradie</i>. All Rights Reserved.</span>
			-->
		</div>
		<!-- End Footer -->
	
	</body>
	
	<footer>
		
		<script type="text/javascript">
								
		</script>
	
	</footer>
	
<!-- #EndTemplate -->
	
</html>
