<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>NEW TRADIE</title>
		<!-- #EndEditable -->
		<?php include "common.php"; ?>
		<?php include "common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<!-- #BeginEditable "page_styles" -->
			<style>
			</style>
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








<?php
				
	$_SESSION["account_additional_trades"] = [];

	//*******************************************************************************************
	//*******************************************************************************************
	//* 
	//* Form data processing functions
	//* 
	//*******************************************************************************************
	//*******************************************************************************************
	
	if (isset($_POST["text_business_name"]))
	{
		/*
			Array ( 
				[text_username] => debian-sys-maint 
				[text_password] => wCN5zhYx5R6004zg 
				[select_trade] => 1 
				[select_additional_trades] => Array ( [0] => 3 [1] => 4 [2] => 5 [3] => 6 ) 
				[text_business_name] => xxxxxxxxxxxxx 
				[text_abn] => 
				select_structure] => Sole trader 
				[text_license] => 
				[text_description] => 
				[text_minimum_charge] => 35 
				[text_minimum_budget] => 53 
				[select_maximum_size] => Up to 50 
				[text_maximum_distance] => 54 
				[text_first_name] => Fred 
				[text_surname] => Smith 
				[text_unit] => 23 
				[text_street] => 56 Derby Drive 
				[text_suburb] => Epping 
				[select_state] => VIC 
				[text_postcode] => 3076 
				[text_phone] => 45678987 
				[text_mobile] => 0456345298 
				[text_email] => f@gmail.com)
		*/
		if (DoFindQuery1($g_dbFindATradie, "members", "username", $_POST["text_username"]))
		{
			PrintJavascriptLine("AlertError(\"username '" . $_POST["text_username"] . "' is already registered by someone else!\");", 2, true);
		}
		else if (DoFindQuery1($g_dbFindATradie, "members", "business_name", $_POST["text_business_name"]))
		{
			PrintJavascriptLine("AlertError(\"buisness name '" . $_POST["text_business_name"] . "' is already registered by some one else!\");",  2, true);
		}
		else if (DoFindQuery1($g_dbFindATradie, "members", "abn", $_POST["text_abn"]))
		{
			PrintJavascriptLine("AlertError(\"ABN '" . $_POST["text_abn"] . "' is already registered by someone else!\");",  2, true);
		}
		else
		{
			$_SESSION["account_id"] = $_POST["text_id"];
			$_SESSION["account_trade"] = $_POST["select_trade"];
			$_SESSION["account_additional_trades"] = $_POST["select_additional_trades"];
			$_SESSION["account_business_name"] = $_POST["text_business_name"];
			$_SESSION["account_first_name"] = $_POST["text_first_name"];
			$_SESSION["account_surname"] = $_POST["text_surname"];
			$_SESSION["account_abn"] = $_POST["text_abn"];
			$_SESSION["account_structure"] = $_POST["select_structure"];
			$_SESSION["account_license"] = $_POST["text_license"];
			$_SESSION["account_description"] = $_POST["text_description"];
			$_SESSION["account_minimum_charge"] = $_POST["text_minimum_charge"];
			$_SESSION["account_minimum_budget"] = $_POST["text_minimum_budget"];
			$_SESSION["account_maximum_size"] = $_POST["select_maximum_size"];
			$_SESSION["account_maximum_distance"] = $_POST["text_maximum_distance"];
			$_SESSION["account_unit"] = $_POST["text_unit"];
			$_SESSION["account_street"] = $_POST["text_street"];
			$_SESSION["account_suburb"] = $_POST["text_suburb"];
			$_SESSION["account_state"] = $_POST["select_state"];
			$_SESSION["account_postcode"] = $_POST["text_postcode"];
			$_SESSION["account_phone"] = $_POST["text_phone"];
			$_SESSION["account_mobile"] = $_POST["text_mobile"];				
			$_SESSION["account_email"] = $_POST["text_email"];
			$_SESSION["account_username"] = $_POST["text_username"];
			$_SESSION["account_password"] = $_POST["text_password"];

			$strQuery = "INSERT INTO members (trade, business_name, first_name, surname, abn, structure, license, description, " . 
							"minimum_charge, minimum_budget, maximum_size, maximum_distance, unit, street, suburb, state, postcode, ".
							"phone, mobile, email, username password expiry_date) VALUES (" .
							AppendSQLValues($_POST["select_trade"], $_POST["text_business_name"], 
							$_POST["text_first_name"], $_POST["text_surname"],  $_POST["text_abn"],  $_POST["select_structure"],  
							$_POST["text_license"], $_POST["text_description"],  $_POST["text_minimum_charge"],  
							$_POST["text_minimum_budget"],   $_POST["select_maximum_size"],  $_POST["text_maximum_distance"],  
							$_POST["text_unit"],  $_POST["text_street"],  $_POST["text_suburb"],  $_POST["select_state"],  
							$_POST["text_postcode"],  $_POST["text_phone"],  $_POST["text_mobile"],  $_POST["text_email"], 
							$_POST["text_username"], $_POST["text_password"], date("Y-m-d") ) . ")";
	
			$result = DoQuery($g_dbFindATradie, $strQuery);
			if ($result->num_rows == 1)
			{
				$row = $result->fetch_assoc();
				$strMemberID = $row["id"];
				$arrayAdditionalTrades = $_POST["select_additional_trades"];
				$bResult = true;

				foreach ($arrayAdditionalTrades as $strTradeID)
				{
					$result = DoInsertQuery2($g_dbFindATradie, "additional_trades", "client_id", $row["id"], "trade_id", $strTradeID);
					if ($result->num_rows == 0)
					{
						PrintJavascriptLine("AlertError(\"there was a problem inserting a record into 'additional_trades' in new_tradie.php!\");", 4, true);
						$bResult = false;
						break;
					}
				}
				if ($bResult)
				{
					PrintJavascriptLines(["AlertSuccess(\"Your details were saved to the database!\");",
											"DoGetInput('form_tradie_login').submit();"], 4, true);
				}
			}
			else
			{
				PrintJavascriptLine("AlertError(\"there was a problem inserting a record into 'members' in new_tradie.php!\");", 4, true);
			}
		}
	}
	else
	{
		print_r($_POST);
	}

				
				
	$g_strButtonText = "NEXT";
	$g_bIsStaged = true;
	include "member_details_forms.html"; 
