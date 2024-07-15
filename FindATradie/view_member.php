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
		sessionStorage["member_id"] = <?php echo $_SESSION["account_id"]; ?>
	
	</script>
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Member Details</title>
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
					<li class="navigation_list_item" <?php if (isset($_SESSION["account_admin"]) && ($_SESSION["account_admin"] == 0)) echo "style=\"display:none;\"";?>><a class="navigation_link" href="admin.php" title="For the web administrator only...">ADMIN</a></li>
				</ul>
				<a href="https://www.facebook.com/FindATradiePage" class="social_media" title="Go to the facebook page..."><img src="images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
				<a id="find-a-tradie-app" class="app_button" href="https://www.find-a-tradie.com.au/app/find_a_tradie.apk" download title="Download the android app...">
					<img src="images/AppIcon.png" width="30" />
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








		<div class="page_content" id="page_content0">

			<div class="note" style="overflow-x:auto;overflow-y:visible;">
				<?php 
				
					if (isset($_GET["member_id"]))
					{						
						$results = DoFindQuery1($g_dbFindATradie, "members", "id", $_GET["member_id"]);
						if ($results && ($results->num_rows > 0))
						{
							$row = $results->fetch_assoc();
							if ($row)
							{
								if (IsTradie($row["trade_id"]))
								{
									$strEmail = $row["email"];
									$strPhone = $row["phone"];
									$strMobile = $row["mobile"];
									if (isset($_GET["try_out"]) && (strcmp($_GET["try_out"], "true") == 0))
									{
										$strEmail = "dummy_email@gmail.com";
										$strPhone = "94010000";
										$strMobile = "0455000000";
									}
									
									
									echo "<div class=\"tradie_details\">\n";
									echo "<b><u>BUSINESS PROFILE</u></b><br/<br/><br/>\n";
									echo "<table cellspacing=\"0\" cellpadding=\"10\" class=\"table_no_borders\" style=\"display:inline-block;width:510px;\">\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Business name:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">" . $row["business_name"] . "<br/>";
									if ($row["logo_filename"] && (strcmp($row["logo_filename"], "") != 0))
									{
										echo "<img class=\"advert_image\" style=\"display:block;\" width=\"200\" src=\"" . $row["logo_filename"] . "\" alt=\"images/" . $row["logo_filename"] . "\" />";
									}
									echo "</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>ABN:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">" . $row["abn"] . "</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Structure:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">" . $row["structure"] . "</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;vertical-align:top;\"><b>Name:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">";
									echo $row["first_name"] . " " . $row["surname"] . "<br/>";
									if ($row["profile_filename"] && (strcmp($row["profile_filename"], "") != 0))
									{
										echo "<img src=\"" . $row["profile_filename"] . "\" alt=\"images/" . $row["profile_filename"] . "\" width=\"200\" style=\"display:block;\" />";
									}
									echo "</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Phone:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">\n";
									if ($row["phone"] && ($row["phone"] != ""))
										echo $strPhone . "\n";
									echo "		</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Mobile:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">";
									if ($row["mobile"] && ($row["mobile"] != ""))
										echo $strMobile . "\n";
									echo "		</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Email:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">";
									if ($row["email"] && ($row["email"] != ""))
										echo $strEmail;
									echo "		</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Location:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">" . $row["suburb"] . ", " . $row["state"] . ", " . $row["postcode"] . "</td>\n";
									echo "	</tr>\n";
									echo "</table>\n";
									echo "</div>\n";
									echo "<div class=\"tradie_about\">\n";
									echo "<b><u>TRADES</u></b><br/>\n";
									echo "<b>Primary trade: </b>" . GetTradeName($row["trade_id"]) . "<br/<br/>\n";
									echo "<b>Additional trades: </b>";
									echo GetAdditionalTradeNames($row["id"]) . "<br/><br/>\n";
									
									if ($row["license"] && ($row["license"] != ""))
									{
										echo "<b><u>BUSINESS LICENSES & PROFESSIONAL MEMBERSHIPS</u></b><br/>\n";
										echo RelaceCRLF($row["license"]);
										echo "<br/><br/>";
									}
									if ($row["description"] && ($row["description"] != ""))
									{
										echo "<b><u>ABOUT THE BUSINESS</u></b><br/>\n";
										echo RelaceCRLF($row["description"]);
										echo "<br/>";
									}
									echo "</div>\n";
									echo "<div class=\"tradie_feedback\">\n";
									echo "<b><u>FEEDBACK AS A CLIENT</u></b>\n";
									DoDisplayFeedbackPercentages($_GET["member_id"], "", "tradie");
	
									echo "<table cellspacing=\"0\" cellpadding=\"10\" border=\"0\" class=\"table_no_borders search_table\">\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:1em;\">+/-</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:10em;\">Feedback comments</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:1.5em;\">Job ID</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:3.5em;\">Date feedback</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:8em;\">Tradie name<br/>Business name<br/>Location</td>\n";
									echo "</tr>\n";
									DoDisplayFeedbackAs($_GET["member_id"], "customer");
									echo "</table>\n";
									echo "</div>\n";
									
									echo "<div class=\"tradie_feedback\">\n";
									echo "<b><u>FEEDBACK AS A TRADIE</u></b>\n";
										
									DoDisplayFeedbackPercentages($_GET["member_id"], "", "tradie");
										
									echo "<table cellspacing=\"0\" cellpadding=\"10\" border=\"0\" class=\"table_no_borders search_table\">\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:1em;\">+/-</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:6em;\">Feedback comments</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:1.5em;\">Job ID</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:3.5em;\">Date feedback</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:6em;\">Client name<br/>Location</td>\n";
									echo "</tr>\n";
									DoDisplayFeedbackAs($_GET["member_id"], "tradie");
									echo "</table>\n";
									echo "</div>\n";
								}
								else
								{
									echo "<div class=\"tradie_details\" style=\"font-size:large;background-color: #778899;\">\n";
									echo "<b><u>CUSTOMER PROFILE</u></b><br/<br/><br/>\n";
									echo "<table cellspacing=\"0\" cellpadding=\"10\" class=\"table_no_borders\" style=\"display:inline-block;width:510px;\">\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;vertical-align:top;\"><b>Name:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">";
									echo $row["first_name"] . " " . $row["surname"] . "<br/>";
									if ($row["profile_filename"] && (strcmp($row["profile_filename"], "") != 0))
									{
										echo "<img src=\"" . $row["profile_filename"] . "\" alt=\"images/" . $row["profile_filename"] . "\" width=\"200\" style=\"display:block;\" />";
									}
									echo "</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Phone:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">\n";
									if ($row["phone"] && ($row["phone"] != ""))
										echo $row["phone"] . "\n";
									echo "		</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Mobile:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">";
									if ($row["mobile"] && ($row["mobile"] != ""))
										echo $row["mobile"] . "\n";
									echo "		</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Email:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">";
									if ($row["email"] && ($row["email"] != ""))
										echo $row["email"];
									echo "		</td>\n";
									echo "	</tr>\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Location:</b></td>\n";
									echo "		<td class=\"cell_no_borders\">" . $row["suburb"] . ", " . $row["state"] . ", " . $row["postcode"] . "</td>\n";
									echo "	</tr>\n";
									echo "</table>\n";
									echo "</div>\n";

									echo "<div class=\"tradie_feedback\" style=\"font-size:medium;background-color: #778899;\">\n";
									echo "<b><u>FEEDBACK</u></b>\n";
									DoDisplayFeedbackPercentages($_GET["member_id"], "", "customer");
									
									echo "<table cellspacing=\"0\" cellpadding=\"10\" border=\"0\" class=\"table_no_borders search_table\" style=\"\">\n";
									echo "	<tr>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:0.5em;\">+/-</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:12em;\">Feedback comments</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:0.5em;\">Job ID</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:1em;\">Date feedback</td>\n";
									echo "		<td class=\"cell_no_borders search_cell\" style=\"width:4em;\">Tradie name<br/>Business name<br/>Location</td>\n";
									echo "</tr>\n";
									DoDisplayFeedbackAs($_GET["member_id"], "customer");
									echo "</table>\n";
									echo "</div>\n";
								}
							}
						}
					}
					
					if (isset($_GET["advert_id"]))
					{
						$results = DoFindQuery1($g_dbFindATradie, "adverts", "id", $_GET["advert_id"]);
						if ($results && ($results->num_rows > 0))
						{
							if ($row = $results->fetch_assoc())
							{
								$nNumClicks = (int)$row["number_clicks"] + 1;
								$results = DoUpdateQuery1($g_dbFindATradie, "adverts", "number_clicks", $nNumClicks, "id", $_GET["advert_id"]);
								if ($results)
								{
								}
								else
								{
									PrintJSAlertError("Could not increment number of clicks for advert with ID '" . $_GET["advert_id"] . "'!");
								}
							}
							else
							{
								PrintJSAlertError("Could not fetch advert record with ID '" . $_GET["advert_id"] . "'!");
							}
						}
						else
						{
							PrintJSAlertError("Could not find advert with ID '" . $_GET["advert_id"] . "'!");
						}
					}

				?>
			</div>
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
		
		<script type="text/javascript">	
		
			DoSetAdverts();
		
		</script>
		
		<!-- #BeginEditable "footer" -->



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
