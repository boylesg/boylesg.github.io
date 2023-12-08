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
		<title>Frequently Asked Questions</title>
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
	</head>
	
	<body>
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tools.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php"><img src="images/StoneButtonTradie.png" alt="images/StoneButtonTradie.png" width="150"/></a>
			<a class="masthead_button" href="new_customer.php"><img src="images/StoneButtonCustomer.png" alt="images/StoneButtonCustomer.png" width="150"/></a>
			<a class="masthead_button" href="login.php"><img src="images/StoneButtonLogin.png" alt="images/StoneButtonLogin.png" width="150"/></a>
			<div class="tag" id="tag">Created by an Australian tradie for Australians</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php"><img src="images/StoneButtonHome.png" alt="images/StoneButtonHome.png" width="150"/></a>
				<a class="navigation_link" href="benefits.php"><img src="images/StoneButtonBenefits.png" alt="images/StoneBenefitsTradie.png" width="150"/></a>
				<a class="navigation_link" href="about.php"><img src="images/StoneButtonAbout.png" alt="images/StoneButtonAbout.png" width="150"/></a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\"><img src=\"images/StoneButtonAccount.png\" alt=\"images/StoneButtonAccount.png\" width=\"150\"/></a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\"><img src=\"images/StoneButtonLogin.png\" alt=\"images/StoneButtonLogin.png\" width=\"150\"/></a>\n";
							
					?>
					<a class="navigation_link" href="faq.php"><img src="images/StoneButtonFAQ.png" alt="images/StoneButtonFAQ.png" width="150"/></a>
					<a class="navigation_link" href="contact.php"><img src="images/StoneButtonContact.png" alt="images/StoneButtonContact.png" width="150"/></a>
					<a class="navigation_link" href="forum.php"><img src="images/StoneButtonForum.png" alt="images/StoneButtonForum.png" width="150"/></a>
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








				<div class="advert" id="advert_faq1" style="height: 80px; width: 95%;">
					<?php DoInsertAdvert("faq1", 70, "advert_faq1"); ?>
				</div>

				<div class="advert" id="advert_faq2" style="height: 80px; width: 95%;margin-top:20px;margin-bottom:10px;">
					<?php DoInsertAdvert("faq2", 70, "advert_faq2"); ?>
				</div>
				
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
							Q. Do I have to pay for leads?<br/>
						</li>
						<li class="faq_answer">A. You do not have to pay an additional fee for leads.</li>
						<hr/><li class="faq_question">
							Q. How much will it cost me to list a job for tradies?<br/>
						</li>
						<li class="faq_answer">A. It won't cost you anything to list jobs.</li>
						<hr/><li class="faq_question">
							Q. Can I add positive feedback and testimonials for jobs I have completed in the past?<br/>
						</li>
						<li class="faq_answer">A. Yes you can - just email us with the feedback and testimonials and we will add it for you. We need to peruse the feedback to satisfy ourselves that it is genuine.</li>
						<hr/><li class="faq_question">
							Q. How is <u>www.find-a-tradie.com.au</u> safer than Facebook groups?<br/>
						</li>
						<li class="faq_answer">
							A. The integrity of customers and treadies alike is only as good as the efforts of the Facebook group 
							owners to maintain it a high level. And let's face it, the amount of revenue from Facebaook groups is directly 
							proportional to the number of members. So the insentive for Facebook group owners is always to maximise the 
							number of group members rather than the integrity of its members.
						</li>
						<hr/><li class="faq_question">
							Q. Do you store bank account and credit card numbers?<br/>
						</li>
						<li class="faq_answer">A. No. All payments are made through Paypal, so no financial details are stored on the web site.</li>
						<hr/><li class="faq_question">
							Q. I am a customer so why do I have to join to 'Find a Tradie'?<br/>
						</li>
						<li class="faq_answer">
							A. Because we want this system to be fair for both 
							tradies and their customers. It employs a mutual 
							trust and feedback system, similar to eBay, that 
							allows both tradies and customers to judge each 
							other's integrity based on their feedback and 
							testimonials
						<hr/><li class="faq_question">
							Q. What if someone hacks my account?<br/>
						</li>
						<li class="faq_answer">
							A. If they do then it is not really going to bring them much benefit. There are no credit cards numbers,
							no bank account numbers, no dates of birth or any other identity data for them to steal. Other than what you
							 have likely made public yourself in the Yellow Pages or on Facebook etc. All comminications take place 
							 via your phone numbers and private email accounts, so there is litle information about you for them to 
							 access. Unless they also hack your email and mobile accounts
						</li>
						<hr/><li class="faq_question">
							Q. Does 'Find a Tradie' provide guarentees on workmanship or refunds?<br/>
						</li>
						<li class="faq_answer">
							A. No. It is simply a platform to allow tradies to connect with customers. We play no 
							role in business relationships or financial transactions between tradies and their customers.
						</li>
						<hr/><li class="faq_question">
							Q. Does 'Find a Tradie'  store any other sensitive personal data?<br/>
						</li>
						<li class="faq_answer">
							A. No. The only data we store is basic contact information. In the case of tradies they routinely make 
							that information publicly available through advertising. In the case of customers they make basic contact 
							information public on web sites like Google and Facebook. In both cases you we do not require you to 
							enter your street address. If you have a business address then you can include your street address if you 
							wish.
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
		
		<!-- #BeginEditable "footer" -->



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
