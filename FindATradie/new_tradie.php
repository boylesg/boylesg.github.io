<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>NEW TRADIE</title>
		<!-- #EndEditable -->
		<?php include "common.php"; ?>
		<link href="styles/style2.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<script src="common.js"></script>
		<script src="AustraliaPost.js"></script>
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

	$g_bDoRedirectToLogin = false;

	//*******************************************************************************************
	//*******************************************************************************************
	//* 
	//* Trade related HTML generation functions
	//* 
	//*******************************************************************************************
	//*******************************************************************************************

	function DoGenerateTradesRadioButtons()
	{	
		global $g_dbFindATradie;
		$strChecked = "checked "; 
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
		
		while ($row = $queryResult->fetch_assoc())
	    {
	    	PrintIndents(8);
			echo "<tr>\n";
			PrintIndents(9);
			echo "<td style=\"text-align:right;width:1em;\" class=\"trade_table_cell\"><input type=\"radio\" name=\"radio_trade\" id=\"radio_" . $row["id"] . "\" " . $strChecked . "value=\"" . $row["id"] . "\" /></td>\n";
			PrintIndents(9);
			echo "<td style=\"text-align:left;width:20em;\" class=\"trade_table_cell\">" . strtoupper($row["name"][0]) . substr($row["name"], 1) ."</td>\n";
			PrintIndents(9);
			echo "<td colspan=\"2\" style=\"text-align:left;\" class=\"trade_table_cell\"><label>" . $row["description"] . "</label></td>\n";
			$strChecked = "";		
			PrintIndents(8);
			echo "</tr>\n";
			$strChecked = "";
	    }
	    $queryResult->free_result();
	}

	function DoGenerateHiddenTradesRadioButtons()
	{	
		global $g_dbFindATradie;
		$strChecked = "checked "; 
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
		
		while ($row = $queryResult->fetch_assoc())
	    {
	    	PrintIndents(6);
			echo "<input type=\"radio\" name=\"hidden_radio_" . $row["id"] . "\" id=\"hidden_radio_" . $row["id"] . "\" " . $strChecked . "value=\"" . $row["id"] . " \"/>\n";
	    	$strChecked = "";
	    }
	    $queryResult->free_result();
	}

	function DoGenerateAdditionalTradesCheckBoxes()
	{	
		global $g_dbFindATradie;
		$nCount = 0;
		$nNumCols = 20;
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
		
		while ($row = $queryResult->fetch_assoc())
	    {
	    	if (($nCount == 0) || (($nCount % $nNumCols) == 0))
	    	{
	    		PrintIndents(12);
	    		echo "<td>\n";
	    	}
	    	PrintIndents(13);
			echo "<input type=\"checkbox\" id=\"checkbox_" . $row["id"] . "\" name=\"hidden_checkbox_" . $row["id"] . "\" value=\"" . $row["id"] . "\" />";
			echo "<label>" . $row["name"] . "</label><br/>\n";	
    		$nCount++;
	    	if (($nCount % $nNumCols) == 0)
	    	{
	    		PrintIndents(12);
	    		echo "</td>\n";
	    		$nCount = 0;
	    	}
	    }
	    $queryResult->free_result();
	}

	function DoGenerateHiddenAdditionalTradesCheckBoxes()
	{	
		global $g_dbFindATradie;
		 
		$queryResult = $g_dbFindATradie->query("SELECT id, name, description FROM trades ORDER BY name");
		
		while ($row = $queryResult->fetch_assoc())
	    {
	    	PrintIndents(6);
			echo "<input type=\"checkbox\" id=\"hidden_checkbox_" . $row["id"]  . "\" name=\"hidden_checkbox_" . $row["id"] . "\" value=\"" . $row["id"] . "\" />\n";
	    }
	    $queryResult->free_result();
	}
	
	function DoDebugPostData()
	{
		$_POST["SUBMIT"] = "new_tradie";
		$_POST["hidden_business_name"] = "Greg's Native Landscapes"; 
		$_POST["hidden_first_name"] = "Greg";
		$_POST["hidden_surname"] = "Boyles"; 
		$_POST["hidden_abn"] = "51 824 753 556"; 
		$_POST["hidden_structure"] = "Sole trader"; 
		$_POST["hidden_license"] = "";
		$_POST["hidden_description"] = "Ecological weed control\nLow maintenance\nDrought tolerant\nIrrigation systems\nSmall retaining walls\nSmall tree removal\nGeneral pruning\nBush tucker gardens\nSmall ornamental billabongs\nNative lawns"; 
		$_POST["hidden_minimum_charge"] = "100"; 
		$_POST["hidden_minimum_budget"] = "5000";  
		$_POST["hidden_maximum_size"] = "Up to 50"; 
		$_POST["hidden_maximum_distance"] = "20"; 
		$_POST["hidden_unit"] = ""; 
		$_POST["hidden_street"] = "56 Derby Drive"; 
		$_POST["hidden_suburb"] = "Epping"; 
		$_POST["hidden_state"] = "VIC"; 
		$_POST["hidden_postcode"] = "3076"; 
		$_POST["hidden_phone"] = "94013696"; 
		$_POST["hidden_mobile"] = "0455328886"; 
		$_POST["hidden_email"] = "gregplants@bigpond.com";
		$_POST["hidden_username"] = "boylesg";
		$_POST["hidden_password"] = "password";
 		$_POST["hidden_radio_52"] = "52"; 
 		$_POST["hidden_checkbox_21"] = "21"; 
 		$_POST["hidden_checkbox_24"] = "24"; 
 		$_POST["hidden_checkbox_29"] = "29";
 		$_POST["hidden_checkbox_30"] = "30";
 		$_POST["hidden_checkbox_52"] = "52";
 		$_POST["hidden_checkbox_54"] = "54";
 		$_POST["hidden_checkbox_35"] = "35";	
 	}

	//*******************************************************************************************
	//*******************************************************************************************
	//* 
	//* Form data processing functions
	//* 
	//*******************************************************************************************
	//*******************************************************************************************

	/*
		Array (
				[SUBMIT] => new_tradie
				[hidden_business_name] => Greg's Native Landscapes 
				[hidden_first_name] => Greg 
				[hidden_surname] => Boyles 
				[hidden_abn] => 51 824 753 556 
				[hidden_structure] => Sole trader 
				[hidden_license] => 
				[hidden_description] => Ecological weed control Low maintenance Drought tolerant Irrigation systems Small retaining walls Small tree removal General pruning Bush tucker gardens Small ornamental billabongs Native lawns 
				[hidden_minimum_charge] => 100 
				[hidden_minimum_budget] => 5000 
				[hidden_maximum_size] => Up to 50 
				[hidden_maximum_distance] => 20 
				[hidden_unit] => 
				[hidden_street] => 56 Derby Drive 
				[hidden_suburb] => ABBEYARD 
				[hidden_state] => VIC 
				[hidden_postcode] => 3737 
				[hidden_mobile] => 0455328886 
				[hidden_phone] => 94013696 
				[hidden_email] => gregplants@bigpond.com 
				[hidden_username] => boylesg 
				[hidden_password] => password 
				[hidden_radio_52] => 52 
				[hidden_checkbox_21] => 21 
				[hidden_checkbox_24] => 24 
				[hidden_checkbox_30] => 30 
				[hidden_checkbox_52] => 52 
				[hidden_checkbox_54] => 54 
				[hidden_checkbox_35] => 35 
			) 
	*/
