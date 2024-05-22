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
		sessionStorage["member_id"] = <?php echo $_SESSION["account_id"]; ?>
	
	</script>
	<!-- #BeginEditable "server" -->
	
		<?php
		
		?>
	
	<!-- #EndEditable -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Home</title>
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
			
			setInterval(DoNextAdvert, g_nMillisAdvertTimeout);
			
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
					<li class="navigation_list_item"><a class="navigation_link" href="admin.php">ADMIN</a></li>
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








<?php

	$strResultsDisplay = "none";
	$arrayResults = [];

	if (isset($_POST["submit_search"]))
	{
		$arrayResults = DoSearchTradies($_POST["select_trade"], $_POST["select_job_size"], $_POST["text_maximum_budget"], $_POST["text_postcode"]);
		if (count($arrayResults) > 0)
			$strResultsDisplay = "block";
	}

?>
				<div class="note" style="display:none;font-weight:bold;font-size:medium;margin-top:0px;height:70px;">
					<img src="images/UnderConstruction.jpg" alt="images/UnderConstruction.jpg" width="150" style="float:left;" />
					Tradies can join for their first 6 months, free of charge.
				</div>

				<div class="note" style="display:block;">
					<img src="images/Lawn-Mowing.jpg" alt="images/Lawn-Mowing.jpg" width="180" style="float:left;margin-right:10px;margin-bottom:10px;"/>
					<h6><a href="benefits.php">Click here</a> to read the benefits of becoming a member.</h6>
					<p style="font-size:large;">
						<b><u>www.find-a-tradie.com.au</u></b> is perfect for tradies and small business people who are just starting out 
						with their sole proprietor business, and are reluctant to spend $100 per month or more for avertising, when 
						there are no guarantees of it resulting in enough paid jobs to cover the cost.
					</p>
					<p style="font-size:large;">
						With <b><u>www.find-a-tradie.com.au</u></b> membership will cost you a maximum of 
						$<?php echo sprintf("%d", $g_nCostPerMonth * 12); ?> per year and you can try for as many jobs as you 
						please, with no additional charges. So there is little risk of you spending more on advertising than you 
						are likely to earn over an entire year.
					</p>
					<hr/>
					<img src="images/forum.jpg" alt="images/forum.jpg" width="340" style="float:right;margin-left:10px;margin-bottom:10px;"/>
					<h6>Community forum</h6>
					<p style="font-size:large;">
						Don't forget to join the <a href="forum.php">forum</a> once you become a member - just use the same user 
						name and password to register a forum account.
					</p>
					<p style="font-size:large;">
						Customers and tradies can negotiate jobs directly with each other through this forum, in the same way as 
						others do on Facebook. However you can rest assured that your personal data will not be exploited for 
						profit as Facebook does. 
					</p>
					<p style="font-size:large;">
						It is an alternative to posting jobs and waiting for tradies to respond to your job request, if you prefer a more social 
						experience. You can also seek advice from  tradies about the feasibility of different solutions to your 
						particular problems, and discuss jobs and times. Take advantage of this community and get involved.
					</p>
					<hr/>
					<h6>Both customers &amp; tradies need to register and login to use this service.</h6>
					<p style="font-size:large;">However if you are new here then you can give it a test run...</p>
					<form method="post" action="index.php" style="width:745px">
						
						<table class="table_no_borders">
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What type of tradie are you looking for?</b>
								</td>
								<td class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<select id="select_trade" name="select_trade">
										<?php 
											if (isset($_POST["select_trade"]))
												DoGeneratePrimaryTradeOptions($_POST["select_trade"]);
											else
												DoGeneratePrimaryTradeOptions("");
											?>
									</select>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What is you maximum budget?</b>
								</td>
								<td class="cell_no_borders">
									$&nbsp;<input type="text" id="text_maximum_budget" name="text_maximum_budget" maxlength="6" value="<?php if (isset($_POST["text_maximum_budget"])) echo $_POST["text_maximum_budget"]; ?>" onkeydown="OnKeyPressDigitsOnly(event)" />
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What is the size of your job?</b>
								</td>
								<td class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<select id="select_job_size" name="select_job_size">
										<option value="0" <?php if ((isset($_POST["select_trade"]) && ($_POST["select_trade"] == "0")) || !isset($_POST["select_trade"])) echo "selected"; ?>>Up to 50</option>
										<option value="1" <?php if (isset($_POST["select_trade"]) && ($_POST["select_trade"] == "1")) echo "selected"; ?>>50 - 100</option>
										<option value="2" <?php if (isset($_POST["select_trade"]) && ($_POST["select_trade"] == "2")) echo "selected"; ?>>100 - 250</option>
										<option value="3" <?php if (isset($_POST["select_trade"]) && ($_POST["select_trade"] == "3")) echo "selected"; ?>>250 - 500</option>
										<option value="4" <?php if (isset($_POST["select_trade"]) && ($_POST["select_trade"] == "4")) echo "selected"; ?>>More than 500</option>
									</select>&nbsp;<b>m<sup>2</sup></b>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What is your postcode?</b>
								</td>
								<td class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<input type="text" id="text_postcode" name="text_postcode" maxlength="4" value="<?php if (isset($_POST["text_postcode"])) echo $_POST["text_postcode"]; ?>" onkeydown="OnKeyPressDigitsOnly(event)" />
								</td>
							</tr>
							<tr>
								<td style="text-align:left;" class="cell_no_borders">
									&nbsp;
								</td>
								<td style="text-align:left;" class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<input type="submit" id="submit_search"  name="submit_search" value="SEARCH" />
								</td>
							</tr>
						</table>
					</form>
					<div id="results" style="display: <?php echo $strResultsDisplay; ?>;">
						<h6><u>RESULTS</u></h6>
						<select id="text_results" size="10" style="font-size:large;width:850px;border-width:medium;border-color:var(--NoteHeadingColor);">
							<?php
								$strSelected = " selected";
								for ($nI = 0; $nI < count($arrayResults); $nI++)
								{
									echo "<option value=\"" . $arrayResults[$nI][1] . "\"" . $strSelected . ">";
									echo $arrayResults[$nI][0];
									echo "</option>\n";
									$strSelected = "";
								}
							?>
						</select>
						<br/><br/>
						<input type="button" value="VIEW DETAILS" onclick="alert('You need to register and login to use this feature.')" />
					</div>
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
