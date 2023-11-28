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
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
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
					<a class="navigation_link" href="faq.php">FAQ</a>
					<a class="navigation_link" href="contact.php">Contact</a>
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
					<h6><b>Who created <u>www.find-a-tradie.com.au?</u></b></h6>
					<p>
						Find a Tradie was created by myself and my brother. I am a former medical scientist, former programmer and a 
						small business gardener/landscaper, by choice, for the past  <?php echo $nYears; ?> years. My brother is still 
						a programmer. I still love the creativity and problem solving involved with building web sites and software, 
						and have put my programming skils to good use building, maintaining and hosting my own landscaping business web 
						site. Building this web site has been very enjoyable.
					</p>
					<h6><b>Why did we create <u>www.find-a-tradie.com.au?</u></b></h6>
					<p>
						Recently I explored advertising on <b><u>www.highpages.com.au</u></b> and was rather disgusted at the level of gouging that 
						this company was engaging in. I was quoted $109 PER MONTH that essentially gave me 7 or so chances to 'purchase' 
						client contact details and gain a paying job.
					</p>
					<p>
						As a gardener/landscaper, in particular, it is quite hard to get decent jobs that exceed 1 hour or so, and pay 
						more than $100. Combine that with 30-60 minutes drive time between jobs and you end up working for below the 
						minimum wage. And rising interest rates, rising rents and rising electricity/water/gas bills are disuading 
						so many people from spending on many trade services altogether. 
					</p>
					<p>
						So the client detail purchase fees, charged by Highpages etc., take a signficant chunk out of what I would 
						likely earn from any gardening jobs I obtained from them. And I doubt that I am the only tradie with the 
						injustice about a bunch of 'suits' charging tradies THAT much to advertise while we do all the hard work hard 
						in the heat or the rain out doors!
					</p>
					<p>
						So these are the two reason why my brother and I have created <i>www.find-a-tradie.com.au</i>. Not in small 
						part is the satisfaction of levergaing my programming skills to undermine these companies that are clearly 
						engaged in gouging small business tradies. And to give Australian small business tradies a fair go.
					</p>
					<h6><b>Why is <u>www.find-a-tradie.com.au</u> different from Oneflare, Highpages and ServiceSeeking</b></h6>
					<p>
						We do not charge you to obtain a customer's contact details. For a flat membership fee of $10 per month, or $120 
						per year, you can try for as many jobs as you want. So there is little risk of you spending more money on trying for 
						jobs than you make from actually completing jobs. 

					</p>
					<p>
						There is also the issue of customers being able to post jobs on the other web sites when they are not entirely 
						serious about engaging the services of a tradie, and just want to get an idea of the cost do do a job for 
						example. It still costs tradies $10 to $20 to get their contact details but it costs the customer nothing to 
						post the job, and there are no other consequences for them. So it is for this reason that customers ALSO need 
						to register an account and login to post jobs.
					</p>
					<p>
						With <b><u>www.highpages.com.au</u></b> that poses no risk to tradies because we don't charge them to 
						obtain their contact details. And tradies must mark a job as complete, and leave feedback, once they 
						receive payment from the customer. If customers make a habit of posting jobs that they don't really have 
						any intention of following through on then those pending jobs will be visible to tradies as an indication 
						of that customer's integrity.
					</p>
					<p>
						<b><u>www.highpages.com.au</u></b> uses a mutual trust system, similar to eBay, where both customers and tradies can 
						leave each other feedback. If tradies complete jobs on time and on budget then customers can leave that tradie positive 
						feedback. Or negative feedback if the tradie does a poor job. Similarly if customers delays payment or refuses to pay 
						tradies then the tradie can leave that customer negative feedback and warn other tradies. If the customer 
						pays in full and on time then the tradie can leave that customer positive feedback. Any feedback tradies 
						or customers leave each other is editable at any time subject to private negotiations between them.
						
					</p>
					<p>
						I am old enough to remember when this country was built on the foundation of a 'fair go' for outdoor workers. 
						And I believe that myself and my brother are giving small business Australian tradies a fair go through this 
						web site.
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