//	DoDebugPostData();
	if (count($_POST) > 0)
	{
		if ($_POST["SUBMIT"] === "new_tradie")
		{
			$arrayAdditionalTrades = array();
			$strTrade = -1;
			$strMemberID = "";
	
			foreach( $_POST as $strKey => $strValue)
			{
				if (strpos($strKey, "hidden_radio_") !== false)
				{
					$strTrade = $strValue;
				}
				else if (strpos($strKey, "hidden_checkbox_") !== false)
				{
					array_push($arrayAdditionalTrades, (int)$strValue);
				}
			}
			$strQuery = "INSERT INTO members (trade, business_name, first_name, surname, abn, structure, license, description, " . 
							"minimum_charge, minimum_budget, maximum_size, maximum_distance, unit, street, suburb, state, postcode, ".
							"phone, mobile, email, username password expiry_date) VALUES (" .
							AppendSQLValues($strTrade, $_POST["hidden_business_name"], 
							$_POST["hidden_first_name"], $_POST["hidden_surname"],  $_POST["hidden_abn"],  $_POST["hidden_structure"],  
							$_POST["hidden_license"], $_POST["hidden_description"],  $_POST["hidden_minimum_charge"],  
							$_POST["hidden_minimum_budget"],   $_POST["hidden_maximum_size"],  $_POST["hidden_maximum_distance"],  
							$_POST["hidden_unit"],  $_POST["hidden_street"],  $_POST["hidden_suburb"],  $_POST["hidden_state"],  
							$_POST["hidden_postcode"],  $_POST["hidden_phone"],  $_POST["hidden_mobile"],  $_POST["hidden_email"], 
							$_POST["hidden_username"], $_POST["hidden_password"], date("Y-m-d") ) . ")";
	
			$result = DoInsertQuery1($g_dbFindATradie, $strQuery, "members", "business_name", $_POST["hidden_business_name"]);
			if ($result->num_rows == 1)
			{
				$row = $result->fetch_assoc();
				$strMemberID = $row["id"];
				$g_bDoRedirectToLogin = true;

				foreach ($arrayAdditionalTrades as $strValue)
				{
					$strQuery = "INSERT INTO additional_trades (member_id, trade_id) VALUES (" . AppendSQLValues($strMemberID, $strValue) . ")";
					$result = DoInsertQuery1($g_dbFindATradie, $strQuery, "members", "business_name", $_POST["hidden_business_name"], "user_name", $_POST["hidden_username"]);
				}
			}
		}
		else
		{
			print_r($_POST);
		}
	}
