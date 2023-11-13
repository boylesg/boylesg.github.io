<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	


	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Home</title>
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
					background-color: /*white*/var(--ColorBodyBG);
				}

			</style>
		<!-- #BeginEditable "page_styles" -->
			<style>


				p
				{
					color:black;
					font-size:medium;
				}
				li
				{
					color:black;
					font-size:medium;
				}
				table
				{
					display:inline-block;
					border-style:solid;
					border-width:medium;
					border-collapse:collapse;
					border-color:#CCAA77;
					margin-left:auto;
					margin-right:auto;
					margin-top:0;
					margin-bottom:0;
					position:relative;
					left:0em;
				}
				td, th
				{
					border-style:solid;
					border-width:thin;
					border-color:#CCAA77;
					padding:20px;
					font-size:large;
					width:12em;
					color:black;
				}
				
				h2
				{
					color:#CCAA77;
				}
			</style>
		<!-- #EndEditable -->
	</head>
	
	<body onresize="SetPageContetHeight()">
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tradie.png" width="90" />
			<div class="web_title_container" id="web_title_container">
				<div class="web_name" id="web_name">
					Find a Tradie<br/>
				</div>
				<div class="web_tag_line">
					Gardener, landscaper, electrician, plumber, builder, carpenter, plasterer, painter &amp; more
				</div>
			</div>
			<img class="trades_image" src="images/Tools.png" alt="images/Tools.png"/>
		</div>
		<!-- End Masthead -->
		<!-- Begin Navigation -->
		<nav class="navigation" id="navigation">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="about.html">About</a></li>
				<li><a href="new_tradie.php">New Tradie</a></li>
				<li><a href="new_customer.html">New Customer</a></li>
				<?php

					if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
						echo "<li><a href=\"account.php\">Account</a></li>\n";
					else
						echo "<li><a href=\"login.php\">Login</a></li>\n";
						
				?>
				<li><a href="compare.html">Compare</a></li>
				<li><a href="contact.html">FAQ</a></li>
				<li><a href="contact.html">Contact</a></li>
			</ul>
		</nav>
		<!-- End Navigation -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
			<h1><u><script type="text/javascript">document.write(document.title);</script></u></h1>				
				<!-- #BeginEditable "content" -->



XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX




				<!-- #EndEditable -->
		<!-- End Page Content -->
		</div>
		<!-- Begin Footer -->
		<div class="footer" id="footer">
			<span class="footer_links" id="footer_links">
				<a href="index.php">Home</a> | 
				<a href="new_tradie.php">New Tradie</a> | 
				<a href="new_customer.html">New Customer</a> | 
				<?php
					if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
						echo "<a href=\"account.php\">Account</a>";
					else
						echo "<a href=\"login.php\">Login</a>";
				?> | 
				<a href="about.html">About</a> | 
				<a href="compare.html">Compare</a> | 
				<a href="faq.html">FAQ</a> | 
				<a href="contact.html">Contact</a>
			</span>
			<span class="footer_copyright" id="footer_copyright" style="float:right;">Copyright &copy; 2023 <i>Find a Tradie</i>. All Rights Reserved.</span>
		</div>
		<!-- End Footer -->
	
	</body>
	
	<footer>
		
		<script type="text/javascript">
		
			function SetPageContetHeight()
			{
				let divMasthead = document.getElementById("masthead"),
					navNavigation = document.getElementById("navigation"),
					divFooter = document.getElementById("footer"),
					divPageContent = document.getElementById("page_content"),
					nTotalOccupiedHeight = 0, nAvailableHeight = 680;
					
				if (divMasthead && divFooter && navNavigation && divPageContent)
				{
					nTotalOccupiedHeight = divMasthead.offsetHeight + divFooter.offsetHeight + navNavigation.offsetHeight;
					nAvailableHeight = document.documentElement.offsetHeight - nTotalOccupiedHeight;
					divPageContent.style.height = nAvailableHeight + "px";
					divPageContent.style.width = document.documentElement.offsetWidth;
				}
			}
			SetPageContetHeight();
			
		</script>
	
	</footer>
	
<!-- #EndTemplate -->
	
</html>
