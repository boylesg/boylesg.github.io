<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.php"; ?>
	
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Account</title>
		<!-- #EndEditable -->
		<?php 
			include $_SERVER['DOCUMENT_ROOT'] . "/common.js";
			include "set_advert.php";
		?>
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
					width: 96.5%;
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
					font-size: 12.5px;
					/*color: maroon;*/
					border-bottom-style: solid;
					border-width: thin;
					border-color: black;
					padding: 5px;
					vertical-align: middle;
					text-align: left;
				}

				.form_table
				{
					table-layout: fixed;
					width: 100%;
				}
				
				.form_table_cell
				{
					font-size: small;
					padding: 5px;
					vertical-align: middle;
					text-align: left;
				}
				
				.function_button
				{
					display: inline-block;
					border-style: outset;
					border-width: thin;
					border-color: silver;
				}
				
				.function_form
				{
					display: inline-block;
					border-color: red;
					border-style: none;
				}
				
				.feedback_form
				{
					width: 580px;
					float: right;
					background-color: var(--ColorInactiveBG);
				}

			</style>
			
			<script type="text/javascript">
			
				if (sessionStorage.getItem("active tab_button") == undefined)
					sessionStorage.setItem("active tab_button", "");
				
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
							if (sessionStorage.getItem("active tab_button") != "")
							{
								DoGetInput(sessionStorage.getItem("active tab_button")).style.backgroundColor = GetCSSVariable("--ColorBG");
							}
							divTabButton.style.backgroundColor = GetCSSVariable("--ColorActiveBG");
							sessionStorage.setItem("active tab_button", divTabButton.id);
						}
					}
				}
																
			</script>

