<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<?php include "common.php"; ?>
	
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Account</title>
		<!-- #EndEditable -->
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
				
				.search_table
				{
					width: 98%;
					background-color: white;
					border-style: inset;
					border-width: medium;
					border-color: var(--ColorInactiveBG);
				}
				
				.search_cell
				{
					font-size: small;
					border-bottom-style: solid;
					border-width: thin;
					border-color: black;
					padding: 5px;
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
					min-height: 400px;
					min-width: 1000px;
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
																
				
				.pm_menu
				{
					display: block;
					position: relative;
					margin-top: 30px;
				}
				
				.pm_button
				{
					display: inline-block;
					position: relative;
					margin: 5px;
					border-radius: 10px;
					padding: 8px;
					width: 100px;
				}
				
				.pm_list
				{
					display: block;
					position: relative;
					border-radius: 10px;
				}
				
				.search_form
				{
					background-color: var(--ColorInactiveBG);
					border-style: solid;
					border-width: thin;
					border-radius: var(--BorderRadius);
					border-color: var(--TextColor);
					margin-top: 0px;
				}

			</style>
			
			<?php
				
				if (isset($_POST["submit_feedback_edit"]))
				{
					$bPositive = true;
					
					if ($_POST["feedback"] == "true")
						$bPositive = true;
					else if ($_POST["feedback"] == "false")
						$bPositive = false;

					$results = DoUpdateQuery2($g_dbFindATradie, "feedback", "description", $_POST["textarea_comments"], 
						"positive", $bPositive, "id", $_POST["hidden_feedback_id"]);
					if ($results)
					{
					}
					else
					{
						PrintJavascriptLine("AlertError(\"Could not update feedback!\")", 4, true);
					}
				}
			?>
			
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
	if (!isset($_GET["submit_login"]))
	{
		PrintJavascriptLine("document.location = \"login.php\";", 5, true);
	}
	else if (isset($_GET["paypal"]))
	{
		$nNumMonths = (int)$_GET["paypal"];
		$dateExpiry = new DateTime($_SESSION["account_expiry_date"]);
		$interval = DateInterval::createFromDateString($nNumMonths . " month");
		$dateExpiry = $dateExpiry->add($interval);
		$_SESSION["account_expiry_date"] = $dateExpiry->format("Y-m-d");
		if (DoUpdateQuery1($g_dbFindATradie, "members", "expiry_date", $_SESSION["account_expiry_date"], "id", $_SESSION["account_id"]))
		{
			PrintJSAlertError("Your new renewal date has been updated to " . $dateExpiry->format("d/m/Y"), 5, true);
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
					["AlertError(\"Business name '" . $_POST["text_business_name"] . "' is already in use!\");\n",
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
				PrintJavascriptLine("AlertError(\"Business details could not be updated!\");\n", 2, true);
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
			PrintJavascriptLine("AlertError(\"Contact details could not be updated!\");\n", 2, true);
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
					["AlertError(\"Username '" . $_POST["text_username"] . "' is already in use!\");\n",
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
				PrintJavascriptLine("AlertError(\"User details could not be updated!\");\n", 2, true);
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
	
	function DoGetMaxDistance()
	{
		$strResult = "";
		
		if (isset($_POST["text_maximum_distance"]))
			$strResult = $_POST["text_maximum_distance"];
		else if (isset($_SESSION["account_maximum_distance"]))
			$strResult = sprintf("%d", (int)$_SESSION["account_maximum_distance"]);
		
		return $strResult;
	}
	
	function DoGetMinBudget()
	{
		$strResult = "";

		if (isset($_POST["text_minimum_budget"]))
			$strResult = $_POST["text_minimum_budget"];
		else if (isset($_SESSION["account_minimum_budget"]))
			$strResult = sprintf("%d", (int)$_SESSION["account_minimum_budget"]);

		return $strResult;
	}
	
	function DoGetMaxSize()
	{
		$strResult = "";

		if (isset($_POST["select_maximum_size"]))
			$strResult = $_POST["select_maximum_size"];
		else if (isset($_SESSION["account_maximum_size"]))
			$strResult = sprintf("%d", (int)$_SESSION["account_maximum_size"]);

		return $strResult;
	}
	
	function GetDateSince()
	{
		$strResult = "";

		if (isset($_POST["date_since"]))
			$strResult = $_POST["date_since"];
		else
			$strResult = "";

		return $strResult;
	}
	
	function DoGetTradies()
	{
		/*
		"select_trade"
		"text_maximum_distance"
		*/
		global $g_dbFindATradie;
		$row = null;

		if (isset($_POST["submit_tradie_search"]))
		{
			$strQuery = "SELECT * FROM members WHERE ";
			if (isset($_POST["select_trade"]) && ($_POST["select_trade"] != ""))
			{
				$strQuery = $strQuery . "trade_id='" . $_POST["select_trade"] . "'";
			}
			else
			{
				$strQuery = $strQuery . "1";
			}
			$results = DoQuery($g_dbFindATradie, $strQuery);
			if ($results && ($results->num_rows > 0))
			{
				echo "<td class=\"cell_no_borders search_cell\"><b>ID</b></td>\n";
				echo "<td class=\"cell_no_borders search_cell\"><b>Name<b></td>\n";
				echo "<td class=\"cell_no_borders search_cell\"><b>Email<b></td>\n";
				echo "<td class=\"cell_no_borders search_cell\"><b>Phone<b></td>\n";
				echo "<td class=\"cell_no_borders search_cell\"><b>Mobile<b></td>\n";
				echo "<td class=\"cell_no_borders search_cell\"><b>Postcode<b></td>\n";
				echo "<td class=\"cell_no_borders search_cell\"><b>View<b></td>\n";
				echo "</tr>\n";
				while ($rowMember = $results->fetch_assoc())
				{
					if (IsDistanceMatch($_SESSION["account_postcode"], $rowMember["postcode"], $_POST["text_maximum_distance"]))
					{
						echo "<tr>\n";
						echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["id"] . "</td>";
						echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["first_name"] . " " . $rowMember["surname"] . "</td>";
						echo "<td class=\"cell_no_borders search_cell\"><a href=\"mailto://" . $rowMember["email"] . "?subject=RE: job id: " . $rowJob["id"] . ", posted on date: " . $date->format("d/m/Y") . " on 'Find a Tradie'\">Email member</a></td>\n";
						echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["phone"] . "</td>";
						echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["mobile"] . "</td>";
						echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["postcode"] . "</td>";
						echo "<td class=\"cell_no_borders search_cell\"><a href=\"tradie.php?member_id=" . $rowMember["id"] . "\">VIEW</a></td>";
						echo "</tr>\n";
					}
				}
			}
		}
	}
	
	function DoGetJobs()
	{
		global $g_dbFindATradie;
		$row = null;
		
		if (isset($_POST["submit_job_search"]))
		{
			/*
				Array ( [text_maximum_distance] => 20 [text_minimum_budget] => 5000 [date_since] => [submit_job_search] => SEARCH )
				Array ( [text_maximum_distance] => 20 [text_minimum_budget] => 5000 [date_since] => 2023-11-01 [checkbox_urgent] => on [submit_job_search] => SEARCH ) 
				Array ( [text_maximum_distance] => [text_minimum_budget] => 5000 [date_since] => [submit_job_search] => SEARCH ) 
			*/
			$strAND = "";
			
			$strQuery = "SELECT * FROM jobs WHERE ";
			if (isset($_POST["text_minimum_budget"]) && ($_POST["text_minimum_budget"] != ""))
			{
				$strQuery = $strQuery . "maximum_budget>='" . $_POST["text_minimum_budget"] . "'";
				$strAND = " AND ";
			}
			if (isset($_POST["date_since"]) && ($_POST["date_since"] != ""))
			{
				$strQuery = $strQuery . $strAND . "date_added>='" . $_POST["date_since"] . "'";
				$strAND = " AND ";
			}
			if (isset($_POST["checkbox_urgent"]) && ($_POST["checkbox_urgent"] == "on"))
			{
				$strQuery = $strQuery . $strAND . "urgent=1";
			}
			if (strrpos($strQuery, "WHERE") == 19)
			{
				$strQuery = $strQuery . "1";
			}
		}
		else
		{
			$strQuery = "SELECT * FROM jobs WHERE maximum_budget>='" . $_SESSION["account_minimum_budget"] . "'";
		}
		$results = DoQuery($g_dbFindATradie, $strQuery);
		if ($results && ($results->num_rows > 0))
		{
			echo "<tr>\n";
			echo "<td class=\"cell_no_borders search_cell\"><b>ID</b></td>\n";
			echo "<td class=\"cell_no_borders search_cell\"><b>Date<b></td>\n";
			echo "<td class=\"cell_no_borders search_cell\"><b>Name<b></td>\n";
			echo "<td class=\"cell_no_borders search_cell\"><b>Email<b></td>\n";
			echo "<td class=\"cell_no_borders search_cell\"><b>Maximum budget<b></td>\n";
			echo "<td class=\"cell_no_borders search_cell\"><b>Size<b></td>\n";
			echo "<td class=\"cell_no_borders search_cell\"><b>Urgent?<b></td>\n";
			echo "<td class=\"cell_no_borders search_cell\"><b>Description<b></td>\n";
			echo "</tr>\n";
			while ($rowJob = $results->fetch_assoc())
			{
				$rowMember = DoGetMember($rowJob["member_id"]);

				if (IsDistanceMatch($_SESSION["account_postcode"], $rowMember["postcode"], $_SESSION["account_maximum_distance"]) && 
					(DoGetSizeIndex($rowJob["size"]) <= DoGetSizeIndex($_SESSION["account_maximum_size"])))
				{
					echo "<tr>\n";
					$date = new DateTime($rowJob["date_added"]);
					echo "<td class=\"cell_no_borders search_cell\">" . $rowJob["id"] . "</td>";
					echo "<td class=\"cell_no_borders search_cell\">" . $date->format("d/m/Y") . "</td>\n";
					echo "<td class=\"cell_no_borders search_cell\">" . $rowMember["first_name"] . " " . $rowMember["surname"] . "</td>";
					echo "<td class=\"cell_no_borders search_cell\"><a href=\"mailto://" . $rowMember["email"] . "?subject=RE: job id: " . $rowJob["id"] . ", posted on date: " . $date->format("d/m/Y") . " on 'Find a Tradie'\">Email member</a></td>\n";
					echo "<td class=\"cell_no_borders search_cell\">" . sprintf("$%d", $rowJob["maximum_budget"]) . "</td>";
					echo "<td class=\"cell_no_borders search_cell\">" . $rowJob["size"] . "</td>";
					if ($rowJob["urgent"])
						echo "<td class=\"cell_no_borders search_cell\">YES</td>";
					else
						echo "<td class=\"cell_no_borders search_cell\">NO</td>";
					echo "<td class=\"cell_no_borders search_cell\"><button type=\"button\" onclick=\"AlertInformation('JOB DESCRIPTION', '" . $rowJob["description"] . "')\">View job description</button></td>\n";
					echo "</tr>\n";
				}
			}
			echo "<tr><td class=\"cell_no_borders search_cell\" colspan=\"8\">&nbsp;</td></tr>\n";
		}
		else
		{
			echo "<tr><td style=\"height:30px;\">No jobs found based on your account job preferences. Try searching with different job preferences.</td></tr>\n";
		}
	}
?>

		<!-- #EndEditable -->
	</head>
	
	<body>
	
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








				<div class="note" style="flex-wrap:wrap;">

					<form method="post" id="form_logout" action="login.php">
						<input type="submit" class="button" id="submit_logout" name="submit_logout" value="LOG OUT" />
					</form>
					
					<div style="width:2000px;visibility:hidden">SPACE FILLER</div>

					<div id="paypal" style="display:<?php echo 	$strPaypalDisplay; ?>;">						
						<h2>It is time to renew your membership...</h2><br/>
						<table class="paypal_table">
							<tr>
								<td class="paypal_cell paypal_first_cell">1 month</td>
								<td class="paypal_cell paypal_first_cell">$<?php printf("%0.2f", $g_nCostPerMonth); ?></td>
								<td class="paypal_cell paypal_first_cell">
									<div id="live1" style="display: <?php echo $g_strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="UYVQLYZVXKVHN" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>									</div>
									<div id="debug1" style="display: <?php echo $g_strPaypalTest; ?>;">
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
									<div id="live6" style="display: <?php echo $g_strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="3HA4WCZAD3DZE" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>					
									</div>
									<div id="debug6" style="display: <?php echo $g_strPaypalTest; ?>;">
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
									<div id="live12" style="display: <?php echo $g_strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="LVG5EVU9Y9SM4" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>
									</div>
									<div id="debug12" style="display: <?php echo $g_strPaypalTest; ?>;">
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
									<div id="live18" style="display: <?php echo $g_strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="V6JERUCM52TGN" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>	
									</div>
									<div id="debug18" style="display: <?php echo $g_strPaypalTest; ?>;">
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
									<div id="live24" style="display: <?php echo $g_strPaypalLive; ?>;">
										<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										  <input type="hidden" name="cmd" value="_s-xclick" />
										  <input type="hidden" name="hosted_button_id" value="KS2BA9S5L8TMG" />
										  <input type="hidden" name="currency_code" value="AUD" />
										  <input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
										</form>										
									</div>
									<div id="debug24" style="display: <?php echo $g_strPaypalTest; ?>;">
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
						<button class="tab_button" id="tab_button1" onclick="DoOpenTab('tab_button1', 'tab_contents1')"><?php if (IsTradie()) echo "Browse your jobs"; else echo "Browse tradies";?></button>
						<button class="tab_button" id="tab_button2" onclick="DoOpenTab('tab_button2', 'tab_contents2')">Post your own job</button>
						<button class="tab_button" id="tab_button3" onclick="DoOpenTab('tab_button3', 'tab_contents3')">Account details</button>
						<button class="tab_button" id="tab_button4" onclick="DoOpenTab('tab_button4', 'tab_contents4')">Feedback you've received</button>
						<button class="tab_button" id="tab_button5" onclick="DoOpenTab('tab_button5', 'tab_contents5')">Feedback you've given</button>

						<div id="tab_contents1" class="tab_content">
							<h2><script type="text/javascript">document.write(document.getElementById("tab_button1").innerText);</script></h2>
								<form method="post" action="" id="form_job_search" class="form search_form" style="display:<?php if (IsTradie()) echo "block"; else echo "none";?>;width:800px;">
									<table  cellspacing="0" cellpadding="3" border="0" style="table-layout:fixed;">
										<tr>
											<td style="width:150px;"><b>Maximum distance</b></td>
											<td style="width:140px;"><b>Minimum budget</b></td>
											<td style="width:140px;"><b>Maximum size</b></td>
											<td style="width:125px;"><b>Jobs added since</b></td>
											<td style="width:110px;"><b>Urgent jobs only</b></td>
											<td style="width:100px;text-align:center;" rowspan="2"><input type="submit" id="submit_job_search" name="submit_job_search" value="SEARCH" /></td>
										</tr>
										<tr>	
											<td><input type="text" id="text_maximum_distance" name="text_maximum_distance" maxlength="4" size="15" value="<?php echo DoGetMaxDistance() ?>" onclick="OnKeyPressDigitsOnly(event)" />&nbsp;<b>km</b></td>
											<td><b>$</b>&nbsp;<input type="text" id="text_minimum_budget" name="text_minimum_budget" maxlength="7" size="15" value="<?php echo DoGetMinBudget(); ?>" onclick="OnKeyPressDigitsOnly(event)" /></td>
											<td>
												<select id="select_maximum_size" name="select_maximum_size">
													<option <?php if (DoGetSizeIndex($_SESSION["account_maximum_size"]) == 0) echo "selected"; ?>>Up to 50</option>
													<option<?php if (DoGetSizeIndex($_SESSION["account_maximum_size"]) == 1) echo "selected"; ?>>50 - 100</option>
													<option<?php if (DoGetSizeIndex($_SESSION["account_maximum_size"]) == 2) echo "selected"; ?>>100 - 250</option>
													<option<?php if (DoGetSizeIndex($_SESSION["account_maximum_size"]) == 3) echo "selected"; ?>>250 - 500</option>
													<option<?php if (DoGetSizeIndex($_SESSION["account_maximum_size"]) == 4) echo "selected"; ?>>More than 500</option>
												</select>&nbsp;<b>m<sup>2</sup></b>
											</td>											
											<td><input type="date" id="date_since" name="date_since" value="\<?php echo GetDateSince(); ?>\"/></td>
											<td><input type="checkbox" id="checkbox_urgent" name="checkbox_urgent" <?php if (isset($_POST["checkbox_urgent"]) && ($_POST["checkbox_urgent"] == "on")) echo "checked"; ?>/></td>
										</tr>
									</table>
								</form>
								<form method="post" action="" id="form_tradie_search" class="form search_form" style="width:98%;display:<?php if (!IsTradie()) echo "block"; else echo "none"; ?>">
									<table  cellspacing="0" cellpadding="3" border="0" style="table-layout:fixed;">
										<tr>
											<td style="width:950px;"><b>Trade type</b></td>
											<td style="width:185px;"><b>Maximum distance from you</b></td>
											<td style="width:100px;text-align:center;" rowspan="2"><input type="submit" id="submit_tradie_search" name="submit_tradie_search" value="SEARCH" /></td>
										</tr>
										<tr>	
											<td>
												<select id="select_trade" name="select_trade" onchange="OnChangeTrade(this, DoGetInput('trade_description'))">
													<?php if (isset($_POST["select_trade"])) DoGeneratePrimaryTradeOptions($_POST["select_trade"]); else DoGeneratePrimaryTradeOptions($_SESSION["account_trade"]); ?>
												</select>
												<br/><br/>
												<label id="trade_description">XXXXXXXXXXXXX</label>
											</td>											
											<td><input type="text" id="text_maximum_distance" name="text_maximum_distance" maxlength="4" size="15" value="<?php if (isset($_POST["text_maximum_distance"])) echo $_POST["text_maximum_distance"]; ?>" onclick="OnKeyPressDigitsOnly(event)" />&nbsp;<b>km</b></td>
										</tr>
									</table>
								</form>
								
								<table class="table_no_borders search_table">
									<?php
										
										if (IsTradie())
										{
											DoGetJobs();
										}
										else
										{
											DoGetTradies();
										}
																		
									?>
								</table>
						</div>
						
						<div id="tab_contents2" class="tab_content">
							<h2><script type="text/javascript">document.write(document.getElementById("tab_button2").innerText);</script></h2>
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
							<table cellspacing="0" cellpadding="10">
<?php
	DoDisplayFeedback($_SESSION["account_id"], "", true);
?>
							</table>
						</div>

						<div id="tab_contents5" class="tab_content">
<?php
	DoDisplayFeedback("", $_SESSION["account_id"], true);
?>
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
				AlertError("The two passwords do not match!");
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
	
	//DoChangeButtonSaveFunction(OnClickButtonSave);
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
		
		<!-- #BeginEditable "footer" -->



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
