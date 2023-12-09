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
		<title>Benefits</title>
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








				<div class="advert" id="advert_benefits1" style="height: 80px; width: 95%;">
					<?php DoInsertAdvert("benefits1", 70, "advert_benefits1"); ?>
				</div>

				<div class="advert" id="advert_benefits2" style="height: 80px; width: 95%;margin-top:20px;margin-bottom:10px;">
					<?php DoInsertAdvert("benefits2", 70, "advert_benefits2"); ?>
				</div>
				
				<div class="note" style="float: left; margin-left: 45px;width:1200px; display: block;">
					<p>
						<b><u>www.find-a-tradie.com.au</u></b> uses a mutual trust system like <b>eBay</b>, with both tradies and 
						customers being able to leave each other feedback. And both parties are able to peruse that feedback 
						and decide for themselves if they are trustworthy enough to do business with. It is for that reason that 
						customers also need to register and login to use this service.
						
						The problem with Facebook groups is that the owners are incentivised to maximise the number of members of 
						their facebook groups, in order to earn a cut of Facebook's advert revenue. The goal of 
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
							There is little or no risk of you spending more money on advertising here than you actually earn from 
							any jobs you win, so <b><u>www.find-a-tradie.com.au</u></b> is ideal for small business tradies who are 
							just starting out.
						</li>
						<li>That is a big disadvantage of sites like OneFlare, HiPages &amp; ServiceSeeking through their charging 
						to obtain customer contact details.</li>
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
						<li>All communcations between clients and tradies are done through your private email account or phone numbers.</li>
						<li>So if the web site is hacked there really is not much that the hackers can gain by doing so.</li>
					</ul>
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
