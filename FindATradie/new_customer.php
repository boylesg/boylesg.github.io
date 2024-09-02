<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/advert_stuff.php";
	?>
	<script type="text/javascript">	

		sessionStorage["member_id"] = <?php if (isset($_SESSION["account_id"])) echo $_SESSION["account_id"]; else echo "0"; ?>
	
	</script>
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>NEW CUSTOMER</title>
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
			<marquee id="advert_marquee " behavior="alternate" scrolldelay="80" truespeed loop="-1" style="<?php if (strcmp(basename($_SERVER['REQUEST_URI']), "admin.php") == 0) echo "none"; else echo "block";?>;" class="advert_marquee">
				<?php DoGenerateAdvertSlotHTML(); ?></marquee>
			<!-- #BeginEditable "content" -->








			<div class="note">	
				<h6>You can become a member for <span style="color:red;">FREE</span>!</h6>	

<?php
	
	$_SESSION["NEW"] = true;
				
	include "member_details_forms.html"; 
	
	$_SESSION["account_additional_trades"] = [];

	//*******************************************************************************************
	//*******************************************************************************************
	//* 
	//* Form data processing functions
	//* 
	//*******************************************************************************************
	//*******************************************************************************************
	
	if (isset($_POST["button_save_all"]) && DoCheckCorrectNumberTest($_POST["text_number_test"]))
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
		$results = DoFindQuery1($g_dbFindATradie, "members", "username", $_POST["text_username"]);
		if ($results && ($results->num_rows > 0))
		{
			PrintJSAlertWarning("The username '" . $_POST["text_username"] . "' is already registered by someone else!", 2, true);
		}
		else
		{
			$results = DoFindQuery9($g_dbFindATradie, "members",  
							"surname", $_POST["text_surname"], "first_name", $_POST["text_first_name"],
							"email", $_POST["text_email"], "suburb", $_POST["text_suburb"],
							"state", $_POST["select_state"], "postcode", $_POST["text_postcode"],
							"mobile", $_POST["text_mobile"], "phone", $_POST["text_phone"], "gender", 
							$_POST["select_gender"]);
			if ($results && ($results->num_rows > 0))
			{
				PrintJSAlertWarning("Some on with the same name, email address, suburb, state, postcode, mobile and phone is already registered as a member!",  2);
			}
			else
			{
				$dateExpiry = new DateTime();
				$dateExpiry->modify("100 years");
				$g_strQuery = "INSERT INTO members (trade_id, first_name, surname, unit, street, suburb, state, postcode, ".
								"phone, mobile, email, username, password, expiry_date, gender) VALUES (" .
								AppendSQLInsertValues(DoGetCustomerTradeID(), $_POST["text_first_name"], $_POST["text_surname"], 
									$_POST["text_unit"],  $_POST["text_street"],  $_POST["text_suburb"],  $_POST["select_state"],  
									$_POST["text_postcode"],  $_POST["text_phone"],  $_POST["text_mobile"],  $_POST["text_email"], 
									$_POST["text_username"], $_POST["text_password"], $dateExpiry->format("Y-m-d")) . $_POST["select_gender"] . ")";

				$result = DoQuery($g_dbFindATradie, $g_strQuery);
				if ($result)
				{
					mail("$g_strAdminEmail", "NEW CUSTOMER", "NAME: " . $_POST["text_first_name"] . " " . $_POST["text_surname"]);
					PrintJavascriptLine("window.location.href = \"https://www.find-a-tradie.com.au/login.php\";", 4, true);					
					$_SESSION["account_usernanme"] = $_POST["text_username"];			
					$_SESSION["account_password"] = $_POST["text_password"];			
				}
				else
				{
					PrintJSAlertError("There was a problem inserting a record into 'members' in new_tradie.php!", 4);
				}
			}
		}
	}

?>
			</div>	
	







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
			
			DoSetCustomer();
			DoSetStaged();
			
		</script>



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
