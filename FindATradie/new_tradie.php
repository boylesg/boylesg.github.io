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
		<title>NEW TRADIE</title>
		<!-- #EndEditable -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<!-- #BeginEditable "page_styles" -->
			<style>
</style>
		<!-- #EndEditable -->
		<script type="text/javascript">
			
			function DoChangeBackgroundImage()
			{
				let nImageNum = Math.ceil(Math.random() * 39),
					strFilename = "url('/images/background" + nImageNum + ".jpg')";
					
				document.body.style.backgroundImage = strFilename;
			}
			
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
				<!-- #BeginEditable "content" -->








<?php
				
	include "member_details_forms.html";

	$_SESSION["account_additional_trades"] = [];

	//*******************************************************************************************
	//*******************************************************************************************
	//* 
	//* Form data processing functions
	//* 
	//*******************************************************************************************
	//*******************************************************************************************
	
	if (isset($_POST["submit_all_details"]))
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
		$results = DoFindQuery1($g_dbFindATradie, "members", "username", $_POST["text_username"]);
		if ($results && ($results->num_rows > 0))
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
			$dateExpiry = new DateTime();
						
			$dateExpiry->modify($g_strFreeMembership);
			$strQuery = "INSERT INTO members (trade_id, business_name, first_name, surname, abn, structure, license, description, " . 
							"minimum_charge, minimum_budget, maximum_size, maximum_distance, unit, street, suburb, state, postcode, ".
							"phone, mobile, email, username, password, expiry_date) VALUES (" .
							AppendSQLInsertValues($_POST["select_trade"], $_POST["text_business_name"], 
								$_POST["text_first_name"], $_POST["text_surname"],  $_POST["text_abn"],  $_POST["select_structure"],  
								$_POST["text_license"], $_POST["text_description"],  $_POST["text_minimum_charge"],  
								$_POST["text_minimum_budget"],   $_POST["select_maximum_size"],  $_POST["text_maximum_distance"],  
								$_POST["text_unit"],  $_POST["text_street"],  $_POST["text_suburb"],  $_POST["select_state"],  
								$_POST["text_postcode"],  $_POST["text_phone"],  $_POST["text_mobile"],  $_POST["text_email"], 
								$_POST["text_username"], DoAESEncrypt($_POST["text_password"]), $dateExpiry->format("Y-m-d")) . ")";
	
			$result = DoQuery($g_dbFindATradie, $strQuery);
			if ($result)
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
											"DoGetInput('form_login').submit();"], 4, true);
					$_SESSION["account_usernanme"] = $_POST["text_username"];			
					$_SESSION["account_password"] = $_POST["text_password"];			
				}
			}
			else
			{
				PrintJavascriptLine("AlertError(\"there was a problem inserting a record into 'members' in new_tradie.php!\");", 4, true);
			}
		}
	}
	else if (count($_POST) > 0)
	{
		print_r($_POST);
	}		
				
?>			








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



		<script type="text/javascript">
			
			DoSetTradie();
			DoSetStaged();
			
		</script>
		


		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
