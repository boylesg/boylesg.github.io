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
		<title>Contact Us</title>
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
					<a class="navigation_link" href="phpBB3/index.php">Forum</a>
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

	if (isset($_POST["submit_message"]))
	{
		mail($g_strEmailAddress, $_POST["select_about"], $_POST["hidden_member_id"] . ", " . $_POST["hidden_member_name"] . "\r\n\r\n" . $_POST["text_message"], "From: <" . $_POST["hidden_email"] . ">\r\n");
	}
?>
				<div class="note" style="flex-wrap:wrap;">

					<form method="post" action="" id="form_contact">
						
						<table class="table_no_borders">
							<tr>
								<td class="cell_no_borders"><b>What are you contacting us about?</b></td>
								<td class="cell_no_borders">
									<select id="select_about" name="select_about">
										<option value="1">Please add my tesimonials</option>
										<option value="2">Technical problem</option>
										<option value="3">Complaint</option>
										<option value="4">Testimonial</option>
										<option value="5">Other</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="cell_no_borders"><b>Date</b></td>
								<td class="cell_no_borders">
									<input type="date" id="date_now" name="date_now" readonly value="<?php echo date("Y-m-d"); ?>" />
								</td>
							</tr>
							<tr>
								<td class="cell_no_borders"><b>Message</b></td>
								<td class="cell_no_borders">
									<textarea id="text_message" name="text_message" cols="128" rows="10"></textarea>
								</td>
							</tr>
							<tr>
								<td class="cell_no_borders" colspan="2"><input type="submit" name="submit_message" value="SEND" /></td>
							</tr>
						</table>
						<hidden id="hidden_member_id" name="hidden_member_id" value="<?php if (isset($_SESSIION["account_id"])) echo $_SESSIION["account_id"]; ?>" />
						<hidden id="hidden_member_name" name="hidden_member_id" value="<?php if (isset($_SESSIION["account_first_name"])) echo $_SESSIION["account_first_name"] . " " . $_SESSIION["account_surname"]; ?>" />
						<hidden id="hidden_email" name="hidden_email" value="<?php if (isset($_SESSIION["account_email"])) echo $_SESSIION["account_email"]; ?>" />
					</form>

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
