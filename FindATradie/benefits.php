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
			<a class="masthead_button" href="new_customer">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie for Australians</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">Home</a>
				<a class="navigation_link" href="benefits.php">Benefits</a>
				<a class="navigation_link" href="about.html">About</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">Account</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">Login</a>\n";
							
					?>
					<a class="navigation_link" href="contact.html">FAQ</a>
					<a class="navigation_link" href="contact.html">Contact</a>
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








				<div class="note" style="float: left; margin-left: 45px;width:1200px;">
					<p>
						<b>Find a Tradie</b> uses a mutual trust system like <b>eBay</b>, with both tradies and customers being able 
						to leave each other feedback. And both parties being able to peruse that feedback. It is for that reason that 
						customers also need to register and login to use this service.
					</p>
					<h5>BENEFITS FOR TRADIES</h5>
					<ul style="font-size: medium;">
						<li>Tradies can browse customers and view their feedback reputation.</li>
						<li>Flat annual membership for tradies, with no fees to obtain contact details.</li>
							<table class="table_borders">
								<tr>
									<td class="cell_borders">1 month</td>
									<td class="cell_borders">$<?php printf("%d", $g_nCostPerMonth); ?></td>
								</tr>
								<tr>
									<td class="cell_borders">6 monts</td>
									<td class="cell_borders">$<?php printf("%d", ($g_nCostPerMonth * 6)); ?></td>
								</tr>
								<tr>
									<td class="cell_borders">12 months</td>
									<td class="cell_borders">$<?php printf("%d", ($g_nCostPerMonth * 12)); ?></td>
								</tr>
								<tr>
									<td class="cell_borders">18 months</td>
									<td class="cell_borders">$<?php printf("%d", ($g_nCostPerMonth * 18)); ?></td>
								</tr>
								<tr>
									<td class="cell_borders">24 months</td>
									<td class="cell_borders">$<?php printf("%d", ($g_nCostPerMonth * 24)); ?></td>
								</tr>
							</table>
						<li>You can filter out jobs that are of no interest to you, e.g. too small or too far away.</li>
						<li>Tradies can post jobs for other tradies to browser and answer.</li>
						<li>Tradies with a primary trade that matches what a customer is searching for are prioritized over tradies that have listed it as an additional trade.</li>
						<li>No bank account or credit card numbers are stored on the web site.</li>
						<li>All payments made with Paypal.</li>
					</ul>
					<h5>BENEFITS FOR CUSTOMERS</h5>
					<ul style="font-size: medium;">
						<li>Customers can browse tradies and view their feedback reputation.</li>
						<li>Customers can can post jobs for local tradies to browse and answer.</li>
						<li>Free membership for customers.</li>
						<li>Customers can browse tradies (based on filters like minimum charge and maximum distance) and contact them directly.</li>
						<li>No bank account or credit card numbers are stored on the web site.</li>
						<li>All payments made with Paypal.</li>
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