?>

					<div id="trade" style="display:none;">
						<h2>What is your primary trade?</h2>
						<form id="form_select_trade" class="form_trade">
							<table border="0" style="width:100%;table-layout: fixed;">

<?php DoGenerateTradesRadioButtons(); ?>

								<tr>
									<td style="text-align:left;">
										<?php
											echo "<a href=\"mailto:gregplants@bigpond.com?subject=Request a new trade&body=Trade name: %0D%0A%0D%0A%0D%0ADescription%0D%0A----------------%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A\"><h4>Request addition of a new trade.<h4></a>";
										?>
									</td>
								</tr>
								<tr>
									<td><b><u>Any sdditional trades your are qualified in.</u></b></td>
								</tr>
								<tr>
									<td style="text-align::left;">
										<table border="0" style="width:100%;table-layout:fixed;">
											<tr>
<?php DoGenerateAdditionalTradesCheckBoxes(); ?>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><br/><input type="button" value="Next" class="next_button" onclick="DoNext('trade', 'business_details', 'form_select_trade')"/></td>
								</tr>
							</table>
						</form>
					</div>
					
					<div id="business_details" style="display:none;">
						<h2>Details about your business</h2>
						<form id="form_business_details" class="form_trade" style="width:55em;">
							<table>
								<tr>
									<td colspan="2"><b><u>Business details</u></b></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Business name</b></td>
									<td><input type="text" id="business_name" size="32" name="business name" pattern="!blank" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Your first name</b></td>
									<td><input type="text" id="first_name" size="32" name="first name" pattern="!blank" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Your surname</b></td>
									<td><input type="text" id="surname" size="32" name="surname" pattern="!blank" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>ABN</b></td>
									<td><input type="text" id="abn" size="32" name="ABN" pattern="!blank digits11" />&nbsp;&nbsp;<label>e.g. 51 824 753 556</label></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Business structure</b></td>
									<td>
										<select id="structure" name="structure">
											<option selected>Sole trader</option>
											<option>Company</option>
											<option>Cooperative</option>
											<option>Partnership</option>
											<option>Indigenous corporation</option>
											<option></option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Trade license &amp; professional membership details</b></td>
									<td style="text-align:left;"><textarea id="license" name="Trade licenses & professional memberships" cols="64" rows="4" pattern=""></textarea></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Description of business &amp; services</b></td>
									<td style="text-align:left;"><textarea id="description" name="Description of business & services" cols="64" rows="16" pattern="!blank"></textarea></td>
								</tr>
								<tr>
									<td colspan="2"><b><u>Job preferences</u></b></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Minimum charge $</b></td>
									<td style="text-align:left;"><input type="text" id="minimum_charge" size="8" name="minimum charge" value="100" onkeydown="OnKeyPressNumberInput(event)" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Minimum preferred budget $</b></td>
									<td style="text-align:left;"><input type="text" id="minimum_budget" size="8" name="minimum_budget" value="5000" onkeydown="OnKeyPressNumberInput(event)" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Maximum preferred job size</b></td>
									<td style="text-align:left;">on
										<select id="maximum_size" name="maximum_size">
											<option selected>Up to 50</option>
											<option>50 - 100</option>
											<option>100 - 250</option>
											<option>250 - 500</option>
											<option>More than 500</option>
										</select>
										<b>m<sup>2</sup></b>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Maximum distance you will travel</b></td>
									<td style="text-align:left;"><input type="text" id="maximum_distance" name="maximum distance" size="8" value="20" style="text-align:right" onkeydown="OnKeyPressNumberInput(event)" />&nbsp;<b>km</b></td>
								</tr>
								<tr>
									<td style="text-align:left;"><br/><input type="button" value="Previous" class="next_button" onclick="DoNext('business_details', 'trade', '')"/></td>
									<td style="text-align:right;"><br/><input type="button" value="Next" class="next_button" onclick="DoNext('business_details', 'business_contact_details', 'form_business_details')"/></td>
								</tr>
							</table>
						</form>					
					</div>

					<div id="business_contact_details" style="display:none;">
						<h2>Business contact details</h2>
						<form id="form_contact_details" class="form_trade">
							<table>
								<tr>
									<td style="text-align:right;"><b>Unit</b></td>
									<td style="text-align:left;"><input type="text" id="unit" name="unit" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Street</b></td>
									<td><textarea id="street" name="street" cols="64" rows="2" pattern="!blank"></textarea></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>City, suburb or town</b></td>
									<td style="text-align:left;">
										<select id="suburb" name="city/suburb/town" style="width:18em;" onchange="OnChangeSuburb(this, document.getElementById('postcode'), document.getElementById('state'))">
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>State</b></td>
									<td style="text-align:left;">
										<select id="state" name="state" onchange="OnChangeState(this, document.getElementById('suburb'), document.getElementById('postcode'))">
											<option selected=>ACT</option>
											<option>NSW</option>
											<option>NT</option>
											<option>QLD</option>
											<option>SA</option>
											<option>TAS</option>
											<option>VIC</option>
											<option>WA</option>
										</select>
									
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Postcode</b></td>
									<td style="text-align:left;">
										<select id="postcode" name="postcode" onchange="OnChangePostcode(this, document.getElementById('suburb'), document.getElementById('state'))">
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Office phone number</b></td>
									<td style="text-align:left;"><input type="text"  id="phone" name="office phone number" pattern="!blank digits8" onkeydown="OnKeyPressNumberInput(event)" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Mobile number</b></td>
									<td style="text-align:left;"><input type="text"  id="mobile" name="mobile number" pattern="!blank digits10" onkeydown="OnKeyPressNumberInput(event)" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Email address</b></td>
									<td style="text-align:left;"><input type="text"  id="email" name="email address" pattern="!blank email" /></td>
								</tr>
								<tr>
									<td style="text-align:left;"><input type="button" value="Previous" class="next_button" onclick="DoNext('business_contact_details', 'business_details')"/></td>
									<td style="text-align:right;"><input type="button" value="Next" class="next_button" onclick="DoNext('business_contact_details', 'account_details', 'form_contact_details')"/></td>
								</tr>
							</table>
						</form>					
					</div>

					<div id="account_details" style="display:none;">
						<h2>Account details</h2>
						<form id="form_account_details" class="form_trade">
							<table>
								<tr>
									<td style="text-align:right;"><b>Username or email address</b></td>
									<td style="text-align:left;"><input type="text" id="username" name="username" pattern="!blank6" /></td>
								</tr>
								<tr>
									<td style="text-align:right;"><b>Password</b></td>
									<td><input type="password" id="password" name="password" pattern="!blank12" />&nbsp;<input type="checkbox" id="check_show_password" onclick="OnClickCheckShowPassword(this, document.getElementById('password'))"/></td>
								</tr>
								<tr>
									<td style="text-align:left;"><br/><input type="button" value="Previous" class="next_button" onclick="DoNext('form_account_details', 'business_contact_details')"/></td>
									<td style="text-align:right;"><br/><input type="button" value="Next" class="next_button" onclick="DoSubmit('form_account_details', 'form_new_tradie')"/></td>
								</tr>
							</table>
						</form>					
					</div>

					<script type="text/javascript">
						DoFillSuburbsAndPostcodeSelects(document.getElementById("suburb"), document.getElementById("postcode"), document.getElementById("state"));
					</script>

					<form method="post" id="form_new_tradie" style="visibility:hidden;" action="new_tradie.php">
						<input type="hidden" name="hidden_new_member" value="new_member" />
						<input type="hidden" id="hidden_business_name" name="hidden_business_name" />
						<input type="hidden" id="hidden_first_name" name="hidden_first_name" />
						<input type="hidden" id="hidden_surname" name="hidden_surname" />
						<input type="hidden" id="hidden_abn" name="hidden_abn" />
						<input type="hidden" id="hidden_structure" name="hidden_structure" />
						<input type="hidden" id="hidden_license" name="hidden_license" />
						<input type="hidden" id="hidden_description" name="hidden_description" />
						<input type="hidden" id="hidden_minimum_charge" name="hidden_minimum_charge" />
						<input type="hidden" id="hidden_minimum_budget" name="hidden_minimum_budget" />
						<input type="hidden" id="hidden_maximum_size" name="hidden_maximum_size" />
						<input type="hidden" id="hidden_maximum_distance" name="hidden_maximum_distance" />

						<input type="hidden" id="hidden_unit" name="hidden_unit" />
						<input type="hidden" id="hidden_street" name="hidden_street" />
						<input type="hidden" id="hidden_suburb" name="hidden_suburb" />
						<input type="hidden" id="hidden_state" name="hidden_state" />
						<input type="hidden" id="hidden_postcode" name="hidden_postcode" />
						<input type="hidden" id="hidden_mobile" name="hidden_mobile" />
						<input type="hidden" id="hidden_phone" name="hidden_phone" />
						<input type="hidden" id="hidden_email" name="hidden_email" />
						
						<input type="hidden" id="hidden_username" name="hidden_username" />
						<input type="hidden" id="hidden_password" name="hidden_password" />
