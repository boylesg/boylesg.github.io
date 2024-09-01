<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<?php 
		require_once $_SERVER['DOCUMENT_ROOT'] . "/common.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/advert_stuff.php";
	?>
	<script type="text/javascript">	
	
		var g_arrayAdverts = [
								<?php DoGenerateJSAdvertArray(); ?>
					 		 ];
		sessionStorage["member_id"] = <?php if (isset($_SESSION["account_id"])) echo $_SESSION["account_id"]; else echo "0"; ?>
	
	</script>
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Admin Functions</title>
		<!-- #EndEditable -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/common.js"; ?>
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
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;" title="Join find-a-tradie as a tradie looking for customers...">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php" title="Join find-a-tradie as a customer looking for tradies...">CUSTOMER REGISTRATION</a>
			<?php 
				$g_strLoginButtonDisplay = "block";
				$g_strLogoutButtonDisplay = "none";
					
				if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
				{
					$g_strLoginButtonDisplay = "none";
					$g_strLogoutButtonDisplay = "block";
				}
			?>
			<a class="masthead_button" href="login.php" style="display:<?php echo $g_strLoginButtonDisplay; ?>;" title="Login to your account...">LOG IN</a>
			<a class="masthead_button" href="login.php?submit_logout=LOG OUT" style="display:<?php echo $g_strLogoutButtonDisplay; ?>;" title="Logout of your account...">LOG OUT</a>
			
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<ul class="navigation_list">
					<li class="navigation_list_item"><a class="navigation_link" href="index.php" title="Return to the home page...">HOME</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="benefits.php" title="Read about the many benefits of becoming a find-a-tradie member...">BENEFITS</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="about.php" title="Read about why find-a-tradie was created...">ABOUT</a></li>
						<?php
		
							if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a></li>\n";
							else
								echo "<li class=\"navigation_list_item\"><a class=\"navigation_link\" href=\"login.php\">LOG IN</a></li>\n";
								
						?>
					<li class="navigation_list_item"><a class="navigation_link" href="faq.php" title="Frequently Asked Questions answered...">FAQ</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="contact.php" title="Contact find-a-tradie...">CONTACT</a></li>
					<li class="navigation_list_item"><a class="navigation_link" href="forum.php" title="Talk to tradies about your job...">FORUM</a></li>
				</ul>
				<a href="https://www.facebook.com/FindATradiePage" class="social_media" title="Go to the facebook page..."><img src="images/Facebook.png" alt="images/Facebook.png" width="30" /></a>
				<a id="find-a-tradie-app" class="app_button" href="https://www.find-a-tradie.com.au/app/find_a_tradie.apk" download title="Download the android app...">
					<img src="images/AndroidMobile.png" height="60" />
				</a>
				&nbsp;
				<a id="find-a-tradie-app" class="app_button" href="" download title="IOS app is comming...">
					<img src="images/AppleMobile.png" height="60" />
				</a>

			</nav>
			<!-- End Navigation -->
		</div>
		<!-- Begin PageHeading -->
		<div id="page_heading text_outline"class="page_heading"><script type="text/javascript">document.write(document.title);</script></div>				
		<!-- End PageHeading -->
		<!-- End Masthead -->
		<!-- Begin Page Content -->
		<div class="page_content" id="page_content">
			<marquee id="advert_marquee " behavior="alternate" scrolldelay="80" truespeed loop="-1" style="<?php if (strcmp(basename($_SERVER['REQUEST_URI']), "admin.php") == 0) echo "none"; else echo "block";?>;" class="advert_marquee">
				<?php DoGenerateAdvertSlotHTML(__FILE__); ?></marquee>
			<!-- #BeginEditable "content" -->








<?php

	if (isset($_POST["submit_trade_edit"]))
	{
		$results = DoUpdateQuery2($g_dbFindATradie, "trades", "name", $_POST["text_trade_name"], "description", $_POST["text_trade_desc"], "id", $_POST["text_trade_id"]);
		if (!$results)
		{
			PrintJSAlertError("Failed to save changes to trade '" . $_POST["text_trade_name"] . "'!", 4);
		}
	}
	else if (isset($_POST["submit_new_trade"]))
	{
		$results = DoInsertQuery2($g_dbFindATradie, "trades", "name", $_POST["text_trade_name"], "description", $_POST["text_trade_desc"]);
		if (!$results)
		{
			PrintJSAlertError("Failed to save new trade '" . $_POST["text_trade_name"] . "'!", 4);
		}
	}

?>
				<div class="note" style="flex-wrap:wrap;">
					
					<h6>TRADES</h6>
					<div style="overflow-y:auto;height:20em;padding:10px;">
						<table class="form" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="">
									<table class="" border="0" cellpadding="0" cellspacing="2"><tr>
										<td style="width:17.5em;padding-left:0.8em"><b>TRADE NAME</b></td>
										<td style="width:66em;"><b>DESCRIPTION</b></td>
										<td style=""><b>Functions</b></td>
									</tr></table>
								</td>
							</tr>
							<?php DoGenerateTradesList(); ?>
						</table>
					</div>
					<br/><br/>
					<form class="form" method="post" style="width:56em;">
						<h6>ADD NEW TRADE</h6>
						<label for="text_name">Name</label><br/>
						<input type="text" name="text_trade_name" size="30" /><br/><br/>
						<label for="text_name">Description</label><br/>
						<textarea name="text_trade_desc" cols="100" rows="4"></textarea><br/><br/>
						<button type="submit" name="submit_new_trade" title="Save new trade" class="function_button"><img src="images/save.png" alt="images/save.png" class="function_button_image" /></button>
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
