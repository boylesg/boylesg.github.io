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
		<title>NEW CUSTOMER</title>
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
			</style>
		<!-- #EndEditable -->
	</head>
	
	<body>
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tradie.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie for Australians</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">Home</a>
				<a class="navigation_link" href="benefits.php">Benefits</a>
				<a class="navigation_link" href="about.php">About</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">Account</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">Login</a>\n";
							
					?>
					<a class="navigation_link" href="faq.php">FAQ</a>
					<a class="navigation_link" href="contact.php">Contact</a>
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
		else
		{
			$strQuery = "INSERT INTO members (trade_id, first_name, surname, unit, street, suburb, state, postcode, ".
							"phone, mobile, email, username password expiry_date) VALUES (" .
							AppendSQLInsertValues("59", $_POST["text_first_name"], $_POST["text_surname"], $_POST["text_unit"],  
								$_POST["text_street"],  $_POST["text_suburb"],  $_POST["select_state"],  $_POST["text_postcode"],  
								$_POST["text_phone"],  $_POST["text_mobile"],  $_POST["text_email"], $_POST["text_username"], 
								$_POST["text_password"], date("Y-m-d") ) . ")";
	
			$result = DoQuery($g_dbFindATradie, $strQuery);
			if ($result->num_rows == 1)
			{
				PrintJavascriptLines(["AlertSuccess(\"Your details were saved to the database!\");",
										"DoGetInput('form_tradie_login').submit();"], 4, true);					
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

	PrintJavascriptLines(["let g_bIsCustomer = true;", "let g_bIsStaged = true;"], 2, true);
	include "member_details_forms.html"; 
	PrintJavascriptLines(["DoChangeFormButtonText('NEXT');", "DoSetStaged();"], 2, true);
	
?>		
				<form method="post" id="form_all_details" action="" class="form" style="display:none;">
					<input type="text" id="htext_username" name="text_username" />
					<input type="password" id="htext_password" name="text_password" />
					<input type="text" id="htext_first_name" name="text_first_name" />
					<input type="text" id="htext_surname" name="text_surname" />
					<input type="text" id="htext_unit" name="text_unit" />
					<input type="text" id="htext_street" name="text_street" />
					<input type="text" id="htext_suburb" name="text_suburb" />
					<select id="hselect_state" name="select_state">
						<?php include "states.html"; ?>
					</select>
					<input type="text" id="htext_postcode" name="text_postcode" />
					<input type="text"  id="htext_phone" name="text_phone" />
					<input type="text"  id="htext_mobile" name="text_mobile" />
					<input type="text"  id="htext_email" name="text_email" />
					<input type="hidden" name="submit_all_details" value="SUBMIT" />
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
			<!--
			<span class="footer_copyright" id="footer_copyright" style="float:right;">Copyright &copy; 2023 <i>Find a Tradie</i>. All Rights Reserved.</span>
			-->
		</div>
		<!-- End Footer -->
	
	</body>
	
	<footer>
		
		<!-- #BeginEditable "footer" -->

		<script type="text/javascript">
		
			function DoFormSubmitAll()
			{
				DoGetInput("htext_username").value = DoEncrypt(DoGetInput("text_username"), localStorage.getItem("LOREM"));
				DoGetInput("htext_password").value = DoEncrypt(DoGetInput("text_password"), localStorage.getItem("LOREM"));
				DoCopyTextInput("text_first_name", "htext_first_name");
				DoCopyTextInput("text_surname", "htext_surname");
				DoCopyTextInput("text_unit", "htext_unit");
				DoCopyTextInput("text_street", "htext_street");
				DoCopyTextInput("text_suburb", "htext_suburb");
				DoCopyTextInput("text_postcode", "htext_postcode");
				DoCopyTextInput("text_phone", "htext_phone");
				DoCopyTextInput("text_mobile", "htext_mobile");
				DoCopyTextInput("text_email", "htext_email");
				DoCopySelectInput("select_state", "hselect_state");
				DoGetInput("form_all_details").submit();
			}
			
		</script>

		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
