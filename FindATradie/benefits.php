﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
		<title>Benefits</title>
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








				<div class="advert" id="advert_benefits1" style="height: 80px; width: 95%;">
					<?php DoInsertAdvert("benefits1", 70, "advert_benefits1"); ?>
				</div>

				<div class="note" style="float: left; margin-left: 45px;width:1200px; display: block;">
					<p>
						<b><u>www.find-a-tradie.com.au</u></b> uses a mutual trust system like <b>eBay</b>, with both tradies and 
						customers being able to leave each other feedback. And both parties are able to peruse that feedback 
						and decide for themselves if they are trustworthy enough to do business with. It is for that reason that 
						customers also need to register and login to use this service.
						
						The problem with Facebook groups is that the owners are incentivised to maximise the number of members on 
						their Facebook groups, in order to earn a cut of Facebook's advertising revenue. In contrast the goal of 
						<b><u>www.find-a-tradie.com.au</u></b> is to maximise the trustworthiness of all participants.
					</p>
					<h5>BENEFITS FOR TRADIES</h5>
					<ul style="font-size: medium;">
						<li>Tradies can browse customers and view their feedback reputation.</li>
						<li>Flat annual membership for tradies, with no fees to obtain contact details.</li>
							<table class="table_borders" style="width:500px;">
								<tr>
									<td class="cell_borders"><b>1 month</b></td>
									<td class="cell_borders">$<?php printf("%d", $g_nCostPerMonth); ?></td>
								</tr>
								<tr>
									<td class="cell_borders"><b>6 months</b></td>
									<td class="cell_borders">$<?php printf("%d", ($g_nCostPerMonth * 6)); ?></td>
								</tr>
								<tr>
									<td class="cell_borders"><b>12 months</b></td>
									<td class="cell_borders">$<?php printf("%d", ($g_nCostPerMonth * 12)); ?></td>
								</tr>
								<tr>
									<td class="cell_borders"><b>18 months</b></td>
									<td class="cell_borders">$<?php printf("%d", ($g_nCostPerMonth * 18)); ?></td>
								</tr>
								<tr>
									<td class="cell_borders"><b>24 months</b></td>
									<td class="cell_borders">$<?php printf("%d", ($g_nCostPerMonth * 24)); ?></td>
								</tr>
							</table>
						<li>You can filter out jobs that are of no interest to you, e.g. too small or too far away.</li>
						<li>Tradies can post jobs for other tradies to browse and answer.</li>
						<li>Tradies with a primary trade that matches what a customer is searching for are prioritized over 
							tradies that have listed it as an additional trade.</li>
						<li>
							There is little or no risk of you spending more money on advertising than you are likely to actually 
							earn from any jobs you win over an entire year. So <b><u>www.find-a-tradie.com.au</u></b> is ideal 
							for small business tradies who are just starting out.
						</li>
						<li>The services of our competitors charge you around $10 each time you request a customers contact 
						details, and that means you can easily spend more on advertising than you can earn from jobs over a matter
						of months.</li>
					</ul>
					<h5>BENEFITS FOR CUSTOMERS</h5>
					<ul style="font-size: medium;">
						<li>Customers can browse tradies and view their feedback reputation.</li>
						<li>Customers can post jobs for local tradies to browse and answer.</li>
						<li>Free membership for customers.</li>
						<li>Customers can browse tradies (based on filters like minimum charge and maximum distance) and contact them directly.</li>
						<li>No bank account or credit card numbers are stored on the web site.</li>
						<li>All payments made with Paypal.</li>
					</ul>
					<h5>BENEFITS FOR BOTH</h5>
					<ul style="font-size: medium;">
						<li>No bank account or credit card numbers are stored on the web site.</li>
						<li>Personal identification data, such as DOB, are not stored on the web site.</li>
						<li>Any of your business or personal information that is stored on the web site, you have almost certainly made public through 
							other forms of advertising and social media etc.</li>
						<li>All payments made with Paypal to us are made by using Paypal.</li>
						<li>All payments by members to each other are made through third party invoicing and payment systems, e.g. direct bank deposits.</li>
						<li>All communications between clients and tradies are done through their private email accounts or phone numbers.</li>
						<li>So if the web site is hacked there really is not much that the hackers can gain.</li>
					</ul>
				</div>
				
				<div class="advert" id="advert_benefits2" style="height: 80px; width: 95%;margin-top:20px;margin-bottom:10px;">
					<?php DoInsertAdvert("benefits2", 70, "advert_benefits2"); ?>
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



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