<?php 

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
		$strTargetPath = "";
		
		if (isset($_FILES["logo_file_name"]))
		{
			$strTargetPath = DoGetLogoImageFilename($_SESSION["account_id"], false);
		}
		if (move_uploaded_file($_FILES["logo_file_name"]["tmp_name"], $strTargetPath))
		{
			$_SESSION["account_logo_filename"] = $strTargetPath;
			$results = DoUpdateQuery1($g_dbFindATradie, "members", "logo_filename", $_SESSION["account_logo_filename"], "id", $_SESSION["account_id"]);
			if ($results)
			{
				PrintJavascriptLine("AlertSuccess(\"Logo image file '" . $_FILES["logo_file_name"]["name"] . "' was saved!\");", 3, true);
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Logo image column could not be updated!\");", 3, true);
			}
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Could not save file '" . $_SESSION["account_logo_filename"] . "\");", 3, true);
		}
	}
	else if (isset($_POST["submit_profile"]))
	{
		$strTargetPath = "";
		
		if (isset($_FILES["profile_file_name"]))
		{
			$strTargetPath = DoGetProfileImageFilename($_SESSION["account_id"], false);
		}
		if (move_uploaded_file($_FILES["profile_file_name"]["tmp_name"], $strTargetPath))
		{
			$_SESSION["account_profile_filename"] = $strTargetPath;
			$results = DoUpdateQuery1($g_dbFindATradie, "members", "profile_filename", $_SESSION["account_profile_filename"], "id", $_SESSION["account_id"]);
			if ($results)
			{
				PrintJavascriptLine("AlertSuccess(\"Profile image file '" . $_FILES["profile_file_name"]["name"] . "' was saved!\");", 3, true);
			}
			else
			{
				PrintJavascriptLine("AlertError(\"Profile image column could not update!\");", 3, true);
			}
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Could not save file '" . $_SESSION["account_profile_filename"] . "\");", 3, true);
		}
	}
	else if (isset($_POST["submit_accept_job"]))
	{
		$resultsJob = DoUpdateQuery1($g_dbFindATradie, "jobs", "accepted_by_member_id", $_POST["text_member_id"], "id", $_POST["text_job_id"]);
		if ($resultsJob)
		{
			$results = DoFindQuery1($g_dbFindATradie, "jobs", "id", $_POST["text_job_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($rowJob = $results->fetch_assoc())
				{
					$results = DoFindQuery1($g_dbFindATradie, "members", "id", $row["member_id"]);
					if ($results && ($results->num_rows > 0))
					{
						if ($rowMember = $results->fetch_assoc())
						{
							$results = DoFindQuery1($g_dbFindATradie, "members", "id", $row["accepted_by_member_id"]);
							if ($results && ($results->num_rows > 0))
							{
								if ($rowTradie = $results->fetch_assoc())
								{
									mail($rowMember["email"], "RE: job ID: " . $rowJob["id"] . ", date: " . 
										$rowJob["date_added"] . " on 'FindaTradie'", "Business member '" . $rowTradie["business_name"] . " has accepted your job and will contact your shortly.");
								}
							}
						}
					}
				}
			}
			PrintJavascriptLine("AlertSuccess(\"Job was accepted!\")", 4, true);
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Job could not be accepted!\")", 4, true);
		}
	}
	else if (isset($_GET["submit_unaccept_job"]))
	{
		$resultsJob = DoUpdateQuery1($g_dbFindATradie, "jobs", "accepted_by_member_id", 0, "id", $_GET["text_job_id"]);
		if ($resultsJob)
		{
			$results = DoFindQuery1($g_dbFindATradie, "jobs", "id", $_GET["text_job_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($rowJob = $results->fetch_assoc())
				{
					$results = DoFindQuery1($g_dbFindATradie, "members", "id", $rowJob["member_id"]);
					if ($results && ($results->num_rows > 0))
					{
						if ($rowMember = $results->fetch_assoc())
						{
							$results = DoFindQuery1($g_dbFindATradie, "members", "id", $rowJob["accepted_by_member_id"]);
							if ($results && ($results->num_rows > 0))
							{
								if ($rowTradie = $results->fetch_assoc())
								{
									mail($rowMember["email"], "RE: job ID: " . $rowJob["id"] . ", date: " . 
										$rowJob["date_added"] . " on 'FindaTradie'", "Business member '" . $rowTradie["business_name"] . " has changed their mind and declined your job.");
								}
							}
						}
					}
				}
			}
			PrintJavascriptLine("AlertSuccess(\"Job was declined!\")", 4, true);
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Job could not be declined!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_feedback_add"]))
	{
		$bPositive = true;
		
		if ($_POST["radio_feedback"] == "true")
			$bPositive = true;
		else if ($_POST["radio_feedback"] == "false")
			$bPositive = false;

		//$resultsFeedback = DoInsertQuery4($g_dbFindATradie, "feedback", "description", $_POST["textarea_comments"], 
		//	"positive", $bPositive, "recipient", $_POST["hidden_recipient_id"], "provider_id", $_SESSION["account_id"]);
			
		$results = DoUpdateQuery1($g_dbFindATradie, "jobs", "completed", true, "id", $_POST["hidden_job_id"]);
		if ($results)
		{
			$results = DoFindQuery1($g_dbFindATradie, "jobs", "id", $_POST["hidden_job_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{
					$resultsFeedback = DoInsertQuery4($g_dbFindATradie, "feedback", "description", $_POST["textarea_comments"], 
						"positive", $bPositive, "recipient", $rowT["accepted_by_member_id"], "provider_id", $_SESSION["account_id"]);
					if ($results && ($results->num_rows > 0))
					{
						PrintJavascriptLine("AlertSuccess(\"Job was completed with feedback!\")", 4, true);
					}
					else
					{
						PrintJavascriptLine("AlertSuccess(\"Job was completed without feedback!\")", 4, true);
					}
				}
			}
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Job could not be completed!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_feedback_edit"]))
	{
		$bPositive = true;
		
		if ($_POST["radio_feedback"] == "true")
			$bPositive = true;
		else if ($_POST["radio_feedback"] == "false")
			$bPositive = false;

		$results = DoUpdateQuery2($g_dbFindATradie, "feedback", "description", $_POST["textarea_comments"], 
			"positive", $bPositive, "id", $_POST["hidden_feedback_id"]);
		if ($results)
		{
			PrintJavascriptLine("AlertSuccess(\"Feedback was updated!\")", 4, true);
		}
		else
		{
			PrintJavascriptLine("AlertError(\"Feedback could not be updated!\")", 4, true);
		}
	}
	else if (isset($_POST["submit_job_edit"]))
	{
		// See below the edit job form.
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
			id="text_description"
			
			id="hidden_member_id"
			id="hidden_job_id"
		*/
		// New job
		if (isset($_POST["hidden_job_id"]) && ($_POST["hidden_job_id"] == ""))
		{
			$bIsUrgent = "0";
			if (isset($_POST["check_urgent"]) && ($_POST["check_urgent"] == "on"))
				$bIsUrgent = "1";
				
			$results = DoInsertQuery5($g_dbFindATradie, "jobs", "trade_id", $_POST["select_trade_job"], 
										"maximum_budget", $_POST["text_maximum_budget"], "size", $_POST["select_job_size"], 
										"urgent", (int)$bIsUrgent, "description", $_POST["text_description"]);
			if ($results && ($results->num_rows > 0))
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
			$results = DoUpdateQuery5($g_dbFindATradie, "jobs", "trade_id", $_POST["select_trade_job"], 
										"maximum_budget", $_POST["text_maximum_budget"], "size", $_POST["select_job_size"], 
										"urgent", $_POST["check_urgent"] == "on", "description", $_POST["text_description"], 				
										"id", $_POST["hidden_job_id"]);
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
	// If the session has expired
	if (!isset($_SESSION["account_id"]) || ($_SESSION["account_id"] == ""))
	{
		PrintJavascriptLine("document.location = \"login.php\";", 1, true);
	}
	else
	{
		// If a tradie account then...
		if ($_SESSION["account_trade"] != $g_nTradeIDCustomer)
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
			
			setInterval(DoNextAdvert, 3000);
			
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
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
			<?php 
				$g_strLoginButtonDisplay = "block";
				$g_strLogoutButtonDisplay = "none";
				
				if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
				{
					$g_strLoginButtonDisplay = "none";
					$g_strLogoutButtonDisplay = "block";
				}
			?>
			<a class="masthead_button" href="login.php" style="display:<?php echo $g_strLoginButtonDisplay; ?>;">LOG IN</a>
			<a class="masthead_button" href="login.php?submit_logout=LOG OUT" style="display:<?php echo $g_strLogoutButtonDisplay; ?>;">LOG OUT</a>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<ul class="navigation_list">
					<li class="navigation_list_item"><a class="navigation_link" href="index.php">HOME</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="benefits.php">BENEFITS</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="about.php">ABOUT</a></li>
						<?php
		
							if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a></li>\n";
							else
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"login.php\">LOG IN</a></li>\n";
								
						?>
					<li class="navigation_list_item"><a class="navigation_link" href="faq.php">FAQ</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="contact.php">CONTACT</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="forum.php">FORUM</a></li>
				</ul>
				<a href="https://www.facebook.com/FindATradiePage/?viewas=100000686899395" class="social_media" ><img src="images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading text_outline"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
		<!-- End PageHeading -->
		<!-- End Masthead -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
			<div class="advert_marquee">
				<form id="form_adverts" method="post">
					<table class="scroll" cellpadding="0" cellspacing="0" border="0" id="advert_1">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(1)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_1_text">ADVERT 1 HTML</td>
							<div class="advert_expires" id="advert_1_expires" colspan="2">Advert expires on 0/0/0000</div>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_2" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(2)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_2_text">ADVERT 2 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_3" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(3)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_3_text">ADVERT 3 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_4" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(4)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_4_text">ADVERT 4 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_5" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(5)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_5_text">ADVERT 5 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_6" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(6)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_6_text">ADVERT 6 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_7" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(7)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_7_text">ADVERT 7 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_8" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(8)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_8_text">ADVERT 8 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_9" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(9)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_9_text">ADVERT 9 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_10" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(10)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_10_text">ADVERT 10 HTML</td>
						</tr>
					</table>
					<input type="hidden" id="advert_space_code" name="advert_space_code" />
					<input type="hidden" id="current_page" name="current_page" />
				</form>
			</div>
			<!-- #BeginEditable "content" -->








				<div class="note" style="flex-wrap:wrap;">
					
					<div style="width:2000px;visibility:hidden">SPACE FILLER</div>

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
					
						<br/><br/>
						<button class="tab_button" id="tab_button1" onclick="DoOpenTab('tab_button1', 'tab_contents1')"><?php if (IsTradie()) echo "Browse your jobs"; else echo "Browse tradies";?></button>
						<button class="tab_button" id="tab_button2" onclick="DoOpenTab('tab_button2', 'tab_contents2')">Post your own job</button>
						<button class="tab_button" id="tab_button3" onclick="DoOpenTab('tab_button3', 'tab_contents3')">Account details</button>
						<button class="tab_button" id="tab_button4" onclick="DoOpenTab('tab_button4', 'tab_contents4')">Feedback you've received</button>
						<button class="tab_button" id="tab_button5" onclick="DoOpenTab('tab_button5', 'tab_contents5')">Feedback you've given</button>
						<button style="display:<?php if (IsTradie()) echo "block"; else echo "none"; ?>;" class="tab_button" id="tab_button6" onclick="DoOpenTab('tab_button6', 'tab_contents6')">Your adverts</button>

						<div id="tab_contents1" class="tab_content">
							<h2 id="tab_heading0"><script type="text/javascript">document.write(document.getElementById("tab_button1").innerText);</script></h2>
								<form method="post" action="" id="form_job_search" class="form search_form" style="display:<?php if (IsTradie()) echo "block"; else echo "none"; ?>;width:955px;">
									<table  cellspacing="0" cellpadding="3" border="0" class="forrm_table">
										<tr>
											<td class="form_table_cell" style="width:150px;"><b>Maximum distance</b></td>
											<td class="form_table_cell" style="width:140px;"><b>Minimum budget</b></td>
											<td class="form_table_cell" style="width:140px;"><b>Maximum size</b></td>
											<td class="form_table_cell" style="width:125px;"><b>Jobs added since</b></td>
											<td class="form_table_cell" style="width:115px;"><b>Urgent jobs only</b></td>
											<td class="form_table_cell" style="width:125px;"><b>Hide accepted jobs</b></td>
											<td class="form_table_cell" style="width:100px;text-align:center;" rowspan="2">
												<input type="submit" id="submit_job_search" name="submit_job_search" value="SEARCH" style="width:5em;margin:5px;" /><br/>
												<input type="reset" id="reset_job_search" name="reset_job_search" value="RESET" style="width:5em;;margin:5px;" />
											</td>
										</tr>
										<tr>	
											<td class="form_table_cell"><input type="text" id="text_maximum_distance" name="text_maximum_distance" maxlength="4" size="15" value="<?php echo DoGetMaxDistance() ?>" onkeydown="OnKeyPressDigitsOnly(event)" />&nbsp;<b>km</b></td>
											<td class="form_table_cell"><b>$</b>&nbsp;<input type="text" id="text_minimum_budget" name="text_minimum_budget" maxlength="7" size="15" value="<?php echo DoGetMinBudget(); ?>" onkeydown="OnKeyPressDigitsOnly(event)" /></td>
											<td class="form_table_cell">
												<select id="select_maximum_size" name="select_maximum_size">
													<?php include "job_size.html"; ?>
												</select>&nbsp;<b>m<sup>2</sup></b>
											</td>
											<?php
																							
												PrintJavascriptLine("SetSelection(\"select_maximum_size\", \"" . $_SESSION["account_maximum_size"] . "\");", 12, true);
											?>										
											<td class="form_table_cell"><input type="date" id="date_since" name="date_since" value="\<?php echo GetDateSince(); ?>\"/></td>
											<td class="form_table_cell"><input type="checkbox" id="checkbox_urgent" name="checkbox_urgent" <?php if (isset($_POST["checkbox_urgent"]) && ($_POST["checkbox_urgent"] == "on")) echo "checked"; ?>/></td>
											<td class="form_table_cell"><input type="checkbox" id="checkbox_hide_accepted" name="checkbox_hide_accepted" <?php if (isset($_POST["checkbox_hide_accepted"]) && ($_POST["checkbox_hide_accepted"] == "on")) echo "checked"; ?>/></td>
										</tr>
									</table>
								</form>
								<form method="post" action="" id="form_tradie_search" class="form search_form" style="display:<?php if (!IsTradie()) echo "block"; else echo "none"; ?>">
									<table  cellspacing="0" cellpadding="3" border="0" class="forrm_table">
										<tr>
											<td class="form_table_cell" style="width:950px;"><b>Trade type</b></td>
											<td class="form_table_cell" style="width:185px;"><b>Maximum distance from you</b></td>
											<td class="form_table_cell" style="width:100px;text-align:center;" rowspan="2"><input type="submit" id="submit_tradie_search" name="submit_tradie_search" value="SEARCH" /></td>
										</tr>
										<tr>	
											<td class="form_table_cell">
												<select id="select_trade" name="select_trade" onchange="OnChangeTrade(this, DoGetInput('trade_description_search'))">
													<?php if (isset($_POST["select_trade"])) DoGeneratePrimaryTradeOptions($_POST["select_trade"]); else DoGeneratePrimaryTradeOptions($_SESSION["account_trade"]); ?>
												</select>
												<br/><br/>
												<label id="trade_description_search">XXXXXXXXXXXXX</label>
											</td>											
											<td class="form_table_cell">
											<input type="text" id="text_maximum_distance0" name="text_maximum_distance" maxlength="4" size="15" value="<?php if (isset($_POST["text_maximum_distance"])) echo $_POST["text_maximum_distance"]; ?>" onkeydown="OnKeyPressDigitsOnly(event)" />&nbsp;<b>km</b></td>
										</tr>
									</table>
								</form>
								<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
								<table class="table_no_borders search_table">
									<tr>
										<td class="cell_no_borders search_cell" style="width:3em;"><b>ID</b></td>
										<td class="cell_no_borders search_cell" style="width:6em;"><b>Date</b></td>
										<td class="cell_no_borders search_cell" style="width:26em;"><b>Name</b></td>
										<td class="cell_no_borders search_cell" style="width:25em;"><b>Email</b></td>
										<td class="cell_no_borders search_cell" style="width:10em;"><b>Maximum budget</b></td>
										<td class="cell_no_borders search_cell" style="width:5em;"><b>Size</b></td>
										<td class="cell_no_borders search_cell" style="width:5em;"><b>Urgent?</b></td>
										<td class="cell_no_borders search_cell" style=""><b>Functions</b></td>
									</tr>
									<?php
										
										if (IsTradie())
										{
											$mapAddedJobIDs = [];
											
											$mapAddedJobIDs = DoGetJobs($_SESSION["account_trade"], $mapAddedJobIDs);
											
											$results = DoFindQuery1($g_dbFindATradie, "additional_trades", "trade_id", $_SESSION["account_trade"]);
											if ($results && ($results->num_rows > 0))
											{
												while ($row = $results->fetch_assoc())
												{
													DoGetJobs($row["trade_id"], $mapAddedJobIDs);
												}
											}
										}
										else
										{											
											if (isset($_POST["submit_tradie_search"]) && isset($_POST["select_trade"]) && ($_POST["select_trade"] != ""))
											{
												DoGetTradies($_POST["select_trade"], $mapAddedJobIDs);
											}
										}
																		
									?>
									<tr><td class="cell_no_borders search_cell" colspan="8">&nbsp;</td></tr>
								</table>
						</div>
						
						<div id="tab_contents2" class="tab_content">
							<h2 id="tab_heading1"><script type="text/javascript">document.write(document.getElementById("tab_button2").innerText);</script></h2>
							
							<form method="post" action="" id="form_add_job" class="form search_form">
								<table cellspacing="0" cellpadding="3" border="0" class="forrm_table">
									<tr>
										<td class="form_table_cell" style="width:790px;"><b>Trade type</b></td>
										<td class="form_table_cell" style="width:230px;"><b>Maximum budget</b></td>
										<td class="form_table_cell" style="width:70px;"><b>Size</b></td>
										<td class="form_table_cell" style="width:75px;"><b>Urgent</b></td>
										<td class="form_table_cell" style="width:360px;"><b>Job description</b></td>
										<td rowspan="2" class="form_table_cell" style="vertical-align:middle;width:80px;">
											<input id="submit_job" name="submit_job" type="submit" value="SUBMIT" />
										</td>
									</tr>
									<tr>
										<td class="form_table_cell">
											<select id="select_trade_job" name="select_trade_job" onchange="OnChangeTrade(this, DoGetInput('trade_description_job'))">
												<?php DoGeneratePrimaryTradeOptions(""); ?>
											</select><br/><br/>
											<label id="trade_description_job">XXXXXXXXXXXXX</label>
										</td>
										<td class="form_table_cell">
											<b>$</b>&nbsp;<input type="text" id="text_maximum_budget" name="text_maximum_budget" size="8" maxlength="7" required onkeydown="OnKeyPressDigitsOnly(event)" />
										</td class="form_table_cell">
										<td class="form_table_cell">
											<select id="select_job_size" name="select_job_size">
												<?php include "job_size.html"; ?>
											</select>
											<?php
												PrintJavascriptLine("SetSelection(\"select_job_size\", \"" . $_SESSION["account_maximum_size"] . "\")", 12, true);
											?>										
										</td>
										<td class="form_table_cell">
											<input type="checkbox" id="check_urgent" name="check_urgent" />
										</td class="form_table_cell">
										<td class="form_table_cell" >
											<textarea id="text_description" name="text_description" maxlength="512" cols="48" rows="3" required></textarea>
										</td>
									</tr>
								</table>
								<input type="hidden" id="hidden_member_id" name="hidden_member_id" value="<?php if (isset($_SESSION["account_id"])) echo $_SESSION["account_id"]; ?>" />
								<input type="hidden" id="hidden_job_id" name="hidden_job_id" value="" />
							</form>
					
<?php
	
	$bFeedbackEdit = false;
	include "feedback_form.html";

	if (isset($_POST["submit_job_edit"]))
	{
		if (isset($_POST["hidden_job_edit_id"]))
		{
			$results = DoFindQuery1($g_dbFindATradie, "jobs", "id", $_POST["hidden_job_edit_id"]);
			if ($results && ($results->num_rows > 0))
			{
				if ($row = $results->fetch_assoc())
				{
					$strChecked = "false";
					if ($row["urgent"])
						$strChecked = "true";
	
					/*
						id="select_trade_job"
						id="text_maximum_budget"
						id="select_job_size"
						id="check_urgent"
						id="text_description"
						id="hidden_member_id"
						id="hidden_job_id"
					*/
					PrintJavascriptLines([
											"let selectTrade = DoGetInput(\"select_trade\"),",
											"	textMaxBudget = DoGetInput(\"text_maximum_budget\"),",
											"	selectJobSize = DoGetInput(\"select_job_size\"),",
											"	textDesc = DoGetInput(\"text_description\"),",
											"	checkboxUrgent = DoGetInput(\"check_urgent\"),",
											"	hiddenJobID = DoGetInput(\"hidden_job_id\");",
											"",
											"if (selectTrade && textMaxBudget && selectJobSize && checkboxUrgent && hiddenJobID && textDesc)",
											"{",
											"	hiddenJobID.value = \"" . $_POST["hidden_job_edit_id"] . "\";",
											"	textMaxBudget.value = \"" . $row["maximum_budget"] . "\";",
											"	textDesc.value = \"" . $row["description"] . "\";",
											"	checkboxUrgent.checked = " . $strChecked . ";",
											"	SetSelectionValue(\"select_trade_job\", " . $row["trade_id"] . ");",
											"	SetSelection(\"select_job_size\", \"" . $row["size"] . "\");",
											"}"
										 ], 10, true);
				}
			}
		}
		else
		{
			PrintJavascriptLine("Hidden input 'hidden_job_id' value was not found!", 5, true);
		}
	}

?>
							<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
							<table  cellspacing="0" cellpadding="3" border="1" class="search_table">
								<tr>
									<td class="search_cell" style="width:9em;"><b>Date</b></td>
									<td class="search_cell" style="width:6em;"><b>Size</b></td>
									<td class="search_cell" style="width:9em;"><b>Maximum budget</b></td>
									<td class="search_cell" style="width:3em;"><b>Urgent</b></td>
									<td class="search_cell" style="width:12em;"><b>Accepted by</b></td>
									<td class="search_cell" style=""><b>Description</b></td>
									<td class="search_cell" style="width:110px;"><b>Functions</b></td>
								</tr>
								<?php
									DoGetJobsPosted();
								?>
							</table>

						</div>
						
						<div id="tab_contents3" class="tab_content">
							<h2 id="tab_heading2"><script type="text/javascript">document.write(document.getElementById("tab_button3").innerText);</script></h2>
							<form method="post" id="form_profile_image" action="" class="form" enctype="multipart/form-data" style="width:50%;">
								<fieldset>
									<legend>Profile image:</legend>
									<br/>
									<table border="0" cellspacing="0" cellpadding="5" style="table-layout:fixed;width:500px;">									

<?php
	$strID = "profile";
	include "select_file.html"; 
?>
<script type="text/javascript">
	document.getElementById("profile_image_preview").src = "<?php echo $_SESSION["account_profile_filename"]; ?>";
</script>
			
										<tr>
											<td class="cell_no_borders" style="width:100%;text-align:right;vertical-align:center;" colspan="2">
												<input type="submit" name="submit_profile" value="SAVE" />
											</td>
										</tr>
									</table>
								</fieldset>
							</form>
							
							<form method="post" id="form_logo_image" action="" class="form" enctype="multipart/form-data" style="width:50%;">
								<fieldset>
									<legend>Business logo image:</legend>
									<br/>
									<table border="0" cellspacing="0" cellpadding="5" style="table-layout:fixed;width:500px;">								
	
<?php
	$strID = "logo";
	include "select_file.html";
?>
<script type="text/javascript">
	document.getElementById("logo_image_preview").src = "<?php echo $_SESSION["account_logo_filename"]; ?>";
</script>
										<tr>
											<td class="cell_no_borders" style="width:100%;text-align:right;vertical-align:center;" colspan="2">
												<input type="submit" name="submit_logo" value="SAVE" />
											</td>
										</tr>
									</table>
								</fieldset>
							</form>

<?php include "member_details_forms.html"; ?>
						</div>
						
						<div id="tab_contents4" class="tab_content">
							<h2 id="tab_heading3"><script type="text/javascript">document.write(document.getElementById("tab_button4").innerText);</script></h2>

							<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
							<table cellspacing="0" cellpadding="10">
<?php
	DoDisplayFeedback($_SESSION["account_id"], "", true);
?>
							</table>
						</div>

						<div id="tab_contents5" class="tab_content">
							<h2 id="tab_heading4"><script type="text/javascript">document.write(document.getElementById("tab_button4").innerText);</script></h2>
							<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
<?php
	DoDisplayFeedback("", $_SESSION["account_id"], true);
	$bFeedbackEdit = true;
	include "feedback_form.html";
?>							
						</div>
						
						<div id="tab_contents6" class="tab_content" style="display:<?php if (IsTradie()) echo "block"; else echo "none"; ?>;" >
							<h2 id="tab_heading5"><script type="text/javascript">document.write(document.getElementById("tab_button6").innerText);</script></h2>
							
							<form method="post" action="" id="form_search_adverts" class="form search_form" style="width:88%;">
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
										<td class="form_table_cell" style="text-align:right;width:8em;"><input name="submit_search_adverts" type="submit" value="SEARCH" /></td>
									</tr>
								</table>
							</form>
							
							<p>If you hover the mouse pointer over the function buttons then you will see what they do.</p>
							<table  cellspacing="0" cellpadding="3" border="1" class="search_table" style="table-layout:fixed;">
								<tr>
									<td class="search_cell" style="width:5em;"><b>Date</b></td>
									<td class="search_cell" style=""><b>Advert Location</b></td>
									<td class="search_cell" style="width:8em;"><b>Cost per Month</b></td>
									<td class="search_cell" style="width:7em;"><b>Time Period</b></td>
									<td class="search_cell" style="width:6em;"><b>Total Cost</b></td>
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
								<tr><td colspan="7">&nbsp;</td></tr>
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
		let strID = sessionStorage["active tab_button"];
		
		if (strID == "tab_button2")
		{
			DoOpenTab("tab_button2", "tab_contents2");
		}
		else if (strID == "tab_button3")
		{
			DoOpenTab("tab_button3", "tab_contents3");
		}
		else if (strID == "tab_button4")
		{
			DoOpenTab("tab_button4", "tab_contents4");
		}
		else if (strID == "tab_button5")
		{
			DoOpenTab("tab_button5", "tab_contents5");
		}
		else if (strID == "tab_button6")
		{
			DoOpenTab("tab_button6", "tab_contents6");
		}
		else
		{
			DoOpenTab("tab_button1", "tab_contents1");
		}
	}
	
	DoRestoreTab();
	let rectHeading = DoGetInput("tab_heading").getBoundingClientRect();
	window.screenTop = rectHeading.top + 100;

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
