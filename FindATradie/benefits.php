<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
<!-- #BeginTemplate "master.dwt" -->

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Benefits</title>
		<!-- #EndEditable -->
		<?php include "common.php"; ?>
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
			
				div.note table
				{
					table-layout: fixed;
					border-collapse: collapse;
					margin: 10px;
					border-style: solid;
					border-color: navy;
					border-width: medium;
					width: 400px;
				}
				
				div.note td, th
				{
					padding: 5px;
					font-size: large;
					color: black;
					width: 50%;
					border-bottom-style: solid;
					border-bottom-color: navy;
					border-bottom-width: thin;
					border-left-style: none;
					border-right-style: none;
					padding: 10px;
				}

			</style>
		<!-- #EndEditable -->
	</head>
	
	<body onresize="SetPageContetHeight()">
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tradie.png" width="90" />
			<div class="web_title" id="web_title">
				FIND A TRADIE
			</div>
			<a class="masthead_button" href="new_tradie.php">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">Home</a>
				<a class="navigation_link" href="benefits.html">Benefits</a>
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








				<div class="note note_benefits" style="float: left; margin-left: 45px;">
					<h5>BENEFITS FOR TRADIES</h5>
					<ul>
						<li>Tradies can browse customers and view their feedback reputation.</li>
						<br/>
						<li>
							Flat annual membership for tradies, with no fees to obtain contact details.<br/><br/>
							<table border="1" cellspacing="0" cellpadding="2em">
								<tr>
									<td>1 month</td>
									<td>$<?php printf("%d", $g_nCostPerMonth); ?></td>
								</tr>
								<tr>
									<td>6 monts</td>
									<td>$<?php printf("%d", ($g_nCostPerMonth * 6)); ?></td>
								</tr>
								<tr>
									<td>12 months</td>
									<td>$<?php printf("%d", ($g_nCostPerMonth * 12)); ?></td>
								</tr>
								<tr>
									<td>18 months</td>
									<td>$<?php printf("%d", ($g_nCostPerMonth * 18)); ?></td>
								</tr>
								<tr>
									<td>24 months</td>
									<td>$<?php printf("%d", ($g_nCostPerMonth * 24)); ?></td>
								</tr>
							</table>
						</li>
						<br/>
						<li>You can filter out jobs that are of no interest to you, e.g. too small or too far away.</li>
						<br/>
						<li>No bank account or credit card numbers are stored on the web site.</li>
						<br/>
						<li>All payments made with Paypal.</li>
					</ul>
					<h5>BENEFITS FOR CUSTOMERS</h5>
					<ul>
						<li>Customers can browse tradies and view their feedback reputation.</li>
						<br/>
						<li>Free membership for customers.</li>
						<br/>
						<li>Customers can browse tradies (based on filters like minimum charge and maximum distance) and contact them directly.</li>
						<br/>
						<li>No bank account or credit card numbers are stored on the web site.</li>
						<br/>
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
		
		<script type="text/javascript">
								
		</script>
	
	</footer>
	
<!-- #EndTemplate -->
	
</html>
