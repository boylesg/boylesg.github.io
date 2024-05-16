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
		<title>Frequently Asked Questions</title>
		<!-- #EndEditable -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.js"; ?>
		<link href="styles/style.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
		<!-- #BeginEditable "page_styles" -->
			<style>



			
				.faq_question
				{
					display: block;
					font-size: medium;
					font-weight: bold;
					margin-top: 30px;
					color: MidnightBlue;
				}
				
				.faq_answer
				{
					display: block;
					font-size: medium;
					font-weight: bold;
					margin-bottom: 30px;	
					color: black;
				}
				
				.table_costs
				{
					table-layout: fixed;
					border-width: thin;
					border-color: black;
					font-size: small;
				}
				
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
				<a href="https://www.facebook.com/FindATradiePage" class="social_media" ><img src="images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
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








				<div class="note" style="display:block;overflow-x:auto;overflow-y:visible;">

					<ul>						<hr/><li class="faq_question">
							Q. How much will it cost me to join?<br/>
						</li>
						<li class="faq_answer">
							A. Here are the costs.<br/><br/>
							<table cellpadding="10" cellpadding="1" border="1" class="table_costs">
								<tr>
									<td><b>Per month</b></td>
									<td><?php printf("$%02d", $g_nCostPerMonth); ?></td>
								</tr>
								<tr>
									<td><b>Per 6 vmonths</b></td>
									<td><?php printf("$%02d", $g_nCostPerMonth * 6); ?></td>
								</tr>
								<tr>
									<td><b>Per 12 months</b></td>
									<td><?php printf("$%02d", $g_nCostPerMonth * 12); ?></td>
								</tr>
								<tr>
									<td><b>Per 18 months</b></td>
									<td><?php printf("$%02d", $g_nCostPerMonth * 18); ?></td>
								</tr>
								<tr>
									<td><b>Per 24 months</b></td>
									<td><?php printf("$%02d", $g_nCostPerMonth * 24); ?></td>
								</tr>
							</table>
						</li>
						<hr/><li class="faq_question">
							Q. Do I have to pay to obtain customer contact details?<br/>
						</li>
						<li class="faq_answer">A. No, you do not have to pay fees to obtain customer contact details.</li>
						<hr/><li class="faq_question">
							Q. How much will it cost me to list a job for tradies?<br/>
						</li>
						<li class="faq_answer">
							A. It won't cost you anything to list jobs, but you still have to register a customer account.
						</li>
						<hr/><li class="faq_question">
							Q. Can I add positive feedback and testimonials for jobs I have completed in the past and on other 
								platforms?<br/>
						</li>
						<li class="faq_answer">
							A. Yes you can - just email us with the feedback and testimonials and we will add it 
							for you. We need to peruse the feedback to satisfy ourselves that it is genuine.
						</li>
						<hr/><li class="faq_question">
							Q. How is <b><u>www.find-a-tradie.com.au</u></b> safer than Facebook groups?<br/>
						</li>
						<li class="faq_answer">
							A. The integrity of customers and tradies alike is only as good as the efforts of the Facebook group 
							owners to maintain it a high level. And let's face it, the amount of revenue from Facebook groups is directly 
							proportional to the number of members. So the incentive for Facebook group owners is always to maximise the 
							number of group members rather than the integrity of its members.
						</li>
						<hr/><li class="faq_question">
							Q. Do you store bank account and credit card numbers?<br/>
						</li>
						<li class="faq_answer">
							A. No. All payments are made by your through external web sites like Paypal or eBanking through your bank's web site. 
							So no sensitive financial or personal details are stored on the web site. The only details that are stored are:
							<ul>
								<li>Business
									<ul>
										<li>Email</li>
										<li>Mobile</li>
										<li>Landline</li>
										<li>Suburb, state, postcode</li>
										<li>Unit number and street are optional - don't bother adding these unless they pertain to a business premises.</li>
									</ul>
								</li>
								<li>Personal
									<ul>
										<li>Email</li>
										<li>Mobile</li>
										<li>Landline</li>
										<li>Suburb, state, postcode</li>
										<li>Unit number and street are optional - you can add these if you want but they are not necessary.</li>
									</ul>
								</li>
							</ul>
							<p>Most of these are likely to be in the public domain already through your Facebook and Google accounts etc.</p>
						</li>
						<hr/><li class="faq_question">
							Q. I am a customer so why do I have to join to 'Find a Tradie'?<br/>
						</li>
						<li class="faq_answer">
							A. Because we want this system to be fair for both tradies and their customers. It employs 
							a mutual trust and feedback system, similar to eBay, that allows both tradies and customers 
							to judge each other's integrity based on their feedback and testimonials.
						</li>
						<hr/><li class="faq_question">
							Q. What if someone hacks my account?<br/>
						</li>
						<li class="faq_answer">
							A. If they do then it is not really going to bring them much benefit. There are no credit 
							cards numbers, no bank account numbers, no dates of birth or any other identity data for 
							them to steal. Other than what you have likely made public yourself in the Yellow Pages or 
							on Facebook etc. All communications take place via your phone numbers and private email 
							accounts, so there is little information about you for them to access. Unless they also 
							hack your email and mobile accounts.
						</li>
						<hr/><li class="faq_question">
							Q. Does 'Find a Tradie' provide guarantees on workmanship or refunds?<br/>
						</li>
						<li class="faq_answer">
							A. No. It is simply a platform to allow tradies to connect with customers. We play no 
							role in business relationships or financial transactions between tradies and their customers.
						</li>
						<hr/><li class="faq_question">
							Q. I am a tradie so can I try out find-a-tradie to see if it suits me?<br/>
						</li>
						<li class="faq_answer">
							A.Yes you can. Every tradie gets their first <?php echo $g_strFreeMembership; ?> months membership for free. And there are no 
							time limits on this.
						</li>
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
		
			DoSetAdverts();
		
		</script>
		
		<!-- #BeginEditable "footer" -->



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
