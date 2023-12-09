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
		<title>NEW TRADIE</title>
		<!-- #EndEditable -->
		<?php include "common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
			<?php
			
				function DoGetRandomBackgroundImage()
				{
					$strImagfeFileName = "background";
					$nNum = rand(1, 9);
					$strImagfeFileName = $strImagfeFileName . $nNum;
					return $strImagfeFileName;
				}
				
			?>
			<style>

			
				body 
				{
					color: #000;
					font-family: Arial, Helvetica, sans-serif;
					font-size: small;
					font-style: normal;
					background-image: url('images/<?php echo DoGetRandomBackgroundImage(); ?>.jpg');
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
				}
				
			</style>
			
		<!-- #BeginEditable "page_styles" -->
			<style>
</style>
		<!-- #EndEditable -->
	</head>
	
	<body>
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tools.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie.</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">HOME</a>
				<a class="navigation_link" href="benefits.php">BENEFITS</a>
				<a class="navigation_link" href="about.php">ABOUT</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">LOG IN</a>\n";
							
					?>
				<a class="navigation_link" href="faq.php">FAQ</a>
				<a class="navigation_link" href="contact.php">CONTACT</a>
				<a class="navigation_link" href="forum.php">FORUM</a>
				<div class="nav_images">
					<img src="images/tools/ACTester.png" alt="images/tools/ACTester.png" class="nav_image" />
					<img src="images/tools/Chainsaw.png" alt="images/tools/Chainsaw.png" class="nav_image" style="width:80px;" />
					<img src="images/tools/LawnMower.png" alt="images/tools/LawnMower.png" class="nav_image" style="width:50px; />
					<img src="images/tools/SewingMachine.png" alt="images/tools/SewingMachine.png" class="nav_image" />
					<img src="images/tools/PlumberWrench.png" alt="images/tools/PlumberWrench.png" class="nav_image" />
					<img src="images/tools/GlassCutter.png" alt="images/tools/GlassCutter.png" class="nav_image" />
				</div>
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








<?php
				
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
			$dateExpiry = new DateTime();
						
			if ($g_nDaysToGo > 0)
			{
				$interval = DateInterval::createFromDateString("6 months");
				$dateExpiry->add($interval);
			}
			$strQuery = "INSERT INTO members (trade_id, business_name, first_name, surname, abn, structure, license, description, " . 
							"minimum_charge, minimum_budget, maximum_size, maximum_distance, unit, street, suburb, state, postcode, ".
							"phone, mobile, email, username, password, expiry_date) VALUES (" .
							AppendSQLInsertValues($_POST["select_trade"], $_POST["text_business_name"], 
								$_POST["text_first_name"], $_POST["text_surname"],  $_POST["text_abn"],  $_POST["select_structure"],  
								$_POST["text_license"], $_POST["text_description"],  $_POST["text_minimum_charge"],  
								$_POST["text_minimum_budget"],   $_POST["select_maximum_size"],  $_POST["text_maximum_distance"],  
								$_POST["text_unit"],  $_POST["text_street"],  $_POST["text_suburb"],  $_POST["select_state"],  
								$_POST["text_postcode"],  $_POST["text_phone"],  $_POST["text_mobile"],  $_POST["text_email"], 
								$_POST["text_username"], $_POST["text_password"], $dateExpiry->format("Y-m-d")) . ")";
	
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
	else if (count($_POST) > 0)
	{
		print_r($_POST);
	}		
				
	include "member_details_forms.html";

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
