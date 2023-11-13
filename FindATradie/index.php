<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
<!-- #BeginTemplate "master.dwt" -->

	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Home</title>
		<!-- #EndEditable -->
		<?php include "common.php"; ?>
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
	
	<body onresize="SetPageContetHeight()">
	
		<!-- Begin Masthead -->
		<div class="masthead" id="masthead">
			<img class="logo" alt="" src="images/Tradie.png" width="90" />
			<div class="title" id="title">FIND A TRADIE</div>
			<a class="masthead_button" href="new_tradie.php">TRADIE REGISTRATION</a>
			<a class="masthead_button" href="new_customer">CUSTOMER REGISTRATION</a>
			<a class="masthead_button" href="login.php">LOG IN</a>
			<div class="tag" id="tag">Created by an Australian tradie for Australians</div>
			<!-- Begin Navigation -->
			<nav class="navigation" id="navigation">
				<a class="navigation_link" href="index.php">Home</a>
				<a class="navigation_link" href="benefits.php">Benefits</a>
				<a class="navigation_link" href="about.html">About</a>
					<?php
	
						if (isset($_SESSION["account_id"]) && ($_SESSION["account_id"] != ""))
							echo "<a class=\"navigation_link\" href=\"account.php\">Account</a>\n";
						else
							echo "<a class=\"navigation_link\" href=\"login.php\">Login</a>\n";
							
					?>
					<a class="navigation_link" href="contact.html">FAQ</a>
					<a class="navigation_link" href="contact.html">Contact</a>
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

	function IsMatchMaxSize($strTradieMaxSize, $strJobSizeIndex)
	{
		$nJobSize = (int)$strJobSizeIndex;
		$nTradieMaxSizeIndex = 0;
		
		if ($strTradieMaxSize == "Up to 50")
			$nTradieMaxSizeIndex = 0;
		else if ($strTradieMaxSize == ">50 - 100")
			$nTradieMaxSizeIndex = 1;
		else if ($strTradieMaxSize == "100 - 250")
			$nTradieMaxSizeIndex = 2;
		else if ($strTradieMaxSize == "250 - 500")
			$nTradieMaxSizeIndex = 3;
		else if ($strTradieMaxSize == "More than 500")
			$nTradieMaxSizeIndex = 4;
		else if ($strTradieMaxSize == "Up to 50")
			$nTradieMaxSizeIndex = 5;
			
		return $nJobSize <= $nTradieMaxSizeIndex;
	}
	
	function IsDistanceMatch($strTradiePostcode, $strJobPostcode, $strTradieMaxDistance)
	{
		echo "<div style=\"background-color:white;\">";
		$url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $strTradiePostcode . "&destinations=". $strJobPostcode . "&mode=driving&language=en-EN&sensor=false";

		$data   = @file_get_contents($url);
		$result = json_decode($data, true);
		if ($result)
		{
			$nDistance = (int)$result["rows"][0]["elements"][0]["distance"]["value"] / 1000;
			echo "<h1>" . $nDistance . "</h1>";
			print_r($result);
		}
		else
		{
			print_r($result);
		}
		echo "</div>";
		return $nDistance <= (int)$strTradieMaxDistance;
	}
	
	IsDistanceMatch("3076", "2000", "10");
	$strResultsDisplay = "none";
	$arrayResults = [];
	if (isset($_POST["select_trade"]))
	{
		$strResultsDisplay = "block";
		
		$results = DoFinQuery1($g_dbFindATradie, "members", "trade_id", $_POST["select_trade"]);
		$row = $results->fetch_assoc();
		if (IsMatchMaxSize($row["maximim_size"], $_POST["select_job_size"]) && 
			((int)$_POST["text_maximum_budget"] >= $row["minimum_budget"]) &&
			IsDistanceMatch($row["postcode"], $_POST["text_postcode"], $row["maximum_distance"]))
			$arrayResults[] = [$row["business_name"] . ", " . $row["suburb"] . ", " . $row["postcode"], $row["id"]];
	}

?>

				<div class="note">
					
					<h4>Both customers &amp; tradies need to register and login to use this service.</h4>
					<h5>However you can give it a test run here.</h5>
					<h6><a href="befits.php">Click here</a> to read the benefits of becoming a member of 'Find a tradie'.</h6>
					<form method="post" action="index.php" style="width:57em;">
						
						<table class="table_no_borders">
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What type of tradie are you looking for?</b>
								</td>
								<td class="cell_no_borders">
									&nbsp;&nbsp;<select id="select_trade" name="trade">
										<?php DoGeneratePrimaryTradeOptions(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What is you maximum budget?</b>
								</td>
								<td class="cell_no_borders">
									$&nbsp;<input type="text" id="text_maximum_budget" name="text_maximum_budget" maxlength="6" onkeydown="OnKeyPressDigitsOnly(event)" />
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What is the size of your job?</b>
								</td>
								<td class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<select id="select_job_size" name="select_job_size">
										<option selected value="0">Up to 50</option>
										<option value="1">50 - 100</option>
										<option value="2">100 - 250</option>
										<option value="3">250 - 500</option>
										<option value="4">More than 500</option>
									</select>&nbsp;<b>m<sup>2</sup></b>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>What is your postcode?</b>
								</td>
								<td class="cell_no_borders">
									&nbsp;&nbsp;&nbsp;<input type="text" id="text_postcode" name="text_postcode" maxlength="4" onkeydown="OnKeyPressDigitsOnly(event)" />
								</td>
							</tr>
						</table>
					</form>
					<div id="results" style="display: <?php echo $strResultsDisplay; ?>;">
						<h6><u>RESULTS</u></h6>
						<select id="text_results" size="20" style="width:56em;border-width:medium;border-color:var(--NoteHeadingColor);">
							<?php
								for ($nI = 0; $nI < count($arrayResults); $nI++)
								{
									echo "<option value=\"" . $arrayResults[$nI][1] . "\">";
									echo $arrayResults[$nI][0];
									echo "</option>\n";
								}
							?>
						</select>
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
								
		</script>
	
	</footer>
	
<!-- #EndTemplate -->
	
</html>