<?php
	DoGenerateHiddenTradesRadioButtons();
	DoGenerateHiddenAdditionalTradesCheckBoxes();
?>
					</form>
					
					<form method="post" id="form_tradie_login" style="visibility:hidden;" action="login.php">
						<input type="hidden" id="hidden_username0" name="hidden_username" value="<?php if (isset($_POST["hidden_username"])) echo $_POST["hidden_username"]; ?>"/>
						<input type="hidden" id="hidden_password0" name="hidden_password" value="<?php if (isset($_POST["hidden_password"])) echo $_POST["hidden_password"]; ?>"/>
						<input type="hidden" name="SUBMIT" value="tradie_login" />
					</form>
					
					<script type="text/javascript">
					
						<?php
							if ($g_bDoRedirectToLogin)
							{
								echo "document.getElementById('form_tradie_login').submit()";
							}
						?>
						
						if (sessionStorage["new_tradie_stage"] === undefined)
							sessionStorage["new_tradie_stage"] = "trade";
							
						let div2Show = document.getElementById(sessionStorage["new_tradie_stage"]);
						
						if (div2Show)
							div2Show.style.display = "block";
						
						PreloadForm(document.getElementById("form_select_trade"));
						PreloadForm(document.getElementById("form_business_details"));
						PreloadForm(document.getElementById("form_contact_details"));
						PreloadForm(document.getElementById("form_account_details"));
						
						OnClickCheckShowPassword(document.getElementById("check_show_password"), document.getElementById("password"));
						
					</script>








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
