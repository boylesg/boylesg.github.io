<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/advert_stuff.php";
	?>
	<script type="text/javascript">	
	
		var g_nCurrentAdvert = 0;
		var g_arrayAdverts = [
								<?php DoGenerateJSAdvertArray(); ?>
					 		 ];
		sessionStorage["member_id"] = <?php if (isset($_SESSION["account_id"])) echo $_SESSION["account_id"]; else echo "0"; ?>
	
	</script>
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Account</title>
		<!-- #EndEditable -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
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
					border-style: var(--BorderStyle);
					border-width: var(--BorderWidth);
					border-color: var(--BorderColor);
					background-color: var(--ColorActiveBG);
					border-bottom-left-radius: var(--BorderRadius);
					border-bottom-right-radius: var(--BorderRadius);
					border-top-right-radius:  var(--BorderRadius);
					min-width: 1120px;
					overflow: auto;
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
				
			</style>
			
			<script type="text/javascript">
			
				if (sessionStorage.getItem("active tab_button") == undefined)
					sessionStorage.setItem("active tab_button", 0);
				
				let g_arrayTabs = [];
			
				<?php
				
					if (IsTradie($_SESSION["account_id"]))
					{
						echo "g_arrayTabs.push({tab:\"tab_button1\", contents:\"tab_contents1\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button2\", contents:\"tab_contents2\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button3\", contents:\"tab_contents3\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button4\", contents:\"tab_contents4\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button5\", contents:\"tab_contents5\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button6\", contents:\"tab_contents6\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button7\", contents:\"tab_contents7\"});\n";
					}
					else
					{
						echo "g_arrayTabs.push({tab:\"tab_button2\", contents:\"tab_contents2\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button3\", contents:\"tab_contents3\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button4\", contents:\"tab_contents4\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button5\", contents:\"tab_contents5\"});\n";
						echo "g_arrayTabs.push({tab:\"tab_button7\", contents:\"tab_contents7\"});\n";
					}
				?>
				
				function GetSelectedTabIndex(strTabButtonID)
				{
					let nTabNum = -1;
					
					for (let nI = 0; nI < g_arrayTabs.length; nI++)
					{
						if (g_arrayTabs[nI].tab == strTabButtonID)
						{
							nTabNum = nI;
							break;
						}
					}
					return nTabNum;
				}
				
				function  DoOpenTab(strTabButton2ShowID, strTab2ShowID) 
				{
					for (let nI = 0; nI < g_arrayTabs.length; nI++)
					{
						DoGetInput(g_arrayTabs[nI].contents).style.display = "none";
						DoGetInput(g_arrayTabs[nI].tab).style.backgroundColor = GetCSSVariable("--ColorBG");
					}
					DoGetInput(strTab2ShowID).style.display = "block";
					DoGetInput(strTabButton2ShowID).style.backgroundColor = GetCSSVariable("--ColorActiveBG");
					sessionStorage.setItem("active tab_button", GetSelectedTabIndex(strTabButton2ShowID));
				}
				
			</script>

<?php 
	$_SESSION["NEW"] = false;
	$strPaypalDisplay = "none";
	$strAccountDisplay = "block";
	