?>
					

					<form method="post" action="new_tradie.php" id="form_hidden_tradie_details" style="visibility: hidden">
						<input type="text" id="htext_username" name="text_username" />
						<input type="text" id="htext_password" name="text_password" />
						<select id="hselect_trade" name="select_trade">
							<?php DoGeneratePrimaryTradeOptions(); ?>
						</select>
						<select id="hselect_additional_trades" name="select_additional_trades[]" multiple="multiple">
							<?php DoGenerateAdditionalTradeOptions($_SESSION["account_additional_trades"]); ?>
						</select>
						<input type="text" id="htext_business_name" name="text_business_name" />
						<input type="text" id="htext_abn" name="text_abn" />
						<select id="hselect_structure" name="select_structure">
							<option>Sole trader</option>
							<option>Company</option>
							<option>Cooperative</option>
							<option>Partnership</option>
							<option>Indigenous corporation</option>
						</select>
						<textarea id="htext_license" name="text_license"></textarea>
						<textarea id="htext_description" name="text_description"></textarea>
						<input type="text" id="htext_minimum_charge" name="text_minimum charge" />
						<input type="text" id="htext_minimum_budget" name="text_minimum_budget" />
						<select id="hselect_maximum_size" name="select_maximum_size">
							<option selected>Up to 50</option>
							<option>50 - 100</option>
							<option>100 - 250</option>
							<option>250 - 500</option>
							<option>More than 500</option>
						</select>
						<input type="text" id="htext_maximum_distance" name="text_maximum distance" />
						<input type="text" id="htext_first_name" name="text_first_name" />
						<input type="text" id="htext_surname" name="text_surname" />
						<input type="text" id="htext_unit" name="text_unit" />
						<input type="text" id="htext_street" name="text_street" />
						<input type="text" id="htext_suburb" name="text_suburb" />
						<select id="hselect_state" name="select_state">
							<option selected=>ACT</option>
							<option>NSW</option>
							<option>NT</option>
							<option>QLD</option>
							<option>SA</option>
							<option>TAS</option>
							<option>VIC</option>
							<option>WA</option>
						</select>
						<input type="text" id="htext_postcode" name="text_postcode" />
						<input type="text" id="htext_phone" name="text_phone" />
						<input type="text" id="htext_mobile" name="text_mobile" />
						<input type="text" id="htext_email" name="text_email" />
					</form>

				
				
				
					<form method="post" id="form_tradie_login" style="visibility:hidden;" action="login.php">
						<input type="text" id="text_username" name="text_username" value="<?php if (isset($_POST["text_username"])) echo $_POST["text_username"]; ?>"/>
						<input type="text" id="text_password" name="text_password" value="<?php if (isset($_POST["text_password"])) echo $_POST["text_password"]; ?>"/>
						<input type="submit" name="submit_login" value="LOG IN" />
					</form>
					







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
					divPageContent.style.width = document.documentElement.offsetWidth;
				}
			}
			SetPageContetHeight();
			
		</script>
	
	</footer>
	
<!-- #EndTemplate -->
	
</html>