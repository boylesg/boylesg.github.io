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
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
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
			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading text_outline"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
		<!-- End PageHeading -->
		<!-- End Masthead -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
				<!-- #BeginEditable "content" -->








				<?php
				
					$nYears = (int)date("Y") - 2003;

				?>

				<div class="advert" id="advert_about1" style="height: 80px; width: 95%;">
					<?php DoInsertAdvert("about1", 70, "advert_about1"); ?>
				</div>

				<div class="advert" id="advert_about2" style="height: 80px; width: 95%;margin-top:20px;margin-bottom:10px;">
					<?php DoInsertAdvert("about2", 70, "advert_about2"); ?>
				</div>
				
				<div class="note" style="overflow-x:auto;overflow-y:visible;">
					<h6><b>Who created <u>www.find-a-tradie.com.au?</u></b></h6>
					<p>
						Find a Tradie was created by my brother and myself. I am a former medical scientist, former programmer 
						and I have been a small business gardener/landscaper for the past <?php echo $nYears; ?> years. My 
						brother is still a programmer. I still love the creativity and problem solving involved with building 
						web sites and software, and have put my programming skills to good use building, maintaining and hosting 
						my own landscaping business web site. As well as half dozen other web sites for my self and a friend.
					</p>
					<h6><b>Why did we create <u>www.find-a-tradie.com.au?</u></b></h6>
					<p>
						Recently I explored advertising on other similar tradie advertising web services and was rather disgusted 
						at the level of gouging that they engaging in. I was quoted $109 PER MONTH, that essentially gave me 7 or 
						so chances to 'purchase' client contact details and obtain a paying job.
					</p>
					<p>
						As a gardener/landscaper, in particular, it is quite hard to get decent jobs that exceed 1-2 hours, 
						and pay more than $100 or so. Combine that with 30-60 minutes drive time between jobs and you can easily 
						end up working for minimum wage or barely above it. And rising interest rates, rising cost of living over 
						the last few years are disuading so many people from spending on many trade services altogether. 
					</p>
					<p>
						Combine that with high level of competition in many trade services and I could easily spend as much on 
						advertising with these companies over a year than I would likely earn from any gardening jobs I obtained 
						through them. And I doubt that I am the only tradie who is experiencing this issue. Nor the only tradie 
						who feels that the 'suits' behind these companies gouging such a high gaurenteed income from us really 
						sucks when it is we who do all the hard work in the heat or the rain outdoors!
					</p>
					<p>
						So these are the two reasons why my brother and I have created <b><u>www.find-a-tradie.com.au</u></b>. 
						Not in small part is the satisfaction of leveraging my programming skills to give other small business 
						tradies like me, and indeed myself, a fair go. And I am old enough to remember when this country was built 
						on the foundation of giving all workers are fair go.
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
