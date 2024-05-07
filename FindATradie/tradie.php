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
	
	</script>
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Tradie Details</title>
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
								echo "<div class=\"tradie_details\" style=\"font-size:large;\">\n";
								echo "<b><u>BUSINESS PROFILE</u></b><br/<br/><br/>\n";
								echo "<table cellspacing=\"0\" cellpadding=\"10\" class=\"table_no_borders\" style=\"display:inline-block;width:510px;\">\n";
								echo "	<tr>\n";
								echo "		<td class=\"cell_no_borders\" style=\"text-align:right;\"><b>Business name:</b></td>\n";
								echo "		<td class=\"cell_no_borders\">" . $row["business_name"] . "</td>\n";
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
								echo $row["first_name"] . " " . $row["surname"] . "<br/><br/>";
								echo "<img src=\"images/" . $row["profile_filename"] . "\" alt=\"images/" . $row["profile_filename"] . "\" width=\"150\" />";
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
								if ($row["logo_filename"] && ($row["logo_filename"] != ""))
								{
									echo "<img class=\"advert_image\" style=\"float:right;\" width=\"250\" src=\"images/" . $row["logo_filename"] . "\" alt=\"images/" . $row["logo_filename"] . "\" />\n";
								}
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
								echo "<b><u>FEEDBACK</u></b>\n";
								DoDisplayFeedback($row["id"], "", false);
								echo "</div>\n";
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
