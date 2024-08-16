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
		<title>Home</title>
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








				<div class="note" style="display:block;">
					<table cellpadding="0" cellspacing="10" border="0" style="float: right">
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>
								<a href="https://www.find-a-tradie.com.au/app/find_a_tradie.apk" download title="Download the android app...">
									<img src="images/AndroidMobile.png" height="100" />
								</a>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>
								<a href="" download title="IOS app is coming...">
									<img src="images/AppleMobile.png" height="100" />
								</a>
							</td>
						</tr>
					</table>
					<img src="images/Lawn-Mowing.jpg" alt="images/Lawn-Mowing.jpg" width="180" style="float:left;margin-right:10px;margin-bottom:10px;"/>
					<h6><a href="benefits.php">Click here</a> to read the benefits of becoming a member.</h6>
					<p style="font-size:large;">
						<b><u>www.find-a-tradie.com.au</u></b> is perfect for tradies and small business people who are just starting out 
						with their sole proprietor business, and are reluctant to spend $100 per month or more for avertising, when 
						there are no guarantees of it resulting in enough paid jobs to cover the cost.
					</p>
					<p style="font-size:large;">
						With <b><u>www.find-a-tradie.com.au</u></b> membership will cost you a maximum of 
						$<?php echo sprintf("%d", $g_nCostPerMonth * 12); ?> per year and you can try for as many jobs as you 
						please, with no additional charges. So there is little risk of you spending more on advertising than you 
						are likely to earn over an entire year.
					</p>
					<hr/>
					<img src="images/forum.jpg" alt="images/forum.jpg" width="340" style="float:right;margin-left:10px;margin-bottom:10px;"/>
					<h6>Community forum</h6>
					<p style="font-size:large;">
						Don't forget to join the <a href="forum.php">forum</a> once you become a member - just use the same user 
						name and password to register a forum account.
					</p>
					<p style="font-size:large;">
						Customers and tradies can negotiate jobs directly with each other through this forum, in the same way as 
						others do on Facebook. However you can rest assured that your personal data will not be exploited for 
						profit as Facebook does. 
					</p>
					<p style="font-size:large;">
						It is an alternative to posting jobs and waiting for tradies to respond to your job request, if you prefer a more social 
						experience. You can also seek advice from  tradies about the feasibility of different solutions to your 
						particular problems, and discuss jobs and times. Take advantage of this community and get involved.
					</p>
					<hr/>
					<h6>Both customers &amp; tradies need to register and login to use this service.</h6>
					<p style="font-size:large;">However if you are new here then you can give it a test run...</p>
					<form method="post" action="index.php" style="width:745px" class="form">
						
						<table class="form_table">
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What type of tradie are you looking for?</b>
								</td>
								<td class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<select id="select_trade" name="select_trade">
										<?php 
											if (isset($_POST["select_trade"]))
												DoGeneratePrimaryTradeOptions($_POST["select_trade"]);
											else
												DoGeneratePrimaryTradeOptions("52");
											?>
									</select>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What is your postcode?</b>
								</td>
								<td class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<input type="text" id="text_postcode" name="text_postcode" maxlength="4" value="<?php if (isset($_POST["text_postcode"])) echo $_POST["text_postcode"]; ?>" onkeydown="OnKeyPressDigitsOnly(event)" />
								</td>
							</tr>
							<tr>
								<td style="text-align:left;" class="cell_no_borders">
									&nbsp;
								</td>
								<td style="text-align:left;" class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<input type="submit" id="submit_search"  name="submit_search" value="SEARCH" />
								</td>
							</tr>
						</table>
					</form>
					<br/>
					<div class="form">
						<table cellpadding ="0" cellspacing="0" border="0" class="form_table" style="position:sticky;">
							<tr>
								<th class="cell_no_borders search_cell" style="width:1em;"><b>ID</b></th>
								<th class="cell_no_borders search_cell" style="width:8em;"><b>Name</b></th>
								<th class="cell_no_borders search_cell" style="width:2.5em;"><b>Send email</b></th>
								<th class="cell_no_borders search_cell" style="width:2em;"><b>Phone</b></th>
								<th class="cell_no_borders search_cell" style="width:2.5em;"><b>Mobile</b></th>
								<th class="cell_no_borders search_cell" style="width:4em;"><b>Suburb</b></th>
								<th class="cell_no_borders search_cell" style="width:1em;"><b>State</b></th>
								<th class="cell_no_borders search_cell" style="width:1.5em;"><b>Postcode</b></th>
								<th class="cell_no_borders search_cell" style="width:8em;"><b>Feedback</b></th>
							</tr>
						</table>
						<div style="max-height:300px;width:100%;overflow-y:auto;">
							<table cellpadding ="0" cellspacing="0" border="0" class="form_table" style="">
								<?php
								
									$strTradeID = "";
									$strPostcode = "";			
									
									if (isset($_POST["submit_search"]))
									{
										if (isset($_POST["select_trade"]))
											$strTradeID = $_POST["select_trade"];
										if (isset($_POST["text_postcode"]))
											$strPostcode = $_POST["text_postcode"];
									}
									if (!DoGetWebTradies($strTradeID, $strPostcode, "", 0, true))
										echo "<tr><td colspan=\"7\" style=\"height:30px;\">No tradies found based on your current search criteria...</td></tr>\n";									
								?>
							</table>
						</div>
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
