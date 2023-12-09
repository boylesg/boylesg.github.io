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
		<title>Home</title>
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
</style>
		<!-- #EndEditable -->
	</head>
	
	<body>
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tools.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php" style="margin-right:0px;">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer.php">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie.</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">HOME</a>
				<a class="navigation_link" href="benefits.php">BENEFITS</a>
				<a class="navigation_link" href="about.php">ABOUT</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">ACCOUNT</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">LOG IN</a>\n";
							
					?>
					<a class="navigation_link" href="faq.php">FAQ</a>
					<a class="navigation_link" href="contact.php">CONTACT</a>
					<a class="navigation_link" href="forum.php">FORUM</a>
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

	$strResultsDisplay = "none";
	$arrayResults = [];

	if (isset($_POST["submit_search"]))
	{
		$arrayResults = DoSearchTradies($_POST["select_trade"], $_POST["select_job_size"], $_POST["text_maximum_budget"], $_POST["text_postcode"]);
		if (count($arrayResults) > 0)
			$strResultsDisplay = "block";
	}

?>
				<div class="note" style="display:block;font-weight:bold;font-size:medium;margin-top:0px;">
					Tradies can join for 6 months, free of charge, until <span style="color:red;"><?php echo $g_dateJoinFree->format("d/m/Y"); ?></span>.
					&nbsp;&nbsp;
					<?php echo $g_nDaysToGo; ?> days to go!
				</div>

				<div class="note" style="flex-wrap: wrap;">
					<h6><a href="befits.php">Click here</a> to read the benefits of becoming a member.</h6>
					<p style="font-size:medium;"><b>find-a-tradie.com.au</b> is perfect for tradies and small business people who 
					are just starting out with their sole proprietor business, and don't yet have a large advertising budget.</p>
					<p style="font-size:medium;">Don't forget to join the <a href="forum.php">forum</a> once you become a member - 
					just use the same user name and password to register that you have used for 'find-a-tradie'. 
					Customers and tradies can negotiate jobs directly with each other through this forum, in the same way as 
					others do on Facebook. However you can rest assured that your personal data will not be exploited for profit as 
					Facebook does. It is an alternative to posting jobs if you prefer a more social experience.</p>
				</div>
						
				<div class="advert" id="advert_index1" style="height: 100px; width: 95%;">
					<?php DoInsertAdvert("index1", 70, "advert_index1"); ?>
				</div>

				<div class="note" style="flex-wrap: wrap;">
					
					<div>
						<h6>Both customers &amp; tradies need to register and login to use this service.</h6>
						<p style="font-size:medium;">However you can give it a test run here...</p>
					</div>
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
								<td style="text-align:right;" class="cell_no_borders" colspan="2">
									<input type="submit" id="submit_search"  name="submit_search" value="SEARCH" />
								</td>
							</tr>
						</table>
					</form>
					<div class="advert" id="advert_index2" style="height: 208px; width: 100%;">
						<?php DoInsertAdvert("index2", 180, "advert_index2"); ?>
					</div>
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
		
		<!-- #BeginEditable "footer" -->



		<?php //DoCleanupAdvertImages(); ?>



		<!-- #EndEditable -->

	</footer>
	
<!-- #EndTemplate -->
	
</html>
