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








		<div class="page_content" id="page_content0">








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

				<div class="note" style="flex-wrap: wrap;">
					
					<div>
						<h4>Both customers &amp; tradies need to register and login to use this service.</h4>
						<h5><a href="befits.php">Click here</a> to read the benefits of becoming a member of 'Find a tradie'.</h5>
						<h6>However you can give it a test run here...</h6>
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
					<div class="advert" id="advert_index" style="height: 208px; width: 484px;">
						<?php DoInsertAdvert("index1", 180, "advert_index"); ?>
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