/*	
	DEBUG PAYPAL RESPONSE
	
	$_GET["paypal"] = 12;
	DebugPrint("_SESSION[\"username\"]", $_SESSION["username"], 2);
	DebugPrint("_SESSION[\"password\"]", $_SESSION["password"], 2);
	DebugPrint("_SESSION[\"accountid\"]", $_SESSION["account_id"], 2);
	echo "<br><br>";
*/
	if (isset($_POST["submit_logo"]))
	{
		DoSaveLogoImage($_SESSION["account_id"], $_FILES["logo_file_name"]);
		unset($_FILES["profile_file_name"]);
	}
	else if (isset($_POST["submit_profile"]))
	{
		DoSaveProfileImage($_SESSION["account_id"], $_FILES["profile_file_name"]);
		unset($_FILES["profile_file_name"]);
	}
	else if (isset($_POST["submit_accept_job"]))
	{
		$results = DoUpdateQuery1($g_dbFindATradie, "jobs", "accepted_by_member_id", $_SESSION["account_id"], "id", $_POST["text_job_id"]);
		if ($results)
		{
			$results = DoFindQuery1($g_dbFindATradie, "jobs", "id", $_POST["text_job_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{
					$strFromEmail = $_SESSION["account_email"];
					$strToEmail = DoGetMemberEmail($row["member_id"]);
					
					mail($strFromEmail, "RE: job ID: " . $row["id"] . ", date: " . 
							$row["date_added"] . " on 'FindaTradie'", "Business member '" . 
							$_SESSION["account_business_name"] . " has accepted your job and will contact your shortly.", 
							"From: " . $strFromEmail);
				}
				else
				{
					PrintJavascriptLine("AlertError(\"Could not fetch job row!\")", 4, true);
				}
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Could not find row!\")", 4, true);
			}
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Job could not be accepted!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_unaccept_job"]))
	{
		$results = DoUpdateQuery1($g_dbFindATradie, "jobs", "accepted_by_member_id", 0, "id", $_POST["text_job_id"]);
		if ($results)
		{
			$results = DoFindQuery1($g_dbFindATradie, "jobs", "id", $_POST["text_job_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{
					$strFromEmail = $_SESSION["email"];
					$strToEmail = DoGetMemberEmail($row["member_id"]);
					
					mail($strFromEmail, "RE: job ID: " . $row["id"] . ", date: " . 
							$row["date_added"] . " on 'FindaTradie'", "Business member '" . 
							$_SESSION["business_name"] . " has changed their mind and declined your job.", 
							"From: " . $strFromEmail);	
				}
				else
				{
					PrintJavascriptLine("AlertError(\"Could not fetch job row!\")", 4, true);
				}
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Could not find row!\")", 4, true);
			}
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Job could not be declined!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_complete_job"]))
	{
		$dateNow = new DateTime();
		$results = DoUpdateQuery2($g_dbFindATradie, "jobs", "completed", 1, "date_completed", $dateNow->format("Y-m-d"), "id", $_POST["text_job_id"]);
		if (!$results)
		{
			PrintJavascriptLine("AlertError(\"Job could not be marked as complete!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_uncomplete_job"]))
	{
		$results = DoUpdateQuery1($g_dbFindATradie, "jobs", "completed", 0, "id", $_POST["text_job_id"]);
		if (!$results)
		{
			PrintJavascriptLine("AlertError(\"Job could not be marked as incomplete!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_paid_job"]))
	{
		$dateNow = new DateTime();
		$results = DoUpdateQuery2($g_dbFindATradie, "jobs", "paid", 1, "date_paid", $dateNow->format("Y-m-d"), "id", $_POST["text_job_id"]);
		if (!$results)
		{
			PrintJavascriptLine("AlertError(\"Job could not be marked as paid!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_unpaid_job"]))
	{
		$results = DoUpdateQuery1($g_dbFindATradie, "jobs", "paid", 0, "id", $_POST["text_job_id"]);
		if (!$results)
		{
			PrintJavascriptLine("AlertError(\"Job could not be marked as unpaid!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_positive_feedback"]) || isset($_POST["submit_negative_feedback"]))
	{
		$nPositive = 0;
		
		if (isset($_POST["submit_positive_feedback"]))
			$nPositive = 1;
		else if (isset($_POST["submit_negative_feedback"]))
			$nPositive = 0;
		$strUpdateOrAdd = "XXXX";

		if ($_POST["text_feedback_id"] == 0)
		{
			$results = DoInsertQuery5($g_dbFindATradie, "feedback", "positive", $nPositive, "description", $_POST["text_feedback"], 
										"job_id", $_POST["text_job_id"], "recipient_id", $_POST["text_recipient_id"],
										"provider_id", $_POST["text_provider_id"]);
			$strUpdateOrAdd = "added";
		}
		else
		{
			$results = DoUpdateQuery5($g_dbFindATradie, "feedback", "positive", $nPositive, "description", $_POST["text_feedback"], 
										"job_id", $_POST["text_job_id"], "recipient_id", $_POST["text_recipient_id"],
										"provider_id", $_POST["text_provider_id"], "id", $_POST["text_feedback_id"]);
			$strUpdateOrAdd = "updated";
		}
		if ($results)
		{
			PrintJavascriptLine("AlertSuccess(\"Your feedback has been " . $strUpdateOrAdd . "!\");", 5, true);
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Your feedback could not be " . $strUpdateOrAdd . "!\");", 5, true);
		}
	}
	else if (isset($_POST["submit_job_delete"]))
	{
		if (isset($_POST["hidden_job_id"]))
		{
			$results = DoDeleteQuery1($g_dbFindATradie, "jobs", "id", $_POST["hidden_job_id"]);
			if ($results && ($results->num_rows > 0))
			{	
				PrintJavascriptLine("AlertSuccess(\"Job has been deleted!\");", 5, true);
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Job could not be deleted!\");", 5, true);
			}
		}
		else
		{
			PrintJavascriptLine("Hidden input 'hidden_job_id' value was not found!", 5, true);
		}
	}
	else if (isset($_POST["submit_job"]))
	{
		/*
			id="select_trade_job"
			id="text_maximum_budget"
			id="select_job_size"
			id="check_urgent"
			id="text_job_description"
			
			id="hidden_member_id"
			id="hidden_job_id"
		*/
		// New job
		if (isset($_POST["text_job_id"]) && ($_POST["text_job_id"] == ""))
		{
			$bIsUrgent = "0";
			if (isset($_POST["check_urgent_job_edit"]) && ($_POST["check_urgent_job_edit"] == "on"))
				$bIsUrgent = "1";
			
			$results = DoInsertQuery11($g_dbFindATradie, "jobs", "trade_id", $_POST["select_trade_id_edit"], 
										"maximum_budget", $_POST["text_maximum_budget_edit"], "size", $_POST["select_job_size_edit"], 
										"urgent", (int)$bIsUrgent, "description", $_POST["text_job_description_edit"],
										"unit", $_POST["text_unit_edit"], "street", $_POST["text_street_edit"], 
										"suburb", $_POST["text_suburb_edit"], "state", $_POST["select_state_edit"], 
										"postcode", $_POST["text_postcode_edit"], "member_id", $_SESSION["account_id"]);
			echo $g_strQuery;
			if ($results)
			{
				PrintJavascriptLine("AlertSuccess(\"Job has been added!\");", 2, true);
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Job could not be added!\");", 2, true);
			}
		}
		// Editing existing job
		else
		{
			$results = DoUpdateQuery10($g_dbFindATradie, "jobs", "trade_id", $_POST["select_trade_id_edit"], 
										"maximum_budget", $_POST["text_maximum_budget_edit"], "size", $_POST["select_job_size_edit"], 
										"urgent", $_POST["check_urgent_job_edit"] == "on", "description", $_POST["text_job_description_edit"], 				
										"unit", $_POST["text_unit_edit"], "street", $_POST["text_street_edit"], 
										"suburb", $_POST["text_suburb_edit"], "state", $_POST["select_state_edit"], 
										"postcode", $_POST["text_postcode_edit"], "id", $_POST["text_job_id"]);
			if ($results)
			{
				PrintJavascriptLine("AlertSuccess(\"Job has been updated!\");", 2, true);
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Job could not be updated!\");", 2, true);
			}
		}
	}
	else if (isset($_GET["paypal"]) && isset($_GET["PayerID"]))
	{
		$nNumMonths = (int)$_GET["paypal"];
		
		if ($nNumMonths > 0)
		{
			$dateExpiry = new DateTime($_SESSION["account_expiry_date"]);
			$interval = DateInterval::createFromDateString($nNumMonths . " months");
			$dateExpiry = $dateExpiry->add($interval);
			$_SESSION["account_expiry_date"] = $dateExpiry->format("Y-m-d");
			if (DoUpdateQuery1($g_dbFindATradie, "members", "expiry_date", $_SESSION["account_expiry_date"], "id", $_SESSION["account_id"]))
			{
				PrintJSAlertSuccess("Your membership renewal date has been updated to " . $dateExpiry->format("d/m/Y"), 5, true);
			}
			else
			{
				PrintJSAlertError("Your membership renewal date could not be updated!", 5, true);
			}
		}
		else
		{
			PrintJSAlertError("You did not complete the payment so you membership renewal date was not be updated!", 5, true);
		}
	}
	else if (isset($_POST["button_trade_save"]))
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
					PrintJavascriptLine("AlertSuccess(\"Trade details were updated!\");");
			}
		}
	}
	else if (isset($_POST["button_business_save"]))
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
	else if (isset($_POST["button_contact_save"]))
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
			PrintJavascriptLine("AlertSuccess(\"Contact details updated!\");\n", 2, true);
			
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
	else if (isset($_POST["button_user_save"]))
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
												"password", DoAESEncrypt($_POST["text_password"])) .
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
	else if (isset($_POST["submit_tradie_search"]))
	{
		// See in tab below
	}
	else if (isset($_POST["submit_search_all_my_jobs"]))
	{
		// See in tab below
	}
	else if (isset($_POST["submit_search_my_jobs"]))	
	{
		// See in tab below
	}
	else if (isset($_POST["submit_new_job"]))
	{
		// See in tab below
	}
	else if (isset($_POST["submit_edit_job"]))
	{
		// See in tab below
	}
	else if (isset($_GET["member_id"]))
	{
		PrintJavascriptLine("sessionStorage[\"member_id\"] = \"" . $_GET["member_id"] . "\";", 3, true);
	}
	else
	{
		if (!empty($_GET))
		{
			echo "GET DATA<br>---------<br>\n";
			print_r($_GET);
		}
		if (!empty($_POST))
		{
			echo "<br><br>POST DATA<br>---------<br>\n";
			print_r($_POST);
		}
		if (!empty($_FILES))
		{
			echo "<br><br>FILES DATA<br>---------<br>\n";
			print_r($_FILES);
		}
	}
	// If the session has expired
	if (!isset($_SESSION["account_id"]) || ($_SESSION["account_id"] == ""))
	{
		PrintJavascriptLine("document.location = \"login.php\";", 1, true);
	}
	else
	{
		// If a tradie account then...
		if ($_SESSION["account_trade"] != DoGetCustomerTradeID())
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
	
?>

		<!-- #EndEditable -->
		<script type="text/javascript">
			
			function DoChangeBackgroundImage()
			{
				let nImageNum = Math.ceil(Math.random() * 39),
					strFilename = "url('/images/background" + nImageNum + ".jpg')";
					
				document.body.style.backgroundImage = strFilename;
			}
			
			if (document.title != "Admin Functions")
				setInterval(DoNextAdvert, g_nMillisAdvertTimeout);
			
		</script>
	</head>

	<body class="body" onload="DoChangeBackgroundImage()">
			
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<div class="logo"><img alt="" src="images/FATLogo.png" width="100" /></div>
			<div class="title_container">
				<div class="title text_outline" id="title">FIND A TRADIE</div>
				<div class="tag text_outline" id="tag">Created by an Australian tradie</div>
			</div>
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;" title="Join find-a-tradie as a tradie looking for customers...">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php" title="Join find-a-tradie as a customer looking for tradies...">CUSTOMER REGISTRATION</a>
			<?php 
				$g_strLoginButtonDisplay = "block";
				$g_strLogoutButtonDisplay = "none";
					
				if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
				{
					$g_strLoginButtonDisplay = "none";
					$g_strLogoutButtonDisplay = "block";
				}
			?>
			<a class="masthead_button" href="login.php" style="display:<?php echo $g_strLoginButtonDisplay; ?>;" title="Login to your account...">LOG IN</a>
			<a class="masthead_button" href="login.php?submit_logout=LOG OUT" style="display:<?php echo $g_strLogoutButtonDisplay; ?>;" title="Logout of your account...">LOG OUT</a>
			
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<ul class="navigation_list">
					<li class="navigation_list_item"><a class="navigation_link" href="index.php" title="Return to the home page...">HOME</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="benefits.php" title="Read about the many benefits of becoming a find-a-tradie member...">BENEFITS</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="about.php" title="Read about why find-a-tradie was created...">ABOUT</a></li>
						<?php
		
							if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a></li>\n";
							else
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"login.php\">LOG IN</a></li>\n";
								
						?>
					<li class="navigation_list_item"><a class="navigation_link" href="faq.php" title="Frequently Asked Questions answered...">FAQ</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="contact.php" title="Contact find-a-tradie...">CONTACT</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="forum.php" title="Talk to tradies about your job...">FORUM</a></li>
				</ul>
				<a href="https://www.facebook.com/FindATradiePage" class="social_media" title="Go to the facebook page..."><img src="images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
				<a id="find-a-tradie-app" class="app_button" href="https://www.find-a-tradie.com.au/app/find_a_tradie.apk" download title="Download the android app...">
					<img src="images/AndroidMobile.png" height="60" />
				</a>
				&nbsp;
				<a id="find-a-tradie-app" class="app_button" href="" download title="IOS app is comming...">
					<img src="images/AppleMobile.png" height="60" />
				</a>

			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading text_outline"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
		<!-- End PageHeading -->
		<!-- End Masthead -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
			<div style="display:<?php if (strcmp(basename($_SERVER['REQUEST_URI']), "admin.php") == 0) echo "none"; else echo "block";?>;" class="advert_marquee">
				<?php DoGenerateAdvertSlotHTML(); ?>
			</div>
			<!-- #BeginEditable "content" -->








				<div class="note" style="flex-wrap:wrap;width:1220px">

					<div id="paypal" style="display:<?php echo 	$strPaypalDisplay; ?>;">						
						<h2 id="tab_heading">It is time to renew your membership...</h2><br/>
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
											<input type="hidden" name="hosted_button_id" value="GN6D5BW3R2GCE" />
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
											<input type="hidden" name="hosted_button_id" value="6GDHY53HDNLPQ" />
											<input type="hidden" name="currency_code" value="AUD" />
											<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Buy Now" />
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
						
						<h6>Welcome back <?php echo $_SESSION["account_first_name"] ;?>...</h6>
					
						<?php
							$strDisplayTradieStuff = "none";
							if (IsTradie($_SESSION["account_id"]))
								$strDisplayTradieStuff = "block";
						?>
						
						<br/><br/>
						<button class="tab_button" id="tab_button1" onclick="DoOpenTab('tab_button1', 'tab_contents1')" style="display:<?php echo $strDisplayTradieStuff; ?>;">Browse your jobs</button>
						<button class="tab_button" id="tab_button2" onclick="DoOpenTab('tab_button2', 'tab_contents2')">Post your own job</button>
						<button class="tab_button" id="tab_button3" onclick="DoOpenTab('tab_button3', 'tab_contents3')">Account details</button>
						<button class="tab_button" id="tab_button4" onclick="DoOpenTab('tab_button4', 'tab_contents4')">Feedback you've received</button>
						<button class="tab_button" id="tab_button5" onclick="DoOpenTab('tab_button5', 'tab_contents5')">Feedback you've given</button>
						<button class="tab_button" id="tab_button6" onclick="DoOpenTab('tab_button6', 'tab_contents6')" style="display:<?php echo $strDisplayTradieStuff; ?>;">Your adverts</button>
						<button class="tab_button" id="tab_button7" onclick="DoOpenTab('tab_button7', 'tab_contents7')">Browse tradies</button>

						<div id="tab_contents1" class="tab_content" style="display:<?php echo $strDisplayTradieStuff; ?>;">
							<h2 id="tab_heading1"><script type="text/javascript">document.write(document.getElementById("tab_button1").innerText);</script></h2>
								<form method="post" action="" id="form_job_search" class="form search_form" style="display:<?php if (IsTradie($_SESSION["account_id"])) echo "block"; else echo "none"; ?>;width:1100px;">
									<table  cellspacing="0" cellpadding="3" border="0" class="forrm_table">
										<tr>
											<td class="form_table_cell" style="width:150px;"><b>Maximum distance</b></td>
											<td class="form_table_cell" style="width:140px;"><b>Minimum budget</b></td>
											<td class="form_table_cell" style="width:140px;"><b>Maximum size</b></td>
											<td class="form_table_cell" style="width:125px;"><b>Jobs added since</b></td>
											<td class="form_table_cell" style="width:120px;"><b>Urgency</b></td>
											<td class="form_table_cell" style="width:125px;"><b>Acceptance</b></td>
											<td class="form_table_cell" style="width:125px;"><b>Completeness</b></td>
											<td class="form_table_cell" style="width:100px;"><b>Payment</b></td>
										</tr>
										<tr>	
											<td class="form_table_cell"><input type="text" id="text_maximum_distance" name="text_maximum_distance" maxlength="4" size="15" value="<?php echo DoGetMaxDistance() ?>" onkeydown="OnKeyPressDigitsOnly(event)" />&nbsp;<b>km</b></td>
											<td class="form_table_cell"><b>$</b>&nbsp;<input type="text" id="text_minimum_budget" name="text_minimum_budget" maxlength="7" size="15" value="<?php echo DoGetMinBudget(); ?>" onkeydown="OnKeyPressDigitsOnly(event)" /></td>
											<td class="form_table_cell">
												<select id="select_maximum_size" name="select_maximum_size">
													<?php 
														$strJobSize = "";
														if (isset($_POST["select_maximum_size"])) 
															$strJobSize = $_POST["select_maximum_size"];
														DoGenerateJobSizeOptions($strJobSize); 
													?>
												</select>&nbsp;<b>m<sup>2</sup></b>
											</td>
											<?php
																							
												PrintJavascriptLine("SetSelection(\"select_maximum_size\", \"" . $_SESSION["account_maximum_size"] . "\");", 12, true);
											?>										
											<td class="form_table_cell"><input type="date" id="date_since" name="date_since" value="\<?php echo GetDateSince(); ?>\"/></td>
											<td class="form_table_cell">
												<input type="radio" name="radio_urgency" value="all" <?php if ((isset($_POST["radio_urgency"]) && ($_POST["radio_urgency"] == "all")) || !isset($_POST["radio_urgency"])) echo "checked";?>/><label>All</label><br/>
												<input type="radio" name="radio_urgency" value="urgent"  <?php if (isset($_POST["radio_urgency"]) && ($_POST["radio_urgency"] == "urgent")) echo "checked";?>/><label>Urgent only</label><br/>
												<input type="radio" name="radio_urgency" value="normal"  <?php if (isset($_POST["radio_urgency"]) && ($_POST["radio_urgency"] == "normal")) echo "checked";?>/>Non-urgent only<br/>
											</td>
											<td class="form_table_cell">
												<input type="radio" name="radio_acceptance" value="all" <?php if ((isset($_POST["radio_acceptance"]) && ($_POST["radio_acceptance"] == "all")) || !isset($_POST["radio_acceptance"])) echo "checked";?>/><label>All</label><br/>
												<input type="radio" name="radio_acceptance" value="accepted"  <?php if (isset($_POST["radio_acceptance"]) && ($_POST["radio_acceptance"] == "accepted")) echo "checked";?>/><label>Accepted jobs</label><br/>
												<input type="radio" name="radio_acceptance" value="unaccepted"  <?php if (isset($_POST["radio_acceptance"]) && ($_POST["radio_acceptance"] == "unaccepted")) echo "checked";?>/>Unaccepted jobs<br/>
											</td>
											<td class="form_table_cell">
												<input type="radio" name="radio_completeness" value="all" <?php if ((isset($_POST["radio_completeness"]) && ($_POST["radio_completeness"] == "all")) || !isset($_POST["radio_completeness"])) echo "checked";?>/><label>All</label><br/>
												<input type="radio" name="radio_completeness" value="complete"  <?php if (isset($_POST["radio_completeness"]) && ($_POST["radio_completeness"] == "complete")) echo "checked";?>/><label>Completed jobs</label><br/>
												<input type="radio" name="radio_completeness" value="incomplete"  <?php if (isset($_POST["radio_completeness"]) && ($_POST["radio_completeness"] == "incomplete")) echo "checked";?>/>Incomplete jobs<br/>
											</td>
											<td class="form_table_cell">
												<input type="radio" name="radio_payment" value="all" <?php if ((isset($_POST["radio_payment"]) && ($_POST["radio_payment"] == "all")) || !isset($_POST["radio_payment"])) echo "checked";?>/><label>All</label><br/>
												<input type="radio" name="radio_payment" value="paid"  <?php if (isset($_POST["radio_payment"]) && ($_POST["radio_payment"] == "paid")) echo "checked";?>/><label>Paid jobs</label><br/>
												<input type="radio" name="radio_payment" value="unpaid"  <?php if (isset($_POST["radio_payment"]) && ($_POST["radio_payment"] == "unpaid")) echo "checked";?>/>Unpaid jobs<br/>
											</td>
										</tr>
										<tr>
											<td class="form_table_cell" colspan="8">
												<button type="submit" id="submit_job_search" name="submit_job_search"><img src="images/search.png" alt="SEARCH" width="30" /></button>
												&nbsp;
												<button type="reset" id="reset_job_search" name="reset_job_search"><img src="images/delete.png" alt="RESET" width="30" /></button>
											</td>
										</tr>
									</table>
								</form>
								<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
								
								<table class="table_no_borders search_table" style="width:1100px;">
									<tr>
										<td class="cell_no_borders search_cell" style="width:1.5em;"><b>ID</b></td>
										<td class="cell_no_borders search_cell" style="width:6em;"><b>Date</b></td>
										<td class="cell_no_borders search_cell" style="width:18em;"><b>Member<br/>Location<br/>Contact</b></td>
										<td class="cell_no_borders search_cell" style="width:7em;"><b>Size<br/>Budget</b></td>
										<td class="cell_no_borders search_cell" style="width:4.5em;"><b>Urgent?</b></td>
										<td class="cell_no_borders search_cell" style="width:4.5em;"><b>Accepted</b></td>
										<td class="cell_no_borders search_cell" style="width:6em;"><b>Completed</b></td>
										<td class="cell_no_borders search_cell" style="width:4em;"><b>Paid</b></td>
										<td class="cell_no_borders search_cell" style="width:6em;"><b>Feedback<br/>received</b></td>
										<td class="cell_no_borders search_cell" style=""><b>Functions</b></td>
									</tr>
									<?php
									
										$mapAddedJobIDs = [];
											
										DoGetWebJobs($_SESSION["account_trade"], $mapAddedJobIDs);
											
										$results = DoFindQuery1($g_dbFindATradie, "additional_trades", "trade_id", $_SESSION["account_trade"]);
										if ($results && ($results->num_rows > 0))
										{
											while ($row = $results->fetch_assoc())
											{
												if (DoGetWebJobs($row["trade_id"], $mapAddedJobIDs) == 0)
													echo "<tr><td colspan=\"8\" style=\"height:30px;\">No jobs found based on your current search criteria...</td></tr>\n";
											}
										}
																		
									?>
									<tr><td class="cell_no_borders search_cell" colspan="8">&nbsp;</td></tr>
								</table>
						</div>
						
						<div id="tab_contents2" class="tab_content">
							<h2 id="tab_heading2"><script type="text/javascript">document.write(document.getElementById("tab_button2").innerText);</script></h2>
							
							<form method="post" action="" id="form_filter_jobs" class="form search_form" style="width:640px;">
								<h6>Filter Jobs</h6>
								<table cellspacing="0" cellpadding="3" border="0" class="form_table">
									<tr>
										<td class="form_table_cell" style="width:330px;"><b>Trade type</b></td>
										<td class="form_table_cell" style="width:100px;"><b>Budget</b></td>
										<td class="form_table_cell" style="width:125px;"><b>Size</b></td>
										<td class="form_table_cell" style="width:60px;"><b>Urgent</b></td>
									</tr>
									<tr>
										<td class="form_table_cell">
											<select id="select_trade_job" name="select_trade_job" onchange="OnChangeTrade(this, DoGetInput('trade_description_job'))">
												<?php
													$strTradeJob = "";
													if (isset($_POST["select_trade_job"]))
														$strTradeJob = $_POST["select_trade_job"];
													DoGeneratePrimaryTradeOptions($strTradeJob); 
												?>
											</select>
										</td>
										<td class="form_table_cell">
											<b>$</b>&nbsp;<input type="text" id="text_maximum_budget" name="text_maximum_budget" size="8" maxlength="7" value="<?php if (isset($_POST["text_maximum_budget"])) echo $_POST["text_maximum_budget"]; else echo DoGetDefaultMinimumBudget(); ?>" required onkeydown="OnKeyPressDigitsOnly(event)" />
										</td class="form_table_cell">
										<td class="form_table_cell">
											<select id="select_job_size" name="select_job_size">
													$strJobSize = "";
													if (isset($_POST["select_job_size"]))
														$strJobSize = $_POST["job_size"];
												<?php DoGenerateJobSizeOptions($strJobSize); ?>
											</select>
										</td>
										<td class="form_table_cell">
											<input type="checkbox" id="check_urgent" name="check_urgent" <?php if (isset($_POST["check_urgent"]) && (strcmp($_POST["check_urgent"], "on") == 0)) echo " checked"; ?> />
										</td class="form_table_cell">
									</tr>
									<tr><td colspan="4"><label id="trade_description_job">XXXXXXXXXXXXX</label></td></tr>
									<tr>
										<td colspan="4">
											<button type="submit" id="submit_search_my_jobs" name="submit_search_my_jobs" title="Filter my jobs...">
												<img src="images/search.png" alt="FILTER JOBS" width="30" />
											</button>
											&nbsp;
											<button type="submit" id="submit_search_all_my_jobs" name="submit_search_all_my_jobs" title="Reset jobs...">
												<img src="images/refresh.png" alt="ALL JOBS" width="30" />
											</button>
											&nbsp;
											<button type="button" id="button_new_job" title="Add a new job..." onclick="OnClickButtonNewJob()">
												<img src="images/add.png" alt="ALL JOBS" width="30" />
											</button>
										</td>
									</tr>
								</table>
							</form>
							<br/>
							<form method="post" action="" id="form_edit_job" class="form search_form" style="display:none;width:1040px;">
								<h6 id="job_edit_form_heading">New Job</h6>
								<table cellspacing="0" cellpadding="3" border="0" class="form_table">
									<tr>
										<td class="form_table_cell" style="width:330px;"><b>Trade type</b></td>
										<td class="form_table_cell" style="width:100px;"><b>Budget</b></td>
										<td class="form_table_cell" style="width:125px;"><b>Size</b></td>
										<td class="form_table_cell" style="width:60px;"><b>Urgent</b></td>
										<td class="form_table_cell" style="width:360px;"><b>Job description</b></td>
									</tr>
									<tr>
										<td class="form_table_cell">
											<select id="select_trade_id_edit" name="select_trade_id_edit" onchange="OnChangeTrade(this, DoGetInput('trade_description_job_edit'))">
												<?php
													$strTradeID = "";
													if (isset($_POST["select_trade_job_edit"]))
														$strTradeID = $_POST["select_trade_job"];
													DoGeneratePrimaryTradeOptions($strTradeID); 
												?>
											</select>
										</td>
										<td class="form_table_cell">
											<b>$</b>&nbsp;<input type="text" id="text_maximum_budget_edit" name="text_maximum_budget_edit" size="8" maxlength="7" value="<?php if (isset($_POST["text_maximum_budget"])) echo $_POST["text_maximum_budget"]; else echo ""; ?>" required onkeydown="OnKeyPressDigitsOnly(event)" />
										</td class="form_table_cell">
										<td class="form_table_cell">
											<select id="select_job_size_edit" name="select_job_size_edit">
													$strJobSize = "";
													if (isset($_POST["select_job_size"]))
														$strJobSize = $_POST["job_size"];
												<?php DoGenerateJobSizeOptions($strJobSize); ?>
											</select>
										</td>
										<td class="form_table_cell">
											<input type="checkbox" id="check_urgent_job_edit" name="check_urgent_job_edit" <?php if (isset($_POST["check_urgent"]) && (strcmp($_POST["check_urgent"], "on") == 0)) echo " checked"; ?> />
										</td class="form_table_cell">
										<td class="form_table_cell" >
											<textarea id="text_job_description_edit" name="text_job_description_edit" maxlength="512" cols="48" rows="3" required><?php echo DoGetDefaultJobDescription(); ?></textarea>
										</td>
									</tr>
									<tr>
										<td colspan="5"><label id="trade_description_job_edit">XXXXXXXXXXXXX</label></td>
									</tr>
									<tr>
										<td colspan="5">&nbsp;</td>
									</tr>
									<tr>
										<td class="form_table_cell">
											<table cellpadding="0" cellspacing="0" border="0" class="form_table">
												<tr>	
													<td class="form_table_cell" style="width:19em;"><b>Unit</b></td>
													<td class="form_table_cell" style="width:19em;"><b>Street</b></td>
													<td class="form_table_cell" style="width:19em;"><b>Suburb</b></td>
													<td class="form_table_cell" style="width:5em;"><b>State</b></td>
													<td class="form_table_cell"><b>Postcode</b></td>
												</tr>
												<tr>
													<td class="form_table_cell"><input type="text" id="text_unit_edit" name="text_unit_edit" size="32" value="<?php if (isset($_POST["text_unit"])) echo $_POST["text_unit"]; ?>" /></td>
													<td class="form_table_cell"><input type="text" id="text_street_edit" name="text_street_edit" size="32" pattern="^(\b\D+\b)?\s*(\b.*?\d.*?\b)\s*(\b\D+\b)?$" value="<?php if (isset($_POST["text_street"])) echo $_POST["text_street"]; ?>" /></td>
													<td class="form_table_cell"><input type="text" id="text_suburb_edit" name="text_suburb_edit" size="32" required pattern="^([a-zA-Z\u0080-\u024F]+(?:. |-| |'))*[a-zA-Z\u0080-\u024F]*$" value="<?php if (isset($_POST["text_suburb"])) echo $_POST["text_suburb"]; ?>" /></td>
													<td class="form_table_cell">
														<select id="select_state_edit" name="select_state_edit">
															<?php include "states.html"; ?>
														</select>
														<script type="text/javascript"> SetSelectionValue("select_state_edit", "<?php if (isset($_POST["select_state_edit"])) echo $_POST["select_state_edit"]; ?>"); </script>
													</td>
													<td class="form_table_cell"><input type="text" id="text_postcode_edit" name="text_postcode_edit" size="6" length="4" maxlength="4" required pattern="^[0-9]{4}$" value="<?php if (isset($_POST["text_postcode"])) echo $_POST["text_postcode"];; ?>" /></td>
													<td class="form_table_cell"></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="5">
											<button type="submit" id="submit_edit_job" name="submit_edit_job" class="function_button" title="Edit this job..."><img src="images/save.png" alt="SAVE JOB EDITS" width="30" /></button>
											<button type="submit" id="submit_new_job" name="submit_new_job" class="function_button" title="Add this job..." style="display:none;"><img src="images/save.png" alt="ADD NEW JOB" width="30" /></button>
											&nbsp;
											<button type="button" id="button_cancel_job" class="function_button" title="Discard changes to this job..." onclick="DoToggleEditJobForm()"><img src="images/delete.png" alt="CANCEL" width="30" /></button>
										</td>
									</tr>
								</table>
								<input type="hidden" id="text_member_id" name="text_member_id" value="<?php if (isset($_SESSION["account_id"])) echo $_SESSION["account_id"]; ?>" />
								<input type="hidden" id="text_job_id" name="text_job_id" value="" />
							</form>
<?php

	if (isset($_POST["submit_new_job"]))
	{
		$nUrgent = 0;
		if (isset($_POST["check_urgent_job_edit"]))
		{
			if (strcmp($_POST["check_urgent_job_edit"], "on") == 0)
			{
				$nUrgent = 1;
			}
		}
		if (!DoInsertQuery11($g_dbFindATradie, "jobs", "member_id", $_POST["text_member_id"], "trade_id", $_POST["select_trade_id_edit"], 
								"maximum_budget", $_POST["text_maximum_budget_edit"], "size", $_POST["select_job_size_edit"], 
								"urgent", $nUrgent, "description", $_POST["text_job_description_edit"], 
								"unit", $_POST["text_unit_edit"], "street", $_POST["text_street_edit"], 
								"suburb", $_POST["text_suburb_edit"], "state", $_POST["select_state_edit"], 
								"postcode", $_POST["text_postcode_edit"]))
		{
		}
	}
	else if (isset($_POST["submit_edit_job"]))
	{
		$nUrgent = 0;
		if (isset($_POST["check_urgent_job_edit"]))
		{
			if (strcmp($_POST["check_urgent_job_edit"], "on") == 0)
			{
				$nUrgent = 1;
			}
		}
		if (!DoUpdateQuery10($g_dbFindATradie, "jobs", "trade_id", $_POST["select_trade_id_edit"], 
							"maximum_budget", $_POST["text_maximum_budget_edit"], "size", $_POST["select_job_size_edit"], 
							"urgent", $nUrgent, "description", $_POST["text_job_description_edit"], 
							"unit", $_POST["text_unit_edit"], "street", $_POST["text_street_edit"], 
							"suburb", $_POST["text_suburb_edit"], "state", $_POST["select_state_edit"], 
							"postcode", $_POST["text_postcode_edit"], "id", $_POST["text_job_id"]))
		{
		}
	}
	
?>
							<p>
								If you hover the mouse pointer over the function buttons then you will see what they do.
								<br/><b>NOTE: </b>The tradie doing the work is responsible for marking jobs as complete &amp; paid.
							</p>
							<script type="text/javascript">
							
								function DoToggleEditJobForm()
								{
									var formEditJob = document.getElementById("form_edit_job");
									
									if (formEditJob)
									{
										if (formEditJob.style.display == "block")
											formEditJob.style.display = "none";
										else
											formEditJob.style.display = "block";
									}
								}
								
								function OnClickButtonNewJob()
								{							
									var headingEditJob = DoGetInput("job_edit_form_heading", "job_edit_form_heading");
									
									if (headingEditJob)
									{
										headingEditJob.innerText = "New Job";
										DoGetInput("submit_edit_job").style.display = "none";
										DoGetInput("submit_new_job").style.display = "inline-block";
										DoToggleEditJobForm();
									}
								}

								function OnClickEditJobButton(strJobID, strMemberID, strTradeID, strMaximumBudget, strSize, 
																strUrgent, strDescription, strUnit, strStreet, strSuburb, 
																strState, strPostcode)
								{
									var headingEditJob = DoGetInput("job_edit_form_heading", "job_edit_form_heading");
									
									if (headingEditJob)
									{
										headingEditJob.innerText = "Edit Job";
										DoGetInput("submit_edit_job").style.display = "inline-blobk";
										DoGetInput("submit_new_job").style.display = "none";
										DoToggleEditJobForm();
									}
									DoGetInput("text_job_id").value = strJobID;
									DoGetInput("text_member_id").value = strMemberID;
									
									var nI = 0, 
										selectTrade = DoGetInput("select_trade_id_edit"),
										nTradeID = Number(strTradeID);
										
									for (nI = 0; nI < selectTrade.options.length; nI++)
									{
										if (nTradeID == Number(selectTrade.options[nI].value))
										{
											selectTrade.selectedIndex = nI;
											break;
										}
									}
									DoGetInput("text_maximum_budget_edit").value = strMaximumBudget;
									DoGetInput("select_job_size_edit").selectedIndex = DoGetJobSizeSelectionIndex(strSize);
									DoGetInput("check_urgent_job_edit").checked = strUrgent == 1;
									DoGetInput("text_job_description_edit").value = strDescription;
									DoGetInput("text_unit_edit").value = strUnit;
									DoGetInput("text_street_edit").value = strStreet;
									DoGetInput("text_suburb_edit").value = strSuburb;
									DoGetInput("select_state_edit").selectedIndex = DoGetStateSelectionIndex(strState);
									DoGetInput("text_postcode_edit").value =strPostcode;
								}
								OnChangeTrade(DoGetInput("select_trade_id_edit"), DoGetInput('trade_description_job_edit'));
							</script>
							<table  cellspacing="0" cellpadding="3" border="0" class="search_table" style="height: 100px;">
								<tr>
									<td class="cell_no_borders search_cell" style="width:5em;"><b>Date</b></td>
									<td class="cell_no_borders search_cell" style="width:6em;"><b>Size</b></td>
									<td class="cell_no_borders search_cell" style="width:3em;"><b>Budget</b></td>
									<td class="cell_no_borders search_cell" style="width:3em;"><b>Urgent</b></td>
									<td class="cell_no_borders search_cell" style="width:15em;"><b>Accepted by<br/>Location</b></td>
									<td class="cell_no_borders search_cell" style="width:5em;"><b>Completed</b></td>
									<td class="cell_no_borders search_cell" style="width:4em;"><b>Paid</b></td>
									<td class="cell_no_borders search_cell" style="width:4.5em;"><b>Feedback<br/>received</b></td>
									<td class="cell_no_borders search_cell" style="width:320px;">
										<table cellspacing="0" cellpadding="0" border="0">
											<tr>
												<td style="width:25em;"><b>Functions</b></td>
												<td>
													<button type="button" class="function_button" title="Add a new job" onclick="OnClickAddJobButton()">
														<img src="images/add.png" alt="add.png" class="function_button_image" />
													</button>
												</td>
											</tr>
										</table>
									</td>
								</tr>

								<?php DoGetWebJobsPosted(); ?>
								<tr><td class="cell_no_borders search_cell" colspan="8">&nbsp;</td></tr>
							</table>

						</div>
						
						<div id="tab_contents3" class="tab_content">
							<h2 id="tab_heading3"><script type="text/javascript">document.write(document.getElementById("tab_button3").innerText);</script></h2>
							<form method="post" id="form_profile_image" action="" class="form" enctype="multipart/form-data" style="width:50%;">
								<fieldset>
									<legend>Profile image:</legend>
									<br/>
									<table border="0" cellspacing="0" cellpadding="5" style="table-layout:fixed;width:500px;">									

<?php
	$strID = "profile";
	$strPreviewImageFilePath = $_SESSION["account_profile_filename"];
	include "select_file.html"; 
?>
			
										<tr>
											<td class="cell_no_borders" style="width:100%;text-align:right;vertical-align:center;">
												<button class="function_button" title="Save this profile image" type="submit" name="submit_profile"><img class="function_button_image" src="images/save.png" alt="images/save.png" /></button>
											</td>
										</tr>
									</table>
								</fieldset>
							</form>
							
							<form method="post" id="form_logo_image" action="" class="form" enctype="multipart/form-data" style="width:500px;display:<?php if (isset($_SESSION["account_trade"]) && IsTradie($_SESSION["account_id"])) echo "block"; else echo "none"; ?>;">
								<fieldset>
									<legend>Business logo image:</legend>
									<br/>
									<table border="0" cellspacing="0" cellpadding="5" style="table-layout:fixed;width:700px;">								
	
<?php
	$strID = "logo";
	$strPreviewImageFilePath = $_SESSION["account_logo_filename"];
	include "select_file.html";
?>
										<tr>
											<td class="cell_no_borders" style="width:100%;text-align:right;vertical-align:center;">
												<button class="function_button" title="Save this logo image" type="submit" name="submit_logo"><img class="function_button_image" src="images/save.png" alt="images/save.png" /></button>
											</td>
										</tr>
									</table>
								</fieldset>
							</form>

<?php include "member_details_forms.html"; ?>
						</div>
						
						<div id="tab_contents4" class="tab_content">
							<h2 id="tab_heading4"><script type="text/javascript">document.write(document.getElementById("tab_button4").innerText);</script></h2>

							<?php DoDisplayFeedbackPercentages($_SESSION["account_id"], ""); ?>
							
							<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
							
							<table cellspacing="0" cellpadding="10" border="0" class="table_no_borders search_table">
								<tr>
									<td class="cell_no_borders search_cell" style="width:1em;">+/-</td>
									<td class="cell_no_borders search_cell" style="width:10em;">Feedback comments</td>
									<td class="cell_no_borders search_cell" style="width:1.5em;">Job ID</td>
									<td class="cell_no_borders search_cell" style="width:3.5em;">Date feedback</td>
									<td class="cell_no_borders search_cell" style="width:8em;">Member name<br/>Business name<br/>Location</td>
									<td class="cell_no_borders search_cell" style="width:13em;">Functions</td>
								</tr>

<?php
	DoDisplayFeedback($_SESSION["account_id"], "");
?>
							</table>
						</div>

						<div id="tab_contents5" class="tab_content">
							<h2 id="tab_heading5"><script type="text/javascript">document.write(document.getElementById("tab_button5").innerText);</script></h2>
							<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
							<table cellspacing="0" cellpadding="10" border="0" class="table_no_borders search_table">
								<tr>
									<td class="cell_no_borders search_cell" style="width:1em;">+/-</td>
									<td class="cell_no_borders search_cell" style="width:10em;">Feedback comments</td>
									<td class="cell_no_borders search_cell" style="width:1.5em;">Job ID</td>
									<td class="cell_no_borders search_cell" style="width:3.5em;">Date feedback</td>
									<td class="cell_no_borders search_cell" style="width:8em;">Member name<br/>Business name<br/>Location</td>
									<td class="cell_no_borders search_cell" style="width:14em;">Functions</td>
								</tr>
<?php
	DoDisplayFeedback("", $_SESSION["account_id"]);
?>							
							</table>
						</div>
						
						<div id="tab_contents6" class="tab_content" style="display:<?php echo $strDisplayTradieStuff; ?>;" >
							<h2 id="tab_heading6"><script type="text/javascript">document.write(document.getElementById("tab_button6").innerText);</script></h2>
							
							<form method="post" action="" id="form_search_adverts" class="form search_form" style="width:960px;">
								<table cellspacing="0" cellpadding="1" border="0" class="forrm_table">
									<tr>
										<td class="form_table_cell" style="text-align:right;width:6em;">Start Date</td>
										<td class="form_table_cell" style="text-align:left;"><input name="date_start" type="date" value="<?php if (isset($_POST["date_start"])) echo $_POST["date_start"]; ?>" /></td>
										<td class="form_table_cell" style="text-align:right;width:6em;">End Date</td>
										<td class="form_table_cell" style="text-align:left;"><input name="date_end" type="date" value="<?php if (isset($_POST["date_end"])) echo $_POST["date_end"]; ?>" /></td>
										<td class="form_table_cell" style="text-align:right;width:10em;">Advertising Space</td>
										<td class="form_table_cell" style="text-align:left;">
											<select name="Select_advertising_space">
												<?php 
													$strSpaceCode = "";
													if (isset($_POST["Select_advertising_space"]))
														$strSpaceCode = $_POST["Select_advertising_space"];
													DoGenerateAdvertSpaceOptions($strSpaceCode); 
												?>
											</select></td>
										<td class="form_table_cell" style="text-align:right;width:11em;">Hide Expired Adverts</td>
										<td class="form_table_cell" style="text-align:left;"><input name="checkbox_hide_expired_adverts" type="checkbox"<?php if (isset($_POST["checkbox_hide_expired_adverts"]) && ($_POST["checkbox_hide_expired_adverts"] == "on")) echo " checked"; ?>/></td>
									</tr>
									<tr>
										<td class="form_table_cell" colspan="8">
											<button type="submit" id="submit_search_adverts" name="submit_search_adverts">
												<img src="images/search.png" alt="SEARCH" width="30px" />
											</button>
										</td>
									</tr>
								</table>
							</form>
							
							<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
							<table  cellspacing="0" cellpadding="3" border="0" class="search_table">
								<tr>
									<td class="search_cell" style="width:5em;"><b>Date</b></td>
									<td class="search_cell" style=""><b>Advert Location</b></td>
									<td class="search_cell" style="width:8em;"><b>Cost per Year</b></td>
									<td class="search_cell" style="width:6em;"><b>Expiry Date</b></td>
									<td class="search_cell" style="width:6em;"><b>Clicks</b></td>
									<td class="search_cell" style="width:5em;"><b>Functions</b></td>
								</tr>
<?php

	$bHideExpired = false;
	$dateStart = new DateTime("2022-1-1");
	$dateEnd = new DateTime("2100-1-1");
	$strSpaceID = "";
	
	if (isset($_POST["submit_search_adverts"]))
	{
		if (isset($_POST["checkbox_hide_expired_adverts"]) && ($_POST["checkbox_hide_expired_adverts"] == "on"))
			$bHideExpired = true;
		if (isset($_POST["date_start"]))
			$dateStart = new DateTime($_POST["date_start"]);
		if (isset($_POST["date_end"]))
			$dateEnd = new DateTime($_POST["date_end"]);
		if (isset($_POST["Select_advertising_space"]))
			$strSpaceID = $_POST["Select_advertising_space"];
	}
	DoDisplayAdverts($_SESSION["account_id"], $strSpaceID, $dateStart, $dateEnd, $bHideExpired);
?>
							</table>
							
						</div>
						
						<div id="tab_contents7" class="tab_content">
							<h2 id="tab_heading7"><script type="text/javascript">document.write(document.getElementById("tab_button1").innerText);</script></h2>
								<form method="post" action="" id="form_tradie_search" class="form search_form" style="width:920px;">
									<table  cellspacing="0" cellpadding="3" border="0" class="forrm_table">
										<tr>
											<td class="form_table_cell" style="width:350px;"><b>Trade type</b></td>
											<td class="form_table_cell" style="width:100px;"><b>Postcode</b></td>
											<td class="form_table_cell" style="width:250px;"><b>Suburb</b></td>
											<td class="form_table_cell" style="width:200px;"><b>Maximum distance from you</b></td>
										</tr>
										<tr>	
											<td class="form_table_cell">
												<select id="select_trade_tradies" name="select_trade_tradies" onchange="OnChangeTrade(this, DoGetInput('trade_description_tradies'))">
													<?php if (isset($_POST["select_trade_tradies"])) DoGeneratePrimaryTradeOptions($_POST["select_trade_tradies"]); else DoGeneratePrimaryTradeOptions($_SESSION["account_trade"]); ?>
												</select>
											</td>
											<td>
												<input type="text" name="text_postcode" maxlength="4" size="4" onkeydown="OnKeyPressDigitsOnly(event)" value="<?php if (isset($_POST["text_postcode"])) echo $_POST["text_postcode"]; else echo $_SESSION["account_postcode"];?>" />
											</td>										
											<td>
												<input type="text" name="text_suburb" size="24" name="" value="<?php if (isset($_POST["text_suburb"])) echo $_POST["text_suburb"]; else echo $_SESSION["account_suburb"]; ?>" />
											</td>										
											<td class="form_table_cell">
												<input type="text" id="text_maximum_distance0" name="text_maximum_distance" maxlength="4" size="15" value="<?php if (isset($_POST["text_maximum_distance"])) echo $_POST["text_maximum_distance"]; else printf("%d", $_SESSION["account_maximum_distance"]); ?>" onkeydown="OnKeyPressDigitsOnly(event)" />&nbsp;<b>km</b>
											</td>
										</tr>
										<tr><td colspan="4"><label id="trade_description_tradies">XXXXXXXXXXXXX</label></td></tr>
										<tr>
											<td class="form_table_cell" colspan="4">
												<button type="submit" id="submit_tradie_search" name="submit_tradie_search">
													<img src="images/search.png" alt="SEARCH" width="30px" />
												</button>
											</td>
										</tr>
									</table>
								</form>
								<table class="table_no_borders search_table">
									<tr>
										<td class="cell_no_borders search_cell" style="width:1em;"><b>ID</b></td>
										<td class="cell_no_borders search_cell" style="width:8em;"><b>Name</b></td>
										<td class="cell_no_borders search_cell" style="width:2.5em;"><b>Send email</b></td>
										<td class="cell_no_borders search_cell" style="width:2em;"><b>Phone</b></td>
										<td class="cell_no_borders search_cell" style="width:2.5em;"><b>Mobile</b></td>
										<td class="cell_no_borders search_cell" style="width:4em;"><b>Suburb</b></td>
										<td class="cell_no_borders search_cell" style="width:1em;"><b>State</b></td>
										<td class="cell_no_borders search_cell" style="width:1.5em;"><b>Postcode</b></td>
										<td class="cell_no_borders search_cell" style="width:8em;"><b>Feedback</b></td>
									</tr>
									<script type="text/javascript">
										OnChangeTrade(DoGetInput("select_trade_tradies"), DoGetInput("trade_description_tradies"));
									</script>
									<?php
										$strTradeID = "";
										$strPostcode = "";
										$strSuburb = "";
										$strMaxDistance = "";				
										
										if (isset($_POST["submit_tradie_search"]))
										{
											if (isset($_POST["select_trade_tradies"]))
												$strTradeID = $_POST["select_trade_tradies"];
											if (isset($_POST["text_postcode"]))
												$strPostcode = $_POST["text_postcode"];
											if (isset($_POST["text_suburb"]))
												$strTrade = $_POST["text_suburb"];
											if (isset($_POST["text_maximum_distance"]))
												$strMaxDistance = $_POST["text_maximum_distance"];
										}
										if (!DoGetWebTradies($strTradeID, $strPostcode, $strSuburb, $strMaxDistance) == 0)
											echo "<tr><td colspan=\"7\" style=\"height:30px;\">No tradies found based on your current search criteria...</td></tr>\n";
											
									?>
								</table>
						</div>
						
					</div>

				</div>

<script type="text/javascript">
			
	g_bIsCustomer = <?php if ($_SESSION["account_trade"] == 59) echo "true"; else echo "false" ?>;
	DoSetNotStaged();
	if (g_bIsCustomer)
		DoSetCustomer();
	else
		DoSetTradie();	
	
	function OnClickComplete(strJobID)
	{
		DoGetInput("feedback_form").style.display = "block";
		DoGetInput("hidden_job_id").value = strJobID;
		return false;
	}
	
	function DoRestoreTab()
	{
		if (sessionStorage["active tab_button"] == "NaN")
			sessionStorage["active tab_button"] = 0;
			
		let nSelectedTabIndex = parseInt(sessionStorage["active tab_button"]),
			strSelectedTabID = "",
			strSelectedContentsID = "";
			
		if ((nSelectedTabIndex == undefined) || (nSelectedTabIndex == "NaN"))
		{
			console.log("@@@@@" + nSelectedTabIndex + "@@@@@");
		}
		else
		{
			if (g_arrayTabs[nSelectedTabIndex] == undefined)
			{
				console.log("&&&&&" + nSelectedTabIndex + "&&&&&" + g_arrayTabs[nSelectedTabIndex] + "&&&&&");
			}
			else
			{
				strSelectedTabID = g_arrayTabs[nSelectedTabIndex].tab;
				if (strSelectedTabID == undefined)
				{
					console.log("*****" + nSelectedTabIndex + "*****");
				}
				strSelectedContentsID = g_arrayTabs[nSelectedTabIndex].contents;
				if (strSelectedContentsID == undefined)
				{
					console.log("#####" + nSelectedTabIndex + "#####");
				}
			}
		}
		DoOpenTab(strSelectedTabID, strSelectedContentsID);
	}
	
	DoRestoreTab();
	//let rectHeading = DoGetInput("tab_heading" + (nI + 1).toString()).getBoundingClientRect();
	//window.screenTop = rectHeading.top + 100;

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
		
			DoSetAdverts();
		
		</script>
		
		<!-- #BeginEditable "footer" -->



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
