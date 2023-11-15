<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	
	<!-- #BeginTemplate "master.dwt" -->
	
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<!-- #BeginEditable "doctitle" -->
		<title>Create an advertisement</title>
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
						
			<script type="text/javascript">
			
				function OnMonthsChange(inputMonths, nCostPerMonth)
				{
					let labelCost = document.getElementById("label_cost");
					
					if (labelCost)
					{
						let nCost = Number(inputMonths.value) * nCostPerMonth;
						labelCost.value = nCost.toString();
					}
				}
			
			</script>
			
		<!-- #EndEditable -->
	</head>
	
	<body>
	
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
					
					function DoGetLocationName()
					{
						$strLocationName = "";
						
						if (isset($_GET["location"]))
						{
							if ($_GET["location"]== "index1")
								$strLocationName = "Home page, top";
							else if ($_GET["location"]== "login1")
								$strLocationName = "Login page, top";
						}
						return $strLocationName;
					}
					
					function DoGetCost()
					{
						global $g_dbFindATradie;
						$nCost = 0;
						
						if (isset($_GET["location"]))
						{
							$results = DoFinQuery1($g_dbFindATradie, "advert_space_name", $_GET["location"]);
							if ($results->num_rows > 0)
							{
								$row = $result->fetch_assoc();
								$nCost = $row["cost_per_month"];
							}
						}
						return $nCost;
					}
										
				?>
				<div class="note" style="flex-wrap:wrap;">
					<h6><b>LOCATION: </b><?php if (isset($_GET["location"])) echo DoGetLocationName(); ?></h6>
					<div style="width:500px;"></div>
					<form class="advert_form" id="advert_form" method="post" action="advert.php" style="width: 748px;">
						<table class="table_no_borders">
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Select and image to display</b>
								</td>
								<td class="cell_no_borders">
									<input type="file" id="file_image" name="file_image" accept=".jpg, .png, .jpeg, .gif|image/*"/>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Image preview</b>
								</td>
								<td class="cell_no_borders">
									<img src="" alt="IMAGE PREVIEW" id="image_review" width="600" />
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Text to display beside image</b>
								</td>
								<td class="cell_no_borders">
									<textarea cols="60" rows="10" maxlength="620"></textarea>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>How many months?</b>
								</td>
								<td class="cell_no_borders">
									<input type="text" size="4" maxlength="3" id="text_months" name="text_month" onchange="OnMonthsChange(this, <?php echo DoGetCost(); ?>)" onkeypress="OnKeyPressDigitsOnly(eventKey)" />
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders">
									<b>Cost</b>
								</td>
								<td class="cell_no_borders">
									$<label id="label_cost"></label>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;" class="cell_no_borders" colspan="2">
									<input type="submit" id="submit_advert"  name="submit_advert" value="SUBMIT" />
								</td>
							</tr>
						</table>
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
