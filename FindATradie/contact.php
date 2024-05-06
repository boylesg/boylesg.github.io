<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
<!-- #BeginTemplate "master.dwt" -->

	<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.php"; ?>
	
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Contact Us</title>
		<!-- #EndEditable -->
		<?php 
			include $_SERVER['DOCUMENT_ROOT'] . "/common.js";
			include "set_advert.php";
		?>
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
				<a href="https://www.facebook.com/FindATradiePage/?viewas=100000686899395" class="social_media" ><img src="images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
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
				<form id="form_adverts" method="post">
					<table class="scroll" cellpadding="0" cellspacing="0" border="0" id="advert_1">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(1)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_1_text">ADVERT 1 HTML</td>
							<div class="advert_expires" id="advert_1_expires" colspan="2">Advert expires on 0/0/0000</div>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_2" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(2)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_2_text">ADVERT 2 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_3" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(3)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_3_text">ADVERT 3 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_4" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(4)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_4_text">ADVERT 4 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_5" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(5)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_5_text">ADVERT 5 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_6" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(6)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_6_text">ADVERT 6 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_7" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(7)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_7_text">ADVERT 7 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_8" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(8)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_8_text">ADVERT 8 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_9" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(9)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_9_text">ADVERT 9 HTML</td>
						</tr>
					</table>
					<table cellpadding="0" cellspacing="0" border="0" id="advert_10" style="display: none;">
						<tr class="advert_row">
							<td>
								<button type="button" onclick="DoSetAdvert(10)" class="advert_button">
									<img class="advert_logo" src="images/AdvertiseHere.png" alt="AdvertiseHere.png" />
								</button>
							</td>
							<td class="advert_text" id="advert_10_text">ADVERT 10 HTML</td>
						</tr>
					</table>
					<input type="hidden" id="advert_space_code" name="advert_space_code" />
				</form>
			</div>
			<!-- #BeginEditable "content" -->








<?php

	if (isset($_POST["submit_message"]))
	{
		mail($g_strEmailAddress, $_POST["select_about"], $_POST["hidden_member_id"] . ", " . $_POST["hidden_member_name"] . "\r\n\r\n" . $_POST["text_message"], "From: <" . $_POST["hidden_email"] . ">\r\n");
	}
?>
				<div class="advert" id="advert_contact1" style="height: 80px; width: 95%;">
					<?php DoInsertAdvert("contact1", 70, "advert_contact1"); ?>
				</div>

				<div class="advert" id="advert_contact2" style="height: 80px; width: 95%;margin-top:20px;margin-bottom:10px;">
					<?php DoInsertAdvert("contact2", 70, "advert_contact2"); ?>
				</div>
				
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

				<div class="advert" id="advert_contact3" style="height: 80px; width: 95%;">
					<?php DoInsertAdvert("contact3", 70, "advert_contact3"); ?>
				</div>

				<div class="advert" id="advert_contact4" style="height: 80px; width: 95%;margin-top:20px;margin-bottom:10px;">
					<?php DoInsertAdvert("contact4", 70, "advert_contact4"); ?>
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
