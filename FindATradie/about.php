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
		<title>About Us</title>
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
				<a class="navigation_link" href="about.php">About</a>
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
				
				<?php
				
					$nYears = (int)date("Y") - 2003;

				?>

				<div class="note" style="overflow-x:auto;overflow-y:visible;">
					<h6><b>Who created www.find-a-tradie.com.au?</b></h6>
					<p>
						Find a Tradie was created by myself and my brother. I am a former medical scientist, former programmer and a 
						small business gardener/landscaper, by choice, for the past  <?php echo $nYears; ?>years. My brother is still 
						a programmer. I still love the creativity and problem solving involved with building web sites and software, 
						and have put my programming skils to good use building, maintaining and hosting my own landscaping business web 
						site. Building this web site has been very enjoyable.
					</p>
					<h6><b>Why did we create www.find-a-tradie.com.au?</b></h6>
					<p>
						Recently I explored advertising on <i>www.highpages.com.au</i> and was rather disgusted at the level of gouging that 
						this company was engaging in. I was quoted $109 PER MONTH that essentially gave me 7 or so chances to 'purchase' 
						client contact details and gain a paying job.
					</p>
					<p>
						As a gardener/landscaper, in particular, it is quite hard to get decent jobs that exceed 2 hours or so, and pay 
						more than $100 or there abouts. Rising interest rates, rising rents and rising electricity/water/gas bills are 
						disuading so many people from spending on many trade services. So the client detail purchase fees, charged by 
						Highpages etc., take a signficant chunk out of what I would likely earn from any jobs I obtained from them. And 
						I doubt that I am the only tradie with the injustice of a bunch of 'suits' charging tradies that much to 
						advertise, while sitting on their back sides behind desks while we work hard in the heat and the rain out doors!
					</p>
					<p>
						So these are the two reason why my brother and I have created <i>www.find-a-tradie.com.au</i>. Not in small 
						part is the satisfaction of levergaing my programming skils to undermining web advertising service companies 
						that are clearly engaged in gouging small business tradies.
					</p>
				
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
